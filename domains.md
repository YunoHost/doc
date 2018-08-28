Domains, DNS conf and certificate
=================================

YunoHost allows to manage and serve several domains on the same server. You can therefore host, for instance, a blog and a Nextcloud on a first domain `yolo.com`, and a web mail client on a second domain `swag.nohost.me`. Each domain is automatically configured to be able to handle web services, mail services and XMPP services.

Domains can be managed in the 'Domain' section of the webadmin, or through the `yunohost domain` category of the command line. Each time you add a domain, it is expected that you bought it (or own it) on a domain registrar, such that you will then be able to manage the [DNS configuration](dns). The exception is the domains `.nohost.me`, `.noho.st` and `ynh.fr` which are free and can be directly integrated with YunoHost.

The domain chosed during the postinstall is defined as the main domain of the server : this is where the SSO and the web admin interface will be available. The main domain can later be changed through the web admin in Domains > (the domain) > Set default, or with the command line `yunohost tools maindomain`.

Finally, it shall be noted that, in the context of YunoHost, there is no hierarchy between the domains it knows. In the previous example, one may add a third domain `foo.yolo.com` - but it would be considered as a domain independent of `yolo.com`.

DNS configuration
-----------------

DNS (Domain Name System) is a system that allows computers from all around the world to translate human-readable domain name (such as `yolo.com`) to machine-understandable adresses called IP (such as `11.22.33.44`). For this translation (and other features) to work, one must carefully configure DNS records. 

YunoHost can generate a recommended DNS configuration for each domain, including elements needed for mail and XMPP. The recommended DNS configuration is available in the webadmin via Domain > (the domain) > DNS configuration, or with the command `yunohost domain dns-conf the.domain.tld`.

SSL/HTTPS certificates
----------------------

Another important aspect of domain configuration is the SSL/HTTPS certificate. YunoHost is integrated with Let's Encrypt, such that once your server is correctly reachable from anybody on the internet though the domain name, the administrator can ask to install a Let's Encrypt certificate. See the documentation about [certificates](certificates) for more information.

Subpaths vs. individual domains per apps
----------------------------------------

In the context of YunoHost, it is quite common to have a single (or a few) domains on which several apps are installed in "subpaths", such that you end up with something like this : 

```bash
yolo.com
     ├── /blog  : Wordpress (a blog)
     ├── /cloud : Nextcloud (a cloud service)
     ├── /rss   : TinyTiny RSS (a RSS reader)
     ├── /wiki  : DokuWiki (a wiki)
```

Alternatively, one may choose to install each (or some) apps on a dedicated domain. This might look prettier for end users, but is generally considered more complicated and less efficient in the context of YunoHost, for you need to add a new domain each time. Nevertheless, some apps might need an entire domain dedicated to them, for technical reason.

If all apps from the previous example would be installed on a separate domain, this would give something like this :

```bash
blog.yolo.com  : Wordpress (a blog)
cloud.yolo.com : Nextcloud (a cloud service)
rss.yolo.com   : TinyTiny RSS (a RSS reader)
wiki.yolo.com  : DokuWiki (a wiki)
```

