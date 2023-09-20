---
title: SnappyMail
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_snappymail'
---

![SnappyMail's logo](image://snappymail_logo.png?height=100)

[![Install SnappyMail with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=snappymail) [![Integration level](https://dash.yunohost.org/integration/snappymail.svg)](https://dash.yunohost.org/appci/app/snappymail)

### Index

- [Configuration](#configuration)
  - [Domains](#domains)
  - [Upgrade](#upgrade)
- [Useful links](#useful-links)

SnappyMail is a lightweight webmail, a fork of RainLoop.

## Configuration

To configure it, go to http://DOMAIN.TLD/snappymail/app/?admin

- The default login is: admin
- The default password is stored in a file located at `/var/www/snappymail/data/_data_/_default_/admin_password.txt

### Domains
Users can use SnappyMail to access mailboxes other than the one provided by YunoHost (e.g. gmail.com or live.com). The option is available through the "account -> add an account" button.
The administrator must authorize the connection to third party domains, via a white list in the administration interface.

### Upgrade
To upgrade the app once a new SnappyMail version is available, simply run in a local shell via ssh or otherwise:
`sudo yunohost app upgrade -u https://github.com/YunoHost-Apps/snappymail_ynh snappymail`

## Useful links

+ Website : [snappymail.eu](https://snappymail.eu/)
+ Official documentation : [github.com/the-djmaze/snappymail/wiki](https://github.com/the-djmaze/snappymail/wiki)
+ Demonstration : [Demo](https://snappymail.eu/demo/)
+ Application software repository : [github.com - YunoHost-Apps/snappymail](https://github.com/YunoHost-Apps/snappymail_ynh)
+ Fix a bug or an improvement by creating a ticket (issue) : [github.com - YunoHost-Apps/snappymail/issues](https://github.com/YunoHost-Apps/snappymail_ynh/issues)
