<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class DivShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('div', static function(ShortcodeInterface $sc) {
            $id = $sc->getParameter('id');
            $class = $sc->getParameter('class');
            $style = $sc->getParameter('style');

            $id_output = $id ? ' id="' . $id . '" ': '';
            $class_output = $class ? ' class="' . $class . '"' : '';
            $style_output = $style ? ' style="' . $style . '"' : '';

            return '<div ' . $id_output . $class_output . $style_output . '>' . $sc->getContent() . '</div>';
        });
    }
}