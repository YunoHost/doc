<?php

/**
 * @package    Grav\Plugin\Login
 *
 * @copyright  Copyright (C) 2014 - 2021 RocketTheme, LLC. All rights reserved.
 * @license    MIT License; see LICENSE file for details.
 */

namespace Grav\Plugin\Login\RememberMe;

use Grav\Common\File\CompiledYamlFile;
use Grav\Common\Filesystem\Folder;
use Grav\Common\Grav;
use Birke\Rememberme\Storage\StorageInterface;

/**
 * Token Storage wrapper
 *
 * Used for storing the credential/token/persistentToken triplets.
 */
class TokenStorage implements StorageInterface
{
    /** @var string */
    protected $path;

    /** @var int */
    protected $timeout;

    /**
     * Constructor
     *
     * @param string    $path   Path to storage directory
     * @param int       $timeout
     * @throws \InvalidArgumentException
     */
    public function __construct($path = 'user-data://rememberme', $timeout = 604800)
    {
        $this->path = Grav::instance()['locator']->findResource($path, true, true);
        $this->timeout = $timeout;
    }

    /**
     * Return Tri-state value constant
     *
     * @param mixed     $credential         Unique credential (user id, email address, user name)
     * @param string    $token              One-Time Token
     * @param string    $persistentToken    Persistent Token
     *
     * @return int
     */
    public function findTriplet($credential, $token, $persistentToken)
    {
        // Hash the tokens, because they can contain a salt and can be accessed in the file system
        $persistentToken = sha1($persistentToken);
        $token = sha1($token);

        $file = $this->getFile($credential);
        $tokens = (array)$file->content();

        if (!isset($tokens[$persistentToken]) || $tokens[$persistentToken] < time() + $this->timeout) {
            return self::TRIPLET_NOT_FOUND;
        }

        $stored = key($tokens[$persistentToken]);
        if ($stored !== $token) {
            return self::TRIPLET_INVALID;
        }

        return self::TRIPLET_FOUND;
    }

    /**
     * Store the new token for the credential and the persistent token. Create a new storage entry, if the combination
     * of credential and persistent token does not exist.
     *
     * @param mixed     $credential
     * @param string    $token
     * @param string    $persistentToken
     * @param int       $expire             Timestamp when this triplet will expire (0 = no expiry)
     */
    public function storeTriplet($credential, $token, $persistentToken, $expire = null)
    {
        // Hash the tokens, because they can contain a salt and can be accessed in the file system
        $persistentToken = sha1($persistentToken);
        $token = sha1($token);

        $file = $this->getFile($credential);
        $tokens = (array)$file->content();

        // Update token
        $tokens[$persistentToken] = [$token => time()];

        $file->save($tokens);
    }

    /**
     * Replace current token after successful authentication
     *
     * @param mixed     $credential
     * @param string    $token
     * @param string    $persistentToken
     * @param int       $expire
     */
    public function replaceTriplet($credential, $token, $persistentToken, $expire = null)
    {
        $this->storeTriplet($credential, $token, $persistentToken, $expire);
    }

    /**
     * Remove one triplet of the user from the store
     *
     * @param mixed     $credential
     * @param string    $persistentToken
     */
    public function cleanTriplet($credential, $persistentToken)
    {
        // Hash the tokens, because they can contain a salt and can be accessed in the file system
        $persistentToken = sha1($persistentToken);

        $file = $this->getFile($credential);
        if (!$file->exists()) {
            return;
        }

        $tokens = (array)$file->content();

        if (isset($tokens[$persistentToken])) {
            // Delete token from storage
            unset($tokens[$persistentToken]);

            if ($tokens) {
                $file->save($tokens);
            } else {
                $file->delete();
            }
        }
    }

    /**
     * Remove all triplets of a user, effectively logging him out on all
     * machines
     *
     * @param  mixed   $credential
     */
    public function cleanAllTriplets($credential)
    {
        $file = $this->getFile($credential);
        if ($file->exists()) {
            $file->delete();
        }
    }

    /**
     * Helper method to clear RememberMe cache
     */
    public function clearCache()
    {
        if (is_dir($this->path)) {
            Folder::delete($this->path, false);
        }
    }

    /**
     * @param string $credential
     * @return CompiledYamlFile
     */
    protected function getFile($credential)
    {
        return CompiledYamlFile::instance($this->path . '/' . sha1($credential) . '.yaml');
    }
}
