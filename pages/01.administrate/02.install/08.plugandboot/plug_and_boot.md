---
title: Plug and boot your server up
template: docs
taxonomy:
    category: docs
routes:
  default: '/plug_and_boot'
---

# Boot and connect to your server

* Plug the SD card (for ARM boards)
* Plug the ethernet cable
* Plug the power supply
* Wait a couple minutes for your server to boot

### Connecting to your server

* Make sure that your computer (desktop/laptop) is connected to the same local network (i.e. same internet box) as your server.
* Open a browser and type `https://yunohost.local` in the address bar.
* If your server is up, you will very likely encounter a security warning. This is because your server is for now using what's called a "self-signed certificate" - and because we're accessing the server through a special `.local` domain. You will later be able to add a proper domain and install a certificate automatically recognized by web browsers as described in the [certificate documentation](/certificate). In the meantime, you should add a security exception to accept the current certificate.
* If you are NOT able to join your server using the `yunohost.local` domain, try to [find the local IP of your server](/finding_the_local_ip) - then in your browser's address bar, type `https://192.168.x.y`
* [Proceed with the initial configuration (post-installation)](/postinstall)

--- 

#### [Optional] Connecting your server to the internet through WiFi

* If you want your server to connect using WiFi, you may configure it as explained [here](https://www.raspberrypi.org/documentation/configuration/wireless/wireless-cli.md).
* Alternatively, you can mount the second partition of the SD card and edit the `wpa-supplicant.conf` file prior to boot the card for the first time. On Windows you can use [Paragon ExtFS](https://www.paragon-software.com/home/extfs-windows/) for this - just don't forget to unmount everytime for changes to take effect.

---

#### [Optional] Direct access with a screen and keyboard

You can also boot your server with a screen and keyboard connected to it to see how the boot process is going on (which can also be useful to troubleshoot issues) and to have a direct access to it.

![](image://boot_screen.png)
