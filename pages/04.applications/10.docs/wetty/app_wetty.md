---
title: Wetty
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_wetty'
---

[![Installer Wetty with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=wetty) [![Integration level](https://dash.yunohost.org/integration/wetty.svg)](https://dash.yunohost.org/appci/app/wetty)

*Wetty* is a Terminal application over HTTP and HTTPS. WeTTy is an alternative to ajaxterm and anyterm but much better than them because WeTTy uses xterm.js which is a full fledged implementation of terminal emulation written entirely in JavaScript. WeTTy uses websockets rather then Ajax and hence better response time.

### Screenshots

![Screenshot of Wetty](https://github.com/YunoHost-Apps/wetty_ynh/blob/master/doc/screenshots/terminal.png)

### Disclaimers / important information

#### Configuration

There is few configuration in Wetty:
* Startup config (listen port, URL path, SSH host) is contained in the systemd service file
* User interface configuration is done through the web GUI itself.

* Is LDAP and HTTP authentication supported? **No**
  * You need to manually log in.
  * You can log in as a specific user using `https://<host>/wetty/ssh/<username>`

* You can specify at install if Wetty should be visible by users not logged into YunoHost.

* You can't use ssh key authentication.

## Useful links

+ Website: [github.com/butlerx/wetty](https://github.com/butlerx/wetty)
+ Application software repository: [github.com - YunoHost-Apps/wetty](https://github.com/YunoHost-Apps/wetty_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/wetty/issues](https://github.com/YunoHost-Apps/wetty_ynh/issues)
