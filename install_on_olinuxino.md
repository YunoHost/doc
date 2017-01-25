# Install on an OlinuXino board

<div class="alert alert-info" markdown="1">
The simplest way to install YunoHost on an OLinuXino board is to use the image provided by the [*Internet Cube project*](http://labriqueinter.net). It's an image specifically designed for the OLinuXino boards.
</div>

<div class="alert alert-warning" markdown="1">
If you aim to setup a full Internet Cube (OLinuXino boad + YunoHost + VPN from neutral ISP + Wifi access point), you should use the [the install procedure on the Internet Cube project website](https://install.labriqueinter.net).

It is recommended to read about the [advantages of using a neutral VPN in the context of self-hosting](/vpn_advantage) and to contact your local associative ISP (if you have one).
</div>

## Prerequisites

* One of these OLinuXino boards
 * [A20-OLinuXino-LIME](https://www.olimex.com/Products/OLinuXino/A20/A20-OLinuXino-LIME/open-source-hardware)
 * [A20-OLinuXino-LIME2](https://www.olimex.com/Products/OLinuXino/A20/A20-OLinuXino-LIME2/open-source-hardware)
* A Micro-SD card ([Transcend 300x](https://www.amazon.com/Transcend-MicroSDHC-Class10-Adapter-TS32GUSDU1/dp/B00APCMMDG/) show good performance and stability).
* A power supply ([european one](https://www.olimex.com/Products/Power/SY0605E/)) for the board. (Supply through a USB cable is not stable.)
* An ethernet/RJ-45 cable to connect the board to your internet box / router.

To prepare the SD card, a computer with GNU/Linux or BSD is preferable. You should be able to follow the same instructions on MacOS/OSX. On Windows, you will need to use the tool decribed [here](/copy_image).

---

## Download the image

Download the image ([LIME1](http://repo.labriqueinter.net/labriqueinternet_A20LIME_latest_jessie.img.tar.xz) or [LIME2](http://repo.labriqueinter.net/labriqueinternet_A20LIME2_latest_jessie.img.tar.xz)), check its integrity (*MD5 checksum*), and uncompress it :
```bash
cd /tmp/
# Download image
wget https://repo.labriqueinter.net/labriqueinternet_A20LIME_latest_jessie.img.tar.xz

# Integrity check (optionnal, but recommended)
wget -q -O - https://repo.labriqueinter.net/MD5SUMS | grep "labriqueinternet_A20LIME_latest_jessie.img.tar.xz$" > MD5SUMS
md5sum -c MD5SUMS

# Uncompress image
tar -xf labriqueinternet_*.img.tar.xz
mv labriqueinternet_*.img labriqueinternet.img
```

## Copy image to SD card

1. Identify the name of the card : 
    - Make sure the SD card is *not* plugged in the computer
    - Run the command `ls -1 /sys/block/`
    - Insert the SD card in the computer (maybe 
    - Run the command `ls -1 /sys/block/` again
    - The name of your card (SDNAME) is the one present in the what's returned in the second command but not in the first. It's usually something like `sdb` or `mmcblk0`.

2. Copy the image to your card (replace SDNAME by the name of your card, found in the previous step). Command will take a while.
```bash
sudo dd if=/tmp/labriqueinternet.img of=/dev/SDNAME bs=1M status=progress
sync
```

## Plug and boot

Insert the card in the OLinuXino board, connect it to your router with the Ethernet cable, and plug the power supply. Your board will boot (give it a few seconds) and the LEDs around the Ethernet port should start blinking.
<div class="alert alert-warning" markdown="1">
The first boot can take a little more than one minute because the partition is being resized and the board rebooted automatically.
</div>

## Find the local IP of your server

Get the local IP of your OLinuXino board :

 * either using `sudo arp-scan --local | grep -P '\t02'` ;
 * either using the router interface by listing the DHCP clients ;
 * either by pluging an HDMI screen on the OLinuXino, logging in and typing `ifconfig`.

<div class="alert alert-info" markdown="1">
In the following commands, we refer to the board's IP with **192.168.x.y**. You should replace it with the local IP you found.
</div>

## Connect through SSH and change root password

Connect to your server with
```bash
ssh root@192.168.x.y
```
The default password is **olinux**.

After connecting, you will be asked to changed the root password. First, enter **olinux** *again* (current password), then type the new password two times.

## Update your server

Update your server with the following commands. It can take around 15 minutes.
```bash
apt-get update && apt-get dist-upgrade
```

## Proceed to post-installation

Proceed to [post-installation](/postinstall) by connecting with your browser to https://192.168.x.y (you browser will warn you about the certificate being self-signed, but you can add/accept the certificate exception).
<div class="alert alert-info" markdown="1">
**Note :** it is also possibled to do the post-installation step through command line in SSH, with `yunohost tools postinstall`.
</div>

## (Optionnel) Install DoctorCube

If you want to benefit automatically from fixes and configuration specific to the Internet Cube, you can install the DoctorCube app.

1. Add the Internet Cube repository :
```bash
yunohost app fetchlist -n labriqueinternet -u https://labriqueinter.net/apps/labriqueinternet.json
```
2. In the web administration interface, click on "Applications", then install the DoctorCube app. The installation can be pretty long, but you can leave the page anyway.


