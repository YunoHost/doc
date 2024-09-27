---
title: Installing "custom" apps
template: docs
taxonomy:
    category: docs
routes:
  default: '/custom_apps'
---

While YunoHost has many apps available in the catalog, you may want to install apps that are not available in the official catalog, or setup your very own website that you crafted using HTML / CSS / PHP ..

## Installing your very own webapp

A special application exists called "Custom webapp" or "My webapp" : <https://apps.yunohost.org/app/my_webapp>

It can be seen as "an empty shell" in which you can drop your own HTML, CSS, JS, etc files through SFTP or other means. It also supports PHP, and an SQL database can be initialized.

## Adding a reverse proxy to an app that you manually installed, for example using Docker

While YunoHost apps do not use Docker for reasons that are beyond the scope of this page, you can manually install Docker apps on your server (assuming you know what you do and won't tinker too much the base system ...). However, this is not limiter to Docker, you may have deployed "manually" an app using Python, Ruby or other language, and such app usually listen to a specific port.

Once your app or container is setup, you will probably need to actually *expose* the container on the web on a specific URL. This can be done using another special app called Redirect (which could also be called ... Reverse proxy) : <https://apps.yunohost.org/app/redirect>

Make sure to chose the reverse proxy mode, and point it to something like `http://127.0.0.1:PORT` where `PORT` is the port of your custom app.

It will add the appropriate configuration bits in Nginx, SSOwat and a tile in the user portal.

## Adding a custom tile in the portal pointing to an external app

The Redirect app (<https://apps.yunohost.org/app/redirect>) can also be used add a "shortcut" tile in the user portal that points to an app or page located on a completly different server. Make sure to use the "explicit redirect" mode and the URL of the external page or app.

Generally, you should refrain from manually tinkering and installing apps, except if you are sure they will not interfere with your server. YunoHost proposes two generic apps to help you out:
