---
title: Tiny Tiny RSS
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_ttrss'
---

![Tiny Tiny RSS's logo](image://ttrss.png?width=80)

[![Install Tiny Tiny RSS with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=ttrss) [![Integration level](https://dash.yunohost.org/integration/ttrss.svg)](https://dash.yunohost.org/appci/app/ttrss)

### Index

- [Liens utiles](#liens-utiles)

Tiny Tiny RSS is a news feed reader using RSS and Atom protocols.

### Exporting/importing feeds
Tiny Tiny RSS allows you to save your feeds in opml format.
In order to do so, go to Actions -> Configuration -> feed tab -> OPML section -> Export/Import OPML.

### Android Client

You can read your feeds on Android using ttrss-reader application: **[ttrss-reader](https://f-droid.org/packages/org.ttrssreader/)**

To use it, you need to go to Actions -> Configuration, in Tiny Tiny RSS web interface and select "Activate API".
Then, in your android ttrss-reader, fill the Tiny Tiny RSS server adress: https://yourdomain.org/ttrss, username, password (no need to use HTTP authentification).

**Note**: you may need to uninstall and reinstall the Tiny Tiny RSS application through the YunoHost admin panel in order to be able to connect.

## Useful links

 + Website: [git.tt-rss.org/git/tt-rss/wiki](https://git.tt-rss.org/git/tt-rss/wiki)
 + Official documentation: (login as `demo`, `demo`): [srv.tt-rss.org/tt-rss/](https://srv.tt-rss.org/tt-rss/)
 + Application software repository: [github.com - YunoHost-Apps/ttrss](https://github.com/YunoHost-Apps/ttrss_ynh)
 + Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/ttrss/issues](https://github.com/YunoHost-Apps/ttrss_ynh/issues)
