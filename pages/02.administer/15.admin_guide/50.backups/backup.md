---
title: Backing up your server
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup'
---

In the context of self-hosting, backups are an important element to compensate for unexpected events (fire, database corruption, loss of access to the server, compromised server...). The backup policy to implement depends on the importance of the services and data you manage. For example, backing up a test server will be of little interest, while you will want to be very careful if you are managing critical data for an association or a company - and in such cases, you will want to store the backups *in a different location or locations*.

## Manual backup

### Backup

YunoHost comes with a backup system, that allows you to backup (and restore) system configurations and data (e.g. emails) and apps if they support it.

You can manage backups either from the command line (`yunohost backup --help`) or from the web administration (in the Backups section), though some features are not yet available in the webadmin.

The current default method consists in creating a `.tar` archive containing all relevant files.

#### Creating backups

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="From the webadmin"]

You can easily create backup archives from the webadmin by going to `Backups > Local storage` and clicking on `New backup`. You will then be asked to select which configuration, data and apps you want to backup.

![picture of YunoHost's backup pannel](image://backup.png)

[/ui-tab]
[ui-tab title="From the command line"]

You can create a new backup archive from the command line. Here are a few simple examples of commands and their corresponding behavior:

- Backing up everything (all system parts and apps):

  ```bash
  yunohost backup create
  ```

- Backing up only apps

  ```bash
  yunohost backup create --apps
  ```

- Backing up only two apps (wordpress and shaarli)

  ```bash
  yunohost backup create --apps wordpress shaarli
  ```

- Backing up only emails

  ```bash
  yunohost backup create --system data_mail
  ```

- Backing up emails and wordpress

  ```bash
  yunohost backup create --system data_mail --apps wordpress
  ```

For more information and options about backup creation, consult `yunohost backup create --help`. You can also list the system parts that can be backed up with `yunohost hook list backup`.
[/ui-tab]
[/ui-tabs]

#### Downloading backups

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="From the webadmin"]
After creating backups, it is possible to list and inspect them using the corresponding views in the web administration interface. A button allows you to download the archive. If the archive is larger than 3GB, it may be better to proceed via SFTP.

`Backup > Local Archives > <Archive name> > Download`

[/ui-tab]
[ui-tab title="With a SFTP client"]
Currently, the most accessible way to download big archives is to use the program FileZilla as explained in [this page](/filezilla).

By default, backups are stored in `/home/yunohost.backup/archives/`.

[/ui-tab]
[ui-tab title="From the command line"]
The `yunohost backup list` and `yunohost backup info <archive_name>` commands provide information about the names and sizes of backups.

It is possible to use `scp` (a program based on [`ssh`](/ssh)) to copy files between two machines via the command line. So, from a GNU/Linux machine, you can use the following command to download an archive:

```bash
scp admin@your.domain.tld:/home/yunohost.backup/archives/<archive_name>.tar ./
```

If your SSH port is different from 22

```bash
scp -P ssh_port admin@your.domain.tld:/home/yunohost.backup/archives/<archive_name>.tar ./
```

[/ui-tab]
[/ui-tabs]

! Don't forget to store your backup in a different place to your server.


!!! If you want, you can connect an external disk to your server so that the archives arrive directly on it. See this guide to [Adding external storage to your server](/external_storage)

### Testing

You should regularly test your backups by at least listing the contents of the archives and checking the size of the associated data. It is best to practice restoring regularly.
```bash
# List the files
tar -tvf /home/yunohost.backup/archives/ARCHIVE.tar | less

# List database exports
tar -tvf /home/yunohost.backup/archives/ARCHIVE.tar | grep "(db|dump)`.sql"

# Check the weight
ls -lh /home/yunohost.backup/archives/ARCHIVE.tar
```

### Restoring backups
!!! SPOILER: The larger your data volume and the more applications you have, the more complex your recovery will be.

#### Simple case: little data, archive already present
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="From the webadmin"]

Go in `Backup > Local storage` and select your archive. You can then select which items you want to restore, then click on 'Restore'.

![picture of YunoHost's restore pannel](image://restore.png)

[/ui-tab]
[ui-tab title="From the command line"]

From the command line, you can run `yunohost backup list` to get the available archive names. They are basically their file name without extension.

You can then run `yunohost backup restore <archivename>` (hence without its `.tar` extension) to restore an archive. As for `yunohost backup create`, this will restore everything in the archive by default. If you want to restore only specific items, you can use something like `yunohost backup restore <archivename> --apps wordpress`, which will restore only the wordpress app.

!!! In the case of a complete restoration, it is possible to restore instead of launching the initial configuration.
[/ui-tab]
[/ui-tabs]

To restore an app, the domain on which it was installed should already be configured (or you need to restore the corresponding system configuration). You also cannot restore an app which is already installed... which means that to restore an old version of an app, you must first uninstall it.

#### Upload an archive

In many cases, the archive is not on the server on which you want to restore it. So it has to be uploaded, which depending on its size can take more or less time.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="With an SFTP client"]
Currently, the most accessible solution for uploading backups is to use the FileZilla program as explained in [this page](/filezilla).

By default, backups are to be placed in `/home/yunohost.backup/archives/`.
[/ui-tab]
[ui-tab title="From the command line"]
You can upload a backup from a machine to your server with :

```bash
scp /path/to/your/<archive_name>.tar admin@your.domain.tld:/home/yunohost.backup/archives/
```

If your SSH port is different from 22

```bash
scp -P ssh_port /path/to/your/<archive_name>.tar admin@your.domain.tld:/home/yunohost.backup/archives/
```

[/ui-tab]
[/ui-tabs]

## Automatic or remote backup

There are 3 YunoHost applications that offer to extend YunoHost with an automated backup method.

 * [BorgBackup](/backup/borgbackup)
 * [Restic](/backup/restic)
 * [Archivist](/backup/archivist)

## Go further

 * [Evaluate the quality of your backup](/backup/strategies)
 * [Clone your file system](/backup/clone_filesystem)
 * [Avoid a hardware failure](/backup/avoid_hardware_failure)
 * [Include/exclude files](/backup/include_exclude_files)
 * [Custom methods](/backup/custom_backup_methods)
 * [Migrate or merge servers](/backup/migrate_or_merge_servers)


