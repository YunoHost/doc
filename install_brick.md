# Introduction
Installation instructions for the "brique" written in live during the General Meeting "FFDN" of 2015. To be completed.

## VPN reservation

This step is specific to your internet provider. Get the required certificates and/or password for VPN connection to the client, as well as specific OpenVPN directives if necessary.

For example, Neutrinet needs the `topology subnet` directive (for Windows compatibility \o/)

## Download ISO

Go to http://repo.labriqueinter.net/ 
(get latest http://repo.labriqueinter.net/labriqueinternet_latest.img.tar.gz)

Save ISO to to SD card using `dd`:

```bash
sudo dd if=labriqueinternet_latest.img of=/dev/sdX
```

Insert SD card into the box, plug in ethernet cable (to connect to local network) and turn it on.

## Post-configuration
Connect to `yunohost.local` or through SSH, using the IP adress and update packages.

*  user : root
*  password : olinux

```bash
apt-get update && apt-get dist-upgrade
```

Then connect using https and accept the self signed certificate. Then follow instructions and proceed to [postinstall](/postinstall).

* Choose domain name
* Choose administrator password

You will be redirected to the admin panel, where you will be able to add your first user.

Then, you can install applications using "applications -> install" or fill the bottom field with a Github repository URL:

* [HotSpot](https://github.com/labriqueinternet/hotspot_ynh)
* [VPNCient](https://github.com/labriqueinternet/vpnclient_ynh)
* [TorClient](https://github.com/labriqueinternet/torclient_ynh)
* [PirateBox](https://github.com/labriqueinternet/piratebox_ynh)


Go to `http://monurl.com/vpnadmin` (or the custom value you picked):

(neutrinet) Fill with `vpn.neutrinet.be`
copy/paste the generated vpn conf into "advanced" section
(Note that IPv6 script isn't ready yet so don't try to configure it... If you're wreckless, you can get it at https://vpn.neutrinet.be:8000)

```bash
scp auth client.crt client.key ca.crt dans /etc/openvpn/
```