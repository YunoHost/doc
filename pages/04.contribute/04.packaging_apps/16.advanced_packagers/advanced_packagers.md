---
title: Advanced packagers
template: docs
taxonomy:
    category: docs
routes:
  default: '/advanced_packagers'
---

Here comes the time:
- you know all the [YEPs](/packaging_apps_guidelines)
- you masterise [apps packaging](/packaging_apps), [package_check](https://github.com/YunoHost/package_check), [example_ynh](https://github.com/YunoHost/example_ynh) and [experimental helpers](https://github.com/YunoHost-Apps/Experimental_helpers)
- you have integrated the [YunoHost Apps Group](https://yunohost.org/#/project_organization)
- you know what means `¯\_(ツ)_/¯`
- you use to say `Don't ask to ask, just ask` in the [YunoHost support room](https://yunohost.org/#/help)

Here are few ideas that could help you to improve YunoHost apps packaging.

Usually, there are things that slow you down:
- Installing your freshly done package because of dependencies installation or npm/rust/elixir/composer builds
- Waiting a package_check to see the level of your package
- etc...

The idea is to use YunoHost stuffs to help you improve this lost time.

## Building your infrastructure
First idea is to build several VMs, LXCs or VirtualBoxs with YunoHost to let you parallelize actions, like having the first one installing an app, the second installing another app, the third one debugging an app upgrade, etc...

After first installation of those VMs/LXCs, each one has to be reacheable with its domain name, like for example:
- ynh1.mydomain.org
- ynh2.mydomain.org
- ynh3.mydomain.org

For that you will need a public IP for each one or reverse proxy... 
If your are lucky enough to have IPV6 and a /64 IPV6 scope, it won't be a problem to assign a public IPV6 to each YunoHost.

Another way the DNS stuff is to simply use an hosts file.

In addition, it's helpfull to have several domains names for each YunoHost, for example:
- ynh1.mydomain.org
  - test11.mydomain.org
  - test12.mydomain.org
  - test13.mydomain.org
- ynh2.mydomain.org
  - test21.mydomain.org
  - test22.mydomain.org
  - test23.mydomain.org
- ynh3.mydomain.org
  - test31.mydomain.org
  - test32.mydomain.org
  - test33.mydomain.org

With that you will be able to install two apps on the same YunoHost first one at https://test11.mydomain.org and a second app at https://test12.mydomain.org (let say the first app is nextcloud_ynh the second one is collabora_ynh or onlyoffice_ynh)

When your infrastructure is up and ready, you will have to do snapshots of each VMs/LXCs. Doing that, you will be able to revert back to an happy and healthy YunoHost after doing install/backup/restore/upgrade of and app...

Don't forget to regularly upgrade your YunoHosts VMs/LXCs to the last release doing: revert back to last happy/healthy YunoHost snapshot and doing `yunohost domain cert-renew --no-check && yunohost tools update && yunohost tools upgrade --apps && yunohost tools upgrade --system && apt autoremove`. Take a snapshot after that successfull full upgrade. And after some testings or one week later, remove old snapshot. PS: that can be automated...

Example of a script to upgrade a master VirtualBox VM

```
#!/bin/bash

# printers
normal="\e[0m"
bold="\e[1m"
white="\e[97m"
blue="\e[34m"
echo_info()
{
	echo -e "[${bold}${blue}INFO${normal}] ${bold}${white}$1${normal}"
}

echo_info "### Update host"
sudo apt update
sudo apt dist-upgrade

sudo yunohost settings set security.password.user.strength -v -1
sudo yunohost settings set security.password.admin.strength -v -1

echo_info "### Update package_check"
( cd package_check; git pull)
echo_info "### Update LXC container"
package_check/sub_scripts/lxc_upgrade.sh

echo_info "### Clean hosts"
sudo apt autoclean
sudo apt autoremove

echo_info "### Fill free space with zero"
cat /dev/zero > zeros ; sync ; rm zeros

echo_info "### Run 'VBoxManage modifyhd --compact file.vdi' to reduce the size of this VM"
```

Example of a script to customize a cloned VM

```
#!/bin/bash

master_domain=domain1.fr
domainX=domain2.fr
master_ip=70
ipX=68


sudo yunohost --admin-password admin domain add $domainX
sudo yunohost --admin-password admin domain add sous.$domainX
sudo yunohost --admin-password admin tools maindomain -n $domainX
sudo yunohost --admin-password admin domain remove $master_domain
sudo yunohost --admin-password admin domain remove sous.$master_domain

sudo sed -i "s/address 192.168.1.$master_ip/address 192.168.1.${ipX}/" /etc/network/interfaces

sudo reboot
```

Doing that you will have all the time a full/ready to go YunoHosts infrastructure for advanced packagers. And if require, you can have some VMs/LXCs runnning the YunoHost testing or YunoHost next Debian main version.

## Having your packages/commits available in each VMs/LXCs
There are several ways to have your freshly created package available from each VMs/LXCs
1- Do an ssh from the YunoHost VM/LXC to a central repository on your computer
2- Having a shared directory available from each VMs, LXCs VirtualBoxs
3- Rsync you central repository to each VM/LXC
4- Use [syncthing](https://github.com/YunoHost-Apps/syncthing_ynh) to syncrhonise you main repository on each VM/LXC

Example of a script to mount as shared directory a packaging directory into a VirtualBox VM

```
#!/bin/bash

shared_folder=my_directory

# printers
normal="\e[0m"
bold="\e[1m"
white="\e[97m"
blue="\e[34m"
echo_info()
{
	echo -e "[${bold}${blue}INFO${normal}] ${bold}${white}$1${normal}"
}

# Create the main directory for the mount
sudo mkdir -p "./$shared_folder"

# Mount ynh-dev directory from the host
echo_info "Mount shared directory $shared_folder"
sudo mount -o defaults -t vboxsf $shared_folder "./$shared_folder"
```

## Shortcuts
Use and abuse of `yunohost app install` `--args` argument

You can do ugly thing considering mynewapp is the name/REPLACEBYYOURAPP of your app

To install your mynewapp app:

```bash
YNHAPP=mynewapp
yunohost app install /mycentralrepo/${YNHAPP}_ynh/ --debug --force --args domain=test11.mydomain.org&path=/myapp&admin=alice&is_public=true&language=en&password=awesomepassword
```

To remove your mynewapp app and reinstall it

```bash
YNHAPP=mynewapp 
yunohost app remove ${YNHAPP} --debug && yunohost app install /mycentralrepo/${YNHAPP}_ynh/ --debug --force --args domain=test11.mydomain.org&path=/myapp&admin=alice&is_public=true&language=en&password=awesomepassword
```

To backup your mynewapp app

```bash
YNHAPP=mynewapp 
yunohost backup create --apps ${YNHAPP} --debug
```

To restore your mynewapp app from the backup just made

```bash
YNHAPP=mynewapp 
yunohost backup restore XXXXXXXX-XXXXXX --apps ${YNHAPP} --debug
```

To upgrade your mynewapp

```bash
YNHAPP=mynewapp 
yunohost app upgrade ${YNHAPP} -f /mycentralrepo/${YNHAPP}_ynh/ --debug


```

With that, you will be able to launch different actions on differents YunoHost VMs/LXCs

## Package_check

With advanced packaging comes [CI_package_check](https://github.com/YunoHost/CI_package_check), it lets you serialize and automate package_check.

## Managing all the parallel packaging you are working on

When you do several things at the same time, sometimes you don't remember what is the next step for this or that app.
A good tool to keep your TODO list organized is to use a kaban like apps:
- [kanboard](https://github.com/YunoHost-Apps/kanboard_ynh)
- [wekan](https://github.com/YunoHost-Apps/wekan_ynh)
