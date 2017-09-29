# Résolveur DNS de YunoHost

<div class="alert alert-danger">Cette page est dépréciée / obsolète. Les informations présentées ont besoin d'être mise à jour (ou doivent être retirée).</div>

### Présentation
YunoHost est installé avec un service DNS pour la résolution des noms de domaine. En général, votre serveur n’est pas configuré, c’est celui de votre FAI.
Par exemple pour une Freebox la résolution se fait par l’adresse `192.168.0.254`.

Comment savoir ? Regarder le contenu du fichier `/etc/resolv.conf`. Ce fichier n’est pas modifiable car il est réécrit par le service DHCP.
Un client DHCP est configuré, celui-ci interroge votre routeur pour les adresses IP de vos serveurs de résolution de DNS. Ces IPs sont fournis par votre FAI.

### Configuration
Afin d’utiliser le résolveur DNS de votre instance YunoHost, il faut modifier la configuration DHCP pour ne pas faire de requêtes à votre routeur. Il faut donc mettre de façon statique la nouvelle adresse à savoir dans ce cas `127.0.0.1`.

Éditer le fichier `/etc/dhcp/dhclient.conf`, ajouter une ligne `supersede` et supprimer de la ligne `request` le mot `domain-name-servers` :
```bash
supersede domain-name-servers 127.0.0.1, 192.168.0.254;
request subnet-mask, broadcast-address, time-offset, routers,
        domain-name, domain-search, host-name,
        dhcp6.name-servers, dhcp6.domain-search,
        netbios-name-servers, netbios-scope, interface-mtu,
        rfc3442-classless-static-routes, ntp-servers;
```

Afin de prendre en compte la modification, redémarrer le serveur DNS :

```bash
service dnsmasq restart
```

(TODO : il doit être possible de reconfigurer à chaud, mais ça n’a pas fonctionné).
Il est possible de faire la même modification sur toutes vos machines du réseau local en remplaçant 127.0.0.1 par l’IP de votre serveur.
