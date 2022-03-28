<?php

/**
 * @package    Grav\Plugin\Login
 *
 * @copyright  Copyright (C) 2014 - 2021 RocketTheme, LLC. All rights reserved.
 * @license    MIT License; see LICENSE file for details.
 */

namespace Grav\Plugin\Login;

use Birke\Rememberme\Cookie;
use Grav\Common\Config\Config;
use Grav\Common\Data\Data;
use Grav\Common\Debugger;
use Grav\Common\Grav;
use Grav\Common\Language\Language;
use Grav\Common\Language\LanguageCodes;
use Grav\Common\Page\Interfaces\PageInterface;
use Grav\Common\Page\Page;
use Grav\Common\Page\Pages;
use Grav\Common\Session;
use Grav\Common\User\Interfaces\UserCollectionInterface;
use Grav\Common\User\Interfaces\UserInterface;
use Grav\Common\Uri;
use Grav\Common\Utils;
use Grav\Plugin\Email\Utils as EmailUtils;
use Grav\Plugin\Login\Events\UserLoginEvent;
use Grav\Plugin\Login\Invitations\Invitation;
use Grav\Plugin\Login\RememberMe\RememberMe;
use Grav\Plugin\Login\RememberMe\TokenStorage;
use Grav\Plugin\Login\TwoFactorAuth\TwoFactorAuth;

/**
 * Class Login
 * @package Grav\Plugin
 */
class Login
{
    public const DEBUG = 0;

    /** @var Grav */
    protected $grav;

    /** @var Config */
    protected $config;

    /** @var Language $language */
    protected $language;

    /** @var Session */
    protected $session;

    /** @var Uri */
    protected $uri;

    /** @var RememberMe */
    protected $rememberMe;

    /** @var TwoFactorAuth */
    protected $twoFa;

    /** @var RateLimiter[] */
    protected $rateLimiters = [];

    /** @var array  */
    protected $provider_login_templates = [];

    /**
     * Login constructor.
     *
     * @param Grav $grav
     */
    public function __construct(Grav $grav)
    {
        $this->grav = $grav;
        $this->config = $this->grav['config'];
        $this->language = $this->grav['language'];
        $this->session = $this->grav['session'];
        $this->uri = $this->grav['uri'];
    }

    /**
     * @param string $message
     * @param object|array $data
     */
    public static function addDebugMessage(string $message, $data = []): void
    {
        /** @var Debugger $debugger */
        $debugger = Grav::instance()['debugger'];
        $debugger->addMessage($message, 'debug', $data);
    }

    /**
     * Login user.
     *
     * @param array $credentials    Login credentials, eg: ['username' => '', 'password' => '']
     * @param array $options        Login options, eg: ['remember_me' => true]
     * @param array $extra          Example: ['authorize' => 'site.login', 'user' => null], undefined variables get set.
     * @return UserInterface|UserLoginEvent  Returns event if $extra['return_event'] is true.
     */
    public function login(array $credentials, array $options = [], array $extra = [])
    {
        $grav = Grav::instance();

        $eventOptions = [
            'credentials' => $credentials,
            'options' => $options
        ] + $extra;

        // Attempt to authenticate the user.
        $event = new UserLoginEvent($eventOptions);
        $grav->fireEvent('onUserLoginAuthenticate', $event);

        if ($event->isSuccess()) {
            static::DEBUG && static::addDebugMessage('Login onUserLoginAuthenticate: success', $event);

            // Make sure that event didn't mess up with the user authorization.
            $user = $event->getUser();
            $user->authenticated = true;
            $user->authorized = false;

            // Allow plugins to prevent login after successful authentication.
            $event = new UserLoginEvent($event->toArray());
            $grav->fireEvent('onUserLoginAuthorize', $event);
        }

        if ($event->isSuccess()) {
            static::DEBUG && static::addDebugMessage('Login onUserLoginAuthorize: success', $event);

            // User has been logged in, let plugins know.
            $event = new UserLoginEvent($event->toArray());
            $grav->fireEvent('onUserLogin', $event);

            // Make sure that event didn't mess up with the user authorization.
            $user = $event->getUser();
            $user->authenticated = true;
            $user->authorized = !$event->isDelayed();
            if ($user->authorized) {
                $event = new UserLoginEvent($event->toArray());
                $this->grav->fireEvent('onUserLoginAuthorized', $event);
            }
        } else {
            static::DEBUG && static::addDebugMessage('Login failed', $event);

            // Allow plugins to log errors or do other tasks on failure.
            $eventName = $event->getOption('failureEvent') ?? 'onUserLoginFailure';
            $event = new UserLoginEvent($event->toArray());
            $grav->fireEvent($eventName, $event);

            // Make sure that event didn't mess up with the user authorization.
            $user = $event->getUser();
            $user->authenticated = false;
            $user->authorized = false;
        }

        $user = $event->getUser();
        $user->def('language', 'en');

        return !empty($event['return_event']) ? $event : $user;
    }

    /**
     * Logout user.
     *
     * @param array                         $options
     * @param array|UserInterface           $extra      Array of: ['user' => $user, ...] or UserInterface object (deprecated).
     * @return UserInterface|UserLoginEvent Returns event if $extra['return_event'] is true.
     */
    public function logout(array $options = [], $extra = [])
    {
        $grav = Grav::instance();

        if ($extra instanceof UserInterface) {
            user_error(__METHOD__ . '($options, $user) is deprecated since Login Plugin 3.5.0, use logout($options, [\'user\' => $user]) instead', E_USER_DEPRECATED);

            $extra = ['user' => $extra];
        } elseif (isset($extra['user'])) {
            $extra['user'] = $grav['user'];
        }

        $eventOptions = [
            'options' => $options
        ] + $extra;

        $event = new UserLoginEvent($eventOptions);

        // Logout the user.
        $grav->fireEvent('onUserLogout', $event);

        $user = $event->getUser();
        $user->authenticated = false;
        $user->authorized = false;

        return !empty($event['return_event']) ? $event : $user;
    }

    /**
     * Authenticate user.
     *
     * @param array $credentials Form fields.
     * @param array $options
     *
     * @return bool
     * @deprecated Uses the Controller::taskLogin() event
     */
    public function authenticate($credentials, $options = ['remember_me' => true])
    {
        $event = $this->login($credentials, $options, ['return_event' => true]);
        $user = $event['user'];

        $redirect = $event->getRedirect();
        $message = $event->getMessage();
        $messageType = $event->getMessageType();

        if ($user->authenticated && $user->authorized) {
            if (!$message) {
                $message = 'PLUGIN_LOGIN.LOGIN_SUCCESSFUL';
                $messageType = 'info';
            }

            if (!$redirect) {
                $redirect = $this->uri->route();
            }
        }

        if ($message) {
            $this->grav['messages']->add($this->language->translate($message, [$user->language]), $messageType);
        }

        if ($redirect) {
            $this->grav->redirectLangSafe($redirect, $event->getRedirectCode());
        }

        return $user->authenticated && $user->authorized;
    }

    /**
     * Create a new user file
     *
     * @param array $data
     * @param array $files
     *
     * @return UserInterface
     */
    public function register(array $data, array $files = [])
    {
        // Add defaults and mandatory fields.
        $data += [
            'username' => null,
            'email' => null
        ];

        if (!isset($data['groups'])) {
            //Add new user ACL settings
            $groups = (array) $this->config->get('plugins.login.user_registration.groups', []);
            if (\count($groups) > 0) {
                $data['groups'] = $groups;
            }
        }

        if (!isset($data['access'])) {
            $access = (array) $this->config->get('plugins.login.user_registration.access.site', []);
            if (\count($access) > 0) {
                $data['access']['site'] = $access;
            }
        }

        // Validate fields from the form.
        $password = $this->validateField('password1', $data['password'] ?? $data['password1'] ?? null);
        foreach ($data as $key => &$value) {
            $value = $this->validateField($key, $value, $key === 'password2' ? $password : '');
        }
        unset($value);

        /** @var UserCollectionInterface $accounts */
        $accounts = $this->grav['accounts'];

        // Check whether username already exists.
        $username = $data['username'];
        if (!$username || $accounts->find($username, ['username'])->exists()) {
            /** @var Language $language */
            $language = $this->grav['language'];

            throw new \RuntimeException($language->translate(['PLUGIN_LOGIN.USERNAME_NOT_AVAILABLE', $username]));
        }
        // Check whether email already exists.
        $email = $data['email'];
        if (!$email || $accounts->find($email, ['email'])->exists()) {
            /** @var Language $language */
            $language = $this->grav['language'];

            throw new \RuntimeException($language->translate(['PLUGIN_LOGIN.EMAIL_NOT_AVAILABLE', $email]));
        }

        $user = $accounts->load($username);
        $user->update($data, $files);
        if (isset($data['groups'])) {
            $user->groups = $data['groups'];
        }
        if (isset($data['access'])) {
            $user->access = $data['access'];
        }
        $user->save();

        return $user;
    }

    /**
     * @param string $username
     * @param string|null $ip
     * @return int Return positive number if rate limited, otherwise return 0.
     */
    public function checkLoginRateLimit(string $username, string $ip = null): int
    {
        $ipKey = $this->getIpKey($ip);
        $rateLimiter = $this->getRateLimiter('login_attempts');
        $rateLimiter->registerRateLimitedAction($ipKey, 'ip')->registerRateLimitedAction($username);

        // Check rate limit for both IP and user, but allow each IP a single try even if user is already rate limited.
        $attempts = \count($rateLimiter->getAttempts($ipKey, 'ip'));
        if ($rateLimiter->isRateLimited($ipKey, 'ip') || ($attempts && $rateLimiter->isRateLimited($username))) {
            return $rateLimiter->getInterval();
        }

        return 0;
    }

    /**
     * @param string $username
     * @param string|null $ip
     */
    public function resetLoginRateLimit(string $username, string $ip = null): void
    {
        $ipKey = $this->getIpKey($ip);
        $rateLimiter = $this->getRateLimiter('login_attempts');
        $rateLimiter->resetRateLimit($ipKey, 'ip')->resetRateLimit($username);
    }

    /**
     * @param string|null $ip
     * @return string
     */
    public function getIpKey(string $ip = null): string
    {
        if (null === $ip) {
            $ip = Uri::ip();
        }
        $isIPv4 = filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
        $ipKey = $isIPv4 ? $ip : Utils::getSubnet($ip, $this->grav['config']->get('plugins.login.ipv6_subnet_size'));

        // Pseudonymization of the IP
        return sha1($ipKey . $this->grav['config']->get('security.salt'));
    }

    /**
     * @param string $type
     * @param mixed  $value
     * @param string $extra
     *
     * @return string
     */
    public function validateField($type, $value, $extra = '')
    {
        switch ($type) {
            case 'user':
            case 'username':
                /** @var Config $config */
                $config = Grav::instance()['config'];
                $username_regex = '/' . $config->get('system.username_regex') . '/';

                $value = \is_string($value) ? trim($value) : '';
                if ($value === '' || !preg_match($username_regex, $value)) {
                    throw new \RuntimeException('Username does not pass the minimum requirements');
                }

                break;

            case 'password':
            case 'password1':
                /** @var Config $config */
                $config = Grav::instance()['config'];
                $pwd_regex = '/' . $config->get('system.pwd_regex') . '/';

                $value = \is_string($value) ? $value : '';
                if ($value === '' || !preg_match($pwd_regex, $value)) {
                    throw new \RuntimeException('Password does not pass the minimum requirements');
                }

                break;

            case 'password2':
                $value = \is_string($value) ? $value : '';
                if ($value === '' || $value !== $extra) {
                    throw new \RuntimeException('Passwords did not match.');
                }

                break;

            case 'email':
                $value = \is_string($value) ? trim($value) : '';
                if ($value === '' || !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    throw new \RuntimeException('Not a valid email address');
                }

                break;

            case 'permissions':
                if (!\in_array($value, ['a', 's', 'b'], true)) {
                    throw new \RuntimeException('Permissions ' . $value . ' are invalid.');
                }

                break;

            case 'state':
                if ($value !== 'enabled' && $value !== 'disabled') {
                    throw new \RuntimeException('State is not valid');
                }

                break;

            case 'language':
                $languages = new LanguageCodes();
                if ($value !== null && !array_key_exists($value, $languages->getList())) {
                    throw new \RuntimeException('Language code is not valid');
                }

                break;
        }

        return $value;
    }

    /**
     * Handle the email to notify the user account creation to the site admin.
     *
     * @param UserInterface $user
     *
     * @return bool True if the action was performed.
     * @throws \RuntimeException
     */
    public function sendNotificationEmail(UserInterface $user)
    {
        if (empty($user->email)) {
            throw new \RuntimeException($this->language->translate('PLUGIN_LOGIN.USER_NEEDS_EMAIL_FIELD'));
        }

        $site_name = $this->config->get('site.title', 'Website');

        $subject = $this->language->translate(['PLUGIN_LOGIN.NOTIFICATION_EMAIL_SUBJECT', $site_name]);
        $content = $this->language->translate([
            'PLUGIN_LOGIN.NOTIFICATION_EMAIL_BODY',
            $site_name,
            $user->username,
            $user->email,
            $this->grav['base_url_absolute'],
        ]);
        $to = $this->config->get('plugins.email.to');

        if (empty($to)) {
            throw new \RuntimeException($this->language->translate('PLUGIN_LOGIN.EMAIL_NOT_CONFIGURED'));
        }

        $sent = EmailUtils::sendEmail($subject, $content, $to);

        if ($sent < 1) {
            throw new \RuntimeException($this->language->translate('PLUGIN_LOGIN.EMAIL_SENDING_FAILURE'));
        }

        return true;
    }

    /**
     * Handle the email to welcome the new user
     *
     * @param UserInterface $user
     *
     * @return bool True if the action was performed.
     * @throws \RuntimeException
     */
    public function sendWelcomeEmail(UserInterface $user)
    {
        if (empty($user->email)) {
            throw new \RuntimeException($this->language->translate('PLUGIN_LOGIN.USER_NEEDS_EMAIL_FIELD'));
        }

        $site_name = $this->config->get('site.title', 'Website');
        $author = $this->grav['config']->get('site.author.name', '');
        $fullname = $user->fullname ?: $user->username;

        $subject = $this->language->translate(['PLUGIN_LOGIN.WELCOME_EMAIL_SUBJECT', $site_name]);
        $content = $this->language->translate(['PLUGIN_LOGIN.WELCOME_EMAIL_BODY',
            $fullname,
            $this->grav['base_url_absolute'],
            $site_name,
            $author
        ]);
        $to = $user->email;

        $sent = EmailUtils::sendEmail($subject, $content, $to);

        if ($sent < 1) {
            throw new \RuntimeException($this->language->translate('PLUGIN_LOGIN.EMAIL_SENDING_FAILURE'));
        }

        return true;
    }

    /**
     * Handle the email to activate the user account.
     *
     * @param UserInterface $user
     *
     * @return bool True if the action was performed.
     * @throws \RuntimeException
     */
    public function sendActivationEmail(UserInterface $user)
    {
        if (empty($user->email)) {
            throw new \RuntimeException($this->language->translate('PLUGIN_LOGIN.USER_NEEDS_EMAIL_FIELD'));
        }

        $token = md5(uniqid(mt_rand(), true));
        $expire = time() + 604800; // next week
        $user->activation_token = $token . '::' . $expire;
        $user->save();

        $param_sep = $this->config->get('system.param_sep', ':');
        $activationRoute = $this->getRoute('activate');
        if (!$activationRoute) {
            throw new \RuntimeException('User activation route does not exist!');
        }

        /** @var Pages $pages */
        $pages = $this->grav['pages'];
        $activationLink = $pages->url($activationRoute . '/token' . $param_sep . $token . '/username' . $param_sep . $user->username, null, true);

        $site_name = $this->config->get('site.title', 'Website');
        $author = $this->grav['config']->get('site.author.name', '');
        $fullname = $user->fullname ?: $user->username;

        $subject = $this->language->translate(['PLUGIN_LOGIN.ACTIVATION_EMAIL_SUBJECT', $site_name]);
        $content = $this->language->translate(['PLUGIN_LOGIN.ACTIVATION_EMAIL_BODY',
            $fullname,
            $activationLink,
            $site_name,
            $author
        ]);
        $to = $user->email;
        $sent = EmailUtils::sendEmail($subject, $content, $to);

        if ($sent < 1) {
            throw new \RuntimeException($this->language->translate('PLUGIN_LOGIN.EMAIL_SENDING_FAILURE'));
        }

        return true;
    }

    /**
     * Handle the email to invite user.
     *
     * @param Invitation $invitation
     * @param string|null $message
     * @param UserInterface|null $user
     * @return bool True if the action was performed.
     * @throws \RuntimeException
     */
    public function sendInviteEmail(Invitation $invitation, string $message = null, UserInterface $user = null)
    {
        /** @var UserInterface $user */
        $user = $user ?? $this->grav['user'];

        $param_sep = $this->config->get('system.param_sep', ':');
        $inviteRoute = $this->getRoute('register', true);
        if (!$inviteRoute) {
            throw new \RuntimeException('User registration route does not exist!');
        }

        /** @var Pages $pages */
        $pages = $this->grav['pages'];
        $invitationLink = $pages->url("{$inviteRoute}/{$param_sep}{$invitation->token}", null, true);

        $siteName = $this->config->get('site.title', 'Website');

        $subject = $this->language->translate(['PLUGIN_LOGIN.INVITATION_EMAIL_SUBJECT', $siteName]);
        $message = $message ?? (string)$this->language->translate(['PLUGIN_LOGIN.INVITATION_EMAIL_MESSAGE']);
        $content = $this->language->translate(['PLUGIN_LOGIN.INVITATION_EMAIL_BODY',
            $siteName,
            $message,
            $invitationLink,
            $user->fullname
        ]);
        $to = $invitation->email;
        $sent = EmailUtils::sendEmail($subject, $content, $to);

        if ($sent < 1) {
            throw new \RuntimeException($this->language->translate('PLUGIN_LOGIN.EMAIL_SENDING_FAILURE'));
        }

        return true;
    }

    /**
     * Gets and sets the RememberMe class
     *
     * @param  mixed $var A rememberMe instance to set
     *
     * @return RememberMe Returns the current rememberMe instance
     * @throws \InvalidArgumentException
     */
    public function rememberMe($var = null)
    {
        if ($var !== null) {
            $this->rememberMe = $var;
        }

        if (!$this->rememberMe) {
            /** @var Config $config */
            $config = $this->grav['config'];
            $cookieName = $config->get('plugins.login.rememberme.name');
            $timeout = $config->get('plugins.login.rememberme.timeout');

            // Setup storage for RememberMe cookies
            $storage = new TokenStorage('user-data://rememberme', $timeout);
            $this->rememberMe = new RememberMe($storage);
            $this->rememberMe->setCookieName($cookieName);
            $this->rememberMe->setExpireTime($timeout);

            // Hardening cookies with user-agent and random salt or
            // fallback to use system based cache key
            $server_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
            $data = $server_agent . $config->get('security.salt', $this->grav['cache']->getKey());
            $this->rememberMe->setSalt(hash('sha512', $data));

            // Set cookie with correct base path of Grav install
            $cookie = new Cookie;
            $cookie->setPath($this->grav['base_url_relative'] ?: '/');
            $this->rememberMe->setCookie($cookie);
        }

        return $this->rememberMe;
    }

    /**
     * Gets and sets the TwoFactorAuth object
     *
     * @param TwoFactorAuth $var
     * @return TwoFactorAuth
     * @throws \RobThree\Auth\TwoFactorAuthException
     */
    public function twoFactorAuth($var = null)
    {
        if ($var !== null) {
            $this->twoFa = $var;
        }

        if (!$this->twoFa) {
            $this->twoFa = new TwoFactorAuth;
        }

        return $this->twoFa;
    }

    /**
     * @param string $context
     * @param int $maxCount
     * @param int $interval
     * @return RateLimiter
     */
    public function getRateLimiter($context, $maxCount = null, $interval = null)
    {
        if (!isset($this->rateLimiters[$context])) {
            switch ($context) {
                case 'login_attempts':
                    $maxCount = $this->grav['config']->get('plugins.login.max_login_count', 5);
                    $interval = $this->grav['config']->get('plugins.login.max_login_interval', 10);
                    break;
                case 'pw_resets':
                    $maxCount = $this->grav['config']->get('plugins.login.max_pw_resets_count', 2);
                    $interval = $this->grav['config']->get('plugins.login.max_pw_resets_interval', 60);
                    break;
            }
            $this->rateLimiters[$context] = new RateLimiter($context, $maxCount, $interval);
        }

        return $this->rateLimiters[$context];
    }

    /**
     * @param string $type
     * @param string|null $route
     * @param PageInterface|null $page
     * @return PageInterface|null
     */
    public function getPage(string $type, string $route = null, PageInterface $page = null): ?PageInterface
    {
        $route = $route ?? $this->getRoute($type, true);
        if (null === $route) {
            return null;
        }

        if ($page) {
            $page->route($route);
            $page->slug(basename($route));
        } else {
            /** @var Pages $pages */
            $pages = $this->grav['pages'];
            $page = $pages->find($route);
        }
        if (!$page instanceof PageInterface) {
            // Only add login page if it hasn't already been defined.
            $page = new Page();
            $page->init(new \SplFileInfo('plugin://login/pages/' . $type . '.md'));
            $page->route($route);
            $page->slug(basename($route));
        }

        // Login page may not have the correct Cache-Control header set, force no-store for the proxies.
        $cacheControl = $page->cacheControl();
        if (!$cacheControl) {
            $page->cacheControl('private, no-cache, must-revalidate');
        }

        return $page;
    }

    /**
     * Add Login page.
     *
     * @param string $type
     * @param string|null $route Optional route if we want to force-add the page.
     * @param PageInterface|null $page
     * @return PageInterface|null
     */
    public function addPage(string $type, string $route = null, PageInterface $page = null): ?PageInterface
    {
        $page = $this->getPage($type, $route, $page);
        if (null === $page) {
            return null;
        }

        /** @var Pages $pages */
        $pages = $this->grav['pages'];
        $pages->addPage($page, $route);

        return $page;
    }

    /**
     * Get route to a given login page.
     *
     * @param string $type Use one of: login, activate, forgot, reset, profile, unauthorized, after_login, after_logout,
     *                     register, after_registration, after_activation
     * @param bool|null $enabled
     * @return string|null Returns route or null if the route has been disabled.
     */
    public function getRoute(string $type, bool $enabled = null): ?string
    {
        switch ($type) {
            case 'login':
                $route = $this->config->get('plugins.login.route');
                break;
            case 'activate':
            case 'forgot':
            case 'reset':
            case 'profile':
                $route = $this->config->get('plugins.login.route_' . $type);
                break;
            case 'unauthorized':
                $route = $this->config->get('plugins.login.route_' . $type, '/');
                break;
            case 'after_login':
            case 'after_logout':
                $route = $this->config->get('plugins.login.redirect_' . $type);
                if ($route === true) {
                    $route = $this->config->get('plugins.login.route_' . $type);
                }
                break;
            case 'register':
                $enabled = $enabled ?? $this->config->get('plugins.login.user_registration.enabled', false);
                $route = $enabled === true ? $this->config->get('plugins.login.route_' . $type) : null;
                break;
            case 'after_registration':
            case 'after_activation':
                $route = $this->config->get('plugins.login.redirect_' . $type);
                break;
            default:
                $route = null;
        }

        if (!is_string($route) || $route === '') {
            return null;
        }

        return $route;
    }

    /**
     * @param UserInterface $user
     * @param PageInterface $page
     * @param Data|null $config
     * @return bool
     */
    public function isUserAuthorizedForPage(UserInterface $user, PageInterface $page, $config = null)
    {
        $header = $page->header();
        $rules = (array)($header->access ?? []);

        if (!$rules && $config !== null && $config->get('parent_acl')) {
            // If page has no ACL rules, use its parent's rules
            $parent = $page->parent();
            while (!$rules and $parent) {
                $header = $parent->header();
                $rules = (array)($header->access ?? []);
                $parent = $parent->parent();
            }
        }

        // Continue to the page if it has no ACL rules.
        if (!$rules) {
            return true;
        }

        // All protected pages have a private cache-control. This includes pages which are for guests only.
        $cacheControl = $page->cacheControl();
        if (!$cacheControl) {
            $cacheControl = 'private, no-cache, must-revalidate';
        } else {
            // The response is intended for a single user only and must not be stored by a shared cache.
            $cacheControl = str_replace('public', 'private', $cacheControl);
            if (strpos($cacheControl, 'private') === false) {
                $cacheControl = 'private, ' . $cacheControl;
            }
            // The cache will send the request to the origin server for validation before releasing a cached copy.
            if (strpos($cacheControl, 'no-cache') === false) {
                $cacheControl .= ', no-cache';
            }
            // The cache must verify the status of the stale resources before using the copy and expired ones should not be used.
            if (strpos($cacheControl, 'must-revalidate') === false) {
                $cacheControl .= ', must-revalidate';
            }
        }
        $page->cacheControl($cacheControl);

        // Deny access if user has not completed 2FA challenge.
        if ($user->authenticated && !$user->authorized) {
            return false;
        }

        // Continue to the page if user is authorized to access the page.
        foreach ($rules as $rule => $value) {
            if (is_int($rule)) {
                if ($user->authorize($value) === true) {
                    return true;
                }
            } elseif (\is_array($value)) {
                foreach ($value as $nested_rule => $nested_value) {
                    if ($user->authorize($rule . '.' . $nested_rule) === Utils::isPositive($nested_value)) {
                        return true;
                    }
                }
            } elseif ($user->authorize($rule) === Utils::isPositive($value)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if user may use password reset functionality.
     *
     * @param UserInterface $user
     * @param string        $field
     * @param int           $count
     * @param int           $interval
     * @return bool
     * @deprecated 2.5.0 Use $grav['login']->getRateLimiter($context) instead. See Grav\Plugin\Login\RateLimiter class.
     */
    public function isUserRateLimited(UserInterface $user, $field, $count, $interval)
    {
        if ($count > 0) {
            if (!isset($user->{$field})) {
                $user->{$field} = [];
            }
            //remove older than $interval x minute attempts
            $actual_resets = [];
            foreach ((array)$user->{$field} as $reset) {
                if ($reset > (time() - $interval * 60)) {
                    $actual_resets[] = $reset;
                }
            }

            if (\count($actual_resets) >= $count) {
                return true;
            }
            $actual_resets[] = time(); // current reset
            $user->{$field} = $actual_resets;

        }
        return false;
    }

    /**
     * Reset the rate limit counter.
     *
     * @param UserInterface $user
     * @param string        $field
     * @deprecated 2.5.0 Use $grav['login']->getRateLimiter($context) instead. See Grav\Plugin\Login\RateLimiter class.
     */
    public function resetRateLimit(UserInterface $user, $field)
    {
        $user->{$field} = [];
    }

    /**
     * Get Current logged in user
     *
     * @return UserInterface
     * @deprecated 2.5.0 Use $grav['user'] instead.
     */
    public function getUser()
    {
        /** @var UserInterface $user */
        return $this->grav['user'];
    }

    public function addProviderLoginTemplate($template)
    {
        $this->provider_login_templates[] = $template;
    }

    public function getProviderLoginTemplates()
    {
        return $this->provider_login_templates;
    }
}
