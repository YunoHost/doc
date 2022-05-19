<?php

namespace Grav\Plugin\Problems;

use Grav\Plugin\Problems\Base\Problem;

/**
 * Class PHPVersion
 * @package Grav\Plugin\Problems
 */
class PHPVersion extends Problem
{
    public function __construct()
    {
        $this->id = 'PHP Minimum Version';
        $this->class = get_class($this);
        $this->order = 102;
        $this->level = Problem::LEVEL_CRITICAL;
        $this->status = false;
        $this->help = 'https://getgrav.org/blog/raising-php-requirements-2018';
    }

    /**
     * @return $this
     */
    public function process()
    {
        $min_php_version = defined('GRAV_PHP_MIN') ? GRAV_PHP_MIN : '5.6.4';
        $your_php_version = PHP_VERSION;

        $msg = 'Your PHP <strong>%s</strong> is %s than the minimum of <strong>%s</strong> required';

        // Check PHP version
        if (version_compare($your_php_version, $min_php_version, '<')) {
            $this->msg = sprintf($msg, $your_php_version, 'less', $min_php_version);
        } else {
            $this->msg = sprintf($msg, $your_php_version, 'greater', $min_php_version);
            $this->status = true;
        }

        return $this;
    }
}