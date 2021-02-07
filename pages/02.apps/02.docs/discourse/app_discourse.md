---
title: Discourse
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_discourse'
---

![Discourse's logo](image://discourse_logo.svg?resize=,80)

[![Install Discourse with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=discourse) [![Integration level](https://dash.yunohost.org/integration/discourse.svg)](https://ci-apps.yunohost.org/jenkins/job/discourse%20%28Community%29/lastBuild/consoleFull)

### Index

- [Limitations with YunoHost](#limitations-with-yunohost)
- [Useful links](#useful-links)

Discourse has all the usual features of a discussion forum: users, discussions, search, private messages, etc. The "mailing list" mode allows you to use most of the forum's functionalities via e-mail. Written in Ruby and JavaScript, it requires a PostgreSQL database and a mail server.[¹](#sources)

## Limitations with YunoHost

In the administration dashboard, The installed version is shown as unknown (due the fact that we don't use Git for installation); you can safely ignore that as the YunoHost package will be maintained. On ARM devices, default generated avatars are missing the profile initials (they are only a plain discus).

## Useful links

+ Website: [www.discourse.org](https://www.discourse.org/)
+ Official documentation: [www.discourse.org - customers](https://www.discourse.org/customers)
+ Application software repository: [github.com - YunoHost-Apps/discourse](https://github.com/YunoHost-Apps/discourse_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/discourse/issues](https://github.com/YunoHost-Apps/discourse_ynh/issues)

-----

### Sources

¹ [framalibre.org - Discourse (fr)](https://framalibre.org/content/discourse)
