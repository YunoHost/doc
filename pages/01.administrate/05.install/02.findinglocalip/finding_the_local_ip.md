---
title: Finding your server's local IP
template: docs
taxonomy:
    category: docs
routes:
  default: '/finding_the_local_ip'
---

On an installation at home, your server should typically be accessible using the `yunohost.local` domain. If for any reason this does not work, you may need to find the *local* IP of your server.

## What is a local IP ?
The local IP is the address used to refer to your server inside the local network (typically your home) where multiple devices are connected to a router (your internet box). The local IP typically looks like `192.168.x.y` (or sometimes `10.0.x.y` or `172.16.x.y`)

## How to find it ?
Any of these tricks should allow you to find the local IP of your server:
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="(Recommended) With AngryIP"]

You can use the [AngryIP](https://angryip.org/download/) software to achieve that. You just need to scan these local ip ranges in this order until you find the active IP corresponding to your server:
- `192.168.0.0` -> `192.168.0.255`
- `192.168.1.0` -> `192.168.1.255`
- `192.168.2.0` -> `192.168.255.255`
- `10.0.0.0` -> `10.0.255.255`
- `172.16.0.0` -> `172.31.255.255`

!!! **Tips**:
!!! - you can order by ping like on this screenshot to easily see effectively-used IP.
!!! - your server should typically be displayed as listening on port 80 and 443
!!! - in case of doubt, just type `https://192.168.x.y` in your browser to check if it's a Yunohost or not.

![](image://angryip.png?class=inline)

[/ui-tab]
[ui-tab title="With your internet router / box"]
Connect to your internet box / router interface to list the machines connected.
[/ui-tab]
[ui-tab title="With arp-scan"]
If you're using Linux, you can open a terminal and use `sudo arp-scan --local` to list the IP on your local network (this may also work in Windows);

If the `arp-scan` command displays a confusing number of devices, you can check which ones are open to SSH with `nmap -p 22 192.168.1.0/24` to sort them out (adapt the IP range to your local network)
[/ui-tab]
[ui-tab title="With a direct access on the server"]
Plug a screen on your server, log in and type `hostname --all-ip-address`.

The default credentials (before post-installation!) to log in are:
- login: root
- password: yunohost

(If you are using a raw Armbian image instead of the pre-installed Yunohost image, the credentials are root / 1234)

[/ui-tab]
[/ui-tabs]

## I still can't find my local IP

If you are unable to find your server using any of the previous tricks, maybe your server did not boot correctly:

- Make sure that your server is properly plugged in;
- If you're using an SD card, make sure the connector is not too dusty;
- Plug a screen on your server and try to reboot to check that it's properly booting;
- Make sure that your ethernet cable is working and properly plugged in;
