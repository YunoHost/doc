<?php

namespace Grav\Plugin\ShortcodeCore;

class ShortcodeObject
{
    protected $obj_name;
    protected $obj_object;

    public function __construct($name, $object)
    {
        $this->obj_name = $name;
        $this->obj_object = $object;
    }

    public function __toString()
    {
        return $this->obj_object;
    }

    public function name()
    {
        return $this->obj_name;
    }

    public function object()
    {
        return $this->obj_object;
    }
}

// Make sure we also autoload the deprecated class.
class_exists(\Grav\Plugin\Shortcodes\ShortcodeObject::class);
