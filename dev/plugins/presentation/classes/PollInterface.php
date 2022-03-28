<?php
/**
 * Presentation Plugin, Poll API Interface
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
 * Poll API Interface
 *
 * Poll API Interface for aggregating Poll
 *
 * @category Extensions
 * @package  Grav\Plugin\PresentationPlugin\API
 * @author   Ole Vik <git@olevik.net>
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @link     https://github.com/OleVik/grav-plugin-presentation
 */
interface PollInterface
{
    /**
     * Set Poll Event Data
     *
     * @param string $data Event Data to execute.
     *
     * @throws Exception Errors from file operations.
     *
     * @return bool State of execution.
     */
    public function set($data);

    /**
     * Get Poll Event Data
     *
     * @throws Exception Errors from file operations.
     *
     * @return bool State of execution.
     */
    public function get();
    
    /**
     * Remove Poll Event Data
     *
     * @throws Exception Errors from file operations.
     *
     * @return bool State of execution.
     */
    public function remove();
}