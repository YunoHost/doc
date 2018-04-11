#Accéder à son serveur depuis le réseau local

Après installation de votre serveur, il est probable que votre nom de domaine ne soit pas accessible depuis le réseau local où se trouve le serveur. Ceci est un problème connu sous le nom de [hairpinning](http://fr.wikipedia.org/wiki/Hairpinning).

Pour résoudre ce problème, il est nécessaire de configurer le DNS de votre routeur ou, à défaut, le ou les fichiers hosts de vos ordinateurs clients.

### Obtenir l’adresse IP locale du serveur
Afin de configurer le DNS ou le fichier hosts, il vous faut connaître l’adresse IP privée de votre serveur. Cette adresse est utilisable uniquement sur le réseau local où se trouve le serveur et n’est pas liée à votre adresse publique utilisée sur Internet.

Vous pouvez retrouver l’adresse privée de votre serveur de différentes manières :
- Sur l’écran de connexion de YunoHost sur le serveur lui-même :
<img src="/images/ynh_login.png" width=600>

- Depuis l’interface d’administration de votre serveur YunoHost :
    dans État du serveur > Réseau
<img src="/images/ynh_admin_etat_ip.png" width=900>

- Ou depuis votre routeur ou votre box, selon son modèle.

## Configurer le DNS de la box ou du routeur

L'idée ici est de créer une redirection qui sera active sur tout votre réseau. Le but est de créer une redirection DNS vers l'ip de votre serveur YunoHost dans votre box. Il faut donc accéder à l'interface de configuration de votre box et aux paramétrages DNS, puis créer la redirection locale (par exemple, yunohost.local renvoi sur 192.168.21).

### Box SFR
Si vous ne disposez toujours pas de l’adresse IP privée de votre serveur, vous pouvez la trouver sur l’interface de votre box SFR :  
    Dans l’onglet Réseau puis Général
<img src="/images/ip_serveur.png" width=800>

#### Configurer le DNS de la box SFR
Rendez-vous dans l’onglet Réseau puis DNS pour ajouter votre nom de domaine au DNS de la box.
<img src="/images/dns_9box.png" width=800>

## Configurer le fichier [hosts](http://fr.wikipedia.org/wiki/Hosts) de l’ordinateur client
La modification du fichier hosts devrait être effectuée seulement si vous ne pouvez pas modifier le DNS de votre box ou de votre routeur, car le fichier hosts impactera uniquement l’ordinateur sur lequel le fichier est modifié.

- Sous Windows, vous trouverez le fichier hosts ici :
    `%SystemRoot%\system32\drivers\etc\`
    > Il est nécessaire d’afficher les fichiers cachés et systèmes pour voir le fichier hosts.
- Sous les systèmes UNIX (GNU/Linux, Mac OS), vous le trouverez ici :
    `/etc/hosts`
    > Les droits root sont nécessaires pour modifier le fichier.

Ajoutez simplement à la fin du fichier hosts une ligne contenant l’adresse IP privée du serveur suivi de votre nom de domaine

```bash
192.168.1.62	domain.tld
```
