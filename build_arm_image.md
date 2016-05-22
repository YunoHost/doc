# Build ARM image

This tutorial's goal is to build a plug-and-play image for YunoHost for ARM boards.

It could be used on many ARM board (Rasberry Pi, Olimex, Cubieboard…).

This tutorial is based on [Yunocubian](https://github.com/M5oul/Yunocubian).

### Download minimal Debian Jessie
Download a Debian Jessie image compatible with the hardware **without desktop environnement** installed:

* [ARMbian](http://www.armbian.com/download/) (Olimex, Cubieboard, Banana Pi…)
* [Raspbian Jessie Lite](https://www.raspberrypi.org/downloads/raspbian/)

### Copy image and install YunoHost
<a class="btn btn-lg btn-default" href="/copy_image">Copy image to the SD card</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">Plug & boot</a>

* Connect via [SSH](ssh): **root@exemple.tld/ip_address** with the password which you could find on respectives documentations.
* You should be **root** for next operations.

<a class="btn btn-lg btn-default" href="/install_manually">Install YunoHost</a>

<div class="alert alert-danger">Do not proceed to **post-installation**.</div>

### Clean image
* Update image:
```bash
apt-get update && apt-get dist-upgrade && apt-get autoremove
```
* Change hostname:
```bash
hostname -v YunoHost
```
* Set new SSH key generation at first lauching:

```bash
# Delete SSH keys
rm -f /etc/ssh/ssh_host_*

# Add script to regenerate SSH keys at first boot
nano /etc/init.d/ssh_gen_host_keys
---
#!/bin/sh
### BEGIN INIT INFO
# Provides:          Generates new ssh host keys on first boot
# Required-Start:    $remote_fs $syslog
# Required-Stop:     $remote_fs $syslog
# Default-Start:     2 3 4 5
# Default-Stop:
# Short-Description: Generates new ssh host keys on first boot
# Description:       Generatesapt-get --purge clean new ssh host keys on $
### END INIT INFO
ssh-keygen -f /etc/ssh/ssh_host_rsa_key -t rsa -N ""
ssh-keygen -f /etc/ssh/ssh_host_dsa_key -t dsa -N ""
insserv -r /etc/init.d/ssh_gen_host_keys
rm -f \$0
---

# Give executable right
chmod a+x /etc/init.d/ssh_gen_host_keys

# Make it execute at next boot
insserv /etc/init.d/ssh_gen_host_keys
```

* Delete logs:
```bash
find /var/log -type f -exec rm {} \;
```

* Turn off your board:
```bash
shutdown
```

### Copy image
Plug your SD card on your desktop computer and copy it:
<div class="alert alert-danger">Be carefull to not erase your data.</div>

```bash
sudo dd bs=1M if=/dev/sdd of=~/yunohost-jessie-board-year-month-day.img
```

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
