<?php
namespace Grav\Plugin;

use DiDom\Document;
use DiDom\Element;
use Grav\Common\Plugin;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class ImageCaptionsPlugin
 * @package Grav\Plugin
 */
class ImageCaptionsPlugin extends Plugin
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'onPluginsInitialized' => ['onPluginsInitialized', 0]
        ];
    }

    /**
     * Initialize the plugin
     */
    public function onPluginsInitialized()
    {
        // Don't proceed if we are in the admin plugin
        if ($this->isAdmin()) {
            return;
        }

        include __DIR__.'/vendor/autoload.php';

        if ($this->grav['config']->get('plugins.image-captions.entire_page')) {
            $this->enable([
                'onOutputGenerated' => ['onOutputGenerated', 0],
                'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
            ]);
        } else {
            $this->enable([
                'onPageContentProcessed' => ['onPageContentProcessed', 0],
                'onTwigSiteVariables' => ['onTwigSiteVariables', 0]
            ]);
        }


    }

    /**
     * Process on entire Grav output
     */
    public function onOutputGenerated()
    {
        $page = $this->grav['page'];
        $this->updateConfig($page);

        if ($this->config->get('plugins.image-captions.enabled') === false) {
            return;
        }

        $this->grav->output = $this->processFigures($this->grav->output);
    }

    /**
     * Process on page content
     *
     * @param Event $event
     */
    public function onPageContentProcessed(Event $event)
    {
        $page = $event['page'];
        $this->updateConfig($page);

        if ($this->config->get('plugins.image-captions.enabled') === false) {
            return;
        }

        $content = $page->getRawContent();
        $content = $this->processFigures($content);
        $page->setRawContent($content);
    }

    /**
     * Load the CSS if configured
     */
    public function onTwigSiteVariables()
    {

        if ($this->config->get('plugins.image-captions.built_in_css')) {
            $this->grav['assets']->add('plugin://image-captions/css/image-captions.css');
        }
    }

    /**
     * Process content and replace any items in scope with the figure/figcaption structure
     *
     * @param $content
     * @return string
     */
    protected function processFigures($content)
    {
        // Check for empty content
        if (strlen($content) === 0) {
            return '';
        }

        $document = new Document($content);

        $scope = trim($this->grav['config']->get('plugins.image-captions.scope'));
        $figure_class = $this->grav['config']->get('plugins.image-captions.figure_class');
        $figcaption_class = $this->grav['config']->get('plugins.image-captions.figcaption_class');
        $source = $this->grav['config']->get('plugins.image-captions.source');

        if (count($images = $document->find($scope)) > 0) {
            foreach ($images as $image) {
                if ($source == 'alt') {
                    $caption = $image->getAttribute('alt');
                } else {
                    $caption = $image->getAttribute('title');
                }

                if ($caption) {
                    $figure_classes = [$figure_class];

                    // If there are any `caption-*` classes on the image, add them to the figure
                    $image_classes = explode(' ', $image->getAttribute('class'));
                    foreach ($image_classes as $class) {
                        if (preg_match('/^(caption-|figure-).*/', $class)) {
                            $figure_classes[] = $class;
                        }
                    }

                    $figcaption = new Element('figcaption',$caption, ['class' => $figcaption_class]);
                    $items = [$image, $figcaption];
                    $figure = new Element('figure', '', ['class' => implode(' ', $figure_classes)]);
                    $figure->appendChild($items);
                    $image->replace($figure);
                }
            }
            return $this->cleanupTags($document->html());
        }

        return $content;
    }

    private function updateConfig($page)
    {
        $config = $this->mergeConfig($page)->toArray();
        $this->config->set('plugins.image-captions', $config);
    }

    /**
     * Removes html and body tags at the begining and end of the html source
     *
     * @param $html
     * @return string
     */
    private function cleanupTags($html)
    {
        // remove html/body tags
        $html = preg_replace('#<html><body>#', '', $html);
        $html = preg_replace('#</body></html>#', '', $html);

        // remove whitespace
        $html = trim($html);

        // remove p tags
        preg_match_all('#<p>(?:\s*)((<a*.>)?.*)(?:\s*)(<figure((?:.|\n)*?)*(?:\s*)<\/figure>)(?:\s*)(<\/a>)?(?:\s*)<\/p>#m', $html, $matches);

        if (is_array($matches) && !empty($matches)) {
            $num_matches = count($matches[0]);
            for ($i = 0; $i < $num_matches; $i++) {
                $original = $matches[0][$i];
                $new = $matches[1][$i] . $matches[3][$i] . $matches[5][$i];

                $html = str_replace($original, $new, $html);
            }
        }

        return $html;
    }
}
