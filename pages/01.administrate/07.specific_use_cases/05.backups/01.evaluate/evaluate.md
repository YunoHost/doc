---
title: Backup strategies
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup_strategies'
page-toc:
  active: true
  depth: 3
---


In the context of self-hosting, backups are an important element to compensate for unexpected events (fire, database corruption, loss of access to the server, compromised server...). The backup policy to implement depends on the importance of the services and data you manage. For example, backing up a test server will be of little interest, while you will want to be very careful if you are managing critical data for an association or a company - and in such cases, you will want to store the backups *in a different location or locations*.

## What is a good backup ?
A good backup consists of at least **3 copies of the data** (including the original data), on at least **2 separate storages**, in at least **2 separate locations** (far enough apart) and ideally with 2 separate methods. If your backups are encrypted **these rules also apply to the decryption phrase/key**.

A good backup is also in many cases, a recent backup, so it takes either a lot of rigor or to **automate** the process.

A good backup is checked regularly to ensure the effectiveness and integrity of the data.

Finally, a good backup is one that is **restorable within an acceptable timeframe** for you. Remember to document your restoration method and to estimate the transfer time of a copy, especially if the Internet connections involved are not symmetrical.


!!! Example of **a robust and comfortable combination**:
* a remote and automatic backup with borg
* a backup on external disk and automatic with borg
* a regular snapshot/image (and before updates)
* a monitored RAID 1 array (or a commercial VPS that will also be on an array)
* a decryption passphrase stored on 3 media in 2 locations

## Some possible methods

* [generate an archive and download it manually (default method of YunoHost)](/backup#manual-backup)
* [backup automatically (recommended method)](/backup#automatic-or-remote-backup)
* [generate an archive directly on another disk](/external_storage)
* [make a disk image or snapshot](/backup/clone_filesystem)
* [save useful data via a custom method](/backup/custom_backup_methods) 


## Risks
Below, a list of risks sorted from the most to the least probable, whose probability remains to be adapted according to your situation (location of the server, quality of the installations, user profiles, etc.). It is up to you to put the cursor where it should be, especially considering the consequences of a data loss. 

!!! Keep in mind that real accidents are linked to the occurrence of 2 events simultaneously. 

* **Lack of rigor**: strategies based on manual backups require a lot of rigor in the regularity
* **Bad handling**: it can happen that a backup is erased by mistake during a restoration or if you rely on a synchronization system, you could delete a file and the deletion would be synchronized instantly
* **Cryptolocker**: this is a virus that encrypts files and demands a ransomware. If your users are using nextcloud and windows, an infected windows could synchronize encrypted files and thus you lose your copy.
* **Hardware failure**: SD cards are the least reliable media over time (~2 years of life in a server), followed by SSD disks (about 3 years of life) and hard drives (3 years). Note that a new equipment has also probability to break down during the first 6 months. In all cases, your copies should not be on the same physical media.
* **Software failure/bug**: a software bug may result in data deletion or you may not know how to fix a problem and want to restore your system.
* **Electricity or internet failure**: do you have a plan if this happens? What if you are on vacation?
* **Disaster or natural or unnatural event**: a small child, a cat, lightning or a simple leak can destroy your equipment. Fires or floods can also destroy your backup copy at the other end of your home...
* **Server compromise**: a malicious person or a robot could attack your server and delete your data
* **Machine theft**: a burglary or theft of a computer on which your password manager is located to decrypt your backups
* **Search**: whether you are guilty or not, a search can result in the seizure of the entire computer equipment of a place (or even several)
* **Death/health problem**: you may not be able to type your passphrase anymore

## About Nextcloud or Thunderbird (IMAP) synchronization
A method that allows a partial backup is to backup files and emails via synchronization software like Nextcloud client or ThunderBird. This way, you avoid the risk of hardware failure. 

If this method is easy to set up, it is not without risk because of the synchronization itself. For example, if you are on Windows or Mac, you increase the risk of data loss following the encryption of files by a [cryptolocker](https://en.wikipedia.org/wiki/Ransomware) type virus. On any type of system, a false manipulation can delete all your copies on the server and on the equipment that synchronizes. This concern is aggravated by the fact that the deletion synchronization is usually rather instantaneous.

While the risk of false manipulation can be mitigated by desktop backup software such as TimeShift, the risk of false manipulation can only be mitigated by a backup on a hard drive. Only a backup on a disconnected external hard drive really protects you from ransomware.
