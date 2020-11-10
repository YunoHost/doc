# YunoHost auf einem Raspberry Pi installieren

*Alle Arten YunoHost zu installieren findest du **[hier](/install)**.*

<center>
<img src="/images/raspberrypi.jpg" width=300 style="padding-bottom:20px">
<img src="/images/micro-sd-card.jpg">
</center>

<div class="alert alert-info" markdown="1">
Vor der Einrichtung eines Servers zuhause ist es empfehlenswert [mögliche Einschränkungen deines Providers](/isp) zu kennen. Wenn er zu viele Einschränkungen vornimmt, kann es sinnvoll sein ein VPN zu nutzen um diese zum umgehen.
</div>

## Voraussetzungen

- Einen Raspberry Pi 2, 3 oder 4 (RPi 0 and 1 may work but require some tweaking ... see [this issue](https://github.com/YunoHost/issues/issues/1423)) ;
- Eine microSD Karte: **8 GB** Speicherplatz (mindestens) und **Class 10** Geschwindigkeit werden empfohlen (wie zum Beispiel die [Transcend 300x](http://www.amazon.fr/Transcend-microSDHC-adaptateur-TS32GUSDU1E-Emballage/dp/B00CES44EO)) ;
- Ein Netzeil (entweder ein Steckernetzteil oder ein MicroUSB Kabel) ;
- An Netzwerkkabel (RJ-45) um den Raspberry mit dem router zu verbinden. (Raspberry Pi Zero Nutzer können ein OTG Kabel nutzen, [Wifi dongle](https://core-electronics.com.au/tutorials/raspberry-pi-zerow-headless-wifi-setup.html).) ;
- Einen [geeigneten Provider](/isp), am Besten einen mit einer guten upload Geschwindigkeit.

---

## Install with the pre-installed image (recommended)

<a class="btn btn-lg btn-default" href="/images">0. Download the pre-installed image for Raspberry Pi</a>

<a class="btn btn-lg btn-default" href="/burn_or_copy_iso">1. Flash the SD card with the image</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">2. Plug & boot</a>

<a class="btn btn-lg btn-default" href="/ssh">3. Connect to your server with SSH</a>

<a class="btn btn-lg btn-default" href="/postinstall">4. Proceed to post-installation</a>

---

## Manual installation (advanced users)

<div class="alert alert-warning" markdown="1">
We do not recommend the manual installation because it is more technical and longer than using the pre-installed image. This documentation is only intended for advanced users.
</div>

<div class="alert alert-warning" markdown="1">
The latest Raspberry Pi OS Lite images requires a screen and a keyboard, as it is no longer possible to connect directly to the Raspberry through SSH. Nevertheless it is possible to re-enable SSH at boot: before starting your Raspberry, put in the boot partition of the SD card an empty file named `ssh` (without extension).
</div>

0. Install Raspberry Pi OS Lite on the SD card ([instructions](https://www.raspberrypi.org/downloads/raspberry-pi-os/)).

1. Connect to your Raspberry Pi with the user `pi`. Set the root password with 
```bash
sudo passwd root
```

2. Edit `/etc/ssh/sshd_config` to allow SSH login for root, by replacing `PermitRootLogin without-password` with `PermitRootLogin yes`. Reload the SSH daemon with `service ssh reload`.

3. Disconnect and reconnect, this time as root.

4. Then follow the <a href="/install_manually">generic manual install procedure</a>.

