---
title: Rainloop
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_rainloop'
---

![Rainloop's logo](image://yunohost_package.png?height=80)

[![Install Rainloop with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=rainloop) [![Integration level](https://dash.yunohost.org/integration/rainloop.svg)](https://dash.yunohost.org/appci/app/rainloop)

### Index

- [Configuration](#Configuration)
- [Useful links](#useful-links)

Rainloop is a lightweight webmail.

## Configuration

To configure it, go to http://DOMAIN.TLD/rainloop/app/?admin

- The default login is: admin
- The default password is: Password chosen during install
- If you lost the admin password, you can retrieve it using `sudo yunohost app setting rainloop password`

### CardDAV
Each user can add a remote cardDAV server from their own parameters interface.

- If you use Baïkal, the CardDAV address is: https://DOMAIN.TLD/baikal/card.php/addressbooks/USER/default/
- If you use Nextcloud, the CardDAV address is: https://DOMAIN.TLD/nextcloud/remote.php/carddav/addressbooks/USER/contacts

### Domains
Users can use Rainloop to access mailboxes other than the one provided by YunoHost (e.g. gmail.com or live.com). The option is available through the "account -> add an account" button.
The administrator must authorize the connection to third party domains, via a white list in the administration interface.

### PGP Keys
Rainloop saves your PGP private keys in the browser storage. This means that you will loose your private keys if you clear your browser storage (e.g., private browsing, different computer...). This packages integrates [PGPback by chtixof](https://github.com/chtixof/pgpback_ynh) so you can store your PGP private keys on the server securely. Go to **http://DOMAIN.TLD/rainloop/pgpback** to backup your PGP keys on the server or restore them.

### Upgrade
To upgrade the app once a new rainloop version is available, simply run in a local shell via ssh or otherwise:
`sudo yunohost app upgrade -u https://github.com/YunoHost-Apps/rainloop_ynh rainloop`

## Useful links

+ Website : [www.rainloop.net](https://www.rainloop.net/)
+ Official documentation : [www.rainloop.net/docs/configuration](https://www.rainloop.net/docs/configuration/)
+ Demonstration : [Demo](https://mail.rainloop.net/)
+ Application software repository : [github.com - YunoHost-Apps/rainloop](https://github.com/YunoHost-Apps/rainloop_ynh)
+ Fix a bug or an improvement by creating a ticket (issue) : [github.com - YunoHost-Apps/rainloop/issues](https://github.com/YunoHost-Apps/rainloop_ynh/issues)
