# Configure port-forwarding

If you are self-hosting at home and without a VPN, you need to forward ports on your home router ("Internet box"). If you want a short explanation on what is and why you need port forwarding, have a look in [this page](port_forwarding).

### 0. Diagnose ports opened

After configuring port forwarding, you should be able to validate with this small tool that your ports are correctly forwarded : 

<a class="btn btn-default" href="http://ports.yunohost.org">Check which ports are forwarded</a>

### 1. Access your box/router administration interface

Your box/router admin interface is usually reachable via http://192.168.0.1 or http://192.168.1.1. Then, you will probably need to authenticate yourself with your internet server provider's credentials.

### 2. Find the local IP of your server

Identify what is the local IP of your server, either :
- from your box/router interface, which might list devices connected
- from the YunoHost webadmin, in 'State of the server', 'Network'
- from the command line in your server, by running `ip a | grep "scope global" | awk '{print $2}'`

A local IP address typically looks like `192.168.xx.yy`, or `10.0.xx.yy`.

### 3. Forwarding ports

In your router admin interface, look for something like 'router configuration' or 'port forwarding'. The naming differs among the various kinds of boxes.

Opening the ports listed below is necessary for the various services available in YunoHost to work. For each of them, the 'TCP' forwarding is needed. Some interfaces refer to 'external' and 'internal' ports : these are the same in our case.

* Web: 80 <small>(HTTP)</small>, 443 <small>(HTTPS)</small>
* [SSH](/ssh_en): 22
* [XMPP](/XMPP_en): 5222 <small>(clients)</small>, 5269 <small>(servers)</small>
* [Email](/email_en): 25, 587 <small>(SMTP)</small>, 993 <small>(IMAP)</small>

If you use both a modem and a router, then you need to do the following:
1. first on the modem (the box closest to the internet) create rules to forward the above ports to your router;
2. then on the router (the box between the modem and your devices) create rules to forward the above ports to the static IP address for your server.

<div class="alert alert-warning" markdown="1">
<span class="glyphicon glyphicon-warning-sign"></span> Some internet service providers block port 25 (mail SMTP) by default to fight spam. Some other ISP don't allow to use port 80/443 (web) freely, though it's less likely. Depending on the ISP, it might be possible to open them in the admin interface... Check [this page](isp_en) for more info.
</div>

## Automatic port forwarding / UPnP

A technology called UPnP is available on some internet boxes / routers and allows to automatically forward ports by the machine who needs them. If UPnP is enabled in your local network, then running this command should automatically open the port for you :

```bash
sudo yunohost firewall reload
```

