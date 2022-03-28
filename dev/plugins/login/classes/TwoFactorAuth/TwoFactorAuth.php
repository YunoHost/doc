<?php

/**
 * @package    Grav\Plugin\Login
 *
 * @copyright  Copyright (C) 2014 - 2021 RocketTheme, LLC. All rights reserved.
 * @license    MIT License; see LICENSE file for details.
 */

namespace Grav\Plugin\Login\TwoFactorAuth;

use Grav\Common\Grav;
use Grav\Common\HTTP\Client;
use Grav\Common\Utils;
use RobThree\Auth\TwoFactorAuth as Auth;
use RobThree\Auth\TwoFactorAuthException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

/**
 * Class TwoFactorAuth
 * @package Grav\Plugin\Login\RememberMe
 */
class TwoFactorAuth
{
    protected $twoFa;

    /**
     * TwoFactorAuth constructor.
     * @throws TwoFactorAuthException
     */
    public function __construct()
    {
        $this->twoFa = new Auth('Grav', 6, 30, 'sha1', new BaconQrProvider);
    }

    /**
     * @return Auth
     */
    public function get2FA()
    {
        return $this->twoFa;
    }

    /**
     * @param int $bits
     * @return string
     * @throws TwoFactorAuthException
     */
    public function createSecret($bits = 160)
    {
        return $this->twoFa->createSecret($bits);
    }

    /**
     * @param string $secret
     * @param string $code
     * @return bool
     */
    public function verifyCode($secret, $code)
    {
        if (!$secret || !$code) {
            return false;
        }

        $secret = str_replace(' ', '', $secret);

        return $this->twoFa->verifyCode($secret, $code);
    }

    /**
     * @param string $username
     * @param string $secret
     * @return string
     * @throws TwoFactorAuthException
     */
    public function getQrImageData($username, $secret)
    {
        $label = $username . ':' . Grav::instance()['config']->get('site.title');
        $secret = str_replace(' ', '', $secret);

        return $this->twoFa->getQRCodeImageAsDataUri($label, $secret);
    }

    /**
     * @param string $yubikey_id
     * @param string $otp
     * @return bool
     */
    public function verifyYubikeyOTP(string $yubikey_id, string $otp): bool
    {
        // Quick sanity check
        if (!$yubikey_id || !$otp || !Utils::startsWith($otp, $yubikey_id)) {
            return false;
        }

        $api_url = "https://api.yubico.com/wsapi/2.0/verify?id=1&otp=%s&nonce=%s";
        $client = Client::getClient();

        $url = sprintf($api_url, $otp, Utils::getNonce('yubikey'));

        try {
            $response = $client->request('GET', $url);
            if ($response->getStatusCode() === 200) {
                $content = $response->getContent();
                if (Utils::contains($content, 'status=OK')) {
                    return true;
                }
            }
        } catch (TransportExceptionInterface|ClientExceptionInterface|RedirectionExceptionInterface|ServerExceptionInterface $e) {
            return false;
        }

        return false;
    }
}
