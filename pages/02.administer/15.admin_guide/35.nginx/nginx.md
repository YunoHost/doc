---
title: Web server with NGINX
template: docs
taxonomy:
    category: docs
routes:
  default: '/web_server'
---

YunoHost ships [NGINX](https://www.nginx.com/), a web server and reverse proxy software. That's the keystone that enables your apps and YunoHost services to be accessible online.

Most of the web applications installed with YunoHost will automatically have their own configuration file created for NGINX.

## Manually installing apps, or exposing existing apps

Generally, you should refrain from manually tinkering and installing apps, except if you are sure they will not interfere with your server. YunoHost proposes two generic apps to help you out:

- If you already have a website ready to be deployed, consider using a **Custom Webapp**. It allows you to easily setup a directory into which you can upload your HTML, PHP, CSS, JS files with SFTP, and a database if needed.

- If you want to use YunoHost as a reverse proxy, i.e. serve an app from another server or an internal web server (think NodeJS, Ruby, Python, ...), you can use the **Redirect app** in proxy mode.

- The **Redirect app** can also simply run in redirect mode, for example to create shortcuts for your users in their SSO page, or redirect `www.yourdomain.tld` to `yourdomain.tld`.

For more information on these apps, and for more application use cases, have a look to the [Tutorials](/tutorials) section.

!! Do not try to install Apache or other public web servers. This will break your system.