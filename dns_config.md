## DNS zone configuration

Sample DNS zone configuration for `domain.tld` domain nane:

#### Redirection from the domain name to the IP address
```bash
@ 1800 IN A 111.222.333.444 # (Minimal) IPv4
@ 1800 IN AAAA 2001:AABB:CCDD:EEFF:1122:3344:5566:7788 # IPv6

* 1800 IN A 111.222.333.444 # Wildcard
* 1800 IN AAAA 2001:AABB:CCDD:EEFF:1122:3344:5566:7788
```

#### Subdomains
```bash
www 1800 IN CNAME @ # accesible at www.domain.tld
```

#### XMPP
```bash
_xmpp-client._tcp 1800 IN SRV 0 5 5222 domain.tld. # (Minimal) clients connection
_xmpp-server._tcp 1800 IN SRV 0 5 5269 domain.tld. # (Minimal) servers connection

muc 1800 IN CNAME @ # multi-user chat rooms at muc.domain.tld
anonymous 1800 IN CNAME @ # connection without account at `anonymous.domain.tld`
bosh 1800 CNAME @ # BOSH
_xmppconnect 1800 TXT "_xmpp-client-xbosh=https://bosh.domain.tld:5281/http-bind"
pubsub 1800 IN CNAME @
vjud 1800 IN CNAME @
```

#### Email
```bash
@ 1800 IN MX 10 domain.tld. # (Minimal)
@ 1800 IN TXT "v=spf1 a mx -all"
```

#### Set up
Replace:
- "`domain.tld`" with your own domain preserving the dot at the end.
-  IP samples values with your server IP addresses:
 * `111.222.333.444`: [IPv4](http://ip.yunohost.org/).
 * `2001:AABB:CCDD:EEFF:1122:3344:5566:7788`: [IPv6](http://ip6.yunohost.org/).

<div class="alert alert-info"><b>To begin:</b> lines with "(Minimal)" are the minimal required DNS entries to make works redirection from the domain name to the IP adress, XMPP and email.</div>

<div class="alert alert-warning"><b>Warning:</b> <b>@</b> is the default domain name currently defined, some registrar (like OVH) does not accept it, so replace @ by your domain name (domain.tld**.**) with a dot at the end.</div>

#### Time to live
All DNS lines above have `1800` value (30 minutes). It corresponds to [Time to live (TTL)](https://en.wikipedia.org/wiki/Time_to_live#DNS_records) which represents and indicate time, in seconds, during which the DNS line can be kept in the cache. After this time, the information must me considered obsolete and must be update.