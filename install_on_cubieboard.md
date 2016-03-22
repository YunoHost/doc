# Install YunoHost on Cubieboard

*Find other ways to install YunoHost **[here](/install)**.*

### Requirements

<img src="/images/cubieboard2.png">
<img src="/images/micro-sd-card.jpg">

* CubieBoard 1, 2 or CubieTruck.
* A micro SD card: **4GB** capacity (or more) and **class10** speed rate are highly recommended
* A [reasonable ISP](/isp), preferably with a good and unlimited upstream bandwidth

---

## Installation
* Download the latest **[image of ARMbian Jessie for Cubieboard](http://www.armbian.com/cubieboard-2/)**

<a class="btn btn-lg btn-default" href="/copy_image">Copy image to the SD card</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">Plug & boot</a>

* Connect via [SSH](ssh): **root@exemple.tld/ip_address** with the password: **1234**.

<a class="btn btn-lg btn-default" href="/install_manually">Install YunoHost</a>

<a class="btn btn-lg btn-default" href="/postinstall">Post-install</a>

---

#### Recommended after post-installation
* Use [SSH authentication via key](security)

---

#### Build image
* [Create a Cubieboard image](/build_arm_image_en)

---

***If you need help during one of these steps, do not hesitate to use [our support tools](/support).***