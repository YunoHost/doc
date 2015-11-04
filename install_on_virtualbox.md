# Install YunoHost on VitualBox

*Find other ways to install YunoHost **[here](/install)**.*

## Pre-requisite

<img src="https://yunohost.org/images/virtualbox.png" width=200>

* An x86 computer with VirtualBox installed and enough RAM capacity to be able to run a small virtual machine.
* The latest **YunoHost ISO image**, available here: 
  * **Torrent** ([i386](http://build.yunohost.org/yunohostv2-latest-i386.iso.torrent), [amd64](http://build.yunohost.org/yunohostv2-latest-amd64.iso.torrent)): share at least to ratio 1 to assure torrents sustainability
  * **Direct download** ([i386](http://build.yunohost.org/yunohostv2-latest-i386.iso), [amd64](http://build.yunohost.org/yunohostv2-latest-amd64.iso))


---

## <small>1.</small> Create a new virtual machine

<img src="https://yunohost.org/images/virtualbox_1.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

* 256MB RAM is the minimum required, 512MB may be better.

* 4GB storage is the minimum required.

---

## <small>2.</small> Change network settings

Go to **Settings** > **Network**,  and your interface:

<img src="https://yunohost.org/images/virtualbox_2.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

* Select `Bridged adapter`

* Select your interface's name:

    **wlan0** if you are connected wirelessly, else **eth0**.

---

## <small>3.</small> Boot up the virtual machine

Start the virtual machine

<img src="https://yunohost.org/images/virtualbox_2.1.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

You will have to select your ISO image `yunohostv2-latest-amd64.iso` here, then you should see the YunoHost's boot screen.

<br>
   
<img src="https://yunohost.org/images/virtualbox_3.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

* Select `Graphical install`

* Select your language, your location, your keyboard layout and let the installer do the rest :-)

---

## <small>4.</small> Proceed to post-installation

After the reboot, you will see this screen:

<img src="https://yunohost.org/images/virtualbox_4.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

* You can obtain further precisions on post-installation here: **[yunohost.org/postinstall](/postinstall)**

---

***If you need help during one of these steps, do not hesitate to use [our support tools](/support).***
