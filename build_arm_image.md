# Build ARM image

This tutorial's goal is to build a plug-and-play image for YunoHost for ARM boards.

It could be used on many ARM board (Rasberry Pi, Olimex, Cubieboard…).

This tutorial is based on [Yunocubian](https://github.com/M5oul/Yunocubian).

You could find [ARM image builder from Debian Jessie](https://github.com/YunoHost/install_script/pull/36).

**All these steps can be executed with variations of [this script](https://github.com/likeitneverwentaway/rpi_buildbot/blob/master/build_image.sh).**

### Download minimal Debian Jessie
Download a Debian Jessie image compatible with the hardware **without desktop environnement** installed:

* [ARMbian](http://www.armbian.com/download/) (Olimex, Cubieboard, Banana Pi…)
* [Raspbian Jessie Lite](https://www.raspberrypi.org/downloads/raspbian/)

### Copy image and install YunoHost
<a class="btn btn-lg btn-default" href="/copy_image">Copy image to the SD card</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">Plug & boot</a>

* Connect via [SSH](ssh): **pi@exemple.tld/ip_address** with the password **raspberry** (or any variations for other distros than Raspbian).
* Set a root password :

```bash
sudo passwd
```

and login as root:
```bash
su
```


* You should be **root** for next operations.

<a class="btn btn-lg btn-default" href="/install_on_raspberry">Manually install YunoHost on a Raspberry Pi</a>

If you encounter problems during installation check out [this installation guide](http://avignu.wiki.tuxfamily.org/doku.php?id=documentation:yunohost-jessie) for the Raspberry Pi, based on suggestion [from this thread](https://forum.yunohost.org/t/installation-de-yunohost-2-4-sur-raspbian-jessie-minimal-sur-un-raspberry-pi-3/1597).

<div class="alert alert-danger">Do not proceed to **post-installation**.</div>

### Clean image
* Update image:
```bash
apt-get update && apt-get dist-upgrade && apt-get autoremove
```
* Change hostname:
```bash
sed -i "s/$(hostname)/YunoHost/g" /etc/hosts
sed -i "s/$(hostname)/YunoHost/g" /etc/hostname
```
* Allow SSH connection as root:
```bash
sed -i '0,/without-password/s/without-password/yes/g' /etc/ssh/sshd_config
``` 
* Delete the **pi** user (this step must be perform directly as root, not logged in as pi and then login as root):
```bash
deluser –remove-all-files pi
``` 
* Set the first boot script:

```bash
wget https://raw.githubusercontent.com/likeitneverwentaway/rpi_buildbot/master/yunohost-firstboot -P /etc/init.d/

# Give executable right
chmod a+x /etc/init.d/yunohost-firstboot

# Make it execute at next boot
insserv /etc/init.d/yunohost-firstboot
```
* Set the boot promtp script:
```bash
wget https://raw.githubusercontent.com/likeitneverwentaway/rpi_buildbot/master/boot_prompt.service -P /etc/systemd/system/
wget https://raw.githubusercontent.com/likeitneverwentaway/rpi_buildbot/master/boot_prompt.sh -P /usr/bin/
chmod a+x /usr/bin/boot_prompt.sh
systemctl enable boot_prompt.service
```

* Tell the boot_prompt script that the next boot is the first boot:
```bash
touch /etc/yunohost/firstboot
``` 

* Turn off your board:
```bash
shutdown
```


Don't forget to reset **wpa-supplicant.conf** if you changed it. You could also delete the command history with

```bash
history -c
```
or by editing **/root/.bash_history**.

### Copy image
Plug your SD card on your desktop computer and copy it:
<div class="alert alert-danger">Be carefull to not erase your data.</div>

```bash
sudo dd bs=1M if=/dev/sdd of=~/yunohost-jessie-board-year-month-day.img
```
You can also use the **Read** function of [Win32 Disk Imager](https://sourceforge.net/projects/win32diskimager/).

### Verify image
<a class="btn btn-lg btn-default" href="/copy_image">Copy image to the SD card</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">Plug & boot</a>

<a class="btn btn-lg btn-default" href="/postinstall">Post-install</a>

<div class="alert alert-info">If everything is alright, you could publish your image.</div>

### Publish image
* Reduce size by zipping the image:
```bash
zip yunohost-jessie-board-year-month-day.img.zip yunohost-jessie-board-year-month-day.img
```

* Publish: you could post your image on the [forum](https://forum.yunohost.org/).
