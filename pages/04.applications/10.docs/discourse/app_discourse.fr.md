---
title: Discourse
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_discourse'
---

![logo de Discourse](image://discourse_logo.svg?resize=,80)

[![Install Discourse with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=discourse) [![Integration level](https://dash.yunohost.org/integration/discourse.svg)](https://ci-apps.yunohost.org/jenkins/job/discourse%20%28Community%29/lastBuild/consoleFull)

### Index

- [Limitations avec YunoHost](#limitations-avec-yunohost)
- [Liens utiles](#liens-utiles)

Discourse dispose des fonctionnalités usuelles d’un forum de discussion : utilisateurs, discussions, recherche, messages privés, etc. Le mode « liste de diffusion » permet d’utiliser la plupart des fonctionnalités du forum via des courriers électroniques. Écrit en ruby et en JavaScript, il nécessite une base de données PostgreSQL et un serveur d’envoi de courrier électronique.[¹](#sources)

## Limitations avec YunoHost

Dans le tableau de bord de l'administration, la version installée est indiquée comme inconnue (du fait que nous n'utilisons pas Git pour l'installation) ; vous pouvez ignorer cela sans risque car le paquet YunoHost sera maintenu. Sur les appareils ARM, les avatars générés par défaut ne portent pas les initiales du profil (il ne s'agit que d'un simple disque).

## Liens utiles

 + Site web : [www.discourse.org (en)](https://www.discourse.org/)
 + Documentation officielle : [www.discourse.org - customers (en)](https://www.discourse.org/customers)
 + Dépôt logiciel de l'application : [github.com - YunoHost-Apps/discourse](https://github.com/YunoHost-Apps/discourse_ynh)
 + Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/discourse/issues](https://github.com/YunoHost-Apps/discourse_ynh/issues)

 ------

### Sources

¹ [framalibre.org - Discourse](https://framalibre.org/content/discourse)
