#Configuration DNS

Exemple de configuration DNS pour domain.tld

```bash
#### IPv4 & IPv6
@ 900 IN A 111.222.333.444 (Minimum)
* 900 IN A 111.222.333.444 (wildcard)
@ 900 IN AAAA 2001:AABB:CCDD:EEFF:1122:3344:5566:7788
* 900 IN AAAA 2001:AABB:CCDD:EEFF:1122:3344:5566:7788

#### Gestion du sous-domaine www
www 1800 IN CNAME @

#### Sous-domaines pour XMPP/Jabber
_xmpp-client._tcp 14400 IN SRV 0 5 5222 domain.tld. (Minimum)
_xmpp-server._tcp 14400 IN SRV 0 5 5269 domain.tld. (Minimum)
muc 1800 IN CNAME @
pubsub 1800 IN CNAME @
vjud 1800 IN CNAME @

#### Configuration pour le mail
@ 900 IN MX 10 domain.tld. (Minimum)
@ 900 IN TXT "v=spf1 a mx -all"
```

<div class="alert alert-warning"><b>Attention :</b> remplacez « domain.tld » par votre propre nom de domaine ainsi que les adresses IP d’exemple par celle de votre serveur.</div>


<div class="alert alert-info"><b>Pour débuter :</b> les lignes avec « (Minimum) » sont les entrées DNS minimales requises pour que le web, le courrier électronique et XMPP fonctionnent.</div>

<div class="alert alert-warning"><b>Attention :</b> <b>@</b> représente le nom de domaine par défaut que l’on est en train de définir, certains bureaux d’enregistrement ne l’acceptent pas (ex : OVH). Il faut donc remplacer le « @ » par votre nom de domaine (domain.tld**.**) sans oublier un point à la fin.</div>
