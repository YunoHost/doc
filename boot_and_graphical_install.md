# Graphical installation

Now that your YunoHost install medium, you can start with the installation.

## <small>1.</small> Plug the network cable

If you want the network configuration to be set up automatically, you have to plug your server with an **Ethernet** cable **right behind your main router**.
 
The wireless connections are not supported yet, and if you use intermediate routers, the network ports opening will not be automatic: Your server will not be accessible externally.


## <small>2.</small> Boot on CD / USB key

Boot up your server with the USB key or a CD-ROM inserted, and select it as **bootable device** by pressing one of the following keys (hardware specific):    
```<ESC>```, ```<F8>```, ```<F10>```, ```<F11>```, ```<F12>``` or ```<SUPPR>```

## <small>3.</small> Launch graphical installation

You should see a screen like this:

<img src="https://yunohost.org/images/virtualbox_3.png">


* Select `Graphical install`

* Select your language, your location and your keyboard layout

* If a partitioning screen appears, confirm.

    <div class="alert alert-danger"><b>Caution:</b> This will totally erase the data on your hard drive</div>


* Let the installer do the rest, it will download required packages and install them. 

   <div class="alert alert-info">If it fails, you probably have an Internet connection issue.    
Check that your computer is physically connected and retry.</div>

* It should reboot automatically.

## <small>4.</small> Proceed to post-installation

Once booted, your computer should display a screen like this:

<img src="https://yunohost.org/images/virtualbox_4.png">

You can proceed to post-installation right away, or access the **IP** address shown on this screen from another computer's web browser (usually `http://192.168.x.x`)

<img src="https://yunohost.org/images/postinstall_error.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

If you encounter this kind of error, click on "**Proceed**" or "**Add an exception**".    
This means that you have to trust the certificate which secures your server's connections.    
Since this is your server, you can bypass it serenely here :-)

<br> 

<img src="https://yunohost.org/images/postinstall_web.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

---

#### More information on the post-installation here:

**[yunohost.org/postinstall](/postinstall)**
