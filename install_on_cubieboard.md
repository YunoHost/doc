# Install YunoHost on CubieBoard

*Find other ways to install YunoHost **[here](/install)**.*

### Requirements
* CubieBoard & µ-SD of at least 4GB
* Internet access
* Access to server administration
* A Cubieboard Debian 7 image compatible with YunoHost:
    * [Cubian](http://cubian.org/)
    * [Cubieez](http://www.cubieforums.com/index.php?topic=442.0)

## Copy the image to your µ-SD card

#### On Windows
* Download and install **[Win32 Disk Imager](http://sourceforge.net/projects/win32diskimager/)**
* Plug your µ-SD card in
* Copy the `CubieBoard_image.img` file to your µ-SD card using Win32 Disk Imager.

#### On GNU/Linux, BSD or Mac OS X
* Open a terminal
* Plug your µ-SD card in
* Identify the device name by typing:

```bash
sudo fdisk -l
```

It should be `/dev/diskN`, where `N` is a number, or `/dev/sdX`, where `X` is a letter.

* Copy the image by typing:

```bash
sudo dd bs=1M if=/path/to/your/CubieBoard_image.img of=/your/device/name
```

Do not forget to change `/path/to/your/CubieBoard_image.img` and `/your/device/name` with the appropriate values.

The command may take a few minutes.

You can also expand the partition using GParted.

---

### Start
Put the µ-SD in the CubieBoard and start it up.

### Get the local IP address of your CubieBoard
```bash
nmap 192.168.0.0/24 or nmap 192.168.1.0/24
```

### Redirect your domain name to the local IP address of the CubieBoard
Edit /etc/hosts on your local computer:
```bash
(sudo) nano /etc/hosts
```
Add a line in the following format:
```bash
ip_address_of_cubieboard      your_domain.org
```

### SSH connection
```bash
ssh root@votre_domaine.org
```

### Install YunoHost

1. Install git
```bash
apt-get install git
```

2. Clone the installation script repository
```bash
git clone https://github.com/YunoHost/install_script /tmp/install_script
```

3. Execute the script
```bash
cd /tmp/install_script && ./install_yunohostv2
```

### Post-installation

Once the installation is complete, the script will ask you to proceed to the post-install configuration. You will have to enter a **domain name** and the **administration password**.

More information here: [yunohost.org/postinstall](/postinstall)

## System upgrade

It is **wisely recommended** to execute a full system upgrade as soon as possible. To do so, you have to go to the administration interface by entering its URL in a web browser: `https://<your_domain.org>/yunohost/admin`, then click on "**Tools**" and "**System upgrade**".

The operation may take a few minutes, then confirm the package upgrade and wait a few more minutes.

---

#### *If you need help during one of these steps, do not hesitate to use [our support tools](/support).* 
