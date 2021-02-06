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

### Index

- [Configuration](#configuration)
- [Useful links](#useful-links)

Fallback is a special app, only by command line interface, which provide a way to have a secondary server which you can used if your main server goes down.
This other server will allow you to deploy a copy of your server to bring back you to internet during your break down.

## Configuration

After the installation, you should not have anything else to configure. If you want anyway, you can find the list of app to backup in the file `/home/yunohost.app/fallback/app_list` and a global configuration in this other file `/home/yunohost.app/fallback/config.conf`

## Useful links

+ Application software repository: [github.com - YunoHost-Apps/fallback](https://github.com/YunoHost-Apps/fallback_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/fallback/issues](https://github.com/YunoHost-Apps/fallback_ynh/issues)
