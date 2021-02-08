---
title: Configuration de l'IPv6
template: docs
taxonomy:
    category: docs
routes:
  default: '/ipv6'
---

L'IPv6 peut fonctionner directement dans certains cas. Mais dans d'autres, ou chez certains hébergeurs spécifiques, vous devez activer l'IPv6 manuellement.

## Avec un VPS chez OVH

OVH donne une adresse IPv4 et une IPv6 pour ses VPS, mais par défaut, seule l'IPv4 fonctionne.
La documentation d'OVH à ce sujet est ici : https://docs.ovh.com/fr/vps/configurer-ipv6/

### Configurer le serveur DNS

Ici : https://yunohost.org/#/dns_subdomains

### Configurer le serveur

Sur le panneau de gestion d'OVH, vous aller récupérer 3 informations :
- l'adresse IPv6 du serveur
- l'adresse passerelle IPv6 
- le préfixe IPv6. Les offres VPS SSD d'OVH ne fournissent qu'**une** seule adresse IPV6, le préfixe est donc `/128`

Sur votre VPS, vous aller créer une sauvegarde de votre fichier de configuration des interfaces réseau dans votre répertoire home avec la commande : `cp /etc/network/interfaces ~/interfaces`.

Ensuite, vous pouvez modifier le fichier de configuration `/etc/network/interfaces`.

! Dans cet exemple, nous considérons que votre interface réseau est `eth0`. Si elle est différente (vérifiez avec `ip a`) vous devez adapter l'exemple pour correspondre à votre situation.

```plaintext
iface eth0 inet6 static
address <votre adresse IPv6>
netmask <votre préfixe IPv6>
post-up /sbin/ip -6 route add <la passerelle IPv6> dev eth0
post-up /sbin/ip -6 route add default via <la passerelle IPv6> dev eth0
pre-down /sbin/ip -6 route del default via <la passerelle IPv6> dev eth0
pre-down /sbin/ip -6 route del <la passerelle IPv6> dev eth0
```

Maintenant, enregistrez le fichier et redémarrez les services réseau avec : `service networking restart`. (TODO : ideally we should find a way to validate the content of the configuration, otherwise it could fuck up the network stack and get disconnected from the VPS ?)

Vérifiez votre configuration avec les commandes :
- `ip a` pour afficher les adresses IP des interfaces
- `hostname -I` pour afficher les adresses IP du système
- essayez de faire un test de `ping` sur un serveur IPv6 (vous pouvez utiliser `ping6 ipv6.yunohost.org`)
- essayez de faire un test de `ping` sur votre server depuis votre PC (cela exige que votre PC puisse utiliser l'IPv6)

Et voilà !
