#Configuration DNS avec OVH

Nous allons voir comment configurer le DNS avec [OVH](http://www.ovh.com).

Après achat de votre nom de domaine, rendez vous dans l'espace client pour retrouver le panneau de configuration d'OVH, et cliquez sur votre domaine à gauche:

<img src="/images/ovh_control_panel.png" width=800>

Cliquez sur l'onglet **Zone DNS**, puis sur **Ajouter une entrée**:

<img src="/images/ovh_dns_zone.png" width=800>

Il suffit maintenant d'ajouter les redirections DNS comme indiqué dans la [configuration DNS standard](/dns_config_fr).


###IP dynamique

[Tutoriel plus général sur l’IP dynamique](dns_dynamicip_fr).

Cette partie est à suivre, que si votre IP est dynamique.

Pour savoir si votre fournisseur d’accès internet vous fournit une IP dynamique [voir ici](/isp_fr).

Commencez par créer un identifiant DynHost.

Suivez [ce tutoriel](http://blog.developpez.com/brutus/p6316/ubuntu/configurer_dynhost_ovh_avec_ddclient) pour l’installation de ddclient.
ddclient annonce à OVH le changement d’IP. OVH va alors changer votre IP.

Il faut ajouter dans le fichier de configuration :
* votre identifiant et votre mot de passe DynHost
* votre nom de domaine

Il existe un [guide d'utilisation DynHost fait par OVH](https://docs.ovh.com/fr/fr/web/domains/utilisation-dynhost/).
