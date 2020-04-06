# Install YunoHost on a Raspberry Pi

*Find all the ways to install YunoHost **[here](/install)**.*

<center>
<img src="/images/raspberrypi.jpg" width=300 style="padding-bottom:20px">
<img src="/images/micro-sd-card.jpg">
</center>

<div class="alert alert-info" markdown="1">
Before setting up a server at home, it is recommended that you know the [possible limitations imposed by your ISP](/isp). If they are too restrictive, you might consider using a VPN to bypass them.
</div>

## Pre-requisites

- A Raspberry Pi 0, 1, 2 or 3 (does not currently work on RPI 4);
- An microSD card: **8GB** capacity (at least) and **Class 10** speed rate are highly recommended (like the [Transcend 300x](http://www.amazon.fr/Transcend-microSDHC-adaptateur-TS32GUSDU1E-Emballage/dp/B00CES44EO)) ;
- A power supply (either an adapter or a MicroUSB cable)i ;
- An ethernet cable (RJ-45) to connect your Raspberry Pi to your router. (Raspberry Pi Zero users can connect the Pi using an OTG cable, [Wifi dongle](https://core-electronics.com.au/tutorials/raspberry-pi-zerow-headless-wifi-setup.html).) ;
- A [reasonable ISP](/isp), preferably with a good and unlimited upload bandwidth.

---

## Install with the pre-installed image (recommended)

<a class="btn btn-lg btn-default" href="/images">0. Download the pre-installed image for Raspberry Pi</a>

<a class="btn btn-lg btn-default" href="/copy_image">1. Flash the SD card with the image</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">2. Power up the board and let it boot</a>

<a class="btn btn-lg btn-default" href="/ssh">3. Connect to your server with your web browser</a>

<a class="btn btn-lg btn-default" href="/postinstall">4. Proceed with the initial configuration (post-installation)</a>

---

## Manual installation (advanced users)

<div class="alert alert-warning" markdown="1">
We do not recommend the manual installation because it is more technical and longer than using the pre-installed image. This documentation is only intended for advanced users.
</div>

<div class="alert alert-warning" markdown="1">
The latest Rasbpian images requires a screen and a keyboard, as it is no longer possible to connect directly to the Raspberry through SSH. Nevertheless it is possible to re-enable SSH at boot : before starting your Raspberry, put in the boot partition of the SD card an empty file named `ssh` (without extension).
</div>

0. Install Raspbian Stretch Lite on the SD card ([instructions](https://www.raspberrypi.org/downloads/raspbian/)). The Raspbian Stretch Lite can be found here: https://downloads.raspberrypi.org/raspbian_lite/images/raspbian_lite-2019-04-09/

1. Connect to your Raspberry Pi with the user `pi`. Set the root password with 
```bash
sudo passwd root
```

2. Edit `/etc/ssh/sshd_config` to allow ssh login for root, by replacing `PermitRootLogin without-password` with `PermitRootLogin yes`. Reload the ssh daemon with `service ssh reload`.

3. Disconnect and reconnect, this time as root.

4. Then follow the <a href="/install_manually">generic manual install procedure</a>.

