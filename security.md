# Security

YunoHost has been developed to provide the best security without too much complication. Every protocol used in YunoHost are **encrypted**, only password's hash are stored and by default each user is able to access to his personal directory only.

Two things remain important to note:

* Installing additional apps can **increase significantly** the number of potential security flaws. Do not hesitate to get information about them **before using it**, and try to install only those which will suit your needs.

* The fact that YunoHost is a well-spread software increase chances to face an attack. If a flaw is discovered, it could potentially affect all the YunoHost instances at once. Keep your system **up-to-date** to remain safe.

*If you need some advises, do not hesitate to [ask us](/support).*


## Improve security

If your YunoHost server is used in a critical production environment, or if you want to improve its safety, you may want to follow those good practices.

**Attention :** *Following those instructions requires advanced knowledges in system administration.*

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

### Deactivate YunoHost API

YunoHost administration is accessible through an **HTTP API**, served on the 6787 port by default. It can be used to administrate a lot of things on your server, thus to break many things between malicious hands. The best thing to do, if you know how to use the [command-line interface](/moulinette), is to deactivate the `yunohost-api` service.

```bash
sudo service yunohost-api stop
```

