<?php
/**
 * Presentation Plugin, Content API Interface
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
 * Content API Interface
 *
 * Content API Interface for aggregating content
 *
 * @category Extensions
 * @package  Grav\Plugin\PresentationPlugin\API
 * @author   Ole Vik <git@olevik.net>
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @link     https://github.com/OleVik/grav-plugin-presentation
 */
interface ContentInterface
{
    /**
     * Creates page-structure recursively
     *
     * @param string  $route Route to page
     * @param string  $mode  Reserved collection-mode for handling child-pages
     * @param integer $depth Reserved placeholder for recursion depth
     *
     * @return array Page-structure with children
     */
    public function buildTree(string $route, $mode = false, $depth = 0);

    /**
     * Create HTML to use with Reveal.js
     *
     * @param array $pages Page-structure with children
     *
     * @return string HTML-structure
     */
    public function buildContent(array $pages);

    /**
     * Create HTML from content
     *
     * @param array $page   Grav Page-instance
     * @param array $config Plugin- and slide-configuration
     * @param array $breaks Slides from Markdown
     *
     * @return void
     */
    public function breakContent(array $page, array $config, array $breaks);

    /**
     * Create HTML for slides
     *
     * @param array  $page   Grav Page-instance
     * @param array  $config Plugin- and slide-configuration
     * @param string $break  Slides from Markdown
     *
     * @return void
     */
    public function buildSlide(array $page, array $config, string $break);

    /**
     * Create HTML for fragments
     *
     * @param string $content Markdown content in Page
     *
     * @return string Processed contents
     */
    public function processFragments(string $content);

    /**
     * Create HTML from Notes-shortcodes
     *
     * @param string $content Markdown content in Page
     *
     * @return string Processed content
     */
    public function pushNotes(string $content);

    /**
     * Generate menu with anchors and titles from pages
     *
     * @param array $tree Page-structure with children
     *
     * @return array Slide-anchors with titles
     */
    public function buildMenu(array $tree);
}
