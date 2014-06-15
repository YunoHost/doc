#Email

YunoHost provide:
* [Postfix](http://www.postfix.org/): a SMTP email server
* [Dovecot](http://www.dovecot.org/): a IMAP and a POP3 email server
* [Amavis](http://amavis.org/): an antispam
* [RoundCube](/apps): a webmail

###Heavy email client
You can acces to your emails throud an heavy email client such as Mozilla Thunderbird or Évolution.

You will need your email adress and your password.

#####Settings:

IMAP | 993 | SSL/TLS

SMTP | 465 | SSL/TLS

#### Mozilla Thunderbird

The automatic detection tool of Thunderbird doesn’t works with YunoHost. You will need to do it manually.

###Migration

Your e-mails are saved in the forder /var/mail/.
You will need to move that folder to your new server YunoHost.
