# Graphical installation

Now that your YunoHost install medium, you can start with the installation.

## <small>1.</small> Plug the network cable

If you want the network configuration to be set up automatically, you have to plug your server with an **Ethernet** cable **right behind your main router**.
 
The wireless connections are not supported yet, and if you use intermediate routers, the network ports opening will not be automatic: Your server will not be accessible externally.


## <small>2.</small> Boot on CD / USB stick

Boot up your server with the USB stick or a CD-ROM inserted, and select it as **bootable device** by pressing one of the following keys (hardware specific):    
```<ESC>```, ```<F9>```, ```<F10>```, ```<F11>```, ```<F12>``` or ```<DEL>```

## <small>3.</small> Launch graphical installation

You should see a screen like this:

<img src="/images/virtualbox_3.png">


* Select `Graphical install`

* Select your language, your location and your keyboard layout

* If a partitioning screen appears, confirm.

    <div class="alert alert-danger"><b>Caution:</b> This will totally erase the data on your hard drive</div>


* Let the installer do the rest, it will download required packages and install them. 

   <div class="alert alert-info">If it fails, you probably have an Internet connection issue.    
Check that your computer is physically connected and retry.</div>

* It should reboot automatically.

## <small>4.</small> Log in

After the reboot, you should see a black screen with a few words asking you to
log in. You can log with the following credentials :

* User: **root**
* Password: **yunohost**

## <small>5.</small> Proceed to post-installation

<a class="btn btn-lg btn-default" href="/postinstall">Post-install documentation</a>


