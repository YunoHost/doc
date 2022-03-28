<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class HShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('h1', function(ShortcodeInterface $sc) {
            return $this->header(1, $sc);
        });

        $this->shortcode->getHandlers()->add('h2', function(ShortcodeInterface $sc) {
            return $this->header(2, $sc);
        });

        $this->shortcode->getHandlers()->add('h3', function(ShortcodeInterface $sc) {
            return $this->header(3, $sc);
        });

        $this->shortcode->getHandlers()->add('h4', function(ShortcodeInterface $sc) {
            return $this->header(4, $sc);
        });

        $this->shortcode->getHandlers()->add('h5', function(ShortcodeInterface $sc) {
            return $this->header(5, $sc);
        });

        $this->shortcode->getHandlers()->add('h6', function(ShortcodeInterface $sc) {
            return $this->header(6, $sc);
        });


    }

    protected function header($level, ShortcodeInterface $sc)
    {
        $id = $sc->getParameter('id');
        $class = $sc->getParameter('class');
        $tag = 'h' . $level;

        $id_output = $id ? ' id="' . $id . '" ': '';
        $class_output = $class ? ' class="' . $class . '"' : '';

        return "<{$tag}{$id_output}{$class_output}>{$sc->getContent()}</{$tag}>";
    }
}