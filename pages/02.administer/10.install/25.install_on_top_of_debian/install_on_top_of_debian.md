---
title: Installing YunoHost on top of Debian
template: docs
taxonomy:
    category: docs
routes:
  default: '/install_on_top_of_debian'
aliases:
  - '/installing_debian'
---

If you can't install YunoHost successfully using our pre-built image, YunoHost can still be installed on top of a vanilla Debian setup.

YunoHost is based on Debian 12 (Bookworm), and you would usually obtain that image from [Debian's download page](https://www.debian.org/download.html) assuming Debian's stable version is still Bookworm (12.x) when reading this page. Alternatively, you can find the image in [Debian's archive](https://cdimage.debian.org/mirror/cdimage/archive/) > scroll down to find the latest 12.x version > amd64 > iso-cd > scroll down an choose the regular "netinst" iso.

The Debian installer isn't the most user-friendly installer and may ask some technical questions. It'll be easier to **format the hard drive** you plan to use for Debian+YunoHost **before you install Debian**, using your disk utility of choice.

You may then flash this ISO file on an USB stick (just like you would do for YunoHost's preinstalled image)

### Installing

In general, you can simply follow the instructions on screen and use the suggested defaults.

Debian installer will ask for a **hostname** and a **domain name**. You can use `yunohost` and `yunohost.local`. It is not that important since the YunoHost Installer will overwrite those anyway.

Debian will ask for a **root password**, which should be reaonably complex as it is your primary defense to possible attacks.

The installer will also ask for a **user account** and another password. **IMPORTANT:** this username should be DIFFERENT from the first YunoHost user which you will choose during YunoHost's posinstall ...For example, you can name it `debian`. Be sure to also use a long complex password.

When the install asks where to install and how to **create disk partitions**, select the option to use the whole disk, unless you know what you're doing.

- We recommend to no separate the `/home`, `/var` or `/tmp` partitions. Use the option to “keep all files in one partition”.
- We discourage the encryption of any partitions (Edit by Aleks: there's no explanation why though...)

The installer will ask about **mirrors**. Select a country and server close to your location, or use the default options.

The installer will ask which **desktop environment** you want. We discourage installing a desktop environment on a server as it's essentially a waste of resources:

- Unselect all desktop environment
- Keep “standard system utilities” checked

## After installing Debian

1. Remove the installation media (unplug the USB stick)
2. Reboot
3. Login as `root`
4. Install curl by typing `apt install curl`
5. Proceed to install YunoHost on Debian using these instructions: <https://yunohost.org/en/install/hardware:vps_debian>
