<?php
namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Debugger;
use Grav\Common\Grav;
use Grav\Common\Page\Interfaces\PageInterface;
use Grav\Common\Page\Pages;
use Grav\Common\Page\Types;
use Grav\Common\Plugin;
use Grav\Common\User\Interfaces\UserInterface;
use Grav\Common\Utils;
use Grav\Events\FlexRegisterEvent;
use Grav\Events\PermissionsRegisterEvent;
use Grav\Events\PluginsLoadedEvent;
use Grav\Framework\Acl\PermissionsReader;
use Grav\Framework\Flex\FlexDirectory;
use Grav\Framework\Flex\FlexForm;
use Grav\Framework\Flex\Interfaces\FlexAuthorizeInterface;
use Grav\Framework\Flex\Interfaces\FlexInterface;
use Grav\Framework\Form\Interfaces\FormInterface;
use Grav\Framework\Route\Route;
use Grav\Plugin\Admin\Admin;
use Grav\Plugin\FlexObjects\Controllers\ObjectController;
use Grav\Plugin\FlexObjects\FlexFormFactory;
use Grav\Plugin\Form\Forms;
use Grav\Plugin\FlexObjects\Admin\AdminController;
use Grav\Plugin\FlexObjects\Flex;
use Psr\Http\Message\ServerRequestInterface;
use RocketTheme\Toolbox\Event\Event;
use function is_array;
use function is_callable;

/**
 * Class FlexObjectsPlugin
 * @package Grav\Plugin
 */
class FlexObjectsPlugin extends Plugin
{
    /** @var string */
    protected const MIN_GRAV_VERSION = '1.7.0';

    /** @var int[] */
    public $features = [
        'blueprints' => 1000,
    ];

    /** @var AdminController */
    protected $controller;

    /**
     * @return bool
     */
    public static function checkRequirements(): bool
    {
        return version_compare(GRAV_VERSION, static::MIN_GRAV_VERSION, '>=');
    }

    /**
     * @return array
     *
     * The getSubscribedEvents() gives the core a list of events
     *     that the plugin wants to listen to. The key of each
     *     array section is the event that the plugin listens to
     *     and the value (in the form of an array) contains the
     *     callable (or function) as well as the priority. The
     *     higher the number the higher the priority.
     */
    public static function getSubscribedEvents(): array
    {
        if (!static::checkRequirements()) {
            return [];
        }

        return [
            PluginsLoadedEvent::class => [
                ['initializeFlex', 10]
            ],
            PermissionsRegisterEvent::class => [
                ['onRegisterPermissions', 100]
            ],
            FlexRegisterEvent::class => [
                ['onRegisterFlex', 100]
            ],
            'onCliInitialize' => [
                ['autoload', 100000],
                ['initializeFlex', 10]
            ],
            'onPluginsInitialized' => [
                ['onPluginsInitialized', 0],
            ],
            'onFormRegisterTypes' => [
                ['onFormRegisterTypes', 0]
            ]
        ];
    }

    /**
     * Get list of form field types specified in this plugin. Only special types needs to be listed.
     *
     * @return array
     */
    public function getFormFieldTypes()
    {
        return [
            'list' => [
                'array' => true
            ],
            'pagemedia' => [
                'array' => true,
                'media_field' => true,
                'validate' => [
                    'type' => 'ignore'
                ]
            ],
            'filepicker' => [
                'media_picker_field' => true
            ],
        ];
    }

    /**
     * @return ClassLoader
     */
    public function autoload(): ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    /**
     * [PluginsLoadedEvent:10]: Initialize Flex
     *
     * @return void
     */
    public function initializeFlex(): void
    {
        $config = $this->config->get('plugins.flex-objects.directories') ?? [];

        // Add to DI container
        $this->grav['flex_objects'] = static function (Grav $grav) use ($config) {
            /** @var FlexInterface $flex */
            $flex = $grav['flex'];

            $flexObjects = new Flex($flex, $config);

            // This event is for backwards compatibility only, do not use it!
            $grav->fireEvent('onFlexInit', new Event(['flex' => $flexObjects]));

            return $flexObjects;
        };
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function onPluginsInitialized(): void
    {
        if ($this->isAdmin()) {
            /** @var UserInterface|null $user */
            $user = $this->grav['user'] ?? null;

            if (null === $user || !$user->authorize('login', 'admin')) {
                return;
            }

            $this->enable([
                'onAdminTwigTemplatePaths' => [
                    ['onAdminTwigTemplatePaths', 10]
                ],
                'onAdminMenu' => [
                    ['onAdminMenu', 0]
                ],
                'onAdminPage' => [
                    ['onAdminPage', 0]
                ],
                'onAdminCompilePresetSCSS' => [
                    ['onAdminCompilePresetSCSS', 0]
                ],
                'onDataTypeExcludeFromDataManagerPluginHook' => [
                    ['onDataTypeExcludeFromDataManagerPluginHook', 0]
                ],
                'onAdminControllerInit' => [
                    ['onAdminControllerInit', 0]
                ],
                'onThemeInitialized' => [
                    ['onThemeInitialized', 0]
                ],
                'onPageInitialized' => [
                    ['onAdminPageInitialized', 0]
                ],
                'onTwigSiteVariables' => [
                    ['onTwigAdminVariables', 0]
                ],
                'onGetPageTemplates' =>
                    ['onGetPageTemplates', 0]

            ]);

        } else {
            $this->enable([
                'onTwigTemplatePaths' => [
                    ['onTwigTemplatePaths', 0]
                ],
                'onPagesInitialized' => [
                    ['onPagesInitialized', -10000]
                ],
                'onPageInitialized' => [
                    ['authorizePage', 10000]
                ],
                'onBeforeFlexFormInitialize' => [
                    ['onBeforeFlexFormInitialize', -10]
                ],
                'onPageTask' => [
                    ['onPageTask', -10]
                ],
            ]);
        }
    }

    /**
     * @param FlexRegisterEvent $event
     * @return void
     */
    public function onRegisterFlex(FlexRegisterEvent $event): void
    {
        /** @var \Grav\Framework\Flex\Flex $flex */
        $flex = $event->flex;
        $types = (array)$this->config->get('plugins.flex-objects.directories', []);
        $this->registerDirectories($flex, $types);
    }

    /**
     * @return void
     */
    public function onThemeInitialized(): void
    {
        // Register directories defined in the theme.
        /** @var \Grav\Framework\Flex\Flex $flex */
        $flex = $this->grav['flex'];
        $types = (array)$this->config->get('plugins.flex-objects.directories', []);
        $this->registerDirectories($flex, $types, true);

        $this->controller = new AdminController();

        /** @var Debugger $debugger */
        $debugger = Grav::instance()['debugger'];
        $names = implode(', ', array_keys($flex->getDirectories()));
        $debugger->addMessage(sprintf('Registered flex types: %s', $names), 'debug');
    }

    /**
     * @param Event $event
     */
    public function onBeforeFlexFormInitialize(Event $event): void
    {
        /** @var array $form */
        $form = $event['form'];
        $edit = $form['actions']['edit'] ?? false;
        if (!isset($form['flex']['key']) && $edit === true) {
            /** @var Route $route */
            $route = $this->grav['route'];
            $id = $route->getGravParam('id');
            if (null !== $id) {
                $form['flex']['key'] = $id;
                $event['form'] = $form;
            }
        }
    }

    /**
     * [onPagesInitialized:-10000] Default router for flex pages.
     *
     * @param Event $event
     */
    public function onPagesInitialized(Event $event): void
    {
        /** @var Route|null $route */
        $route = $event['route'] ?? null;
        if (null === $route) {
            // Stop if in CLI.
            return;
        }

        /** @var PageInterface|null $page */
        $page = $this->grav['page'] ?? null;

        $base = '';
        $path = [];
        if (!$page->routable() || $page->template() === 'notfound') {
            /** @var Pages $pages */
            $pages = $this->grav['pages'];

            // Find first existing and routable parent page.
            $parts = explode('/', $route->getRoute());
            array_shift($parts);
            $page = null;
            while (!$page && $parts) {
                $path[] = array_pop($parts);
                $base = '/' . implode('/', $parts);
                $page = $pages->find($base);
                if ($page && !$page->routable()) {
                    $page = null;
                }
            }
        }

        // If page is found, check if it contains flex directory router.
        if ($page) {
            $flex = $this->grav['flex'];
            $options = $page->header()->flex ?? null;
            $router = $options['router'] ?? null;
            $type = $options['directory'] ?? null;
            $directory = $type ? $flex->getDirectory($type) : null;
            if (\is_string($router)) {
                $path = implode('/', array_reverse($path));
                $response = null;
                $flexEvent = new Event([
                    'flex' => $flex,
                    'directory' => $directory,
                    'parent' => $page,
                    'page' => $page,
                    'base' => $base,
                    'path' => $path,
                    'route' => $route,
                    'options' => $options,
                    'request' => $event['request'],
                    'response' => &$response,
                ]);
                $flexEvent = $this->grav->fireEvent("flex.router.{$router}", $flexEvent);
                if ($response) {
                    $this->grav->close($response);
                }

                /** @var PageInterface|null $routedPage */
                $routedPage = $flexEvent['page'];
                if ($routedPage) {
                    /** @var Debugger $debugger */
                    $debugger = Grav::instance()['debugger'];
                    $debugger->addMessage(sprintf('Flex uses page %s', $routedPage->route()));

                    unset($this->grav['page']);
                    $this->grav['page'] = $routedPage;
                    $event->stopPropagation();
                }
            }
        }
    }

    /**
     * [onPageInitialized:10000] Authorize Flex Objects Page
     *
     * @param Event $event
     */
    public function authorizePage(Event $event): void
    {
        /** @var PageInterface|null $page */
        $page = $event['page'];
        if (!$page instanceof PageInterface) {
            return;
        }

        $header = $page->header();
        $forms = $page->getForms();

        // Update dynamic flex forms from the page.
        $form = null;
        foreach ($forms as $name => $test) {
            $type = $form['type'] ?? null;
            if ($type === 'flex') {
                $form = $test;

                // Update the form and add it back to the page.
                $this->grav->fireEvent('onBeforeFlexFormInitialize', new Event(['page' => $page, 'name' => $name, 'form' => &$form]));
                $page->addForms([$form], true);
            }
        }

        // Make sure the page contains flex.
        $config = $header->flex ?? null;
        if (!is_array($config) && !$form) {
            return;
        }

        /** @var Route $route */
        $route = $this->grav['route'];

        $type = $form['flex']['type'] ?? $config['directory'] ?? $route->getGravParam('directory') ?? null;
        $key = $form['flex']['key'] ?? $config['id'] ?? $route->getGravParam('id') ?? '';
        if (\is_string($type)) {
            /** @var Flex $flex */
            $flex = $this->grav['flex_objects'];
            $directory = $flex->getDirectory($type);
        } else {
            $directory = null;
        }

        if (!$directory) {
            return;
        }

        $create = (bool)($form['actions']['create'] ?? false);
        $edit = (bool)($form['actions']['edit'] ?? false);

        $scope = $config['access']['scope'] ?? null;

        $object = $key !== '' ? $directory->getObject($key) : null;
        $hasAccess = null;

        $action = $config['access']['action'] ?? null;
        if (null === $action) {
            if (!$form) {
                $action = $key !== '' ? 'read' : 'list';
                if (null === $scope) {
                    $hasAccess = true;
                }
            } elseif ($object) {
                if ($edit) {
                    $scope = $scope ?? 'admin';
                    $action = 'update';
                } else {
                    $hasAccess = false;
                }
            } elseif ($create) {
                $object = $directory->createObject([], $key);
                $scope = $scope ?? 'admin';
                $action = 'create';
            } else {
                $hasAccess = false;
            }
        }

        if ($action && $hasAccess === null) {
            if ($object instanceof FlexAuthorizeInterface) {
                $hasAccess = $object->isAuthorized($action, $scope);
            } else {
                $hasAccess = $directory->isAuthorized($action, $scope);
            }
        }

        if (!$hasAccess) {
            // Hide the page (404).
            $page->routable(false);
            $page->visible(false);

            // If page is not a module, replace the current page with unauthorized page.
            if (!$page->isModule()) {
                $login = $this->grav['login'] ?? null;
                $unauthorized = $login ? $login->addPage('unauthorized') : null;
                if ($unauthorized) {
                    unset($this->grav['page']);
                    $this->grav['page'] = $unauthorized;
                }
            }
        } elseif ($config['access']['override'] ?? false) {
            // Override page access settings (allow).
            $page->modifyHeader('access', []);
        }
    }

    /**
     * @param Event $event
     */
    public function onPageTask(Event $event): void
    {
        /** @var FormInterface|null $form */
        $form = $event['form'] ?? null;
        if (!$form instanceof FlexForm) {
            return;
        }

        $object = $form->getObject();

        /** @var ServerRequestInterface $request */
        $request = $event['request'];
        $request = $request
            ->withAttribute('type', $object->getFlexType())
            ->withAttribute('key', $object->getKey())
            ->withAttribute('object', $object)
            ->withAttribute('form', $form);

        $controller = new ObjectController();

        $response = $controller->handle($request);
        if ($response->getStatusCode() !== 418) {
            $this->grav->close($response);
        }
    }

    /**
     * @param \Grav\Framework\Flex\Flex $flex
     * @param array $types
     * @param bool $report
     */
    protected function registerDirectories(\Grav\Framework\Flex\Flex $flex, array $types, bool $report = false): void
    {
        $map = Flex::getLegacyBlueprintMap(false);
        foreach ($types as $blueprint) {
            // Backwards compatibility to v1.0.0-rc.3
            $blueprint = $map[$blueprint] ?? $blueprint;
            $type = Utils::basename((string)$blueprint, '.yaml');
            if (!$type) {
                continue;
            }

            if (!file_exists($blueprint)) {
                if ($report) {
                    /** @var Debugger $debugger */
                    $debugger = Grav::instance()['debugger'];
                    $debugger->addMessage(sprintf('Flex: blueprint for flex type %s is missing', $type), 'error');
                }

                continue;
            }

            $directory = $flex->getDirectory($type);
            if (!$directory || !$directory->isEnabled()) {
                $flex->addDirectoryType($type, $blueprint);
            }
        }
    }

    /**
     * Initial stab at registering permissions (WIP)
     *
     * @param PermissionsRegisterEvent $event
     * @return void
     */
    public function onRegisterPermissions(PermissionsRegisterEvent $event): void
    {
        /** @var Flex $flex */
        $flex = $this->grav['flex_objects'];
        $directories = $flex->getDirectories();

        $permissions = $event->permissions;

        $actions = [];
        foreach ($directories as $directory) {
            $data = $directory->getConfig('admin.permissions', []);
            $actions[] = PermissionsReader::fromArray($data, $permissions->getTypes());

        }
        $actions[] = PermissionsReader::fromYaml("plugin://{$this->name}/permissions.yaml");

        $permissions->addActions(array_replace(...$actions));
    }

    /**
     * @param Event $event
     * @return void
     */
    public function onFormRegisterTypes(Event $event): void
    {
        /** @var Forms $forms */
        $forms = $event['forms'];
        $forms->registerType('flex', new FlexFormFactory());
    }

    /**
     * @param Event $event
     * @return void
     */
    public function onAdminPage(Event $event): void
    {
        if ($this->controller->isActive()) {
            $event->stopPropagation();

            /** @var PageInterface $page */
            $page = $event['page'];
            $page->init(new \SplFileInfo(__DIR__ . '/admin/pages/flex-objects.md'));
            $page->slug($this->controller->getLocation());
            $header = $page->header();
            $header->access = ['admin.login'];
            $header->controller = $this->controller->getInfo();
        }
    }

    /**
     * [onPageInitialized:0]: Run controller
     *
     * @return void
     */
    public function onAdminPageInitialized(): void
    {
        if ($this->controller->isActive()) {
            $this->controller->execute();
            $this->controller->redirect();
        }
    }

    /**
     * @param Event $event
     * @return void
     */
    public function onAdminControllerInit(Event $event): void
    {
        $eventController = $event['controller'];

        // Blacklist all admin routes, including aliases and redirects.
        $eventController->blacklist_views[] = 'flex-objects';
        foreach ($this->controller->getAdminRoutes() as $route => $info) {
            $eventController->blacklist_views[] = trim($route, '/');
        }
    }

    /**
     * Add Flex-Object's preset.scss to the Admin Preset SCSS compile process
     *
     * @param Event $event
     * @return void
     */
    public function onAdminCompilePresetSCSS(Event $event): void
    {
        $event['scss']->add($this->grav['locator']->findResource('plugins://flex-objects/scss/_preset.scss'));
    }

    /**
     * @param Event $event
     * @return void
     */
    public function onGetPageTemplates(Event $event): void
    {
        /** @var Types $types */
        $types = $event->types;
        $types->register('flex-objects', 'plugins://flex-objects/blueprints/pages/flex-objects.yaml');
    }

    /**
     * Form select options listing all enabled directories.
     *
     * @return array
     */
    public static function directoryOptions(): array
    {
        /** @var Flex $flex */
        $flex = Grav::instance()['flex_objects'];
        $directories = $flex->getDirectories();

        $list = [];
        /**
         * @var string $type
         * @var FlexDirectory $directory
         */
        foreach ($directories as $type => $directory) {
            if (!$directory->getConfig('site.hidden')) {
                $list[$type] = $directory->getTitle();
            }
        }

        return $list;
    }

    /**
     * @return array
     */
    public function getAdminMenu(): array
    {
        /** @var Flex $flex */
        $flex = $this->grav['flex_objects'];

        $list = [];
        foreach ($flex->getAdminMenuItems() as $name => $item) {
            $route = trim($item['route'] ?? $name, '/');
            $list[$route] = $item;
        }

        return $list;
    }

    /**
     * Add Flex Directory to admin menu
     *
     * @return void
     */
    public function onAdminMenu(): void
    {
        /** @var Flex $flex */
        $flex = $this->grav['flex_objects'];
        /** @var Admin $admin */
        $admin = $this->grav['admin'];

        foreach ($this->getAdminMenu() as $route => $item) {
            $directory = null;
            if (isset($item['directory'])) {
                $directory = $flex->getDirectory($item['directory']);
                if (!$directory || !$directory->isEnabled()) {
                    continue;
                }
            }

            $title = $item['title'] ?? 'PLUGIN_FLEX_OBJECTS.TITLE';
            $index = $item['index'] ?? 0;
            if (($this->grav['twig']->plugins_hooked_nav[$title]['index'] ?? 1000) <= $index) {
                continue;
            }

            $location = $item['location'] ?? $route;
            $hidden = $item['hidden'] ?? false;
            $icon = $item['icon'] ?? 'fa-list';
            $authorize = $item['authorize'] ?? ($directory ? null : ['admin.flex-objects', 'admin.super']);
            if ($hidden || (null === $authorize && $directory->isAuthorized('list', 'admin', $admin->user))) {
                continue;
            }
            $cache = $directory ? $directory->getCache('index') : null;
            $count = $cache ? $cache->get('admin-count-' . md5($admin->user->username)) : false;
            if (null === $count) {
                try {
                    $collection = $directory->getCollection();
                    if (is_callable([$collection, 'isAuthorized'])) {
                        $count = $collection->isAuthorized('list', 'admin', $admin->user)->count();
                    } else {
                        $count = $collection->count();
                    }
                    $cache->set('admin-count-' . md5($admin->user->username), $count);
                } catch (\InvalidArgumentException $e) {
                    continue;
                }
            }
            $badge = $directory ? ['badge' => ['count' => $count]] : [];
            $priority = $item['priority'] ?? 0;

            $this->grav['twig']->plugins_hooked_nav[$title] = [
                'location' => $location,
                'route' => $route,
                'index' => $index,
                'icon' => $icon,
                'authorize' => $authorize,
                'priority' => $priority
            ] + $badge;
        }
    }

    /**
     * Exclude Flex Directory data from the Data Manager plugin
     *
     * @return void
     */
    public function onDataTypeExcludeFromDataManagerPluginHook(): void
    {
        $this->grav['admin']->dataTypesExcludedFromDataManagerPlugin[] = 'flex-objects';
    }

    /**
     * Add current directory to twig lookup paths.
     *
     * @return void
     */
    public function onTwigTemplatePaths(): void
    {
        $extra_site_twig_path = $this->config->get('plugins.flex-objects.extra_site_twig_path');
        $extra_path = $extra_site_twig_path ? $this->grav['locator']->findResource($extra_site_twig_path) : null;
        if ($extra_path) {
            $this->grav['twig']->twig_paths[] = $extra_path;
        }

        $this->grav['twig']->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * Add plugin templates path
     *
     * @param Event $event
     * @return void
     */
    public function onAdminTwigTemplatePaths(Event $event): void
    {
        $extra_admin_twig_path = $this->config->get('plugins.flex-objects.extra_admin_twig_path');
        $extra_path = $extra_admin_twig_path ? $this->grav['locator']->findResource($extra_admin_twig_path) : null;

        $paths = $event['paths'];
        if ($extra_path) {
            $paths[] = $extra_path;
        }

        $paths[] = __DIR__ . '/admin/templates';
        $event['paths'] = $paths;
    }

    /**
     * Set needed variables to display directory.
     *
     * @return void
     */
    public function onTwigAdminVariables(): void
    {
        if ($this->controller->isActive()) {
            // Twig shortcuts
            $this->grav['twig']->twig_vars['controller'] = $this->controller;
            $this->grav['twig']->twig_vars['action'] = $this->controller->getAction();
            $this->grav['twig']->twig_vars['task'] = $this->controller->getTask();
            $this->grav['twig']->twig_vars['target'] = $this->controller->getTarget();
            $this->grav['twig']->twig_vars['key'] = $this->controller->getId();

            $this->grav['twig']->twig_vars['flex'] = $this->grav['flex_objects'];
            $this->grav['twig']->twig_vars['directory'] = $this->controller->getDirectory();
            $this->grav['twig']->twig_vars['collection'] = $this->controller->getCollection();
            $this->grav['twig']->twig_vars['object'] = $this->controller->getObject();

            // CSS / JS Assets
            $this->grav['assets']->addCss('plugin://flex-objects/css/admin.css');
            $this->grav['assets']->addCss('plugin://admin/themes/grav/css/codemirror/codemirror.css');
        }
    }
}
