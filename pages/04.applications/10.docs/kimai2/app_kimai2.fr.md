---
title: Kimai2
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_kimai2'
---

[![Installer Kimai2 avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=kimai2) [![Integration level](https://dash.yunohost.org/integration/kimai2.svg)](https://dash.yunohost.org/appci/app/kimai2)

*Kimai2* est la version actualisée du timetracker open source Kimai. Actuellement, il est dans une phase de développement précoce, il est utilisable mais certaines fonctionnalités avancées de Kimai v1 sont manquantes.

Kimai v2 n'a rien en commun avec son prédécesseur Kimai v1 à part les idées de base du suivi du temps et l'équipe de développement actuelle.

### Avertissements / informations importantes

* Il faut un domaine dédié comme **kimai.domain.tld**.
* Cette application est multi-instance (vous pouvez avoir plus d'une instance Kimai sur un serveur YunoHost).
* Comme le support de SQLite s'est arrêté à la version 1.14, si vous avez choisi une base de données SQLite pendant l'installation, la mise à jour de Kimai2 est bloquée à la version 1.13.

#### Support multi-utilisateurs

LDAP est supporté HTTP auth n'est pas supporté Les rôles par défaut de Kimai2 sont :
* ROLE_USER
* ROLE_TEAMLEAD => Kimai2 (Teamlead) YunoHost permission
* ROLE_ADMIN => Kimai2 (Admin) YunoHost permission
* ROLE_SUPER_ADMIN => Kimai2 (Super_Admin) YunoHost permission
Those roles are directly managed using YunoHost permission system. User choosen during installation is granted the ROLE_SUPER_ADMIN

## Liens utiles

+ Site web : [kimai.org](https://www.kimai.org/)
+ Démonstration : [Démo](https://www.kimai.org/demo/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/kimai2](https://github.com/YunoHost-Apps/kimai2_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/kimai2/issues](https://github.com/YunoHost-Apps/kimai2_ynh/issues)
