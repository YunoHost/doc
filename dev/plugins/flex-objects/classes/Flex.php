<?php

declare(strict_types=1);

namespace Grav\Plugin\FlexObjects;

use Grav\Common\Config\Config;
use Grav\Common\Filesystem\Folder;
use Grav\Common\Grav;
use Grav\Common\Page\Interfaces\PageInterface;
use Grav\Common\Utils;
use Grav\Framework\Flex\FlexDirectory;
use Grav\Framework\Flex\FlexObject;
use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;
use Grav\Framework\Flex\Interfaces\FlexCommonInterface;
use Grav\Framework\Flex\Interfaces\FlexDirectoryInterface;
use Grav\Framework\Flex\Interfaces\FlexInterface;
use Grav\Framework\Flex\Interfaces\FlexObjectInterface;
use Grav\Plugin\FlexObjects\Admin\AdminController;
use Grav\Plugin\FlexObjects\Table\DataTable;

/**
 * Class Flex
 * @package Grav\Plugin\FlexObjects
 */
class Flex implements FlexInterface
{
    /** @var FlexInterface */
    protected $flex;
    /** @var array */
    protected $adminRoutes;
    /** @var array */
    protected $adminMenu;
    /** @var array */
    protected $managed;

    /**
     * @param bool $newToOld
     * @return array
     * @internal
     */
    public static function getLegacyBlueprintMap(bool $newToOld = true): array
    {
        $map = [
            'blueprints://flex-objects/pages.yaml' => 'blueprints://flex-objects/grav-pages.yaml',
            'blueprints://flex-objects/user-accounts.yaml' => 'blueprints://flex-objects/grav-accounts.yaml',
            'blueprints://flex-objects/user-groups.yaml' => 'blueprints://flex-objects/grav-user-groups.yaml'
        ];

        return $newToOld ? $map : array_flip($map);
    }

    /**
     * Flex constructor.
     * @param FlexInterface $flex
     * @param array $types
     */
    public function __construct(FlexInterface $flex, array $types)
    {
        $this->flex = $flex;
        $this->managed = [];

        $legacy = static::getLegacyBlueprintMap(false);
        foreach ($types as $blueprint) {
            // Backwards compatibility to v1.0.0-rc.3
            $blueprint = $legacy[$blueprint] ?? $blueprint;

            $type = Utils::basename((string)$blueprint, '.yaml');
            if ($type) {
                $this->managed[] = $type;
            }
        }
    }

    /**
     * @param string $type
     * @param string $blueprint
     * @param array  $config
     * @return $this
     */
    public function addDirectoryType(string $type, string $blueprint, array $config = [])
    {
        $this->flex->addDirectoryType($type, $blueprint, $config);

        return $this;
    }

    /**
     * @param FlexDirectory $directory
     * @return $this
     */
    public function addDirectory(FlexDirectory $directory)
    {
        $this->flex->addDirectory($directory);

        return $this;
    }

    /**
     * @param string $type
     * @return bool
     */
    public function hasDirectory(string $type): bool
    {
        return $this->flex->hasDirectory($type);
    }

    /**
     * @param string[]|null $types
     * @param bool $keepMissing
     * @return array<FlexDirectoryInterface|null>
     */
    public function getDirectories(array $types = null, bool $keepMissing = false): array
    {
        return $this->flex->getDirectories($types, $keepMissing);
    }

    /**
     * Get directories which are not hidden in the site.
     *
     * @return array
     */
    public function getDefaultDirectories(): array
    {
        $list = $this->getDirectories();
        foreach ($list as $type => $directory) {
            if ($directory->getConfig('site.hidden', false)) {
                unset($list[$type]);
            }
        }

        return $list;
    }

    /**
     * @param string $type
     * @return FlexDirectory|null
     */
    public function getDirectory(string $type): ?FlexDirectory
    {
        return $this->flex->getDirectory($type);
    }

    /**
     * @param string $type
     * @param array|null $keys
     * @param string|null $keyField
     * @return FlexCollectionInterface|null
     */
    public function getCollection(string $type, array $keys = null, string $keyField = null): ?FlexCollectionInterface
    {
        return $this->flex->getCollection($type, $keys, $keyField);
    }

    /**
     * @param array $keys
     * @param array $options            In addition to the options in getObjects(), following options can be passed:
     *                                  collection_class:   Class to be used to create the collection. Defaults to ObjectCollection.
     * @return FlexCollectionInterface
     * @throws \RuntimeException
     */
    public function getMixedCollection(array $keys, array $options = []): FlexCollectionInterface
    {
        return $this->flex->getMixedCollection($keys, $options);
    }

    /**
     * @param array $keys
     * @param array $options    Following optional options can be passed:
     *                          types:          List of allowed types.
     *                          type:           Allowed type if types isn't defined, otherwise acts as default_type.
     *                          default_type:   Set default type for objects given without type (only used if key_field isn't set).
     *                          keep_missing:   Set to true if you want to return missing objects as null.
     *                          key_field:      Key field which is used to match the objects.
     * @return array
     */
    public function getObjects(array $keys, array $options = []): array
    {
        return $this->flex->getObjects($keys, $options);
    }

    /**
     * @param string $key
     * @param string|null $type
     * @param string|null $keyField
     * @return FlexObjectInterface|null
     */
    public function getObject(string $key, string $type = null, string $keyField = null): ?FlexObjectInterface
    {
        return $this->flex->getObject($key, $type, $keyField);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->flex->count();
    }

    public function isManaged(string $type): bool
    {
        return \in_array($type, $this->managed, true);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $directories = $this->getDirectories($this->managed);
        $all = $this->getBlueprints();

        /** @var FlexDirectory $directory */
        foreach ($all as $type => $directory) {
            if (!isset($directories[$type])) {
                $directories[$type] = $directory;
            }
        }

        ksort($directories);

        return $directories;
    }

    /**
     * @return array
     */
    public function getBlueprints(): array
    {
        $params = [
            'pattern' => '|\.yaml|',
            'value' => 'Url',
            'recursive' => false,
            'folders' => false
        ];

        $directories = [];
        $all = Folder::all('blueprints://flex-objects', $params);
        foreach ($all as $url) {
            $type = Utils::basename($url, '.yaml');
            $directory = new FlexDirectory($type, $url);
            if ($directory->getConfig('hidden') !== true) {
                $directories[$type] = $directory;
            }
        }

        // Order blueprints by title.
        usort($directories, static function (FlexDirectory $a, FlexDirectory $b) {
            return $a->getTitle() <=> $b->getTitle();
        });

        return $directories;
    }

    /**
     * @param string|FlexDirectory $type
     * @param array $options
     * @return DataTable
     */
    public function getDataTable($type, array $options = []): DataTable
    {
        $directory = $type instanceof FlexDirectory ? $type : $this->getDirectory($type);
        if (!$directory) {
            throw new \RuntimeException('Not Found', 404);
        }

        $collection = $options['collection'] ?? $directory->getCollection();
        if (isset($options['filters']) && is_array($options['filters'])) {
            $collection = $collection->filterBy($options['filters']);
        }
        $table = new DataTable($options);
        $table->setCollection($collection);

        return $table;
    }

    /**
     * @param string|object|null $type
     * @param array $params
     * @param string $extension
     * @return string
     */
    public function adminRoute($type = null, array $params = [], string $extension = ''): string
    {
        if (\is_object($type)) {
            $object = $type;
            if ($object instanceof FlexCommonInterface || $object instanceof FlexDirectory) {
                $type = $type->getFlexType();
            } else {
                return '';
            }
        } else {
            $object = null;
        }

        $routes = $this->getAdminRoutes();

        $grav = Grav::instance();

        /** @var Config $config */
        $config = $grav['config'];
        if (!Utils::isAdminPlugin()) {
            $parts = [
                trim($grav['base_url'], '/'),
                trim($config->get('plugins.admin.route'), '/')
            ];
        }

        if ($type && isset($routes[$type])) {
            if (!$routes[$type]) {
                // Directory has empty route.
                return '';
            }

            // Directory has it's own menu item.
            $parts[] = trim($routes[$type], '/');
        } else {
            if (empty($routes[''])) {
                // Default route has been disabled.
                return '';
            }

            // Use default route.
            $parts[] = trim($routes[''], '/');
            if ($type) {
                $parts[] = $type;
            }
        }

        // Append object key if available.
        if ($object instanceof FlexObject) {
            if ($object->exists()) {
                $parts[] = trim($object->getKey(), '/');
            } else {
                if ($object->hasKey()) {
                    $parts[] = trim($object->getKey(), '/');
                }
                $params = ['' => 'add'] + $params;
            }
        }

        $p = [];
        $separator = $config->get('system.param_sep');
        foreach ($params as $key => $val) {
            $p[] = $key . $separator . $val;
        }

        $parts = array_filter($parts, static function ($val) { return $val !== ''; });
        $route = '/' . implode('/', $parts);
        $extension = $extension ? '.' . $extension : '';

        return $route . $extension . ($p ? '/' . implode('/', $p) : '');
    }

    public function getAdminController(): ?AdminController
    {
        $grav = Grav::instance();
        if (!isset($grav['admin'])) {
            return null;
        }

        /** @var PageInterface $page */
        $page = $grav['page'];
        $header = $page->header();
        $callable = $header->controller['controller']['instance'] ?? null;
        if (null !== $callable && \is_callable($callable)) {
            return $callable();
        }

        return null;
    }

    /**
     * @return array
     */
    public function getAdminRoutes(): array
    {
        if (null === $this->adminRoutes) {
            $routes = [];
            /** @var FlexDirectory $directory */
            foreach ($this->getDirectories() as $directory) {
                $config = $directory->getConfig('admin');
                if (!$directory->isEnabled() || !empty($config['disabled'])) {
                    continue;
                }

                // Resolve route.
                $route = $config['router']['path']
                    ?? $config['menu']['list']['route']
                    ?? "/flex-objects/{$directory->getFlexType()}";

                $routes[$directory->getFlexType()] = $route;
            }

            $this->adminRoutes = $routes;
        }

        return $this->adminRoutes;
    }

    /**
     * @return array
     */
    public function getAdminMenuItems(): array
    {
        if (null === $this->adminMenu) {
            $routes = [];
            $count = 0;

            $directories = $this->getDirectories();
            /** @var FlexDirectory $directory */
            foreach ($directories as $directory) {
                $config = $directory->getConfig('admin');
                if (!$directory->isEnabled() || !empty($config['disabled'])) {
                    continue;
                }
                $type = $directory->getFlexType();
                $items = $directory->getConfig('admin.menu') ?? [];
                if ($items) {
                    foreach ($items as $view => $item) {
                        $item += [
                            'route' => '/' . $type,
                            'title' => $directory->getTitle(),
                            'icon' => 'fa fa-file',
                            'directory' => $type
                        ];
                        $routes[$type] = $item;
                    }
                } else {
                    $count++;
                }
            }

            if ($count && !isset($routes[''])) {
                $routes[''] = ['route' => '/flex-objects'];
            }

            $this->adminMenu = $routes;
        }

        return $this->adminMenu;
    }
}
