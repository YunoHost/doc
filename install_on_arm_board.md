# Install YunoHost on ARM board

*Find other ways to install YunoHost **[here](/install)**.*

<center>
<img src="/images/olinuxino.jpg" width=250 style="padding-bottom:20px">
<img src="/images/micro-sd-card.jpg">
</center>

<div class="alert alert-info" markdown="1">
Before setting up a server at home, it is recommended that you know the [possible limitations imposed by your ISP](/isp). If they are too restrictive, you might consider using a VPN to bypass them.
</div>

<div class="alert alert-warning" markdown="1">
YunoHost doesn't yet support ARM64 boards. For more information, see [this issue](https://github.com/YunoHost/issues/issues/438).
</div>

## Pre-requisites

- An ARM board with 500MHz CPU and 512MB RAM ;
- A power supply for your board ;
- A microSD card: **8GB** capacity (at least) and **Class 10** speed rate are highly recommended (like the [Transcend 300x](http://www.amazon.fr/Transcend-microSDHC-adaptateur-TS32GUSDU1E-Emballage/dp/B00CES44EO)) ;
- An ethernet cable (RJ-45) to connect your board to your router ;
- A [reasonable ISP](/isp), preferably with a good and unlimited upload bandwidth.

---

## Install with the pre-installed image (recommended)

<a class="btn btn-lg btn-default" href="/images">0. Download the pre-installed image for your board</a><br><small>If no pre-installed image exists for your board, you can follow the instructions to "Install on top of ARMbian"</small>

<a class="btn btn-lg btn-default" href="/copy_image">1. Flash the SD card with the image</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">2. Power up the board and let it boot</a>

<a class="btn btn-lg btn-default" href="/ssh">3. Connect to your server with SSH</a>

<a class="btn btn-lg btn-default" href="/postinstall">4. Proceed with the initial configuration (post-installation)</a>

---

## Install on top or ARMbian

<a class="btn btn-lg btn-default" href="https://www.armbian.com/download/">0. Download the ARMbian image for your board</a>

<a class="btn btn-lg btn-default" href="/copy_image_fr">1. Flash the SD card with the image</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot_fr">2. Plug & boot</a>

<a class="btn btn-lg btn-default" href="/ssh_fr">3. Connect to your server with SSH</a>

<a class="btn btn-lg btn-default" href="/install_manually_fr">4. Follow the generic install procedure</a>
