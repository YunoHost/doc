---
title: Jirafeau
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_jirafeau'
---

![Jirafeau's logo](image://Jirafeau_logo.jpg?width=80)

[![Install Jirafeau with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=jirafeau) [![Integration level](https://dash.yunohost.org/integration/jirafeau.svg)](https://dash.yunohost.org/appci/app/jirafeau)

### Index

- [Configuration](#configuration)
  - [Changing the conditions of use of the service](#changing-the-conditions-of-use-of-the-service)
  - [Administration](#administration)
- [Useful links](#useful-links)

Jirafeau offers the possibility to host and share your files with ease. Choose a file, Jirafeau will provide you with a link with many options.
It is possible to protect your links with a password as well as to choose how long the file will be kept on the server. The file and the link will self-destruct after this time.
Downloads of transmitted files can be limited to a certain date, and each file can self-destruct after the first download.
Jirafeau allows you to configure maximum retention times and maximum size per file. Encryption is available as an option.[¹](#sources)

## Configuration

### Changing the conditions of use of the service

The license text on the "Terms of Service" page, which is shipped with the default installation, is "based on the Open Source Initiative Terms of Service".
To change this text simply copy the file `/lib/tos.original.txt`, rename it to `/lib/tos.local.txt` and adapt it to your own needs.
If you update the installation, then only the `tos.original.txt` file may change eventually, not your `tos.local.txt` file.

### Administration

To administer the files within Jirafeau it is enough to go to the address `jirafeau.domaine.tld/admin.php`.

## Useful links

+ Website: [jirafeau.net](https://jirafeau.net/)
+ Official documentation: [gitlab.com - mojo42/Jirafeau (en)](https://gitlab.com/mojo42/Jirafeau)
+ Application software repository: [github.com - YunoHost-Apps/jirafeau](https://github.com/YunoHost-Apps/jirafeau_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/jirafeau/issues](https://github.com/YunoHost-Apps/jirafeau_ynh/issues)

------

### Sources

¹ [framalibre.org (fr)](https://framalibre.org/content/jirafeau)
