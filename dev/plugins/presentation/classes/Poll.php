<?php
/**
 * Presentation Plugin, Poll API
 *
 * PHP version 7
 *
 * @category   API
 * @package    Grav\Plugin\PresentationPlugin
 * @subpackage Grav\Plugin\PresentationPlugin\Poll
 * @author     Ole Vik <git@olevik.net>
 * @license    http://www.opensource.org/licenses/mit-license.html MIT License
 * @link       https://github.com/OleVik/grav-plugin-presentation
 */

namespace Grav\Plugin\PresentationPlugin\API;

/**
 * Poll API
 *
 * Simple REST API for communicating Event Data between pages
 *
 * @category Extensions
 * @package  Grav\Plugin\PresentationPlugin
 * @author   Ole Vik <git@olevik.net>
 * @license  http://www.opensource.org/licenses/mit-license.html MIT License
 * @link     https://github.com/OleVik/grav-plugin-presentation
 */
class Poll implements PollInterface
{
    /**
     * Initiate Poll Storage
     *
     * @param string $directory Path to directory.
     * @param string $file      Filename.
     */
    public function __construct($directory, $file)
    {
        $this->directory = $directory;
        $this->file = $file;
        $this->DS = DIRECTORY_SEPARATOR;
    }

    /**
     * Set Poll Event Data
     *
     * @param string $data Event Data to execute.
     *
     * @throws Exception Errors from file operations.
     *
     * @return bool State of execution.
     */
    public function set($data)
    {
        try {
            if (!is_writable($this->directory)) {
                try {
                    mkdir($this->directory, 0755, true);
                } catch (\Exception $e) {
                    throw new \Exception($e);
                }
            }
            try {
                file_put_contents($this->directory . $this->DS . $this->file, $data);
                echo $data;
                return true;
            } catch (\Exception $e) {
                throw new \Exception($e);
            }
            return false;
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    /**
     * Get Poll Event Data
     *
     * @throws Exception Errors from file operations.
     *
     * @return bool State of execution.
     */
    public function get()
    {
        try {
            $target = $this->directory . $this->DS . $this->file;
            if (file_exists($target)) {
                $data = file_get_contents($target);
                echo $data;
                return true;
            } else {
                echo '100 Continue';
                return false;
            }
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
    }

    /**
     * Remove Poll Event Data
     *
     * @throws Exception Errors from file operations.
     *
     * @return bool State of execution.
     */
    public function remove()
    {
        try {
            $target = $this->directory . $this->DS . $this->file;
            if (file_exists($target)) {
                unlink($target);
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            throw new \Exception($e);
        }
        return false;
    }
}
