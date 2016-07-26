# Configuration box/router

<a class="btn btn-lg btn-default" href="http://ports.yunohost.org">Check ports are open</a>

#### Access to box/routeur administration
In the URL bar of your web navigator put:
```bash
192.168.0.1 or 192.168.1.1
```
Then you will need to authentificate.

#### Opening ports
Opening following ports are necessary to make works differents services.

**TCP:**
* Web: 80 <small>(HTTP)</small>, 443 <small>(HTTPS)</small>
* [SSH](/ssh_en): 22
* [XMPP](/XMPP_en): 5222 <small>(clients)</small>, 5269 <small>(servers)</small>
* [Email](/email_en):  25, 465 <small>(SMTP)</small>, 587 <small>(SMTP with SSL)</small>,  993 <small>(IMAP)</small>
* [DNS](/dns_en): 53

##### UPnP
UPnP permit opening automatically ports.

In some case, after changing your box configuration (ex: add IPv6, or unlock SMTP ... ) and a reboot. It happens that ports are no onger opened. So you have to reload your firewall configuration:

```sudo yunohost firewall reload```

##### Manual opening ports
In the case that UPnP doesn’t works, manual opening ports are necessary.

##### Email
Internet service porviders blocks port 25 to avoid spam. To send mails, you’ll need to open port 25.
