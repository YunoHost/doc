---
title: Fallback
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_fallback'
---

![Fallback](image://yunohost_package.png?height=80)

[![Install Fallback with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=fallback) [![Integration level](https://dash.yunohost.org/integration/fallback.svg)](https://dash.yunohost.org/appci/app/fallback)

Fallback is a special app, available only by command line interface, which provides a way to have a secondary server which can be used if your main server goes down.
This other server will allow you to deploy a copy of your server to bring you back to the internet during your break down.

## Configuration

After the installation, you should not have anything else to configure. If you want, you can find the list of apps to backup in the file `/home/yunohost.app/fallback/app_list` and a global configuration in this other file `/home/yunohost.app/fallback/config.conf`

## Useful links

+ Application software repository: [github.com - YunoHost-Apps/fallback](https://github.com/YunoHost-Apps/fallback_ynh)
+ Fix a bug or suggest an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/fallback/issues](https://github.com/YunoHost-Apps/fallback_ynh/issues)
