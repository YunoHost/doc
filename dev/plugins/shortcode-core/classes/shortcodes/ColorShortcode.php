<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class ColorShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('color', function(ShortcodeInterface $sc) {
            $color = $sc->getParameter('color', $this->getBbCode($sc));

            return '<span style="color: ' . $color . ';">' . $sc->getContent() . '</span>';
        });
    }
}