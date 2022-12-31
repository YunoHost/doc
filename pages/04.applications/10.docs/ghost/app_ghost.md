---
title: Ghost
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_ghost'
---

[![Installer Ghost with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=ghost) [![Integration level](https://dash.yunohost.org/integration/ghost.svg)](https://dash.yunohost.org/appci/app/ghost)

*Ghost* is a publishing, memberships, subscriptions and newsletters platform.

### Disclaimers / important information

#### Installation

1. No LDAP support.

2. You need more than 1GB of ram. If you don't have it, please create a swap memory.

```
dd if=/dev/zero of=/swapfile bs=1024 count=1048576
mkswap /swapfile
swapon /swapfile
echo "/swapfile swap swap defaults 0 0" >> /etc/fstab
```

3. This app is multi-instance (you can have more than one Ghost blogging websites on a single YunoHost server)

##### Installing the Ghost app

0. Note - When making the install public, your Ghost domain link must be accessed WHILE NOT signed into your YunoHost session. It is recommended to use a incognito mode to sign into your Ghost admin account. If you make your install public, and try to login your Ghost admin account while signed into your YunoHost session, you will get a an authorized header error. The reason for this is because Ghost has a feature that allows for a subscription based access for content. This means Ghost allows for the admin user to setup other users (either other staff or paid/unpaid subscribers) to have the abilility to login outside of YunoHost.

1. App can be installed by YunoHost admin interface or by the following command:

```
sudo yunohost app install https://github.com/YunoHost-Apps/ghost_ynh
```

2. After installation create an admin account by visiting `https://domain.tld/ghost/ghost`. If you choose to name your Ghost instance "blog" during YunoHost setup process, then it would be https://domain.tld/blog/ghost. This will allow you to continue to setup your admin account and configure your settings.

## Useful links

+ Website: [ghost.org](https://ghost.org/)
+ Application software repository: [github.com - YunoHost-Apps/ghost](https://github.com/YunoHost-Apps/ghost_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/ghost/issues](https://github.com/YunoHost-Apps/ghost_ynh/issues)
