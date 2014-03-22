#Configuration DNS avec OVH
Nous allons voir comment configurer le DNS avec [OVH](http://www.ovh.com).

À l'endroit de configuration de la zone DNS, mettez-vous en éditon texte, copiez le texte ci-dessous, completez les <…> et effacez les exemples.

```bash
@ 10800 IN A <votre IP publique> (exp. : 136.186.4.7)
@ 10800 IN MX 10 <votre-nom-domaine.tld.> (exp. : yunohost.org.)
_xmpp-client._tcp 10800 IN SRV 0 5 5222 <votre-nom-domaine.tld.>
_xmpp-server._tcp 10800 IN SRV 0 5 5269 <votre-nom-domaine.tld.>
@ 10800 IN TXT "v=spf1 a mx -all"
```

N'oubliez pas le point à la fin de votre nom de domaine.

###IP dynamique :

Cette partie est à suivre que si votre IP est dynamique.

Pour savoir si votre fournisseur d'accès internet vous fourni une IP dynamique [voir ici](/isp_fr).

Commencez par créer un identifiant DynHost.

Suivez [ce tutoriel](http://blog.developpez.com/brutus/p6316/ubuntu/configurer_dynhost_ovh_avec_ddclient) pour l'intallation de ddclient.
ddclient annonce à OVH le changement d'IP. OVH vas alors changer votre IP.

Il faut ajouter dans le fichier de configuration :
* votre identifiant et votre mot de passe DynHost
* votre nom de domaine
