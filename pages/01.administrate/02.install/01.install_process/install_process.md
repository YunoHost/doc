---
title: Install YunoHost
template: docs
taxonomy:
    category: docs
never_cache_twig: true
twig_first: true
process:
    markdown: true
    twig: true
routes:
  default: '/install_process'
  aliases: 
    - '/docker'
    - '/install_iso'
    - '/install_on_vps'
    - '/install_manually'
    - '/install_on_raspberry'
    - '/install_on_arm_board'
    - '/install_on_debian'
    - '/install_on_virtualbox'
    - '/plug_and_boot'
    - '/burn_or_copy_iso'
    - '/boot_and_graphical_install'
---
{% set arm, at_home, regular, rpi2plus, rpi1, rpi0, arm_sup, arm_unsup, vps, vps_debian, vps_ynh, virtualbox, internetcube, docker = false, false, false, false, false, false, false, false, false, false, false, false, false, false %}
{% if uri.param('hardware') == 'regular' %}
  {% set regular = true %}
{% elseif uri.param('hardware') == 'internetcube' %}
  {% set arm, arm_sup, internetcube = true, true, true %}
{% elseif uri.param('hardware') == 'rpi2plus' %}
  {% set arm, rpi2plus = true, true %}
{% elseif uri.param('hardware') == 'rpi1' %}
  {% set arm, rpi1 = true, true %}
{% elseif uri.param('hardware') == 'rpi0' %}
  {% set arm, rpi0 = true, true %}
{% elseif uri.param('hardware') == 'arm_sup' %}
  {% set arm, arm_sup = true, true %}
{% elseif uri.param('hardware') == 'arm_unsup' %}
  {% set arm, arm_unsup = true, true %}
{% elseif uri.param('hardware') == 'vpsdebian' %}
  {% set vps, vps_debian = true, true %}
{% elseif uri.param('hardware') == 'vpsynh' %}
  {% set vps, vps_ynh = true, true %}
{% elseif uri.param('hardware') == 'virtualbox' %}
  {% set at_home, virtualbox = true, true %}
{% elseif arm or regular %}
  {% set at_home = true %}
{% elseif uri.param('hardware') == 'docker' %}
  {% set docker = true %}
{% endif %}

<style>

</style>
Select the hardware on which you want install YunoHost :
[div class="flex-container"]

[div class="flex-child"]
[[figure caption="VirtualBox"]![](image://virtualbox.png?height=75)[/figure]](/install_process/hardware:virtualbox)
[/div]

[div class="flex-child"]
[[figure caption="Raspberry Pi"]![](image://raspberrypi.jpg?height=75)[/figure]](/install_process/hardware:rpi2plus)
[/div]

[div class="flex-child"]
[[figure caption="ARM board"]![](image://olinuxino.jpg?height=75)[/figure]](/install_process/hardware:arm_sup)
[/div]

[div class="flex-child"]
[[figure caption="Regular computer"]![](image://computer.png?height=75)[/figure]](/install_process/hardware:regular)
[/div]

[div class="flex-child"]
[[figure caption="Dedicated or virtual private server"]![](image://vps.png?height=75)[/figure]](/install_process/hardware:vps_debian)
[/div]

[div class="flex-child"]
[[figure caption="(Non-official!) Docker"]![](image://docker.png?height=75)[/figure]](/install_process/hardware:docker)
[/div]

[/div]




{% if docker %}
!! **YunoHost doesn’t support Docker officially since issues with versions 2.4+. In question, YunoHost 2.4+ doesn’t work anymore on Docker because YunoHost requires systemd and Docker has chosen to not support it natively (and there are other problems link to the firewall and services).**
!!
!! **We strongly discourage you to run YunoHost on docker with those images**

## Community images

However, community images exist and are available on Docker Hub:

  * [AMD64 (classic) (ancienne version de YunoHost)](https://hub.docker.com/r/domainelibre/yunohost/)
  * [I386 (old computers) (ancienne version de YunoHost)](https://hub.docker.com/r/domainelibre/yunohost-i386/)
  * [ARMV7 (Raspberry Pi 2/3 ...) (ancienne version de YunoHost)](https://hub.docker.com/r/domainelibre/yunohost-arm/)
  * [ARMV6 (Raspberry Pi 1) (old yunoHost version)](https://hub.docker.com/r/tuxalex/yunohost-armv6/)
{% else %}


## Pre-requisites

{% if regular %}
* A x86-compatible hardware dedicated to YunoHost: laptop, nettop, netbook, desktop ...
{% elseif rpi2plus %}
* A Raspberry Pi 2, 3 or 4 ...
{% elseif rpi1 %}
* A RPi 1 ...
{% elseif rpi0 %}
* A RPi zero ...
{% elseif arm_sup %}
* An Orange Pi PC+, or an Onlinuxino Lime 1 or 2 ...
{% elseif arm_unsup %}
* An ARM board with 500MHz CPU ...
{% elseif vps_debian %}
* A dedicated or virtual private server with Debian 10 <small>(with **kernel >= 3.12**)</small>)
preinstalled ...
{% elseif vps_ynh %}
* A dedicated or virtual private server with yunohost preinstalled ...
{% elseif virtualbox %}
* An x86 computer with VirtualBox installed and enough RAM capacity to be able to run a small virtual machine ...
{% endif %}
* ... with 512MB RAM{% if not arm %} and 15GB capacity{% endif %} (at least)

{% if arm %}
* A power supply (either an adapter or a MicroUSB cable) for your board;
* A microSD card: 16GB capacity (at least) and Class 10 speed rate are highly recommended (like the Transcend 300x);
{% endif %}
{% if regular %}
* A USB stick of at least 1GB capacity OR a standard blank CD
{% endif %}
{% if at_home %}
* A reasonable ISP, preferably with a good and unlimited upstream bandwidth
{% if rpi0 %}
* An usb OTG or a wifi dongle to connect your Raspberry Pi Zero
{% else %}
* An ethernet cable (RJ-45) to connect your server to your router.
{% endif %}
* A computer to read this guide, write the image and access to your server.
{% endif %}
{% if not at_home %}
* A computer or a smartphone to read this guide and access to your server.
{% endif %}

{% if virtualbox %}
! N.B. : Installing YunoHost in a VirtualBox is usually intended for testing. To run an actual server on the long-term, you usually need a dedicated physical machine (old computer, ARM board...) or a VPS online.
{% endif %}

{% if at_home %}
## Download the YunoHost image
<div id="cards-list">
<div id="regularcomputer64" class="card panel panel-default" style="max-width:400px">
        <div class="panel-body text-center">
            <h3>Regular computer</h3>
            <div class="card-comment">64 bits - default</div>
            <div class="card-desc text-center">
![Regular computer](image://computer.png?resize=100,100)
            </div>
        </div>
        <div class="annotations">
            <div class="col-sm-6 annotation"><a href="https://build.yunohost.org/yunohost-buster-4.1.6-amd64-stable.iso.sha256sum"><span class="glyphicon glyphicon-barcode" aria-hidden="true"></span> Checksum</a></div>
            <div class="col-sm-6 annotation"><a href="https://build.yunohost.org/yunohost-buster-4.1.6-amd64-stable.iso.sig"><span class="glyphicon glyphicon-tag" aria-hidden="true"></span> Signature</a></div>
        </div>
        <div class="btn-group" role="group">
            <a href="https://build.yunohost.org/yunohost-buster-4.1.6-amd64-stable.iso" target="_BLANK" type="button" class="btn btn-info col-sm-12"><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Télécharger <small>v.4.1.6</small></a>
        </div>
</div>
</div>

{% if regular %}
!!! ***Particular case*** : If your server has no graphic card, [prepare iso for booting with serial port](https://github.com/luffah/debian-mkserialiso).
{% elseif virtualbox %}
!!! If your host OS is 32 bits, be sure that you downloaded the 32-bit image previously.
{% endif %}


{% if not virtualbox %}
## Flash the YunoHost image
Now that you downloaded the image of YunoHost, you should flash it on {% if arm %}a SD card{% else %}a USB stick or a CD.{% endif %}

{% if arm %}
![SD card](image://sdcard.jpg?resize=100,100&class=inline)
![Micro SD card](image://micro-sd-card.jpg?resize=100,100&class=inline)
{% else %}
![USB drive](image://usb_key.png?resize=100,100&class=inline)
![CD](image://cd.jpg?resize=100,100&class=inline)
{% endif %}

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="(Recommended) With Etcher"]

Download <a href="https://www.balena.io/etcher/" target="_blank">Etcher</a> for your operating system and install it.

![Etcher](image://etcher.gif?resize=100%&class=inline)

Plug your USB stick, select your YunoHost ISO and click "Flash"
[/ui-tab]
[ui-tab title="With UNetbootin"]

Download <a href="https://unetbootin.github.io/">UNetbootin</a> for your operating system and install it.

![UNetbootin](image://unetbootin.png?resize=100%&class=inline)

Put your USB stick on, select your YunoHost ISO and click "OK"


[/ui-tab]
[ui-tab title="With dd"]

If you are on GNU/Linux / macOS and know your way around command line, you may also flash your USB stick or SD card with `dd`. You can identify which device corresponds to your USB stick or SD card with `fdisk -l` or `lsblk`. A typical SD card name is something like `/dev/mmcblk0`. BE CAREFUL and make sure you got the right name.

Then run :

```bash
# Replace /dev/mmcblk0 if the name of your device is different...
dd if=/path/to/yunohost.img of=/dev/mmcblk0
```
[/ui-tab]
{% if regular %}
[ui-tab title="Burning a CD/DVD"]
For older devices, you might want to burn a CD/DVD. The software to use depends on your operating system.

* On Windows, use [ImgBurn](http://www.imgburn.com/) to write the image file on the disc

* On macOS, use [Disk Utility](http://support.apple.com/kb/ph7025)

* On GNU/Linux, you have plenty of choices, like [Brasero](https://wiki.gnome.org/Apps/Brasero) or [K3b](http://www.k3b.org/)
[/ui-tab]
{% endif %}
[/ui-tabs]

{% else %}
## Create a new virtual machine

![](image://virtualbox_1.png?class=inline)


---

## Change network settings

**NB:** You must carry out this step. If not, the install will fail. 

Go to **Settings** > **Network**:

![](image://virtualbox_2.png?class=inline)

* Select `Bridged adapter`

* Select your interface's name:

    **wlan0** if you are connected wirelessly, else **eth0**.

---


{% endif %}









{% if arm %}
## Power up the board
* Plug the ethernet cable. 
!!! Note: if you want the network configuration to be set up automatically, you have to plug your server with an Ethernet cable right behind your main router.[details="If you have confident in your skills, it's possible to connect your server through WiFi"]If you want your server to connect using WiFi, you may configure it as explained [here](https://www.raspberrypi.org/documentation/configuration/wireless/wireless-cli.md). Alternatively, you can mount the second partition of the SD card and edit the `wpa-supplicant.conf` file prior to boot the card for the first time. On Windows you can use [Paragon ExtFS](https://www.paragon-software.com/home/extfs-windows/) for this - just don't forget to unmount everytime for changes to take effect.[/details]
* Plug the SD card
* Power up the board
!!! You can also boot your server with a screen and keyboard connected to it to see how the boot process is going on.[details="See more"]This method can also be useful to troubleshoot issues and to have a direct access to it.<div class="text-center"><img src="/images/boot_screen.png"></div>[/details]
* Wait a couple minutes for your server to boot and to resize automatically partition
* Make sure that your computer (desktop/laptop) is connected to the same local network (i.e. same internet box) as your server.

TODO improve details feature ?

{% elseif virtualbox %}
## Boot up the virtual machine

Start the virtual machine

![](image://virtualbox_2.1.png?class=inline)

You will have to select your ISO image here, then you should see the YunoHost's boot screen.

! If you encounter the error "VT-x is not available", you need probably need to enable Virtualization in the BIOS of your computer.


{% else %}
## Boot the machine on your usb stick and run the installation
* Plug the ethernet cable. 
!!! Note: if you want the network configuration to be set up automatically, you have to plug your server with an Ethernet cable right behind your main router. The wireless connections are not supported yet, and if you use intermediate routers, the network ports opening will not be automatic: Your server will not be accessible externally.
* If your server was under windows 7+, ask for windows to boot on the USB stick TODO
* Boot up your server with the USB stick or a CD-ROM inserted, and select it as **bootable device** by pressing one of the following keys (hardware specific):    
```<ESC>```, ```<F9>```, ```<F10>```, ```<F11>```, ```<F12>``` or ```<DEL>```
{% endif %}

{% if regular or virtualbox %}
## Launch graphical install

You should see a screen like this:

[figure class="nomargin" caption="Preview of the ISO menu"]
![](image://virtualbox_3.png?class=inline)
[/figure]

  1. Select `Graphical install`
  2. Select your language, your location and your keyboard layout
  3. If a partitioning screen appears, confirm.
    !! This will totally erase the data on your hard drive
  4. Let the installer do the rest, it will download required packages and install them.

    ! If it fails, you probably have an Internet connection issue.  
    ! Check that your computer is physically connected and retry.

  5. It should reboot automatically.

TODO what to do with default credentials info ?

{% endif %}








{% else %}
## Run the install script

Once you have access to a command line on your server (either directly or through SSH), you can install YunoHost by running command as root :

```bash
curl https://install.yunohost.org | bash
```

!!! If `curl` is not installed on your system, you might need to install it with `apt install curl`.  
!!! Otherwise, if the command does not do anything, you might want to `apt install ca-certificates`

---

!!! **Note for advanced users concerned with the `curl|bash` approach:**  
!!! If you strongly object to the `curl|bash` way (and similar commands) of installing software, consider reading ["Is curl|bash insecure?"](https://sandstorm.io/news/2015-09-24-is-curl-bash-insecure-pgp-verified-install) on Sandstom's blog, and possibly [this discussion on Hacker News](https://news.ycombinator.com/item?id=12766350).

{% endif %}
## Proceed with initial configuration or restore an archive
!!! if you are in the process of restoring a server from scratch **and** you have a yunohost-made backup, you can skip this process and follow through with the "restoring during the postinstall" step, in the [backup](/backup) page.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="From the web interface"]
You can perform the post-installation with the web interface by entering in your browser {%if at_home %} **`{% if internetcube %}internetcube.local{% else %}yunohost.local{% endif %}`** OR **the local IP address of your server** if it is on your local network (e.g. at home !). The address typically looks like `192.168.x.y` (see [finding your local IP](/finding_the_local_ip)){% else %} **the public IP address of your server** if your server is not on your local network. Typically, if you own a VPS, your VPS provider should have given you the IP of the server.{% endif %}

! During the first visit, you will very likely encounter a security warning related to the certificate used by the server. For now, your server uses a self-signed certificate. You will later be able to add a certificate automatically recognized by web browsers as described in the [certificate documentation](/certificate). For now, you should add a security exception to accept the current certificate. PLEASE, don't take the habit to blindly accept this kind of alert !

{% if not internetcube %}
You should then land on this page :

[figure class="nomargin" caption="Preview of the Web initial configuration page"]
![Initial configuration page](image://postinstall_web.png?resize=100%&class=inline)
[/figure]

{% endif %}
[/ui-tab]
[ui-tab title="From the command line"]

You can also perform the postinstallation with the command `yunohost tools postinstall` directly on the server, or [via SSH](/ssh).

[figure class="nomargin" caption="Preview of the command-line post-installation"]
![Initial configuration with CLI](image://postinstall_cli.png?resize=100%&class=inline)
[/figure]

[/ui-tab]
[/ui-tabs]

{% if not internetcube %}

[details="Details on information asked during initial configuration"]

#### Main domain

This is the first domain name linked to your YunoHost server, but also the one which will be used by your server's users to access the **authentication portal**. It will thus be **visible by everyone**, choose it wisely.

* If you do not have a domain name, or if you want to use the YunoHost's DynDNS service, choose a sub-domain of **.nohost.me**, **.noho.st** or **.ynh.fr** (e.g. `homersimpson.nohost.me`). Provided that it's not already taken, the domain will be configured automatically and you won't need any further configuration step.

* If you do know what **DNS** is, you probably want to configure your own domain name here. In this case, please refer to the [DNS page](/dns) page for more informations.

* If you don't own a domain name and don't want a **.nohost.me**, **.noho.st** or **.ynh.fr**, you can use a local domain. More information on how to setup a local domain can be found [here](/dns_local_network).

#### Administration password

This password will be used to access to your server's [administration interface](/admin). You would also use it to connect via **SSH** or **SFTP**. In general terms, this is your **system's key**, [choose it carefully](http://www.wikihow.com/Choose-a-Secure-Password).
[/details]

## Create a first user
You should create a first user. 

!!! This user will received special emails `root@`, `admin@`, `postmaster@`, `webmaster@` and `abuse@`. These emails are used to send you mails about your server.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="From the web interface"]
[/ui-tab]
[ui-tab title="From the command line"]
You can create your first user by running this command, it will ask you some information.
```
yunohost user create johndoe
```
[/ui-tab]
[/ui-tabs]
{% endif %}

## Run diagnostic and fix DNS or Router issues if needed
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="(Recommended) From the web interface"]
[/ui-tab]
[ui-tab title="From the command line"]
[/ui-tab]
[/ui-tabs]

## Let's Encrypt
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="From the web interface"]
[/ui-tab]
[ui-tab title="From the command line"]
[/ui-tab]
[/ui-tabs]
{% endif %}
