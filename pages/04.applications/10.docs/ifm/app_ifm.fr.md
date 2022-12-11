---
title: IFM
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_ifm'
---

[![Installer IFM avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=ifm) [![Integration level](https://dash.yunohost.org/integration/ifm.svg)](https://dash.yunohost.org/appci/app/ifm)

*IFM* est un gestionnaire de fichiers basé sur le Web, qui se présente sous la forme d'un fichier unique utilisant HTML5, CSS3, JavaScript et PHP.

### Avertissements / informations importantes

L'IFM est généralement verrouillé dans son propre répertoire (`/home/yunohost.app/ifm`), vous ne pouvez donc pas aller sur d'autres répertoires. Vous pouvez changer cela en définissant `env[IFM_ROOT_DIR] = /home/yunohost.app/ifm` dans la configuration PHP `/etc/php/7.3/fpm/pool.d/ifm.conf` L.434 en vous aidant de cette [documentation](https://github.com/misterunknown/ifm/wiki/Configuration). 

## Liens utiles

+ Site web : [github.com/misterunknown/ifm](https://github.com/misterunknown/ifm)
+ Démonstration : [Démo](https://ifmdemo.gitea.de/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/ifm](https://github.com/YunoHost-Apps/ifm_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/ifm/issues](https://github.com/YunoHost-Apps/ifm_ynh/issues)
