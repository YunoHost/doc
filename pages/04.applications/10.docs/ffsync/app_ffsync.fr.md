---
title: Firefox Sync
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_ffsync'
---

![logo de Firefox Sync](image://ffsync_logo.png?width=80)

[![Install Firefox Sync with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=ffsync) [![Integration level](https://dash.yunohost.org/integration/ffsync.svg)](https://dash.yunohost.org/appci/app/ffsync)

### Index

- [Configuration](#configuration)
  - [Firefox bureau](#firefox-bureau)
  - [Firefox mobile](#firefox-mobile)
- [Limitations avec YunoHost](#limitations-avec-yunohost)
- [Liens utiles](#liens-utiles)

Firefox Sync permet la synchronisation des favoris, des marques-pages, de l’historique, des onglets, des extensions entre plusieurs instances du navigateur web Firefox.

## Configuration

Une fois installé, le site `domain.tld/path` devrait afficher une page expliquant comment le configurer.

Pour utiliser votre serveur personnel de synchronisation Firefox, vous allez devoir configurer votre navigateur [Firefox](https://www.mozilla.org/fr/firefox/new/).

### Firefox bureau

1. Une fois Firefox lancé, rendez-vous à l’adresse : `about:config`
2. Recherchez la clé : `identity.sync.tokenserver.uri`
3. Remplacez l’URL par la vôtre : `https://mondomaine.tld/path/token/1.0/sync/1.5`
4. Créez un compte chez Mozilla : https://accounts.firefox.com/signup

### Firefox mobile

Avec les versions récentes de Firefox pour mobile la démarche est identique à la version bureau.

## Limitations avec YunoHost

Par défaut, l'authentification s’effectuera toujours à l’aide de comptes hébergés par Mozilla à l'adresse https://accounts.firefox.com. Vous devrez donc toujours vous authentifier chez Mozilla, mais le stockage de vos informations se fera bien sur votre serveur.

## Liens utiles

 + Dépôt logiciel de l'application : [github.com - YunoHost-Apps/APPLICATION](https://github.com/YunoHost-Apps/ffsync_ynh)
 + Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/ffsync/issues](https://github.com/YunoHost-Apps/ffsync_ynh/issues)
