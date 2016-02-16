## Configuration de la zone DNS

Exemple de configuration des entrés de la zone DNS pour le nom de domaine `domain.tld` :

#### Redirection du nom de domaine vers l’adresse IP
```bash
@ 900 IN A 111.222.333.444 # (Minimum) IPv4
@ 900 IN AAAA 2001:AABB:CCDD:EEFF:1122:3344:5566:7788 # IPv6

* 900 IN A 111.222.333.444 # Wildcard
* 900 IN AAAA 2001:AABB:CCDD:EEFF:1122:3344:5566:7788
```

#### Sous-domaines
```bash
www 1800 IN CNAME @ # accessible sur www.domain.tld
```

#### XMPP
```bash
_xmpp-client._tcp 14400 IN SRV 0 5 5222 domain.tld. # (Minimum) connexion avec les clients
_xmpp-server._tcp 14400 IN SRV 0 5 5269 domain.tld. # (Minimum) connexions entre serveurs

muc 1800 IN CNAME @ # salons de discussion sur `muc.domain.tld`
anonymous 1800 IN CNAME @ # connexion sans compte sur `anonymous.domain.tld`
bosh 1800 CNAME @ # BOSH
_xmppconnect 1800 TXT "_xmpp-client-xbosh=https://bosh.domain.tld:5281/http-bind"
pubsub 1800 IN CNAME @
vjud 1800 IN CNAME @
```

#### Email
```bash
@ 900 IN MX 10 domain.tld. # (Minimum)
@ 900 IN TXT "v=spf1 a mx -all"
```
<br />

#### Mise en place
Remplacez :
* « `domain.tld` » par votre propre nom de domaine en conservant le point à la fin.
* les adresses IP d’exemple par celles de votre serveur :
 * `111.222.333.444` : [IPv4](http://ip.yunohost.org/).
 * `2001:AABB:CCDD:EEFF:1122:3344:5566:7788` : [IPv6](http://ip6.yunohost.org/).

<div class="alert alert-info">**Pour débuter :** les lignes avec « (Minimum) » sont les entrées DNS minimales requises pour avoir une redirection nom de domaine vers l’adresse IP, avoir XMPP et le courrier électronique qui fonctionnent.</div>

<div class="alert alert-warning">**Attention :** le **@** représente le nom de domaine par défaut que l’on est en train de définir, certains bureaux d’enregistrement ne l’acceptent pas (ex : OVH). Il faut donc remplacer le « @ » par votre nom de domaine (domain.tld**.**) sans oublier un point à la fin.</div>
