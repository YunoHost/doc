---
title: Setting up a development environment
template: docs
taxonomy:
    category: docs
routes:
  default: '/dev/ynh-dev'
---


!!! **Use [ynh-dev](https://github.com/YunoHost/ynh-dev)** to setup a development environment - locally in a virtual machine, or on a VPS. This will setup a working YunoHost instance, using directly the Git repositories (with symlinks). That way, you will be able to edit files, test your changes in real time, commit stuff and push/pull directly from your development environment.


## Introduction

`ynh-dev` is a CLI tool to manage your local development environment for YunoHost.

This allow you to develop on the various repositories of the YunoHost project.

In particular, it allows you to:

 * Create a directory with a clone of each repository of the YunoHost project
 * Replace Yunohost debian packages with symlinks to those git clones

Because there are many diverse constraints on the development of the Yunohost
project, there is no "official" one-size-fits-all development environment.
However, we do provide documentation for what developers are using now in
various circumstances.

Please keep this in mind when reviewing the following options with regard to
your capacities and resources when aiming to setup a development environment.

`yhn-dev` can be used for the following scenarios:

### Local Development Path

Yunohost can be developed on using a combination of the following technologies:

  * Git (any version is sufficient)
  * LXD (>= 2.x) (though only tested with 3.x for now)

Because LXC are containers, they are typically lightweight and quick to start and stop. 
But you may find the initial setup complex (in particular network configuration). 
LXD makes managing an LXC ecosystem much simpler.

This local development path allows to work without an internet connection,
but be aware that it will *not* allow you to easily test your email stack
or deal with deploying SSL certificates, for example, as your machine is
likely to not be exposed on the internet. A remote machine should be used
for these cases.

If choosing this path, please keep reading at the [local development
environment](#local-development-environment) section.

Alternatively, you may be able to setup a local environnement using Vagrant and
Virtualbox which is kinda more resource-hungry because it is fully virtualized, 
but might be more familiar and user-friendly if you already know your way around 
Virtualbox's UI.

  * Virtualbox (>= 6.x)
  * Vagrant (>= ?.?.?)
  * Vagrant-virtualbox (>= ?.?.?)

See the [Alternative: Only Virtualbox](#alternative-using-only-virtualbox)
section for more info.

### Remote Development Path

Yunohost can be deployed as a typical install on a remote VPS. You can then use
`ynh-dev` to configure a development environment on the server.

This method can potentially be faster than the local development environment
assuming you have familiarity with working on VPS machines, if you always have
internet connectivity when working, and if you're okay with paying a fee. It
is also a good option if the required system dependencies (LXD/LXC, Vagrant, 
Virtualbox, etc.) are not easily available to you on your distribution.

Please be aware that this method should **not** be used for a end-user facing
production environment.

If choosing this path, please keep reading at the [remote development
environment](#remote-development-environment) section.

## Local Development Environment

Here is the development flow:

1. Setup `ynh-dev` and the development environment
2. Manage YunoHost's development LXCs
3. Develop on your local host and testing in the container

### 1. Setup `ynh-dev` and the development environment

First you need to install the system dependencies.

`ynh-dev` essentially requires Git and the LXD/LXC ecosystem. Be careful that 
**LXD can conflict with other installed virtualization technologies such as 
libvirt or vanilla LXCs**, especially because they all require a daemon based 
on DNSmasq and therefore require to listen on port 53.

On a Debian-based system (regular Debian, Ubuntu, Mint ...), LXD can be
installed using `snapd`. On other systems like Archlinux, you will probably also
be able to install `snapd` using the system package manager (or even
`lxd` directly).

```bash
apt install git snapd
sudo snap install core
sudo snap install lxd

# Adding lxc/lxd to /usr/local/bin to make sure we can use them easily even
# with sudo for which the PATH is defined in /etc/sudoers and probably doesn't
# include /snap/bin
sudo ln -s /snap/bin/lxc /usr/local/bin/lxc
sudo ln -s /snap/bin/lxd /usr/local/bin/lxd
```

Then you shall initialize LXD which will ask you a bunch of question. Usually
answering the default (just pressing enter) to all questions is fine.

```bash
sudo lxd init
```

Pre-built images are centralized on `devbaseimgs.yunohost.org` and we'll download them from there to speed things up:

```bash
sudo lxc remote add yunohost https://devbaseimgs.yunohost.org --public
```

On Archlinux-based distributions (Arch, Manjaro, ...) it was found that it's needed
that LXC/LXD will throw some error about "newuidmap failed to write mapping / Failed
to set up id mapping" ... It can be [fixed with the following](https://discuss.linuxcontainers.org/t/solved-arch-linux-containers-only-run-when-security-privileged-true/4006/4) :

```
# N.B.: this is ONLY for Arch-based distros
$ echo "root:1000000:65536" > /etc/subuid
$ echo "root:1000000:65536" > /etc/subgid
```

Then, go into your favorite development folder and deploy `ynh-dev` with:

```bash
curl https://raw.githubusercontent.com/yunohost/ynh-dev/master/deploy.sh | bash
```

This will create a new `ynh-dev` folder with everything you need inside.

In particular, you shall notice that there are clones or the various git
repositories. In the next step, we shall start a LXC and 'link' those folders
between the host and the LXC.

### 2. Manage YunoHost's dev LXCs

When ran on the host, the `./ynh-dev` command allows you to manage YunoHost's dev LXCs.

Start your actual dev LXC using :

```bash
$ cd ynh-dev  # if not already done
$ ./ynh-dev start
```

This should automatically download from `devbaseimgs.yunohost.org` a pre-build ynh-dev LXC image running Yunohost unstable, and create a fresh container from it.

After starting the LXC, your terminal will automatically be attached to it. If you later disconnect from the LXC, you can go back in with `./ynh-dev attach`. Later, you might want to destroy the LXC. You can do so with `./ynh-dev destroy`.

### 3. Development and container testing

After SSH-ing inside the container, you should notice that the *directory* `/ynh-dev` is a shared folder with your host. In particular, it contains the various git clones `yunohost`, `yunohost-admin` and so on - as well as the `./ynh-dev` script itself.

Inside the container, `./ynh-dev` can be used to link the git clones living in the host to the code being ran inside the container.

For instance, after running:

```bash
$ ./ynh-dev use-git yunohost
```

The code of the git clone `'yunohost'` will be directly available inside the container. Which mean that running any `yunohost` command inside the container will use the code from the host... This allows to develop with any tool you want on your host, then test the changes in the container.

The `use-git` action can be used for any package among `yunohost`, `yunohost-admin`, `moulinette` and `ssowat` with similar consequences. You might want to run use-git several times depending on what you want to develop precisely.

***Note***: The `use-git` operation can't be reverted now. Do **not** do this in production.

### 4. Testing the web interface

You should be able to access the web interface via the IP address of the container. The IP can be known from inside the container using either from `ip a` or with `./ynh-dev ip`.

If you want to access to the interface using the domain name, you shall tweak your `/etc/hosts` and add a line such as:

```bash
111.222.333.444 yolo.test
```

Note that `./ynh-dev use-git yunohost-admin` has a particular behavior: it starts a `gulp` watcher that shall re-compile automatically any changes in the javascript code. Hence this particular `use-git` will keep running until you kill it after your work is done.

### Advanced: using snapshots

You can check `lxc snapshot --help` to learn how to manage lxc snapshots.

### Alternative: Using Only Virtualbox

A Vagrant and Virtualbox (without LXC) guide is provided on another branch of
this repository. This is a known working setup used by some developers. Please
see the ["virtualbox" branch](https://github.com/YunoHost/ynh-dev/tree/virtualbox#develop-on-your-local-machine)
for more.

### Troubleshooting
If you experiment network issues with your lxd during rebuild container steps. Probably your container are not able to get a local IP with DHCP.

It could be due to bridge conflict (for example if you have lxc installed too) or dnsmasq port already used.

This [ticket](https://github.com/YunoHost/issues/issues/1664) could help.

## Remote Development Environment

Here is the development flow:

1. Setup your VPS and install YunoHost
2. Setup `ynh-dev` and the development environment
3. Develop and test

### 1. Setup your VPS and install YunoHost

Setup a VPS somewhere (e.g. Scaleway, Digital Ocean, etc.) and install YunoHost following the [usual instructions](https://yunohost.org/#/install_manually).

Depending on what you want to achieve, you might want to run the postinstall right away - and/or setup a domain with an actually working DNS.

### 2. Setup `ynh-dev` and the development environment

Deploy a `ynh-dev` folder at the root of the filesystem with:

```
$ cd /
$ curl https://raw.githubusercontent.com/yunohost/ynh-dev/master/deploy.sh | bash
$ cd /ynh-dev
```

### 3. Develop and test

Inside the VPS, `./ynh-dev` can be used to link the git clones to actual the code being ran.

For instance, after running:

```bash
$ ./ynh-dev use-git yunohost
```

Any `yunohost` command will run from the code of the git clone.

The `use-git` action can be used for any package among `yunohost`, `yunohost-admin`, `moulinette` and `ssowat` with similar consequences.

## Further Resources

  * [yunohost.org/dev](https://yunohost.org/dev)
