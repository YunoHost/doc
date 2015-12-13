# Install YunoHost on a Raspberry Pi

*Find other ways to install YunoHost **[here](/install)**.*

## Pre-requisite
<img src="https://yunohost.org/images/Raspberry_Pi_2_Model_B_v1.1_front_angle_new.jpg" width=350>
<img src="https://yunohost.org/images/micro-sd-card.jpg">

* A Raspberry Pi model 1 or 2
* An SD card: **4GB** capacity (or more) and **class10** speed rate are highly recommended
* An other computer to read this guide and access to your Raspberry Pi
* A screen and a keyboard are recommended to control your Raspberry Pi if a problem occurs.
* A [reasonable ISP](/isp), preferably with a good and unlimited upstream bandwidth
* The **YunoHost Raspberry Pi image**, available here (to **unzip**):

    [Wheezy image for Raspberry Pi 1 and 2 created the 4th june 2015](http://build.yunohost.org/yunohost4rpi2.img.7z)

---

## Installation steps

<a class="btn btn-lg btn-default" href="/copy_image">1. Copy image to the SD card</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">2. Plug & boot</a>

<a class="btn btn-lg btn-default" href="/postinstall">3. Post-install</a>

---

### Recommended after post-installation

* Connect via SSH: **root@IP.OF.RPI** (password: **yunohost**)
* Change root password: `passwd root`
* Upgrade system: `apt-get update && apt-get dist-upgrade && rpi-update`

---

#### Build image
* [Create a Raspberry Pi image](/build_arm_image_en)

***If you need help during one of these steps, do not hesitate to use [our support tools](/support).***

