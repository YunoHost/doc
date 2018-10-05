# Interface utilisateur

L'interface utilisateur est un portail permettant à un utilisateur connecté de voir toutes les applications qu'il peut
utiliser, et y accéder. Cette interface permet aussi à l'utilisateur de gérer ses paramètres (changer de mot de passe, 
définir ses alias et redirections courriel).

<img src="/images/home_panel.jpg" width=800>

### Problème d’accès

L’accès à la partie utilisateur peut se faire uniquement avec un nom de domaine. Vous ne pouvez pas y accéder en utilisant l’adresse IP locale de votre serveur comme suit : https://adresse.ip.du.server/yunohost/sso

Vous pouvez créer une redirection d’un nom de domaine vers l’adresse IP du serveur en modifiant `/etc/hosts` et en ajoutant cette ligne :

```bash
adresse.ip.du.server domaine.tld
```

En remplaçant `adresse.ip.du.server` par exemple par `192.168.1.5` et `domaine.tld` par votre nom de domaine ou par un nom de domaine que vous pouvez choisir si vous n’en avez pas.

### Logiciel

L’interface utilisateur est basé sur le logiciel suivant : https://github.com/Kloadut/ssowat
