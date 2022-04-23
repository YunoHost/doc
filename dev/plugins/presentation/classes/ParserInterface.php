<?php
/**
 * Presentation Plugin, Parser API Interface
 *
 * PHP version 7
 *
 * @category   API
 * @package    Grav\Plugin\PresentationPlugin
 * @subpackage Grav\Plugin\PresentationPlugin\API
 * @author     Ole Vik <git@olevik.net>
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @link       https://github.com/OleVik/grav-plugin-presentation
 */

namespace Grav\Plugin\PresentationPlugin\API;

/**
 * Parser API Interface
 *
 * Parser API Interface for parsing content
 *
 * @category Extensions
 * @package  Grav\Plugin\PresentationPlugin\API
 * @author   Ole Vik <git@olevik.net>
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @link     https://github.com/OleVik/grav-plugin-presentation
 */
interface ParserInterface
{
    /**
     * Parse shortcodes
     *
     * @param string $content Markdown content in Page
     * @param string $id      Slide ID
     * @param array  $page    Page instance
     *
     * @return array Processed content and shortcodes
     */
    public function processShortcodes(string $content, string $id, array $page);
    
    /**
     * Process key-value pairs of options
     *
     * @param array $data  Key-value pairs of options
     * @param string $id   Target id-attribute
     * @param array $paths Paths to use for file-finding
     *
     * @return void
     */
    public function processor(array $data, string $id, array $paths = []);

    /**
     * Process style
     *
     * @param string $id       Target id-attribute
     * @param string $property CSS property name
     * @param string $value    CSS property value
     * @param array  $paths    Locations to search for asset in
     *
     * @return void
     */
    public function styleProcessor(string $id, string $property, string $value, array $paths = []);

    /**
     * Remove wrapping paragraph from img-element
     *
     * @param string $content Markdown content in Page
     *
     * @return string Processed content
     */
    public static function unwrapImage(string $content);

    /**
     * Create HTML for fragments
     *
     * @param string $content Markdown content in Page
     *
     * @deprecated 2.0.0
     *
     * @return string Processed contents
     */
    public function processFragments(string $content);

    /**
     * Parse shortcodes
     *
     * @param string $content Markdown content in Page
     * @param string $id      Slide id-attribute
     *
     * @deprecated 2.0.0
     *
     * @return array Processed contents and properties
     */
    public function interpretShortcodes(string $content, string $id);

    /**
     * Process styles and data-attributes
     *
     * @param array  $styles List of key-value pairs
     * @param string $route  Route to Page for relative assets
     * @param string $id     Slide id-attribute
     *
     * @deprecated 2.0.0
     *
     * @return string Processed styles, in inline string
     */
    public function processStylesData(array $styles, string $route, string $id);
}
