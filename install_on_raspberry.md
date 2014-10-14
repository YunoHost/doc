# Install YunoHost on a Raspberry Pi

*Find other ways to install YunoHost **[here](/install)**.*

## Pre-requisite

<img src="https://yunohost.org/images/raspberry-pi-model-b.jpg">
<img src="https://yunohost.org/images/sdcard.jpg">

* A Raspberry Pi model B or B+
* An SD card: **4GB** capacity (or more) and **class10** speed rate are highly recommended
* An other computer to read this guide and access to your Raspberry Pi
* A screen and a keyboard are recommended to control your Raspberry Pi if a problem occurs.
* A [reasonable ISP](/isp), preferably with a good and unlimited upstream bandwidth
* The **YunoHost Raspberry image**, available here (to **unzip**):

    [http://build.yunohost.org/yunohost-raspberrypi-2014-09-17.zip](http://build.yunohost.org/yunohost-raspberrypi-2014-09-17.zip)

    <div class="alert alert-warning">
    <b>Warning:</b> the network device *eth0* is configured to connect by default to DHCP in the system configuration. You could have to change this configuration in order to connect to your local network from your Raspberry Pi if its device has a different name. For that:
    <ul>
    <li>connect locally to your Raspberry Pi</li>
    <li>retrieve your network device's name: `$ ip link` (*lo* corresponds to the loopback device, so it can just be *eth1* for example)</li>
    <li>edit the configuration file `/etc/network/interfaces` and replace *eth0* by your network device's name</li>
    <li>restart networking service: `$ service networking restart`</li>
    </ul>
    </div>

---

## Installation steps

<a class="btn btn-lg btn-default" href="/copy_image">1. Copy image to the SD card</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">2. Plug & boot</a>

<a class="btn btn-lg btn-default" href="/postinstall">3. Post-install</a>

---

### Recommended after post-installation

* Connect via SSH: **root@yunohost.local** (password: **yunohost**)
* Change root password: `passwd root`
* Upgrade system: `apt-get update && apt-get dist-upgrade && rpi-update`

---

***If you need help during one of these steps, do not hesitate to use [our support tools](/support).***

