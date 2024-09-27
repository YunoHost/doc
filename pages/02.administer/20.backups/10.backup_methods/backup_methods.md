---
title: Backup methods
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/backup_methods'
page-toc:
  active: true
  depth: 3
---

YunoHost currently has three apps integrating backup solutions offering more features than the simple ".tar" mechanism shipped in YunoHost, in particular automatic and remote backups.

## [BorgBackup](https://www.borgbackup.org/) (cf the [Borg "client"](https://apps.yunohost.org/app/borg) and [Borg "server"](https://apps.yunohost.org/app/borgserver) apps)

- backup of data on an external disk or on a remote Borg repository
- deduplication and compression of files, which makes it possible to keep many previous copies without too much storage overhead
- data encryption, which allows you to store data with a third party
- to define the frequency and type of data to be backed up
- a mail alert system in case of backup failure.

There are [remote borg repository providers](https://www.borgbackup.org/support/commercial.html), it is also possible to create your own repository on another YunoHost with the [borgserver application](https://github.com/YunoHost-Apps/borgserver_ynh).

## [Restic](https://restic.net/) (cf the [Restic app](https://apps.yunohost.org/app/restic))

- backup of data to remote storage (support for different types of storage, inclusing S3 and SFTP)
- deduplication and compression of files, which makes it possible to keep many previous copies without too much storage overhead
- data encryption, which allows to store data at a third party
- to define the frequency and type of data to be backed up
- a mail alert system in case of backup failure.


## [Archivist](https://apps.yunohost.org/app/archivist)

!! This application is currently broken!

- based on rsync and GPG
- backup of data on a remote storage (support for different types of storage)
- data encryption, which allows to store data at a third party

The package also allows you to finely define the frequency and type of data to be backed up and integrates an email alert system in case of backup failure.

More info: <https://forum.yunohost.org/t/new-app-archivist/3747>
