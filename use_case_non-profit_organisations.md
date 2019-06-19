# YunoHost for non-profit

## Table of Contents
* [Introduction](/use_case_non-profit_organisations_en?id=introduction) 
* [Who](/use_case_non-profit_organisations_en?id=who) 
* [What](/use_case_non-profit_organisations_en?id=what) 
* [When](/use_case_non-profit_organisations_en?id=when) 
* [Where](/use_case_non-profit_organisations_en?id=where) 
* [Why](/use_case_non-profit_organisations_en?id=why) 
* [How](/use_case_non-profit_organisations_en?id=how) 
* [Conclusion](/use_case_non-profit_organisations_en?id=conclusion) 

## Introduction <a id="introduction"></a> 

The object of this document is to present a specific use of [YunoHost](https://yunohost.org/) for non-profit organizations.

## Who <a id="who"></a> 

Non-profit organizations, NGO or any kind of association.

## What <a id="what"></a> 

Usually non-profit organizations need to provide several services to several publics:

* Board of Directors / Steering Committee / Volunteers with:
  * [Mails](/use_case_non-profit_organisations_en?id=mail)
  * [Calendar](/use_case_non-profit_organisations_en?id=calendar)
  * [Contact](/use_case_non-profit_organisations_en?id=contact)
  * [Shared files / Drive](/use_case_non-profit_organisations_en?id=drive)
  * [Instant communication](/use_case_non-profit_organisations_en?id=im)
  * [Intranet / knowledge database](/use_case_non-profit_organisations_en?id=intranet)
  * [ERP / Accounting](/use_case_non-profit_organisations_en?id=erp)
* Members with:
  * [Public website with private and individual access](/use_case_non-profit_organisations_en?id=www)
  * [Membership](/use_case_non-profit_organisations_en?id=membership)
  * [Events registrations](/use_case_non-profit_organisations_en?id=events)
  * [Mailings](/use_case_non-profit_organisations_en?id=mailing)
  * [Forum](/use_case_non-profit_organisations_en?id=forum)
* Public with:
  * [Public website](/use_case_non-profit_organisations_en?id=www)
  * [Newsletter](/use_case_non-profit_organisations_en?id=mailing)

## When <a id="when"></a> 

When ready to move forward.

## Where <a id="where"></a> 

You YunoHost for non profit can be hosted in several places:
* Own hosting on a server, computer or Raspberry behind ASDL, SDSL or Fiber
* [Chatons](https://chatons.org), [librehosters](https://framagit.org/librehosters/awesome-librehosters) hosting services
* Commercial hosting services providing Debian virtual machine

## Why <a id="why"></a> 

YunoHost can provide mostly all needs of a non-profit organization.
Keeping their data on their own.

## How <a id="how"></a> 

### YunoHost <a id="yunohost"></a>

YunoHost is a Debian GNU/Linux based distribution packaged with free software that automates the installation of a personal web server. The purpose of YunoHost is to allow users to easily host their own web services by enabling a simple point-and-click web interface for installing various web apps.

![](https://upload.wikimedia.org/wikipedia/commons/0/07/Yunohost_user_portal.png)

Out of the box YunoHost provide:
* A system of application
* A web interface
* A command-line interface (CLI): Moulinette
* A web server: Nginx
* A DNS server: Dnsmasq
* A database: MariaDB
* A backup system
* An SSO : SSOwat
* OpenLDAP
* Email:
  * SMTP: Postfix
  * IMAP & POP3: Dovecot
  * An antispam: rspamd,rmilter
* Instant messaging XMPP server: Metronome IM

### Domain Name <a id="domain"></a>

The first thing you will need to implement a YunoHost server is a domain name. The domain name can usually be provided with your hosting service.

### Mails <a id="mail"></a>

From scratch, YunoHost provide mail system available using POP/IMAP/SMTP.
Mails accounts will be managed using the web interface or the command line. Created accounts are stored in openldap.

Additional package can be installed to provide more functionality to the YunoHost mail system:
* Webmail using [Roundcube](https://github.com/YunoHost-Apps/roundcube_ynh), [Rainloop](https://github.com/YunoHost-Apps/rainloop_ynh)
* ActiveSync using [Z-Push](https://github.com/YunoHost-Apps/z-push_ynh)
* Internal distribution group using [Mailman](https://github.com/YunoHost-Apps/mailman_ynh)

### Calendar <a id="calendar"></a>

To provide personal or shared calendars you will need to install:
* [Nextcloud](https://github.com/YunoHost-Apps/nextcloud_ynh)
* [Baikal](https://github.com/YunoHost-Apps/baikal_ynh)

### Contact <a id="contact"></a>

To provide personal contact system you will need to install:
* [Nextcloud](https://github.com/YunoHost-Apps/nextcloud_ynh)
* [Baikal](https://github.com/YunoHost-Apps/baikal_ynh)

### Shared files <a id="drive"></a>

To provide shared files system: personal and shared drive, you can install [Nextcloud](https://github.com/YunoHost-Apps/nextcloud_ynh).
Files will be available from a web interface or using a synchronization client

### Instant communication <a id="im"></a>

Out of the box, YunoHost provide an XMPP server, for which you can install a web client: [Jappix](https://github.com/YunoHost-Apps/jappix_ynh)

You can also install a matrix server:
* The server: [Synapse](https://github.com/YunoHost-Apps/synapse_ynh)
* A web client: [Riot](https://github.com/YunoHost-Apps/_ynh)

### Intranet <a id="intranet"></a>

For an non-profit organization a good way to implement an intranet is to provide a wiki to let internal users read, edit and add content. Here are some packages to implement a wiki:
* [DokuWiki](https://github.com/YunoHost-Apps/docuwiki_ynh) using wiki syntax
* [Wiki.js](https://github.com/YunoHost-Apps/wikijs_ynh) using markdown syntax

### ERP / Accounting <a id="erp"></a>

At some time a non-profit organization could need an accounting/erp system, here are two propositions:
* [OpenERP/Odoo](https://github.com/YunoHost-Apps/libreerp_ynh)
* [Dolibarr](https://github.com/YunoHost-Apps/dolibarr_ynh)

### Public Web Site <a id="www"></a>

There are several way to implement a Public Web Site:
* Simple html, css, etc... Website using: [Custom Webapp](https://github.com/YunoHost-Apps/my_webapp_ynh)
* Using a CMS (Content Management System) like [Wordpress](https://github.com/YunoHost-Apps/_ynh), [Drupal](https://github.com/YunoHost-Apps/drupal_ynh) , [Grav](https://github.com/YunoHost-Apps/grav_ynh), [PluXml](https://github.com/YunoHost-Apps/pluxml_ynh)

But we will propose something more powerful: [CiviCRM on Drupal 7](https://github.com/YunoHost-Apps/civicrm_drupal7_ynh):
* Drupal that is a powerful open source content management framework
* with CiviCRM that is an open source constituent relationship management for non-profits 

#### Membership <a id="membership"></a>

With CiviCRM you can provide online membership and payment.

#### Events Registrations <a id="events"></a>

With CiviCRM, you can provide an online diary to let members or public register for free or with a payment

#### Newsletter/Mailing <a id="mailing"></a>

Best way to manage that is using CiviCRM and its mailing module

### Forum <a id="forum"></a>

You have several choices, or having an integrated forum in Drupal or using a dedicated forum system like [Flarum](https://github.com/YunoHost-Apps/flarum_ynh)

### Backup <a id="backup"></a>

YunoHost provide is own backup system. Before any package upgrade, YunoHost backup the current version of the package and automaticaly restore it if the upgrade fails.
Yunohost backup are stored localy in `/home/yunohost.backup/archives`

But for production, localy stored backup are not enough, so you will need to implement aditional backup strategies:
* Backup of the the Virtual Machine if provided by the hosting system.
* [Archivist](https://github.com/YunoHost-Apps/archivist_ynh) is an automatic backup system for your server. Your backups can be send to many other places, local or distant.
* [Borg](https://github.com/YunoHost-Apps/borg_ynh) and [Borg Server](https://github.com/YunoHost-Apps/borgserver_ynh) allow to externalize backups
* [Fallback](https://github.com/YunoHost-Apps/fallback_ynh), if you have two yunohost servers, provide a way to have a secondary server which you can used if your main server goes down. This secondary server will allow you to deploy a copy of your server to bring back your YunoHost during your break down.

### Go further <a id="further"></a>

#### Federated Photo Gallery <a id="photo"></a>

* [Pixelfed](https://github.com/YunoHost-Apps/pixelfed_ynh)

#### Federated Audio Gallery <a id="audio"></a>

* [Reel2Bits](https://github.com/YunoHost-Apps/reel2bits_ynh)

#### Federated Video Gallery <a id="video"></a>

* [PeerTube](https://github.com/YunoHost-Apps/peertube_ynh)

#### Federated Social Networking <a id="sn"></a>

* [Mastodon](https://github.com/YunoHost-Apps/mastodon_ynh)
* [Pleroma](https://github.com/YunoHost-Apps/pleroma_ynh)
* [Mobilizon](https://github.com/YunoHost-Apps/mobilizon_ynh)

#### Federated Blog <a id="sn"></a>

* [Plume](https://github.com/YunoHost-Apps/plume_ynh)
* [Writefreely](https://github.com/YunoHost-Apps/writefreely_ynh)

#### Chat <a id="sn"></a>

* [Mattermost](https://github.com/YunoHost-Apps/mattermost_ynh)


## Conclusion <a id="conclusion"></a>

YunoHost can cover 99% of the needs of non-profit organizations, allowing them to own and protect their data, choose applications they want to use.
And if one is not available, they can [package it for YunoHost](https://yunohost.org/#/contributordoc), it's very simple.
