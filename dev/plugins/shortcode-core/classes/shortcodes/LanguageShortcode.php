<?php
namespace Grav\Plugin\Shortcodes;

use Grav\Common\Language\Language;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class LanguageShortcode extends Shortcode
{

    public function init()
    {
        $this->shortcode->getHandlers()->add('lang', function(ShortcodeInterface $sc) {
            $lang = $this->getBbCode($sc);

            if ($lang) {
                $list = explode(',', $lang);
                array_walk($list, 'trim');

                /** @var Language $language */
                $language = $this->grav['language'];
                $current = $language->getLanguage();

                if (in_array($current, $list)) {
                    return $sc->getContent();
                }
            }

            return '';
        });
    }
}