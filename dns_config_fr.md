#Configuration DNS

Exemple de configuration de DNS pour domain.tld

```bash
#### IPv4 & IPv6
@ 900 IN A 111.222.333.444
@ 900 IN AAAA 2001:AABB:CCDD:EEFF:1122:3344:5566:7788

#### Gestion du sous-domaine www
www 1800 IN CNAME @

#### Sous-domaines pour XMPP/Jabber
muc 1800 IN CNAME @
pubsub 1800 IN CNAME @
vjud 1800 IN CNAME @
_xmpp-client._tcp 14400 IN SRV 0 5 5222 domain.tld.
_xmpp-server._tcp 14400 IN SRV 0 5 5269 domain.tld.

#### Configuration pour le mail
@ 900 IN MX 10 domain.tld.
@ 900 IN TXT "v=spf1 a mx:domain.tld ~all"
```