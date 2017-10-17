# Vagrant and YunoHost

*If you need testing some code, you should using directly [ynh-dev](https://github.com/yunohost/ynh-dev)*

*Find other ways to install YunoHost **[here](/install)**.*

<img src="/images/vagrant.png" width=250>

**Prerequisite**: an x86 computer with VirtualBox installed and enough RAM capacity to be able to run a small virtual machine.

---

## Initialization

Create a project folder
```bash
mkdir YunoHost
cd YunoHost
```

The following command will initialize the project with a Yunohost image based on Debian Jessie
```bash
vagrant box add yunohost/jessie-stable https://build.yunohost.org/yunohost-jessie-stable.box --provider virtualbox
vagrant init yunohost/jessie-stable
```
<blockquote>
<span class="text-warning">/!\</span> If you prefer use the beta version : https://build.yunohost.org/yunohost-jessie-testing.box 
</blockquote>

You need to activate the network for the YunoHost instance.
```bash
sed -i 's/# config\.vm\.network "private_network"/config.vm.network "private_network"/' Vagrantfile```

---

## Run a vm

Start the virtual machine
```bash
vagrant up
```

Connect to the started virtual machine
```bash
vagrant ssh
```

Upgrade the system
```bash
sudo apt-get update && sudo apt-get dist-upgrade
```

You can access to your vm with the ip 192.168.33.10

The IP addresses related to the boxes are set by default but can be changed in the network settings. 

---

*Once the installation is finished, you may want to proceed to post-installation: **[yunohost.org/postinstall](/postinstall)** *



