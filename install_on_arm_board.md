# Install YunoHost on ARM board

*Find other ways to install YunoHost **[here](/install)**.*

### Requirements

<img src="/images/cubieboard2.png">
<img src="/images/micro-sd-card.jpg">

* An ARM board with 500MHz CPU and 512MB RAM.
* A micro SD card: **4GB** capacity (or more), **class10** speed rate is highly recommended.
* A [reasonable ISP](/isp), preferably with a good and unlimited upload bandwidth.

---

## Installation
* Download the latest **[image of ARMbian Jessie for the ARM board](http://www.armbian.com/download)**

<a class="btn btn-lg btn-default" href="/copy_image">Copy image to the SD card</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">Plug & boot</a>

* Connect via [SSH](ssh): **root@exemple.tld/ip_address** with the password: **1234**.

<a class="btn btn-lg btn-default" href="/install_manually">Install YunoHost</a>

<a class="btn btn-lg btn-default" href="/postinstall">Post-install</a>

---

#### Recommended after running the post-installation
* Use [SSH authentication via key](security)

---

#### Build image
* [Create an ARM board image](/build_arm_image_en)

