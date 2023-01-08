---
title: Webmin
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_webmin'
---

![webmin's logo](image://webmin_logo.png?resize=100)

[![Install Webmin with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=webmin) [![Integration level](https://dash.yunohost.org/integration/webmin.svg)](https://dash.yunohost.org/appci/app/webmin)

## Overview

Webmin is a web-based interface for system administration for Unix. Using any modern web browser, you can setup user accounts, Apache, DNS, file sharing and much more. Webmin removes the need to manually edit Unix configuration files like `/etc/passwd`, and lets you manage a system from the console or remotely.

## Important information

* This app has **root** access which can change core things in the system, thus **breaking the YunoHost**. Use it carefully and read the [documents](https://doxfer.webmin.com/Webmin/Main_Page) two times before changing values.
* Only **user** given permission at time of the installation can **access** the Webmin login interface
* To login to webmin, use root and root password 
* Webmin will **update itself** when system updates are run. So no need to **run upgrade script** once installed.


## Useful links

* Official app website: [http://www.webmin.com](http://www.webmin.com)
* Upstream app code repository: [https://github.com/webmin/webmin](https://github.com/webmin/webmin)
* YunoHost documentation for this app: [https://yunohost.org/app_webmin](https://yunohost.org/app_webmin)
* Report a bug: [https://github.com/YunoHost-Apps/webmin_ynh/issues](https://github.com/YunoHost-Apps/webmin_ynh/issues)

