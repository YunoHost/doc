---
title: Roundcube
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_roundcube'
---

![roundcube's logo](image://roundcube_logo.svg?resize=,80)

[![Install Roundcube with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=roundcube) [![Integration level](https://dash.yunohost.org/integration/roundcube.svg)](https://dash.yunohost.org/appci/app/roundcube)

### Index

- [Useful links](#useful-links)

Roundcube is a web client for email messaging also called webmail.

### Synchronize your contacts

Roundcube offers you at the installation to synchronize your contacts with a CardDAV server, through a third party plugin. Using a CardDAV server like Baïkal or Nextcloud's "Contacts" application, both available in YunoHost, allows you to centralize and manage your contacts.

Similarly to IMAP that allows you to synchronize your emails with your mail server, CardDAV allows you to access your contacts through multiple clients, such as Roundcube. Thanks to CardDAV, you will not have to import your contacts in each of your devices.

Note that addressbooks defined in Baïkal or Nextcloud will be automatically added in Roundcube for each user if they are already installed.

----

In case you've installed Nextcloud after, here is how to add your addressbooks:

* Go to "Contacts" section of your Nextcloud application and click on the gear wheel icon located at the bottom left. Then, click on "CardDAV link" and copy the URL that appeared.
* Go to Roundcube's CardDAV section and type in "nextcloud" in "Label" field, paste the previously copied URL and type your username and password. Your contacts are now synchronized!

## Useful links

+ Website : [roundcube.net](https://roundcube.net/)
+ Official documentation : [github.com/roundcube/roundcubemail/wiki](https://github.com/roundcube/roundcubemail/wiki)
+ Demonstration : [Demo](https://demo.yunohost.org/webmail/)
+ Application software repository : [github.com - YunoHost-Apps/roundcube](https://github.com/YunoHost-Apps/roundcube_ynh)
+ Fix a bug or an improvement by creating a ticket (issue) : [github.com - YunoHost-Apps/roundcube/issues](https://github.com/YunoHost-Apps/roundcube_ynh/issues)
