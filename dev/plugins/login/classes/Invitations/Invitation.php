<?php

/**
 * @package    Grav\Plugin\Login
 *
 * @copyright  Copyright (C) 2014 - 2021 RocketTheme, LLC. All rights reserved.
 * @license    MIT License; see LICENSE file for details.
 */

namespace Grav\Plugin\Login\Invitations;

/**
 * Invite users to the site.
 *
 * Tools to send emails for invites and handle invite registrations.
 */
class Invitation
{
    /** @var string */
    public $token;
    /** @var string */
    public $email;
    /** @var string */
    public $created_by;
    /** @var int */
    public $created_timestamp = 0;
    /** @var int */
    public $expiration_timestamp = 0;
    /** @var array */
    public $account = ['access' => ['site' => ['login' => true]]];

    public function __construct(string $token, array $data)
    {
        $this->token = $token;
        $this->email = $data['email'];
        $this->created_by = $data['created_by'];
        $this->created_timestamp = $data['created_timestamp'] ?? time();
        $this->expiration_timestamp = $data['expiration_timestamp'] ?? time() + 86400; // 1 day
        if (isset($data['account'])) {
            $this->account = $data['account'];
        }
    }

    public function isExpired(): bool
    {
        return ($this->expiration_timestamp ?? 0) < time();
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'created_by' => $this->created_by,
            'created_timestamp' => $this->created_timestamp,
            'expiration_timestamp' => $this->expiration_timestamp,
            'account' => $this->account,
        ];
    }
}
