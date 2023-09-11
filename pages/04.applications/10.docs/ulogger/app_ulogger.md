---
title: μlogger
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_ulogger'
---

![μlogger's logo](image://ulogger-logo.png?resize=100)


[![Install μlogger with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=ulogger) 
[![Integration level](https://dash.yunohost.org/integration/ulogger.svg)](https://dash.yunohost.org/appci/app/ulogger)

**μlogger** is a web application for real-time collection of geolocation data, tracks viewing and management. Together with a dedicated μlogger mobile client (*F-Droid Store*) it may be used as a complete self hosted server–client solution for logging and monitoring users' geolocation.

## Features:
- simple
- allows live tracking
- track statistics
- altitudes graph
- multiple users
- user authentication
- Google Maps
- OpenLayers (OpenStreet and other layers)
- user preferences stored in cookies
- simple admin menu
- export tracks to gpx and kml
- import tracks from gpx

## Configuration
- Edit `scripts/setup.php` script, enable it by setting `$enabled` value to `true`
- Open http://YOUR_HOST/scripts/setup.php page in your browser
- Follow instructions in setup script. It will add database tables and set up your μlogger user
- **Remember to remove or disable `scripts/setup.php` script**
- Log in with your new user on your host,
- You may also want to set your new user as an admin in config file `$admin_user = "";`

## Useful links

* Upstream app code repository: [https://github.com/bfabiszewski/ulogger-server](https://github.com/bfabiszewski/ulogger-server)
* Demo: [https://ulogger.lima.zone](https://ulogger.lima.zone)
* Application software repository: [https://github.com/YunoHost-Apps/ulogger_ynh](https://github.com/YunoHost-Apps/ulogger_ynh)
* Report a bug: [https://github.com/YunoHost-Apps/ulogger_ynh/issues](https://github.com/YunoHost-Apps/ulogger_ynh/issues)
