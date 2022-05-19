<?php
namespace Grav\Plugin;

use \Grav\Common\Plugin;
use \Grav\Common\Grav;
use \Grav\Common\Page\Page;

class AnchorsPlugin extends Plugin
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
     * Initialize configuration
     */
    public function onPluginsInitialized()
    {
        if ($this->isAdmin()) {
            $this->active = false;
        } else {
            $this->enable([
                'onPageInitialized' => ['onPageInitialized', 0],
                'onTwigSiteVariables' => ['onTwigSiteVariables', 0],
                'onTwigExtensions' => ['onTwigExtensions', 0]
            ]);
        }
    }

    public function onTwigExtensions()
    {
        $config = $this->config->get('plugins.anchors.selectors');
        require_once(__DIR__ . '/twig/AnchorsTwigExtension.php');
        $this->grav['twig']->twig->addExtension(new AnchorsTwigExtension($config));
    }

    /**
     * Initialize configuration
     */
    public function onPageInitialized()
    {
        $defaults = (array) $this->config->get('plugins.anchors');

        /** @var Page $page */
        $page = $this->grav['page'];
        if (isset($page->header()->anchors)) {
            $this->config->set('plugins.anchors', array_merge($defaults, $page->header()->anchors));
        }
    }

    /**
     * if enabled on this page, load the JS + CSS and set the selectors.
     */
    public function onTwigSiteVariables()
    {
        if ($this->config->get('plugins.anchors.active')) {
            $selectors = $this->config->get('plugins.anchors.selectors', 'h1,h2,h3,h4');
            $visible = "visible: '{$this->config->get('plugins.anchors.visible', 'hover')}',";
            $placement = "placement: '{$this->config->get('plugins.anchors.placement', 'right')}',";
            $icon = $this->config->get('plugins.anchors.icon') ? "icon: '{$this->config->get('plugins.anchors.icon')}'," : '';
            $class = $this->config->get('plugins.anchors.class') ? "class: '{$this->config->get('plugins.anchors.class')}'," : '';
            $truncate = "truncate: {$this->config->get('plugins.anchors.truncate', 64)}";
            $this->grav['assets']->addJs('plugin://anchors/js/anchor.min.js');

            $anchors_init =
                "document.addEventListener('DOMContentLoaded', function() {
                    anchors.options = {
                        $visible
                        $placement
                        $icon
                        $class
                        $truncate
                    };
                    anchors.add('$selectors');
                });";


            $this->grav['assets']->addInlineJs($anchors_init);

            if ($this->config->get('plugins.anchors.copy_to_clipboard')) {
                $clipboard_init =
                    'document.addEventListener("DOMContentLoaded", function() {
                        for (var r=0; r < document.getElementsByClassName("anchorjs-link").length; r++) {
                          var danchors = document.getElementsByClassName("anchorjs-link");
                          var danchorshref = danchors[r].href;
                          danchors[r].setAttribute("data-clipboard-text",danchorshref);
                        }
                        let anchorjsLinks = document.querySelectorAll(".anchorjs-link");                
                        anchorjsLinks.forEach(el => {
                          el.addEventListener("click", event => {
                            event.preventDefault();
                            // add custom "copy to clipboard" code
                            new ClipboardJS(".anchorjs-link");       
                          });
                        });
                    });';

                $this->grav['assets']->addJs('plugin://anchors/js/clipboard.min.js');
                $this->grav['assets']->addInlineJs($clipboard_init);
            }
        }
    }
}
