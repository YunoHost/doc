---
title: Local network access to your server
template: docs
taxonomy:
  category: docs
routes:
  default: '/dns_local_network'
---

After completing your server installation, it is possible that your domain will not be accessible through the local network. This is an issue known as [hairpinning](http://en.wikipedia.org/wiki/Hairpinning) - a feature that is not well supported by some internet routers.

To solve this issue you can:
- configure your router's DNS
- or alternatively -  your /etc/hosts files on your clients workstation

### Find the local IP address of your server

First you need to find out the local IP of your server
- either using the tricks lister [here](/finding_the_local_ip)
- or if in the webadmin, in the Diagnosis section, under Internet Connectivity, IPv4, click on 'Details' and you should find an entry for 'Local IP'
- or using the command line on the server : `hostname -I`

## Configure DNS on your Internet router

The goal here is to create a network wide redirection handled by your router. The idea is to create a DNS redirection to your server's IP. You should access your router's configuration and look for DNS configuration, then add a redirection to your server's IP (e.g. redirect `yunohost.local` to `192.168.1.21`).

### SFR Box
If you haven't found your server private IP, you may find it using the SFR box admin panel:  
    Go to Network tab > General
<img src="/images/ip_serveur.png" width=800>

#### Configure SFR box's DNS

Go to Network tab > DNS and add your domain name to the box's DNS.
<img src="/images/dns_9box.png" width=800>

## Configure [hosts](https://en.wikipedia.org/wiki/Host_%28Unix%29) file on client workstation

Modifying hosts file should be done only if you cannot alter your box's DNS or router, because hosts file will only impact the workstation where the file was modified.

- Windows hosts file is located at:
    `%SystemRoot%\system32\drivers\etc\`
    > You MUST activate hidden and system file display to see the hosts file.
- UNIX systems (GNU/Linux, macOS) hosts file is located at:
    `/etc/hosts`
    > You MUST have root privileges to modify the file.

Add a line at the end of the file containing your server private IP followed by a space and your domain name

```bash
192.168.1.62	domain.tld
```
