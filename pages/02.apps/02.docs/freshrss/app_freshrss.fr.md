---
title: FreshRSS
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_freshrss'
---

![logo de FreshRSS](image://freshrss_logo.svg?resize=,80)

[![Install FreshRSS with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=freshrss) [![Integration level](https://dash.yunohost.org/integration/freshrss.svg)](https://dash.yunohost.org/appci/app/freshrss)

### Index

- [Configuration](#configuration)
- [Applications clientes](#applications-clientes)
- [Liens utiles](#liens-utiles)

FreshRSS est un agrégateur et lecteur de flux RSS. Il permet de regrouper l’actualité de plusieurs sites différents dans un endroit unique pour que vous puissiez la lire sans devoir aller de site en site.

FreshRSS a été conçu comme un agrégateur puissant et propose des tas de fonctionnalités.

## Configuration

API (mini) Comment faire :
1. Dans votre profil utilisateur `Paramètres > profil`
2. Définir un mot de passe API
3. Vérifiez que l'API fonctionne : https://exemple.tld/rss/api/greader.php
4. Configurez votre client avec :
    + username : ynh user
    + password : le mot de passe que vous venez de configurer
    + URL : https://exemple.tld/rss/api/greader.php

## Applications clientes

| Nom de l'applications | Plateforme | Multi-comptes | F-Droid | Play Store |
|-----------------------|------------|---------------|---------|------------|
| Fresh RSS | Android | ? | [f-droid.org - Fresh RSS](https://f-droid.org/fr/packages/fr.chenry.android.freshrss/) | X |

## Liens utiles

 + Site web : [www.freshrss.org (en)](https://www.freshrss.org/)
 + Documentation officielle : [freshrss.github.io - FreshRSS](https://freshrss.github.io/FreshRSS/fr/)
 + Dépôt logiciel de l'application : [github.com - YunoHost-Apps/freshrss](https://github.com/YunoHost-Apps/freshrss_ynh)
 + Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/freshrss/issues](https://github.com/YunoHost-Apps/freshrss_ynh/issues)
