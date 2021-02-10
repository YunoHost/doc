---
title: MiniDLNA (Ready Media)
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_minidlna'
---

![MiniDLNA's (Ready Meadia) logo](image://yunohost_package.png?height=80)

[![Install MiniDLNA with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=minidlna) [![Integration level](https://dash.yunohost.org/integration/minidlna.svg)](https://dash.yunohost.org/appci/app/minidlna)

### Index

- [Configuration](#configuration)
- [Useful links](#useful-links)

MiniDLNA (Ready Media) is a lightweight [DLNA](https://fr.wikipedia.org/wiki/Digital_Living_Network_Alliance) server.
It allows to easily share multimedia files with any compatible devices present on the LAN.

MiniDLNA does not have a graphical interface, but it does not require any special configuration.

## Configuration

### What multimedia files are shared?
MiniDLNA (renamed Ready Media) sharing the folder `/home/yunohost.multimedia/share`, which is common to each user in `/home/$USER/Multimedia/Share`.
[More information about multimedia files here.](https://github.com/YunoHost-Apps/yunohost.multimedia)

~~If [Transmission](https://github.com/Kloadut/transmission_ynh) is installed, the downloaded media will be available in DLNA.~~  

### How to view and play media files shared by MiniDLNA?
To view and play media files, all you need is a compatible client DLNA/UPNP.

The majority of set-top boxes provided by ISPs are DLNA compatible, simply look for sources of external media.
This is also true for the latest generation game consoles connected to internet.

Some TV and Blu-ray player is also DLNA compatible.

In any case, it is generally sufficient to seek external sources, USB etc., to find the DLNA server, displayed under the name **YunoHost DLNA**.

There are a multitude of DLNA client for all platforms, including the following [not exhaustive list](https://en.wikipedia.org/wiki/List_of_UPnP_AV_media_servers_and_clients#UPnP_AV_clients).
In general, a DLNA client does not require any special configuration to access the media sharing.

## Useful links

+ Website: [minidlna.sourceforge.net](http://minidlna.sourceforge.net)
+ Official : [help.ubuntu.com/community/MiniDLNA](https://help.ubuntu.com/community/MiniDLNA)
+ Application software repository: [github.com - YunoHost-Apps/minidlna](https://github.com/YunoHost-Apps/minidlna_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/minidlna/issues](https://github.com/YunoHost-Apps/minidlna_ynh/issues)
