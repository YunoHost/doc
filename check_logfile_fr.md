## Consulter les fichiers de log du système

### Accéder à un fichier de log
#### Via l’interface d’administration
[Administration web](admin_fr)

#### En ligne de commande
Un fichier de log est un simple fichier texte utilisé par certains programmes du système (et notamment les services) pour inscrire l’historique de leur fonctionnement. Consulter un fichier de log consiste donc à afficher son contenu pour lire les messages qui s'y trouve.

Pour accéder aux fichiers de log, la méthode traditionnelle consiste à [se connecter au serveur en ligne de commande via SSH](ssh_fr). Un fois connecté, utilisez la commande `tail` qui affiche uniquement la fin du fichier, car les fichiers de log sont très long et qu’uniquement l’historique récent nous intéresse.

### Services
#### Courriel
* Postfix
* Dovecot
* mail.log
* amavis

#### Serveur web
* Nginx
* php5-fpm

#### Serveur XMPP metronome
* Metronome

#### Surveillance du serveur
* Glances

#### Bases de données
* MySQL
* Postgrey

#### SSH

#### yunohost-api

#### Torrents
* transmission-daemon

#### LDAP
* slapdStatut

#### DNS
* Dnsmasq
* Bind9