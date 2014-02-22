#Installation guide

You have two ways to install YunoHost:

1. From a USB key or a CD-ROM (below guide)
2. [Through the install script on an existing Debian system](/install_on_debian)

### Pre-requisite

* An x86-[compatible hardware](/compatible_hardware) dedicated to YunoHost. Be careful to avoid having any unsaved data on it before installation.
* Another computer to read this guide and to access your server.
* A [reasonable ISP](/isp), with good upstream bandwidth, unlimited download/upload, and tolerant of self-hosting.
* A USB key (via [Unetbootin](http://unetbootin.net/more-infos-and-get-it/)) or a CD burned with the latest YunoHost ISO: http://build.yunohost.org

### Boot on CD-ROM drive or USB key

Boot up your server with the USB key or a CD-ROM inserted, and select it as bootable device by pressing one of the following keys (hardware specific): ```<ESC>```, ```<F8>```, ```<F10>```, ```<F11>```, ```<F12>``` ou ```<SUPPR>```


### Installation process
Connect the server to your Ethernet router.

Select "Graphical Install" and follow the instructions. You get to choose the system language and keyboard layout, then you must confirm the full formating of the hard drive.

The installation process will run on itself, automatically downloading the required packages.

If this step is not successful, you probably have a connection problem. Check that your Internet connection is working.

### Post Installation

Your hardware should automatically reboot after installation. At the end of the reboot, your freshly installed YunoHost system should display the IP address of your server and a proposal for post-installation: proceed to post-installation.

You can then either:
* Login to http://xxxx (xxxx is your IP address) from another machine and follow the instructions post installation.
* Run the post-installation commandline by typing the enter key on your server.

Two parameters will be required:

1. Domain Name: You must choose a domain name that points to the IP address of your YunoHost instance. If you choose a domain name ending with .nohost.me or .noho.st, the DNS configuration step is automatically done and you'll only have to wait 3 minutes at the end of the post-installation. If you opt for another domain name, you must previously have purchased and configured it to point to your IP address.

2. Administrator Password: This is the password that will allow you to manage your YunoHost instance, **choose it carefully**, it must not be disclosed or be guessable, otherwise you can lose your system.

The post-install process will then be automatic and you will have access to the administration interface via **https://votre-domaine.org/ynhadmin**
