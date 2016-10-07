# Install YunoHost on a Raspberry Pi

*Find other ways to install YunoHost **[here](/install)**.*

## Requirements
<img src="/images/Raspberry_Pi_2_Model_B_v1.1_front_angle_new.jpg" width=350>
<img src="/images/micro-sd-card.jpg">

- A Raspberry Pi model 1, 2 or 3
- A SD card: **4GB** capacity (or more) and **class10** speed rate is highly recommended
- A different computer to read this guide and access your Raspberry Pi
- A screen and a keyboard, recommended if a problem occurs and you want to control your Raspberry Pi
- A [reasonable ISP](/isp), preferably with a good and unlimited upload bandwidth
- **YunoHost Raspberry Pi images**, available here:
 - [Official Wheezy/YunoHost 2.2 created the 4th June 2015](https://build.yunohost.org/yunohost-rpi2_wheezy.7z)
 - [Non-official Jessie/YunoHost 2.2 created the 5th December 2015](https://forum.yunohost.org/t/building-a-new-image-for-raspberry-debian-jessie-fr-en/1101/2)


<div class="alert alert-info">**This two images are old**. YunoHost image for Raspberry Pi is not maintained, feel free to contribute and contact us if you would like to [maintain an image](build_arm_image_en) for YunoHost project.</div>


---

## Installation steps

<a class="btn btn-lg btn-default" href="/copy_image">1. Copy image to the SD card</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">2. Plug & boot</a>

<a class="btn btn-lg btn-default" href="/postinstall">3. Post-install</a>

---

### Recommended after running the post-installation

* Connect via SSH: **root@IP.OF.RPI** (password: **yunohost**)
* Change root password: `passwd root`
* Upgrade system: `apt-get update && apt-get dist-upgrade && rpi-update`

---

#### Build image
* [Create a Raspberry Pi image](/build_arm_image_en)

***If you need help during one of these steps, do not hesitate to use [our support channels](/support).***
