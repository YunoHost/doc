---
title: Advantages of a VPN for self-hosting
template: docs
taxonomy:
    category: docs
routes:
  default: '/vpn_advantage'
---

Since setting up a server at home is an uncommon practice, most Internet connections provided to individuals are unsuitable for this purpose. A net neutral VPN providing a static IPv4 address and IPv6 addresses can help to circumvent some limitations or difficulties.

! **Beware**: not all existing VPN providers meet these conditions, make sure the one you choose meets them.

## Advantages

### Plug & Play

By setting up a VPN on your server, you'll be able to make it accessible to the rest of the Internet without having to change the configuration of the router you connect it to. This can be really handy if you are going on vacation, moving or have an Internet disconnection, as you will be able to easily connect it to someone you trust without having to configure the router of the person who is helping you.

In the same way, you save yourself the trouble of opening your router's ports and bypassing hairpinning.

### No micro DNS outages

If your Internet connection does not have a fixed public IP, you will be forced to set up a dynamic domain name (Dynamic DNS). This solution may be acceptable, but the DNS will only be updated at regular intervals (every two minutes if it is a `noho.st` or `nohost.me` domain name). So there is a chance that this will cause some display errors in the browser from time to time, or even that another site will be displayed (the risks are however reduced because the practice of self-hosting is not widespread).

With a neutral VPN, this problem is circumvented because the VPN can be compared to a Virtual Internet connection, which has its own fixed IPv4 address, so no need to update the domain name.

### The case of email

Email is one of the most complex protocols to self-host, usually it is what a user self-hosts last. Indeed, it is very easy to find yourself in a situation where emails sent by the server are refused by the recipient SMTP servers.

To avoid this you need to:

- configure the reverse DNS of the server's Internet connection (or VPN)
- a fixed IPv4
- that this IPv4 is removable from all blacklists (notably the IP must not be on the DUL)
- to be able to open port 25 (as well as the other SMTP ports)

Unfortunately, none of the most common French ISPs respect all these points.

To overcome this, the use of a VPN respecting these points can be an alternative.

### Trust

Finally, if you do not want the content of your server's communications to be spied on by equipment present on your ISP's network, you can use a VPN to encrypt your communications and deport your trust to a VPN provider. Remember, since 2015, the government officially deploys black boxes at the large network operators whose objective is to tap all French digital communications to preserve the scientific, economic and industrial interests of France.

## Disadvantages

### Cost

A neutral VPN has a cost since the operator who provides it must run a server and use bandwidth. The prices of the FFDN's associative VPNs are around 6 € per month.

### Packet path

When you set up a VPN on your server, if you don't set up any particular configuration, the transfer of a file from a computer on the local network to the server using the VPN, will go through the end of the VPN i.e. through the server of the VPN provider.

To solve this problem, there are two solutions:

- transform the server into a router and connect the home equipments to it, these equipments will then benefit from the VPN confidentiality too.
- use the YunoHost server as a DNS resolver when you are at home, in order to redirect the server's domain names to the local IP rather than the public IP. This operation can be done either on each equipment or on the router (if the latter allows it).
