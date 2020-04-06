Domains, DNS conf and certificate
=================================

YunoHost allows you to manage and serve several domains on the same server. For instance, you can host a blog and Nextcloud on a first domain `yolo.com`, and a web mail client on a second domain `swag.nohost.me`. Each domain is automatically configured to handle web services, mail services and XMPP services.

Domains can be managed in the 'Domain' section of the webadmin, or through the `yunohost domain` category of the command line. Each time you add a domain, it is expected that you bought it (or own it) on a domain registrar, so you can manage the [DNS configuration](dns). The exception is the [`.nohost.me`, `.noho.st` and `ynh.fr` domains](/dns_nohost_me) which are paid for by the YunoHost Project, and can be directly integrated with YunoHost thanks to an automated dynDNS setup. (To limit costs and abuses, each instance may only have one of these domains setup at any given time).

The domain chosen during the postinstall is defined as the main domain of the server : this is where the SSO and the web admin interface will be available. The main domain can later be changed through the web admin in Domains > (the domain) > Set default, or with the command line `yunohost tools maindomain`.

Finally, take note that, in the context of YunoHost, there is no hierarchy between the domains it knows. In the previous example, you may add a third domain `foo.yolo.com` - but it would be considered as a domain independent of `yolo.com`.

Non-latin characters
-----------------

If your domain has special, non-latin characters, you need to use its [internationalized version](https://en.wikipedia.org/wiki/Internationalized_domain_name) through [Punycode](https://en.wikipedia.org/wiki/Punycode). You can use [this converter](https://www.charset.org/punycode), and use the converted domain name in your YunoHost configuration. 

DNS configuration
-----------------

DNS (Domain Name System) is a system that allows computers from around the world to translate human-readable domain names (such as `yolo.com`) to machine-understandable adresses called IP addresses (such as `11.22.33.44`). For this translation (and other features) to work, you must carefully configure DNS records. 

YunoHost can generate a recommended DNS configuration for each domain, including elements needed for mail and XMPP. The recommended DNS configuration is available in the webadmin via Domain > (the domain) > DNS configuration, or with the command `yunohost domain dns-conf the.domain.tld`.

SSL/HTTPS certificates
----------------------

Another important aspect of domain configuration is the SSL/HTTPS certificate. YunoHost is integrated with Let's Encrypt, so once your server is correctly reachable from anybody on the internet through the domain name, the administrator can request a Let's Encrypt certificate. See the documentation about [certificates](certificate) for more information.

Subpaths vs. individual domains per apps
----------------------------------------

In the context of YunoHost, it is quite common to have a single (or a few) domains on which several apps are installed in "subpaths", so that you end up with something like this: 

```bash
yolo.com
     ├── /blog  : Wordpress (a blog)
     ├── /cloud : Nextcloud (a cloud service)
     ├── /rss   : TinyTiny RSS (a RSS reader)
     ├── /wiki  : DokuWiki (a wiki)
```

Alternatively, you may choose to install each (or some) apps on a dedicated domain. This might look prettier for end users, but is generally considered more complicated and less efficient in the context of YunoHost, since you need to add a new domain each time. Nevertheless, some apps might need an entire domain dedicated to them, for technical reasons.

If all apps from the previous example were installed on a separate domain, this would give something like this:

```bash
blog.yolo.com  : Wordpress (a blog)
cloud.yolo.com : Nextcloud (a cloud service)
rss.yolo.com   : TinyTiny RSS (a RSS reader)
wiki.yolo.com  : DokuWiki (a wiki)
```

