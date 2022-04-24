---
title: Domains, DNS conf, and certificate
template: docs
taxonomy:
    category: docs
routes:
  default: '/domains'
---

YunoHost allows you to manage and serve several domains on the same server. For instance, you can host a blog and Nextcloud on a first domain `yolo.com`, and a web mail client on a second domain `swag.nohost.me`. Each domain is automatically configured to handle web services, mail services and XMPP services.

Domains can be managed in the 'Domain' section of the webadmin, or through the `yunohost domain` category of the command line.

Each time you add a domain, it is expected that you bought it (or own it) on a domain registrar, so you can manage the [DNS configuration](/dns_config). The exception is the [`.nohost.me`, `.noho.st` and `ynh.fr` domains](/dns_nohost_me) which are paid for by the YunoHost Project, and can be directly integrated with YunoHost thanks to an automated dynDNS setup. To limit costs and abuses, each instance may only have one of these domains setup at any given time, however you can add as many sub-domains of it as you wish. For example, if you choose `example.noho.st` you can later add the domains `video.example.noho.st` or `www.example.ynh.noho.st` or any other sub-domain you may need.

The domain chosen during the initial configuration (post-install) is defined as the main domain of the server : this is where the SSO and the web admin interface will be available. The main domain can later be changed through the web admin in Domains > (the domain) > Set default, or with the command line `yunohost tools maindomain`.

Finally, take note that, in the context of YunoHost, there is no hierarchy between the domains it knows. In the previous example, you may add a third domain `foo.yolo.com` - but it would be considered as a domain independent of `yolo.com`.

## Non-latin characters

If your domain has special, non-latin characters, you need to use its [internationalized version](https://en.wikipedia.org/wiki/Internationalized_domain_name) through [Punycode](https://en.wikipedia.org/wiki/Punycode). You can use [this converter](https://www.charset.org/punycode), and use the converted domain name in your YunoHost configuration. 

## Local domains

Starting from YunoHost v4.3, domains ending by `.local` are fully supported, in addition to the default `yunohost.local`.
They do not use the DNS protocol, but the mDNS one (also known as Zeroconf, Bonjour), which allows them to be published with no specific configuration but exclusively on your local network or VPN.
Their use is this especially suitable when you do not want one of your apps to be available on the Internet.

!!!! mDNS protocol does not allow for subdomains to be created. So `domain.local` will work, while `sub.domain.local` is not possible.

`Yunomdns` service takes care of publishing your `.local` domains on your network.
It has a configuration file, `/etc/yunohost/mdns.yml`, which allows you to choose which domains are published, and on which network interfaces.
This file is automatically regenerated whenever you add or delete a `.local` domain.

The service will always try to publish `yunohost.local`. If you have multiple YunoHost servers on your network, try `yunohost-2.local`, and so on.
The number may change depending on which server starts first, so do not rely on it to use actual apps and create your own domains.

! Unfortunately, Android devices before version 12 (released in 2021) do not seem to be listening to mDNS protocol.
! To be able to reach `.local` domains on your Android devices, you will have to add in their DNS settings your YunoHost server's local IP address.

## DNS configuration

DNS (Domain Name System) is a system that allows computers from around the world to translate human-readable domain names (such as `yolo.com`) to machine-understandable adresses called IP addresses (such as `11.22.33.44`). For this translation (and other features) to work, you must carefully configure DNS records. 

YunoHost can generate a recommended DNS configuration for each domain, including elements needed for mail and XMPP. The recommended DNS configuration is available in the webadmin via Domain > (the domain) > DNS configuration, or with the command `yunohost domain dns-conf the.domain.tld`.

## SSL/HTTPS certificates

Another important aspect of domain configuration is the SSL/HTTPS certificate. YunoHost is integrated with Let's Encrypt, so once your server is correctly reachable from anybody on the internet through the domain name, the administrator can request a Let's Encrypt certificate. See the documentation about [certificates](/certificate) for more information.
