<?php
/**
 * Presentation Plugin, Transport API
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
 * Transport API
 *
 * @category Extensions
 * @package  Grav\Plugin\PresentationPlugin\API
 * @author   Ole Vik <git@olevik.net>
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @link     https://github.com/OleVik/grav-plugin-presentation
 */
class Transport implements TransportInterface
{
    /**
     * Placeholder for slide styles
     *
     * @var array
     */
    public $styles;

    /**
     * Placeholder for slide classes
     *
     * @var array
     */
    public $classes;

    /**
     * Placeholder for data attributes
     *
     * @var array
     */
    public $dataAttributes;

    /**
     * Placeholder for aria attributes
     *
     * @var array
     */
    public $ariaAttributes;

    /**
     * Instantiate Transport API
     */
    public function __construct()
    {
        $this->styles = array();
        $this->classes = array();
        $this->dataAttributes = array();
        $this->ariaAttributes = array();
    }

    /**
     * Set style
     *
     * @param string $id       Slide id-attribute
     * @param string $style    CSS Style
     * @param string $elements Elements to iterate through
     *
     * @return bool State of execution
     */
    public function setStyle(string $id, string $style, string $elements = null)
    {
        if ($elements) {
            $elements = explode(',', $elements);
            if (count($elements) > 1) {
                foreach ($elements as $element) {
                    $this->styles[$id][] = $element . ' ' . $style;
                }
                return true;
            } else {
                $this->styles[$id][] = $elements[0] . ' ' .  $style;
                return true;
            }
        } else {
            $this->styles[$id][] = $style;
            return true;
        }
    }

    /**
     * Get style
     *
     * @param string $id Slide id-attribute
     *
     * @return string Styles for slide
     */
    public function getStyle(string $id)
    {
        if (empty($this->styles[$id])) {
            return false;
        }
        $return = '';
        foreach ($this->styles[$id] as $style) {
            $return .= '#' . $id . ' ' . $style . "\n";
        }
        return $return;
    }

    /**
     * Get styles
     *
     * @return string Aggregated styles
     */
    public function getStyles()
    {
        if (empty($this->styles)) {
            return false;
        }
        $return = '';
        foreach ($this->styles as $style => $values) {
            $return .= $this->getStyle($style) . "\n";
        }
        return $return;
    }

    /**
     * Add class
     *
     * @param string $id    Slide id-attribute
     * @param string $class Class name
     *
     * @return bool State of execution
     */
    public function setClass(string $id, string $class)
    {
        if (!array_key_exists($id, $this->classes)) {
            $this->classes[$id] = array();
        }
        if (!in_array($class, $this->classes[$id])) {
            $this->classes[$id][] = $class;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get classes
     *
     * @param string $id Slide id-attribute
     *
     * @return string Classes for slide
     */
    public function getClasses(string $id)
    {
        if (empty($this->classes[$id])) {
            return false;
        }
        $return = '';
        foreach ($this->classes[$id] as $class) {
            $return .= ' ' .  $class;
        }
        return $return;
    }

    /**
     * Add data attribute
     *
     * @param string $id        Slide id-attribute
     * @param string $attribute Property name
     * @param string $value     Value
     *
     * @return bool State of execution
     */
    public function setDataAttribute(string $id, string $attribute, string $value)
    {
        if (!array_key_exists($id, $this->dataAttributes)) {
            $this->dataAttributes[$id] = array();
        }
        if (!array_key_exists($value, $this->dataAttributes[$id])) {
            $this->dataAttributes[$id][$attribute] = $value;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get data attribute
     *
     * @param string $id        Slide id-attribute
     * @param string $attribute Property name
     *
     * @return string Data attribute for slide
     */
    public function getDataAttribute(string $id, string $attribute)
    {
        if (empty($this->dataAttributes[$id][$attribute])) {
            return false;
        }
        return $this->dataAttributes[$id][$attribute];
    }

    /**
     * Get data attributes
     *
     * @param string $id Slide id-attribute
     *
     * @return string Data attributes for slide
     */
    public function getDataAttributes(string $id)
    {
        if (empty($this->dataAttributes[$id])) {
            return false;
        }
        $return = '';
        foreach ($this->dataAttributes[$id] as $name => $value) {
            $return .= ' data-' . $name . '="' . $value . '"';
        }
        return $return;
    }

    /**
     * Add aria attribute
     *
     * @param string $id        Slide id-attribute
     * @param string $attribute Property name
     * @param string $value     Value
     *
     * @return bool State of execution
     */
    public function setAriaAttribute(string $id, string $attribute, string $value)
    {
        if (!array_key_exists($id, $this->ariaAttributes)) {
            $this->ariaAttributes[$id] = array();
        }
        if (!array_key_exists($value, $this->ariaAttributes[$id])) {
            $this->ariaAttributes[$id][$attribute] = $value;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get aria attribute
     *
     * @param string $id        Slide id-attribute
     * @param string $attribute Property name
     *
     * @return string Aria attribute for slide
     */
    public function getAriaAttribute(string $id, string $attribute)
    {
        if (empty($this->ariaAttributes[$id][$attribute])) {
            return false;
        }
        return $this->ariaAttributes[$id][$attribute];
    }

    /**
     * Get aria attributes
     *
     * @param string $id Slide id-attribute
     *
     * @return string Aria attributes for slide
     */
    public function getAriaAttributes(string $id)
    {
        if (empty($this->ariaAttributes[$id])) {
            return false;
        }
        $return = '';
        foreach ($this->ariaAttributes[$id] as $name => $value) {
            if ($name == 'role') {
                $return .= ' role="' . $value . '"';
            } else {
                $return .= ' aria-' . $name . '="' . $value . '"';
            }
        }
        return $return;
    }
}
