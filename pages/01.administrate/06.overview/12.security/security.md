---
title: Security
template: docs
taxonomy:
    category: docs
routes:
  default: '/security'
---

YunoHost has been developed to provide the best security without too much complication. Every protocol used in YunoHost is **encrypted**, only password's hashes are stored and by default each user is able to access their personal directory only.

Two things remain important to note:

* Installing additional apps can **significantly increase** the number of potential security flaws. Do not hesitate to get information about security flaws **before installing an app**, and try to install only apps which will suit your needs.

* The fact that YunoHost is a well-spread software increases the chances of an attack. If a flaw is discovered, it could potentially affect all the YunoHost instances at once. Keep your system **up-to-date** to remain safe.

!!!! If you need advice, do not hesitate to [ask us](/help).

!! [fa=shield /] To discuss security flaws, contact the [YunoHost security team](/security_team).

---

## Improve security
If your YunoHost server is used in a critical production environment, or if you want to improve its safety, you may want to follow those good practices.

! **Attention:** Following those instructions requires advanced knowledge of system administration.

### SSH authentication via key
By default, the SSH authentication uses the administration password. Deactivating this kind of authentication and replacing it by a key mechanism is advised.

**On your client**:

```bash
ssh-keygen
ssh-copy-id -i ~/.ssh/id_rsa.pub <username@your_yunohost_server>
```
!!! If you meet permissions issues, set `username` as owner of the dir `~/.ssh` with `chown`. Be careful, for security reason this directory should be in mode `700`.

Type your admnistration password and your key will be copied on your server.

**On your server**, edit the SSH configuration file, in order to deactivate the password authentication.

```bash
nano /etc/ssh/sshd_config

# Modify or add the following line
PasswordAuthentication no
```

Save and restart the SSH daemon.
```bash
systemctl restart ssh
```
---

### Modify the SSH port

To prevent SSH connection attempts by robots that scan the Internet for any server with SSH enabled, you can change the SSH port.
This is handled by a system setting, which takes care of updating the SSH and Fail2Ban configuration.

```bash
sudo yunohost settings set security.ssh.port -v <new_ssh_port_number>
```

**For the next SSH connections**, you need to add the `-p` option followed by the SSH port number.

**Sample**:

```bash
ssh -p <new_ssh_port_number> admin@<your_yunohost_server>
```

---

### Change cipher compatibility configuration

The default TLS configuration for services tends to offer good compatibility to support old devices. You can tune this policy for specific services like SSH and NGINX. By default, the NGINX configuration follows the [intermediate compatibility recommendation](https://wiki.mozilla.org/Security/Server_Side_TLS#Intermediate_compatibility_.28default.29) from Mozilla. You can choose to switch to the 'modern' configuration which uses more recent security recommendations, but decreases the compatibility, which may be an issue for your users and visitors using older devices. More details about the compatibility can be found on [this page](https://wiki.mozilla.org/Security/Server_Side_TLS#Modern_compatibility).

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
YunoHost administration is accessible through an **HTTP API**, served on the 6787 port by default (only on `localhost`). It can be used to administer a lot of things on your server, so malicious actors can also use it to damage your server. The best thing to do, if you know how to use the [command-line interface](/commandline), is to deactivate the `yunohost-api` service.

```bash
sudo systemctl disable yunohost-api
sudo systemctl stop yunohost-api
```
