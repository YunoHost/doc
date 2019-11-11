# Flashing the YunoHost ISO on a USB stick or CD/DVD

Now that you downloaded the ISO image of YunoHost, you should flash/burn it on a physical medium. Typically, this is done on a **USB stick** but you might want to use a **CD/DVD** for older machines.

<img src="/images/usb_key.png" width=150>
<img src="/images/cd.jpg" width=150>

---

## USB stick

### With Etcher

Download <a href="https://etcher.io/" target="_blank">Etcher</a> for your operating system and install it.

<img src="/images/etcher.gif">

Plug your USB stick, select your YunoHost ISO and click "Flash"

### With UNetbootin

Download <a href="https://unetbootin.github.io/">UNetbootin</a> for your operating system and install it.

<img src="/images/unetbootin.png">

Put your USB stick on, select your YunoHost ISO and click "OK"

### With `dd`

If you know your way around command line, you may also flash your USB stick with
`dd`. Assuming your USB stick is `/dev/sdz` (be careful !!), you may run :

```bash
dd if=/path/to/yunohost.iso of=/dev/sdz
```

---

## CD/DVD

The software to use differs regarding your operating system.

* On Windows, use [ImgBurn](http://www.imgburn.com/) to write the image file on the disc

* On Mac OS, use [Disk Utility](http://support.apple.com/kb/ph7025)

* On GNU/Linux, you have plenty of choices, like [Brasero](https://wiki.gnome.org/Apps/Brasero) or [K3b](http://www.k3b.org/)
