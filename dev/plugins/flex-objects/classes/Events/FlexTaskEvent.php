<?php

namespace Grav\Plugin\FlexObjects\Events;

use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;
use Grav\Framework\Flex\Interfaces\FlexDirectoryInterface;
use Grav\Framework\Flex\Interfaces\FlexObjectInterface;
use Grav\Framework\Object\Interfaces\ObjectInterface;
use Grav\Plugin\FlexObjects\Controllers\AbstractController;

/**
 * @template T as FlexObjectInterface
 * @template C as FlexCollectionInterface
 */
class FlexTaskEvent
{
    /** @var string */
    public $task;
    /** @var string */
    public $type;
    /** @var string */
    public $key;

    /** @var ObjectInterface */
    private $object;
    /** @var AbstractController */
    private $controller;

    /**
     * @param AbstractController $controller
     * @param string $task
     */
    public function __construct(AbstractController $controller, ObjectInterface $object, string $task)
    {
        $this->task = $task;
        $this->type = $controller->getDirectoryType();
        $this->key = $controller->getObjectKey();
        $this->object = $object;
        $this->controller = $controller;
    }

    /**
     * @return AbstractController
     */
    public function getController(): AbstractController
    {
        return $this->controller;
    }

    /**
     * @return FlexDirectoryInterface
     */
    public function getDirectory(): FlexDirectoryInterface
    {
        return $this->getController()->getDirectory();
    }

    /**
     * @return FlexObjectInterface
     * @phpstan-return T
     */
    public function getModifiedObject(): FlexObjectInterface
    {
        return $this->object;
    }

    /**
     * @return FlexObjectInterface
     * @phpstan-return T
     */
    public function getOriginalObject(): FlexObjectInterface
    {
        return $this->controller->getObject();
    }

    /**
     * @return FlexCollectionInterface
     * @phpstan-return C
     */
    public function getCollection(): FlexCollectionInterface
    {
        return $this->getController()->getDirectory()->getCollection();
    }
}
