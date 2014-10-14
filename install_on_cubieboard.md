# Install YunoHost on CubieBoard

*Find other ways to install YunoHost **[here](/install)**.*

### Requirements

<img src="https://yunohost.org/images/cubieboard2.png">
<img src="https://yunohost.org/images/micro-sd-card.jpg">

* CubieBoard 1 or 2 (CubieTruck might work as well)
* A micro-SD card: **8GB** capacity (or more) and **class10** speed rate are highly recommended
* An other computer to read this guide and access to your Cubieboard
* A screen and a keyboard are recommended to control your Cubieboard if a problem occurs
* A [reasonable ISP](/isp), preferably with a good and unlimited upstream bandwidth
* The **YunoHost Cubieboard image**, available here (to **unzip**):

---

## Installation steps

<a class="btn btn-lg btn-default" href="/copy_image">1. Copy image to the SD card</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">2. Plug & boot</a>

<a class="btn btn-lg btn-default" href="/postinstall">4. Post-install</a>

---

### Recommended after post-installation

* Connect via [SSH](ssh): **root@expemple.tld** (password: **yunohost**)
* Change root password: `passwd root`
* Upgrade system: `apt-get update && apt-get dist-upgrade && cubian-update`

---

## Create a YunoHost image for Cubieboard 1 or 2
* **[Scripts for Cubian](https://github.com/M5oul/Yunocubian)**
* A Cubieboard Debian 7 image compatible with YunoHost:
    * [Cubian](http://cubian.org/)
    * [Cubieez](http://www.cubieforums.com/index.php?topic=442.0)

---

***If you need help during one of these steps, do not hesitate to use [our support tools](/support).***