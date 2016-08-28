# Security

YunoHost has been developed to provide the best security without too much complication. Every protocol used in YunoHost are **encrypted**, only password's hash are stored and by default each user is able to access to his personal directory only.

Two things remain important to note:

* Installing additional apps can **increase significantly** the number of potential security flaws. Do not hesitate to get information about them **before using it**, and try to install only those which will suit your needs.

* The fact that YunoHost is a well-spread software increase chances to face an attack. If a flaw is discovered, it could potentially affect all the YunoHost instances at once. Keep your system **up-to-date** to remain safe.

*If you need some advises, do not hesitate to [ask us](/support).*

---

## Improve security
If your YunoHost server is used in a critical production environment, or if you want to improve its safety, you may want to follow those good practices.

**Attention:** *Following those instructions requires advanced knowledges in system administration.*

### SSH authentication via key
By default, the SSH authentication uses the administration password. Deactivation this kind of authentication and replacing it by a key mechanism is advised.

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

---

### Modify SSH port

To prevent SSH connection attempts by robots that scan the Internet for any attempt SSH connections with any server accessible, you can change the SSH port.

**On your server**, edit the ssh configuration file, in order to modify SSH port.

```bash
nano /etc/ssh/sshd_config

# Search line "Port" and remplace port number (by default 22) by another not used number
Port 22 # to replace by 9777 for example
```

Save and restart SSH daemon.

Then restart the iptables firewall and close the old port in iptables.

```bash
yunohost firewall reload
yunohost firewall disallow <your_old_ssh_port_number> # port by default 22
yunohost firewall disallow --ipv6 TCP <your_new_ssh_port_number> # for ipv6
``` 

**For the next SSH connections ** you need to add the `-p` option followed by the SSH port number.

**Sample**:

```bash
ssh -p <new_ssh_port_number> admin@<your_yunohost_server>
``` 

---

### Change the user authorized to connect via SSH

To avoid multiple forcing the admin login attempts by robots, it can possibly change the authorized user to connect.

<div class="alert alert-info" markdown="1">
In the case of a key authentication, brute force has no chance of succeeding. This step is not really useful in this case
</div>

**On your server**, add a user
```bash
sudo adduser user_name
```
Choose a strong password, since it is the user who will be responsible to obtain root privileges.
Add the user to sudo group so just to allow him to perform maintenance tasks that require root privileges.
```bash
sudo adduser user_namesudo
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

---

### Disable YunoHost API
YunoHost administration is accessible through an **HTTP API**, served on the 6787 port by default. It can be used to administrate a lot of things on your server, thus to break many things between malicious hands. The best thing to do, if you know how to use the [command-line interface](/moulinette), is to deactivate the `yunohost-api` service.

```bash
sudo service yunohost-api stop
```

### YunoHost penetration test

Some [pentests](https://en.wikipedia.org/wiki/Penetration_test) have been done on a YunoHost 2.4 instance (french):

- [1) Preparation](https://blog.exadot.fr/2016/07/03/pentest-dune-instance-yunohost-1-preparation)
- [2) The functionning](https://blog.exadot.fr/2016/07/12/pentest-dune-instance-yunohost-2-le-fonctionnement)
- [3) Black Box Audit](https://blog.exadot.fr/2016/08/26/pentest-dune-instance-yunohost-3-audit-en-black-box)
