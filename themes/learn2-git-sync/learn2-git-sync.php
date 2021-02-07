<?php
namespace Grav\Theme;

use Grav\Common\Grav;
use Grav\Common\Theme;
use RocketTheme\Toolbox\Event\Event;

class Learn2GitSync extends Learn2
{
    /**
     * Initialize plugin and subsequent events
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onTwigInitialized' => ['onTwigInitialized', 0],
            'onThemeInitialized' => ['onThemeInitialized', 0],
            'onShortcodeHandlers' => ['onShortcodeHandlers', 0],
            'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
            'onTNTSearchIndex' => ['onTNTSearchIndex', 0],
            'registerNextGenEditorPlugin' => ['registerNextGenEditorPluginShortcodes', 0]
        ];
    }

    public function onShortcodeHandlers()
    {
        $this->grav['shortcode']->registerAllShortcodes('user://themes/learn2-git-sync/shortcodes');
    }

    public function registerNextGenEditorPluginShortcodes($event) {
        $plugins = $event['plugins'];

        $plugins['js'][] = 'user://themes/learn2-git-sync/nextgen-editor/shortcodes/googleslides.js';
        $plugins['js'][] = 'user://themes/learn2-git-sync/nextgen-editor/shortcodes/h5p.js';
        $plugins['js'][] = 'user://themes/learn2-git-sync/nextgen-editor/shortcodes/pdf.js';

        $event['plugins']  = $plugins;
        return $event;
    }

    public function onTwigSiteVariables()
    {
        if ($this->isAdmin() && ($this->grav['config']->get('plugins.shortcode-core.enabled'))) {
            $this->grav['assets']->add('theme://editor-buttons/admin/js/shortcode-presentation.js');
        }
    }

    public function onTNTSearchIndex(Event $e)
    {
        $fields = $e['fields'];
        $page = $e['page'];
        $taxonomy = $page->taxonomy();

        if (isset($taxonomy['tag'])) {
            $fields->tag = implode(",", $taxonomy['tag']);
        }
    }

    public function onTwigInitialized() {
        $sc = $this->grav['shortcode'];
        $sc->getHandlers()->addAlias('version', 'lang');
    }

    /**
     * Register events and route with Grav
     *
     * @return void
     */
    public function onThemeInitialized()
    {
        /* Check if Admin-interface */
        if (!$this->isAdmin()) {
            $this->enable(
                [
                    'onPageInitialized' => ['onPageInitialized', 0]
                ]
            );
        }
    }

    /**
     * Get default category setting
     *
     * @return string
     */
    public static function getdefaulttaxonomycategory()
    {
        $config = Grav::instance()['config'];
        return $config->get('themes.' . $config->get('system.pages.theme'). '.default_taxonomy_category');
    }

    /**
     * Handle CSS
     *
     * @return void
     */
    public function onPageInitialized()
    {
        $assets = $this->grav['assets'];
        $config = $this->config();
        if (isset($config['style'])) {
            $style = $config['style'];
            if ($style == 'default') {
                $style = 'theme';
            }
            $current = self::fileFinder(
                $style,
                '.css',
                'theme://css/styles',
                'theme://css'
            );
            $assets->addCss($current, 101);
        }
    }

    /**
     * Search for a file in multiple locations
     *
     * @param string $file         Filename.
     * @param string $ext          File extension.
     * @param array  ...$locations List of paths.
     *
     * @return string
     */
    public static function fileFinder($file, $ext, ...$locations)
    {
        $return = false;
        foreach ($locations as $location) {
            if (file_exists($location . '/' . $file . $ext)) {
                $return = $location . '/' . $file . $ext;
                break;
            }
        }
        return $return;
    }
}
?>
