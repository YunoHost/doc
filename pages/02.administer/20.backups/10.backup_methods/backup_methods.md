---
title: Backup Methods
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/backup_methods'
page-toc:
  active: true
  depth: 3
---

## [BorgBackup](/borgbackup)

This application offers:

- backup of data on an external disk or on a remote Borg repository
- deduplication and compression of files, which allows to keep many previous copies
- data encryption, which allows you to store data with a third party
- to define the frequency and type of data to be backed up
- a mail alert system in case of backup failure.

## [Restic](/restic)

This application offers:

- backup of data to remote storage (support for different types of storage)
- deduplication and compression of files, which makes it possible to keep many previous copies
- data encryption, which allows to store data at a third party

## [Archivist](/archivist)

!! This application is currently broken!
This application is based on rsync and GPG, it offers:

- backup of data on a remote storage (support for different types of storage)
- data encryption, which allows to store data at a third party
