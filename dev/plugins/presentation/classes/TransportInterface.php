<?php
/**
 * Presentation Plugin, Transport API Interface
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
 * Transport API Interface
 *
 * @category Extensions
 * @package  Grav\Plugin\PresentationPlugin\API
 * @author   Ole Vik <git@olevik.net>
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @link     https://github.com/OleVik/grav-plugin-presentation
 */
interface TransportInterface
{
    /**
     * Set style
     *
     * @param string $id       Slide id-attribute
     * @param string $style    CSS Style
     * @param string $elements Elements to iterate through
     *
     * @return bool State of execution
     */
    public function setStyle(string $id, string $style, string $elements = null);

    /**
     * Get styles
     *
     * @param string $id Slide id-attribute
     *
     * @return string Styles for slide
     */
    public function getStyle(string $id);

    /**
     * Get styles
     *
     * @return string Aggregated styles
     */
    public function getStyles();

    /**
     * Add class
     *
     * @param string $id    Slide id-attribute
     * @param string $class Class name
     *
     * @return bool State of execution
     */
    public function setClass(string $id, string $class);

    /**
     * Get classes
     *
     * @param string $id Slide id-attribute
     *
     * @return string Classes for slide
     */
    public function getClasses(string $id);

    /**
     * Add data attribute
     *
     * @param string $id        Slide id-attribute
     * @param string $attribute Property name
     * @param string $value     Value
     *
     * @return bool State of execution
     */
    public function setDataAttribute(string $id, string $attribute, string $value);

    /**
     * Get data attribute
     *
     * @param string $id        Slide id-attribute
     * @param string $attribute Property name
     *
     * @return string Data attribute for slide
     */
    public function getDataAttribute(string $id, string $attribute);

    /**
     * Get data attributes
     *
     * @param string $id Slide id-attribute
     *
     * @return string Data attributes for slide
     */
    public function getDataAttributes(string $id);
}
