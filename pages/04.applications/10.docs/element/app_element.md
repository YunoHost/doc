---
title: Element
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_element'
---

[![Installer Element with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=element) [![Integration level](https://dash.yunohost.org/integration/element.svg)](https://dash.yunohost.org/appci/app/element)

*Element* is a new type of messaging app. You choose where your messages are stored, putting you in control of your data. It gives you access to the Matrix open network, so you can talk to anyone. Element provides a new level of security, adding cross-signed device verification to default end-to-end encryption.

### YunoHost specific features

Multi-users support

This application support the SSO. If you want to use the SSO, you need to define the path to the default homeserver as your homeserver witch is installed on your YunoHost instance.

### Additional informations

Important Security Note

We do not recommend running Element from the same domain name as your Matrix homeserver (Synapse). The reason is the risk of XSS (cross-site-scripting) vulnerabilities that could occur if someone caused Element to load and render malicious user generated content from a Matrix API which then had trusted access to Element (or other apps) due to sharing the same domain.

## Useful links

+ Website: [element.io (en)](https://element.io/)
+ Demonstration: [Demo](https://app.element.io/)
+ Application software repository: [github.com - YunoHost-Apps/element](https://github.com/YunoHost-Apps/element_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/element/issues](https://github.com/YunoHost-Apps/element_ynh/issues)
