<?php
namespace Grav\Plugin\Shortcodes;

use Grav\Common\Utils;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class FontAwesomeShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('fa', function(ShortcodeInterface $sc) {
            // Load assets if required
            if ($this->config->get('plugins.shortcode-core.fontawesome.load', false)) {
                $this->shortcode->addAssets('css', $this->config->get('plugins.shortcode-core.fontawesome.url'));
            }
            if ($this->config->get('plugins.shortcode-core.fontawesome.v5', false)) {
                $v5classes = ['fab', 'fal', 'fas', 'far', 'fad'];
            } else {
                $v5classes = [];
            }

            // Get shortcode content and parameters
            $str = $sc->getContent();
            $icon = $sc->getParameter('icon', $sc->getParameter('fa', $this->getBbCode($sc)));

            if (!Utils::startsWith($icon, 'fa-')) {
                $icon = 'fa-'.$icon;
            }

            if ($icon) {
                $fa_class = 'fa';
                $extras = explode(',', $sc->getParameter('extras', ''));

                foreach($extras as $extra) {
                    if(!empty($extra)) {
                        if(in_array($extra, $v5classes, true)) {
                            $fa_class = $extra;
                            continue;
                        }
                        if(!Utils::startsWith($extra, 'fa-')) {
                            $extra = 'fa-' . $extra;
                        }
                        $icon .= ' ' . $extra;
                    }
                }

                return '<i class="' . $fa_class . ' ' . $icon . '">' . $str . '</i>';
            }

            return '';
        });
    }
}
