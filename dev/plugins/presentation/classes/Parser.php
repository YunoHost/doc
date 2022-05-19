<?php
/**
 * Presentation Plugin, Parser API
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

use Grav\Common\Uri;
use Grav\Common\Utils;
use Grav\Plugin\PresentationPlugin\Utilities;
use Thunder\Shortcode\Parser\RegularParser;
use Thunder\Shortcode\Parser\RegexParser;
use Thunder\Shortcode\Parser\WordpressParser;
use Thunder\Shortcode\Processor\Processor;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use Thunder\Shortcode\HandlerContainer\HandlerContainer;

/**
 * Parser API
 *
 * Parser API for parsing content
 *
 * @category Extensions
 * @package  Grav\Plugin\PresentationPlugin\API
 * @author   Ole Vik <git@olevik.net>
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @link     https://github.com/OleVik/grav-plugin-presentation
 */
class Parser implements ParserInterface
{
    /**
     * Regular expressions
     */
    const REGEX_MEDIA_P = '/<p>\s*(<a .*>\s*<img.*\s*<\/a>|\s*<img.*|<img.*\s*|<video.*|<audio.*)\s*<\/p>/i';

    /**
     * Instantiate Parser API
     *
     * @param array     $config    Plugin configuration
     * @param Transport $transport Transport API
     */
    public function __construct($config, $transport)
    {
        $this->config = $config;
        $this->transport = $transport;
        // @deprecated 2.0.0
        $this->props = [];
    }

    /**
     * Parse shortcodes
     *
     * @param string $content Markdown content in Page
     * @param string $id      Slide ID
     * @param array  $page    Page configuration
     *
     * @return array Processed content and shortcodes
     */
    public function processShortcodes(string $content, string $id, array $page)
    {
        $handlers = new HandlerContainer();
        $path = $page['path'];
        $handlers->setDefault(
            function (ShortcodeInterface $sc) use ($id, $path) {
                $name = $sc->getName();
                $value = $sc->getParameter($name, $sc->getBbCode()) ?? '';
                if (Utils::startsWith($name, 'class')) {
                    $this->transport->setClass($id, $value);
                } elseif (Utils::startsWith($name, 'style')) {
                    $property = str_replace('style-', '', $name);
                    $this->styleProcessor($id, $property, $value, [$path]);
                } elseif (Utils::startsWith($name, 'styles')) {
                    $property = str_replace('styles-', '', $name);
                    $this->styleProcessor($id, $property, $value, [$path]);
                } elseif (Utils::startsWith($name, 'data')) {
                    $property = str_replace('data-', '', $name);
                    $this->transport->setDataAttribute($id, $property, $value);
                } elseif (Utils::startsWith($name, 'hide')) {
                    $this->transport->setDataAttribute($id, 'hide', "true");
                }
                return;
            }
        );
        $parser = "Thunder\Shortcode\Parser\\" . $this->config['shortcode_parser'];
        $parser = new $parser();
        $processor = new Processor($parser, $handlers);
        return [
            'content' => $processor->process($content),
            'shortcodes' => $parser->parse($content)
        ];
    }

    /**
     * Process key-value pairs of options
     *
     * @param array  $data  Key-value pairs of options
     * @param string $id    Target id-attribute
     * @param array  $paths Paths to use for file-finding
     * @param string $mode  Which Transport to perform
     *
     * @return boolean
     */
    public function processor(array $data, string $id, array $paths = [], string $mode = 'style')
    {
        if (empty($data)) {
            return false;
        }
        foreach ($data as $key => $value) {
            if (Utils::startsWith('style-', $key)) {
                $mode = 'style';
            } elseif (Utils::startsWith('styles-', $key)) {
                $mode = 'style';
            } elseif (Utils::startsWith('data-', $key)) {
                $mode = 'data';
            } elseif (Utils::startsWith('aria-', $key)) {
                $mode = 'aria';
            }
            $key = str_replace($mode . '-', '', $key);
            if ($mode == 'style') {
                if (empty($value)) {
                    continue;
                }
                $this->styleProcessor($id, $key, $value, $paths);
            } elseif ($mode == 'data') {
                $this->transport->setDataAttribute($id, $key, $value);
            } elseif ($mode == 'aria') {
                $this->transport->setAriaAttribute($id, $key, $value);
            }
        }
        return true;
    }

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
    public function styleProcessor(string $id, string $property, string $value, array $paths = [])
    {
        if ($property == 'background-image') {
            if (!Uri::isValidUrl($value)) {
                $locations = array_merge(
                    $paths,
                    [
                        '',
                        'user/pages',
                        'user/pages/images',
                    ]
                );
                $locations = Utilities::explodeFileLocations($locations, GRAV_ROOT, '/', '/');
                $file = Utilities::fileFinder($value, $locations);
                $file = str_ireplace(GRAV_ROOT, '', $file);
                $value = $file;
            }
            $this->transport->setStyle($id, "{\n$property: url($value);\n}");
        } elseif ($property == 'header-font-family') {
            $this->transport->setStyle($id, "{\nfont-family:$value;\n}", 'h1,h2,h3,h4,h5,h6');
        } elseif ($property == 'header-color') {
            $this->transport->setStyle($id, "{\ncolor:$value;\n}", 'h1,h2,h3,h4,h5,h6');
        } elseif ($property == 'block-font-family') {
            $this->transport->setStyle($id, "{\nfont-family:$value;\n}");
        } elseif ($property == 'block-color') {
            $this->transport->setStyle($id, "{\ncolor:$value;\n}");
        } else {
            $this->transport->setStyle($id, "{\n$property:$value;\n}");
        }
    }

    /**
     * Set modular scales in CSS
     *
     * @param string $id       Slide id-attribute
     * @param string $scale    Modular Scale Ratio
     * @param float  $modifier Optional multiplication-parameter
     *
     * @return void
     */
    public function setModularScale(string $id, string $scale, float $modifier = null)
    {
        $scale = (float) $scale;
        $steps = array(6, 5, 4, 3, 2, 1, 0);
        for ($i = 1; $i <= 6; $i++) {
            $value = self::modularScale($steps[$i], 16, $scale, true);
            $value = $modifier != null ? $value * $modifier : $value;
            $this->transport->setStyle($id, '{font-size:' . $value . 'em;}', 'h' . $i);
        }
    }

    /**
     * Get font-size in pixels
     *
     * @param integer $step     Step in scale
     * @param integer $base     Base font-size
     * @param float   $ratio    Rhythm
     * @param bool    $relative Output relative units
     *
     * @return float Modular Scale breakpoint
     */
    public static function modularScale(int $step, int $base, float $ratio, bool $relative = null)
    {
        if ($relative == true) {
            return round((pow($ratio, $step) * $base) / $base, 3);
        } else {
            return round((pow($ratio, $step) * $base), 2);
        }
    }

    /**
     * Remove wrapping paragraph from img-element
     *
     * @param string $content Markdown content in Page
     *
     * @return string Processed content
     */
    public static function unwrapImage(string $content)
    {
        $unwrap = self::REGEX_MEDIA_P;
        $content = preg_replace($unwrap, "$1", $content);
        return $content;
    }

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
    public function interpretShortcodes(string $content, string $id)
    {
        $handlers = new HandlerContainer();
        $handlers->setDefault(
            function (ShortcodeInterface $sc) {
                $return = array();
                $name = $sc->getName();
                $value = $sc->getParameter($name, $sc->getBbCode());
                if (Utils::startsWith($name, 'class')) {
                    $this->props['class'] = $value;
                } elseif (Utils::startsWith($name, 'style')) {
                    $name = str_replace('style-', '', $name);
                    $this->props['styles'][$name] = $value;
                } elseif (Utils::startsWith($name, 'data')) {
                    $this->props['styles'][$name] = $value;
                } elseif (Utils::startsWith($name, 'hide')) {
                    $this->props['hide'] = [true];
                }
                return;
            }
        );
        $parser = "Thunder\Shortcode\Parser\\" . $this->config['shortcode_parser'];
        $processor = new Processor(new $parser(), $handlers);
        return ['content' => $processor->process($content), 'props' => $this->props];
    }
    
    /**
     * Create HTML for fragments
     *
     * @param string $content Markdown content in Page
     *
     * @deprecated 2.0.0
     *
     * @return string Processed contents
     */
    public function processFragments(string $content)
    {
        $content = preg_replace(
            self::REGEX_FRAGMENT_SHORTCODE,
            '<span class="fragment \\1">\\2</span>',
            $content
        );
        return $content;
    }

    /**
     * Process styles and data-attributes
     *
     * @param array  $styles List of key-value pairs
     * @param string $route  Route to Page for relative assets
     * @param string $id     Slide id-attribute
     * @param string $base   Base path to prepend to file
     *
     * @deprecated 2.0.0
     *
     * @return string Processed styles, in inline string
     */
    public function processStylesData(array $styles, string $route, string $id, string $base = "")
    {
        $inline = $data = '';
        foreach ($styles as $property => $value) {
            if ($property == 'background-image') {
                if (!Uri::isValidUrl($value)) {
                    $locations = array(
                        '',
                        'user/pages',
                        'user/pages/images',
                    );
                    $locations = Utilities::explodeFileLocations($locations, GRAV_ROOT, '/', '/');
                    $file = Utilities::fileFinder($value, $locations);
                    $file = str_ireplace(GRAV_ROOT, '', $file);
                    $value = $base . $file;
                }
                $inline .= $property . ': url(' . $value . ');';
            } elseif (Utils::startsWith($property, 'data')) {
                $data .= ' ' . $property . '="' . $value . '"';
                if ($property == 'data-textsize-scale') {
                    $this->transport->setClass($id, 'textsizing');
                }
            } elseif ($property == 'header-font-family') {
                $this->transport->setStyle($id, "{\nfont-family:$value;\n}", 'h1,h2,h3,h4,h5,h6');
            } elseif ($property == 'header-color') {
                $this->transport->setStyle($id, "{\ncolor:$value;\n}", 'h1,h2,h3,h4,h5,h6');
            } elseif ($property == 'block-font-family') {
                $this->transport->setStyle($id, "{\nfont-family:$value;\n}");
            } elseif ($property == 'block-color') {
                $this->transport->setStyle($id, "{\ncolor:$value;\n}");
            } else {
                $inline .= $property . ': ' . $value . ';';
            }
        }
        return array(
            'style' => $inline,
            'data' => $data
        );
    }
}
