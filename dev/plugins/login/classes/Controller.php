<?php

/**
 * @package    Grav\Plugin\Login
 *
 * @copyright  Copyright (C) 2014 - 2021 RocketTheme, LLC. All rights reserved.
 * @license    MIT License; see LICENSE file for details.
 */

namespace Grav\Plugin\Login;

use Grav\Common\Config\Config;
use Grav\Common\Grav;
use Grav\Common\Language\Language;
use Grav\Common\Page\Pages;
use Grav\Common\Uri;
use Grav\Common\User\Interfaces\UserCollectionInterface;
use Grav\Common\User\Interfaces\UserInterface;
use Grav\Common\Utils;
use Grav\Plugin\Email\Utils as EmailUtils;
use Grav\Plugin\Form\Forms;
use Grav\Plugin\Login\Events\UserLoginEvent;
use Grav\Plugin\Login\Invitations\Invitation;
use Grav\Plugin\Login\Invitations\Invitations;
use Grav\Plugin\Login\TwoFactorAuth\TwoFactorAuth;
use Grav\Plugin\LoginPlugin;
use RocketTheme\Toolbox\Event\Event;
use RocketTheme\Toolbox\Session\Message;

/**
 * Class Controller
 * @package Grav\Plugin\Login
 */
class Controller
{
    /**
     * @var Grav
     */
    public $grav;

    /**
     * @var string
     */
    public $action;

    /**
     * @var array
     */
    public $post;

    /**
     * @var string
     */
    protected $redirect;

    /**
     * @var int
     */
    protected $redirectCode;

    /**
     * @var string
     */
    protected $prefix = 'task';

    /**
     * @var Login
     */
    protected $login;

    /**
     * @param Grav   $grav
     * @param string $action
     * @param array  $post
     */
    public function __construct(Grav $grav, $action, $post = null)
    {
        $this->grav = $grav;
        $this->action = $action;
        $this->login = $this->grav['login'];
        $this->post = $post ? $this->getPost($post) : [];
    }

    /**
     * Performs an action.
     * @throws \RuntimeException
     */
    public function execute()
    {
        $messages = $this->grav['messages'];

        // Set redirect if available.
        $redirect = $this->post['_redirect'] ?? null;
        unset($this->post['_redirect']);

        $success = false;
        $method = $this->prefix . ucfirst($this->action);

        if (!method_exists($this, $method)) {
            throw new \RuntimeException('Page Not Found', 404);
        }

        try {
            $success = $this->{$method}();
        } catch (\RuntimeException $e) {
            $messages->add($e->getMessage(), 'error');
            $this->grav['log']->error('plugin.login: '. $e->getMessage());
        }

        if (!$this->redirect && $redirect) {
            $this->setRedirect($redirect, 303);
        }

        return $success;
    }

    /**
     * Handle login.
     *
     * @return bool True if the action was performed.
     */
    public function taskLogin()
    {
        /** @var Language $t */
        $t = $this->grav['language'];

        /** @var Message $messages */
        $messages = $this->grav['messages'];

        // Remove login nonce from the form.
        $form = array_diff_key($this->post, ['login-form-nonce' => true]);

        // Is twofa enabled?
        $twofa = $this->grav['config']->get('plugins.login.twofa_enabled', false);

        // Fire Login process.
        $event = $this->login->login($form, ['rate_limit' => true, 'remember_me' => true, 'twofa' => $twofa], ['return_event' => true]);
        $user = $event->getUser();

        $login_redirect = $this->login->getRoute('after_login');

        if ($user->authenticated) {
            if ($user->authorized) {
                $event->defMessage('PLUGIN_LOGIN.LOGIN_SUCCESSFUL', 'info');

                $event->defRedirect(
                    $this->grav['session']->redirect_after_login ?:
                        $login_redirect ?: $this->grav['uri']->referrer('/', '', true)
                );
            } else {
                $redirect_to_login = $this->grav['config']->get('plugins.login.redirect_to_login');
                $redirect_route = $redirect_to_login ? $this->login->getRoute('login') : null;
                $event->defRedirect($redirect_route ?? $this->grav['uri']->referrer('/', '', true));
            }
        } else {
            if ($user->authorized) {
                $event->defMessage('PLUGIN_LOGIN.ACCESS_DENIED', 'error');

                $event->defRedirect($this->login->getRoute('unauthorized') ?? '/');
            } else {
                $event->defMessage('PLUGIN_LOGIN.LOGIN_FAILED', 'error');
            }
        }

        $message = $event->getMessage();
        if ($message) {
            $messages->add($t->translate($message), $event->getMessageType());
        }

        $redirect = $event->getRedirect();
        if ($redirect) {
            $this->setRedirect($redirect, $event->getRedirectCode());
        }

        return true;
    }

    public function taskTwoFa()
    {
        /** @var Config $config */
        $config = $this->grav['config'];

        /** @var Language $t */
        $t = $this->grav['language'];

        /** @var Message $messages */
        $messages = $this->grav['messages'];
        if (!$config->get('plugins.login.twofa_enabled', false)) {
            $messages->add($t->translate('PLUGIN_LOGIN.2FA_FAILED'),  'error');

            return true;
        }

        $twoFa = $this->login->twoFactorAuth();
        $user = $this->grav['user'];

        $code = $this->post['2fa_code'] ?? null;
        $secret = $user->twofa_secret ?? null;

        $eventOptions = [
            'credentials' => ['username' => $user->get('username')],
            'options' => ['twofa' => true]
        ];

        // Attempt to authenticate the user.
        $event = new UserLoginEvent($eventOptions);
        $event->setUser($user);

        if (!$code || !$secret || !$twoFa->verifyCode($secret, $code)) {
            $event->setStatus(UserLoginEvent::AUTHENTICATION_FAILURE | UserLoginEvent::AUTHORIZATION_CHALLENGE);
            $event->setMessage($t->translate('PLUGIN_LOGIN.2FA_FAILED'),  'error');

            $this->grav->fireEvent('onUserLoginFailure', $event);

            // Make sure that event didn't mess up with the user authorization.
            $user = $event->getUser();
            $user->authenticated = false;
            $user->authorized = false;

            if (!$event->getRedirect()) {
                $redirect_to_login = $this->grav['config']->get('plugins.login.route_to_login');
                $login_route = $this->login->getRoute('login');

                $event->setRedirect(
                    $redirect_to_login && $login_route ? $login_route : $this->getCurrentRedirect(),
                    303
                );
            }
        } else {

            $event->setStatus(UserLoginEvent::AUTHENTICATION_SUCCESS | UserLoginEvent::AUTHORIZATION_CHALLENGE);
            $event->setMessage($t->translate('PLUGIN_LOGIN.LOGIN_SUCCESSFUL'),  'info');

            $this->grav->fireEvent('onUserLoginAuthorized', $event);

            // Make sure that event didn't mess up with the user authorization.
            $user = $event->getUser();
            $user->authenticated = $event->isSuccess();
            $user->authorized = !$event->isDelayed();

            if (!$event->getRedirect()) {
                $login_redirect = $this->login->getRoute('after_login');

                $event->setRedirect(
                    $this->grav['session']->redirect_after_login ?: $login_redirect ?: $this->grav['uri']->referrer('/', '', true),
                    303
                );
            }
        }

        /** @var Message $messages */
        $messages = $this->grav['messages'];
        $messages->add($event->getMessage(), $event->getMessageType());

        $redirect = $event->getRedirect() ?: $this->getCurrentRedirect();
        $this->setRedirect($redirect, $event->getRedirectCode());

        return true;
    }

    public function taskTwofa_cancel()
    {
        /** @var Config $config */
        $config = $this->grav['config'];

        /** @var Language $t */
        $t = $this->grav['language'];

        /** @var Message $messages */
        $messages = $this->grav['messages'];
        if (!$config->get('plugins.login.twofa_enabled', false)) {
            $messages->add($t->translate('PLUGIN_LOGIN.2FA_FAILED'),  'error');

            return true;
        }

        $user = $this->grav['user'];
        $eventOptions = [
            'credentials' => ['username' => $user->get('username')],
            'options' => ['twofa' => true]
        ];

        $event = new UserLoginEvent($eventOptions);

        $event->setStatus(UserLoginEvent::AUTHENTICATION_CANCELLED | UserLoginEvent::AUTHORIZATION_CHALLENGE);
        $event->setMessage($t->translate('PLUGIN_LOGIN.2FA_FAILED'),  'error');

        $this->grav->fireEvent('onUserLoginFailure', $event);

        // Make sure that event didn't mess up with the user authorization.
        $user = $event->getUser();
        $user->authenticated = false;
        $user->authorized = false;

        if (!$event->getRedirect()) {
            $redirect_to_login = $this->grav['config']->get('plugins.login.route_to_login');
            $login_route = $this->login->getRoute('login');

            $event->setRedirect(
                $redirect_to_login && $login_route ? $login_route : $this->getCurrentRedirect(),
                303
            );
        }

        return true;
    }

    /**
     * Handle logout.
     *
     * @return bool True if the action was performed.
     */
    public function taskLogout()
    {
        $event = $this->login->logout(['remember_me' => true], ['return_event' => true]);

        $message = $event->getMessage();
        if ($message) {
            /** @var Language $t */
            $t = $this->grav['language'];

            $messages = $this->grav['messages'];
            $messages->add($t->translate($message), $event->getMessageType());
        }

        $logout_redirect = $this->login->getRoute('after_logout');

        $redirect = $event->getRedirect() ?: $logout_redirect ?: $this->getCurrentRedirect();
        if ($redirect) {
            $this->setRedirect($redirect, $event->getRedirectCode());
        }

        $this->grav['session']->setFlashCookieObject(LoginPlugin::TMP_COOKIE_NAME, ['message' => $this->grav['language']->translate('PLUGIN_LOGIN.LOGGED_OUT'),
            'status' => 'info']);

        return true;
    }

    /**
     * Handle the email password recovery procedure.
     *
     * @return bool True if the action was performed.
     */
    protected function taskForgot()
    {
        /** @var Config $config */
        $config = $this->grav['config'];
        $param_sep = $config->get('system.param_sep', ':');
        $data = $this->post;

        /** @var UserCollectionInterface $users */
        $users = $this->grav['accounts'];

        $email = $data['email'] ?? '';
        $user = !empty($email) ? $users->find($email, ['email']) : null;

        /** @var Language $language */
        $language = $this->grav['language'];
        $messages = $this->grav['messages'];

        if (!isset($this->grav['Email'])) {
            $messages->add($language->translate('PLUGIN_LOGIN.FORGOT_EMAIL_NOT_CONFIGURED'), 'error');
            $this->setRedirect($this->login->getRoute('forgot') ?? '/');

            return true;
        }

        if (!$user || !$user->exists()) {
            $messages->add($language->translate(['PLUGIN_LOGIN.FORGOT_USERNAME_DOES_NOT_EXIST', $email]), 'error');
            $this->setRedirect($this->login->getRoute('forgot') ?? '/');

            return true;
        }

        if (empty($user->email)) {
            $messages->add($language->translate(['PLUGIN_LOGIN.FORGOT_CANNOT_RESET_EMAIL_NO_EMAIL', $email]),
                'error');
            $this->setRedirect($this->login->getRoute('forgot') ?? '/');

            return true;
        }

        if (empty($user->password) && empty($user->hashed_password)) {
            $messages->add($language->translate(['PLUGIN_LOGIN.FORGOT_CANNOT_RESET_EMAIL_NO_PASSWORD', $email]),
                'error');
            $this->setRedirect($this->login->getRoute('forgot') ?? '/');

            return true;
        }

        $from = $config->get('plugins.email.from');

        if (empty($from)) {
            $messages->add($language->translate('PLUGIN_LOGIN.FORGOT_EMAIL_NOT_CONFIGURED'), 'error');
            $this->setRedirect($this->login->getRoute('forgot') ?? '/');

            return true;
        }

        $userKey = $user->username;
        $rateLimiter = $this->login->getRateLimiter('pw_resets');
        $rateLimiter->registerRateLimitedAction($userKey);

        if ($rateLimiter->isRateLimited($userKey)) {
            $messages->add($language->translate(['PLUGIN_LOGIN.FORGOT_CANNOT_RESET_IT_IS_BLOCKED', $email, $rateLimiter->getInterval()]), 'error');
            $this->setRedirect($this->login->getRoute('login') ?? '/');

            return true;
        }

        $token = md5(uniqid(mt_rand(), true));
        $expire = time() + 604800; // next week

        $user->reset = $token . '::' . $expire;
        $user->save();

        $author = $config->get('site.author.name', '');
        $fullname = $user->fullname ?: $user->username;

        $resetRoute = $this->login->getRoute('reset');
        if (!$resetRoute) {
            throw new \RuntimeException('Password reset route does not exist!');
        }

        /** @var Pages $pages */
        $pages = $this->grav['pages'];
        $route = $pages->url($resetRoute, null, true);

        $reset_link = $route . '/task' . $param_sep . 'login.reset/token' . $param_sep . $token . '/user' . $param_sep . $user->username . '/nonce' . $param_sep . Utils::getNonce('reset-form');

        $sitename = $config->get('site.title', 'Website');

        $to = $user->email;

        $subject = $language->translate(['PLUGIN_LOGIN.FORGOT_EMAIL_SUBJECT', $sitename]);
        $content = $language->translate(['PLUGIN_LOGIN.FORGOT_EMAIL_BODY', $fullname, $reset_link, $author, $sitename]);

        $sent = EmailUtils::sendEmail($subject, $content, $to);

        if ($sent < 1) {
            $messages->add($language->translate('PLUGIN_LOGIN.FORGOT_FAILED_TO_EMAIL'), 'error');
        } else {
            $messages->add($language->translate('PLUGIN_LOGIN.FORGOT_INSTRUCTIONS_SENT_VIA_EMAIL'), 'info');
        }

        $this->setRedirect($this->login->getRoute('login') ?? '/');

        return true;
    }

    /**
     * Handle the reset password action.
     *
     * @return bool True if the action was performed.
     * @throws \Exception
     */
    public function taskReset()
    {
        $data = $this->post;
        $language = $this->grav['language'];
        $messages = $this->grav['messages'];

        if (isset($data['password'])) {
            /** @var UserCollectionInterface $users */
            $users = $this->grav['accounts'];

            $username = $data['username'] ?? null;
            $user = !empty($username) ? $users->find($username) : null;
            $password = $data['password'] ?? null;
            $token = $data['token'] ?? null;

            if ($user && !empty($user->reset) && $user->exists()) {
                [$good_token, $expire] = explode('::', $user->reset);

                if ($good_token === $token) {
                    if (time() > $expire) {
                        $messages->add($language->translate('PLUGIN_LOGIN.RESET_LINK_EXPIRED'), 'error');
                        $this->grav->redirectLangSafe($this->login->getRoute('forgot') ?? '/');

                        return true;
                    }

                    unset($user->hashed_password, $user->reset);
                    $user->password = $password;
                    $user->save();

                    $messages->add($language->translate('PLUGIN_LOGIN.RESET_PASSWORD_RESET'), 'info');
                    $this->setRedirect($this->login->getRoute('login') ?? '/');

                    return true;
                }
            }

            $messages->add($language->translate('PLUGIN_LOGIN.RESET_INVALID_LINK'), 'error');
            $this->grav->redirectLangSafe($this->login->getRoute('forgot') ?? '/');

            return true;

        }

        $user = $this->grav['uri']->param('user');
        $token = $this->grav['uri']->param('token');

        if (!$user || !$token) {
            $messages->add($language->translate('PLUGIN_LOGIN.RESET_INVALID_LINK'), 'error');
            $this->grav->redirectLangSafe($this->login->getRoute('forgot') ?? '/');

            return true;
        }

        return true;
    }

    /**
     * @param null $secret
     * @return bool
     */
    public function taskRegenerate2FASecret()
    {
        try {
            /** @var UserInterface $user */
            $user = $this->grav['user'];

            if ($user->exists()) {
                /** @var TwoFactorAuth $twoFa */
                $twoFa = $this->grav['login']->twoFactorAuth();
                $secret = $twoFa->createSecret();
                $image = $twoFa->getQrImageData($user->username, $secret);

                // Change secret in the session.
                $user->twofa_secret = $secret;

                // Save secret into the user file.
                $user->save();

                $json_response = ['status' => 'success', 'image' => $image, 'secret' => trim(preg_replace('|(\w{4})|', '\\1 ', $secret))];
            } else {
                $json_response = ['status' => 'error', 'message' => 'user does not exist'];
            }
        } catch (\Exception $e) {
            $json_response = ['status' => 'error', 'message' => $e->getMessage()];
        }

        // Return JSON
        header('Content-Type: application/json');
        echo json_encode($json_response);
        exit;
    }

    /**
     * @return bool
     */
    public function taskInvite()
    {
        /** @var Forms $forms */
        $forms = $this->grav['forms'] ?? null;
        $form = $forms ? $forms->getActiveForm() : null;

        /** @var Language $t */
        $t = $this->grav['language'];

        if (null === $form) {
            $this->grav->fireEvent('onFormValidationError', new Event([
                'form' => $form,
                'message' => $t->translate("PLUGIN_LOGIN.INVALID_FORM"),
            ]));
            return false;
        }

        $data = $form->getData();
        $emails = $data['emails'] ?? null;
        $emails = array_unique(preg_split('/[\s,;]+/mu', $emails));
        $emails = array_filter($emails, static function ($str) { return $str && filter_var($str, FILTER_VALIDATE_EMAIL); });
        if (!$emails) {
            $this->grav->fireEvent('onFormValidationError', new Event([
                'form' => $form,
                'message' => $t->translate("PLUGIN_LOGIN.INVALID_INVITE_EMAILS"),
            ]));
            return false;
        }
        $message = $data['message'] ?? null;

        $defaults = [
            'expiration' => 86400
        ];
        $invite = (array)($form->getBlueprint()->get('form/meta/invite')) + $defaults;

        /** @var UserInterface $user */
        $user = $this->grav['user'];
        $issuer = $user->email;
        $invitations = Invitations::getInstance();
        $list = [];
        foreach ($emails as $email) {
            $data = [
                'email' => $email,
                'created_by' => $issuer,
                'created_timestamp' => time(),
                'expiration_timestamp' => time() + $invite['expiration'],
                'account' => $invite['account']
            ];

            $invitation = new Invitation($invitations->generateToken(), $data);
            $old = $invitations->getByEmail($email);
            if ($old) {
                $invitations->remove($old);
            }
            $invitations->add($invitation);
            $list[] = $invitation;
        }

        $invitations->save();
        foreach ($list as $invitation) {
            $this->login->sendInviteEmail($invitation, $message, $user);
        }

        return true;
    }

    /**
     * @return string
     */
    protected function getCurrentRedirect()
    {
        /** @var Uri $uri */
        $uri = $this->grav['uri'];
        $redirect = $uri->route();
        foreach ($uri->params(null, true) as $key => $value) {
            if (!in_array($key, ['task', 'nonce', 'login-nonce', 'logout-nonce'], true)) {
                $redirect .= $uri->params($key);
            }
        }

        return $redirect;
    }

    /**
     * Redirects an action
     */
    public function redirect()
    {
        if ($this->redirect) {
            $this->grav->redirectLangSafe($this->redirect, $this->redirectCode);
        }
    }

    /**
     * Set redirect.
     *
     * @param     $path
     * @param int $code
     */
    public function setRedirect($path, $code = 303)
    {
        $this->redirect = $path;
        $this->redirectCode = $code;
    }

    /**
     * @return array Array containing [redirect, code].
     */
    public function getRedirect()
    {
        return [$this->redirect, $this->redirectCode];
    }

    /**
     * Prepare and return POST data.
     *
     * @param array $post
     *
     * @return array
     */
    protected function &getPost(array $post)
    {
        unset($post[$this->prefix]);

        // Decode JSON encoded fields and merge them to data.
        if (isset($post['_json'])) {
            $post = array_merge_recursive($post, $this->jsonDecode($post['_json']));
            unset($post['_json']);
        }

        return $post;
    }

    /**
     * Recursively JSON decode data.
     *
     * @param  array $data
     *
     * @return array
     */
    protected function jsonDecode(array $data)
    {
        foreach ($data as &$value) {
            if (\is_array($value)) {
                $value = $this->jsonDecode($value);
            } else {
                $value = json_decode($value, true);
            }
        }

        return $data;
    }

    /**
     * Gets and sets the RememberMe class
     *
     * @param  mixed $var A rememberMe instance to set
     *
     * @return RememberMe\RememberMe Returns the current rememberMe instance
     * @deprecated 2.5.0 Use $grav['login']->rememberMe() instead
     */
    public function rememberMe($var = null)
    {
        return $this->login->rememberMe($var);
    }

    /**
     * Check if user may use password reset functionality.
     *
     * @param  UserInterface $user
     * @param $field
     * @param $count
     * @param $interval
     * @return bool
     * @deprecated 2.5.0 Use $grav['login']->getRateLimiter($context) instead. See Grav\Plugin\Login\RateLimiter class.
     */
    protected function isUserRateLimited(UserInterface $user, $field, $count, $interval)
    {
        return $this->login->isUserRateLimited($user, $field, $count, $interval);
    }

    /**
     * Reset the rate limit counter
     *
     * @param UserInterface $user
     * @param $field
     * @deprecated 2.5.0 Use $grav['login']->getRateLimiter($context) instead. See Grav\Plugin\Login\RateLimiter class.
     */
    protected function resetRateLimit(UserInterface $user, $field)
    {
        $this->login->resetRateLimit($user, $field);
    }


    /**
     * Authenticate user.
     *
     * @param  array $form Form fields.
     *
     * @return bool
     * @deprecated 2.6.2 Will be removed without replacement.
     */
    protected function authenticate($form)
    {
        // Remove login nonce.
        $form = array_diff_key($form, ['login-form-nonce' => true]);

        return $this->login->login($form, ['remember_me' => true])->authenticated;
    }
}
