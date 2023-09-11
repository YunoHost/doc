---
title: OwnTracks
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_owntracks'
---

[![Installer OwnTracks with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=owntracks) [![Integration level](https://dash.yunohost.org/integration/owntracks.svg)](https://dash.yunohost.org/appci/app/owntracks)

*OwnTracks* allow to keep track of your location history.

### Screenshots

![Screenshots](https://github.com/YunoHost-Apps/owntracks_ynh/blob/master/doc/screenshots/screenshot.png)

### Disclaimers / important information

### Features

- [OwnTracks features for a HTTP API](http://owntracks.org/booklet/tech/http/), limited to the [features implemented by the PHP recorder](https://github.com/tomyvi/php-owntracks-recorder#features). Notably, no Friends feature. The [upstream PHP recorder has been tweaked](https://github.com/tituspijean/php-owntracks-recorder) to remove a cumbersome PHP dependency.
- Multi-user: each YunoHost user can connect though basic HTTP authentication, and has only access to their data.

### Installation

- Install the app on your YunoHost server
- Install the mobile app on your device, see [OwnTracks website](http://owntracks.org)
- Configure your mobile app:
  - Allow it to access your location
  - Preference > Connection
    - Mode: `Private http`
    - Host: `https://DOMAIN/PATH/record.php`
    - Identification
       - Authentication: `enabled`
       - Username/password: your YNH credentials
       - Device ID: as you wish
   - Refer to the [OwnTracks documentation](http://owntracks.org/booklet) for the other settings

## Useful links

+ Website: [owntracks.eu (en)](https://owntracks.eu/site/)
+ Application software repository: [github.com - YunoHost-Apps/owntracks](https://github.com/YunoHost-Apps/owntracks_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/owntracks/issues](https://github.com/YunoHost-Apps/owntracks_ynh/issues)
