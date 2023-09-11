---
title: IFM
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_ifm'
---

[![Installer IFM with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=ifm) [![Integration level](https://dash.yunohost.org/integration/ifm.svg)](https://dash.yunohost.org/appci/app/ifm)

*IFM* is a web-based filemanager, which comes as a single file solution using HTML5, CSS3, JavaScript and PHP.

### Disclaimers / important information

The IFM is usually locked to it's own directory (`/home/yunohost.app/ifm`), so you are not able to go above. You can change that by setting `env[IFM_ROOT_DIR] = /home/yunohost.app/ifm` in the PHP config `/etc/php/7.3/fpm/pool.d/ifm.conf` L.434 with the help of this [documentation](https://github.com/misterunknown/ifm/wiki/Configuration).

## Useful links

+ Website: [github.com/misterunknown/ifm](https://github.com/misterunknown/ifm)
+ Demonstration: [Demo](https://ifmdemo.gitea.de/)
+ Application software repository: [github.com - YunoHost-Apps/ifm](https://github.com/YunoHost-Apps/ifm_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/ifm/issues](https://github.com/YunoHost-Apps/ifm_ynh/issues)
