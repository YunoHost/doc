# DNS with a dynamic IP

<div class="alert alert-warning">Before going further, make sure your global IP address is dynamic with: [ip.yunohost.org](http://ip.yunohost.org/). The global IP address of your box changes almost every day.</div>

This tutorial aim to get around dynamic IP issue which is: when the IP public address of your (Internet Service Provider-) box changes, the DNS zone is not updated to point towards the new IP address, and consequently your server is no more reachable via its domain name. After setting up the solution proposed in this tutorial, the redirection from your domain name to the actual IP address of your server will not be lost anymore.

The method proposed here consists of automatizing the fact the box annonces its global IP adress change to the dynamic DNS, so that the DNS zone will automatically be updated.

If you own a domain name at **OVH**, you may go to step 4 and follow this [tutorial](OVH_fr), given that OVH proposes a DynDNS service.

#### 1. Create an account to a Dynamic DNS service
Here are sites which offer a DynDNS service free of charge:
* [DNSexit](https://www.dnsexit.com/Direct.sv?cmd=dynDns)
* [No-IP](https://www.noip.com/remote-access)
* [ChangeIP](https://changeip.com)
* [DynDNS (in italian)](https://dyndns.it)
* [DynDNS with your own domain](https://github.com/jodumont/DynDNS-with-HE.NET)
* [Duck DNS](https://www.duckdns.org/)

Register to one of them. It should provide you with one (or more) IP address to reach the service, and a login (that you may be able to self-define).

#### 2. Move the DNS zones
Copy the [DNS zones](dns_config), except for the NS fields, from the [registrar](registrar_en) where you bought your domain name from to the dynamic DNS service you registrer at in step 1.

#### 3. Switch the management of your domain name to the dynamic DNS server
This step consists in declaring to your [registrar](registrar_en) that the DNS service will now be managed by the DynDNS service provider. 

For this, fisrt declare in the NS field(s) the IP address provided by the DynDNS service.

Then, remove any other item in the [DNS zones](dns_config) (except the previous NS fields), from the [registrar](registrar_en).

#### 4. Configure the client
This client could be your ISP-box, or a package installed on your server, such as `ddclient`.
Here, we will use the client provided by the box, which is the more easy way.

Enter the login of the dynamic DNS and its public IP address in your box (interface details may vary by ISP).

<img src="/images/dns_dynamic-ip_box_conf.png" width=600>

You're good to go !
