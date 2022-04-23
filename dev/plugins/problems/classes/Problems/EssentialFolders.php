<?php

namespace Grav\Plugin\Problems;

use Grav\Plugin\Problems\Base\Problem;

/**
 * Class EssentialFolders
 * @package Grav\Plugin\Problems
 */
class EssentialFolders extends Problem
{
    public function __construct()
    {
        $this->id = 'Essential Folders';
        $this->class = get_class($this);
        $this->order = 100;
        $this->level = Problem::LEVEL_CRITICAL;
        $this->status = false;
        $this->help = 'https://learn.getgrav.org/basics/folder-structure';
    }

    /**
     * @return $this
     */
    public function process()
    {
        $essential_folders = [
            GRAV_ROOT => false,
            GRAV_ROOT . '/vendor' => false,
            GRAV_SYSTEM_PATH => false,
            GRAV_CACHE_PATH => true,
            GRAV_LOG_PATH => true,
            GRAV_TMP_PATH => true,
            GRAV_BACKUP_PATH => true,
            GRAV_WEBROOT => false,
            GRAV_WEBROOT . '/images' => true,
            GRAV_WEBROOT . '/assets' => true,
            GRAV_WEBROOT . '/' . GRAV_USER_PATH .'/accounts' => true,
            GRAV_WEBROOT . '/' . GRAV_USER_PATH .'/data' => true,
            GRAV_WEBROOT . '/' . GRAV_USER_PATH .'/pages' => false,
            GRAV_WEBROOT . '/' . GRAV_USER_PATH .'/config' => false,
            GRAV_WEBROOT . '/' . GRAV_USER_PATH .'/plugins/error' => false,
            GRAV_WEBROOT . '/' . GRAV_USER_PATH .'/plugins' => false,
            GRAV_WEBROOT . '/' . GRAV_USER_PATH .'/themes' => false,
        ];

        // Check for essential files & perms
        $file_errors = [];
        $file_success = [];

        foreach ($essential_folders as $file => $check_writable) {
            $file_path = (!preg_match('`^(/|[a-z]:[\\\/])`ui', $file) ? GRAV_ROOT . '/' : '') . $file;

            if (!is_dir($file_path)) {
                $file_errors[$file_path] = 'does not exist';
            } elseif (!$check_writable) {
                $file_success[$file_path] = 'exists';
            } elseif (!is_writable($file_path)) {
                $file_errors[$file_path] = 'exists but is <strong>not writeable</strong>';
            } else {
                $file_success[$file_path] = 'exists and is writable';
            }
        }

        if (empty($file_errors)) {
            $this->status = true;
            $this->msg = 'All folders look good!';
        } else {
            $this->status = false;
            $this->msg = 'There were problems with required folders:';
        }

        $this->details = ['errors' => $file_errors, 'success' => $file_success];

        return $this;
    }
}
