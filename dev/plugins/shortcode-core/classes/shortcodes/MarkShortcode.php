<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class MarkShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('mark', function(ShortcodeInterface $sc) {
            $style = $sc->getParameter('style', $this->getBbCode($sc));
            $class = $sc->getParameter('class', 'default');

            $css_class = 'class="mark-class-' . $class . '"';

            if ($style === 'block') {
                $css_style = 'style="display:block;"';
                $content = trim($sc->getContent(), "\n");
            } else {
                $css_style = '';
                $content = $sc->getContent();
            }

            return "<mark {$css_class} {$css_style}>{$content}</mark>";
        });
    }
}
