---
title: phpBB
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_phpbb'
---

[![Installer phpBB with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=phpbb) [![Integration level](https://dash.yunohost.org/integration/phpbb.svg)](https://dash.yunohost.org/appci/app/phpbb)

*phpBB* is a free flat-forum bulletin board software solution that can be used to stay in touch with a group of people or can power your entire website. With an extensive database of user-created extensions and styles database containing hundreds of style and image packages to customise your board, you can create a very unique forum in minutes.

### Screenshots

![Screenshot of phpBB](https://github.com/YunoHost-Apps/phpbb_ynh/blob/master/doc/screenshots/screenshot.png)

### Disclaimers / important information

### Configuration

1. The app will require to complete the registration process after the instllation is complete by **visiting the domain** on  which *phpBB* is installed.
1. The MySQL database credentials will be sent to the **admin mail**.
1. Please delete, move or rename the install directory (`mv /var/www/phpbb/install /var/www/phpbb/install_old`) before you use your board. If this directory is still present, only the Administration Control Panel (ACP) will be accessible.

## Useful links

+ Website: [phpbb.com](https://www.phpbb.com/)
+ Demonstration: [Demo](https://www.phpbb.com/demo/)
+ Application software repository: [github.com - YunoHost-Apps/phpbb](https://github.com/YunoHost-Apps/phpbb_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/phpbb/issues](https://github.com/YunoHost-Apps/phpbb_ynh/issues)
