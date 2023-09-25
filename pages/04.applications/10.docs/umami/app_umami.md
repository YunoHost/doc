---
title: umami
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_umami'
---

![umami's logo](image://umami-logo.png?resize=100)


[![Install umami with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=umami) 
[![Integration level](https://dash.yunohost.org/integration/umami.svg)](https://dash.yunohost.org/appci/app/umami)

**Umami** is a simple, fast, privacy-focused alternative to Google Analytics.

## Getting Started
- Install `umami` on dedicated domain (does not support subpaths!)
- After installation the default user is `admin` with password `umami`. Change these as soon as possible!

## Upgrade
To upgrade the app once a new `umami` version is available, simply run in a local shell via ssh or otherwise:
`sudo yunohost app upgrade umami -u https://github.com/YunoHost-Apps/umami_ynh`

### Migrating from 1.x to 2.x
Upgrading from 1.x series to 2.x is a multi-step process that cannot be automated. It involves:
- Upgrade to 1.40 - the latest version in 1.x series. Intermediate steps may include upgrade to 1.33 (first version to use `prisma` for schema versioning) and 1.33.1 (which introduces breaking `prisma` change).
- Running dedicated script for v1 DB to v2 DB migration
- Upgrading to latest and greatest in 2.x series.

The script to perform this step is as following (assuming this is the first instance, named `umami`. If it's the second instance use `umami__2` etc.):


```
# Install latest 1.x version from dedicated branch
$ sudo yunohost app upgrade umami -u https://github.com/orhtej2/umami_ynh/tree/v1.40-enh

# Run migrations
$ cd /var/www/umami
$ yarn add @umami/migrate-v1-v2
$ npx @umami/migrate-v1-v2

# Update to latest version
$ sudo yunohost app upgrade umami -u https://github.com/YunoHost-Apps/umami_ynh
```

## Useful links

* Upstream app code repository: [https://github.com/umami-software/umami](https://github.com/umami-software/umami)
* Docs: [https://umami.is/docs/](https://umami.is/docs/)
* Application software repository: [https://github.com/YunoHost-Apps/umami_ynh](https://github.com/YunoHost-Apps/umami_ynh)
* Report a bug: [https://github.com/YunoHost-Apps/umami_ynh/issues](https://github.com/YunoHost-Apps/umami_ynh/issues)
