---
title: Snapshotting the entire filesystem
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/clone_filesystem'
page-toc:
  active: true
  depth: 3
---

YunoHost's backup tool only backs up useful files and relies on restore scripts to reinstall the dependencies of your applications. In other words, YunoHost's mechanism amounts to reinstalling and then reincorporating the data.

Making full system images can be a complementary or alternative way to backup your machine. The advantage is that your system can be restored to the exact state it was in at the time of the backup.

Depending on your type of installation, you can either create a snapshot or clone the storage medium by removing it from your server (turned off).

## Creating a snapshot

A snapshot allows you to freeze an image of the file system. Snapshots are very useful when doing an update or testing, because they allow you to easily go back in case of a glitch. On the other hand, apart from some very high availability clusters, snapshots do not really protect you against hardware failures or disasters (cf. OVH fire in Strasbourg in 2021).

In general, snapshots are quite disk space saving, the principle is that your file system will store the differences that occurred since your snapshot. Thus, only the modifications consume space.

! Remember to delete the old snapshots to avoid wasting your storage space by storing all the differences since that date!

You can use this method with most VPS (often paying), virtual machine managers or if you have installed YunoHost with an advanced filesystem like btrfs, ceph or ZFS, you can also create snapshots via the command line

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="VPS"]
Below, some documentation for the most known suppliers:

- [DigitalOcean (EN)](https://docs.digitalocean.com/products/images/snapshots/)
- [Gandi](https://docs.gandi.net/fr/simple_hosting/operations_courantes/snapshots.html)
- [OVH](https://docs.ovh.com/fr/vps/snapshot-vps/)
- [Scaleway (EN)](https://www.scaleway.com/en/docs/backup-your-data-with-snapshots/)
[/ui-tab]
[ui-tab title="VirtualBox"]
Select the virtual machine and click `Snapshots`, then specify the snapshot name and click `OK`.
![The snapshot button is located at the top right](image://virtualbox-snapshot2.webp)

To restore, select the virtual machine, click on `Snapshots` then `Restore Snapshot option`.
![](image://virtualbox-snapshot3.webp)

Then click on `Restore Snapshot`.
![](image://virtualbox-snapshot4.webp)
[/ui-tab]
[ui-tab title="Proxmox"]

- Select the virtual machine
- Go to the `Backup` tab
- Click on `Backup now`.
- Choose `Snapshot` mode
- Validate
[/ui-tab]
[ui-tab title="BTRFS"]
Below we consider that `/pool/volume` is the volume to snapshot.

Create a read-only snapshot

```bash
btrfs subvolume snapshot /pool/volume /pool/volume/$(date +"%Y-%m-%d_%H:%M")
```

List snapshots

```bash
btrfs subvolume show /pool/volume
```

Restore a snapshot

```bash
btrfs sub del /pool/volume
btrfs sub snap /pool/volume/2021-07-22_16:12 /pool/volume
btrfs sub del /pool/volume/2021-07-22_16:12
```

Delete a snapshot

```bash
btrfs subvolume delete /pool/volume/2021-07-22_16:12
```

!! Be careful not to delete the original volume

!!! See [this tutorial](https://www.linux.com/training-tutorials/how-create-and-manage-btrfs-snapshots-and-rollbacks-linux-part-2/) for more info
[/ui-tab]
[ui-tab title="CEPH"]
Below we consider that `pool/volume` is the volume to snapshot.

Create a snapshot

```bash
rbd snap create pool/volume@$(date +"%Y-%m-%d_%H:%M")
```

List snapshots

```bash
rbd snap ls pool/volume
```

Restore a snapshot

```bash
rbd snap rollback pool/volume@2021-07-22_16:22
```

Delete a snapshot

```bash
rbd snap rm pool/volume@2021-07-22_16:12
```

[/ui-tab]
[ui-tab title="ZFS"]
Below we consider that `pool/volume` is the volume to snapshot.

Create a snapshot

```bash
zfs snapshot pool/volume@$(date +"%Y-%m-%d_%H:%M")
```

List snapshots

```bash
zfs list -t snapshot -o name,creation
```

Restore a snapshot

```bash
zfs rollback pool/volume@2021-07-22_16:22
```

Delete a snapshot

```bash
zfs destroy pool/volume@2021-07-22_16:12
```

[/ui-tab]
[/ui-tabs]

## Create a cold image of the file system

You can clone your media (SD card, ssd disk, VPS volume...) to create a disk image. This image before compression will be the exact size of your media, that's why this method applies rather to machines of less than 64GB.

Unless you can read a snapshot, this method requires you to stop the server while you create the image. With a VPS, you have to restart in rescue mode from your provider's interface.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="With USBimager"]
This can be done with [USBimager](https://bztsrc.gitlab.io/usbimager/) (Note: make sure you download the 'Read-write' version! Not the 'Write-only' version!). The process then consists of the "reverse" of the SD card flashing process:

- Turn off your server
- Retrieve the SD card and plug it into your computer
- In USBimager, click on "Read" to create an image ("photograph") of the SD card. You can use the resulting file to restore the whole system later.

More details in [USBimager documentation](https://gitlab.com/bztsrc/usbimager/#creating-backup-image-file-from-device)
[/ui-tab]
[ui-tab title="In command line with dd"]

It is possible to achieve the same thing with `dd` if you are comfortable with the command line:

```bash
dd if=/dev/mmcblk0 | gzip > ./my_snapshot.gz
```

(replace `/dev/mmcblk0` with the real name of your SD card or hard drive)

[/ui-tab]
[/ui-tabs]
