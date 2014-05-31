#Email

YunoHost provide:
* [Postfix](http://www.postfix.org/): a SMTP email server
* [Dovecot](http://www.dovecot.org/): a IMAP and a POP3 email server
* [Amavis](http://amavis.org/): an antispam
* [RoundCube](/apps): a webmail

###Heavy email client
You can acces to your emails throud an heavy email client such as Mozilla Thunderbird or Évolution.

You will need the domain name, the user and it’s password.

Settings:

IMAP  993  SSL/TLS

SMTP  465  SSL/TLS

###Migration

You will need to move the folder /val/mail/ to your new server YunoHost.
