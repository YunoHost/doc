---
title: What is YunoHost?
template: docs
taxonomy:
    category: docs
routes:
  default: '/whatsyunohost'
---

![YunoHost logo](image://YunoHost_logo_vertical.png?resize=400&id=ynhlogo)

YunoHost is an **operating system** aiming to simplify **server administration** and therefore democratize [self-hosting](/selfhosting) while making sure it stays reliable, secure, ethical and lightweight. It is a copylefted libre software project maintained exclusively by volunteers. Technically, it can be seen as a distribution based on [Debian GNU/Linux](https://debian.org) and can be installed on [many kinds of hardware](/install).

## Features

- ![](image://icon-debian.png?resize=32&classes=inline) Based on Debian, for a trustworthy & familiar base;
- ![](image://icon-tools.png?resize=32&classes=inline) Administer your server through a **friendly web interface** as well as a handy CLI;
- ![](image://icon-package.png?resize=32&classes=inline) Deploy **apps in just a few clicks** from [our more than 500 apps catalog](https://apps.yunohost.org)!;
- ![](image://icon-users.png?resize=32&classes=inline) Manage **users** <small>(based on LDAP)</small>;
- ![](image://icon-globe.png?resize=32&classes=inline) Manage **domain names**;
- ![](image://icon-medic.png?resize=32&classes=inline) Create and restore **backups**;
- ![](image://icon-door.png?resize=32&classes=inline) Connect to all apps simultaneously through the **user portal** <small>(NGINX, SSOwat)</small>;
- ![](image://icon-mail.png?resize=32&classes=inline) Includes a **full e-mail stack** <small>(Postfix, Dovecot, Rspamd, DKIM)</small>;
- ![](image://icon-lock.png?resize=32&classes=inline) Manages **SSL certificates** <small>(based on Let's Encrypt)</small>;
- ![](image://icon-shield.png?resize=32&classes=inline)... and **security systems** <small>(`fail2ban`, `yunohost-firewall`)</small>.

## Origin

YunoHost was created in February 2012 after something like this:

> "Shit, I'm too lazy to reconfigure my mail server... Beudbeud, how were you able to get your little server running with LDAP?"
> <small>Kload, February 2012</small>

All that was needed was an admin interface for Beudbeud's server to make something usable, so Kload decided to develop one. Finally, after automating several configs and packaging in some web apps, YunoHost v1 was finished.

Noting the growing enthusiasm around YunoHost and around self-hosting in general, the original developers along with new contributors decided to start work on version 2, a more extensible, more powerful, more easy-to-use, and at that, one that makes a nice cup of fair-trade coffee for the elves of Lapland.

The name **YunoHost** comes from the jargon "[Y U NO](https://knowyourmeme.com/memes/y-u-no-guy) Host". The [Internet meme](https://en.wikipedia.org/wiki/Internet_meme) should illustrate it:
![The meme in question, showing a guy with a face bent in frustration and questioning "Y U NO Host"](image://dude_yunohost.jpg)

## What YunoHost is not?

Even if YunoHost can handle multiple domains and multiple users, it is **not meant to be a mutualized system**.

First, the software is too young, not tested at scale and thus probably not optimized well enough for hundreds of users at the same time. With that said, we do not want to lead the software in that direction. Virtualization democratizes, and its usage is recommended since it is a more watertight way to achieve mutualization than a "full-stack" system like YunoHost.

You can host your friends, your family and your company safely and with ease, but you must **trust your users**, and they must trust you above all. If you want to provide YunoHost services for unknown persons anyway, a full VPS per user will be just fine, and we believe a better way to go.

## Artworks

Black and white YunoHost PNG logo by ToZz (400 × 400 px). Licence: CC-BY-SA 4.0. Logos and other artwork are available in <https://github.com/YunoHost/yunohost-artwork>

![Black logo](image://ynh_logo_black_300dpi.png?resize=220) ![White logo](image://ynh_logo_white_300dpi.png?resize=220&id=whitelogo)

