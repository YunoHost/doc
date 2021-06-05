---
title: Configurer la redirection des ports
template: docs
taxonomy:
    category: docs
routes:
  default: '/isp_box_config'
  aliases:
    - '/port_forwarding'
---

Si vous vous auto-hébergez à la maison et sans VPN, il vous faut rediriger les ports de votre routeur ("machin-box"). Le schéma ci-dessous tente d'expliquer brièvement le rôle de la redirection des ports lors de la mise en place d'un serveur à la maison.

[figure caption="Illustration de l'importance de la redirection des ports"]![](image://portForwarding_fr.png)[/figure]

[Cette page](https://craym.eu/tutoriels/utilitaires/ouvrir_les_ports_de_sa_box.html) propose également des explications détaillées sur le fonctionnement des ports, et les étapes de configuration pour différents routeurs.

### 0. Diagnostiquer les ports ouverts

Une fois les redirections configurées, l'outil de diagnostic introduit dans
YunoHost 3.8 vous permettra de vérifier si les ports sont correctement exposés.

### 1. Accéder à l'interface d'administration de votre box/routeur

L'interface d'administration est généralement accessible via http://192.168.0.1 ou http://192.168.1.1.
Ensuite, il vous faudra peut-être vous authentifier avec les identifiants
fournis par votre fournisseur d'accès internet (FAI).

### 2. Trouver l'IP locale de votre serveur

Identifiez quelle est l'IP locale de votre serveur, soit :
- depuis l'interface de votre routeur/box, qui liste peut-être les dispositifs
  connectés;
- depuis la webadmin de YunoHost, dans 'Diagnostic', section 'Connectivité Internet', cliquer sur 'Details' à côté de la ligne sur IPv4.
- depuis la webadmin de YunoHost, dans 'État du serveur', 'Réseau';

Une adresse IP locale ressemble généralement à `192.168.xx.yy`, ou `10.0.xx.yy`.

### 3. Rediriger les ports

Dans l'interface d'administration de votre box/routeur, il vous faut trouver
une catégorie comme 'Configuration du routeur', ou 'Redirections de ports'. Le
nom diffère suivant le type / marque de la box...

Il vous faut ensuite rediriger chacun des ports listés ci-dessous vers l'IP locale de votre serveur pour que les différents services de YunoHost fonctionnent. Pour chacun d'eux, une redirection 'TCP' est nécessaire. Certaines interfaces font référence à un port 'externe' et un port 'interne' : dans notre cas il s'agit du même.

* Web: 80 <small>(HTTP)</small>, 443 <small>(HTTPS)</small>
* [SSH](/ssh): 22
* [XMPP](/XMPP): 5222 <small>(clients)</small>, 5269 <small>(servers)</small>
* [Email](/email): 25, 587 <small>(SMTP)</small>, 993 <small>(IMAP)</small>

! [fa=exclamation-triangle /] Certains fournisseurs d'accès internet bloquent le port 25 (mail SMTP) par défaut pour combattre le spam. D'autres (plus rares) ne permettent pas d'utiliser librement les ports 80/443. En fonction de votre FAI, il peut être possible d'ouvrir ces ports dans l'interface... Voir [cette page](/isp) pour plus d'informations.

## Redirection automatique / UPnP

Une technologie nommée UPnP est disponible sur certains routeurs/box et permet de rediriger automatiquement des ports vers une machine qui le demande. Si UPnP est activé chez vous, exécuter cette commande devrait automatiquement rediriger les bons ports :

```bash
sudo yunohost firewall reload
```

