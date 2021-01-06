# Flashing the YunoHost ISO

Now that you downloaded the ISO image of YunoHost, you should flash/burn it on a physical medium. Typically, this is done on a **USB stick** or an **SD card**.

<img src="/images/sdcard.jpg" width=100>
<img src="/images/micro-sd-card.jpg" width=100>
<img src="/images/usb_key.png" width=150>
<img src="/images/cd.jpg" width=100>

### (Recommended) With Etcher

Download <a href="https://etcher.io/" target="_blank">Etcher</a> for your operating system and install it.

<img src="/images/etcher.gif">

Plug your USB stick, select your YunoHost ISO and click "Flash"

### With UNetbootin

Download <a href="https://unetbootin.github.io/">UNetbootin</a> for your operating system and install it.

<img src="/images/unetbootin.png">

Put your USB stick on, select your YunoHost ISO and click "OK"


### With `dd`

If you are on GNU/Linux / macOS and know your way around command line, you may also flash your USB stick or SD card with `dd`. You can identify which device corresponds to your USB stick or SD card with `fdisk -l` or `lsblk`. A typical SD card name is something like `/dev/mmcblk0`. BE CAREFUL and make sure you got the right name.

Then run :

```bash
# Replace /dev/mmcblk0 if the name of your device is different...
dd if=/path/to/yunohost.img of=/dev/mmcblk0
```

### Burning a CD/DVD

For older devices, you might want to burn a CD/DVD. The software to use depends on your operating system.

* On Windows, use [ImgBurn](http://www.imgburn.com/) to write the image file on the disc

* On macOS, use [Disk Utility](http://support.apple.com/kb/ph7025)

* On GNU/Linux, you have plenty of choices, like [Brasero](https://wiki.gnome.org/Apps/Brasero) or [K3b](http://www.k3b.org/)
