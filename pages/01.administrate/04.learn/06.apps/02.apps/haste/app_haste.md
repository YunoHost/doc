---
title: Haste
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_haste'
---

![Haste's logo](image://yunohost_package.png?height=80)

[![Install Haste with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=haste) [![Integration level](https://dash.yunohost.org/integration/haste.svg)](https://dash.yunohost.org/appci/app/haste)

### Index

- [Configuration](#Configuration)
- [Useful links](#useful-links)

Haste is an open-source pastebin software written in Node.js, which is easily installable in any network. YunoHost Project uses Haste as pastebin for log sharing: [paste.yunohost.org](https://paste.yunohost.org/)

## Configuration

This Haste package for YunoHost includes the [`haste` command](https://github.com/diethnis/standalones/blob/master/hastebin.sh), allowing you to share content from terminal:

```bash
cat something | haste
https://haste.example.com/zuyejeduzu
```
The [Haste-client](https://github.com/seejohnrun/haste-client) is a simple client for uploading data to you Haste server. 

Haste requires a dedicated domain like `haste.domain.tld`.

## Useful links

+ Official documentation: [hastebin.com - about](https://hastebin.com/about.md)
+ Application software repository: [github.com - YunoHost-Apps/haste](https://github.com/YunoHost-Apps/haste_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/haste/issues](https://github.com/YunoHost-Apps/haste_ynh/issues)
