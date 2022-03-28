<?php

/**
 * @package    Grav\Plugin\Login
 *
 * @copyright  Copyright (C) 2014 - 2021 RocketTheme, LLC. All rights reserved.
 * @license    MIT License; see LICENSE file for details.
 */

namespace Grav\Plugin;

use Composer\Autoload\ClassLoader;
use Grav\Common\Data\Data;
use Grav\Common\Debugger;
use Grav\Common\Flex\Types\Users\UserObject;
use Grav\Common\Grav;
use Grav\Common\Language\Language;
use Grav\Common\Page\Interfaces\PageInterface;
use Grav\Common\Page\Pages;
use Grav\Common\Plugin;
use Grav\Common\Twig\Twig;
use Grav\Common\User\Interfaces\UserCollectionInterface;
use Grav\Common\User\Interfaces\UserInterface;
use Grav\Common\Utils;
use Grav\Common\Uri;
use Grav\Events\PluginsLoadedEvent;
use Grav\Events\SessionStartEvent;
use Grav\Framework\Flex\Interfaces\FlexCollectionInterface;
use Grav\Framework\Flex\Interfaces\FlexObjectInterface;
use Grav\Framework\Form\Interfaces\FormInterface;
use Grav\Framework\Session\SessionInterface;
use Grav\Plugin\Form\Form;
use Grav\Plugin\Login\Events\UserLoginEvent;
use Grav\Plugin\Login\Invitations\Invitation;
use Grav\Plugin\Login\Invitations\Invitations;
use Grav\Plugin\Login\Login;
use Grav\Plugin\Login\Controller;
use Grav\Plugin\Login\RememberMe\RememberMe;
use RocketTheme\Toolbox\Event\Event;
use RocketTheme\Toolbox\Session\Message;

/**
 * Class LoginPlugin
 * @package Grav\Plugin\Login
 */
class LoginPlugin extends Plugin
{
    const TMP_COOKIE_NAME = 'tmp-message';

    /** @var bool */
    protected $authenticated = true;

    /** @var Login */
    protected $login;

    /** @var bool */
    protected $redirect_to_login;

    /** @var Invitation|null */
    protected $invitation;

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            PluginsLoadedEvent::class   => [['onPluginsLoaded', 10]],
            SessionStartEvent::class    => ['onSessionStart', 0],
            'onPluginsInitialized'      => [['initializeSession', 10000], ['initializeLogin', 1000]],
            'onTask.login.login'        => ['loginController', 0],
            'onTask.login.twofa'        => ['loginController', 0],
            'onTask.login.twofa_cancel' => ['loginController', 0],
            'onTask.login.forgot'       => ['loginController', 0],
            'onTask.login.logout'       => ['loginController', 0],
            'onTask.login.reset'        => ['loginController', 0],
            'onTask.login.regenerate2FASecret' => ['loginController', 0],
            'onPageTask.login.invite'    => ['loginController', 0],
            'onPagesInitialized'        => ['storeReferrerPage', 0],
            'onDisplayErrorPage.401'    => ['onDisplayErrorPage401', -1],
            'onDisplayErrorPage.403'    => ['onDisplayErrorPage403', -1],
            'onPageInitialized'         => [['authorizeLoginPage', 10], ['authorizePage', 0]],
            'onPageFallBackUrl'         => ['authorizeFallBackUrl', 0],
            'onTwigTemplatePaths'       => ['onTwigTemplatePaths', 0],
            'onTwigSiteVariables'       => ['onTwigSiteVariables', -100000],
            'onFormProcessed'           => ['onFormProcessed', 0],
            'onUserLoginAuthenticate'   => [['userLoginAuthenticateRateLimit', 10003], ['userLoginAuthenticateByRegistration', 10002], ['userLoginAuthenticateByRememberMe', 10001], ['userLoginAuthenticateByEmail', 10000], ['userLoginAuthenticate', 0]],
            'onUserLoginAuthorize'      => ['userLoginAuthorize', 0],
            'onUserLoginFailure'        => ['userLoginGuest', 0],
            'onUserLoginGuest'          => ['userLoginGuest', 0],
            'onUserLogin'               => [['userLoginResetRateLimit', 1000], ['userLogin', 10]],
            'onUserLogout'              => ['userLogout', 0],
        ];
    }

    /**
     * Composer autoload.
     *
     * @return ClassLoader
     */
    public function autoload(): ClassLoader
    {
        return require __DIR__ . '/vendor/autoload.php';
    }

    /**
     * [onPluginsLoaded:10] Initialize login service.
     * @throws \RuntimeException
     */
    public function onPluginsLoaded(): void
    {
        // Check to ensure sessions are enabled.
        if (!$this->config->get('system.session.enabled') && !\constant('GRAV_CLI')) {
            throw new \RuntimeException('The Login plugin requires "system.session" to be enabled');
        }

        // Define login service.
        $this->grav['login'] = static function (Grav $c) {
            return new Login($c);
        };
    }

    public function onSessionStart(SessionStartEvent $event): void
    {
        $session = $event->session;

        $user = $session->user ?? null;
        if ($user && $user->exists() && ($this->config()['session_user_sync'] ?? false)) {
            // User is stored into the filesystem.
            if ($user instanceof FlexObjectInterface && version_compare(GRAV_VERSION, '1.7.13', '>=')) {
                $user->refresh(true);
            } else {
                // TODO: remove when removing legacy support.
                /** @var UserCollectionInterface $accounts */
                $accounts = $this->grav['accounts'];
                if ($accounts instanceof FlexCollectionInterface) {
                    /** @var UserObject $stored */
                    $stored = $accounts[$user->username];
                    if (is_callable([$stored, 'refresh'])) {
                        $stored->refresh(true);
                    }
                } else {
                    $stored = $accounts->load($user->username);
                }

                if ($stored && $stored->exists()) {
                    // User still exists, update user object in the session.
                    $user->update($stored->jsonSerialize());
                } else {
                    // User doesn't exist anymore, prepare for session invalidation.
                    $user->state = 'disabled';
                }
            }

            if ($user->state !== 'enabled') {
                // If user isn't enabled, clear all session data and display error.
                $session->invalidate()->start();

                /** @var Message $messages */
                $messages = $this->grav['messages'];
                $messages->add($this->grav['language']->translate('PLUGIN_LOGIN.USER_ACCOUNT_DISABLED'), 'error');
            }
        }
    }

    /**
     * [onPluginsInitialized:10000] Initialize login plugin if path matches.
     * @throws \RuntimeException
     */
    public function initializeSession(): void
    {
        // Check to ensure sessions are enabled.
        if (!$this->config->get('system.session.enabled')) {
            throw new \RuntimeException('The Login plugin requires "system.session" to be enabled');
        }

        // Define current user service.
        $this->grav['user'] = static function (Grav $c) {
            $session = $c['session'];

            if (empty($session->user)) {
                // Try remember me login.
                $session->user = $c['login']->login(
                    ['username' => ''],
                    ['remember_me' => true, 'remember_me_login' => true, 'failureEvent' => 'onUserLoginGuest']
                );
            }

            return $session->user;
        };
    }

    /**
     * [onPluginsInitialized:1000] Initialize login plugin if path matches.
     * @throws \RuntimeException
     */
    public function initializeLogin(): void
    {
        $this->login = $this->grav['login'];

        // Admin has its own login; make sure we're not in admin.
        if ($this->isAdmin()) {
            return;
        }

        $this->enable([
            'onPagesInitialized' => ['pageVisibility', 0],
        ]);

        /** @var Uri $uri */
        $uri = $this->grav['uri'];
        $path = $uri->path();
        $this->redirect_to_login = $this->config->get('plugins.login.redirect_to_login');

        // Register route to login page if it has been set.
        if ($path === $this->login->getRoute('login')) {
            $this->enable([
                'onPagesInitialized' => ['addLoginPage', 0],
            ]);
        } elseif ($path === $this->login->getRoute('forgot')) {
            $this->enable([
                'onPagesInitialized' => ['addForgotPage', 0],
            ]);
        } elseif ($path === $this->login->getRoute('reset')) {
            $this->enable([
                'onPagesInitialized' => ['addResetPage', 0],
            ]);
        } elseif ($path === $this->login->getRoute('register', true)) {
            $this->enable([
                'onPagesInitialized' => ['addRegisterPage', 0],
            ]);
        } elseif ($path === $this->login->getRoute('activate')) {
            $this->enable([
                'onPagesInitialized' => ['handleUserActivation', 0],
            ]);
        } elseif ($path === $this->login->getRoute('profile')) {
            $this->enable([
                'onPagesInitialized' => ['addProfilePage', 0],
            ]);
        }
    }

    /**
     * Optional ability to dynamically set visibility based on page access and page header
     * that states `login.visibility_requires_access: true`
     *
     * Note that this setting may be slow on large sites as it loads all pages into memory for each page load!
     *
     * @param Event $event
     */
    public function pageVisibility(Event $event): void
    {
        if (!$this->config->get('plugins.login.dynamic_page_visibility')) {
            return;
        }

        /** @var Pages $pages */
        $pages = $event['pages'];
        /** @var UserInterface|null $user */
        $user = $this->grav['user'] ?? null;

        // TODO: This is super slow especially with Flex Pages. Better solution is required (on indexing / on load?).
        foreach ($pages->instances() as $page) {
            if ($page && $page->visible()) {
                $header = $page->header();
                $require_access = $header->login['visibility_requires_access'] ?? false;
                if ($require_access === true && isset($header->access)) {
                    $config = $this->mergeConfig($page);
                    $access = $this->login->isUserAuthorizedForPage($user, $page, $config);
                    if ($access === false) {
                        $page->visible(false);
                    }
                }
            }
        }
    }

    /**
     * [onPagesInitialized]
     */
    public function storeReferrerPage(): void
    {
        $invalid_redirect_routes = [
            $this->login->getRoute('login') ?: '/login',
            $this->login->getRoute('register', true) ?: '/register',
            $this->login->getRoute('activate') ?: '/activate_user',
            $this->login->getRoute('forgot') ?: '/forgot_password',
            $this->login->getRoute('reset') ?: '/reset_password',
        ];

        /** @var Uri $uri */
        $uri = $this->grav['uri'];
        $current_route = $uri->route();

        $redirect = $this->login->getRoute('after_login');
        if (!$redirect && !in_array($current_route, $invalid_redirect_routes, true)) {
            // No login redirect set in the configuration; can we redirect to the current page?

            /** @var Pages $pages */
            $pages = $this->grav['pages'];

            $page = $pages->find($current_route);
            if ($page) {
                $header = $page->header();

                $allowed = ($header->login_redirect_here ?? true) === false;
                if ($allowed && $page->routable()) {
                    $redirect = $page->route();
                    foreach ($uri->params(null, true) as $key => $value) {
                        if (!in_array($key, ['task', 'nonce', 'login-nonce', 'logout-nonce'], true)) {
                            $redirect .= $uri->params($key);
                        }
                    }
                }
            }
        } else {
            $redirect = $this->grav['session']->redirect_after_login;
        }

        $this->grav['session']->redirect_after_login = $redirect;
    }

    /**
     * Add Login page
     */
    public function addLoginPage(): void
    {
        $this->login->addPage('login');
    }

    /**
     * Add Login page
     */
    public function addForgotPage(): void
    {
        $this->login->addPage('forgot');
    }

    /**
     * Add Reset page
     */
    public function addResetPage(): void
    {
        /** @var Uri $uri */
        $uri = $this->grav['uri'];

        $token = $uri->param('token');
        $user = $uri->param('user');
        if (!$user || !$token) {
            return;
        }

        $this->login->addPage('reset');
    }

    /**
     * Add Register page
     */
    public function addRegisterPage(): void
    {
        $this->login->addPage('register');
    }

    /**
     * Add Profile page
     */
    public function addProfilePage(): void
    {
        $this->login->addPage('profile');
        $this->storeReferrerPage();
    }


    /**
     * Set Unauthorized page
     */
    public function setUnauthorizedPage(): void
    {
        $page = $this->login->addPage('unauthorized');

        unset($this->grav['page']);
        $this->grav['page'] = $page;
    }

    /**
     * Handle user activation
     * @throws \RuntimeException
     */
    public function handleUserActivation(): void
    {
        /** @var Uri $uri */
        $uri = $this->grav['uri'];

        /** @var Message $messages */
        $messages = $this->grav['messages'];

        /** @var UserCollectionInterface $users */
        $users = $this->grav['accounts'];

        $username = $uri->param('username');

        $token = $uri->param('token');
        $user = $users->load($username);
        if (is_callable([$user, 'refresh'])) {
            $user->refresh(true);
        }

        $redirect_route = $this->config->get('plugins.login.user_registration.redirect_after_activation');
        $redirect_code = null;

        if (empty($user->activation_token)) {
            $message = $this->grav['language']->translate('PLUGIN_LOGIN.INVALID_REQUEST');
            $messages->add($message, 'error');
        } else {
            [$good_token, $expire] = explode('::', $user->activation_token, 2);

            if ($good_token === $token) {
                if (time() > $expire) {
                    $message = $this->grav['language']->translate('PLUGIN_LOGIN.ACTIVATION_LINK_EXPIRED');
                    $messages->add($message, 'error');
                } else {
                    if ($this->config->get('plugins.login.user_registration.options.manually_enable', false)) {
                        $message = $this->grav['language']->translate('PLUGIN_LOGIN.USER_ACTIVATED_SUCCESSFULLY_NOT_ENABLED');
                    } else {
                        $user['state'] = 'enabled';
                        $message = $this->grav['language']->translate('PLUGIN_LOGIN.USER_ACTIVATED_SUCCESSFULLY');
                    }

                    $messages->add($message, 'info');
                    unset($user->activation_token);
                    $user->save();

                    if ($this->config->get('plugins.login.user_registration.options.send_welcome_email', false)) {
                        $this->login->sendWelcomeEmail($user);
                    }
                    if ($this->config->get('plugins.login.user_registration.options.send_notification_email', false)) {
                        $this->login->sendNotificationEmail($user);
                    }

                    if ($this->config->get('plugins.login.user_registration.options.login_after_registration', false)) {
                        $loginEvent = $this->login->login(['username' => $username], ['after_registration' => true], ['user' => $user, 'return_event' => true]);

                        // If there's no activation redirect, get one from login.
                        if (!$redirect_route) {
                            $message = $loginEvent->getMessage();
                            if ($message) {
                                $messages->add($message, $loginEvent->getMessageType());
                            }

                            $redirect_route = $loginEvent->getRedirect();
                            $redirect_code = $loginEvent->getRedirectCode();
                        }
                    }
                    $this->grav->fireEvent('onUserActivated', new Event(['user' => $user]));
                }
            } else {
                $message = $this->grav['language']->translate('PLUGIN_LOGIN.INVALID_REQUEST');
                $messages->add($message, 'error');
            }
        }

        $this->grav->redirectLangSafe($redirect_route ?: '/', $redirect_code);
    }

    /**
     * Initialize login controller
     */
    public function loginController(): void
    {
        /** @var Uri $uri */
        $uri = $this->grav['uri'];
        $task = $_POST['task'] ?? $uri->param('task');
        $task = substr($task, \strlen('login.'));
        $post = !empty($_POST) ? $_POST : [];

        switch ($task) {
            case 'login':
                if (!isset($post['login-form-nonce']) || !Utils::verifyNonce($post['login-form-nonce'], 'login-form')) {
                    $this->grav['messages']->add($this->grav['language']->translate('PLUGIN_LOGIN.ACCESS_DENIED'),
                        'info');
                    $twig = $this->grav['twig'];
                    $twig->twig_vars['notAuthorized'] = true;

                    return;
                }
                break;

            case 'forgot':
                if (!isset($post['forgot-form-nonce']) || !Utils::verifyNonce($post['forgot-form-nonce'], 'forgot-form')) {
                    $this->grav['messages']->add($this->grav['language']->translate('PLUGIN_LOGIN.ACCESS_DENIED'),'info');
                    return;
                }
                break;
        }

        $controller = new Controller($this->grav, $task, $post);
        $controller->execute();
        $controller->redirect();
    }

    /**
     * Authorize the Page fallback url (page media accessed through the page route)
     */
    public function authorizeFallBackUrl(): void
    {
        if ($this->config->get('plugins.login.protect_protected_page_media', false)) {
            $page_url = \dirname($this->grav['uri']->path());
            $page = $this->grav['pages']->find($page_url);
            unset($this->grav['page']);
            $this->grav['page'] = $page;
            $this->authorizePage();
        }
    }

    /**
     * @param Event $event
     */
    public function onDisplayErrorPage401(Event $event): void
    {
        if ($this->isAdmin()) {
            return;
        }

        $event['page'] = $this->login->addPage('login');
        $event->stopPropagation();
    }

    /**
     * @param Event $event
     */
    public function onDisplayErrorPage403(Event $event): void
    {
        if ($this->isAdmin()) {
            return;
        }

        $event['page'] = $this->login->addPage('unauthorized');
        $event->stopPropagation();
    }

    /**
     * [onPageInitialized]
     */
    public function authorizeLoginPage(Event $event): void
    {
        if ($this->isAdmin()) {
            return;
        }

        $page = $event['page'];
        if (!$page instanceof PageInterface) {
            return;
        }

        // Only applies to the page templates defined by login plugin.
        $template = $page->template();
        if (!in_array($template, ['forgot', 'login', 'profile', 'register', 'reset', 'unauthorized'])) {
            return;
        }

        /** @var Uri $uri */
        $uri = $this->grav['uri'];
        $token = $uri->param('');
        if ($token && $template === 'register') {
            // Special register page for invited users.
            $invitation = Invitations::getInstance()->get($token);
            if ($invitation && !$invitation->isExpired()) {
                $this->invitation = $invitation;
                return;
            }
        }

        // Check if the login page is enabled.
        $route = $this->login->getRoute($template);
        if (null === $route) {
            $page->routable(false);
        }
    }

    /**
     * [onPageInitialized] Authorize Page
     */
    public function authorizePage(): void
    {
        if (!$this->authenticated) {
            return;
        }

        /** @var UserInterface $user */
        $user = $this->grav['user'];

        $page = $this->grav['page'] ?? null;
        if (!$page instanceof PageInterface) {
            return;
        }

        $hasAccess = $this->login->isUserAuthorizedForPage($user, $page, $this->mergeConfig($page));
        if ($hasAccess) {
            return;
        }

        // If this is not an HTML page request, simply throw a 403 error
        $uri_extension = $this->grav['uri']->extension('html');
        $supported_types = $this->config->get('media.types');
        if ($uri_extension !== 'html' && array_key_exists($uri_extension, $supported_types)) {
            header('HTTP/1.0 403 Forbidden');
            exit;
        }

        // User is not logged in; redirect to login page.
        $authenticated = $user->authenticated && $user->authorized;
        $login_route = $this->login->getRoute('login');
        if (!$authenticated && $this->redirect_to_login && $login_route) {
            $this->grav->redirectLangSafe($login_route, 302);
        }

        /** @var Twig $twig */
        $twig = $this->grav['twig'];

        // Reset page with login page.
        if (!$authenticated) {
            $this->authenticated = false;

            $login_page = $this->login->addPage('login', $this->login->getRoute('login') ?? '/login');

            unset($this->grav['page']);
            $this->grav['page'] = $login_page;

            $twig->twig_vars['form'] = new Form($login_page);
        } else {
            $twig->twig_vars['notAuthorized'] = true;

            $this->setUnauthorizedPage();
        }
    }

    /**
     * [onTwigTemplatePaths] Add twig paths to plugin templates.
     */
    public function onTwigTemplatePaths(): void
    {
        $twig = $this->grav['twig'];
        $twig->twig_paths[] = __DIR__ . '/templates';
    }

    /**
     * [onTwigSiteVariables] Set all twig variables for generating output.
     */
    public function onTwigSiteVariables(): void
    {
        /** @var Twig $twig */
        $twig = $this->grav['twig'];

        $this->grav->fireEvent('onLoginPage');

        $extension = $this->grav['uri']->extension();
        $extension = $extension ?: 'html';

        if (!$this->authenticated) {
            $twig->template = "login.{$extension}.twig";
        }

        // add CSS for frontend if required
        if (!$this->isAdmin() && $this->config->get('plugins.login.built_in_css')) {
            $this->grav['assets']->add('plugin://login/css/login.css');
        }

        // Handle invitation during the registration.
        if ($this->invitation) {
            /** @var Form $form */
            $form = $twig->twig_vars['form'];
            /** @var Uri $uri */
            $uri = $this->grav['uri'];

            $form->action = $uri->route() . $uri->params();
            $form->setData('email', $this->invitation->email);
        }

        $task = $this->grav['uri']->param('task') ?: ($_POST['task'] ?? '');
        $task = substr($task, \strlen('login.'));
        if ($task === 'reset') {
            $username = $this->grav['uri']->param('user');
            $token = $this->grav['uri']->param('token');

            if (!empty($username) && !empty($token)) {
                $twig->twig_vars['username'] = $username;
                $twig->twig_vars['token'] = $token;
            }
        } elseif ($task === 'login') {
            $twig->twig_vars['username'] = $_POST['username'] ?? '';
        }

        $flashData = $this->grav['session']->getFlashCookieObject(self::TMP_COOKIE_NAME);

        if (isset($flashData->message)) {
            $this->grav['messages']->add($flashData->message, $flashData->status);
        }
    }

    /**
     * Process the user registration, triggered by a registration form
     *
     * @param Form $form
     * @throws \RuntimeException
     */
    private function processUserRegistration(FormInterface $form, Event $event): void
    {
        $language = $this->grav['language'];
        $messages = $this->grav['messages'];

        if (!$this->config->get('plugins.login.enabled')) {
            throw new \RuntimeException($language->translate('PLUGIN_LOGIN.PLUGIN_LOGIN_DISABLED'));
        }

        if (null === $this->invitation && !$this->config->get('plugins.login.user_registration.enabled')) {
            throw new \RuntimeException($language->translate('PLUGIN_LOGIN.USER_REGISTRATION_DISABLED'));
        }

        $form->validate();

        /** @var Data $form_data */
        $form_data = $form->getData();

        /** @var UserCollectionInterface $users */
        $users = $this->grav['accounts'];

        // Check for existing username
        $username = $form_data->get('username');
        $existing_username = $users->find($username, ['username']);
        if ($existing_username->exists()) {
            $this->grav->fireEvent('onFormValidationError', new Event([
                'form'    => $form,
                'message' => $language->translate([
                    'PLUGIN_LOGIN.USERNAME_NOT_AVAILABLE',
                    $username
                ])
            ]));
            $event->stopPropagation();
            return;
        }

        // Check for existing email
        $email    = $form_data->get('email');
        $existing_email = $users->find($email, ['email']);
        if ($existing_email->exists()) {
            $this->grav->fireEvent('onFormValidationError', new Event([
                'form'    => $form,
                'message' => $language->translate([
                    'PLUGIN_LOGIN.EMAIL_NOT_AVAILABLE',
                    $email
                ])
            ]));
            $event->stopPropagation();
            return;
        }

        $data = [];
        $data['username'] = $username;


        // if multiple password fields, check they match and set password field from it
        if ($this->config->get('plugins.login.user_registration.options.validate_password1_and_password2',
            false)
        ) {
            if ($form_data->get('password1') !== $form_data->get('password2')) {
                $this->grav->fireEvent('onFormValidationError', new Event([
                    'form'    => $form,
                    'message' => $language->translate('PLUGIN_LOGIN.PASSWORDS_DO_NOT_MATCH')
                ]));
                $event->stopPropagation();

                return;
            }
            $data['password'] = $form_data->get('password1');
        }

        $fields = (array)$this->config->get('plugins.login.user_registration.fields', []);

        foreach ($fields as $field) {
            // Process value of field if set in the page process.register_user
            $default_values = (array)$this->config->get('plugins.login.user_registration.default_values');
            if ($default_values) {
                foreach ($default_values as $key => $param) {

                    if ($key === $field) {
                        if (\is_array($param)) {
                            $values = explode(',', $param);
                        } else {
                            $values = $param;
                        }
                        $data[$field] = $values;
                    }
                }
            }

            if (!isset($data[$field]) && $form_data->get($field)) {
                $data[$field] = $form_data->get($field);
            }
        }

        if ($this->config->get('plugins.login.user_registration.options.set_user_disabled', false)) {
            $data['state'] = 'disabled';
        } else {
            $data['state'] = 'enabled';
        }
        if ($this->invitation) {
            $data += $this->invitation->account;
        }
        $data_object = (object) $data;
        $this->grav->fireEvent('onUserLoginRegisterData', new Event(['data' => &$data_object]));

        $flash = $form->getFlash();
        $user = $this->login->register((array)$data_object, $flash->getFilesByFields(true));
        if ($user instanceof FlexObjectInterface) {
            $flash->clearFiles();
            $flash->save();
        }

        // Remove invitation after it has been used.
        if ($this->invitation) {
            $invitations = Invitations::getInstance();
            $invitations->remove($this->invitation);
            $invitations->save();
            $this->invitation = null;
        }

        $this->grav->fireEvent('onUserLoginRegisteredUser', new Event(['user' => &$user]));

        $fullname = $user->fullname ?? $user->username;

        if ($this->config->get('plugins.login.user_registration.options.send_activation_email', false)) {
            $this->login->sendActivationEmail($user);
            $message = $language->translate(['PLUGIN_LOGIN.ACTIVATION_NOTICE_MSG', $fullname]);
            $messages->add($message, 'info');
        } else {
            if ($this->config->get('plugins.login.user_registration.options.send_welcome_email', false)) {
                $this->login->sendWelcomeEmail($user);
            }
            if ($this->config->get('plugins.login.user_registration.options.send_notification_email', false)) {
                $this->login->sendNotificationEmail($user);
            }
            $message = $language->translate(['PLUGIN_LOGIN.WELCOME_NOTICE_MSG', $fullname]);
            $messages->add($message, 'info');
        }

        $this->grav->fireEvent('onUserLoginRegistered', new Event(['user' => $user]));

        $redirect = $this->config->get('plugins.login.user_registration.redirect_after_registration');
        $redirect_code = null;

        if (isset($user['state']) && $user['state'] === 'enabled' && $this->config->get('plugins.login.user_registration.options.login_after_registration', false)) {
            $loginEvent = $this->login->login(['username' => $user->username], ['after_registration' => true], ['user' => $user, 'return_event' => true]);

            // If there's no registration redirect, get one from login.
            if (!$redirect) {
                $message = $loginEvent->getMessage();
                if ($message) {
                    $messages->add($message, $loginEvent->getMessageType());
                }

                $redirect = $loginEvent->getRedirect();
                $redirect_code = $loginEvent->getRedirectCode();
            }
        }

        if ($redirect) {
            $event['redirect'] = $redirect;
            $event['redirect_code'] = $redirect_code;
        }
    }

    /**
     * Save user profile information
     *
     * @param Form $form
     * @param Event $event
     * @return bool
     */
    private function processUserProfile(FormInterface $form, Event $event): bool
    {
        /** @var UserInterface $user */
        $user     = $this->grav['user'];
        $language = $this->grav['language'];

        $form->validate();

        /** @var Data $form_data */
        $form_data = $form->getData();

        // Don't save if user doesn't exist
        if (!$user->exists()) {
            $this->grav->fireEvent('onFormValidationError', new Event([
                'form'    => $form,
                'message' => $language->translate('PLUGIN_LOGIN.USER_IS_REMOTE_ONLY')
            ]));
            $event->stopPropagation();
            return false;
        }

        // Stop overloading of username
        $username = $form->data('username');
        if (isset($username)) {
            $this->grav->fireEvent('onFormValidationError', new Event([
                'form'    => $form,
                'message' => $language->translate([
                    'PLUGIN_LOGIN.USERNAME_NOT_AVAILABLE',
                    $username
                ])
            ]));
            $event->stopPropagation();
            return false;
        }

        /** @var UserCollectionInterface $users */
        $users = $this->grav['accounts'];

        // Check for existing email
        $email = $form->getData('email');
        $existing_email = $users->find($email, ['email']);
        if ($user->username !== $existing_email->username && $existing_email->exists()) {
            $this->grav->fireEvent('onFormValidationError', new Event([
                'form'    => $form,
                'message' => $language->translate([
                    'PLUGIN_LOGIN.EMAIL_NOT_AVAILABLE',
                    $email
                ])
            ]));
            $event->stopPropagation();
            return false;
        }

        $fields = (array)$this->config->get('plugins.login.user_registration.fields', []);

        $data = [];
        foreach ($fields as $field) {
            $data_field = $form_data->get($field);
            if (!isset($data[$field]) && isset($data_field)) {
                $data[$field] = $form_data->get($field);
            }
        }

        try {
            $flash = $form->getFlash();
            $user->update($data, $flash->getFilesByFields(true));
            $user->save();

            if ($user instanceof FlexObjectInterface) {
                $flash->clearFiles();
                $flash->save();
            }
        } catch (\Exception $e) {
            $form->setMessage($e->getMessage(), 'error');
            return false;
        }

        return true;
    }

    /**
     * [onFormProcessed] Process a registration form. Handles the following actions:
     *
     * - register_user: registers a user
     * - update_user: updates user profile
     *
     * @param Event $event
     * @throws \RuntimeException
     */
    public function onFormProcessed(Event $event): void
    {
        $form = $event['form'];
        $action = $event['action'];

        switch ($action) {
            case 'register_user':
                $this->processUserRegistration($form, $event);
                break;
            case 'update_user':
                $this->processUserProfile($form, $event);
                break;
        }
    }

    /**
     * @param UserLoginEvent $event
     * @throws \RuntimeException
     */
    public function userLoginAuthenticateRateLimit(UserLoginEvent $event): void
    {
        // Check that we're logging in with rate limit turned on.
        if (!$event->getOption('rate_limit')) {
            return;
        }

        $credentials = $event->getCredentials();
        $username = $credentials['username'];

        // Check rate limit for both IP and user, but allow each IP a single try even if user is already rate limited.
        if ($interval = $this->login->checkLoginRateLimit($username)) {
            /** @var Language $t */
            $t = $this->grav['language'];

            $event->setMessage($t->translate(['PLUGIN_LOGIN.TOO_MANY_LOGIN_ATTEMPTS', $interval]), 'error');
            $event->setRedirect($this->login->getRoute('login') ?? '/');
            $event->setStatus(UserLoginEvent::AUTHENTICATION_CANCELLED);
            $event->stopPropagation();
        }
    }

    /**
     * @param UserLoginEvent $event
     * @throws \RuntimeException
     */
    public function userLoginAuthenticateByRegistration(UserLoginEvent $event): void
    {
        // Check that we're logging in after registration.
        if (!$event->getOption('after_registration') || $this->isAdmin()) {
            return;
        }

        $event->setStatus($event::AUTHENTICATION_SUCCESS);
        $event->stopPropagation();
    }

    /**
     * @param UserLoginEvent $event
     * @throws \RuntimeException
     */
    public function userLoginAuthenticateByRememberMe(UserLoginEvent $event): void
    {
        // Check that we're logging in with remember me.
        if (!$event->getOption('remember_me_login') || !$event->getOption('remember_me') || $this->isAdmin()) {
            return;
        }

        // Only use remember me if user isn't set and feature is enabled.
        if ($this->grav['config']->get('plugins.login.rememberme.enabled') && !$event->getUser()->exists()) {
            /** @var Debugger $debugger */
            $debugger = $this->grav['debugger'];

            /** @var RememberMe $rememberMe */
            $rememberMe = $this->grav['login']->rememberMe();
            $username = $rememberMe->login();

            if ($rememberMe->loginTokenWasInvalid()) {
                // Token was invalid. We will display error page as this was likely an attack.
                $debugger->addMessage('Remember Me: Stolen token!');

                throw new \RuntimeException($this->grav['language']->translate('PLUGIN_LOGIN.REMEMBER_ME_STOLEN_COOKIE'), 403);
            }

            if ($username === false) {
                // User has not been remembered, there is no point of continuing.
                $debugger->addMessage('Remember Me: No token matched.');

                $event->setStatus($event::AUTHENTICATION_FAILURE);
                $event->stopPropagation();

                return;
            }

            /** @var UserCollectionInterface $users */
            $users = $this->grav['accounts'];

            // Allow remember me to work with different login methods.
            $user = $users->load($username);
            if (is_callable([$user, 'refresh'])) {
                $user->refresh(true);
            }

            $event->setCredential('username', $username);
            $event->setUser($user);

            if (!$user->exists()) {
                $debugger->addMessage('Remember Me: User does not exist');

                $event->setStatus($event::AUTHENTICATION_FAILURE);
                $event->stopPropagation();

                return;
            }

            $debugger->addMessage('Remember Me: Authenticated!');

            $event->setStatus($event::AUTHENTICATION_SUCCESS);
            $event->stopPropagation();
        }
    }

    public function userLoginAuthenticateByEmail(UserLoginEvent $event): void
    {
        if (($username = $event->getCredential('username')) && !$event->getUser()->exists()) {
            /** @var UserCollectionInterface $users */
            $users = $this->grav['accounts'];

            $event->setUser($users->find($username));
        }
    }

    public function userLoginAuthenticate(UserLoginEvent $event): void
    {
        $user = $event->getUser();
        $credentials = $event->getCredentials();

        if (!$user->exists()) {
            // Never let non-existing users to pass the authentication.
            // Higher level plugins may override this behavior by stopping propagation.
            $event->setStatus($event::AUTHENTICATION_FAILURE);
            $event->stopPropagation();

            return;
        }

        // Never let empty password to pass the authentication.
        // Higher level plugins may override this behavior by stopping propagation.
        if (empty($credentials['password'])) {
            $event->setStatus($event::AUTHENTICATION_FAILURE);
            $event->stopPropagation();

            return;
        }

        // Try default user authentication. Stop propagation if authentication succeeds.
        if ($user->authenticate($credentials['password'])) {
            $event->setStatus($event::AUTHENTICATION_SUCCESS);
            $event->stopPropagation();

            return;
        }

        // If authentication status is undefined, lower level event handlers may still be able to authenticate user.
    }

    public function userLoginAuthorize(UserLoginEvent $event): void
    {
        // Always block access if authorize defaulting to site.login fails.
        $user = $event->getUser();
        foreach ($event->getAuthorize() as $authorize) {
            if (!$user->authorize($authorize)) {
                if ($user->state !== 'enabled') {
                    $event->setMessage($this->grav['language']->translate('PLUGIN_LOGIN.USER_ACCOUNT_DISABLED'), 'error');
                }
                $event->setStatus($event::AUTHORIZATION_DENIED);
                $event->stopPropagation();

                return;
            }
        }

        if ($event->getOption('twofa') && $user->twofa_enabled && $user->twofa_secret) {
            $event->setStatus($event::AUTHORIZATION_DELAYED);
        }
    }

    public function userLoginGuest(UserLoginEvent $event): void
    {
        /** @var UserCollectionInterface $users */
        $users = $this->grav['accounts'];
        $user = $users->load('');

        $event->setUser($user);
        $this->grav['session']->user = $user;
    }

    public function userLoginResetRateLimit(UserLoginEvent $event): void
    {
        if ($event->getOption('rate_limit')) {
            // Reset user rate limit.
            $user = $event->getUser();
            $this->login->resetLoginRateLimit($user->get('username'));
        }
    }

    public function userLogin(UserLoginEvent $event): void
    {
        /** @var SessionInterface $session */
        $session = $this->grav['session'];

        // Prevent session fixation.
        $session->regenerateId();

        $session->user = $user = $event->getUser();

        if ($event->getOption('remember_me')) {
            /** @var Login $login */
            $login = $this->grav['login'];

            $session->remember_me = (bool)$event->getOption('remember_me_login');

            // If the user wants to be remembered, create Rememberme cookie.
            $username = $user->get('username');
            if ($event->getCredential('rememberme')) {
                $login->rememberMe()->createCookie($username);
            }
        }
    }

    public function userLogout(UserLoginEvent $event): void
    {
        if ($event->getOption('remember_me')) {
            /** @var Login $login */
            $login = $this->grav['login'];

            if (!$login->rememberMe()->login()) {
                $login->rememberMe()->getStorage()->cleanAllTriplets($event->getUser()->get('username'));
            }
            $login->rememberMe()->clearCookie();
        }

        /** @var SessionInterface $session */
        $session = $this->grav['session'];

        // Clear all session data.
        $session->invalidate()->start();
    }

    /**
     * @return string|false
     * @deprecated 3.5.0 Use $grav['login']->getRoute('after_login') instead
     */
    public static function defaultRedirectAfterLogin()
    {
        /** @var Login $login */
        $login = Grav::instance()['login'] ?? null;
        if (null === $login) {
            return '/';
        }

        return $login->getRoute('after_login') ?? false;
    }

    /**
     * @return string|false
     * @deprecated 3.5.0 Use $grav['login']->getRoute('after_logout') instead
     */
    public static function defaultRedirectAfterLogout()
    {
        /** @var Login $login */
        $login = Grav::instance()['login'] ?? null;
        if (null === $login) {
            return '/';
        }

        return $login->getRoute('after_logout') ?? false;
    }
}
