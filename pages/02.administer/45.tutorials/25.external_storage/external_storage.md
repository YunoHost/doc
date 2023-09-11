---
title: Adding an external storage to your server
template: docs
taxonomy:
    category: docs
routes:
  default: '/external_storage'
  aliases:
    - '/moving_app_folder'
---

## Introduction
 

Apart from the monitoring system that ensures that your system's partitions are not too small, YunoHost does not currently deal with the organisation of your partitions and disks.

If you are hosting on an ARM card with an SD card or on a server with a small SSD drive, you may, for reasons of reliability or lack of space, want to add a drive or drives to your server.

! If you have no space left on your server at all, you can now type `apt clean` to try and save some space while you clean up or follow the steps below.

Below you will find explanations on how to move your data to a hard disk in a correct way with a minimum of impact on the functioning of YunoHost. This operation can be done during installation or, afterwards, when your storage needs have increased or when you no longer trust your SD card.

!!! The method presented here will first mount the single partition of the hard disk, then use one or more sub-folders of this disk to create different mount points on your system tree. This method is preferable to the use of symbolic links, as the latter may interfere with some applications including the YunoHost backup system. You could also choose to mount partitions rather than subfolders, but it is sometimes difficult to estimate the weight of a folder in advance.

## [fa=list-alt /] Prerequisites

* Have some time at a moment when your server users can accept a shutdown. The steps to be performed, even if they are relatively simple, can sometimes seem technical and require in any case **to take your time**.

* Know how to connect as root on your system, for example via [SSH](/ssh). (Note: while logged in as `admin`, you can root with `sudo su`)

* Know the basic commands `cd`, `ls`, `mkdir`, `rm`.

* Have a backup in case things don't work out as planned

* Have extra storage (SSD, hard drive, USB stick) connected to your server via USB or SATA

## 1. Identify directories to be moved

The `ncdu /` command allows you to browse the folders on your server to see how big they are. 

Below is an explanation of some of the paths that can take up weight with some comments to help you reduce their weight or choose to move them.

| Paths | Contents | Tips |
|--------|---|---|
| `/home` | User folders accessible via SFTP | Moveable to a hard disk |
| `/home/yunohost.backup`       | YunoHost's backups  | Depending on your backup strategy, you may want to place this folder on a separate drive from your data or databases.
| `/home/yunohost.app`          |Heavy data from yunohost applications (nextcloud, matrix...)|Moveable to a hard disk
| `/home/yunohost.multimedia` | Heavy data shared between several applications | Moveable to a hard disk |
| `/var/lib/mysql` | Database used by applications | Ideally leave on SSD for performance reasons |
| `/var/lib/postgresql` | Database used by applications | Ideally leave on SSD for performance reasons |
| `/var/mail` | User e-mails | Movable to a hard disk |
| `/var/www` | Program of installed web applications | Ideally leave on SSD for performance reasons |
| `/var/log` | Event logs (pages consulted, connection attempts, hardware errors...). | This directory should not take up too much space, if it grows quickly, it may be a looping error that should be resolved.
| `/opt` | Program and dependency of some YunoHost applications. | Ideally leave it on the SSD for performance reasons. For nodejs applications it is possible to do some cleanup of unused versions.
| `/boot` | Kernels and boot files | Do not move unless you know what you are doing. It can happen that too many kernels are kept, it is possible to do some cleanup.


## 2. Connect and identify the disk

Start by connecting your disk to your system. You must then identify the name under which the disk is designated by the system.

To do this, use the command :

```bash
lsblk
```

It may return something like :

```bash
NAME        MAJ:MIN RM   SIZE RO TYPE MOUNTPOINT
sda           8:0    0 931.5G  0 disk
└─sda1        8:1    0 931.5G  0 part
mmcblk0     179:0    0  14.9G  0 disk
├─mmcblk0p1 179:1    0  47.7M  0 part /boot
└─mmcblk0p2 179:2    0  14.8G  0 part /
```

Here, `mmcblk0` corresponds to a 16GB SD card (you can see that the `mmcblk0p1` and `mmcblk0p2` partitions correspond to the `/boot` partition and the `/` system partition). The hard drive connected corresponds to `sda` which is about 1TB, and contains a single `sda1` partition which is not mounted (no "MOUNTPOINT").

! [fa=exclamation-triangle /] On another system, it may be that your system is installed on `sda` and your disk is then `sdb` for example.

!!! Tip: if the size of the disk is not enough for you to recognise it, you can unplug the disk, run the `lsblk` command, then plug the disk back in, run `lsblk` and deduce the differences.

## 3. (Optional) Format the disk

This operation is optional if your disk is already formatted with a file system supported by linux (so not NTFS or FAT32).

Let's create a partition on the disk:

```bash
fdisk /dev/YOUR_DISK
```

then enter `n`, `p`, `1`, `Enter`, `Enter`, and `w` successively to create a new partition.

Check with `lsblk` that you have your disk containing a single partition.

Before you can use your disk, it must be formatted.

! [fa=exclamation-triangle /] **Formatting a disk means deleting all the data on it! Be careful not to get the name wrong, as this may result in formatting a different disk than the one you want! In the example given earlier, it was `/dev/sda`. If your disk is already "clean", you can skip this step.

To format the :

```bash
mkfs.ext4 /dev/YOUR_DISK1
# then 'y' to validate
```

Replace `YOUR_DISK1` with the name of the first partition on the disk e.g. `sda1`.

!!! It is possible to adapt this step, for example to create a raid 1 volume (mirrored disks) or encrypt the folder. 

## 4. Mount the disk

Unlike Windows where disks are accessed with letters (C:/), under Linux, disks are made accessible via the file tree. "Mounting" a disk means making it effectively accessible in the file tree. We will arbitrarily choose to mount the disk in `/mnt/hdd` but you can name it differently (e.g. `/mnt/disk` ...).

Let's start by creating the directory :
```bash
mkdir /mnt/hdd
```

Then we can mount the disk manually with :

```bash
mount /dev/YOUR_DISK1 /mnt/hdd
```

(Here, `/dev/YOUR_DISK1` corresponds to the first partition on the disk)

## 5. Mount a /mnt/hdd folder on one of the folders you want to move data from

Here we will consider that you want to move the big data of the applications which are in /home/yunohost.app and the mails on your hard disk.

### 5.1 Creating subfolders on the disk
To begin with, we create a folder on the hard drive

```bash
mkdir -p /mnt/hdd/home/yunohost.app
mkdir -p /mnt/hdd/var/mail
```

### 5.2 Switching to maintenance mode
Then, ideally, we switch to maintenance mode the applications that might be writing data.

Example, for nextcloud:

```bash
sudo -u nextcloud /var/www/nextcloud/occ maintenance:mode --on
```

Example, for mail:

```bash
systemctl stop postfix
systemctl stop dovecot
```

! If you wish to move databases such as mariadb (mysql), it is imperative that you stop the services for these databases otherwise it is almost certain that your data will be corrupted.

### 5.3 Creating the mount points

Next, we will rename the original folder and create an empty eponymous folder.

```bash
mv /home/yunohost.app /home/yunohost.app.bkp
mkdir /home/yunohost.app
mv /var/mail /var/mail.bkp
mkdir /var/mail
```

We can then use the `mount --bind` command to mount the folder on our hard drive to the new empty location in the tree.

```bash
mount --bind /mnt/hdd/home/yunohost.app /home/yunohost.app
mount --bind /mnt/hdd/var/mail /var/mail
```

### 5.4 Copying the data

Next, we copy the data, keeping all the folder and file properties. This operation can take a little time, with another terminal, you can control the evolution by observing the weight associated with the mount point with `df -h`

```bash
cp -a /home/yunohost.app.bkp/. /home/yunohost.app/
cp -a /var/mail.bkp/. /var/mail/
```

Once this is done, check with `ls` that the contents are there:

```bash
ls -la /home/yunohost.app/
ls -la /var/mail/
```

### 5.5 Exiting maintenance mode

From here you can stop maintenance mode, the command below is to be adapted depending on the services you have stopped.

```bash
sudo -u nextcloud /var/www/nextcloud/occ maintenance:mode --off
systemctl start postfix
systemctl start dovecot
```

From this point on, your services are running with their data on disk, so it's time to test to see how much of an impact this has on performance (especially if you are using USB 2.0).

## 6. Automatically mount on boot


So far we have manually mounted the disk and subfolders. However, it is necessary to configure the system to automatically mount the disk after a boot.

If your tests are successful, you should keep the mount points, otherwise you should hurry up and go back to maintenance first.

To begin with, let's find the UUID (universal identifier) of our disk with :

```bash
blkid | grep "/dev/YOUR_DISK1:"
# Returns something like :
# /dev/sda1:UUID="cea0b7ae-2fbc-4f01-8884-3cb5884c8bb7" TYPE="ext4" PARTUUID="34e4b02c-02"
```

Let's add a line to the `/etc/fstab` file that handles the mounting of disks at boot time. So we open the file with `nano` :

```bash
nano /etc/fstab
```

Then add these lines to the end of the file:

```bash
UUID="cea0b7ae-2fbc-4f01-8884-3cb5884c8bb7" /mnt/hdd ext4 defaults,nofail 0 0
/mnt/hdd/home/yunohost.app /home/yunohost.app none defaults,bind 0 0
/mnt/hdd/var/mail /var/mail none defaults,bind 0 0
```

(this line must be adapted according to the previous information and choices)

Use Ctrl+X then `y` to save.

You can then try rebooting the system to check if the disk and subfolders are mounted automatically.

## 7. Clean up old data
Once your new setup is validated, you can proceed to delete the old data from step 6.3:

```bash
rm -Rf /home/yunohost.app.bkp
rm -Rf /var/mail.bkp
```

## ![](image://tada.png?resize=32&classes=inline) Congratulations!

If you have made it this far without damage, you now have a server that takes advantage of one or more storage disks.
