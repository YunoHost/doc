---
title: Owncast
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_owncast'
---

[![Installer Owncast with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=owncast) [![Integration level](https://dash.yunohost.org/integration/owncast.svg)](https://dash.yunohost.org/appci/app/owncast)

*Owncast* is an open source, self-hosted, decentralized, single user live streaming and chat server for running your own live streams similar in style to the large mainstream options. It offers complete ownership over your content, interface, moderation and audience.

### Screenshots

![Screenshot of Owncast](https://github.com/YunoHost-Apps/owncast_ynh/blob/master/doc/screenshots/owncast-screenshot.png)

### Disclaimers / important information

### Configuration

You can configure Owncast in the admin page: `domain.ltd/admin` with `admin` and `abc123` as credential. Don't forget to change the stream key.

### Streaming app

OBS can be used as streaming video app: https://obsproject.com/

1. Install OBS or Streamlabs OBS and get it working with your local setup.
1. Open OBS Settings and go to **Stream**.
1. Select **Custom…** as the service.
1. Enter the URL of the server running your streaming service in the format of `rtmp://myserver.net/live`.
1. Enter your **Stream Key** that matches your key file.
1. Press **Start Streaming** (OBS) or **Go Live** (Streamlabs) on OBS.

### Standalone chat mode

`https://live.domain.ltd/index-standalone-chat-readwrite.html`

## Useful links

+ Website: [owncast.online](https://owncast.online/)
+ Demonstration: [Demo](https://watch.owncast.online/)
+ Application software repository: [github.com - YunoHost-Apps/owncast](https://github.com/YunoHost-Apps/owncast_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/owncast/issues](https://github.com/YunoHost-Apps/owncast_ynh/issues)
