# DNS with a dynamic IP

<div class="alert alert-warning">Before going further, make sure your global IP address is dynamic with: [ip.yunohost.org](http://ip.yunohost.org/). The global IP address of your box change almost every days.</div>

This tutorial aim to get around dynamic IP issue who's nest: when the IP address public of the box change, the DNS zone is not update to point towards the new IP address.

After put in place the solution proposed in this tutorial, the redirection from your domain name to the real IP address will not be loose anymore.

The method which will be put in place consist to make automatic the fact the box annonce to the dynamic DNS it has change global IP address, and then the DNS zone will automatically be changed.

If you own a domain name at **OVH**, you could go to step 4 and follow this [tutorial](OVH_fr) because OVH propose a DynDNS service.

#### 1. Create an account to a Dynamic DNS service
Here is sites which offer a DynDNS service free of charge:
* [DNSexit](https://www.dnsexit.com/Direct.sv?cmd=dynDns)
* [No-IP](https://www.noip.com/remote-access)
* [ChangeIP](https://changeip.com)
* [DynDNS (in italian)](https://dyndns.it)
* [DynDNS with your own domain](https://github.com/jodumont/DynDNS-with-HE.NET)

Register to one of them.

#### 2. Move the DNS zones
Move the [DNS zones](dns_config), excepted the NS fields, from the [registrar](registrar_en) where you bought your domain name to the dynamic DNS service you registrer at step 1.

#### 3. Toggle management of your domain name to the dynamic DNS server
This step consist to say to the [registrar](registrar_en) that DNS service will be manage by the DynDNS service.
Redirect NS field to the IP address gived by the DynDNS service.

Then, remove [DNS zones](dns_config), excepted NS fields, from the [registrar](registrar_en).

#### 4. Create a Dynamic DNS login
On the dynamic DNS service create a login that you will enter on a dynamic DNS client.
This client could be your box or a package installed on your server as `ddclient`.
We gone use the client installed on the box which is more easy way.

#### 5. Configure the box
Put the login of the dynamic DNS and the [public IP address](http://ip.yunohost.org/) on your box.

<img src="/images/dns_dynamic-ip_box_conf.png" width=600>
