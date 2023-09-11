---
title: Retroarch Web Player
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_retroarch'
---

[![Installer RetroArch with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=retroarch) [![Integration level](https://dash.yunohost.org/integration/retroarch.svg)](https://dash.yunohost.org/appci/app/retroarch)

*Retroarch Web Player* is a frontend for emulators, game engines and media players. It enables you to run classic games on a wide range of computers and consoles through its slick graphical interface. Settings are also unified so configuration is done once and for all. In addition to this, you are able to run original game discs (CDs) from RetroArch. RetroArch has advanced features like shaders, netplay, rewinding, next-frame response times, runahead, machine translation, blind accessibility features, and more!

### Screenshots

![Screenshots of Retroarch Web Player](https://github.com/YunoHost-Apps/retroarch_ynh/blob/master/doc/screenshots/ozone-main-menu.jpg)

### Disclaimers / important information

#### Use Shared ROMs library

Although you can upload a ROM at runtime, retroarch may have access to the ROMs you already have on your server:

* Games are located in `/opt/yunohost/retroarch/assets/cores`. A symbolic link is created to this folder in `/home/yunohost.multimedia/share/Games`, so that you can place your games from here
* cores have to be indexed to work : script `/opt/yunohost/retroarch/indexer.sh` run every 5 minutes to index all games in `opt/yunohost/retroarch/assets/cores`

#### Limitations

* Cannot save game, in fact, cannot write at all... so configuration is lost each time you start again
* No user management
* Some core are listed but not implemented : they do not work, the issue is from the upstream app.

## Useful links

+ Website: [retroarch.com](https://www.retroarch.com/)
+ Demonstration: [Demo](https://web.libretro.com/)
+ Application software repository: [github.com - YunoHost-Apps/retroarch](https://github.com/YunoHost-Apps/retroarch_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/retroarch/issues](https://github.com/YunoHost-Apps/retroarch_ynh/issues)
