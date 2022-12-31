---
title: CryptPad
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_cryptpad'
---

[![Installer CryptPad with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=cryptpad) [![Integration level](https://dash.yunohost.org/integration/cryptpad.svg)](https://dash.yunohost.org/appci/app/cryptpad)

*CryptPad* is a collaboration suite that is end-to-end-encrypted and open-source. It is built to enable collaboration, synchronizing changes to documents in real time. Because all data is encrypted, the service and its administrators have no way of seeing the content being edited and stored.

## Disclaimers / important information

#### Configuration

Once CryptPad is installed, create an account via the Register button on the home page. To make this account an instance administrator:

    Copy the public key found in User Menu (avatar at the top right) > Settings > Account > Public Signing Key
    Paste this key in `/var/www/cryptpad/config/config.js` in the following array (uncomment and replace the placeholder):
``` 
adminKeys: [
        "[cryptpad-user1@my.awesome.website/YZgXQxKR0Rcb6r6CmxHPdAGLVludrAF2lEnkbx1vVOo=]",
],
``` 
    Restart CryptPad service (In YunoHost webadmin -> Services -> cryptpad -> Restart)

## Useful links

+ Website: [cryptpad.fr](https://cryptpad.fr/)
+ Demonstration: [Demo](https://cryptpad.fr/)
+ Application software repository: [github.com - YunoHost-Apps/cryptpad](https://github.com/YunoHost-Apps/cryptpad_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/cryptpad/issues](https://github.com/YunoHost-Apps/cryptpad_ynh/issues)
