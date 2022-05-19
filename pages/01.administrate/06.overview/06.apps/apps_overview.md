---
title: Applications
template: docs
taxonomy:
    category: docs
routes:
  default: '/apps_overview'
---

One of the key feature of YunoHost is the ability to easily install applications which are then immediately usable. Example of applications include a blog system, a "cloud" (to host and sync files), a website, an RSS reader...

Applications can be installed and managed through the webadmin interface in 'Applications' or through commands of the `yunohost app` category.

The application catalog can be browsed in the webadmin (in Applications > Install) or [here](/apps).

! Be careful to stay reasonable on the number of installed applications. Each additional installation increases the attack surface and the risk of failure. Ideally, if you want to test, do it with another instance for example in [a virtual machine](/install/hardware:virtualbox).

Applications must be packaged manually by application packagers/maintainers. Apps can be integrated with YunoHost to support upgrades, backup/restore and LDAP/SSO integration among other things.

## Instructions after installation

Some applications need to give you instructions, URLs or credentials once they are installed. So remember to check the email of the first user account.

## Integration and quality levels

Automated tests are being run regularly to test the integration and quality of all apps who were declared to be 'working' by packagers. The result is a level between 0 and 8, whose meaning is detailed on [this page](/packaging_apps_levels). Some tests results may also be available [on this dashboard](https://dash.yunohost.org/appci/branch/stable).

By default, only applications of sufficient quality are offered. When the quality of an application drops, updates are put on hold and installation is no longer possible, until the problem is resolved.

## LDAP / SSO integration

Applications may support integration with the LDAP / Single Sign On system, such that users who connects to the user portal can be automatically logged in all those apps. Some applications however do not support this as it can be either not implemented in the upstream, or the package didn't work on this part yet. This information is usually available on the README of the application package.

## Multi-instance applications

Some applications support the ability to be installed several times (at different locations) ! To do so, just go another time in Applications > Install, and select again the application to install.

## Tile management

Web applications can provide tiles available from the user portal, it is possible to choose whether or not to display them and redefine the text via the web administration interface `Applications > APP name > Operations > Manage labels and tiles` or via the command line: `yunohost app change-label <app> "New text"`.

## User access management

Access to apps can be restricted to some users only. This can be configured via the webadmin in the [Groups and permissions panel](/groups_and_permissions), or similarly via the command-line subcategory `yunohost user permission`.

## Applications packaging 

If you want to learn or contribute to app packaging, please check the [contributor documentation](/contributordoc). 
