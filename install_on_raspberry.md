# Install YunoHost on a Raspberry Pi

*Find other ways to install YunoHost **[here](/install)**.*

## Pre-requisite
<img src="/images/Raspberry_Pi_2_Model_B_v1.1_front_angle_new.jpg" width=350>
<img src="/images/micro-sd-card.jpg">

- A Raspberry Pi model 1, 2 or 3
- An SD card: **4GB** capacity (or more) and **class10** speed rate is highly recommended
- An other computer to read this guide and access to your Raspberry Pi
- A screen and a keyboard are recommended to control your Raspberry Pi if a problem occurs.
- A [reasonable ISP](/isp), preferably with a good and unlimited upstream bandwidth
- **YunoHost Raspberry Pi images**, available here:

build.yunohost.org

There are two ways of installing, depending on if you can start your server from scratch or not.

---

## Installation using an image

<a class="btn btn-lg btn-default" href="/copy_image">1. Copy image to the SD card</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">2. Plug & boot</a>

<a class="btn btn-lg btn-default" href="/postinstall">3. Post-install</a>

## Manual installation

Follow these steps if you can't start from scratch and simply use an image. Note - Yunohost installation is different if you have a Raspberry Pi Zero, be careful!

1. Install git
```bash
sudo apt-get install git
```

2. Clone the Yunohost install script repository
```bash
git clone https://github.com/YunoHost/install_script /tmp/install_script
```

3. The root user must have a password set, if it isn't the case, set it (whithout the install script failed):
```bash
sudo passwd root
```

4. Update the Pi: 
```bash
apt-get update ; apt-get dist-upgrade -y ; apt-get install rpi-update ; rpi-update ; reboot`
```

This will upgrade the Pi, then reboot.

<div class="alert alert-info">
<b>Raspberry Pi Zero users:</b> follow these specific steps for a successfull installation.

</div>

0.1 Install metronome manually:
```bash
apt-get install -y ssl-cert lua-event lua-expat lua-socket lua-sec lua-filesystem
wget https://github.com/YunoHost/metronome/archive/debian/3.7.9+33b7572-1.zip
unzip 3.7.9+33b7572-1.zip
cd metronome-debian-3.7.9-33b7572-1
dpkg-buildpackage -rfakeroot -uc -b -d
cd ..
dpkg -i metronome_3.7.9+33b7572-1_armhf.deb
apt-mark hold metronome
```

4. Execute the installation script
```bash
cd /tmp/install_script && sudo ./install_yunohost
```
---

### Recommended after post-installation

* Connect via SSH: **root@IP.OF.RPI** (password: **yunohost**)
* Change root password: `passwd root`
* Upgrade system: `apt-get update && apt-get dist-upgrade && rpi-update`
* Configure the language, keyboard layout and timezone with the **raspi-config** tool

---

#### Build image
* [Create a Raspberry Pi image](/build_arm_image_en)

***If you need help during one of these steps, do not hesitate to use [our support tools](/support).***

