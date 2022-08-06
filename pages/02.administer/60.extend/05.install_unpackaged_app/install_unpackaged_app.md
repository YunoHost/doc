---
title: Install unpackaged apps
template: docs
taxonomy:
    category: docs
routes:
  default: '/install_unpackaged_apps'
---


## PHP or HTML/JS apps
If your app is a PHP or HTML/JS app, you probably should use the `Custom Webapp`, also know as `my_webapp`, in order to configure nginx, php, mysql, yunohost permission and backup for you.

## Other technologies

If you use an other techno, you should install it like on a classical debian.


To expose the app on the web through nginx and be able to manage access permissions to the webapp, you could use the [`redirect` app](https://github.com/YunoHost-Apps/redirect_ynh/) to create a nginx reverse proxy on your local ip/port running the service.

!!! You should use the proxy mode of the redirect app and not HTTP redirections mode.

You probably should create custom backup and restore hooks to integrate your app to your YunoHost backup/restore process. See [Backup and restore hooks]()
