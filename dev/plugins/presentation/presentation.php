<?php

/**
 * Presentation Plugin
 *
 * PHP version 7
 *
 * @category   Extensions
 * @package    Grav
 * @subpackage Presentation
 * @author     Ole Vik <git@olevik.net>
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @link       https://github.com/OleVik/grav-plugin-presentation
 */

namespace Grav\Plugin;

use Grav\Common\Grav;
use Grav\Common\Plugin;
use Grav\Common\Utils;
use Grav\Common\Uri;
use Grav\Common\Inflector;
use Grav\Common\Page\Page;
use Grav\Common\Page\Pages;
use Grav\Common\Page\Media;
use Grav\Common\Page\Collection;
use RocketTheme\Toolbox\Event\Event;

use Grav\Plugin\PresentationPlugin\API\Content;
use Grav\Plugin\PresentationPlugin\API\Parser;
use Grav\Plugin\PresentationPlugin\API\Transport;
use Grav\Plugin\PresentationPlugin\API\Poll;
use Grav\Plugin\PresentationPlugin\Utilities;

/**
 * Creates slides using Reveal.js
 *
 * Class PresentationPlugin
 *
 * @category Extensions
 * @package  Grav\Plugin
 * @author   Ole Vik <git@olevik.net>
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @link     https://github.com/OleVik/grav-plugin-presentation
 */
class PresentationPlugin extends Plugin
{

    /**
     * Protected variables
     *
     * @var bool      $cache     Grav cache setting
     * @var Transport $transport Transport API
     * @var Parser    $parser    Parser API
     * @var Content   $content   Content API
     */
    protected $cache;
    protected $cacheTwig;
    protected $transport;
    protected $parser;
    protected $content;

    /**
     * Register intial event and libraries
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        include __DIR__ . '/vendor/autoload.php';
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0],
        ];
    }

    /**
     * Initialize the plugin and events
     *
     * @return void
     */
    public function onPluginsInitialized()
    {
        if ($this->config->get('plugins.presentation.enabled') != true) {
            return;
        }
        if ($this->config->get('system.debugger.enabled')) {
            $this->grav['debugger']->startTimer('presentation', 'Presentation');
        }
        if ($this->isAdmin() && $this->config->get('plugins.admin')) {
            $this->enable(
                [
                    'onPagesInitialized' => ['handleAPI', 0],
                    'onGetPageTemplates' => ['onGetPageTemplates', 0],
                    'onTwigSiteVariables' => ['twigBaseUrl', 0],
                    'onAssetsInitialized' => ['onAdminPagesAssetsInitialized', 0]
                ]
            );
        }
        $this->cache = $this->grav['config']->get('system.cache.enabled');
        $this->cacheTwig = $this->grav['config']->get('system.pages.never_cache_twig');
        $this->enable(
            [
                'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
                'onPageInitialized' => ['pagePreCache', 0],
                'onPageContentProcessed' => ['pageIteration', -10],
                'onTwigExtensions' => ['onTwigExtensions', 0],
                'onTwigTemplatePaths' => ['templates', 0],
                'onTwigSiteVariables' => ['twigBaseUrl', 0],
                'onPagesInitialized' => ['handleAPI', 0],
                'onAssetsInitialized' => ['onAssetsInitialized', 0],
                'onShutdown' => ['onShutdown', 0]
            ]
        );
        if ($this->config->get('system.debugger.enabled')) {
            $this->grav['debugger']->stopTimer('presentation');
        }
    }

    /**
     * Declare config from plugin-config
     *
     * @return array Plugin configuration
     */
    public function config()
    {
        if ($this->config->get('plugins.presentation')) {
            return (array) $this->config->get('plugins.presentation');
        }
        return false;
    }

    /**
     * Disable caching for related templates
     *
     * @return void
     */
    public function pagePreCache()
    {
        if ($this->grav['page']->template() == 'presentation' || $this->grav['page']->template() == 'slide') {
            $this->grav['config']->set('system.cache.enabled', false);
            $this->grav['config']->set('system.pages.never_cache_twig', true);
        }
    }


    /**
     * Construct the page
     *
     * @return void
     */
    public function pageIteration()
    {
        $grav = $this->grav;
        $config = $this->config();
        if ($grav['page']->template() == 'presentation' || $grav['page']->template() == 'slide') {
            if (!isset($this->grav['twig']->twig_vars['reveal_init'])) {
                $baseUrl = $this->grav['uri']->rootUrl(true);
                $header = (array) $grav['page']->header();
                if (isset($header['presentation'])) {
                    $config = Utils::arrayMergeRecursiveUnique(
                        $config,
                        $header['presentation']
                    );
                }
                $this->transport = $this->getAPIInstance(
                    $config['transport']
                );
                $this->parser = $this->getAPIInstance(
                    $config['parser'],
                    $config,
                    $this->transport
                );
                $this->content = $this->getAPIInstance(
                    $config['content'],
                    $this->grav,
                    $config,
                    $this->parser,
                    $this->transport
                );
                $styles = $this->config->get('plugins.presentation.style') ??
                    $this->config->get('plugins.presentation.styles') ??
                    [];
                if (!empty($styles) && is_array($styles) && Utils::arrayIsAssociative($styles)) {
                    $this->parser->processor(
                        $styles,
                        'presentation',
                        (array) $grav['page']
                    );
                }
                $tree = $this->content->buildTree($grav['page']->route());
                $slides = $this->content->buildContent($tree);
                $grav['page']->setRawContent($slides);
                $menu = $this->content->buildMenu($tree);
                $menu = Utilities::flattenArray($menu, 1);
                $options = Utilities::parseAmbiguousArrayValues(
                    $this->config->get('plugins.presentation.options')
                );
                $options = json_encode($options, JSON_PRETTY_PRINT);
                $breakpoints = json_encode(
                    $this->config->get('plugins.presentation.breakpoints')
                );
                $this->grav['twig']->twig_vars['reveal_init'] = $options;
                $grav['assets']->addInlineJs('const reveal_init = ' . $options . ';', null, 'presentation');
                $this->grav['twig']->twig_vars['presentation_menu'] = $menu;
                $this->grav['twig']->twig_vars['presentation_breakpoints'] = $breakpoints;
                if ($grav['page']->template() == 'presentation') {
                    $grav['assets']->addInlineCss($this->transport->getStyles(), null, 'presentation');
                }
            }
        }
    }

    /**
     * Handle API
     *
     * @return void
     */
    public function handleAPI()
    {
        $uri = $this->grav['uri'];
        $page = $this->grav['page'];
        $plugins = $this->config->get('plugins');
        if ($uri->path() == '/' . $this->config->get('plugins.presentation.api_route')) {
            if ($_GET['action'] == 'poll') {
                $this->handlePollAPI(
                    $uri,
                    $page,
                    (array) $this->config->get('plugins.presentation')
                );
            }
        }
        if (isset($plugins['admin']) && $plugins['admin']['enabled'] == true) {
            $adminRoute = $this->config->get('plugins')['admin']['route'];
            if ($uri->path() == $adminRoute . '/' . $this->config->get('plugins.presentation.api_route')) {
                if ($_GET['action'] == 'save') {
                    $this->handleSaveAPI();
                }
            }
        }
    }

    /**
     * Handle Save API
     *
     * @return void
     */
    public function handleSaveAPI()
    {
        if (!$this->isAdmin() || empty($_POST)) {
            return;
        }
        header('Content-Type: application/json');
        header("allow-control-access-origin: * ");
        header('HTTP/1.1 200 OK');
        try {
            $post = file_get_contents('php://input') ?? $_POST;
            $post = json_decode($post, true);
            $pages = Grav::instance()['pages'];
            $page = $pages->find('/' . $post['route']);
            $page->rawMarkdown(base64_decode($post['content']));
            $page->save();
            echo '200 OK';
        } catch (\Exception $e) {
            echo $e;
        }
        exit();
    }

    /**
     * Handle Poll API
     *
     * @param array $config Plugin configuration
     *
     * @return void
     */
    public function handlePollAPI($config)
    {
        if (isset($config['sync']) && $config['sync'] == 'poll') {
            set_time_limit(0);
            header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
            header('Pragma: no-cache');
            if (!isset($_GET['mode'])) {
                header('HTTP/1.1 400 Bad Request');
                exit('400 Bad Request');
            }
            $res = Grav::instance()['locator'];
            $target = $res->findResource('cache://') . '/presentation';
            include_once __DIR__ . '/API/PollInterface.php';
            include_once __DIR__ . '/API/Poll.php';
            $poll = new Poll($target, 'Poll.json');
            gc_enable();
            if (!isset($config['token']) || empty($config['token'])) {
                return;
            }
            if ($_GET['mode'] == 'set' && isset($_GET['data'])) {
                Utilities::authorize($config['token']);
                $poll->remove();
                header('Content-Type:text/plain');
                header('HTTP/1.1 202 Accepted');
                $poll->set(urldecode($_GET['data']));
            } elseif ($_GET['mode'] == 'get') {
                header('Content-Type: application/json');
                header('HTTP/1.1 200 OK');
                $poll->get();
            } elseif ($_GET['mode'] == 'remove') {
                Utilities::authorize($config['token']);
                header('Content-Type:text/plain');
                header('HTTP/1.1 200 OK');
                $poll->remove();
            }
            $poll = null;
            unset($poll);
            gc_collect_cycles();
            gc_disable();
            exit();
        }
    }

    /**
     * Add templates-directory to Twig paths
     *
     * @return void
     */
    public function templates()
    {
        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * Add root URL to Twig vars
     *
     * @return void
     */
    public function twigBaseUrl()
    {
        $uri = $this->grav['uri']->rootUrl(true);
        $this->grav['twig']->twig_vars['presentation_base_url'] = $uri;
    }

    /**
     * Reset cache on shutdown
     *
     * @return void
     */
    public function onShutdown()
    {
        $this->grav['config']->set('system.cache.enabled', $this->cache);
        $this->grav['config']->set('system.pages.never_cache_twig', $this->cacheTwig);
    }

    /**
     * Add Twig Extensions
     *
     * @return void
     */
    public function onTwigExtensions()
    {
        include_once __DIR__ . '/twig/CallStaticExtension.php';
        $this->grav['twig']->twig->addExtension(new PresentationPlugin\CallStaticTwigExtension());
        include_once __DIR__ . '/twig/FileFinderExtension.php';
        $this->grav['twig']->twig->addExtension(new PresentationPlugin\FileFinderTwigExtension());
    }

    /**
     * Register Page templates
     *
     * @param Event $event RocketTheme\Toolbox\Event\Event
     *
     * @return void
     */
    public function onGetPageTemplates(Event $event)
    {
        $types = $event->types;
        $locator = Grav::instance()['locator'];
        $locations = [
            'plugin://' . $this->name . '/blueprints/',
            'theme://blueprints/',
            'user://blueprints/'
        ];
        foreach ($locations as $location) {
            $types->register(
                'presentation',
                $locator->findResource($location . 'presentation.yaml')
            );
            $types->register(
                'slide',
                $locator->findResource($location . 'slide.yaml')
            );
        }
    }

    /**
     * Get API Instance
     *
     * @param string $class   Class name
     * @param mixed  ...$args Class arguments
     *
     * @return mixed Class Instance
     */
    public function getAPIInstance(string $class, ...$args)
    {
        $caller = '\Grav\Plugin\PresentationPlugin\API\\' . $class;
        return new $caller(...$args);
    }

    /**
     * Get list of modular scales
     *
     * @return array List of modular scales
     */
    public static function getModularScale()
    {
        return array(
            ['name' => 'unison', 'ratio' => '1:1', 'numerical' => 1],
            ['name' => 'minor second', 'ratio' => '15:16', 'numerical' => 1.067],
            ['name' => 'major second', 'ratio' => '8:9', 'numerical' => 1.125],
            ['name' => 'minor third', 'ratio' => '5:6', 'numerical' => 1.2],
            ['name' => 'major third', 'ratio' => '4:5', 'numerical' => 1.25],
            ['name' => 'perfect fourth', 'ratio' => '3:4', 'numerical' => 1.333],
            ['name' => 'aug. fourth / dim. fifth', 'ratio' => '1:√2', 'numerical' => 1.414],
            ['name' => 'perfect fifth', 'ratio' => '2:3', 'numerical' => 1.5],
            ['name' => 'minor sixth', 'ratio' => '5:8', 'numerical' => 1.6],
            ['name' => 'golden section', 'ratio' => '1:1.618', 'numerical' => 1.618],
            ['name' => 'major sixth', 'ratio' => '3:5', 'numerical' => 1.667],
            ['name' => 'minor seventh', 'ratio' => '9:16', 'numerical' => 1.778],
            ['name' => 'major seventh', 'ratio' => '8:15', 'numerical' => 1.875],
            ['name' => 'octave', 'ratio' => '1:2', 'numerical' => 2],
            ['name' => 'major tenth', 'ratio' => '2:5', 'numerical' => 2.5],
            ['name' => 'major eleventh', 'ratio' => '3:8', 'numerical' => 2.667],
            ['name' => 'major twelfth', 'ratio' => '1:3', 'numerical' => 3],
            ['name' => 'double octave', 'ratio' => '1:4', 'numerical' => 4]
        );
    }

    /**
     * Parse modular scales for blueprints
     *
     * @return array Blueprint-friendly list of modular scales
     */
    public static function getModularScaleBlueprintOptions()
    {
        $options = ['' => 'None'];
        foreach (self::getModularScale() as $scale) {
            $options[(string) $scale['numerical']] = $scale['numerical'] . ' (' . ucwords($scale['name']) . ', ' . $scale['ratio'] . ')';
        }
        return $options;
    }

    /**
     * Get class names for blueprints
     *
     * @param string $key Needle to search for
     *
     * @return array Blueprint-friendly list of class names
     */
    public static function getClassNamesBlueprintOptions(string $key)
    {
        $regex = '/Grav\\\\Plugin\\\\PresentationPlugin\\\\API\\\\(?<api>.*)/i';
        $classes = preg_grep($regex, get_declared_classes());
        $matches = preg_grep('/' . $key . '/i', $classes);
        $options = [
            '' => 'None',
            $key => $key
        ];
        foreach ($matches as $match) {
            $match = str_replace('Grav\Plugin\PresentationPlugin\API\\', '', $match);
            $options[$match] = $match;
        }
        return $options;
    }

    /**
     * Get reveal.js themes
     *
     * @return array Associative array of styles
     */
    public static function getRevealThemes()
    {
        include __DIR__ . '/vendor/autoload.php';
        $inflector = new Inflector();
        $options = array('none' => 'None');
        $path = 'user://plugins/presentation/node_modules/reveal.js/css/theme';
        $location = Grav::instance()['locator']->findResource($path, true);
        if (!$location) {
            return $options;
        }
        $files = Utilities::filesFinder($location, ['css']);
        if (empty($files)) {
            return $options;
        }
        foreach ($files as $file) {
            $key = $file->getBasename('.' . $file->getExtension());
            $options[$key] = $inflector->titleize($key);
        }
        return $options;
    }

    /**
     * Initialize shortcodes
     *
     * @return void
     */
    public function onShortcodeHandlers()
    {
        $this->grav['shortcode']->registerAllShortcodes(__DIR__ . '/shortcodes');
    }

    /**
     * Add admin assets
     *
     * @return void
     */
    public function onAdminPagesAssetsInitialized()
    {
        $uri = $this->grav['uri'];
        $res = Grav::instance()['locator'];
        $path = $res->findResource('plugin://' . $this->name, false);
        $adminRoute = $this->config->get('plugins.admin.route');
        if (!Utils::contains($uri->path(), $adminRoute . '/pages')) {
            return;
        }
        if ($this->config->get('plugins.presentation.admin_async_save') !== true) {
            return;
        }
        $adminRoute = $uri->rootUrl(true) . $adminRoute;
        $inlineJsConstants = array(
            'presentationAPIRoute = "' . $adminRoute . '/' . $this->config->get('plugins.presentation.api_route') . '"',
            'presentationAPITimeout = ' . ($this->config->get('plugins.presentation.poll_timeout') ?: 2000) * 2.5,
            'presentationAPIRetryLimit = ' . ($this->config->get('plugins.presentation.poll_retry_limit') ?: 10),
            'presentationAdminAsyncSave = ' . ($this->config->get('plugins.presentation.admin_async_save') ?: 0),
            'presentationAdminAsyncSaveTyping = ' . ($this->config->get('plugins.presentation.admin_async_save_typing') ?: 0)
        );
        $inlineJs = '';
        foreach ($inlineJsConstants as $constant) {
            $inlineJs .= 'const ' . $constant . ';' . "\n";
        }
        $this->grav['assets']->addInlineJs($inlineJs);
        $this->grav['assets']->addJs(
            $path . '/js/save.js'
        );
        $this->grav['assets']->addJs(
            $path . '/node_modules/axios/dist/axios.min.js'
        );
        $this->grav['assets']->addJs(
            $path . '/node_modules/js-base64/base64.min.js'
        );
        $this->grav['assets']->addJs(
            $path . '/node_modules/codemirror/lib/codemirror.js'
        );
    }

    /**
     * Add general assets
     *
     * @return void
     */
    public function onAssetsInitialized()
    {
        if ($this->config->get('plugins.presentation.textsizing')
            && $this->config->get('plugins.presentation.breakpoints')
            && !empty($this->config->get('plugins.presentation.breakpoints'))
        ) {
            $css = '';
            $element = '.reveal .slides section section, .reveal.center .slides section section';
            $breakpoints = array_keys(
                $this->config->get('plugins.presentation.breakpoints')
            );
            $sizes = array_values(
                $this->config->get('plugins.presentation.breakpoints')
            );
            for ($i = 0; $i < count($breakpoints); $i++) {
                $css .= '@media screen and ';
                if ($i == 0) {
                    $css .= '(min-width: 0px) and ';
                    $css .= '(max-width:' . (intval($breakpoints[$i + 1]) - 1) . 'px) ';
                } else {
                    $css .= '(min-width:' . $breakpoints[$i] . 'px) ';
                }
                $css .= '{' . $element . '{font-size:' . $sizes[$i] . 'px !important;}}';
                $css .= "\n";
            }
            $this->grav['assets']->addInlineCss($css, null, 'critical');
        }
        $iframe = '.presentation-iframe {
            width: 100%;
            width: -moz-available;
            width: -webkit-fill-available;
            width: fill-available;
            height: 100%;
            height: -moz-available;
            height: -webkit-fill-available;
            height: fill-available;
          }';
        $this->grav['assets']->addInlineCss($iframe);
    }
}
