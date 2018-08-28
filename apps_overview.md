Applications
============

One of the key feature of YunoHost is the ability to easily install applications which are then immediately usable. Example of applications include a blog system, a "cloud" (to host and sync files), a website, an RSS reader, ...

Applications must be packaged manually by application packagers/maintainers. Apps can be integrated with YunoHost to support upgrades, backup/restore and LDAP/SSO integration among other things.

Applications can be installed and managed through the webadmin interface in 'Applications' or through commands of the `yunohost app` category.

Application lists
-----------------

From the technical point of view, applications are public code repository (such as [this one](https://github.com/YunoHost-Apps/wordpress_ynh)). Existing applications are indexed using "application lists". Those lists can be managed in Applications > Install > Manage applications lists or with commands such as `yunohost app fetchlist`.

By default, YunoHost only knows about the official application list. Those are applications which have been carefully packaged, integrated, reviewed and shall be maintained by the YunoHost team. 

Nevertheless, you might want to have access to the larger catalog of the community list. It can easily be added through the 'Manage applications lists' view of the webadmin, or with the command `yunohost app fetchlist -n community -u https://app.yunohost.org/community.json`. Just be aware that apps in this list offer less guarantees than the official apps and the YunoHost team is not responsible for them !

The full list of application (official and community) can be browsed at [this page](/apps).

Integration and quality levels
------------------------------

Automated tests are being ran regularly to test the integration and quality of all official apps, as well as community apps who were declared to be 'working'. The result is a level between 0 and 7, whose meaning is detailed on [this page](/packaging_apps_levels_fr). Some tests results may also be available [on this dashboard](https://dash.yunohost.org/appci/branch/stable).

LDAP / SSO integration
----------------------

Applications may support integration with the LDAP / Single Sign On system, such that users who connects to the user portal can be automatically logged in all those apps. Some applications however do not support this as it can be either not implemented in the upstream, or the package didn't work on this part yet.

Multi-instance applications
---------------------------

Some applications support the ability to be installed several times (at different locations) ! To do so, just go another time in Applications > Install, and select again the application to install.


User access management
----------------------

Access to apps can be restricted to some users only. This can be configured via the webadmin in Applications > (choose an app) > Access, or similarly via the command line `yunohost app addaccess`, `removeaccess` and `clearaccess`.

Packaging applications 
----------------------

If you want to learn or contribute to app packaging, please check the [contributor documentation](contributordoc). 
