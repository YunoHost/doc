#Configuration DNS avec OVH

Nous allons voir comment configurer le DNS avec [OVH](http://www.ovh.com).

Après achat de votre nom de domaine. Sélectionnez votre nom de domaine.

<img src="https://yunohost.org/images/OVH1_domain_select.png" width=400>

Allez dans **Domaine & DNS** :

<img src="https://yunohost.org/images/OVH2_domain_DNS.png" width=250>

Puis, allez dans **Zone DNS** :

<img src="https://yunohost.org/images/OVH3_zoneDNS.png" width=600>

<Voici la page de configuration des zones DNS

OVH4

Avec l’édition texte.

OVH5>

À l'endroit de configuration de la zone DNS, mettez-vous en édition texte, et utilisez la [configuration DNS standard](/dns_config_fr).

###IP dynamique

[Tutoriel plus général sur l'IP dynamique](dns_dynamicip_fr).

Cette partie est à suivre que si votre IP est dynamique.

Pour savoir si votre fournisseur d'accès internet vous fourni une IP dynamique [voir ici](/isp_fr).

Commencez par créer un identifiant DynHost.

Suivez [ce tutoriel](http://blog.developpez.com/brutus/p6316/ubuntu/configurer_dynhost_ovh_avec_ddclient) pour l'intallation de ddclient.
ddclient annonce à OVH le changement d'IP. OVH vas alors changer votre IP.

Il faut ajouter dans le fichier de configuration :
* votre identifiant et votre mot de passe DynHost
* votre nom de domaine
