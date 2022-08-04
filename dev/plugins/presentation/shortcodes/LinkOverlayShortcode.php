<?php
/**
 * Presentation Plugin
 *
 * PHP version 7
 *
 * @category   Extensions
 * @package    Grav
 * @subpackage Presentation
 * @author     Ole Vik <git@olevik.net>
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @link       https://github.com/OleVik/grav-plugin-presentation
 */
namespace Grav\Plugin\Shortcodes;

use Grav\Common\Uri;
use Grav\Common\Utils;
use Grav\Common\Inflector;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

/**
 * Create link overlay for slide
 *
 * Class PresentationPlugin
 *
 * @category Extensions
 * @package  Grav\Plugin
 * @author   Ole Vik <git@olevik.net>
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @link     https://github.com/OleVik/grav-plugin-presentation
 */
class LinkOverlayShortcode extends Shortcode
{
    /**
     * Initialize shortcode
     *
     * @return string
     */
    public function init()
    {
        $this->shortcode->getHandlers()->add(
            'link-overlay',
            function (ShortcodeInterface $sc) {
                return $this->linkOverlayRenderer($sc);
            }
        );
    }

    /**
     * Render a link overlay in HTML
     *
     * @param ShortcodeInterface $sc Accessor to Thunder\Shortcode
     *
     * @return string
     */
    public function linkOverlayRenderer(ShortcodeInterface $sc)
    {
        $url = $sc->getParameter('url', $this->getBbCode($sc));
        $classes = 'link-overlay';
        if ($sc->getParameter('class') !== null) {
            $classes = $classes . ' ' . $sc->getParameter('class');
        }
        $output = $this->twig->processTemplate(
            'partials/presentation_link_overlay.html.twig',
            [
                'url' => $url,
                'class' => $classes
            ]
        );
        return $output;
    }
}
