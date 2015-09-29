# Vagrant and YunoHost

*Here is a small memo-documentation page on how to test/develop YunoHost with Vagrant.*

*Find other ways to install YunoHost **[here](/install)**.*

<img src="https://yunohost.org/images/vagrant.png" width=250>

**Prerequisite**: an x86 computer with VirtualBox installed and enough RAM capacity to be able to run a small virtual machine.

---

## Initialization

Create a project folder
```bash
mkdir YunoHost
cd YunoHost
```

The following command will initialize the project with a Yunohost image based on Debian Jeesie
```bash
vagrant init yunohost/stable8
```
<blockquote>
<span class="text-warning">/!\</span> You must have a working image call `yunohost/stable8`. If not, just do 
`vagrant box add yunohost/stable8 https://atlas.hashicorp.com/yunohost/boxes/stable8/versions/1.0.0/providers/virtualbox.box`
</blockquote>

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
sudo apt-get update && sudo apt-get upgrade
```

You can access to your vm with the ip 192.168.33.80

---

*Once the installation is finished, you may want to proceed to post-installation: **[yunohost.org/postinstall](/postinstall)** *


## Boxes with wheezy or testing/unstable repository

If you need a vm to test something with wheezy or testing/unstable version of Yunohost. There is a Vagrantfile and 5 other boxes in preparation. For the moment, you can build the boxes by following instructions on these repo: https://github.com/zamentur/yunohost-vagrant

| Box | IP | 
| --- | --- | 
| stable8 | 192.168.33.80 |
| testing8 | 192.168.33.81 |
| unstable8 | 192.168.33.82 |
| stable7 | 192.168.33.70 |
| testing7 | 192.168.33.71 |
| unstable7 | 192.168.33.72 |

The IP addresses related to the boxes are set by default but can be changed in the network settings. 