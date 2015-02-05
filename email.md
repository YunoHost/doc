#Email

YunoHost provides:
* [Postfix](http://www.postfix.org/): a SMTP email server
* [Dovecot](http://www.dovecot.org/): a IMAP and a POP3 email server
* [Amavis](http://amavis.org/): an antispam
* [RoundCube](/apps): a webmail

### Heavy email client
You can access your emails via desktop email clients such as Mozilla Thunderbird or Evolution.

You will need your email address and your password.

**Caution:** your login is your SSO username and not your email address

#####Settings:

`IMAP | 993 | SSL/TLS`

`SMTP | 465 | SSL/TLS`

#### Mozilla Thunderbird

The automatic detection tool of Thunderbird does not work with YunoHost. You will need to setup it manually. To do so, add the account information, then select SSL/TLS for IMAP and SMTP. Afterwards select 'Normal Password' for Authentication and click on 'Advanced Config'. You will need to accept the certificate exceptions for fetching mails and after you send your first mail. Remove dot before domain name.

<img src="https://yunohost.org/images/thunderbird-config.png" width=900>

* [Manage alias mails](https://support.mozilla.org/en-US/kb/configuring-email-aliases)

####For Androïd
[K-9 Mail](https://en.wikipedia.org/wiki/K-9_Mail) application works.

### Migration
Emails can be migrated with [Larch](https://github.com/rgrove/larch/):
* on your client install Larch:
```bash
sudo gem install larch
```
* Proceed to the transfert between two YunoHost servers:
```bash
larch -a -f imaps://serveur_d'origine.org -t imaps://serveur_de_destination.org
```
For other type of tranfers refer you to Larch documentation.

