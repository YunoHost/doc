---
title: Install YunoHost on ARM board
template: docs
taxonomy:
    category: docs
routes:
  default: '/install_on_arm_board'
---

*Find other ways to install YunoHost **[here](/install)**.*

![](image://olinuxino.jpg?resize=250)
![](image://micro-sd-card.jpg)

!!! Before setting up a server at home, it is recommended that you know the [possible limitations imposed by your ISP](/isp). If they are too restrictive, you might consider using a VPN to bypass them.

## Pre-requisites

- An ARM board with 500MHz CPU and 512 MB of RAM;
- A power supply for your board;
- A microSD card: **8GB** capacity (at least) and **Class 10** speed rate are highly recommended (like the [Transcend 300x](http://www.amazon.fr/Transcend-microSDHC-adaptateur-TS32GUSDU1E-Emballage/dp/B00CES44EO));
- An ethernet cable (RJ-45) to connect your board to your router;
- A [reasonable ISP](/isp), preferably with a good and unlimited upload bandwidth.

---

## Install with the pre-installed image (recommended)

[div class="btn btn-lg btn-default"] [0. Download the pre-installed image for your board](/images) [/div]
<br>
<small class="text-info">If no pre-installed image exists for your board, you can follow the instructions to "Install on top of ARMbian"</small>

[div class="btn btn-lg btn-default"] [1. Flash the SD card with the image](/burn_or_copy_iso) [/div]

[div class="btn btn-lg btn-default"] [2. Boot the board and connect to the web interface at `yunohost.local`](/plug_and_boot) [/div]

[div class="btn btn-lg btn-default"] [3. Proceed with the initial configuration (post-installation)](/postinstall) [/div]

---

## Install on top of ARMbian

[div class="btn btn-lg btn-default"] [0. Download the ARMbian image for your board](https://www.armbian.com/download/) [/div]

[div class="btn btn-lg btn-default"] [1. Flash the SD card with the image](/burn_or_copy_iso) [/div]

[div class="btn btn-lg btn-default"] [2. Plug & boot](/plug_and_boot) [/div]

[div class="btn btn-lg btn-default"] [3. Connect to your server with SSH](/ssh) [/div]

[div class="btn btn-lg btn-default"] [4. Follow the generic install procedure](/install_manually) [/div]
