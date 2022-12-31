---
title: my_capsule
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_my_capsule'
---

[![Installer my_capsule with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=my_capsule) [![Integration level](https://dash.yunohost.org/integration/my_capsule.svg)](https://dash.yunohost.org/appci/app/my_capsule)

*my_capsule* is a custom Gemini capsule with SFTP access and HtmGem to make your Gemini pages reachable on the web.

### Screenshots

![Screenshot of my_capsule](https://github.com/YunoHost-Apps/my_capsule_ynh/blob/master/doc/screenshots/screenshot2.png)
![Screenshot of my_capsule](https://github.com/YunoHost-Apps/my_capsule_ynh/blob/master/doc/screenshots/screenshot1.png)

### Disclaimers / important information

* Once installed, go to the chosen URL to know the user, domain and port you will have to use for the SFTP access.** The password is one you chosen during the installation. Under the Web directory, you will see a `www` folder which contains the public files served by this app. You can put all the files of your custom Web application inside.
* providing files access with [SFTP](https://yunohost.org/en/filezilla).
* It can also create a MySQL database which will be backed up and restored with your application. The connection details will be stored in the file `db_accesss.txt` located in the root directory.

* SFTP port
You may have change the SSH port as described in this section: 
[Modify the SSH port](https://yunohost.org/en/security#modify-the-ssh-port); 
then you should use this port to update your website with SFTP.

## Useful links

+ Website: [tildegit.org/Sbgodin/htmgem](https://tildegit.org/Sbgodin/htmgem)
+ Demonstration: [Demo](https://gmi.sbgodin.fr/htmgem/)
+ Application software repository: [github.com - YunoHost-Apps/my_capsule](https://github.com/YunoHost-Apps/my_capsule_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/my_capsule/issues](https://github.com/YunoHost-Apps/my_capsule_ynh/issues)
