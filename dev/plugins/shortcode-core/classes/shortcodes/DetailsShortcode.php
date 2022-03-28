<?php
namespace Grav\Plugin\Shortcodes;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;

class DetailsShortcode extends Shortcode
{
    public function init()
    {
        $this->shortcode->getHandlers()->add('details', function(ShortcodeInterface $sc) {
            // Get summary/title
            $summary = $sc->getParameter('summary', $this->getBbCode($sc));
            $summaryHTML = $summary ? '<summary>' . $summary . '</summary>' : '';

            // Get classes for details
            $class = $sc->getParameter('class', $this->getBbCode($sc));
            $classHTML = (isset($class) and $class !== $summary) ? 'class="' . $class . '"' : '';

            // Get content
            $content = $sc->getContent();

            // Return the details/summary block
            return '<details ' . $classHTML . '>' . $summaryHTML . $content . '</details>';
        });
    }
}
