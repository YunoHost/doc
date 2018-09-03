# Install YunoHost on VitualBox

*Find other ways to install YunoHost **[here](/install)**.*

## Requirements

<img src="/images/virtualbox.png" width=200>

* A x86 computer with VirtualBox installed and enough RAM capacity to be able to run a small virtual machine.
* The latest stable **YunoHost ISO image**, available [here](/images).


---

## <small>1.</small> Create a new virtual machine

<img src="/images/virtualbox_1.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

* 256MB RAM is the minimum required, 512MB may be better.

* 4GB storage is the minimum required.

---

## <small>2.</small> Change network settings

Go to **Settings** > **Network**:

<img src="/images/virtualbox_2.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

* Select `Bridged adapter`

* Select your interface's name:

    **wlan0** if you are connected wirelessly, else **eth0**.

---

## <small>3.</small> Boot up the virtual machine

Start the virtual machine

<img src="/images/virtualbox_2.1.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

You will have to select your ISO image here, then you should see the YunoHost's boot screen.

<br>

<img src="/images/virtualbox_3.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

* Select `Graphical install`

* Select your language, your location, your keyboard layout and let the installer do the rest :-)

---

## <small>4.</small> Proceed to post-installation

After the reboot, you will see this screen:

<img src="/images/virtualbox_4.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>
* The password for root user is "yunohost"

* You can get more information on the post-installation here: **[yunohost.org/postinstall](/postinstall)**

