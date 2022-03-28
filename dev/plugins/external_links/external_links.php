<?php
/**
 * External Links v1.6.1
 *
 * This plugin adds small icons to external and mailto links, informing
 * users the link will take them to a new site or open their email client.
 *
 * Dual licensed under the MIT or GPL Version 3 licenses, see LICENSE.
 * http://benjamin-regler.de/license/
 *
 * @package     External Links
 * @version     1.6.1
 * @link        <https://github.com/sommerregen/grav-plugin-external-links>
 * @author      Benjamin Regler <sommerregen@benjamin-regler.de>
 * @copyright   2017+, Benjamin Regler
 * @license     <http://opensource.org/licenses/MIT>        MIT
 * @license     <http://opensource.org/licenses/GPL-3.0>    GPLv3
 */

namespace Grav\Plugin;

use Grav\Common\Plugin;
use Grav\Common\Page\Interfaces\PageInterface;
use Grav\Common\Data\Blueprints;

use RocketTheme\Toolbox\Event\Event;

/**
 * External Links Plugin
 *
 * This plugin adds small icons to external and mailto links, informing
 * users the link will take them to a new site or open their email client.
 */
class ExternalLinksPlugin extends Plugin
{
    /**
     * @var ExternaLinksPlugin
     */

    /**
     * Instance of ExternalLinks class
     *
     * @var \Grav\Plugin\ExternalLinks
     */
    protected $external_links;

    /** -------------
     * Public methods
     * --------------
     */

    /**
     * Return a list of subscribed events.
     *
     * @return array    The list of events of the plugin of the form
     *                      'name' => ['method_name', priority].
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize configuration
     */
    public function onPluginsInitialized()
    {
        // Process contents order according to weight option
        $weight = $this->config->get('plugins.external_links.weight', 0);

        // Set default events
        $events = [
            'onTwigInitialized' => ['onTwigInitialized', 0],
            'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
            'onPageContentProcessed' => ['onPageContentProcessed', $weight]
        ];

        // Set admin specific events
        if ($this->isAdmin()) {
            $this->active = false;
            $events = [
                'onBlueprintCreated' => ['onBlueprintCreated', 0]
            ];
        }

        // Register events
        $this->enable($events);
    }

    /**
     * Extend page blueprints with ExternalLinks configuration options.
     *
     * @param Event $event
     */
    public function onBlueprintCreated(Event $event)
    {
        /** @var Blueprints $blueprint */
        $blueprint = $event['blueprint'];
        if ($blueprint->get('form/fields/tabs', null, '/')) {
            $blueprints = new Blueprints(__DIR__ . '/blueprints/');
            $extends = $blueprints->get($this->name);
            $blueprint->extend($extends, true);
        }
    }

    /**
     * Apply external links filter to content, when each page has not been
     * cached yet.
     *
     * @param  Event  $event The event when 'onPageContentProcessed' was
     *                       fired.
     */
    public function onPageContentProcessed(Event $event)
    {
        /** @var Page $page */
        $page = $event['page'];

        $config = $this->mergeConfig($page);
        $enabled = ($config->get('process') && $config->get('enabled')) ? true : false;

        if ($enabled && $this->compileOnce($page)) {
            // Do nothing, if a route for a given page does not exist and check if
            // mode option is valid
            $mode = strtolower($config->get('mode', 'passive'));
            if (!$page->route() || !in_array($mode, array('active', 'passive'))) {
                return;
            }

            // Get content and list of exclude tags
            $content = $page->getRawContent();

            // Apply external links filter and save modified page content
            $page->setRawContent(
                $this->externalLinksFilter($content, $config->toArray(), $page)
            );
        }
    }

    /**
     * Initialize Twig configuration and filters.
     */
    public function onTwigInitialized()
    {
        // Expose function
        $this->grav['twig']->twig()->addFilter(
            new \Twig_SimpleFilter('external_links', [$this, 'externalLinksFilter'], ['is_safe' => ['html']])
        );
    }

    /**
     * Set needed variables to display external links.
     */
    public function onTwigSiteVariables()
    {
        if ($this->config->get('plugins.external_links.built_in_css')) {
            $this->grav['assets']->add('plugin://external_links/assets/css/external_links.css');
        }
    }

    /**
     * Filter to parse external links.
     *
     * @param  string $content The content to be filtered.
     * @param  array  $options Array of options for the External links filter.
     *
     * @return string          The filtered content.
     */
    public function externalLinksFilter($content, $params = [])
    {
        // Get custom user configuration
        $page = func_num_args() > 2 ? func_get_arg(2) : $this->grav['page'];
        $config = $this->mergeConfig($page, true, $params);

        // Render
        return $this->init()->render($content, $config, $page);
    }

    /** -------------------------------
     * Private/protected helper methods
     * --------------------------------
     */

    /**
     * Checks if a page has already been compiled yet.
     *
     * @param  Page    $page The page to check
     * @return boolean       Returns true if page has already been
     *                       compiled yet, false otherwise
     */
    protected function compileOnce(PageInterface $page)
    {
        static $processed = [];

        $id = md5($page->path());
        // Make sure that contents is only processed once
        if (!isset($processed[$id]) || ($processed[$id] < $page->modified())) {
            $processed[$id] = $page->modified();
            return true;
        }

        return false;
    }

    /**
     * Initialize plugin and all dependencies.
     *
     * @return \Grav\Plugin\ExternalLinks   Returns ExternalLinks instance.
     */
    protected function init()
    {
        if (!$this->external_links) {
            // Initialize ExternalLinks instance
            require_once(__DIR__ . '/classes/ExternalLinks.php');
            $this->external_links = new ExternalLinks();
        }

        return $this->external_links;
    }
}
