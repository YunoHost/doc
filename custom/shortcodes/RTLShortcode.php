<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class RTLShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('rtl', function(ShortcodeInterface $sc) {
            return '<div dir="rtl">'.$sc->getContent().'</div>';
        });
    }
}