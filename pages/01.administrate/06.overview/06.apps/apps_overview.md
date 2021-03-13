---
title: Applications
template: docs
taxonomy:
    category: docs
routes:
  default: '/apps_overview'
---

One of the key feature of YunoHost is the ability to easily install applications which are then immediately usable. Example of applications include a blog system, a "cloud" (to host and sync files), a website, an RSS reader...

Applications must be packaged manually by application packagers/maintainers. Apps can be integrated with YunoHost to support upgrades, backup/restore and LDAP/SSO integration among other things.

Applications can be installed and managed through the webadmin interface in 'Applications' or through commands of the `yunohost app` category.

The application catalog can be browsed in the webadmin (in Applications > Install) or [here](/apps).

## Integration and quality levels

Automated tests are being run regularly to test the integration and quality of all official apps, as well as community apps who were declared to be 'working'. The result is a level between 0 and 7, whose meaning is detailed on [this page](/packaging_apps_levels). Some tests results may also be available [on this dashboard](https://dash.yunohost.org/appci/branch/stable).

## LDAP / SSO integration

Applications may support integration with the LDAP / Single Sign On system, such that users who connects to the user portal can be automatically logged in all those apps. Some applications however do not support this as it can be either not implemented in the upstream, or the package didn't work on this part yet.

## Multi-instance applications

Some applications support the ability to be installed several times (at different locations) ! To do so, just go another time in Applications > Install, and select again the application to install.

## User access management

Access to apps can be restricted to some users only. This can be configured via the webadmin in the [Groups and permissions panel](/groups_and_permissions), or similarly via the command-line subcategory `yunohost user permission`.

## Packaging applications 

If you want to learn or contribute to app packaging, please check the [contributor documentation](/contributordoc). 
