---
title: Borg
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_borg'
---

![borg's logo](image://borg_logo.svg?resize=,80)

[![Install Borg with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=borg) [![Integration level](https://dash.yunohost.org/integration/borg.svg)](https://dash.yunohost.org/appci/app/borg)

### Index

- [Useful links](#useful-links)

BorgBackup (short: Borg) is a deduplicating backup program. Optionally, it supports compression and authenticated encryption.

The main goal of Borg is to provide an efficient and secure way to backup data. The data deduplication technique used makes Borg suitable for daily backups since only changes are stored. The authenticated encryption technique makes it suitable for backups to not fully trusted targets.[¹](#sources)

## Useful links

+ Website: [www.borgbackup.org](https://www.borgbackup.org/)
+ Official documentation: [borgbackup.readthedocs.io](https://borgbackup.readthedocs.io/en/stable/)
+ Application software repository: [github.com - YunoHost- Apps/borg](https://github.com/YunoHost-Apps/borg_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/borg/issues](https://github.com/YunoHost-Apps/borg_ynh/issues)

------

### Sources

¹ [borgbackup.readthedocs.io](https://borgbackup.readthedocs.io/en/stable/#what-is-borgbackup)
