---
title: Firefox Sync
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_ffsync'
---

![Firefox Sync's logo](image://ffsync_logo.png?width=80)

[![Install Firefox Sync with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=ffsync) [![Integration level](https://dash.yunohost.org/integration/ffsync.svg)](https://dash.yunohost.org/appci/app/ffsync)

### Index

- [Configuration](#configuration)
  - [Firefox desktop](#firefox-desktop)
  - [Firefox mobile](#firefox-mobile)
- [Limitations with YunoHost](#limitations-with-yunohost)
- [Useful links](#useful-links)

Firefox Sync permits synchronize plugins, tabs, bookmarks, favorites, history over many Firefox instances.

## Configuration

Once installed, the `domain.tld/path` site should display a page explaining how to configure it.
To use your personal Firefox sync server, you will need to configure your [Firefox](https://www.mozilla.org/fr/firefox/new/) web browser.

### Firefox desktop

1. In Firefox URL bar put: `about:config`.
2. Search for: `identity.sync.tokenserver.uri`.
3. Replace the URL by: https://mydomain.tld/path/token/1.0/sync/1.5
4. Create an account at Mozilla: https://accounts.firefox.com/signup

### Firefox mobile

With the last version of firefox mobile it's same than for desktop.

## Limitations with YunoHost

By default, a configured server will report authentication to the account server hosted by Mozilla at https://accounts.firefox.com. You will still need to authenticate to Mozilla, but your information will be stored on your host.

## Useful links

+ Application software repository: [github.com - YunoHost-Apps/ffsync](https://github.com/YunoHost-Apps/ffsync_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/ffsync/issues](https://github.com/YunoHost-Apps/ffsync_ynh/issues)
