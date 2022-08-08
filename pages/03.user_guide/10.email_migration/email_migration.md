---
title: Migrating email from an email provider to a YunoHost instance
template: docs
taxonomy:
    category: docs
routes:
  default: '/email_migration'
---

*[Documentation linked to YunoHost email](/email)*.

Migration of emails from one server to another can be done with two recommended tools: ImapSync or Larch.

This tool must be installed on your desktop computer. The transfer method looks at this schema:

**`Old email server −> desktop computer with ImapSync or Larch −> new email server`**

### ImapSync

[ImapSync site](http://imapsync.lamiral.info/)

Install ImapSync on your client computer by following this [guide](http://imapsync.lamiral.info/INSTALL):
```bash
sudo dnf install imapsync # Under Fedora
```
Transfer emails from one server to another:
```bash
imapsync --host1 <domain/IP> --port1 993 --ssl1 --user1 <user> --password1 <password> \
--host2 <domain/IP> --port2 993 --ssl2 --user2 <user> --password2 <password>
```

Note that transfer settings `--port 993` and `--ssl` are specific to YunoHost email server.

### Larch

[Larch site](https://github.com/rgrove/larch/)

After beforehand installed `gem`, install `larch` on your client computer:
```bash
sudo gem install larch
```
Transfer emails from one server to another:
```bash
larch -a -f imaps://serveur_d'origine.org -t imaps://serveur_de_destination.org
```
For other types of transfer refer to [Larch documentation](https://github.com/rgrove/larch#label-Usage).
