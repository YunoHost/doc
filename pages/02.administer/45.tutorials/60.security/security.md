---
title: Security
template: docs
taxonomy:
    category: docs
routes:
  default: '/security'
---

YunoHost has been developed to provide the best security without too much complication. Every protocol used in YunoHost is **encrypted**, only a password's hashes are stored and by default each user is able to access their personal directory only.

Two things remain important to note:

* Installing additional apps can **significantly increase** the number of potential security flaws. Do not hesitate to get information about security flaws **before installing an app**, and try to only install apps which will suit your needs.

* The fact that YunoHost is a well-known and used piece of software increases the chances of an attack. If a flaw is discovered, it could potentially affect all YunoHost instances at once. Keep your system **up-to-date** to remain safe. Updates can be automated by installing the ["Unattended_upgrades" app](https://install-app.yunohost.org/?app=unattended_upgrades).

!!!! If you need advice, do not hesitate to [ask us](/help).

!! [fa=shield /] To discuss security flaws, contact the [YunoHost security team](/security_team).

---

## Improve security

If your YunoHost server is used in a critical production environment, or if you want to improve its safety, you may want to follow these good practices.

! **WARNING:** Following these instructions requires advanced knowledge of system administration.

!!!! **TIP** Never close your current SSH connection before checking that your alterations work. Test your new configuration by opening a new terminal or window. That way, you can undo your alterations if anything goes wrong.

### SSH authentication via key

By default, the SSH authentication uses the administration password. Deactivating this kind of authentication and replacing it by a key mechanism is advised.

**On your client**:

```bash
ssh-keygen
ssh-copy-id -i ~/.ssh/id_rsa.pub <username@your_yunohost_server>
```

!!! If you run into permissions issues, set `username` as owner of the dir `~/.ssh` with `chown`. Be careful, for security reasons this directory should be in mode `700`.

!!! If you are on Ubuntu 16.04 you should run `ssh-add` to initialize the SSH agent.

Type your admnistration password and your key will be copied onto your server.

**On your server**, editing the SSH configuration file to deactivate password authentication is handled by a system setting:

```bash
sudo yunohost settings set security.ssh.password_authentication -v no
```
---

### Modify the SSH port

To prevent SSH connection attempts by robots that scan the internet for any server with SSH enabled, you can change the SSH port.
This is handled by a system setting, which takes care of updating the SSH and Fail2Ban configuration.

! If you modify anything in the `/etc/ssh/sshd_config` file, even if only the port, YunoHost will no longer manage this file. For this reason, always use the YunoHost admin tools to make changes to the systems configuration files!

```bash
sudo yunohost settings set security.ssh.port -v <new_ssh_port_number>
```

**For subsequent SSH connections**, you need to add the `-p` option followed by the SSH port number.

**Sample**:

```bash
ssh -p <new_ssh_port_number> admin@<your_yunohost_server>
```

---

### Change cipher compatibility configuration

The default TLS configuration for services tends to offer good compatibility to support old devices. You can tune this policy for specific services like SSH and NGINX. By default, the NGINX configuration follows the [intermediate compatibility recommendation](https://wiki.mozilla.org/Security/Server_Side_TLS#Intermediate_compatibility_.28default.29) from Mozilla. You can choose to switch to the 'modern' configuration which uses more recent security recommendations, but decreases compatibility, which may be an issue for your users and visitors using older devices. More details about compatibility can be found on [this page](https://wiki.mozilla.org/Security/Server_Side_TLS#Modern_compatibility).

Changing the compatibility level is not definitive and can be reverted if it doesn't fit with your environment.

**On your server**, change the policy for NGINX
```bash
sudo yunohost settings set security.nginx.compatibility -v modern
```

**On your server**, change the policy for SSH
```bash
sudo yunohost settings set security.ssh.compatibility -v modern
```

### Disable the YunoHost API

YunoHost administration is accessible through an **HTTP API**, served on the 6787 port by default (only on `localhost`).
It can be used to administer a lot of things on your server, so malicious actors can also use it to damage your server.
The best thing to do, if you know how to use the [command-line interface (CLI)](/commandline), is to deactivate the `yunohost-api` service.

! This will completely disable both YunoHost's API and the web administration panel that relies on it.
! Proceed only if you are comfortable with the command line interface.

```bash
sudo systemctl disable yunohost-api
sudo systemctl stop yunohost-api
```

As `yunohost-api` is now disabled and not running, Diagnosis will report an error and cannot be ignored from the API.
If you want to ignore this error, you can configure YunoHost from the CLI.

```bash
sudo yunohost diagnosis ignore --filter services service=yunohost-api
```
