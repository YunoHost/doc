<?php

namespace Grav\Plugin\Problems\Base;

use JsonSerializable;

/**
 * Class Problem
 * @package Grav\Plugin\Problems\Base
 */
class Problem implements JsonSerializable
{
    const LEVEL_CRITICAL = 'critical';
    const LEVEL_WARNING = 'warning';
    const LEVEL_NOTICE = 'notice';

    /** @var string */
    protected $id = '';
    /** @var int */
    protected $order = 0;
    /** @var string */
    protected $level = '';
    /** @var bool */
    protected $status = false;
    /** @var string */
    protected $msg = '';
    /** @var array */
    protected $details = [];
    /** @var string */
    protected $help = '';
    /** @var string */
    protected $class = '';

    /**
     * @param array $data
     * @return void
     */
    public function load(array $data): void
    {
        $this->set_object_vars($data);
    }

    /**
     * @return $this
     */
    public function process()
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order;
    }

    /**
     * @return string
     */
    public function getLevel(): string
    {
        return $this->level;
    }

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getMsg(): string
    {
        return $this->msg;
    }

    /**
     * @return array
     */
    public function getDetails(): array
    {
        return $this->details;
    }

    /**
     * @return string
     */
    public function getHelp(): string
    {
        return $this->help;
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }

    /**
     * @param array $vars
     */
    protected function set_object_vars(array $vars): void
    {
        $has = get_object_vars($this);
        foreach ($has as $name => $oldValue) {
            $this->{$name} = $vars[$name] ?? null;
        }
    }
}