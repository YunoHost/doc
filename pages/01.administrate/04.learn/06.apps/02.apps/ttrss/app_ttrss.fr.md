---
title: Tiny Tiny RSS
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_ttrss'
---

![logo de Tiny Tiny RSS](image://ttrss.png?width=80)

[![Installer Tiny Tiny RSS avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=ttrss) [![Integration level](https://dash.yunohost.org/integration/ttrss.svg)](https://dash.yunohost.org/appci/app/ttrss)

### Index

- [Liens utiles](#liens-utiles)

Tiny Tiny RSS est un lecteur de flux d’actualité utilisant les protocoles RSS et Atom.

### Exportation/importation des flux

Il est possible de faire une sauvegarde de ces flux d’actualité en format opml.

Pour cela, il faut aller dans Actions -> Configuration -> onglet flux -> chapitre OPML -> Exporter/Importer en OPML.

### Client Android

Il est possible d’utiliser le client Android ttrss-reader pour consulter ces flux : **[ttrss-reader](https://f-droid.org/packages/org.ttrssreader/)**

Sur l’interface web, dans Actions -> Configuration, cochez « Activer l’accès par API »
puis dans ttrss-reader sur Android, l’adresse du serveur Tiny Tiny RSS : https://votredomaine.org/ttrss, nom d’utilisateur, mot de passe. (pas besoin d’utiliser l’authentification HTTP)

**Note** : vous pouvez avoir besoin de désinstaller, puis réinstaller entièrement l'application Tiny Tiny RSS via l’administration de YunoHost pour que la connexion puisse se faire.

## Liens utiles

 + Site web : [git.tt-rss.org/git/tt-rss/wiki](https://git.tt-rss.org/git/tt-rss/wiki)
 + Site de démonstration (login : `demo`, `demo`): [srv.tt-rss.org/tt-rss/](https://srv.tt-rss.org/tt-rss/)
 + Dépôt logiciel de Tiny Tiny RSS : [github.com - YunoHost-Apps/ttrss](https://github.com/YunoHost-Apps/ttrss_ynh)
 + Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/ttrss/issues](https://github.com/YunoHost-Apps/ttrss_ynh/issues)
