<?php

namespace Grav\Plugin\ShortcodeCore;

use Grav\Common\Grav;

class ShortcodeTwigVar
{
    public function __call($name, $args)
    {
        /** @var ShortcodeManager $shortcode */
        $shortcode = Grav::instance()['shortcode'];
        $objects = $shortcode->getObjects();

        if ($objects) {
            return $objects[$name] ?? [];
        }

        $page_meta = Grav::instance()['page']->getContentMeta('shortcodeMeta');
        if (isset($page_meta['shortcode'])) {
            $objects = (array) $page_meta['shortcode'];
            return $objects[$name] ?? [];
        }

        return [];
    }
}