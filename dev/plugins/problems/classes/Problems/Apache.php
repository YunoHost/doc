<?php

namespace Grav\Plugin\Problems;

use Grav\Plugin\Problems\Base\Problem;

/**
 * Class Apache
 * @package Grav\Plugin\Problems
 */
class Apache extends Problem
{
    public function __construct()
    {
        $this->id = 'Apache Modules';
        $this->class = get_class($this);
        $this->order = 1;
        $this->level = Problem::LEVEL_CRITICAL;
        $this->status = true;
        $this->help = 'https://learn.getgrav.org/basics/requirements#apache-requirements';
    }

    /**
     * @return $this
     */
    public function process()
    {
        // Perform some Apache checks
        if (function_exists('apache_get_modules') && strpos(PHP_SAPI, 'apache') !== false) {

            $require_apache_modules = ['mod_rewrite'];
            $apache_modules = apache_get_modules();

            $apache_errors = [];
            $apache_success = [];

            foreach ($require_apache_modules as $module) {
                if (in_array($module, $apache_modules, true)) {
                    $apache_success[$module] = 'module required but not enabled';
                } else {
                    $apache_errors[$module] = 'module is not installed or enabled';
                }
            }

            if (empty($apache_errors)) {
                $this->status = true;
                $this->msg = 'All modules look good!';
            } else {
                $this->status = false;
                $this->msg = 'There were problems with required modules:';
            }

            $this->details = ['errors' => $apache_errors, 'success' => $apache_success];
        } else {
            $this->msg = 'Apache not installed, skipping...';
        }

        return $this;
    }
}

