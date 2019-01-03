# Nohost.me domains

In order to make self-hosting as accessible as possible, YunoHost offers a *free*
and *automatically configured* domain name service. By using this service, you
won't have to [configure DNS records](/dns_config) yourself, which
can be tedious and technical.

The following (sub)domains are proposed:
- `whateveryouwant.nohost.me`;
- `whateveryouwant.noho.st`;
- `whateveryouwant.ynh.fr`.

To use this service, you simply have to choose such a domain during the 
post-installation. It will then be automatically configured by YunoHost !

#### Retrieve a nohost.me or noho.st domain

If you reinstall your server and want to use a domain already used previously,
you must request a domain reset on the forum 
[in the dedicated thread](https://forum.yunohost.org/t/nohost-domain-recovery/442).

#### Subdomains

The `nohost.me` and `noho.st` domain service does not allow the creation of
subdomains.

Even if YunoHost allows the installation of applications on subdomains (for
example, having the Owncloud application accessible from the
`cloud.mydomain.org` address), this feature is not allowed with the `nohost.me`
and `noho.st` domains and it is not possible to have a subdomain such as `my
application.mydomain.nohost.me`.

To be able to enjoy applications that can only be installed at the root of a
domain name, you must have your own domain name.

### Adding a nohost.me / noho.st / ynh.fr domain after the post-installation

If you already did the postinstall and want to add a nohost.me domain, you
should run the following command (this can only be done from command line
currently).

N.B. : you can only have *one* nohost.me domain per YunoHost installation.

```bash
# Add the domain
yunohost domain add whateveryouwant.nohost.me

# Subscribe/register to the dyndns service
yunohost dyndns subscribe -d whateveryouwant.nohost.me

# [ wait ~ 30 seconds ]

# Update the DNS conf
yunohost dyndns update
```
