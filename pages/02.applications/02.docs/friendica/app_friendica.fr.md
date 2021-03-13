---
title: Friendica
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_friendica'
---

![logo de friendica](image://friendica_logo.svg?resize=,80)

[![Install friendica with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=friendica) [![Integration level](https://dash.yunohost.org/integration/friendica.svg)](https://dash.yunohost.org/appci/app/friendica)

### Index

- [Configuration](#configuration)
- [Liens utiles](#liens-utiles)

Friendica est une plateforme de communication décentralisée qui intègre la communication sociale. La plate-forme est liée à des projets sociaux indépendants et à des services aux entreprises.

Son objectif est de libérer les amis, la famille et les collègues des entreprises qui récoltent des données ; Friendica vise à ce que la communication sociale soit libre et ouverte, tout en circulant entre tous les fournisseurs aussi facilement que le courrier électronique.[¹](#sources)

## Configuration

Avant l'installation, lisez les instructions d'installation de Friendica pour obtenir des informations à propos de l'installation

Exigence de validation du certificat SSL (maintenant avec le support de Let's Encrypt !). Voir la section Installation ci-dessous.
Domaine dédié (doit être installé sous la racine web comme https://hub.example.com/ et non https://example.com/hub/ )

Note : Vous pouvez utiliser les comptes du LDAP de YunoHost. Il n'y a pas encore de SSO actif.

## Liens utiles

+ Site web : [friendi.ca](http://friendi.ca/)
+ Documentation officielle : [github.com/friendica/friendica/wiki](https://github.com/friendica/friendica/wiki)
+ Démonstration : [Démo](http://dir.friendica.social/servers)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/friendica](https://github.com/YunoHost-Apps/friendica_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com -YunoHost-Apps/friendica/issues](https://github.com/YunoHost-Apps/friendica_ynh/issues)

------

### Sources

¹ [github.com - friendica/friendica (en)](https://github.com/friendica/friendica)
