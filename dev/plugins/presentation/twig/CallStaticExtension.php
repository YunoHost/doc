<?php
namespace Grav\Plugin\PresentationPlugin;

class CallStaticTwigExtension extends \Twig_Extension
{
    public function getName()
    {
        return 'CallClassExtension';
    }
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('callstatic', [$this, 'getter'])
        ];
    }
    public function getter($class, $method, $params = false)
    {
        // Cannot get Reflection to work on $class
        return PresentationPlugin::$method($params);
    }
}