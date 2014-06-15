#Messagerie électronique

YunoHost fournit :
* [Postfix](http://www.postfix.org/) : un serveur de messagerie électronique SMTP
* [Dovecot](http://www.dovecot.org/) : un serveur de messagerie électronique IMAP et POP3
* [Amavis](http://amavis.org/) : un antispam
* [RoundCube](/apps) : un webmail

###Client lourd de messagerie électronique
Tu peux accéder à tes courriels grâce à un client lourd de messagerie électronique comme Mozilla Thunderbird ou Évolution.

Tu aura besoin de ta principale adresse mail et de ton mot de passe.

Réglages :

IMAP  993  SSL/TLS

SMTP  465  SSL/TLS

####Thunderbird
L'utilitaire de détection automatique de thunderbird ne marche pas correctement avec yunohost donc il faut passer en configuration manuelle

###Migration

Tes courriels sont enregistré dans le fichier /val/mail/.
Tu aura besoin de déplacer ces fichier vers ton nouveau serveur YunoHost.

