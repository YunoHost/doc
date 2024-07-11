---
title: Prevent hardware failures
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/prevent_hardware_failure'
page-toc:
  active: true
  depth: 3
---


## Physically secure your server

Very often people who self-host don't have proper storage for their system. Leaving the server in several parts, in a high traffic area, accessible to children or pets, or in a poorly ventilated area can quickly turn into a disaster.

## Secure your hard drives

Ideally, your hard disks should be fixed to prevent vibrations which can accelerate the wear of the equipment or even reduce its performance, especially if there is another disk next to it.

## Reduce swapiness for SD cards and SSDs

If you use a swap file with an SSD or SD card with too much swapiness, your storage media could give up the ghost prematurely due to too many writes.

To prevent this:

```bash
cat /proc/sys/vm/swappiness
```

If it is above 10:

```bash
sysctl vm.swappiness=10
nano /etc/sysctl.conf
```

If present, change the vm.swappiness value to 10. Otherwise add the line:

```text
vm.swappiness = 10
```

## Storage redundancy

In order to limit hardware failures of storage media, it can be relevant to set up a cluster of mirrored disks (RAID, ZFS). The idea here is that everything that is written to one disk will be written to the other. This way, if one fails, the other continues to work and the server is still fully functional.

There are also more advanced clusters that maximize fault tolerance (failure of 2 disks like RAID6) or storage (see RAID 5).

However, these disk clustering techniques should not be considered as backups. A RAID array should be considered as a single storage medium. Indeed, if this technique prevents having to reinstall in case of a probable disk crash, it is far from zero risk.

Some examples of situations known to professional system administrators:

- the disks of a cluster mounted with disks of the same brand can fail almost at the same time within a few hours
- without monitoring the health of the disks, there is a good chance that the failure of one disk in the cluster will only be noticed when a second one fails (><)
- if you don't have a spare disk, the delay in purchasing one may result in the other disk crashing
- a half-functional disk that produces errors can propagate its error through the cluster
- the disk connectors or the RAID controller can also produce errors or fail
- the more complex you make the architecture with many components, the more likely it is that one of them will fail

!!! If you want to set up a RAID array or use btrfs, the easiest way is to do it at installation with the YunoHost iso in expert mode (when partitioning the system).
