# Security

YunoHost has been developed to provide the best security without too much complication. Every protocol used in YunoHost are **encrypted**, only password's hashs are stored and by default each user is able to access to his personal directory only.

Two things remain important to note:

* Installing additional apps can **significantly increase** the number of potential security flaws. Do not hesitate to get information about security flaws **before installing an app**, and try to install only apps which will suit your needs.

* The fact that YunoHost is a well-spread software increases the chances of an attack. If a flaw is discovered, it could potentially affect all the YunoHost instances at once. Keep your system **up-to-date** to remain safe.

*If you need advice, do not hesitate to [ask us](/help).*

*To talk about security flaws, contact the [YunoHost security team](/security_team).*

---

## Improve security
If your YunoHost server is used in a critical production environment, or if you want to improve its safety, you may want to follow those good practices.

**Attention:** *Following those instructions requires advanced knowledge of system administration.*

### SSH authentication via key
By default, the SSH authentication uses the administration password. Deactivating this kind of authentication and replacing it by a key mechanism is advised.

**On your client**:

```bash
ssh-keygen
ssh-copy-id -i ~/.ssh/id_rsa.pub <your_yunohost_server>
```

Type your admnistration password and your key will be copied on your server.

**On your server**, edit the SSH configuration file, in order to deactivate the password authentication.

```bash
nano /etc/ssh/sshd_config

# Modify or add the following line
PasswordAuthentication no
```

Save and restart SSH daemon.
```bash
systemctl restart ssh
```
---

### Modify SSH port

To prevent SSH connection attempts by robots that scan the Internet for any servers with SSH accessible, you can change the SSH port.

**On your server**, edit the ssh configuration file, in order to modify SSH port.

```bash
nano /etc/ssh/sshd_config
```
**Search line "Port" and replace** port number (by default 22) by another not used number
```bash
# What ports, IPs and protocols we listen for
Port 22 # to replace by 9777 for example
```

**Open the port** in firewall (you can use `-6` option to deny ipv4 connection)
```bash
yunohost firewall allow TCP 9777
```

Save and restart SSH daemon. Switch over to the new port by restarting SSH.
```bash
systemctl restart ssh
```
Then restart the iptables firewall and close the old port in iptables.

```bash
yunohost firewall reload
yunohost firewall disallow TCP <your_old_ssh_port_number> # port by default 22
```

You also need to give `fail2ban` the new SSH port.

To do that you need to create the configuration file `my_ssh_port.conf` with the command


```bash
nano /etc/fail2ban/jail.d/my_ssh_port.conf
```

and you can fill it with

```bash
[sshd]
port = <your_ssh_port>

[sshd-ddos]
port = <your_ssh_port>
```

Finally you have to restart `fail2ban` in order to apply the new configuration

```bash
systemctl restart fail2ban
```

**For the next SSH connections **, you need to add the `-p` option followed by the SSH port number.

**Sample**:

```bash
ssh -p <new_ssh_port_number> admin@<your_yunohost_server>
```

---

### Change the user authorized to connect via SSH

To avoid multiple forced login attempts to admin by robots, change the authorized user who can connect.

<div class="alert alert-info" markdown="1">
In the case of a key authentication, a brute force attack has no chance of succeeding. This step is not really useful in this case.
</div>

**On your server**, add a user
```bash
sudo adduser user_name
```
Choose a strong password, since this user will be responsible to obtain root privileges.
Add the user to sudo group to allow him/her to perform maintenance tasks that require root privileges.
```bash
sudo adduser user_name sudo
```

Now, change the SSH configuration to allow the new user to connect.
**On your server**, edit the SSH configuration file
```bash
sudo nano /etc/ssh/sshd_config

# Look for the section "Authentication" and add at the end of it:
AllowUsers user_name
```
Only users listed in the AllowUsers directive will then be allowed to connect via SSH, which excludes the admin user.

Save and restart SSH daemon.
```bash
systemctl restart ssh
```
---

### Change cipher compatibility configuration

The default TLS configuration for services tend to offer a good compatibility to support old devices. You can tune this policy for specific services like SSH and NGINX. By default, the NGINX configuration follows the [intermediate compatibility recommendation](https://wiki.mozilla.org/Security/Server_Side_TLS#Intermediate_compatibility_.28default.29) from Mozilla. You can choose to switch to the 'modern' configuration which uses more recent security recommendations, but decreases the compatibility, which may be an issue for your users and visitors using older devices. More details about the compatibility can be found on [this page](https://wiki.mozilla.org/Security/Server_Side_TLS#Modern_compatibility).

Changing the compatibility level is not definitive and can be reverted if it doesn't feet your environment.

**On your server**, change the policy for NGINX
```bash
sudo yunohost settings set security.nginx.compatibility -v modern
```

**On your server**, change the policy for SSH
```bash
sudo yunohost settings set security.ssh.compatibility -v modern
```

### Disable YunoHost API
YunoHost administration is accessible through an **HTTP API**, served on the 6787 port by default (only on `localhost`). It can be used to administrate a lot of things on your server, so malicious actors can also use it to damage your server. The best thing to do, if you know how to use the [command-line interface](/commandline), is to deactivate the `yunohost-api` service.

```bash
sudo systemctl disable yunohost-api
sudo systemctl stop yunohost-api
```

### YunoHost penetration test

Some [pentests](https://en.wikipedia.org/wiki/Penetration_test) have been done on a YunoHost 2.4 instance (french):

- [1) Preparation](https://exadot.fr/blog/2016-07-03-pentest-dune-instance-yunohost-1-preparation)
- [2) The functionning](https://exadot.fr/blog/2016-07-12-pentest-dune-instance-yunohost-2-le-fonctionnement)
- [3) Black Box Audit](https://exadot.fr/blog/2016-08-26-pentest-dune-instance-yunohost-3-audit-en-black-box)
- [4) Grey Box Audit](https://exadot.fr/blog/2016-11-03-pentest-dune-instance-yunohost-4-audit-en-grey-box)
