---
title: Baikal
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_baikal'
---

![Baïkal's logo](image://baikal_logo.png?height=80)

[![Install Baïkal with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=baikal) [![Integration level](https://dash.yunohost.org/integration/baikal.svg)](https://dash.yunohost.org/appci/app/baikal)

### Index

- [Configuration](#Configuration)
  - [Login to admin interface](#Login-to-administration-interface)
  - [Creating a new user](#Create-a-new-user)
- [CalDAV connection](#CalDAV-connection)
  - [Connecting Thunderbird with Lightning](#Connecting-Thunderbird-with-Lightning)
  - [Connecting to AgenDAV](#Connecting-to-AgenDAV)
- [CardDAV Connection](#CardDAV-Connection)
- [Useful links](#Useful-links)

Baïkal is a server for calendars and address books, which uses the CalDav and CardDav protocol. Baïkal can be synced with a lot of clients, like Thunderbird + Lightning.

**WARNING**: Baïkal will not work if you have installed a **Nextcloud** (the Nextcloud CardDav/CalDav functions conflict).

## Configuration

### Connecting to the administration interface

To configure the app, go to the address: `sub.domain.tld/admin` or `domain.tld/baikal/admin`.
The username to specify is `admin`, followed by the specific password you chose when installing Baïkal. The password can contain any special characters.

### LDAP authentication

By default, Baïkal is configured to look for users in YunoHost's LDAP
directory. YunoHost's users will appear under `User and ressources` menu after their
first authentication.

## CalDAV connection

### Connecting Thunderbird with Lightning

Add a new agenda with type "Network" and "CalDAV"

The new URL to add is:

https://domain.org/baikal/cal.php/calendars/username/default

Be careful to replace "domain.org" with your own domain and the "username" with your username.

### Connecting to AgenDAV

AgenDAV is a web client for using your calendars. It's packaged for YunoHost and you can used it after installing Baïkal.

AgenDAV is already connected to Baïkal, any other configuration is necessary. If you create a new entry in Thunderbird + Lightning calendar, refresh your AgenDAV page is enough to see your modifications.

AgenDAV also allows you to create a new calendars very easily.

## CardDAV Connection

Using the example with RoundCube Add a new address book by going to Settings > Preferences > CardDAV.

Make sure it is filled with:
* Addressbook name: `default`
* Username: `username`
* Password: `thePasswordAssociatedToUsername`
* URL : `https://example.com/baikal/card.php/addressbooks/username/default`

* Make sure to replace "example.com" with your domain and "username" with your username*

Save.

Now, the adressbook is accessible.

## Useful links

 + Website: [www.baikal-server.com](http://www.baikal-server.com/)
 + Official documentation: [sabre.io - baikal](https://sabre.io/baikal/)
 + Apps software repository: [github.com - YunoHost-Apps/bikal](https://github.com/YunoHost-apps/baikal_ynh)
 + Fix a bug or suggest an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/baikal/issues](https://github.com/YunoHost-apps/baikal_ynh/issues)
