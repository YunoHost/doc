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

### mbsync/isync

[isync site](https://isync.sourceforge.io/)

The names isync (the project) and mbsync (the program) are about the same 'thing'

The program is available in the Debian repositories. Install by: 
```bash
sudo apt install isync
```

To run mbsync, a configuration file in your home directory is needed. Then run:
```bash
mbsync -a
```

A configuration file for syncing two IMAP mailboxes looks like:
```
# old account
## account access definition
IMAPAccount friendly_name      # free format
Host imap.domain.tld           # the old/existing mailserver
User email_address@domain.tld  # your credentials for that server
Pass secret_password           # 
SSLType IMAPS                  # probably IMAPS
CertificateFile /etc/ssl/certs/ca-certificates.crt

## mbsync account/data reference
IMAPStore friendly_name  # free format, easy when identical
Account friendly_name    # has to match IMAPAccount above


# new account
## account access definition
IMAPAccount yuno      # again, give it a recognizable name
Host mydomain.tld     # the new Yunohost mailserver 
User my_yuno_user     # your Yunohost SSO username 
Pass password         # and pass 
SSLType IMAPS         # IMAPS for Yunohost
CertificateFile /etc/ssl/certs/ca-certificates.crt 

## mbsync account/data reference 
IMAPStore yuno    # again, free to choose, both yuno is easy
Account yuno      # again, has to match the name above

# synchronization definition 
Channel oldmail2yuno   # give this combination of settings a name 
Master :friendly_name: # the IMAPStore-name where the old mail is 
Slave :yuno:           # the IMAPStore-name of your new Yunohost 
Patterns *             # probably you want everything ...
CopyArrivalDate yes    # ... with the original date 
Create Slave           # if folder/mail does not exist, create it on Yunohost 
Expunge None           # don't throw things away 
Sync All               # without sync it would not be so useful
# this directory needs to exist; mkdir manually in advance
Syncstate /home/my_yuno_user/.mbsync_state/   # mkdir `name` has to match this setting, of course 

```
