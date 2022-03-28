<?php

namespace Grav\Plugin\Problems\Base;

use Grav\Common\Cache;
use Grav\Common\Grav;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class ProblemChecker
 * @package Grav\Plugin\Problems\Base
 */
class ProblemChecker
{
    /** @var string */
    const PROBLEMS_PREFIX = 'problem-check-';

    /** @var array */
    protected $problems = [];
    /** @var string */
    protected $status_file;

    public function __construct()
    {
        /** @var Cache $cache */
        $cache = Grav::instance()['cache'];
        $this->status_file = CACHE_DIR . $this::PROBLEMS_PREFIX . $cache->getKey() . '.json';
    }

    /**
     * @return bool
     */
    public function load(): bool
    {
        if ($this->statusFileExists()) {
            $json = file_get_contents($this->status_file) ?: '';
            $data = json_decode($json, true);
            if (!is_array($data)) {
                return false;
            }

            foreach ($data as $problem) {
                $class = $problem['class'];
                $this->problems[] = new $class($problem);
            }
        }

        return true;
    }

    /**
     * @return string
     */
    public function getStatusFile():string
    {
        return $this->status_file;
    }

    /**
     * @return bool
     */
    public function statusFileExists(): bool
    {
        return file_exists($this->status_file);
    }

    /**
     * @return void
     */
    public function storeStatusFile(): void
    {
        $problems = $this->getProblemsSerializable();
        $json = json_encode($problems);
        file_put_contents($this->status_file, $json);
    }

    /**
     * @param string|null $problems_dir
     * @return bool
     */
    public function check($problems_dir = null): bool
    {
        $problems_dir = $problems_dir ?: dirname(__DIR__);
        $problems = [];
        $problems_found = false;

        $iterator = new \DirectoryIterator($problems_dir);
        foreach ($iterator as $file) {
            if (!$file->isFile() || $file->getExtension() !== 'php') {
                continue;
            }
            $classname = 'Grav\\Plugin\\Problems\\' . $file->getBasename('.php');
            if (class_exists($classname)) {
                /** @var Problem $problem */
                $problem = new $classname();
                $problems[$problem->getId()] = $problem;
            }
        }

        // Fire event to allow other plugins to add problems
        Grav::instance()->fireEvent('onProblemsInitialized', new Event(['problems' => $problems]));

        // Get the problems in order
        usort($problems, function($a, $b) {
            /** @var Problem $a */
            /** @var Problem $b */
            return $b->getOrder() - $a->getOrder();
        });

        // run the process methods in new order
        foreach ($problems as $problem) {
            $problem->process();
            if ($problem->getStatus() === false && $problem->getLevel() === Problem::LEVEL_CRITICAL) {
                $problems_found = true;
            }
        }

        $this->problems = $problems;

        return $problems_found;
    }

    /**
     * @return array
     */
    public function getProblems(): array
    {
        if (empty($this->problems)) {
            $this->check();
        }

        $problems = $this->problems;

        // Put the failed ones first
        usort($problems, function($a, $b) {
            /** @var Problem $a */
            /** @var Problem $b */
            return $a->getStatus() - $b->getStatus();
        });

        return $problems;
    }

    /**
     * @return array
     */
    public function getProblemsSerializable(): array
    {
        if (empty($this->problems)) {
            $this->getProblems();
        }

        $problems = [];
        foreach ($this->problems as $problem) {
            $problems[] = $problem->toArray();
        }
        return $problems;
    }
}