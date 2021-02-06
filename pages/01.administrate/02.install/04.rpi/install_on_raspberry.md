---
title: Install YunoHost on a Raspberry Pi
template: docs
taxonomy:
    category: docs
---

*Find all the ways to install YunoHost **[here](/install)**.*

[center]
![Raspberry Pi](image://raspberrypi.jpg?resize=300&class=inline)
![Micro SD card](image://micro-sd-card.jpg?class=inline)
[/center]

! Before setting up a server at home, it is recommended that you know the [possible limitations imposed by your ISP](/administrate/advance/isp).  
! If they are too restrictive, you might consider using a VPN to bypass them.

## Pre-requisites

- A Raspberry Pi 2, 3 or 4 (RPi 0 and 1 may work but require some tweaking... see [this issue](https://github.com/YunoHost/issues/issues/1423));
- An microSD card: **8GB** capacity (at least) and **Class 10** speed rate are highly recommended (like the [Transcend 300x](http://www.amazon.fr/Transcend-microSDHC-adaptateur-TS32GUSDU1E-Emballage/dp/B00CES44EO)) ;
- A power supply (either an adapter or a MicroUSB cable);
- An ethernet cable (RJ-45) to connect your Raspberry Pi to your router. (Raspberry Pi Zero users can connect the Pi using an OTG cable, [Wifi dongle](https://core-electronics.com.au/tutorials/raspberry-pi-zerow-headless-wifi-setup.html).);
- A [reasonable ISP](/isp), preferably with a good and unlimited upload bandwidth.

---

## Install with the pre-installed image (recommended)

<a class="btn btn-lg btn-default" href="/images">0. Download the pre-installed image for Raspberry Pi</a>

<a class="btn btn-lg btn-default" href="/burn_or_copy_iso">1. Flash the SD card with the image</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">2. Boot the board and connect to the web interface at `yunohost.local`</a>

<a class="btn btn-lg btn-default" href="/postinstall">3. Proceed with the initial configuration (post-installation)</a>

---

## Manual installation (advanced users)

! We do not recommend the manual installation because it is more technical and longer than using the pre-installed image. This documentation is only intended for advanced users.

! The latest Raspberry Pi OS images requires a screen and a keyboard, as it is no longer possible to connect directly to the Raspberry through SSH. Nevertheless it is possible to re-enable SSH at boot: before starting your Raspberry, put in the boot partition of the SD card an empty file named `ssh` (without extension).

0. Install Raspberry Pi OS Lite on the SD card ([instructions](https://www.raspberrypi.org/downloads/raspberry-pi-os/)). The Raspberry Pi OS Lite can be found here: https://downloads.raspberrypi.org/raspbian_lite/images/

1. Connect to your Raspberry Pi with the user `pi`. Set the root password with 
```bash
sudo passwd root
```

2. Edit `/etc/ssh/sshd_config` to allow SSH login for root, by replacing `PermitRootLogin without-password` with `PermitRootLogin yes`. Reload the SSH daemon with `service ssh reload`.

3. Disconnect and reconnect, this time as root.

4. Then follow the <a href="/install_manually">generic manual install procedure</a>.

