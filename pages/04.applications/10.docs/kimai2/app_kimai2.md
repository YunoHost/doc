---
title: Kimai2
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_kimai2'
---

[![Installer Kimai2 with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=kimai2) [![Integration level](https://dash.yunohost.org/integration/kimai2.svg)](https://dash.yunohost.org/appci/app/kimai2)

*Kimai2* is the reloaded version of the open source timetracker Kimai. Right now its in an early development phase, its usable but some advanced features from Kimai v1 are missing by now.

Kimai v2 has nothing in common with its predecessor Kimai v1 besides the basic ideas of time-tracking and the current development team.

### Disclaimers / important information

* Require dedicated domain like **kimai.domain.tld**.
* This app is multi-instance (you can have more then one Kimai instance running on a YunoHost server)
* As sqlite support ended on version 1.14, if you choosed an sqlite databse during installation, Kimai2 upgrade is blocked to version 1.13

#### Multi-user support

LDAP is supported HTTP auth is not supported Defaul Kimai2 roles are:
* ROLE_USER
* ROLE_TEAMLEAD => Kimai2 (Teamlead) YunoHost permission
* ROLE_ADMIN => Kimai2 (Admin) YunoHost permission
* ROLE_SUPER_ADMIN => Kimai2 (Super_Admin) YunoHost permission
Those roles are directly managed using YunoHost permission system. User choosen during installation is granted the ROLE_SUPER_ADMIN


## Useful links

+ Website: [kimai.org](https://www.kimai.org/)
+ Demonstration: [Demo](https://www.kimai.org/demo/)
+ Application software repository: [github.com - YunoHost-Apps/kimai2](https://github.com/YunoHost-Apps/kimai2_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/kimai2/issues](https://github.com/YunoHost-Apps/kimai2_ynh/issues)
