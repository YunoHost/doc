<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class AlignShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('center', static function(ShortcodeInterface $sc) {
            return '<div style="text-align: center;">' . $sc->getContent() . '</div>';
        });

        $this->shortcode->getHandlers()->add('left', static function(ShortcodeInterface $sc) {
            return '<div style="text-align: left;">' . $sc->getContent() . '</div>';
        });

        $this->shortcode->getHandlers()->add('right', static function(ShortcodeInterface $sc) {
            return '<div style="text-align: right;">' . $sc->getContent() . '</div>';
        });
        
        $this->shortcode->getHandlers()->add('justify', static function(ShortcodeInterface $sc) {
            return '<div style="text-align: justify;">' . $sc->getContent() . '</div>';
        });
    }
}
