# Installation guide on Debian

You have two ways to install Yunohost:

1. [From a USB key or a CD-ROM](/install)
2. With the install script on an existing Debian system (guide below)

### Pre-requisite
A box, a VPS, or a dedicated server:

* with Debian 7 (Wheezy, Raspbian, Cubian, etc.) installed
* connected to the Internet
* with root access or sudoer via SSH

### Installation

1. Connect to your Debian system through ssh
```bash
ssh root@monserveur.org
```

2. Install git
```bash
apt-get install git
```

3. Clone the Yunohost install script repository
```bash
git clone https://github.com/YunoHost/install_script /tmp/install_script
```

4. Execute the installation script
```bash
cd /tmp/install_script && ./install_yunohostv2
```

### Post-install

Once the installation is finished, the script will ask you for two options to complete the installation:

1. **domain name**: Please choose the domain name which will point to your Yunohost IP. You can choose to use a subdomain of **nohost.me** or **noho.st**, in that case the DNS configuration will be automatic, you will just have to wait three minutes to the end of the post-install. Or you can use your own [properly configured domain name](/dns)

2. **administrator password**: this is the password to administer your Yunohost instance, **make it strong** and don't share it, without it you can lose access to your system.

After the installation is complete, you will be able to access your administration [web interface](/admin) **https://your-domain.org/ynhadmin**, or to administer your Yunohost via the command-line interface called "[moulinette](/moulinette)".
