#Messagerie électronique

YunoHost fournit :
* [Postfix](http://www.postfix.org/) : un serveur de messagerie électronique SMTP
* [Dovecot](http://www.dovecot.org/) : un serveur de messagerie électronique IMAP et POP3
* [Amavis](http://amavis.org/) : un antispam
* [RoundCube](/apps) : un webmail

###Client lourd de messagerie électronique
Tu peux accéder à tes courriels grâce à un client lourd de messagerie électronique comme Mozilla Thunderbird ou Évolution.

Tu auras besoin de ta principale adresse mail et de ton mot de passe.

#####Réglages :

`IMAP | 993 | SSL/TLS`

`SMTP | 465 | SSL/TLS`

####Thunderbird
L'utilitaire de détection automatique de Thunderbird ne marche pas correctement avec YunoHost. Il faut donc passer en configuration manuelle.

<img src="https://yunohost.org/images/Thunderbird-conf.png" width=900>

####Pour Androïd
L’application [K-9 Mail](https://github.com/k9mail) fonctionne.

###Migration

Tes courriels sont enregistrés dans le fichier /var/mail/.
Tu auras besoin de déplacer ces fichier vers ton nouveau serveur YunoHost.

####Aller plus loin

* [Conférence de Benjamin Sonntag - L'email](http://www.iletaitunefoisinternet.fr/lemail-par-benjamin-sonntag/)
