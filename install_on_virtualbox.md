# Install YunoHost on VitualBox

*Find other ways to install YunoHost **[here](/install)**.*

## Requirements

<img src="/images/virtualbox.png" width=200>

* An x86 computer with VirtualBox installed and enough RAM capacity to be able to run a small virtual machine.
* The latest stable **YunoHost ISO image**, available [here](/images).

<div class="alert alert-warning" markdown="1">
N.B. : Installing YunoHost in a VirtualBox is usually intended for testing. To
run an actual server on the long-term, you usually need a dedicated physical
machine (old computer, ARM board, ...) or a VPS online.
</div>

---

## <small>1.</small> Create a new virtual machine

<img src="/images/virtualbox_1.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

* It's okay if you can only have 32-bit versions, just be sure that you downloaded the 32-bit image previously.
* 256MB RAM is the minimum required, but at least 512MB is recommended (1Go or more if you can).
* 8GB storage is the minimum required.

---

## <small>2.</small> Change network settings

**NB:** You must carry out this step. If not, the install will fail. 

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

If you encounter the error "VT-x is not available", you need probably need to enable Virtualization in the BIOS of your computer.

<br>

<img src="/images/virtualbox_3.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

* Select `Graphical install`

* Select your language, your location, your keyboard layout and let the installer do the rest :-)

---

## <small>4.</small> Proceed to post-installation

After the reboot, the system should ask you to proceed with the
post-installation

<a class="btn btn-lg btn-default" href="/postinstall">Post-install documentation</a>



