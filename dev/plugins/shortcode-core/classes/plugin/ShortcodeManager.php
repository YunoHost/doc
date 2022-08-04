<?php

namespace Grav\Plugin\ShortcodeCore;

use Grav\Common\Config\Config;
use Grav\Common\Data\Data;
use Grav\Common\Grav;
use Grav\Common\Page\Interfaces\PageInterface;
use Thunder\Shortcode\EventContainer\EventContainer;
use Thunder\Shortcode\HandlerContainer\HandlerContainer;
use Thunder\Shortcode\Parser\RegexParser;
use Thunder\Shortcode\Parser\RegularParser;
use Thunder\Shortcode\Parser\WordpressParser;
use Thunder\Shortcode\Processor\Processor;
use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use Thunder\Shortcode\Syntax\CommonSyntax;

class ShortcodeManager
{

    /** @var Grav $grav */
    protected $grav;

    /** @var Config */
    protected $config;

    /** @var PageInterface $page */
    protected $page;

    /** @var  HandlerContainer $handlers */
    protected $handlers;

    /** @var  HandlerContainer $raw_handlers */
    protected $raw_handlers;

    /** @var  EventContainer $events */
    protected $events;

    /** @var array */
    protected $assets;

    /** @var array */
    protected $states;

    /** @var array */
    protected $objects;

    /**
     * initialize some internal instance variables
     */
    public function __construct()
    {
        $this->grav = Grav::instance();
        $this->config = $this->grav['config'];
        $this->handlers = new HandlerContainer();
        $this->raw_handlers = new HandlerContainer();
        $this->events = new EventContainer();
        $this->states = [];
        $this->assets = [];
        $this->objects = [];
    }

    /**
     * add CSS and JS assets to the Manager so that they can be saved to cache
     * for subsequent cached pages
     *
     * @param mixed $actionOrAsset the type of asset (JS or CSS) or, if the second parameter is omitted,
     *      a collection or an array of asset.
     * @param string $asset the asset path in question
     */
    public function addAssets($actionOrAsset, $asset = null)
    {
        if ($asset == null) {
            if (is_array($actionOrAsset)) {
                $this->assets[''] = array_merge($this->assets[''] ?? array(), $actionOrAsset);
            } else {
                $this->assets[''] [] = $actionOrAsset;
            }
        } else {
            if (isset($this->assets[$actionOrAsset]) && in_array($asset, $this->assets[$actionOrAsset], true)) {
                return;
            }
            $this->assets[$actionOrAsset] [] = $asset;
        }
    }

    /**
     * return a multi-dimensional array of all the assets
     *
     * @return array the assets array
     */
    public function getAssets()
    {
        return $this->assets;
    }

    /**
     * reset the assets
     */
    public function resetAssets()
    {
        $this->assets = [];
    }

    /**
     * adds ad object
     * @param string $key The key to look up the object
     * @param object $object The object to store
     */
    public function addObject($key, $object)
    {
        $new = [$object->name() => $object];
        if (array_key_exists($key, $this->objects)) {
            $current = (array)$this->objects[$key];
            $this->objects[$key] = $current + $new;
        } else {
            $this->objects[$key] = $new;
        }

    }

    /**
     * sets all the objects
     * @param array $objects The objects array
     */
    public function setObjects($objects)
    {
        $this->objects = $objects;
    }

    /**
     * return all the objects
     * @return array The objects array
     */
    public function getObjects()
    {
        return $this->objects;
    }

    /**
     * reset the objects
     */
    public function resetObjects()
    {
        $this->objects = [];
    }

    /**
     * returns the current handler container object
     * 
     * @return HandlerContainer
     */
    public function getHandlers()
    {
        return $this->handlers;
    }

    /**
     * returns the current raw handler container object
     *
     * @return HandlerContainer
     */
    public function getRawHandlers()
    {
        return $this->raw_handlers;
    }

    /**
     * returns the current event container object
     *         
     * @return EventContainer
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Register an individual shortcode with the manager so it can be operated on by the Shortcode library
     * 
     * @param  string $name      the name of the shortcode (should match the classname)
     * @param  string|null $directory directory where the shortcode is located
      */
    public function registerShortcode($name, $directory = null)
    {
        $className = 'Grav\\Plugin\\Shortcodes\\' . basename($name, '.php');
        if (!class_exists($className) && $directory) {
            $path = rtrim($directory, '/').'/'.$name;

            require_once $path;
        }

        // Make sure the class exists, extends Shortcode and is not abstract.
        if (class_exists($className) && is_subclass_of($className, \Grav\Plugin\Shortcodes\Shortcode::class)) {
            $reflection = new \ReflectionClass($className);
            if (!$reflection->isAbstract()) {
                /** @var \Grav\Plugin\Shortcodes\Shortcode $shortcode */
                $shortcode = new $className();
                $shortcode->init();
            }
        }
    }

    /**
     * register all files as shortcodes in a particular directory
     * @param string $directory directory where the shortcodes are located
     * @param array $options Extra options
     */
    public function registerAllShortcodes($directory, array $options = [])
    {
        try {
            $ignore = $options['ignore'] ?? [];
            foreach (new \DirectoryIterator($directory) as $file) {
                if ($file->isDot() || \in_array($file->getBasename('.php'), $ignore, true)) {
                    continue;
                }
                $this->registerShortcode($file->getFilename(), $directory);
            }
        } catch (\UnexpectedValueException $e) {
            Grav::instance()['log']->error('ShortcodeCore Plugin: Directory not found => ' . $directory);
        }
    }

    /**
     * setup the markdown parser to handle shortcodes properly
     * 
     * @param  object $markdown the markdown parser object
     */
    public function setupMarkdown($markdown)
    {
        $markdown->addBlockType('[', 'ShortCodes', true, false);

        $markdown->blockShortCodes = function($Line) {
            $valid_shortcodes = implode('|', $this->handlers->getNames());
            $regex = '/^\[\/?(?:' . $valid_shortcodes . ')[^\]]*\]$/';

            if (preg_match($regex, trim($Line['body']), $matches)) {
                return [
                    'markup' => $Line['body'],
                ];
            }

            return null;
        };
    }

    /**
     * process the content by running over all the known shortcodes with the
     * chosen parser
     *
     * @param PageInterface $page the page to work on
     * @param Data $config configuration merged with the page config
     * @param null $handlers
     * @return string
     */
    public function processContent(PageInterface $page, Data $config, $handlers = null)
    {
        $parser = $this->getParser($config->get('parser'));

        if (!$handlers) {
            $handlers = $this->handlers;
        }

        if ($page && $config->get('enabled')) {
            $this->page = $page;
            $content = $page->getRawContent();
            $processor = new Processor(new $parser(new CommonSyntax()), $handlers);
            $processor = $processor->withEventContainer($this->events);

            return $processor->process($content);
        }

        return null;
    }

    public function processRawContent(PageInterface $page, Data $config)
    {
        return $this->processContent($page, $config, $this->raw_handlers);
    }

    /**
     * Allow the processing of shortcodes directly on a string
     * For example when used by Twig directly
     *
     * @param $str
     * @param null $handlers
     * @return string
     */
    public function processShortcodes($str, $handlers = null)
    {
        $parser = $this->getParser($this->config->get('parser'));

        if (!$handlers) {
            $handlers = $this->handlers;
        }

        $processor = new Processor(new $parser(new CommonSyntax()), $handlers);

        return $processor->process($str);
    }

    public function processShortcodesRaw($str)
    {
        return $this->processShortcodes($str, $this->raw_handlers);
    }

    /**
     * set a state of a particular item with a hash for retrieval later
     * 
     * @param string             $hash      a unique hash code
     * @param object            $item  some item to store
     */
    public function setStates($hash, $item)
    {
        $this->states[$hash][] = $item;
    }

    /**
     * returns the shortcode of a specific hash
     * 
     * @param  string $hash       unique id of state
     * @return ShortcodeInterface shortcode stored for this hash
     */
    public function getStates($hash)
    {
        if (array_key_exists($hash, $this->states)) {
            return $this->states[$hash];
        }

        return null;
    }

    /**
     * helper method to create a unique shortcode based on the content
     * 
     * @param  ShortcodeInterface $shortcode
     * @return string             
     */
    public function getId(ShortcodeInterface $shortcode)
    {
        return substr(md5($shortcode->getShortcodeText()), -10);
    }

    /**
     * Sets the current page context
     *
     * @param PageInterface $page
     */
    public function setPage(PageInterface $page)
    {
        $this->page = $page;
    }

    /** gets the current page context if set */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Get the appropriate parser object
     *
     * @param $parser
     * @return string
     */
    protected function getParser($parser)
    {
        switch($parser)
        {
            case 'regular':
                $parser = RegularParser::class;
                break;
            case 'wordpress':
                $parser = WordpressParser::class;
                break;
            default:
                $parser = RegexParser::class;
                break;
        }

        return $parser;
    }
}
