---
title: Nitter
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_nitter'
---

[![Installer Nitter with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=nitter) [![Integration level](https://dash.yunohost.org/integration/nitter.svg)](https://dash.yunohost.org/appci/app/nitter)

*Nitter* is a free and open source alternative Twitter front-end focused on privacy and performance. Inspired by the Invidious project.

#### Features

- No JavaScript or ads
- All requests go through the backend, client never talks to Twitter
- Prevents Twitter from tracking your IP or JavaScript fingerprint
- Uses Twitter's unofficial API (no rate limits or developer account required)
- Lightweight (for @nim_lang, 60KB vs 784KB from twitter.com)
- RSS feeds
- Themes
- Mobile support (responsive design)

### Screenshots

![Screenshot of Nitter](https://github.com/YunoHost-Apps/nitter_ynh/blob/master/doc/screenshots/screenshot.png)

### Disclaimers / important information

#### Configuration

This app requires a dedicated root domain.

Nitter config file is stored in `/var/www/nitter/nitter.conf` (for the first instance, subsequent installs will go in `nitter__2`, `nitter__3`, etc). Users can override the defaults and set custom settings at `https://instance-domain.tld/settings`.

### :red_circle: Antifeatures

- **Non-free Network Services**: Promotes or depends entirely on a non-free network service.

## Useful links

+ Website: [nitter.net](https://nitter.net/)
+ Demonstration: [Demo](https://nitter.net/)
+ Application software repository: [github.com - YunoHost-Apps/nitter](https://github.com/YunoHost-Apps/nitter_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/nitter/issues](https://github.com/YunoHost-Apps/nitter_ynh/issues)
