## Configuration de la zone DNS

Exemple de configuration des entrées de la zone DNS pour le nom de domaine `domain.tld` :

#### Redirection du nom de domaine vers l’adresse IP
```bash
@ 1800 IN A 111.222.333.444 # (Minimum) IPv4
@ 1800 IN AAAA 2001:AABB:CCDD:EEFF:1122:3344:5566:7788 # IPv6
```

#### Redirection du nom de domaine et de tous les sous-domaines vers l’adresse IP
```bash
* 1800 IN A 111.222.333.444 # Wildcard : *.domain.tld et domain.tld pointent vers l’adresse IP.
* 1800 IN AAAA 2001:AABB:CCDD:EEFF:1122:3344:5566:7788
```

#### Sous-domaines
```bash
www 1800 IN CNAME @ # accessible sur www.domain.tld
```

#### XMPP
```bash
_xmpp-client._tcp 1800 IN SRV 0 5 5222 domain.tld. # (Minimum) connexions avec les clients
_xmpp-server._tcp 1800 IN SRV 0 5 5269 domain.tld. # (Minimum) connexions entre serveurs

muc 1800 IN CNAME @ # salons de discussion sur `muc.domain.tld`
anonymous 1800 IN CNAME @ # connexion sans compte sur `anonymous.domain.tld`
bosh 1800 CNAME @ # BOSH
_xmppconnect 1800 TXT "_xmpp-client-xbosh=https://bosh.domain.tld:5281/http-bind"
pubsub 1800 IN CNAME @
vjud 1800 IN CNAME @
```

#### Email
```bash
@ 1800 IN MX 10 domain.tld. # (Minimum)
@ 1800 IN TXT "v=spf1 a mx -all"
```
<br />

#### Mise en place
Remplacez :
* « `domain.tld` » par votre propre nom de domaine en conservant le point à la fin.
* les adresses IP d’exemple par celles de votre serveur :
 * `111.222.333.444` : [IPv4](http://ip.yunohost.org/).
 * `2001:AABB:CCDD:EEFF:1122:3344:5566:7788` : [IPv6](http://ip6.yunohost.org/).

Les entrées DNS sous domaines, XMPP et email ne fonctionnent pas sans une redirection du nom de domaine vers l’adresse IP (une ligne est suffisante) étant donné qu’elles en sont dépendantes.

<div class="alert alert-info">**Pour débuter :** les lignes avec « (Minimum) » sont les entrées DNS minimales requises pour avoir une redirection du nom de domaine vers l’adresse IP, XMPP et le courrier électronique qui fonctionnent.</div>

<div class="alert alert-warning">**Attention :** le **@** représente le nom de domaine par défaut que l’on est en train de définir, certains bureaux d’enregistrement ne l’acceptent pas (ex : OVH). Il faut donc remplacer le « @ » par votre nom de domaine (domain.tld**.**) sans oublier un point à la fin.</div>

#### Time to live
Toutes les entrées DNS ci-dessus ont la valeur `1800` (30 minutes). Elle correspond au 
[Time to live (TTL)](https://fr.wikipedia.org/wiki/Time_to_Live#Le_Time_to_Live_dans_le_DNS) qui représente et indique le temps, en secondes, durant lequel l’entrée DNS peut être conservée en cache. Passé ce délai, l’information doit être considérée comme obsolète et doit être mise à jour.