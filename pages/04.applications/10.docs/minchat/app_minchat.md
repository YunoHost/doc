---
title: Minchat
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_minchat'
---

[![Installer Minchat with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=minchat) [![Integration level](https://dash.yunohost.org/integration/minchat.svg)](https://dash.yunohost.org/appci/app/minchat)

*Minchat* is a free minimalist chat application. It is based on [wojtek77/chat](https://github.com/wojtek77/chat), itself based on [Gabriel Nava's tutorial](http://code.tutsplus.com/tutorials/how-to-create-a-simple-web-based-chat-application--net-5931).

### Screenshots

![Screenshot of Minchat](https://github.com/YunoHost-Apps/minchat_ynh/blob/master/doc/screenshots/minchat_ynh_screenshot01.gif)

### Disclaimers / important information

#### Setup

The setup is optional. If you leave it as is, there is a single unnamed room, opened to all users. If you want to customize the access control, edit the file `conf/setup.ini` (if missing, copy it from `conf/sample/setup.ini`). The interesting parameter is `auth` that indicates which user is authorized to which room.

In this example `auth = John:Game,John:Family,Mary:Game,Tim:Family,admin:*,*:Public,*:`,
- `John:Game,John:Family` = John can access the Game room, the Family room 
- `Mary:Game` = Mary can access the Game room 
- `Tim:Family` = Tim can access the Family room 
- `admin:*` = admin can access all rooms
- `*:Public` = everybody can acccess the Public room
- `*:` = everybody  can access the unnamed room

#### Hints for users

- The URLs you send are linked or transformed to images when preceeded by a `!`
- If multiple rooms are allowed by the administrator in the `setup.ini`, you can have several tabs opened to different rooms in the same browser.

## Useful links

+ Website: [github.com/wojtek77/chat](https://github.com/wojtek77/chat)
+ Application software repository: [github.com - YunoHost-Apps/minchat](https://github.com/YunoHost-Apps/minchat_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/minchat/issues](https://github.com/YunoHost-Apps/minchat_ynh/issues)
