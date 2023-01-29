---
title: Misskey
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_misskey'
---

![misskey's logo](image://misskey_logo.png?resize=100)

[![Install Misskey with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=misskey) [![Integration level](https://dash.yunohost.org/integration/misskey.svg)](https://dash.yunohost.org/appci/app/misskey)

Misskey is a decentralized and open source microblogging platform. It has "Reactions" that allow you to easily express your feeling, "Drive" that allows you to manage files in one place, and a highly customizable UI that makes it more fun to share something.

Misskey also implements ActivityPub, so it can communicate with other platforms like Mastodon, Pleroma, Friendica and more interactively.

## Configuration

- Beginning with version 12.111.1~ynh1 (*Misskey* 12.111.1) YunoHost >= 11.0.7 is required, as PostgreSQL >= 12.x is mandatory.
- *Misskey* requires a dedicated root domain, e.g. `misskey.domain.tld`
-  Due to Cypress dependency, *Misskey* only works on 64-bit CPU machines.
- *Misskey* can take quite some time to install (more then 30 minutes). So take out some time and grab yourself a coffee.
- If installing from command line, using `screen` is recommended to avoid disconnection. See below.
- After installation, first page can take time to load and may show timeout error. Give it time to make itself ready for you. Refresh the page after 2 or 3 minutes.
- The first account created will be an admin user and will have all the admin rights.


Using screen in case of disconnects

``` 
sudo apt-get install screen
screen
sudo yunohost app install https://github.com/YunoHost-Apps/misskey_ynh.git
```
Recover after disconnect:
```
screen -d
screen -r
```

## Useful links

* Official app website: [https://misskey-hub.net/](https://misskey-hub.net/)
* Upstream app code repository: [https://github.com/misskey-dev/misskey](https://github.com/misskey-dev/misskey)
* Demonstration : [https://demo.misskey.io](https://demo.misskey.io)
* Report a bug: [https://github.com/YunoHost-Apps/misskey_ynh/issues](https://github.com/YunoHost-Apps/misskey_ynh/issues)
