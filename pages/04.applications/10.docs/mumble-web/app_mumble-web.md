---
title: Mumble Web
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_mumble-web'
---

[![Installer Mumble Web with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=mumble-web) [![Integration level](https://dash.yunohost.org/integration/mumble-web.svg)](https://dash.yunohost.org/appci/app/mumble-web)

*Mumble Web* is an HTML5 Mumble client for use in modern browsers. The Mumble protocol uses TCP for control and UDP for voice. Running in a browser, both are unavailable to this client. Instead Websockets are used for control and WebRTC is used for voice (using Websockets as fallback if the server does not support WebRTC).

### Screenshots

![Screenshot of Mumble Web](https://github.com/YunoHost-Apps/mumble-web_ynh/blob/master/doc/screenshots/screenshot.png)

### Disclaimers / important information

### Setup

- In order to use *Mumble web*, you need to install [Mumble server](https://github.com/YunoHost-Apps/mumbleserver_ynh) first.
- This installation assumes that *Mumble server* is served by port `64738`
- Various configuration options are available for Mumble web on this configuration file `/var/www/mumble-web/dist/config.local.js`

### Documentation

- Murmur documentation: https://wiki.mumble.info/wiki/Murmurguide
- Framasoft documentation: https://docs.framasoft.org/fr/jitsimeet/mumble.html

## Useful links

+ Website: [mumble.info](https://www.mumble.info/)
+ Demonstration: [Demo](https://alt.framasoft.org/fr/mumble)
+ Application software repository: [github.com - YunoHost-Apps/mumble-web](https://github.com/YunoHost-Apps/mumble-web_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/mumble-web/issues](https://github.com/YunoHost-Apps/mumble-web_ynh/issues)
