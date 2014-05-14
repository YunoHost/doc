# Install YunoHost on a Raspberry Pi

*Find other ways to install YunoHost **[here](/install)**.*

## Pre-requisite

* A Raspberry Pi model B *-- Model A should work, but remains untested*
* An SD card: **4GB** capacity (or more) and **class10** speed rate are highly recommended
* Another computer to read this guide and to access your Raspberry Pi
* A screen and a keyboard are recommended to control your Raspberry Pi if a problem occurs.
* A [reasonable ISP](/isp), preferably with a good and unlimited upstream bandwidth
* The **YunoHost Raspberry image**, available here:

    [http://build.yunohost.org/raspberry-latest.img](http://build.yunohost.org/raspberry-latest.img)

## <small>1.</small> Copy the image to your SD card

#### On Windows
* Download and install **[Win32 Disk Imager](http://sourceforge.net/projects/win32diskimager/)**
* Plug your SD card in
* Copy the `raspberry-latest.img` file to your SD card using Win32 Disk Imager.

#### On GNU/Linux, BSD or Mac OS X
* Open a terminal
* Plug your SD card in
* Identify the device name by typing:

```bash
sudo fdisk -l
```

It should be `/dev/diskN`, where `N` is a number, or `/dev/sdX`, where `X` is a number.

* Copy the image by typing:

```bash
sudo dd bs=1M if=/path/to/your/raspberry-latest.img of=/your/device/name
```

Do not forget to change `/path/to/your/raspberry-latest.img` and `/your/device/name` with the appropriate values.

Your SD card is now ready to be used. **:-)**

## <small>2.</small> Boot up the Raspberry Pi

* Put the SD card in the Raspberry Pi and **plug the Ethernet cable** in.
* Do not forget to **plug a screen** if you want to see how boot is going, and a keyboard if you want to have a **command-line access** to your Raspberry Pi.
* Plug the USB power and wait until you see a big squared `Y`

You should be able to see an `IP address` field on the screen, write it down: It is your Raspberry Pi **local IP address**.

## <small>3.</small> Post-Installation

You have two different ways to configure YunoHost, it just has to be done once:

### Web

On your other computer, open a web browser and type down your **local IP address** in the address bar. It should looks like `https://192.168.1.3`.

A warning message appears, just ignore it by clicking the "**Proceed Anyway**" or "**Add an exception**" button.

You are now on the post-installation screen, follow the instructions and proceed. Remember that your Raspberry Pi is not really powerful, this process may thus take several minutes.



### Command-line

If you choose to do the post-installation process directly from your Raspberry Pi, log in at boot screen with the credentials **root** / **yunohost**, and execute:

```bash
yunohost tools postinstall
```

The administration password and a domain will be asked.

---

You can get more information on the post-installation process here:

**[https://yunohost.org/postinstall](/postinstall)**
