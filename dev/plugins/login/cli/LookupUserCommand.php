<?php

/**
 * @package    Grav\Plugin\Login
 *
 * @copyright  Copyright (C) 2014 - 2021 RocketTheme, LLC. All rights reserved.
 * @license    MIT License; see LICENSE file for details.
 */

namespace Grav\Plugin\Console;

use Grav\Common\Grav;
use Grav\Common\User\Interfaces\UserCollectionInterface;
use Grav\Common\User\Interfaces\UserInterface;
use Grav\Console\ConsoleCommand;
use Grav\Framework\Flex\FlexObject;
use Grav\Plugin\Login\Login;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class CleanCommand
 *
 * @package Grav\Console\Cli
 */
class LookupUserCommand extends ConsoleCommand
{
    /** @var array */
    protected $options = [];

    /** @var Login */
    protected $login;

    /**
     * Configure the command
     */
    protected function configure()
    {
        $this
            ->setName('lookup-user')
            ->setAliases(['lookup'])
            ->addArgument(
                'key',
                InputArgument::REQUIRED,
                'The username, email, id, or key to lookup'
            )
            ->setDescription('Finds user info based on some data')
            ->setHelp('The <info>lookup-user</info> finds a user based on some data query.')
        ;
    }

    /**
     * @return int|null|void
     */
    protected function serve()
    {
        include __DIR__ . '/../vendor/autoload.php';

        $io = new SymfonyStyle($this->input, $this->output);

        $grav = Grav::instance();
        $grav->setup();

        $io->title('Looking up user');

        // Initialize Plugins
        $grav['plugins']->init();
        $grav->fireEvent('onCliInitialize');

        $key = $this->input->getArgument('key');

        /** @var UserCollectionInterface $users */
        $users = $grav['accounts'];

        /** @var UserInterface $user */
        $user = $users->find($key, ['username', 'email', 'fullname', 'storage_key', 'flex_key']);

        if ($user->exists()) {
            /** @var $io SymfonyStyle */
            $io->text('Username: <green>'. $user->username . '</green>');
            $io->text('Name:     <red>' . $user->fullname . '</red>');
            if ($user instanceof FlexObject) {
                $io->text('Flex Key: <cyan>' . $user->getFlexKey() . '</cyan>');
            }
            $io->text('Email:    <yellow>' . $user->email . '</yellow>');

            $io->newLine();
            exit;
        }


        $io->error('Sorry, the user with query: "' . $key . '", was not found');
    }
}
