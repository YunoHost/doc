## DNS and subdomains for the applications

### Subdomains

YunoHost allows the use of subdomains. If one owns a domain name `mydomain.com`, one first needs to create the subdomains in the DNS configuration (with one's registrar like Gandi).

### Configuration example with Gandi

The DNS configuration needs an A record with an IPv4 address, an AAAA record with an IPv6 address, and various CNAME records, one for each desired subdomain.

If your DNS configuration looks like:
```bash
@         A            XYZ.XYZ.XYZ.XYZ
@         AAAA         1234:1234:1234:FFAA:FFAA:FFAA:FFAA:AAFF
*         CNAME        mydomain.com.
agenda    CNAME        mydomain.com.
blog      CNAME        mydomain.com.
rss       CNAME        mydomain.com.
```
then you can access `agenda.mydomain.com`, `blog.mydomain.com` and `rss.mydomain.com` subdomains.

### Install an application on a subdomain

To install an application on a subdomain in YunoHost, for example `blog.mydomain.com`, the configuration is done in the administration panel. One first add the subdomain to the available domains list. The creation of a subdomain in Yunohost will create the corresponding configuration files  for Nginx (the web server used in YunoHost).

Then, in the applications>install panel, one follows the classic installation process by choosing the desired subdomain as domain (for example `blog.mydomain.com`). One needs to choose the path `/` (in place of `/wordpress` for example). A warning message will appear telling that it won't be possible to install other application to this subdomain. After validation, the installation starts.

The application is then available at `blog.mydomain.com` (and not `mydomain.com/wordpress`).

### Moving an application to a subdomain

What happens if the application is already installed? For example, one wants to move `mydomain.com/wordpress` to `blog.mydomain.com`.
It depends on the application. 
Some applications allow the change of domain. In that case, one can proceed to the change through the administration panel Applications>the_app>change URL. 
If the application doesn't allow URL change, then there is no easy way to do it. The best solution is to reinstall the application.

### Reinstalling an application

First, save the application data through the backup process. Then uninstall the application with the administration panel. Then reinstall the application to the desired domain. Finally, restore the backup.
