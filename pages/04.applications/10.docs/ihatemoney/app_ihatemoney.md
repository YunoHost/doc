---
title: I Hate Money
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_ihatemoney'
---

[![Installer I Hate Money with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=ihatemoney) [![Integration level](https://dash.yunohost.org/integration/ihatemoney.svg)](https://dash.yunohost.org/appci/app/ihatemoney)

*I Hate Money* is a web application made to ease shared budget management. It keeps track of who bought what, when, and for whom; and helps to settle the bills.

### Screenshots

![Screenshots I Hate Money](https://github.com/YunoHost-Apps/ihatemoney_ynh/blob/master/doc/screenshots/screenshot_1_global.webp)
![Screenshots I Hate Money](https://github.com/YunoHost-Apps/ihatemoney_ynh/raw/master/doc/screenshots/screenshot_2_new_operation.webp)

### Disclaimers / important information

* LDAP authentication and Single Sign-on is not supported. The login mechanism in IHateMoney is per-project (not per-user) and therefore can't be integrated in YunoHost.

- **non-public app**:
  - YunoHost login required
  - per-project identifiers required
  - any YunoHost user with access to the app can create a new project.
- **public app**:
  - no YunoHost login required
  - per-project identifiers required
  - any visitor can create a new project.

* During upgrade from version 4.1.5~ynh3, a new admin password is generated and sent to the root

## Useful links

+ Website: [github.com/spiral-project/ihatemoney](https://github.com/spiral-project/ihatemoney)
+ Demonstration: [Demo](https://ihatemoney.org/authenticate?project_id=demo)
+ Application software repository: [github.com - YunoHost-Apps/ihatemoney](https://github.com/YunoHost-Apps/ihatemoney_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/ihatemoney/issues](https://github.com/YunoHost-Apps/ihatemoney_ynh/issues)
