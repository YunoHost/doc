# Install YunoHost on a Raspberry Pi

*Find all the ways to install YunoHost **[here](/install)**.*

<center>
<img src="/images/raspberrypi.jpg" width=350>
</center>

<div class="alert alert-info" markdown="1">
Before setting up a server at home, it is recommended that you know the [limitations imposed by your ISP](/isp). If they are too restrictive you can consider using a VPN to get around those limitations.
</div>

## Pre-requisite

- An SD card: **8GB** capacity (at least) and **Class 10** speed rate are highly recommended (like the [Transcend 300x](http://www.amazon.fr/Transcend-microSDHC-adaptateur-TS32GUSDU1E-Emballage/dp/B00CES44EO)) ;
- A power supply (either an adapter or a MicroUSB cable)
- An ethernet cable (RJ-45) to connect your Raspberry Pi to your router. (Raspberry Pi Zero users can connect the Pi using an OTG cable, Wifi dongle and [following these instructions](https://davidmaitland.me/2015/12/raspberry-pi-zero-headless-setup/))
- The **YunoHost Raspberry Pi image**, available on [build.yunohost.org](http://build.yunohost.org/). (Not needed if you want to manually install YunoHost on an existing Debian system.)
- **(Optional)** If you do not use the Raspi-Yunohost image above, installing the Rasbpian Jessie image requires a screen and a keyboard as it is no longer possible to connect directly to the Raspberry SSH. An alternative is possible; Before starting your RaspberryPi; Put in the boot partition of the SD card a file named "ssh", empty and without extension. This will enable SSH access, and thus allow access to raspi-config or vnc in the case of Raspbian (Jessie non lite).

---

## Installation using an image

<a class="btn btn-lg btn-default" href="/copy_image">1. Copy image to the SD card</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">2. Plug & boot</a>

<a class="btn btn-lg btn-default" href="/ssh">3. Connect to your server with SSH</a>

<a class="btn btn-lg btn-default" href="/postinstall">4. Proceed to post-installation</a>

---

## Manual installation


0. Install Raspbian on the SD card and connect to your Pi.

1. The root user must have a password, or the installation will fail. To change the root password:
```bash
sudo passwd root
```

2. Install git
```bash
sudo apt-get install git
```

2. Clone the Yunohost install script repository
```bash
git clone https://github.com/YunoHost/install_script /tmp/install_script
```

4. Execute the installation script
```bash
cd /tmp/install_script && sudo ./install_yunohost
```

---

***If you need help during one of these steps, do not hesitate to use [our support tools](/support).***
