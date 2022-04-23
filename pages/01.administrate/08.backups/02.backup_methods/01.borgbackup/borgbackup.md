---
title: BorgBackup
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/borgbackup'
page-toc:
  active: true
  depth: 3
---


YunoHost offers a couple of applications for [BorgBackup](https://www.borgbackup.org/).

## Functionality
This application offers:
* backup of data on an external disk or on a remote Borg repository
* deduplication and compression of files, which allows to keep many previous copies
* data encryption, which allows you to store data with a third party
* to define the frequency and type of data to be backed up
* a mail alert system in case of backup failure.

There are [remote borg repository providers](https://www.borgbackup.org/support/commercial.html), it is also possible to create your own repository on another YunoHost with the [borgserver application](https://github.com/YunoHost-Apps/borgserver_ynh).

The future default backup method integrated in YunoHost will be based on this software.

## Setting up the backup
!!! To set up, first install the [borg application](https://github.com/YunoHost-Apps/borg_ynh), then optionally the [borgserver application](https://github.com/YunoHost-Apps/borgserver_ynh).


## Test
With the borg apps an email is sent to say if the backup fails or if the remote repo has received nothing. However, you can manually test to make sure everything is fine in a more complete way.


```bash
# List files
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg list "$(yunohost app setting $app repository)" | less

# List database exports
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg list "$(yunohost app setting $app repository)" | grep "(db|dump)\.sql"

# List files from the archive
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg list "$(yunohost app setting $app repository)::ARCHIVE" | less

# View archive info
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg info "$(yunohost app setting $app repository)::ARCHIVE"

# Verify data integrity
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg check "$(yunohost app setting $app repository)::ARCHIVE" --verify-data
```

## Restore

If we are in the case of a migration or a reinstallation, we must reinstall borg in the same way. If the repo is remote you have to change the public key.

List the available archives
```
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg list "$(yunohost app setting $app repository)"
```

Create tar archives (one archive per app and system part)
```
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg export-tar "$(yunohost app setting $app repository)::ARCHIVE" /home/yunohost/archives/ARCHIVE.tar
```

Then restore the archive in the usual way.

### Restore large archives
If the available space is less than the weight of your archive, decompressed data and dependencies, you will have to restore part by part, app by app.

If restoring app by app is not enough OR if an archive is too big, it may be a good idea to generate a tarball without the "big" data of an app as if it had been generated with the [BACKUP_CORE_ONLY option] (/backup/include_exclude_files#don't-save-large-quantities-of-data). Example with Nextcloud:
```
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg export-tar -e apps/nextcloud/backup/home/yunohost.app "$(yunohost app setting $app repository)::ARCHIVE" /home/yunohost/archives/ARCHIVE.tar
```

You will then have to extract these data directly with borg
```
cd /home/yunohost.app/
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg extract "$(yunohost app setting $app repository)::ARCHIVE" apps/nextcloud/backup/home/yunohost.app/
mv apps/nextcloud/backup/home/yunohost.app/nextcloud ./
rm -r apps
```

Then restore in the classic way
