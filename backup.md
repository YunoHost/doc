# Backing up your server and apps

Backing up your server, apps and data is an important concern when administrating a server. This protects you from unexpected events that could happen (server lost in a fire, database corruption, loss of access, server compromised, ...). The backup policy you will put in place depends of the importance of the services and data hosted. For instance you won't care too much about having backup on a test server, but you will care about having a backup of critical data of your association or company, and having this backup *in a different physical place*.

## Backups in the context of YunoHost

YunoHost comes with a backup system, that allows to backup (and restore) system configurations and data (e.g. mails) and apps if they support it.

You can manage backups either from the command line (`yunohost backup --help`) or from the web administration (in the Backups section) though some features are not yet available in the webadmin.

The current default method consists in creating a `.tar.gz` archive containing all relevant files. In the future, YunoHost plans to support [Borg](https://www.borgbackup.org/) which is a more flexible, efficient and powerful solution.

## Creating backups

### From the webadmin

You can easily create backup archives from the webadmin by going in Backups > Local storage and clicking on "New backup". You will then be asked to select which configuration, data and apps you want to backup.

![picture of Yunohost's backup pannel](/images/backup.png)

### From the command line

You can create a new backup archive with the command line. Here are a few simple example of commands and their corresponding behavior :

- Backing up everything (all system parts and apps) :

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

- Backing up only mails

  ```bash
  yunohost backup create --system data_mail
  ```

- Backing up mails and wordpress

  ```bash
  yunohost backup create --system data_mail --apps wordpress
  ```

For more informations and options about backup creation, consult `yunohost backup create --help`. You can also list system parts that can be backuped with `yunohost hook list backup`.

### Apps-specific configuration

Some apps such as Nextcloud may be related to a large quantity of data. If you want you can backup the app without the user data. This practice is referred to "backing up only the core" (of the app).  
When performing an upgrade, apps with large quantity of data will, usually, do a backup without those data.

To manually disable the backup of large data, for application that implement that feature, you can set the variable `BACKUP_CORE_ONLY`. To do so, the variable have to be set before the backup command: `sudo BACKUP_CORE_ONLY=1 yunohost backup create --apps nextcloud`. Be careful though that mean you will have to backup user data yourself. But doing so, you will be able to do incremental or differential backups of this large amount of data (which is not an option provided by yunohost yet).


## Downloading and uploading backups

After creating backup archives, it is possible to list and inspect them via the corresponding views in the webadmin, or via `yunohost backup list` and `yunohost backup info <archivename>` from the command line. By default, backups are stored in `/home/yunohost.backup/archives/`.

Currently, the most accessible way to download archives is to use the program FileZilla as explained in [this page](/filezilla).

Alternatively, a solution can be to install Nextcloud or a similar app and configure it to be able to access files in `/home/yunohost.backup/archives/` from a web browser.

One solution consists in using `scp` (a program based on [`ssh`](/ssh)) to copy files between two machines via the command line. Hence, from a machine running Linux, you should be able to run the following to download a specific backup:

```bash
scp admin@your.domain.tld:/home/yunohost.backup/archives/<archivename>.tar.gz ./
```

Similarly, you can upload a backup from a machine to your server with:

```bash
scp /path/to/your/<archivename>.tar.gz admin@your.domain.tld:/home/yunohost.backup/archives/
```

## Restoring backups

### From the webadmin

Go in Backup > Local storage and select your archive. You can then select which items you want to restore, then click on 'Restore'.

![picture of Yunohost's restore pannel](/images/restore.png)

### From the command line

From the command line, you can run `yunohost backup restore <archivename>` (without the `.tar.gz`) to restore an archive. As for `yunohost backup create`, this will restore everything in the archive by default. If you want to restore only specific items, you can use for instance `yunohost backup restore --apps wordpress` which will restore only the wordpress app.

### Constraints

To restore an app, the domain on which it was installed should already be configured (or you need to restore the corresponding system configuration). You also cannot restore an app which is already installed ... which means that to restore an old version of an app, you must first uninstall it.

### Restoring during the postinstall

One specific feature is the ability to restore a full archive *instead* of the postinstall step. This makes it useful when you want to reinstall a system entirely from an existing backup. To be able to do this, you will need to upload the archive on the server and place it in `/home/yunohost.backup/archives`. Then, **instead of** `yunohost tools postinstall` you can run:

```bash
yunohost backup restore <archivename>
```

Note: If your archive isn't in `/home/yunohost.backup/archives`, you can create the directory, move the archive into it, and restore it like this:

```bash
mkdir -p /home/yunohost.backup/archives
mv /path/to/<archivename> /home/yunohost.backup/archives/
yunohost backup restore <archivename>
``` 

## To go futher

### Storing backups on a different drive

If you want, you can connect and mount an external drive to store backup archives on it (among other things). For this, we first move the existing archives then add a symbolic link.

```bash
PATH_TO_DRIVE="/media/my_external_drive" # For instance, depends of where you mounted your drive
mv /home/yunohost.backup/archives $PATH_TO_DRIVE/yunohost_backup_archives
ln -s $PATH_TO_DRIVE/yunohost_backup_archives /home/yunohost.backup/archives
```

### Automatic backups

You can add a simple cron job to trigger automatic backups regularly. For instance, to backup your wordpress weekly, create a file `/etc/cron.weekly/backup-wordpress` with the following content :

```bash
#!/bin/bash
yunohost backup create --apps wordpress
```

then make it executable :

```bash
chmod +x /etc/cron.weekly/backup-wordpress
```

Be careful what you backup exactly and when : you don't want to end up with your whole disk space saturated because you backuped 30 GB of data every day.

#### Backing your server on a remote server

You can follow this tutorial on the forum to setup Borg between two servers : <https://forum.yunohost.org/t/how-to-backup-your-yunohost-server-on-another-server/3153>

Alternatively, the app Archivist allows to setup a similar system : <https://forum.yunohost.org/t/new-app-archivist/3747>

#### Avoiding the backup of some folders
If needed, you can specify that some `/home/user` folders are left out of the `yunohost backup` command, by creating a blank file named `.nobackup` in them.

#### Full backup with `dd`

If you are using an ARM board, another method for doing a full backup can be to create an image of the SD card. For this, poweroff your ARM board, get the SD card in your computer then create a full image with something like :

```bash
dd if=/dev/mmcblk0 of=./backup.img status=progress
```

(replace `/dev/mmcblk0` with the actual device of your sd card)

You can also create a compressed image using gzip this way:
```bash
dd if=/dev/mmcblk0 | gzip > ./image.gz
```
