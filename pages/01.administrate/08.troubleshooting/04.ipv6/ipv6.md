---
title: Setting up IPv6
template: docs
taxonomy:
    category: docs
routes:
  default: '/ipv6'
---

IPv6 may work out of the box in many cases. But in some cases or some specific provider, you may need to tweak things manually to enable IPv6.

## With a VPS from OVH

OVH give one IPv4 address and one IPv6 address for VPS but by default, only IPv4 is OK.
The OVH's documentation is here : https://docs.ovh.com/gb/en/vps/configuring-ipv6/

### Configure the DNS server

Here : https://yunohost.org/#/dns_subdomains

### Configure the server

On the OVH panel, you will copy 3 element :
- the IPv6 address
- the IPv6 gateway address
- the IPv6 prefix. On OVH's VPS SSD, prefixes are `/128` because you have only *one* IPv6 address.

On your VPS, create a backup of the network configuration with : `cp /etc/network/interfaces ~/interfaces` in home directory.
Then, you can edit the configuration file (`/etc/network/interfaces`) with the following. It is assumed that :

! In this example, it is assumed that your network interface is `eth0`. If it's different (check with `ip a`) you need to adapt the example below.

```plaintext
iface eth0 inet6 static
address <your IPv6 address>
netmask <your IPv6 prefix>
post-up /sbin/ip -6 route add <the IPv6 gateway> dev eth0
post-up /sbin/ip -6 route add default via <the IPv6 gateway> dev eth0
pre-down /sbin/ip -6 route del default via <the IPv6 gateway> dev eth0
pre-down /sbin/ip -6 route del <the IPv6 gateway> dev eth0
```

Now, save the file and restart the network service with : `service networking restart`. (TODO : ideally we should find a way to validate the content of the configuration, otherwise it could fuck up the network stack and get disconnected from the VPS ?)

Check your configuration with these commands :
- `ip a` to display network interfaces and addresses
- `hostname -I` to display the system IP addresses
- try to ping an IPv6 server (for example you can use `ping6 ip6.yunohost.org`)
- try to ping your server from your PC (assuming your PC has IPv6 enabled)

If it's ok, it's ok !
