<?php

/**
 * Presentation Plugin, Utilities
 *
 * PHP version 7
 *
 * @category   API
 * @package    Grav\Plugin\PresentationPlugin
 * @subpackage Grav\Plugin\PresentationPlugin\Utilities
 * @author     Ole Vik <git@olevik.net>
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @link       https://github.com/OleVik/grav-plugin-presentation
 */

namespace Grav\Plugin\PresentationPlugin;

use Grav\Common\Grav;
use Grav\Common\Plugin;
use Grav\Common\Page\Page;
use Grav\Common\Page\Collection;

/**
 * Utilities
 *
 * @category Extensions
 * @package  Grav\Plugin\PresentationPlugin
 * @author   Ole Vik <git@olevik.net>
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @link     https://github.com/OleVik/grav-plugin-presentation
 */
class Utilities
{
    /**
     * Search for a file in multiple locations
     *
     * @param string $file      Filename.
     * @param array  $locations List of folders.
     *
     * @return string
     */
    public static function fileFinder(string $file, array $locations)
    {
        $return = false;
        foreach ($locations as $location) {
            if (file_exists($location . '/' . $file)) {
                $return = $location . '/' . $file;
                break;
            }
        }
        return $return;
    }

    /**
     * Search for files in multiple locations
     *
     * @param string $directory Folder-name.
     * @param string $types     File extensions.
     *
     * @return array
     */
    public static function filesFinder(string $directory, array $types)
    {
        if (empty($directory) || !is_dir($directory)) {
            return [];
        }
        $iterator = new \RecursiveDirectoryIterator(
            $directory,
            \RecursiveDirectoryIterator::SKIP_DOTS
        );
        $iterator = new \RecursiveIteratorIterator($iterator);
        $files = [];
        foreach ($iterator as $file) {
            if (in_array(pathinfo($file, PATHINFO_EXTENSION), $types)) {
                $files[] = $file;
            }
        }
        return $files;
    }

    /**
     * Join variations of strings to test locations
     *
     * @param array  $array  Items to iterate through.
     * @param string $base   Root path.
     * @param string $prefix Base prefix.
     * @param string $affix  Base affix.
     *
     * @return array
     */
    public static function explodeFileLocations(array $array, string $base, string $prefix, string $affix)
    {
        $return = array();
        foreach ($array as $entry) {
            $return[] = $entry;
            $return[] = $base . $entry;
            $return[] = $prefix . $base . $entry;
            $return[] = $base . $affix . $entry;
            $return[] = $prefix . $base . $affix . $entry;
        }
        return $return;
    }

    /**
     * Find contrasting color from 50%-equation
     *
     * @param string $hexcolor Hexadecimal color-value
     *
     * @return string black|white
     *
     * @see https://24ways.org/2010/calculating-color-contrast
     */
    public function getContrast50($hexcolor)
    {
        return (hexdec($hexcolor) > 0xffffff / 2) ? 'black' : 'white';
    }

    /**
     * Find contrasting color from YIQ-equation
     *
     * @param string $hexcolor Hexadecimal color-value
     *
     * @return string black|white
     *
     * @see https://24ways.org/2010/calculating-color-contrast
     */
    public function getContrastYIQ($hexcolor)
    {
        $r = hexdec(substr($hexcolor, 0, 2));
        $g = hexdec(substr($hexcolor, 2, 4));
        $b = hexdec(substr($hexcolor, 4, 6));
        $yiq = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;
        return ($yiq >= 128) ? 'black' : 'white';
    }

    /**
     * Flatten a multidimensional array to one dimension, optionally preserving keys
     *
     * @param array   $array        Array to flatten
     * @param integer $preserveKeys 0 to discard, 1 for strings only, 2 for all
     * @param array   $out          Internal parameter for recursion
     *
     * @return array Flattened array
     *
     * @see https://stackoverflow.com/a/7256477/603387
     */
    public static function flattenArray($array, $preserveKeys = 0, &$out = array())
    {
        foreach ($array as $key => $child) {
            if (is_array($child)) {
                $out = self::flattenArray($child, $preserveKeys, $out);
            } elseif ($preserveKeys + is_string($key) > 1) {
                $out[$key] = $child;
            } else {
                $out[] = $child;
            }
        }
        return $out;
    }

    /**
     * Insert string within string
     *
     * @param string $str    Original string
     * @param string $insert String to insert
     * @param int    $index  Position to insert to
     *
     * @return string Original string with new string inserted
     *
     * @see https://stackoverflow.com/a/30820401/603387
     */
    public function stringInsert($str, $insert, $index)
    {
        $str = substr($str, 0, $index) . $insert . substr($str, $index);
        return $str;
    }

    /**
     * Parse string values to numerics or booleans in array
     *
     * @param array $array Array to parse values in
     *
     * @return array Converted array
     *
     * @see https://stackoverflow.com/a/10438028/603387
     */
    public static function parseAmbiguousArrayValues(array $array)
    {
        array_walk_recursive(
            $array,
            function (&$item) {
                if ($item == "true") {
                    $item = true;
                } elseif ($item == "false") {
                    $item = false;
                } elseif (is_numeric($item)) {
                    $item = intval($item);
                } elseif (is_string($item)) {
                    $item = $item;
                }
            }
        );
        return $array;
    }

    /**
     * Authorize access with a token in GET-parameter
     *
     * @param string $token Token to validate against.
     *
     * @return void
     */
    public static function authorize(string $token)
    {
        error_reporting(0);
        if (!strlen($token) >= 16 || !isset($_GET['token']) || $_GET['token'] !== $token) {
            header('HTTP/1.1 401 Unauthorized');
            exit('401 Unauthorized');
        } else {
            return true;
        }
    }
}
