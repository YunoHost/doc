---
title: Graphical installation
template: docs
taxonomy:
    category: docs
routes:
  default: '/boot_and_graphical_install'
---

Now that your YunoHost install medium, you can start with the installation.

## 1. Plug the network cable

If you want the network configuration to be set up automatically, you have to plug your server with an **Ethernet** cable **right behind your main router**.
 
The wireless connections are not supported yet, and if you use intermediate routers, the network ports opening will not be automatic: Your server will not be accessible externally.

## 2. Boot on CD / USB stick

Boot up your server with the USB stick or a CD-ROM inserted, and select it as **bootable device** by pressing one of the following keys (hardware specific):    
```<ESC>```, ```<F9>```, ```<F10>```, ```<F11>```, ```<F12>``` or ```<DEL>```

## 3. Launch graphical installation

You should see a screen like this:

![VirtualBox](image://virtualbox_3.png?class=center)

1. Select `Graphical install`
2. Select your language, your location and your keyboard layout
3. If a partitioning screen appears, confirm.
  !! This will totally erase the data on your hard drive
4. Let the installer do the rest, it will download required packages and install them.

  ! If it fails, you probably have an Internet connection issue.  
  ! Check that your computer is physically connected and retry.

5. It should reboot automatically.

## 4. Log in

After the reboot, you should see a black screen with a few words asking you to
log in. You can log with the following credentials :

* User: `root`
* Password: `yunohost`

## 5. Proceed to post-installation

[div class="btn btn-lg btn-default"] [Post-install documentation](/administrate/postinstall) [/div]


