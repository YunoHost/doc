# Vagrant and YunoHost

*Here is a small memo-documentation page on how to test/develop YunoHost with Vagrant.*

*Find other ways to install YunoHost **[here](/install)**.*

<img src="https://yunohost.org/images/vagrant.png" width=250>

**Prérequis** : An x86 computer with VirtualBox installed and enough RAM capacity to be able to run a small virtual machine.

---

## Initialisation

Create a project folder
```bash
mkdir YunoHost
cd YunoHost
```

The following command will initialize the project with a Debian Wheezy base image
```bash
vagrant init chef/debian-7.4
```

Uncomment (remove the leading #) the following line in the newly created Vagrantfile to get access from the host system
```
  config.vm.network "private_network", ip: "192.168.33.10"
```

Clone the Yunohost install script repository
```bash
git clone https://github.com/YunoHost/install_script
```

---

## Installation

Start the virtual machine
```bash
vagrant up
```

Connecter to the started virtual machine
```bash
vagrant ssh
```

The root user must have a password
```bash
sudo passwd
```

Upgrade the system
```bash
sudo apt-get update && sudo apt-get upgrade
```

Execute the installation script
```bash
cd /vagrant/install_script && sudo ./install_yunohostv2
```

<br>

<p class="text-center">
<img src="https://yunohost.org/images/install_script.png">
</p>

---

*Once the installation is finished, you may want to proceed to post-installation: **[yunohost.org/postinstall](/postinstall)** *
