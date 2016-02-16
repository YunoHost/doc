## DNS zone configuration

Sample DNS zone configuration for `domain.tld` domain nane:

#### Redirection from the domain name to the IP address
```bash
@ 900 IN A 111.222.333.444 # (Minimal) IPv4
@ 900 IN AAAA 2001:AABB:CCDD:EEFF:1122:3344:5566:7788 # IPv6

* 900 IN A 111.222.333.444 # Wildcard
* 900 IN AAAA 2001:AABB:CCDD:EEFF:1122:3344:5566:7788
```

#### Subdomains
```bash
www 1800 IN CNAME @ # accesible at www.domain.tld
```

#### XMPP
```bash
_xmpp-client._tcp 14400 IN SRV 0 5 5222 domain.tld. # (Minimal) clients connection
_xmpp-server._tcp 14400 IN SRV 0 5 5269 domain.tld. # (Minimal) servers connection
muc 1800 IN CNAME @ # multi-user chat rooms at muc.domain.tld
anonymous 1800 IN CNAME @ # connection without account at `anonymous.domain.tld`
pubsub 1800 IN CNAME @
vjud 1800 IN CNAME @
```

#### Email
```bash
@ 900 IN MX 10 domain.tld. (Minimal)
@ 900 IN TXT "v=spf1 a mx -all"
```

#### Set up
Replace:
- "`domain.tld`" with your own domain preserving the dot at the end.
-  IP samples values with your server IP addresses:
 * `111.222.333.444`: [IPv4](http://ip.yunohost.org/).
 * `2001:AABB:CCDD:EEFF:1122:3344:5566:7788`: [IPv6](http://ip6.yunohost.org/).

<div class="alert alert-info"><b>To begin:</b> lines with "(Minimal)" are the minimal required DNS entries to make works redirection from the domain name to the IP adress, XMPP and email.</div>

<div class="alert alert-warning"><b>Warning:</b> <b>@</b> is the default domain name currently defined, some registrar (like OVH) does not accept it, so replace @ by your domain name (domain.tld**.**) with a dot at the end.</div>
