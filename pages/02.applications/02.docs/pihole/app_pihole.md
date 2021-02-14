---
title: Pi-hole
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_pihole'
---

![Pi-hole's logo](image://pihole_logo.png?width=80)

[![Install Pi-hole with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=pihole) [![Integration level](https://dash.yunohost.org/integration/pihole.svg)](https://dash.yunohost.org/appci/app/pihole)

### Index

- [Using Pi-Hole as a DHCP server](#using-pi-hole-as-a-dhcp-server)
  - [Configure Pi-Hole](#configure-pi-hole)
  - [Configure my router](#configure-my-router)
  - [Restore Network](#restore-network)
- [Useful links](#useful-links)

Pi-hole is a network-level ad blocker that acts as a DNS layer and possibly a DHCP3 server for use on a private network. It is designed to be installed on embedded devices with network capabilities, such as the Raspberry Pi, but can be used on other machines running GNU/Linux or in virtualised environments.

## Using Pi-Hole as a DHCP server

> **Warning, you should be aware that touching your DHCP could break your network.
In case your server is inaccessible, you will lose your dns resolution and IP address.
Thus, you would lose any connection to the internet and even the connection to your router.**

> If you encounter this kind of problem, please read the section "How to restore my network".

### Configure Pi-Hole

There are 2 ways to configure Pi-hole to be used as your DHCP server.
- Either you can choose to use it when you install the application.
- Or you can activate the DHCP server afterwards in the "Settings" tab, part "Pi-hole DHCP Server".
In this second case, it may be preferable to force the server IP to a static address.

### Configure my router

Your router or your ISP's router has a DHCP server enabled by default.
If you keep this DHCP, along with Pi-hole's, you will have transparent conflicts between them.
The first DHCP server to respond will distribute its own IP and settings.
So you need to turn off your router's DHCP server and let Pi-hole manage your network.

#### Why should I use Pi-hole's DHCP?

By using Pi-hole's DHCP, you allow Pi-hole to give its dns configuration to each of your clients. This way, every request will be filtered by Pi-hole.

Another case of using Pi-hole DHCP is if you have hairpinning problems (you can't connect to your server because its IP is your public IP, and your router doesn't allow this).
In this case, using Pi-hole's dns will allow you to connect to your server by its local address rather than its public address.

### Restore network

> Oops!
Your Pi-hole server has crashed, and you don't have DHCP anymore.
Don't panic. We'll get through this.

Use your favorite device on your desktop computer.
And first, get your network interface (usually `eth0`).
```bash
sudo ifconfig
```

Then change your IP to a static one.
```bash
sudo ifconfig eth0 192.168.1.100
```

Now you can connect to your router and reboot its DHCP server to use it again.
You can now remove your static IP and get a dynamic IP again.
```bash
sudo ifconfig eth0 0.0.0 && sudo dhclient eth0
```

> Remember to turn off your router's DHCP if your server is running again.

## Useful links

+ Website: [pi-hole.net](https://pi-hole.net)
+ Official documentation: [docs.pi-hole.net](https://docs.pi-hole.net/)
+ Application software repository: [github.com - YunoHost-Apps/pihole](https://github.com/YunoHost-Apps/pihole_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/pihole/issues](https://github.com/YunoHost-Apps/pihole_ynh/issues)
