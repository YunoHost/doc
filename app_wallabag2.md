## <img src="https://yunohost.org/images/Logo-wallabag-svg.svg">

[Wallabag](https://www.wallabag.org/) is a self hostable Read-It-Later application allowing
you to not miss any content anymore. Click, save, read it when you can.
It extracts content so that you can read it when you have time.

[![Install Wallabag v2 with 
YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=wallabag2)

It provides a web interface, browser (Firefox / Chrome / Opera) add-ons, mobile apps (Android / iOS / Windows Phone) and even on e-reader (PocketBook / Kobo)

### Features

In addition to Wallabag core features, the following are made available with
this package:

 * Integrate with YunoHost users and SSO - i.e. logout button
 * Allow one user to be the administrator (set at the installation)
 * Asynchronous import using Redis (need to be enabled in the *Internal Settings*). RabbitMQ import not supported (yet ?)

### Links

 * Report a bug: https://github.com/YunoHost-Apps/wallabag2_ynh/issues
 * Wallabag website: https://www.wallabag.org/
 * Wallabag documentation: https://doc.wallabag.org/ (fr/en/it/de)
 * [Video demo](https://vimeo.com/video/167435064)
 
----

### Upgrade from v1.x

No automatic upgrade process is available. You need a manual (but simple) migration from [Wallabag v1](https://github.com/YunoHost-Apps/wallabag_ynh).
Please take a look at the [official documentation](https://doc.wallabag.org/en/user/import/wallabagv1.html).
