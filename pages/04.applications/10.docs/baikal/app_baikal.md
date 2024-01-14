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

Baïkal is a server for calendars and address books, which uses the CalDAV and CardDAV protocol. Baïkal can be synced with a lot of clients, like Thunderbird + Lightning.

**WARNING**: Baïkal will not work if you have installed a **Nextcloud** (the Nextcloud CardDAV/CalDAV functions conflict).

## Configuration

### Connecting to the administration interface

To configure the app, go to the address: `sub.domain.tld/admin` or `domain.tld/baikal/admin`.
The username to specify is `admin`, followed by the specific password you chose when installing Baïkal. The password can contain any special characters.

### LDAP authentication

By default, Baïkal is configured to look for users in YunoHost's LDAP
directory. YunoHost's users will appear under `User and ressources` menu after their
first authentication.

### CalDAV/CardDAV access

To be able to connect CalDAV or CardDAV clients to Baïkal, you must allow access to the app for visitors during installation.
Clients will still need to to authenticate with username and password of an YNH user.
Also note that the admin interface of Baïkal is always available only to logged-in YNH admin users.

## CalDAV connection

### Connecting Thunderbird with Lightning

Open the Calendar view, select "New Calendar...".
Choose "On the Network", click "Next".
Type in your YNH username in the "Username" input field and your server's "https://domain.tld" in the "Location" input field.
(You only need to enter the domain, Baïkal configures the webserver to forward CalDAV and CardDAV requests to Baïkal.)
Click "Find Calendars" and enter your YNH user's password.
If this is the first time your YNH user logs in to Baïkal, a "Default Calendar" is automatically created for you.
Select the calendar you want to add to Thunderbird and click "Subscribe".

### Connecting to AgenDAV

AgenDAV is a web client for using your calendars. It's packaged for YunoHost and you can use it after installing Baïkal.

AgenDAV is already connected to Baïkal, no other configuration is necessary. If you create a new entry in Thunderbird + Lightning calendar, refreshing your AgenDAV page is enough to see your modifications.

AgenDAV also allows you to create new calendars very easily.

## CardDAV Connection

Using the example with RoundCube Add a new address book by going to Settings > Preferences > CardDAV.

Make sure it is filled with:
* Addressbook name: `default`
* Username: `username`
* Password: `thePasswordAssociatedToUsername`
* URL : `https://example.com/baikal/card.php/addressbooks/username/default`

* Make sure to replace "example.com" with your domain and "username" with your username*

Save.

Now, the address book is accessible.

## Useful links

 + Website: [sabre.io - baikal (en)](https://sabre.io/baikal/)
 + Official documentation: [sabre.io - baikal/dav (en)](https://sabre.io/dav/)
 + Apps software repository: [github.com - YunoHost-Apps/baikal](https://github.com/YunoHost-apps/baikal_ynh)
 + Fix a bug or suggest an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/baikal/issues](https://github.com/YunoHost-apps/baikal_ynh/issues)
