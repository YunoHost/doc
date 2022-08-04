<?php

namespace Grav\Plugin\Problems;

use Grav\Common\Grav;
use Grav\Plugin\Problems\Base\Problem;

/**
 * Class PHPModules
 * @package Grav\Plugin\Problems
 */
class PHPModules extends Problem
{
    public function __construct()
    {
        $this->id = 'PHP Modules';
        $this->class = get_class($this);
        $this->order = 101;
        $this->level = Problem::LEVEL_CRITICAL;
        $this->status = false;
        $this->help = 'https://learn.getgrav.org/basics/requirements#php-requirements';
    }

    /**
     * @return $this
     */
    public function process()
    {
        $modules_errors = [];
        $modules_success = [];

        // Check for PHP CURL library
        $msg = 'PHP Curl (Data Transfer Library) is %s installed';
        if (function_exists('curl_version')) {
            $modules_success['curl'] = sprintf($msg, 'successfully');
        } else {
            $modules_errors['curl'] = sprintf($msg, 'required but not');
        }

        // Check for PHP Ctype library
        $msg = 'PHP Ctype is %s installed';
        if (function_exists('ctype_print')) {
            $modules_success['ctype'] = sprintf($msg, 'successfully');
        } else {
            $modules_errors['ctype'] = sprintf($msg, 'required but not');
        }

        // Check for PHP Dom library
        $msg = 'PHP DOM is %s installed';
        if (class_exists('DOMDocument')) {
            $modules_success['dom'] = sprintf($msg, 'successfully');
        } else {
            $modules_errors['dom'] = sprintf($msg, 'required but not');
        }

        // Check for GD library
        $msg = 'PHP GD (Image Manipulation Library) is %s installed';
        if (defined('GD_VERSION') && function_exists('gd_info')) {

            $msg = $modules_success['gd'] = sprintf($msg, 'successfully');

            // Extra checks for Image support
            $ginfo = gd_info();
            $gda = array('PNG Support', 'JPEG Support', 'FreeType Support', 'GIF Read Support');
            $gda_msg = '';
            $problems_found = false;

            foreach ($gda as $image_type) {
                if (!$ginfo[$image_type]) {
                    $problems_found = true;
                    $gda_msg = "missing $image_type, but is ";
                    break;
                }
            }

            if ($problems_found) {
                $msg .= ' but missing ' . $gda_msg;
            }

            $modules_success['gd'] = $msg;
        } else {
            $modules_errors['gd'] = sprintf($msg, 'required but not');
        }

        // Check for PHP MbString library
        $msg = 'PHP Mbstring (Multibyte String Library) is %s installed';
        if (extension_loaded('mbstring')) {
            $modules_success['mbstring'] = sprintf($msg, 'successfully');
        } else {
            $modules_errors['mbstring'] = sprintf($msg, 'required but not');
        }

        // Check for PHP Open SSL library
        $msg = 'PHP OpenSSL (Secure Sockets Library) is %s installed';
        if (defined('OPENSSL_VERSION_TEXT') && extension_loaded('openssl')) {
            $modules_success['openssl'] = sprintf($msg, 'successfully');
        } else {
            $modules_errors['openssl'] = sprintf($msg, 'required but not');
        }

        // Check for PHP XML library
        $msg = 'PHP JSON Library is %s installed';
        if (extension_loaded('json')) {
            $modules_success['json'] = sprintf($msg, 'successfully');
        } else {
            $modules_errors['json'] = sprintf($msg, 'required but not');
        }

        // Check for PHP XML library
        $msg = 'PHP XML Library is %s installed';
        if (extension_loaded('xml')) {
            $modules_success['xml'] = sprintf($msg, 'successfully');
        } else {
            $modules_errors['xml'] = sprintf($msg, 'required but not');
        }

        // Check for PHP Zip library
        $msg = 'PHP Zip extension is %s installed';
        if (extension_loaded('zip')) {
            $modules_success['zip'] = sprintf($msg, 'successfully');
        } else {
            $modules_errors['zip'] = sprintf($msg, 'required but not');
        }

        // Check Exif if enabled
        if (Grav::instance()['config']->get('system.media.auto_metadata_exif')) {
            $msg = 'PHP Exif (Exchangeable Image File Format) is %s installed';
            if (extension_loaded('exif')) {
                $modules_success['exif'] = sprintf($msg, 'successfully');
            } else {
                $modules_errors['exif'] = sprintf($msg, 'required but not');
            }
        }

        if (empty($modules_errors)) {
            $this->status = true;
            $this->msg = 'All modules look good!';
        } else {
            $this->status = false;
            $this->msg = 'There were problems with required modules:';
        }

        $this->details = ['errors' => $modules_errors, 'success' => $modules_success];

        return $this;
    }
}

