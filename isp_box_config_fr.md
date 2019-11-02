# Configurer la redirection des ports

Si vous vous auto-hébergez à la maison et sans VPN, il vous faut rediriger les ports de votre routeur ("machin-box"). Si vous souhaitez une explication courte de ce qu'est et pourquoi vous avez besoin de rediriger les ports, vous pouvez jeter un œil à [cette page-ci](port_forwarding_fr). [Cette page-là](https://craym.eu/tutoriels/utilitaires/ouvrir_les_ports_de_sa_box.html) propose également des explications détaillées sur le fonctionnement des ports, et les étapes de configuration pour différents routeurs.

### 0. Diagnostiquer les ports ouverts

Une fois que vous aurez configuré la redirection, vous devriez pouvoir valider avec ce petit outil que vos ports sont bien redirigés :

<a class="btn btn-default" href="http://ports.yunohost.org">Vérifier la redirection des ports</a>

### 1. Accéder à l'interface d'administration de votre box/routeur

L'interface d'administration est généralement accessible via http://192.168.0.1 ou http://192.168.1.1.
Ensuite, il vous faudra peut-être vous authentifier avec les identifiants
fournis par votre fournisseur d'accès internet (FAI).

### 2. Trouver l'IP locale de votre serveur

Identifiez quelle est l'IP locale de votre serveur, soit :
- depuis l'interface de votre routeur/box, qui liste peut-être les dispositifs
  connectés;
- depuis la webadmin de YunoHost, dans 'État du serveur', 'Réseau';
- depuis la ligne de commande dans votre serveur, par exemple avec `ip a | grep "scope global" | awk '{print $2}'`.

Une adresse IP locale ressemble généralement à `192.168.xx.yy`, ou `10.0.xx.yy`.

### 3. Rediriger les ports

Dans l'interface d'administration de votre box/routeur, il vous faut trouver
une catégorie comme 'Configuration du routeur', ou 'Redirections de ports'. Le
nom diffère suivant le type / marque de la box...

Il vous faut ensuite rediriger chacun des ports listés ci-dessous vers l'IP locale de votre serveur pour que les différents services de YunoHost fonctionnent. Pour chacun d'eux, une redirection 'TCP' est nécessaire. Certains interfaces font références à un port 'externe' et un port 'interne' : dans notre cas il s'agit du même.

* Web: 80 <small>(HTTP)</small>, 443 <small>(HTTPS)</small>
* [SSH](/ssh_fr): 22
* [XMPP](/XMPP_fr): 5222 <small>(clients)</small>, 5269 <small>(servers)</small>
* [Email](/email_en): 25, 587 <small>(SMTP)</small>, 993 <small>(IMAP)</small>

<div class="alert alert-warning" markdown="1">
<span class="glyphicon glyphicon-warning-sign"></span> Certains fournisseurs d'accès internet bloquent le port 25 (mail SMTP) par défaut pour combattre le spam. D'autres (plus rares) ne permettent pas d'utiliser librement les ports 80/443. En fonction de votre FAI, il peut être possible d'ouvrir ces ports dans l'interface... Voir [cette page](isp_fr) pour plus d'informations.
</div>

## Redirection automatique / UPnP

Une technologie nommée UPnP est disponible sur certains routeurs/box et permet de rediriger automatiquement des ports vers une machine qui le demande. Si UPnP est activé chez vous, exécuter cette commande devrait automatiquement rediriger les bons ports :

```bash
sudo yunohost firewall reload
```

