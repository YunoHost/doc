---
title: Fallback
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_fallback'
---

![Fallback](image://yunohost_package.png?height=80)

[![Install fallback with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=fallback) [![Integration level](https://dash.yunohost.org/integration/fallback.svg)](https://dash.yunohost.org/appci/app/fallback)

### Index

- [Configuration](#configuration)
- [Liens utiles](#liens-utiles)

Fallback est une application spéciale, uniquement par interface de ligne de commande, qui permet d'avoir un serveur secondaire que vous pouvez utiliser si votre serveur principal tombe en panne.
Cet autre serveur vous permettra de déployer une copie de votre serveur pour vous ramener sur internet pendant votre panne.

## Configuration

Après l'installation, vous ne devriez plus avoir rien à configurer. Si vous le souhaitez quand même, vous pouvez trouver la liste des applications à sauvegarder dans le fichier `/home/yunohost.app/fallback/app_list` et une configuration globale dans cet autre fichier `/home/yunohost.app/fallback/config.conf`

## Liens utiles

 + Dépôt logiciel de l'application : [github.com - YunoHost-Apps/fallback](https://github.com/YunoHost-Apps/fallback_ynh)
 + Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/fallback/issues](https://github.com/YunoHost-Apps/fallback_ynh/issues)
