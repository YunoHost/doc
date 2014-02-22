# Installing YunoHost on CubieBoard

### Requirements
* CubieBoard & µ-SD of at least 4GB
* Internet access
* Access to server administration

### Images for Debian 7 Wheezy adapted for CubieBoard 1 and 2:

* [Cubian](http://cubian.org/)
* [Cubieez](http://www.cubieforums.com/index.php?topic=442.0)

### Copy the Image to the µ-SD
#### via the graphical interface (recommended)
With the "Disks" application in Debian and its derivatives, select the µ-SD and choose "Restore Disk Image".

#### via the command line
Get the device name of the µ-SD (/dev/...) with :
```bash
df -h
```
Write the image to disk from the folder you downloaded it to:
```bash
(sudo) dd if=/image/debian/ of=/dev/<µ-SD> bs=1M && sync
```
### Expand the Partition
Expand the Partition using GParted.

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
### Installing YunoHost

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

Once the installation is complete, the script will ask you to proceed to the post-install configuration. This will ask you for a few options:

1. **Domain name**: You must choose a domain name that will point at the IP address of your YunoHost instance. If you choose a name that ends with **.nohost.me** or **.noho.st**, the DNS configuration stage will be completed automatically and you will only need to wait for about 3 minutes for the installation to complete. If you opt for another domain name, you will need to have one purchased and [configured](/dns) so it points at your **IP address**.

2. **Administrator password**: This is the password that you will need to administer your YunoHost instance, **choose it carefully**, it should not be given out or easily guessed, or else you might lose control of your system.

The post-install configuration will take place after this, and you will be able to access your administration interface with **https://your-domain.org/ynhadmin**

### Updating YunoHost
```bash
apt-get update && apt-get upgrade && apt-get dist-upgrade
```
### Opening Ports
uPnP doesn't work just yet, so you will need to manually open the ports on your firewall or router.

To see the ports that need to be opened:

```bash
yunohost firewall list
```
