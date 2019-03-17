# Adding an external storage to your server

## Introduction

If you did not allocate a large partition to `/home` before installing YunoHost, and that your apps require a lot of spaces, you can still add an external driver after setting up your system.

## Before starting

Even though these steps are relatively simple, they may appear technical. In any case, they require you to **take your time**.

You should be connected as root on your server, for instance via [SSH](/ssh). (Note: being logged as `admin`, you can upgrade to `root` with the command `sudo su`)

It can be useful to [create a backup](/backup) of your install before starting.

You should also have your external drive (plugged via USB or SATA).

## 1. Connect and identify the disk

Start by connecting your drive to the system. You shall then identify which name is used by the system to refer to the disk.

You can do this with this command :

```bash
lsblk
```

It may yield something like this :

```bash
NAME        MAJ:MIN RM   SIZE RO TYPE MOUNTPOINT
sda           8:0    0 931.5G  0 disk
└─sda1        8:1    0 931.5G  0 part
mmcblk0     179:0    0  14.9G  0 disk
├─mmcblk0p1 179:1    0  47.7M  0 part /boot
└─mmcblk0p2 179:2    0  14.8G  0 part /
```

Here, `mmcblk0` corresponds to an SD card of 16Go (the partitions `mmcblk0p1` et `mmcblk0p2` are used as the boot partition `/boot` and the system partition `/`). The external drive is `sda` which is about 1TB and has only one partition `sda1` which is not mounted (no "MOUNTPOINT").

<div class="alert alert-warning" markdown="1">
<span class="glyphicon glyphicon-warning-sign"></span> On a different setup, your system partition might be `sda` and so your external drive might be `sdb` for instance.
</div>

## 2. (Optional) Format the disk

This operation is optional if your disk has already been formatted.

First let's create a new partition on the disk :

```bash
fdisk /dev/YOUR_DISK
```

then sucessfully type `n`, `p`, `1`, `Enter`, `Enter`, then `w` to create the new partition.

Check with `lsblk` that your disk really does contain a single partition.

Before you can use your disk it has to be formatted.

You should be aware that **formating a drive implies to erasing every data on it !** If your disk is already "clean", you may ignore this step.

To format the partition :

```bash
mkfs.ext4 /dev/YOUR_DISK1
# then 'y' to validate
```

(Replace `YOUR_DISK1` by the name of the first partition on the disk. Be careful not to do any mistake here, as it can mean erasing data on your main system if you are using the wrong name ! In the previous example, the name of our disk was `sda`.)


## 3. Mount the disk

"Mounting" a disk corresponds to making it effectively accessible in the filesystem tree. Here, we choose the arbitrary name `/media/storage` but you can choose a different name (for instance, `/media/my_disk` ... ).

Let's start by creating the directory :

```bash
mkdir /media/storage
```

Then we can manually mount the disk with :

```bash
mount /dev/YOUR_DISK1 /media/storage
```

(Here, `/dev/YOUR_DISK1` corresponds to the first partition on the disk)

Next, you should be able to create files in `/media/storage`, and, for instance, add `/media/storage` as an external drive in Nextcloud.

## 4. Mount the disk automatically at boot

So far, we only mounted the disk manually. But it can be nice and useful to have it being mounted automatically at each boot.

Let's start by finding the UUID (universal identifier) of the disk with :

```bash
blkid | grep "/dev/YOUR_DISK1:"
# Should return something like
# /dev/sda1:UUID="cea0b7ae-2fbc-4f01-8884-3cb5884c8bb7" TYPE="ext4" PARTUUID="34e4b02c-02"
```

Let's add a line in the file `/etc/fstab` which manages which disks are mounted at boot. We open this file with `nano` :

```bash
nano /etc/fstab
```

And add this line :

```bash
UUID="cea0b7ae-2fbc-4f01-8884-3cb5884c8bb7" /media/storage ext4 defaults,nofail 0 0
```

(this line should be adapated according to previous info and choices)

Use Ctrl+X then `y` to save.

You can then reboot the system to test if the disk is mounted automatically.

