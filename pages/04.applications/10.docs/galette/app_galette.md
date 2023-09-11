---
title: Galette
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_galette'
---

![logo of Galette](https://galette.eu/site/assets/img/galette.png?resize=,80)

[![Installer Galette avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=galette) [![Integration level](https://dash.yunohost.org/integration/galette.svg)](https://dash.yunohost.org/appci/app/galette)

*Galette* is a membership management web application towards non profit organizations. This is before all a free software (as in free speech), community and free (as in beer)! Galette works on any web server that handle PHP.

### Updating the application

Once you have updated the application, you must go to the installer page which by default is `https://domaine/galette/installer.php`.

Once on this page, a verification of the prerequisites is displayed.
At the next step you will have to choose the type of installation: here `Update`.

![Galette Update](https://github.com/YunoHost/doc/raw/master/images/Galette_1_en_Update.png)

It is at this new step, where the fields are pre-filled, that you will have to fill in the database password.

![Galette Password](https://github.com/YunoHost/doc/raw/master/images/Galette_2_en_Passwd.png)

You will be able to find it by connecting to your server with SSH. You will have to switch to `root` and display the `config.inc.php` file in which the application password is located:

```
sudo su

cat /var/www/galette/galette/config/config.inc.php
```

## Useful links

+ Website: [galette.eu (en)](https://galette.eu/site/)
+ Demonstration: [Démo](https://demo.galette.eu/login)
+ Application software repository: [github.com - YunoHost-Apps/galette](https://github.com/YunoHost-Apps/galette_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/galette/issues](https://github.com/YunoHost-Apps/galette_ynh/issues)
