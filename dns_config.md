#DNS Configuration

Sample DNS config for domain.tld

```bash
#### IPv4 & IPv6
@ 900 IN A 111.222.333.444 (Minimal)
* 900 IN A 111.222.333.444 (wildcard)
@ 900 IN AAAA 2001:AABB:CCDD:EEFF:1122:3344:5566:7788
* 900 IN AAAA 2001:AABB:CCDD:EEFF:1122:3344:5566:7788

#### Handle www subdomain
www 1800 IN CNAME @

#### XMPP/Jabber subdomains
_xmpp-client._tcp 14400 IN SRV 0 5 5222 domain.tld. (Minimal)
_xmpp-server._tcp 14400 IN SRV 0 5 5269 domain.tld. (Minimal)
muc 1800 IN CNAME @
pubsub 1800 IN CNAME @
vjud 1800 IN CNAME @

#### Mail configuration
@ 900 IN MX 10 domain.tld. (Minimal)
@ 900 IN TXT "v=spf1 a mx -all"
```

<div class="alert alert-warning"><b>Warning:</b> replace "domain.tld" with your own domain, and update IP samples values with your server IP address.</div>

<div class="alert alert-info"><b>To begin:</b> lines with "(Minimal)" are the minimal required DNS entries to make works web, email and XMPP.</div>

<div class="alert alert-warning"><b>Warning:</b> <b>@</b> is the default domain name currently defined, some registrar (like OVH) does not accept it, so replace @ by your domain name (domain.tld**.**) with a dot at the end.</div>
