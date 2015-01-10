#Messagerie électronique

YunoHost fournit :
* [Postfix](http://www.postfix.org/) : un serveur de messagerie électronique SMTP
* [Dovecot](http://www.dovecot.org/) : un serveur de messagerie électronique IMAP et POP3
* [Amavis](http://amavis.org/) : un antispam
* [RoundCube](/apps) : un webmail

###Client lourd de messagerie électronique
Il est possible d’accéder à ses courriels grâce à un client lourd de messagerie électronique comme Mozilla Thunderbird ou Évolution.

L’adresse mail principale mail et de ton mot de passe sont nécessaire.

**Attention:** votre login est votre nom d’utilisateur SSO et non votre adresse mail ou la partie avant le @ 

#####Réglages :

`IMAP | 993 | SSL/TLS`

`SMTP | 465 | SSL/TLS`

####Mozilla Thunderbird
L'utilitaire de détection automatique de Thunderbird ne marche pas correctement avec YunoHost. Il faut donc passer en configuration manuelle. N’oubliez pas d’enlever le point devant le nom domaine.

<img src="https://yunohost.org/images/thunderbird-config.png" width=900>

* [Gestion des alias mails](https://support.mozilla.org/en-US/kb/configuring-email-aliases)

####Pour Androïd
L’application [K-9 Mail](https://github.com/k9mail) fonctionne.

###Migration
Les emails peuvent être migrés avec [Larch](https://github.com/rgrove/larch/) :
* sur vortre client installez Larch :
```bash
sudo gem install larch
```
* Procédez au transfert ente deux serveurs YunoHost :
```bash
larch -a -f imaps://serveur_d'origine.org -t imaps://serveur_de_destination.org
```
Pour d'autres types de transferts référez-vous à la documentation de Larch.

####Aller plus loin

* [Conférence de Benjamin Sonntag - L'email](http://www.iletaitunefoisinternet.fr/lemail-par-benjamin-sonntag/)
