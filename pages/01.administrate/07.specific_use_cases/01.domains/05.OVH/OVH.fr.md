---
title: Configuration DNS avec OVH
template: docs
taxonomy:
    category: docs
routes:
  default: '/OVH'
---

Nous allons voir comment configurer le DNS avec [OVH](http://www.ovh.com).

Après achat de votre nom de domaine, rendez-vous dans l'espace client pour retrouver le panneau de configuration d'OVH, et cliquez sur votre domaine à gauche :

![](image://ovh_control_panel.png?resize=800)

Cliquez sur l'onglet **Zone DNS**, puis sur **Ajouter une entrée** :

![](image://ovh_dns_zone.png?resize=800)

Cliquer sur "Modifier en mode textuel", garder les 4 premières lignes :
```bash
$TTL 3600
@	IN SOA dns104.ovh.net. tech.ovh.net. (2020083101 86400 3600 3600000 60)
                         IN NS     dns104.ovh.net.
                         IN NS     ns104.ovh.net.
```
puis effacer tout ce qu'il y a en-dessous, et le remplacer par la configuration donnée par votre serveur, comme indiqué dans la [configuration DNS standard](/dns_config).


### IP dynamique

[Tutoriel plus général sur l’IP dynamique](/dns_dynamicip).

Cette partie est à suivre, que si votre IP est dynamique.

Pour savoir si votre fournisseur d’accès internet vous fournit une IP dynamique [voir ici](/isp).

Commencez par créer un identifiant DynHost.

Suivez [ce tutoriel](http://blog.developpez.com/brutus/p6316/ubuntu/configurer_dynhost_ovh_avec_ddclient) pour l’installation de ddclient.
ddclient annonce à OVH le changement d’IP. OVH va alors changer votre IP.

Il faut ajouter dans le fichier de configuration :
* votre identifiant et votre mot de passe DynHost
* votre nom de domaine

Il existe un [guide d'utilisation DynHost fait par OVH](https://docs.ovh.com/fr/fr/web/domains/utilisation-dynhost/).
