---
title: SSH and command line
template: docs
taxonomy:
    category: docs
routes:
  default: '/ssh'
  aliases:
    - '/commandline'
page-toc:
  active: true
---

## What's SSH?

**SSH** stands for Secure Shell, and refers to a protocol that allows to remotely control and administer a machine using the command line interface (CLI). It is available by default in any terminal on GNU/Linux and macOS. On Windows, you may want to use [MobaXterm](https://mobaxterm.mobatek.net/download-home-edition.html) (after launching it, click on Session then SSH).

The command line interface (CLI) is, in the computer world, the original (and more technical) way of interacting with a computer compared to graphical interface. Command line interfaces are generally said to be more complete, powerful or efficient than a graphical interface, though also more difficult to learn.

## What address to use to connect to your server?

If you are **installing at home** (e.g. on a Raspberry Pi or OLinuXino or old computer):
   - you should be able to connect to your server using `yunohost.local`. 
   - if `yunohost.local` does not work, your need to [find out the local IP of the server](/finding_the_local_ip).
   - if you installed a server at home but are attempting to connect from outside your local network, make sure port 22 is correctly forwarded to your server.


If your server is a remote server (VPS), your provider should have communicated you the IP address of the machine

In any cases, if you already configured a domain name pointing to the appropriate IP, it's much better to use `yourdomain.tld` instead of the IP address.


## Login credentials

#### BEFORE running the post-installation

- If you are **installing at home**, the default credentials are login: `root` and password: `yunohost`
- If you are **installing a remote server (VPS)**, your provider should have communicated you the login and password (or allowed you to configure an SSH key)

#### AFTER running the post-installation

During the postinstall, you've been asked to choose an administration password. This password becomes the new password for the `root` and `admin` users. Additionally, **the `root` SSH login becomes disabled after the postinstall and you should log in using the `admin` user !**. The only exception is that you may still be able to login using `root` *from the local network - or from a direct console on the server* (this is to cover the event where the LDAP server is broken and the `admin` user is unusable).


## Connecting

The SSH command typically looks like: 

```bash
# before the postinstall:
ssh root@11.22.33.44

# or after the postinstall:
ssh admin@11.22.33.44
```

Or using the domain name instead of the IP (more convenient): 

```bash
ssh admin@your.domain.tld
# or with the special .local domain:
ssh admin@yunohost.local
```

If you changed the SSH port, you need to add `-p <portnumber>` to the command, e.g.:

```bash
ssh -p 2244 admin@your.domain.tld
```

!!! If you connected as `admin` and would like to become `root` for convenience (e.g. to avoid typing `sudo` in front of every command), you can become `root` using the command `sudo su` or `sudo -i`.

## Which other users may connect to the server?

By default, only the `admin` user can log in to YunoHost SSH server.

YunoHost's users created via the administration interface are managed by the LDAP directory. By default, they can't connect via SSH for security reasons. If you want some users to have SSH access enabled, use the command:

```bash
yunohost user ssh allow <username>
```

It is also possible to remove SSH access using the following:

```bash
yunohost user ssh disallow <username>
```

Finally, it is possible to add, delete and list SSH keys, to improve SSH access security, using the commands:

```bash
yunohost user ssh add-key <username> <key>
yunohost user ssh remove-key <username> <key>
yunohost user ssh list-keys <username>
```

## Security and SSH

N.B. : `fail2ban` will ban your IP for 10 minutes if you perform 5 failed login attempts. If you need to unban the IP, have a look at the page about [Fail2Ban](/fail2ban)

A more extensive discussion about security & SSH can be found on the [dedicated page](/security).

## Yunohost command line

!!! Providing a full tutorial about the command line is quite beyond the scope of the YunoHost documentation : for this, consider reading a dedicated tutorial such as [this one](https://ryanstutorials.net/linuxtutorial/) or [this one](http://linuxcommand.org/). But be reassured that you don't need to be a CLI expert to start using it !

The `yunohost` command can be used to administer your server and perform the various actions similarly to what you do on the webadmin. The command must be launched either from the `root` user or from the `admin` user by preceeding them with `sudo`. (ProTip™ : you can become `root` with the command `sudo su` as `admin`).

YunoHost commands usually have this kind of structure : 

```bash
yunohost app install wordpress --label Webmail
          ^    ^        ^             ^
          |    |        |             |
    category  action  argument      options
```

Don't hesitate to browse and ask for more information about a given category or action using the the `--help` option. For instance, those commands : 

```bash
yunohost --help
yunohost user --help
yunohost user create --help
```

will successively list all the categories available, then the actions available in the `user` category, then the usage of the action `user create`. You might notice that the YunoHost command tree is built with a structure similar to the YunoHost admin pages.
