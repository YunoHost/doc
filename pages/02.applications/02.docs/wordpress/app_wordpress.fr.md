---
title: WordPress
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_wordpress'
---

![logo de WordPress](image://wordpress_logo.svg?resize=,80)

[![Install Wordpress with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=wordpress) [![Integration level](https://dash.yunohost.org/integration/wordpress.svg)](https://dash.yunohost.org/appci/app/wordpress)

### Index

- [Limitations avec YunoHost](#limitations-avec-yunohost)
- [Liens utiles](#liens-utiles)

WordPress est un système de gestion de contenu (SGC ou content management system (CMS) en anglais) gratuit, libre et open-source. Ce logiciel écrit en PHP repose sur une base de données MySQL et est distribué par l'entreprise américaine Automattic. Les fonctionnalités de WordPress lui permettent de créer et gérer différents types de sites Web : site vitrine, site de vente en ligne, site applicatif, blogue, ou encore portfolio. Il est distribué selon les termes de la licence GNU GPL version 2.[¹](#sources)

## Limitations avec YunoHost

Le multisite est uniquement disponible sur des sous-répertoires.

Comme le plugin de mise à jour automatique ne fonctionne pas comme prévu, faites attention à garder wordpress à jour depuis le panneau d'administration de WordPress, et pas seulement depuis le panneau d'administration de YunoHost. Pour des raisons de sécurité, contrôler que toutes les mises à jour sont régulièrement appliquées dans le panneau d'administration de WordPress ainsi que dans le panneau d'administration de YunoHost.

## Liens utiles

+ Site web : [wordpress.org](https://fr.wordpress.org/)
+ Documentation officielle : [codex.wordpress.org (en)](https://codex.wordpress.org/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/wordpress](https://github.com/YunoHost-Apps/wordpress_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com -YunoHost-Apps/wordpress/issues](https://github.com/YunoHost-Apps/wordpress_ynh/issues)

-----------

### Sources

¹ [wikipedia.org - WordPress](https://fr.wikipedia.org/wiki/WordPress)
