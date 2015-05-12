# Configure and use DNS service in Yunohost server

## Description
Yunohost provide a DNS service for DNS name resolution. Usually, your server is not configured to use it, it's your ISP DNS. 
For example, for ISP Free with Freebox router the DNS resolver IP is 192.168.0.254. Howto known: see file /etc/resolv.conf.
This file is not modifiable because is rewriten by DHCP service. A DHCP Client is configured, it requests the router to get DNS resolver IPs. 
This IPs is provided by your ISP.

##Modification
To use Yunohost DNS resolver (your server), modify your DHCP configuration client: remove DNS name server request, and add static IP of your server *127.0.0.1*.
Edit file */etc/dhcp/dhclient.conf*, add line *supersede* and remove in line *request* the word *domain-name-servers*<br>
```
...
supersede domain-name-servers 127.0.0.1, 192.168.0.254;
request subnet-mask, broadcast-address, time-offset, routers,
        domain-name, domain-search, host-name,
        dhcp6.name-servers, dhcp6.domain-search,
        netbios-name-servers, netbios-scope, interface-mtu,
        rfc3442-classless-static-routes, ntp-servers;
...
```
Apply this modification by rebooting the server (TODO: It's ossible to restart a servcie to take into account the modification -DHCP?-, but didn't work for me)
It's possible to do same modification in all machine in local network by replacing *127.0.0.1* by IP server.

