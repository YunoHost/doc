# Installation guide for Debian

You have two ways to install Yunohost :

1. [From an USB key or a CD-ROM](#/install)
2. With the install script on an existing Debian (bellow guide)

### Pre-requisite
A box, a VPS, or a dedicated server :

* with Debian 7 (Wheezy, Raspbian, Cubian, etc.) installed
* Connected to Internet
* root access ou sudoer via SSH

### Installation

1. Connect to your debian system trought ssh
```bash
ssh root@monserveur.org
```

2. Install git
```bash
apt-get install git
```

3. Clone the Yonuhost install script repository
```bash
git clone https://github.com/YunoHost/install_script /tmp/install_script
```

4. Execute the install script
```bash
cd /tmp/install_script && ./install_yunohostv2
```

### Post-install

Once the install finished, the script will ask you two parameters to procede the post-install :

1. **domain name** : Please choose the domain name wich will point to your Yunohost IP. You can choose to use a subdomain of **nohost.me** or **noho.st**, in that case the DNS configuration will be automatic, you will just have to wait three minutes to the end of the post-install. Or you can use your own [well configured domain name](#/dns)

2. **administrator password** : this is the password to administer you yunohost instance, **choose it strong** and don't share it, without it you can loose your system.

after the post-install script you will be able to access to your administration [web interface](#/admin) **https://your-domain.org/ynhadmin** or to amdinister your yunohost via the command-line interface called "[moulinette](#/moulinette)".
