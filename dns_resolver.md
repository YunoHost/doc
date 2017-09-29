# YunoHost DNS Resolver

+<div class="alert alert-danger">This page is deprecated / obsolete. Information it contains should be updated (or should be removed).</div>

### Presentation
YunoHost provide a DNS service for DNS name resolution. Usually, your server is not configured to use it, it's your ISP DNS. For instance, for the Free ISP with Freebox router the DNS resolver IP is `192.168.0.254`.

How to known: watch the file `/etc/resolv.conf`. This file is not modifiable because it is rewriten by the DHCP service. A DHCP client is configured, it requests the router to get DNS resolver IPs. 
This IPs is provided by your ISP.

### Configuration
To use YunoHost DNS resolver of your server, modify your DHCP configuration client: remove DNS name server request, and add static IP of your server `127.0.0.1`.

Edit the file `/etc/dhcp/dhclient.conf`, add the line `supersede` and remove in the line `request` the word `domain-name-servers`:
```bash
supersede domain-name-servers 127.0.0.1, 192.168.0.254;
request subnet-mask, broadcast-address, time-offset, routers,
        domain-name, domain-search, host-name,
        dhcp6.name-servers, dhcp6.domain-search,
        netbios-name-servers, netbios-scope, interface-mtu,
        rfc3442-classless-static-routes, ntp-servers;
```
Apply this modification by rebooting the DNS server:

```bash
service dnsmasq restart
```

(TODO: It's possible to restart a service to take into account the modification -DHCP?-, but didn't work for me).
It's possible to do same modification in all machine in local network by replacing *127.0.0.1* by IP server.
