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
page-toc:
  active: true
  depth: 2
routes:
  default: '/install'
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
    - '/postinstall'
---
{% set image_type = 'YunoHost' %}
{% set arm, at_home, regular, rpi2plus, rpi1, rpi0, arm_sup, arm_unsup, vps, vps_debian, vps_ynh, virtualbox, internetcube, docker = false, false, false, false, false, false, false, false, false, false, false, false, false, false %}
{% set hardware = uri.param('hardware')  %}

{% if hardware == 'regular' %}
  {% set regular = true %}
{% elseif hardware == 'internetcube' %}
  {% set arm, arm_sup, internetcube = true, true, true %}
  {% set image_type = 'Internet Cube' %}
{% elseif hardware == 'rpi2plus' %}
  {% set arm, rpi2plus = true, true %}
{% elseif hardware == 'rpi1' %}
  {% set arm, rpi1 = true, true %}
{% elseif hardware == 'rpi0' %}
  {% set arm, rpi0 = true, true %}
{% elseif hardware == 'arm_sup' %}
  {% set arm, arm_sup = true, true %}
{% elseif hardware == 'arm_unsup' %}
  {% set arm, arm_unsup = true, true %}
  {% set image_type = 'Armbian' %}
{% elseif hardware == 'vps_debian' %}
  {% set vps, vps_debian = true, true %}
{% elseif hardware == 'vps_ynh' %}
  {% set vps, vps_ynh = true, true %}
{% elseif hardware == 'virtualbox' %}
  {% set at_home, virtualbox = true, true %}
{% elseif hardware == 'docker' %}
  {% set docker = true %}
{% endif %}

{% if arm or regular %}
  {% set at_home = true %}
{% endif %}

Select the hardware on which you want install YunoHost :
[div class="flex-container"]

[div class="flex-child hardware{%if virtualbox %} active{% endif %}"]
[[figure caption="VirtualBox"]![](image://virtualbox.png?height=75)[/figure]](/install/hardware:virtualbox)
[/div]

[div class="flex-child hardware{%if rpi2plus or rpi1 or rpi0 %} active{% endif %}"]
[[figure caption="Raspberry Pi"]![](image://raspberrypi.jpg?height=75)[/figure]](/install/hardware:rpi2plus)
[/div]

[div class="flex-child hardware{%if arm_sup or arm_unsup or internetcube %} active{% endif %}"]
[[figure caption="ARM board"]![](image://olinuxino.jpg?height=75)[/figure]](/install/hardware:arm_sup)
[/div]

[div class="flex-child hardware{%if regular %} active{% endif %}"]
[[figure caption="Regular computer"]![](image://computer.png?height=75)[/figure]](/install/hardware:regular)
[/div]

[div class="flex-child hardware{%if vps_debian or vps_ynh %} active{% endif %}"]
[[figure caption="Remote server"]![](image://vps.png?height=75)[/figure]](/install/hardware:vps_debian)
[/div]

[/div]
[div class="flex-container pt-2"]

{% if rpi2plus or rpi1 or rpi0 %}
[div class="flex-child hardware{%if rpi2plus %} active{% endif %}"]
[[figure caption="Raspberry Pi 2, 3 or 4"]![](image://raspberrypi.jpg?height=50)[/figure]](/install/hardware:rpi2plus)
[/div]

[div class="flex-child hardware{%if rpi1 %} active{% endif %}"]
[[figure caption="Raspberry Pi 1"]![](image://rpi1.jpg?height=50)[/figure]](/install/hardware:rpi1)
[/div]

[div class="flex-child hardware{%if rpi0 %} active{% endif %}"]
[[figure caption="Raspberry Pi zero"]![](image://rpi0.jpg?height=50)[/figure]](/install/hardware:rpi0)
[/div]
{% elseif arm_sup or arm_unsup or internetcube %}

[div class="flex-child hardware{%if internetcube %} active{% endif %}"]
[[figure caption="Internet cube With VPN"]![](image://internetcube.png?height=50)[/figure]](/install/hardware:internetcube)
[/div]

[div class="flex-child hardware{%if arm_sup and not internetcube %} active{% endif %}"]
[[figure caption="Olinuxino lime1&2 or Orange Pi PC+"]![](image://olinuxino.jpg?height=50)[/figure]](/install/hardware:arm_sup)
[/div]

[div class="flex-child hardware{%if arm_unsup %} active{% endif %}"]
[[figure caption="Others boards"]![](image://odroidhc4.png?height=50)[/figure]](/install/hardware:arm_unsup)
[/div]
{% elseif vps_debian or vps_ynh %}

[div class="flex-child hardware{%if vps_debian %} active{% endif %}"]
[[figure caption="VPS or dedicated server with Debian 10"]![](image://debian-logo.png?height=50)[/figure]](/install/hardware:vps_debian)
[/div]

[div class="flex-child hardware{%if vps_ynh %} active{% endif %}"]
[[figure caption="VPS or dedicated server with YunoHost pre-installed"]![](image://logo.png?height=50)[/figure]](/install/hardware:vps_ynh)
[/div]

{% endif %}

[/div]


{% if hardware != '' %}

{% if docker %}
!! **YunoHost doesn’t support Docker officially since issues with versions 2.4+. In question, YunoHost 2.4+ doesn’t work anymore on Docker because YunoHost requires systemd and Docker has chosen to not support it natively (and there are other problems link to the firewall and services).**
!!
!! **We strongly discourage you to run YunoHost on docker with those images**

## Community images

However, community images exist and are available on Docker Hub:

  * [AMD64 (classic) (YunoHost 4.x)](https://hub.docker.com/r/domainelibre/yunohost/)
  * [I386 (old computers) (YunoHost 4.x)](https://hub.docker.com/r/domainelibre/yunohost-i386/)
  * [ARM64V8 (Raspberry Pi 4) (YunoHost 4.x)](https://hub.docker.com/r/cms0/yunohost/)
  * [ARMV7 (Raspberry Pi 2/3 ...) (YunoHost 4.x)](https://hub.docker.com/r/domainelibre/yunohost-arm/)
  * [ARMV6 (Raspberry Pi 1) (old yunoHost version)](https://hub.docker.com/r/tuxalex/yunohost-armv6/)
{% else %}


## [fa=list-alt /] Pre-requisites

{% if regular %}
* A x86-compatible hardware dedicated to YunoHost: laptop, nettop, netbook, desktop with 512MB RAM and 16GB capacity (at least)
{% elseif rpi2plus %}
* A Raspberry Pi 2, 3 or 4
{% elseif rpi1 %}
* A Raspberry Pi 1 with at least 512MB RAM
{% elseif rpi0 %}
* A Raspberry Pi zero
{% elseif internetcube %}
* An Orange Pi PC+ or an Olinuxino Lime 1 or 2
* A VPN with a dedicated public IP and a `.cube` file
{% elseif arm_sup %}
* An Orange Pi PC+ or an Olinuxino Lime 1 or 2
{% elseif arm_unsup %}
* An ARM board with at least 512MB RAM
{% elseif vps_debian %}
* A dedicated or virtual private server with Debian 10 (Buster) <small>(with **kernel >= 3.12**)</small> preinstalled, 512MB RAM and 16GB capacity (at least)
{% elseif vps_ynh %}
* A dedicated or virtual private server with yunohost preinstalled, 512MB RAM and 16GB capacity (at least)
{% elseif virtualbox %}
* An x86 computer with [VirtualBox installed](https://www.virtualbox.org/wiki/Downloads) and enough RAM capacity to be able to run a small virtual machine with 1024MB RAM and 8GB capacity (at least)
{% endif %}
{% if arm %}
* A power supply (either an adapter or a MicroUSB cable) for your board;
* A microSD card: 16GB capacity (at least), [class "A1"](https://en.wikipedia.org/wiki/SD_card#Class) highly recommended (such as [this SanDisk A1 card](https://www.amazon.fr/SanDisk-microSDHC-Adaptateur-homologu%C3%A9e-Nouvelle/dp/B073JWXGNT/));
{% endif %}
{% if regular %}
* A USB stick with at least 1GB capacity OR a standard blank CD
{% endif %}
{% if at_home %}
* A [reasonable ISP](/isp), preferably with a good and unlimited upstream bandwidth
{% if rpi0 %}
* An usb OTG or a wifi dongle to connect your Raspberry Pi Zero
{% elseif not virtualbox %}
* An ethernet cable (RJ-45) to connect your server to your router.
{% endif %}
* A computer to read this guide, flash the image and access your server.
{% endif %}
{% if not at_home %}
* A computer or a smartphone to read this guide and access your server.
{% endif %}

{% if virtualbox %}
! N.B. : Installing YunoHost in a VirtualBox is usually intended for testing. To run an actual server on the long-term, you usually need a dedicated physical machine (old computer, ARM board...) or a server online.
{% endif %}




{% if vps_ynh %}
## YunoHost VPS providers
Here are some VPS providers supporting YunoHost natively :

[div class="flex-container"]

[div class="flex-child"]
[[figure caption="Alsace Réseau Neutre - FR"]![](image://vps_ynh_arn.png?height=50)[/figure]](https://vps.arn-fai.net)
[/div]

[/div]
{% endif %}


{% if at_home %}
## [fa=download /] Download the {{image_type}} image

{% if virtualbox or regular %}
!!! If your host OS is 32 bits, be sure to download the 32-bit image.
{% elseif arm_unsup %}
<a href="https://www.armbian.com/download/" target="_BLANK" type="button" class="btn btn-info col-sm-12">[fa=external-link] Download the image for your board on Armbian's website</a>

!!! N.B.: you should download the image Armbian Buster.
{% endif %}


<div class="hardware-image">
<div id="cards-list">
</div>
</div>
<script type="text/template" id="image-template">
<div id="{id}" class="card panel panel-default">
        <div class="panel-body text-center pt-2">
            <h3>{name}</h3>
            <div class="card-comment">{comment}</div>
            <div class="card-desc text-center">
<img src="/user/images/{image}" height=100 style="vertical-align:middle">
            </div>
        </div>
        <div class="annotations flex-container">
            <div class="flex-child annotation"><a href="{file}.sha256sum">[fa=barcode] Checksum</a></div>
            <div class="flex-child annotation"><a href="{file}.sig">[fa=tag] Signature</a></div>
        </div>
        <div class="btn-group" role="group">
            <a href="{file}" target="_BLANK" type="button" class="btn btn-info col-sm-12">[fa=download] Download <small>{version}</small></a>
        </div>
</div>
</script>
<script>
var hardware = "{{ hardware|escape('js') }}";
/*
###############################################################################
  Script that loads the infos from JavaScript and creates the corresponding
  cards
###############################################################################
*/
$(document).ready(function () {
    console.log("in load");
    $.getJSON('https://build.yunohost.org/images.json', function (images) {
        $.each(images, function(k, infos) {
            if (infos.tuto.indexOf(hardware) == -1) return;
            // Fill the template
            html = $('#image-template').html()
             .replace('{id}', infos.id)
             .replace('{name}', infos.name)
             .replace('{comment}', infos.comment || "&nbsp;")
             .replace('{image}', infos.image)
             .replace('{version}', infos.version);
 
            if (infos.file.startsWith("http"))
                html = html.replace(/{file}/g, infos.file);
            else
                html = html.replace(/{file}/g, "https://build.yunohost.org/"+infos.file);
   
            if ((typeof(infos.has_sig_and_sums) !== 'undefined') && infos.has_sig_and_sums == false)
            {
                var $html = $(html);
                $html.find(".annotations").html("&nbsp;");
                html = $html[0];
            } 
            $('#cards-list').append(html);
        });
    });
});
</script>






{% if not virtualbox %}

{% if arm %}
## ![microSD card with adapter](image://sdcard_with_adapter.png?resize=100,75&class=inline) Flash the {{image_type}} image
{% else %}
## ![USB drive](image://usb_key.png?resize=100,100&class=inline) Flash the YunoHost image
{% endif %}

Now that you downloaded the image of {{image_type}}, you should flash it on {% if arm %}a microSD card{% else %}a USB stick or a CD/DVD.{% endif %}

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="(Recommended) With Etcher"]

Download <a href="https://www.balena.io/etcher/" target="_blank">Etcher</a> for your operating system and install it.

Plug your {% if arm %}SD card{% else %}USB stick{% endif %}, select your image and click "Flash"

![Etcher](image://etcher.gif?resize=700&class=inline)

[/ui-tab]
[ui-tab title="With USBimager"]

Download [USBimager](https://bztsrc.gitlab.io/usbimager/) for your operating system and install it.

Plug your {% if arm %}SD card{% else %}USB stick{% endif %}, select your image and click "Write"

![USBimager](image://usbimager.png?resize=700&class=inline)

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

! It's okay if you can only have 32-bit versions, just be sure that you downloaded the 32-bit image previously.

## Tweak network settings

! This step is important to properly expose the virtual machine on the network

Go to **Settings** > **Network**:

* Select `Bridged adapter`
* Select your interface's name:
    **wlan0** if you are connected wirelessly, or **eth0** otherwise.

![](image://virtualbox_2.png?class=inline)

{% endif %}









{% if arm %}
## [fa=plug /] Power up the board

* Plug the ethernet cable (one side on your main router, the other on your board).
    * For advanced users willing to configure the board to connect to WiFi instead, see for example [here](https://www.raspberrypi.org/documentation/configuration/wireless/wireless-cli.md).
* Plug the SD card in your board
* (Optional) You can connect a screen+keyboard directly on your board if you want to troubleshoot the boot process or if you're more comfortable to "see what happens" or want a direct access to the board.
* Power up the board
* Wait a couple minutes while the board autoconfigure itself during the first boot
* Make sure that your computer (desktop/laptop) is connected to the same local network (i.e. same internet box) as your server.

{% elseif virtualbox %}
## [fa=plug /] Boot up the virtual machine

Start the virtual machine after selecting the YunoHost image.

![](image://virtualbox_2.1.png?class=inline)

! If you encounter the error "VT-x is not available", you probably need to enable Virtualization in the BIOS of your computer.


{% else %}
## [fa=plug /] Boot the machine on your USB stick

* Plug the ethernet cable (one side on your main router, the other on your server).
* Boot up your server with the USB stick or a CD-ROM inserted, and select it as **bootable device** by pressing one of the following keys (hardware specific):
`<ESC>`, `<F9>`, `<F10>`, `<F11>`, `<F12>` or `<DEL>`.
    * N.B. : if the server was previously installed with a recent version of Windows (8+), you first need to tell Windows, to "actually reboot". This can be done somewhere in "Advanced startup options".
{% endif %}

{% if regular or virtualbox %}
## [fa=rocket /] Launch the graphical install

!! N.B. : The installation will totally erase the data on the server's hard drive!

You should see a screen like this:

[figure class="nomargin" caption="Preview of the ISO menu"]
![](image://virtualbox_3.png?class=inline)
[/figure]

  1. Select `Graphical install`
  2. Select your language, your location and your keyboard layout
  3. The installer will then download and install all required packages.

{% endif %}


{% if rpi1 or rpi0 %}
## [fa=bug /] Connect to the board and hotfix the image
Raspberry Pi 1 and 0 are not totally supported due to [compilation issues for this architecture](https://github.com/YunoHost/issues/issues/1423).

However, it is possible to fix by yourself the image before to run the initial configuration.

To achieve this, you need to connect on your raspberry pi as root user [via SSH](/ssh) with the temporary password `yunohost`:
```
ssh root@yunohost.local
```

Then run the following commands to work around the metronome issue:
```
mv /usr/bin/metronome{,.bkp}   
mv /usr/bin/metronomectl{,.bkp} 
ln -s /usr/bin/true /usr/bin/metronome
ln -s /usr/bin/true /usr/bin/metronomectl
```

And this one to work around the upnpc issue:
```
sed -i 's/import miniupnpc/#import miniupnpc/g' /usr/lib/moulinette/yunohost/firewall.py
```

! This last command need to be run after each yunohost upgrade :/

{% elseif arm_unsup %}
## [fa=terminal /] Connect to the board

Next you need to [find the local IP address of your server](/finding_the_local_ip) to connect as root user [via SSH](/ssh) with the temporary password `1234`.

```
ssh root@192.168.x.xxx
```

{% endif %}

{% endif %}


{% if vps_debian or arm_unsup %}
## [fa=rocket /] Run the install script

- Open a command line prompt on your server (either directly or [through SSH](/ssh))
- Make sure you are root (or type `sudo -i` to become root)
- Run the following command:

```bash
curl https://install.yunohost.org | bash
```

!!! If `curl` is not installed on your system, you might need to install it with `apt install curl`.
!!! Otherwise, if the command does not do anything, you might want to `apt install ca-certificates`

!!! **Note for advanced users concerned with the `curl|bash` approach:** consider reading ["Is curl|bash insecure?"](https://sandstorm.io/news/2015-09-24-is-curl-bash-insecure-pgp-verified-install) on Sandstom's blog, and possibly [this discussion on Hacker News](https://news.ycombinator.com/item?id=12766350&noprocess).

{% endif %}


## [fa=cog /] Proceed with the initial configuration

!!! If you are in the process of restoring a server using a YunoHost backup, you should skip this step and instead [restore the backup instead of the postinstall step](/backup#restoring-during-the-postinstall).

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="From the web interface"]
{%if at_home %}
In an internet browser, type **{% if internetcube %}`https://internetcube.local`{% else %}`https://yunohost.local`{% endif %}**.

!!! If this doesn't work, you can [look for the the local IP address of your server](/finding_the_local_ip). The address typically looks like `192.168.x.y`, and you should therefore type `https://192.168.x.y` in your browser's address bar.
{% else %}
You can perform the initial configuration with the web interface by typing in the adress bar of your web browser **the public IP address of your server**. Typically, your VPS provider should have provided you with the IP of the server.
{% endif %}

! During the first visit, you will very likely encounter a security warning related to the certificate used by the server. For now, your server uses a self-signed certificate. You will later be able to add a certificate automatically recognized by web browsers as described in the [certificate documentation](/certificate). For now, you should add a security exception to accept the current certificate. (Though PLEASE, don't take the habit to blindly accepting this kind of security alerts !)

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

##### [fa=globe /] Main domain

This will be the domain used by your server's users to access the **authentication portal**. You can later add other domains, and change which one is the main domain if needed.

* If you're new to self-hosting and do not already have a domain name, we recommend using a **.nohost.me** / **.noho.st** / **.ynh.fr** (e.g. `homersimpson.nohost.me`). Provided that it's not already taken, the domain will be configured automatically and you won't need any further configuration step. Please note that the downside is that you won't have full-control over the DNS configuration.

* If you already own a domain name, you probably want to use it here. You will later need to configure DNS records as explained [here](/dns_config).

!!! Yes, you *have to* configure a domain name. If you don't have any domain name and don't want a **.nohost.me** / **.noho.st** / **.ynh.fr** either, you can set up a dummy domain such as `yolo.test` and tweak your `/etc/hosts` file such that this dummy domain points to the appropriate IP, as explained [here](/dns_local_network)).

##### [fa=key /] Administration password

This password will be used to access to your server's administration interface. You will also use it to connect [via **SSH**](/ssh) or [**SFTP**](/filezilla). In general terms, this is your **system's key**, choose it carefully!

## [fa=user /] Create a first user

Once the postinstall is done, you should be able to actually log in the web admin interface using the administration password.

So far, your server now has an `admin` user - but `admin` is not a "regular" user and *can't* be used to log on [the user portal](/users).

Let's therefore add a first "regular" user.

!!! The first user you create is a bit special : it will receive emails sent to `root@yourdomain.tld` and `admin@yourdomain.tld`. These emails may be used to send technical informations or alerts.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="From the web interface"]

Go in Users > Add

TODO: add a screenshot
[/ui-tab]
[ui-tab title="From the command line"]
```
yunohost user create johndoe
```
TODO : copypasta an actual shell session will all info asked etc..

[/ui-tab]
[/ui-tabs]
{% endif %}

## [fa=stethoscope /] Run the initial diagnosis

The diagnosis system is meant to provide an easy way to validate that all critical aspects of your server are properly configured - and guide you in how to fix issues. The diagnosis will run twice a day and send an alert if issues are detected.

!!! N.B. : **don't run away** ! The first time you run the diagnosis, it is quite expected to see a bunch of yellow/red alerts because you typically need to [configure DNS records](/dns_config) (if not using a `.nohost.me`/`noho.st`/`ynh.fr` domain), add a swapfile if not enough ram {% if at_home %} and/or [port forwarding](/isp_box_config){% endif %}.

!!! If an alert is not relevant (for example because you don't intend on using a specific feature), it is perfectly fine to flag the issue as 'ignored' by going in the webadmin > Diagnosis, and clicking the ignore button for this specifc issue.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="(Recommended) From the web interface"]
To run a diagnosis, go on Web Admin in the Diagnosis section. You should get a screen like this :

[figure class="nomargin" caption="Preview of the diagnostic panel"]
![](image://diagnostic.png?resize=100%&class=inline)
[/figure]

[/ui-tab]
[ui-tab title="From the command line"]
```
yunohost diagnosis run
yunohost diagnosis show --issues --human-readable
```
[/ui-tab]
[/ui-tabs]

## [fa=lock /] Get a Let's Encrypt certificate

Once you configured DNS records and port forwarding (if needed), you should be able to install a a Let's Encrypt certificate. This will get rid of the spooky security warning from earlier for new visitors.

For more detailled instructions, or to lean more about SSL/TLS certificates, see [the corresponding page here](/certificate).

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="From the web interface"]

[figure class="nomargin" caption="Preview of the diagnostic panel"]
![](image://certificate-before-LE.png?resize=100%&class=inline)
[/figure]

[/ui-tab]
[ui-tab title="From the command line"]
```
yunohost domain cert-install
```
[/ui-tab]
[/ui-tabs]
{% endif %}

## ![](image://tada.png?resize=32&classes=inline) Congratz!

You now have a pretty well configured server. If you're new to YunoHost, we recommend to have a look at [the guided tour](/overview). You should also be able to [install your favourite applications](/apps). Don't forget to [plan backups](/backup) !

{% endif %}
