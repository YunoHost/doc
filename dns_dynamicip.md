# DNS with a dynamic IP

This tutorial is here to help you get around dynamic IP issue. When the IP address change, the DNS service is not update to the new IP address.

After put in place the solution proposed in this tutorial, the redirection from your domain name to the real IP address will not be loose anymore.

Make sure you got a global dynamic IP with: [ip.yunohost.org](http://ip.yunohost.org/). Global IP of your box change almost every days.

The goal of this tutorial is to make the box to say to the dynamic DNS service it has change global IP, then DNS will automatically change.

If you own a domain name at **OVH**, you could go to step 4  and follow this [tutorial](OVH_fr) because OVH offer a DynDNS service.

#### 1. Register to a Dynamic DNS service
Here is sites which offer a DynDNS service free of charge:
* [DNSexit](https://www.dnsexit.com/Direct.sv?cmd=dynDns)
* [No-IP](https://www.noip.com/remote-access)
* [ChangeIP](https://changeip.com)
* [DynDNS (In Italian)](https://dyndns.it)

Register to one of them.

#### 2. Move the DNS zones
Move the [DNS zones](dns_config), excepted the NS fields, from the [registar](registar_en) where you bought your domain name to the dynamic DNS service you registrer at step 1.

#### 3. Change Name System (NS)
This step consist to say to the [registar](registar_en) that the new DNS service will be manage by the DynDNS service.
Redirect NS field to the IP address gived by the dynDNS service.

Then, remove [DNS zones](dns_config), excepted NS fields, from the [registar](registar_en).

#### 4. Create a Dynamic DNS login
On the dynamic DNS service create a login that you will enter on a dynamic DNS client.
This client could be your box or a package installed on your server as `ddclient`.
We gone use the client installed on the box which is more easy way.

#### 5. Configure the box
Put the login of the dynamic DNS and the [IP address](http://ip.yunohost.org/) on your box.

<img src="https://yunohost.org/images/dns_dynamic-ip_box_conf.png" width=600>
