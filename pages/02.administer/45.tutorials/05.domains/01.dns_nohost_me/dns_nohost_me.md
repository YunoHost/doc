---
title: Nohost.me domains
template: docs
taxonomy:
    category: docs
routes:
  default: '/dns_nohost_me'
---

In order to make self-hosting as accessible as possible, the YunoHost Project provides a *free* and *automatically configured* domain name service. By using this service, you won't have to [configure DNS records](/dns_config) yourself, which can be tedious and technical.

The following (sub)domains are offered:
- `whateveryouwant.nohost.me`;
- `whateveryouwant.noho.st`;
- `whateveryouwant.ynh.fr`.

To use this service, you simply have to choose such a domain during the post-installation set up. It will then be automatically configured by YunoHost!

!!! As a fairness measure, each instance may only have **one such domain** setup at any given time.

### Subdomains

The `nohost.me`, `noho.st` and `ynh.fr` domain service allows the creation of subdomains.

YunoHost allows the installation of applications on subdomains (for example, having the Nextcloud application accessible from the `cloud.mydomain.org` address), this feature is also allowed with the `nohost.me`, `noho.st` and `ynh.fr` domains and so it is possible to have a subdomain such as `my.application.mydomain.nohost.me`. To create a subdomain on `nohost.me`, `noho.st` and `ynh.fr`, you just have to add the subdomain to yunohost like any other domains.


### Adding a nohost.me, noho.st or ynh.fr domain after the post-installation

If you already did the postinstall and want to add an automatic domain, you may do so from the "Domains" web interface, selecting the option "I don't have a domain name..."

Alternatively, the following commands can be used.

```bash
# Add the domain
yunohost domain add whateveryouwant.nohost.me

# Subscribe/register to the dyndns service
yunohost dyndns subscribe -d whateveryouwant.nohost.me

# [ wait ~ 30 seconds ]

# Update the DNS conf
yunohost dyndns update

# Set it as the main domain
yunohost domain main-domain -n whateveryouwant.nohost.me
```

### Retrieve a nohost.me, noho.st or ynh.fr domain

If you reinstall your server and want to use a domain already used previously, you must request a domain reset on the forum [in the dedicated thread](https://forum.yunohost.org/t/nohost-domain-recovery/442).


### Change a nohost.me, noho.st or ynh.fr domain

If you wish to use a different automatic domain, you first have to remove your present domain registration. This is done in 3 steps:

1. Remove the domain from your instance (via webadmin or the `yunohost domain remove` in the CLI). 
2. Ask for registration removal [in the dedicated forum thread](https://forum.yunohost.org/t/nohost-domain-recovery/442).
3. Remove automatic domain configuration files on your server, via CLI only: `sudo rm /etc/cron.d/yunohost-dyndns && sudo rm -r /etc/yunohost/dyndns`

You may then add a new domain.
