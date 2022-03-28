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

use Grav\Common\Grav;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;

/**
 * Embed slides
 *
 * Class PresentationPlugin
 *
 * @category Extensions
 * @package  Grav\Plugin
 * @author   Ole Vik <git@olevik.net>
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @link     https://github.com/OleVik/grav-plugin-presentation
 */
class PresentationShortcode extends Shortcode
{
    /**
     * Initialize shortcode
     *
     * @return string
     */
    public function init()
    {
        $this->shortcode->getHandlers()->add(
            'presentation',
            function (ShortcodeInterface $sc) {
                $pages = Grav::instance()['pages'];
                $uri = $this->grav['uri']->rootUrl(true);
                $src = trim($sc->getParameter('src', $this->getBbCode($sc)), '/"');
                $id = 'presentation-' . str_replace(['/', '\\'], '-', $src);
                $classes = $this->config->get('plugins.presentation.shortcode_classes');
                if ($sc->getParameter('class') !== null) {
                    $classes = $classes . ' ' . $sc->getParameter('class');
                }
                $page = $pages->find('/' . $src);
                $output = $this->twig->processTemplate(
                    'partials/presentation_iframe.html.twig',
                    [
                        'id' => $id,
                        'src' => $src,
                        'base_url' => $uri,
                        'class' => $classes,
                        'page' => $page ?? null
                    ]
                );
                return $output;
            }
        );
    }
}
