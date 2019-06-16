# DNS: Domain Name System

DNS configuration is a crucial stage for rendering your server accessible to the wider Internet. If your DNS is poorly configured, you are liable to have a lot of problems in connecting to your server via your domain name.

*Even though this page appears long and complex, it is very important to understand the implications of Internet domain names, which are necessary for the proper function of your Yunohost server.*

### What is it?

DNS stands for "Domain Name Server", and is often used for the configuration of your domain names. Your domain names must point at a specific identifier (generally at an IP address.)

**For example**: `yunohost.org` points to the server at `88.191.153.110`.

This system was created to more easily keep track of server addresses. There are DNS registries for Internet names that you must register with. They are called "registrars", which will let you rent certain domain names for a price (between $5 or a few hundred, depending on the root domain and the chosen name). These [registrars](registrar) are private entities authorised by [ICANN](http://en.wikipedia.org/wiki/ICANN), such as [OVH](https://www.ovh.co.uk/index.xml), [Gandi](http://gandi.net), [NameCheap](http://namecheap.com) or [BookMyName](http://bookmyname.com). A privacy respecting registrar is [Njalla](https://njal.la/) or [Njalla Onion Site](http://njalladnspotetti.onion). With Njalla, you can register a domain name with just an email or XMPP address (N.B. : you won't have full control and ownership of the domain though).

It is important to note that subdomains do not necessarily have to send you to wherever the principal domain is pointing. If `yunohost.org` sends to `88.191.153.110`, that doesn't mean that `backup.yunohost.org` has to point at the same IP. You must therefore configure **all** of the domains and subdomains that you want to use.

There are also different **types** of DNS records, which means that a domain can point at something other than an IP address.

**For example**: `www.yunohost.org` will send you to `yunohost.org`

### How to (properly) set up a DNS name?

You have several choices here. Note that you can mix and match solutions if you have multiple domains: for example, you can have `my-server.nohost.me` using solution **1.**, and `my-server.org` using solution **2.**, both leading to the same Yunohost server.

1. You can use [YunoHost's DNS service](/dns_nohost_me), which will automatically configure your DNS for you. You must choose a domain that ends with `.nohost.me`, `.noho.st` or `.ynh.fr` for this, which may be inconvenient for you (you would then only be able to use an email address like `john@my-server.noho.st`).

  **This is the recommended option if you are just starting out with self-hosting.**

2. You can use the DNS service offered by your **registrar** (Gandi, NameCheap, BookMyName or others) to configure your domain name. Here is the [standard DNS configuration](/dns_config). The DNS service of your router can also be used, more info on [how to setup a local domain](dns_local_network).
You can also check out these pages for specific [registrar](/registrar_en) documentation: [OVH](https://www.ovh.co.uk/index.xml), [Gandi](http://gandi.net), [NameCheap](http://namecheap.com) or [BookMyName](http://bookmyname.com).

  **Warning**: If you choose this option, you will have more configuration possibilities, but nothing will be done for you. For example, if you want to use `webmail.my-server.org`, you must add it manually to the DNS records with your registrar.

3. Your YunoHost instance has its own DNS service, which means it will automatically configure its own DNS records, and that you can leave the setup to the instance itself. To do this, you must explain to your **registrar** that your YunoHost instance is the authoritative DNS server for your domain name.

  **Warning**: If you choose this option, all configuration options will be done automatically, you will retain a good deal of flexibility, but if your server gets knocked offline you will run into many problems. **Choose this only if you are certain.**

4. Once your DNS service is running, your server can use it but it needs to be configured, this is the [DNS resolver](/dns_resolver_en).


### Dynamic IP
If the global IP address is changing follow this [tutorial](dns_dynamicip_en).
