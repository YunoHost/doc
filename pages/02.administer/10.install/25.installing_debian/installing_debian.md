---
title: Installing Debian for Yunohost
template: docs
taxonomy:
    category: docs
routes:
  default: '/installing_debian'
---

If you can't install YunoHost successfully, there's always the option to install Debian and then install YunoHost on top.

## Which Debian version

YunoHost is based on Debian 12 (Bookworm).

## Before you start

The Debian installer isn't the easiest Linux installer, especially for beginners. It'll be easier to **format the hard drive** you plan to use for Debian+YunoHost **before you install Debian**, using your disk utility of choice.

## Installing Debian

### Booting the installer

This guide won't go into details on how to boot the Debian installer. You can use Debian's own documentation for that. The short version is you'll need to flash a USB stick with the Debian 12 image, like you would flash the YunoHost image.

### Installing

In general, you can simply follow the instructions on screen and use the suggested defaults.

Debian installer will ask for a **hostname** and a **domain name**. You can use `yunohost` and `yunohost.local`. It’s not really important since the YunoHost Installer will overwrite those anyway.

Debian will ask for a **root password**. Make sure you pick a **really long and complex** one and save it to your password manager of choice (Bitwarden, Firefox, etc…) or write it somewhere safe. Remember that this is a server that  will be available on the internet, making it vulnerable to possible attacks so you should be extra safe here!

The installer will also ask for a **user account** and another password. **Important:** name it something that won’t be used by your YunoHost server later. For example, you can name it `debian`. Be sure to also use a long complex password.

When the install asks about where to install and how to **create disk partitions**, select the option to use the whole disk, unless you know what you're doing.

- Don’t separate the /home, /var or /tmp partitions. Use the option to “keep all files in one partition”.
- Don’t encrypt any partitions, [as recommended](https://yunohost.org/en/administer/install/hardware:regular#about-encryption)

The installer will ask about **mirrors**. Select a country and server close to your location, or use the default options.

The installer will ask about which **desktop environment** you want. You should not install a desktop environment on a server:

- Unselect all desktop environment
- Keep “standard system utilities” checked

## After installing Debian

1. Remove the installation media (unplug the USB stick)
2. Reboot
3. Login as `root` with the long complex password you created earlier.
4. Install curl by typing `apt install curl`
5. Proceed to install YunoHost on Debian using these instructions: <https://yunohost.org/en/install/hardware:vps_debian>
   - The installer will ask for permission to overwrite some configuration files. Select Yes.
