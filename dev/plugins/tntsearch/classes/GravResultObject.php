<?php
namespace Grav\Plugin\TNTSearch;

class GravResultObject
{
    /** @var array */
    protected $items;
    /** @var int */
    protected $counter;

    /**
     * GravResultObject constructor.
     * @param array $items
     */
    public function __construct($items)
    {
        $this->counter = 0;
        $this->items   = $items;
    }

    /**
     * @param array $options
     * @return array
     */
    public function fetch($options)
    {
        return $this->items[$this->counter++];
    }
}