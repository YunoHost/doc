---
title: h5ai
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_h5ai'
---

[![Installer h5ai with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=h5ai) [![Integration level](https://dash.yunohost.org/integration/h5ai.svg)](https://dash.yunohost.org/appci/app/h5ai)

*h5ai* is a modern HTTP web server index for NGINX.

### Disclaimers / important information

#### Configuration

After installing the application, you can add documents in `/var/www/documents` (or the corresponding path you choosed).
h5ai doesn't allow to edit or upload new documents directly from the web browser. But you can imagine coupling the folder `/var/www/documents` to Nextcloud or some sort of FTP to allow some users to upload content, and use h5ai as a public read-only interface.
The main configuration file is `_h5ai/private/conf/options.json`. You might want to change some of the documented settings. But there are some more files in `_h5ai/private/conf` you might have a look at.

## Useful links

+ Website: [larsjung.de/h5ai](https://larsjung.de/h5ai/)
+ Application software repository: [github.com - YunoHost-Apps/h5ai](https://github.com/YunoHost-Apps/h5ai_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/h5ai/issues](https://github.com/YunoHost-Apps/h5ai_ynh/issues)
