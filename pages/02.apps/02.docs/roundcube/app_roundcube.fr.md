---
title: Roundcube
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_roundcube'
---

![logo de roundcube](image://roundcube_logo.svg?resize=,80)

[![Install Roundcube with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=roundcube) [![Integration level](https://dash.yunohost.org/integration/roundcube.svg)](https://dash.yunohost.org/appci/app/roundcube)

### Index

- [Liens utiles](#liens-utiles)

Roundcube est un client web de courrier électronique libre ou aussi appelé un webmail.

### Synchronisation des contacts

Roundcube vous propose à l'installation, via un greffon tiers, de pouvoir synchroniser vos contacts avec un serveur CardDAV. Utiliser un serveur CardDAV comme Baïkal ou l’application « Contacts » de Nextcloud, tous deux disponibles pour YunoHost, a l’avantage de permettre une gestion centralisée de vos contacts.

De la même façon que le protocole IMAP vous permet de synchroniser vos courriels avec votre serveur mail, CardDAV vous permet d’avoir accès à vos contacts depuis une multitude de clients, dont Roundcube. Avec CardDAV, nous n’aurez donc plus besoin d’importer vos contacts dans chaque client.

Notez que si Baïkal ou Nextcloud sont déjà installés, les carnets d'adresses qui y sont définis seront automatiquement ajoutés pour chaque utilisateur dans Roundcube.

----

Si vous avez installé Nextcloud après, voici comment ajouter vos carnets d'adresses :

* Rendez-vous dans la section « Contacts » de votre espace Nextcloud et cliquez sur l’icône représentant une roue dentée en bas à gauche. Ensuite, cliquez sur l’icône « Lien CardDAV » et copiez l’URL qui s’affiche en dessous.
* Rendez-vous ensuite dans la section CardDAV des paramètres de Roundcube et entrez « nextcloud » dans le champ « Label », collez l’URL que vous venez de copier et enfin entrez votre nom d’utilisateur et votre mot de passe. Vos contacts sont désormais synchronisés !

## Liens utiles

+ Site web : [roundcube.net](https://roundcube.net/)
+ Documentation officielle : [github.com/roundcube/roundcubemail/wiki](https://github.com/roundcube/roundcubemail/wiki)
+ Démonstration : [Démo](https://demo.yunohost.org/webmail/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/roundcube](https://github.com/YunoHost-Apps/roundcube_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com -YunoHost-Apps/roundcube/issues](https://github.com/YunoHost-Apps/roundcube_ynh/issues)
