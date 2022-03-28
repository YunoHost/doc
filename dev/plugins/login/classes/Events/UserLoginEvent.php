<?php

/**
 * @package    Grav\Plugin\Login
 *
 * @copyright  Copyright (C) 2014 - 2021 RocketTheme, LLC. All rights reserved.
 * @license    MIT License; see LICENSE file for details.
 */

namespace Grav\Plugin\Login\Events;

use Grav\Common\Grav;
use Grav\Common\Session;
use Grav\Common\User\Interfaces\UserCollectionInterface;
use Grav\Common\User\Interfaces\UserInterface;
use Grav\Framework\Session\SessionInterface;
use Grav\Plugin\Login\Login;
use RocketTheme\Toolbox\Event\Event;

/**
 * Class UserLoginEvent
 * @package Grav\Common\User\Events
 *
 * @property int                $status
 * @property array              $credentials
 * @property string|string[]    $authorize
 * @property array              $options
 * @property Session            $session
 * @property UserInterface      $user
 * @property string             $message
 *
 */
class UserLoginEvent extends Event
{
    /**
     * Undefined event state.
     */
    public const AUTHENTICATION_UNDEFINED = 0;

    /**
     * onUserAuthenticate success.
     */
    public const AUTHENTICATION_SUCCESS = 1;

    /**
     * onUserAuthenticate fails on bad username/password.
     */
    public const AUTHENTICATION_FAILURE = 2;

    /**
     * onUserAuthenticate fails on auth cancellation.
     */
    public const AUTHENTICATION_CANCELLED = 4;

    /**
     * onUserAuthorizeLogin fails on expired account.
     */
    public const AUTHORIZATION_EXPIRED = 8;

    /**
     * onUserAuthorizeLogin is delayed until user has performed AUTHORIZATION_CHALLENGE.
     */
    public const AUTHORIZATION_DELAYED = 16;

    /**
     * onUserAuthorizeLogin fails for other reasons.
     */
    public const AUTHORIZATION_DENIED = 32;

    /**
     * onUserAuthorizeLogin was challenged, combine with AUTHENTICATION_SUCCESS, AUTHENTICATION_FAILURE or AUTHENTICATION_CANCELLED.
     */
    public const AUTHORIZATION_CHALLENGE = 64;

    /**
     * UserLoginEvent constructor.
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        $items += [
            'credentials' => [],
            'options' => [],
            'authorize' => 'site.login',
            'status' => static::AUTHENTICATION_UNDEFINED,
            'session' => null,
            'user' => null,
            'message' => null,
            'redirect' => null,
            'redirect_code' => 303
        ];
        $items['credentials'] += ['username' => '', 'password' => ''];

        parent::__construct($items);

        if (!$this->offsetExists('session') && isset(Grav::instance()['session'])) {
            $this->offsetSet('session', Grav::instance()['session']);
        }
        if (!$this->offsetExists('user')) {
            /** @var UserCollectionInterface $users */
            $users = Grav::instance()['accounts'];
            $user = $users->load($this['credentials']['username']);
            if (is_callable([$user, 'refresh'])) {
                $user->refresh(true);
            }

            $this->offsetSet('user', $user);

            if (Login::DEBUG) {
                if ($user->exists()) {
                    Login::addDebugMessage('Login user:', $user);
                } else {
                    Login::addDebugMessage("Login: user '{$this['credentials']['username']}' not found");
                }
            }

        }
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        $status = $this->offsetGet('status');
        $failure = static::AUTHENTICATION_FAILURE | static::AUTHENTICATION_CANCELLED | static::AUTHORIZATION_EXPIRED
            | static::AUTHORIZATION_DENIED;

        return ($status & static::AUTHENTICATION_SUCCESS) && !($status & $failure);
    }

    /**
     * @return bool
     */
    public function isDelayed(): bool
    {
        return $this->isSuccess() && ($this->offsetGet('status') & static::AUTHORIZATION_DELAYED);
    }

    /**
     * @return bool
     */
    public function isChallenged(): bool
    {
        $status = $this->offsetGet('status');

        return (bool)($status & static::AUTHORIZATION_CHALLENGE);
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return (int)$this->offsetGet('status');
    }

    /**
     * @param int $status
     * @return $this
     */
    public function setStatus($status): self
    {
        $this->offsetSet('status', $this->offsetGet('status') | (int)$status);

        return $this;
    }

    /**
     * @return array
     */
    public function getCredentials(): array
    {
        return $this->offsetGet('credentials') + ['username' => '', 'password' => ''];
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getCredential($name)
    {
        return $this->items['credentials'][$name] ?? null;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function setCredential($name, $value): self
    {
        $this->items['credentials'][$name] = $value;

        return $this;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->offsetGet('options');
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function getOption($name)
    {
        return $this->items['options'][$name] ?? null;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function setOption($name, $value): self
    {
        $this->items['options'][$name] = $value;

        return $this;
    }

    /**
     * @return SessionInterface|Session|null
     */
    public function getSession(): ?SessionInterface
    {
        return $this->offsetGet('session');
    }

    /**
     * @return UserInterface
     */
    public function getUser(): UserInterface
    {
        return $this->offsetGet('user');
    }

    /**
     * @param UserInterface $user
     * @return $this
     */
    public function setUser(UserInterface $user): self
    {
        $this->offsetSet('user', $user);

        return $this;
    }

    /**
     * @return array
     */
    public function getAuthorize(): array
    {
        return (array)$this->offsetGet('authorize');
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return !empty($this->items['message'][0]) ? (string)$this->items['message'][0] : null;
    }

    /**
     * @return string
     */
    public function getMessageType(): string
    {
        return !empty($this->items['message'][1]) ? (string)$this->items['message'][1] : 'info';
    }

    /**
     * @param string $message
     * @param string|null $type
     * @return $this
     */
    public function setMessage($message, $type = null): self
    {
        $this->items['message'] = $message ? [$message, $type] : null;

        return $this;
    }

    /**
     * @param string $message
     * @param string|null $type
     * @return $this
     */
    public function defMessage($message, $type = null): self
    {
        if ($message && !isset($this->items['message'])) {
            $this->setMessage($message, $type);
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRedirect(): ?string
    {
        return $this->items['redirect'] ?? null;
    }

    /**
     * @return int
     */
    public function getRedirectCode(): int
    {
        return (int)($this->items['redirect_code'] ?? 303);
    }

    /**
     * @param string $path
     * @param int $code
     * @return $this
     */
    public function setRedirect($path, $code = 303): self
    {
        $this->items['redirect'] = $path ?: null;
        $this->items['redirect_code'] = (int)$code;

        return $this;
    }

    /**
     * @param string $path
     * @param int $code
     * @return $this
     */
    public function defRedirect($path, $code = 303): self
    {
        if ($path && !isset($this->items['redirect'])) {
            $this->setRedirect($path, $code);
        }

        return $this;
    }

    /**
     * Magic setter method
     *
     * @param mixed $offset Asset name value
     * @param mixed $value  Asset value
     */
    public function __set($offset, $value): void
    {
        $this->offsetSet($offset, $value);
    }

    /**
     * Magic getter method
     *
     * @param  mixed $offset Asset name value
     * @return mixed         Asset value
     */
    public function __get($offset)
    {
        return $this->offsetGet($offset);
    }

    /**
     * Magic method to determine if the attribute is set
     *
     * @param  mixed   $offset Asset name value
     * @return boolean         True if the value is set
     */
    public function __isset($offset): bool
    {
        return $this->offsetExists($offset);
    }

    /**
     * Magic method to unset the attribute
     *
     * @param mixed $offset The name value to unset
     */
    public function __unset($offset): void
    {
        $this->offsetUnset($offset);
    }

    /**
     * @return array
     */
    public function __debugInfo(): array
    {
        return get_object_vars($this);
    }
}
