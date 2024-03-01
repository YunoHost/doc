---
title: Restic
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/restic'
page-toc:
  active: true
  depth: 3
---


## Functionality

This application offers:
* backup of data to remote storage (support for different types of storage)
* deduplication and compression of files, which makes it possible to keep many previous copies
* data encryption, which allows to store data at a third party

The package also allows you to finely define the frequency and type of data to be backed up and integrates an email alert system in case of backup failure.
