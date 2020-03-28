# Guide de dépannage de YunoHost

Vous pouvez considérer ce guide comme une sorte de guide de dépannage permettant de voir ce qu’il faut regarder quand vous rencontrez un problème avec votre serveur YunoHost. Ce n’est pas un guide pour remettre en état votre instance YunoHost mais plutôt une liste de choses à vérifier pour aider à diagnostiquer les problèmes rencontrés.
Ce guide peut trouver son intérêt lors du débuggage d’une nouvelle application ou pour comprendre l’architecture de Yunohost.

## Notes générales
### Ne cassez pas YunoHost
La meilleure manière de ne pas avoir de pannes est de ne pas bricoler sur votre serveur. Cela signifie que dès que vous souhaitez essayer quelque chose de nouveau (application non officielle, nouvelle configuration personnalisée, création d’une nouvelle application), essayez d'abord cela sur un serveur de test et non de production. Pour faire cela, vous pouvez par exemple utiliser une [virtualbox](install_on_virtualbox_fr) ou un [droplet DigitalOcean](install_on_vps_fr) pour 1 centime/heure.

Vous pouvez aussi lire ceci si vous avez encore envie de bricoler sur votre instance YunoHost en production : https://wiki.debian.org/DontBreakDebian

### N'installez pas d'applications de mauvaise qualité

Bien que ce soit tentant d’installer toutes les [applications](https://yunohost.org/#/apps), faites attention à leur niveau de qualité car une mauvaise application peut casser votre serveur. Si la qualité d'une application laisse à désirez mais que vous souhaitez tout de même absolument l'installer, essayez de faire ça sur un serveur de test, ou vérifiez au minimum si des problèmes ont été remontés sur le dépôt Github associé ou bien sur le [forum](http://forum.yunohost.org/).

### Vérifier la documentation officielle
Les réponses à vos questions existent peut être déjà dans [la documentation](docs_fr).

### Vérifier l’aide dans les commandes en ligne
Vous pouvez apprendre à utiliser les [commandes YunoHost](/commandline_fr)

## Mise à jour
Les problèmes ont souvent lieu après une mise à jour. Après une mise à jour, vous pouvez avoir envie de [mettre à jour votre application](app_update_fr).


**Vérifier si un processus utilise une ancienne librairie**
vous avez sûrement l’habitude d’utiliser :
```bash
$ apt update && apt dist-upgrade
```
La plupart du temps, cela suffit. Mais dans certaines situations, il est possible que certains processus utilisent toujours d’anciennes bibliothèques non mises à jour. 
Cela peut entraîner des bugs et, dans certains rares cas, des problèmes de sécurité (ex : lors d’une mise à jour de OpenSSL à cause d’une faille de sécurité, Nginx va continuer à utiliser la version dont il dispose en mémoire). L’utilitaire Checkrestart va vous aider à identifier ces processus et les redémarrer.

```bash
$ apt install debian-goodies
checkrestart
# Found 0 processes using old versions of upgraded files
```
Si des processus fonctionnent avec des vieilles versions de bibliothèques, checkrestart va vous le dire et vous proposer une manière de les redémarrer. Il est possible que checkrestart ne trouve pas de manière de les redémarrer. Attention, il faut opérer l’opération manuellement.

<img src="/images/checkstart.png" width=600>

La solution la plus simple peut être de redémarrer si vous pouvez

Vous pouvez aussi utiliser [ce script](https://github.com/octopuce/octopuce-goodies/blob/master/checkrestart/checkrestart.octopuce) pour redémarrer automatiquement ces services si besoin. Plus d’informations [ici](https://www.octopuce.fr/checkrestart-outil-pratique-de-debian-goodies-et-version-octopuce/).

**Forcer une mise à jour d’une application non officielle**

/!\ Pensez toujours à vérifier s’il existe un script de mise à jour et lisez-le si vous pouvez/!\


```bash
$ yunohost app upgrade
Warning: You must provide an URL to upgrade your custom app app_name
Error: No app to upgrade

$ yunohost app upgrade -u https://github.com/user/someapp_ynh app_name
```

## Les services
YunoHost utilise toute une série de logiciels pour fonctionner. La plupart de ces logiciels sont déclarés comme des services dans Debian [plus d’info](whatsyunohost_fr).

### Vérifier le statut des services
Quand quelque chose ne fonctionne pas, une des premières choses à faire est de vérifier que tous les services utilisés par YunoHost sont lancés.
YunoHost inclus un outil qui permet de visualiser tous les services utilisés par YunoHost :
```bash
yunohost service status
```
Exemple de résultat :

<img src="/images/services_status.png" width=210>

Tous les services doivent être activés (enabled) et en fonctionnement (running) sauf Glances (optionnel). Si certains ne le sont pas, essayez de les redémarrer. 
Voici une petite description de leurs fonctions respectives :

- **Amavis** : anti-spam/virus/malwares, utilisé lors de l’échange de mails.
- **Avahi-daemon** : système qui facilite la découverte d’ordinateurs sur le réseau local en leur attribuant des noms.
- **DNSmasq** : serveur DNS, vous n’êtes pas obligé de l’utiliser (Non installé par défaut)
- **Dovecot** : serveur IMAP, utilisé pour la réception de mails.
- **Glances** : optionnel, utilisé pour l’administration web pour afficher les statuts du serveur
- **Metronome** : serveur XMPP utilisé par jappix comme client.
- **MySQL** : base de données utilisée par certaines applications
- **Nginx** : serveur web, utilisé par toutes les applications
- **php5-fpm** : serveur PHP, utilisé par toutes applications utilisant PHP
- **Postfix** : serveur SMTP, utilisé pour l’envoi de mails.
- **Postgrey** : serveur de listes grises, si vous utilisez YunoHost pour les mails, vous devriez regarder un peu plus sur cette question.
[En apprendre plus sur les listes grises](http://en.wikipedia.org/wiki/Greylisting)
- **Slapd** : serveur LDAP, utilisé pour l’authentification (SSO and apps)
- [**SSH**](/ssh_en) : Secure Shell, utilisé pour l’accès distant au serveur.
- [**SSOwat**](https://github.com/Kloadut/SSOwat/) : gestionnaire simple d’authentification.
- **YunoHost-API** : administration web de YunoHost

Les autres services installés par des applications vont aussi apparaître. Par exemple `seafile-serve` utilisé par l’application Seafile et `uwsgi` qui est utilisé par des applications python comme Searx.
##### démarrer ou arrêter un service identifié avec YunoHost :
```bash
yunohost service start <servicename>
yunohost service stop <servicename>
```
Vous pouvez aussi utiliser la commande Debian :
```bash
systemctl start/stop/restart/reload <servicename>
```
Après une tentative de lancement, vérifiez toujours que le service est lancé.

### Logs
Si un service ne démarre pas, vous devez vérifier les logs pour voir ce qui ne pose problème. Il n’y a pas de règles définies où les services doivent stocker leurs logs. Cependant, ceux-ci se trouvent pour la plupart dans :  
```bash
/var/log/
```
Voici quelques fichiers de log utiles pour YunoHost :
##### auth.log
Il contient les connexions ou tentatives de connexion à votre serveur. Il inclut aussi toutes les connexion web, ssh et cron job (tâches répétitives). Il stoque enfin toutes les tentatives (on l’espère) de connexion par des potentiels intrus.

##### fail2ban.log
Quand quelqu’un tente de se connecter à votre serveur et rate plusieurs fois, Fail2ban bannit l’adresse IP afin d’éviter les attaques en bruteforce et/ou en (D)DOS. Vous pouvez donc trouver ici les IP qui auront été bannies.

##### mail.err, mail.info, mail.log, mail.warn
Ce sont les logs de Postfix pour le serveur de mail. Vous pouvez les consulter si vous rencontrez des problèmes avec les mails.

##### metronome/metronome.err, metronome/metronome.log
Logs du serveur de chat XMPP

##### mysql.err, mysql.log, mysql/error.log
Logs de la base de données MySQL. Ils doivent être vides sauf si vous avez des problèmes avec MySQL.

##### php7.0-fpm.log
Lieu générique d’emplacement des logs pour les applications PHP.

##### yunohost.log
C’est le fichier de log créé à l’installation de YunoHost. Si vous rencontrez des problèmes à l’installation de YunoHost, vérifier ce fichier.

Cette liste n’est pas exhaustive. De plus, certaines applications peuvent aussi mettre leurs fichiers de log dans `/var/log`.
Les logs de Slapd sont malheureusement stockés dans`/var/log/syslog`.

## Utilisation de la RAM
Des problèmes peuvent être causés par un manque de RAM. Pour vérifier votre utilisation de la RAM, entrez la commande suivante :
```bash
free -m
```
<img src="/images/free_m.png" width=600> 

5 à 10 % de mémoire libre est acceptable, mais il est bien de disposer d’une marge (en particulier pour les mises à jour). Comme la plupart du temps, vous ne pouvez pas augmenter votre quantité de RAM, vous avez la possibilité d’utiliser une partition de SWAP (mémoire du disque dur attribuée à la RAM).
Gardez à l’esprit que le SWAP est une mémoire 100 000 fois plus lente, vous devriez donc l’utiliser uniquement si vous n’avez pas d’autre choix.

##### créer un fichier de swap :
Si `free -m` indique que vous n’avez aucune ligne de SWAP, vous pouvez avoir envie d’ajouter un fichier de SWAP.
```bash
sudo install -o root -g root -m 0600 /dev/null /swapfile
dd if=/dev/zero of=/swapfile bs=1k count=512k
mkswap /swapfile
swapon /swapfile
echo "/swapfile       swap    swap    auto      0       0" | sudo tee -a /etc/fstab
sudo sysctl -w vm.swappiness=10
echo vm.swappiness = 10 | sudo tee -a /etc/sysctl.conf
```

Changez 512 avec la quantité de mémoire SWAP que vous voulez. 
512 Mio devrait être suffisant pour YunoHost. Après quoi, vérifiez que votre swap est activé avec `free -m`.
[Source avec plus d’explication](https://meta.discourse.org/t/create-a-swapfile-for-your-linux-server/13880).

## Espace disque
Un des autres problèmes communs des serveurs est le manque d’espace disque.
Vous pouvez vérifier que votre disque n’est pas plein avec la commande :
```bash
df -h
```
Cela va vous montrer l’utilisation du disque. Si une partition système est presque pleine, vous pouvez rencontrer des problèmes. Vous devez alors réaliser les opérations appropriées pour gagner de l’espace libre sur le disque ou étendre la capacité de celui-ci.


<img src="/images/df_h.png" width=400>


## Nginx
Nginx joue un grand rôle dans YunoHost puisqu’il fournit toutes les applications web.
YunoHost a une manière particulière de gérer la configuration puisqu’il existe plusieurs domaines et plusieurs applications.

### Configuration
##### Configuration générale de la structure
```bash
# Configuration principale de Nginx, vous ne devriez pas toucher ce fichier
/etc/nginx/nginx.conf
# Dossier où les configurations de toutes les applications et domaines sont situées
 /etc/nginx/conf.d/
# Configuration de l’administration web
/etc/nginx/conf.d/yunohost_admin.conf
# Configuration par domaine (une par domaine)
 /etc/nginx/conf.d/example.com.conf
```

##### Configuration des applications
Pour chaque application ou domaine donné, il y a un fichier de configuration Nginx situé dans :
```bash
/etc/nginx/conf.d/example.com.d/nom_de_application.conf
```
Les fichiers de configuration sont généralement utilisés pour ce genre de modèle

```bash
location YNH_WWW_PATH { # Chemin pour atteindre votre application dans le navigateur
alias YNH_WWW_ALIAS ; # chemin pour accéder aux sources des fichiers aux fichiers (d’habitude /var/www/app_name)

# Configuration particulière pour une application selon son langage de programmation et ses options de déploiement.

# Inclure le logo SSOwat en bas à droite de la fenêtre
include conf.d/yunohost_panel.conf.inc;
}
```

### Les logs
Les fichiers de log de Nginx sont situés dans le dossier :

```bash
/var/log/nginx/
```
#### Logs génériques
##### access.log
Le fichier générique d’accès. Vous trouverez ici toutes les tentatives d’accès à l’administration de YunoHost et certaines tentatives d’intrusion.

##### error.log
Ce fichier devrait être vide avec une configuration correcte de Nginx. Si Nginx ne démarre pas, des informations sur les erreurs devraient se trouver dans ce fichier.


#### Pour chaque nom de domaine
##### example.com-access.log
Tous les accès à ce domaine (en prenant en comptes toutes les applications).

##### example.com-error.log
Toutes les erreurs liées aux applications installées sur ce domaine, il se peut que certaines applications aient tous leurs logs soit dans ce fichier.


## SSOwat
[SSowat](https://github.com/Kloadut/SSOwat) 
est le logiciel qui connecte le serveur web nginx au serveur LDAP. Son but est d’authentifier les utilisateurs au portail YunoHost pour pouvoir simplement se déplaçer entre les applications.

### Configuration
Vous pouvez regarder le fichier de configuration SSOwat dans le fichier :

```bash
/etc/ssowat/conf.json
```
Celui-ci est généré avec la commande 
```bash
sudo yunohost app ssowatconf
```
Astuce : si vous souhaitez mettre en place des règles personnalisées dans le SSOwat, vous pouvez le faire dans ce fichier :
```bash
/etc/ssowat/conf.json.persistent
```
### Logs
Il n’y a pas de fichier de log spécifiques pour SSOwat. Ils sont situés dans les fichiers de log de Nginx. Si vous voyez des lignes avec `lua` à l’intérieur, il s’agit probablement de logs de SSOwat.

## YunoHost
### Configuration
La configuration de Yunohost est située ici
```bash
/etc/yunohost/
```
Si vous souhaitez utiliser et conserver un fichier de configuration personnalisé, utiliser ce fichier :
```bash
/etc/yunohost/yunohost.conf
```
Pour tous les services avec la mention `yes`, YunoHost ne réalisera pas de mise à jour des services spécifiés.
Ne faites ça que si vous savez ce que vous faites. 

Toutes les configurations d’applications sont situées dans :
```bash
/etc/yunohost/apps/app_name/
```
Dans chaque paquet (d’application), vous trouverez :


* **manifest.json** : manifeste de l’application
* **scripts/** : dossier contenant cinq scripts Shell pour gérer l’application.
 * install
 * upgrade
 * remove
 * backup
 * restore
* **config/** : dossier de configuration
* **settings.yml** : La configuration de l’application, aussi accessible via :
```bash
sudo yunohost app setting appname settingname
```

### Logs
Il n’y a pas de fichier de log créé lorsque vous installez une application. Essayez de conserver les logs. Vous pouvez trouver cependant certains logs peuvent se trouver dans :
```bash
/var/log/yunohost/
```

## Applications
Cette partie concerne plus les créateurs d’applications YunoHost mais permet néanmoins de comprendre le lien entre Nginx et les applications web.

Premièrement, vous devez savoir [comment créer un paquet pour une nouvelle application](packaging_apps_fr).

Quand vous bricolez une application, des erreurs peuvent avoir lieu selon certains niveaux d’importance. Il y a une grande variété d’applications et le déploiement de celles-ci va dépendre du langage de programmation de l’application.
Nous allons voir ici les « cas classiques ». 
La configuration des applications n’est pas abordée ici car leurs configurations respectives peuvent énormément varier.

##### Schéma simplifié
Navigateur web −> Nginx <− (serveur web) <− interpréteur (PHP, Python, Node.js…) <− app

L’application est exécutée par l’interpréteur, celui-ci peut potentiellement fournir un serveur web. Le runtime ou le serveur web va communiquer avec Nginx et ce dernier servira des pages au navigateur web. 

Le but de cette configuration est d’avoir plusieurs applications sur un seul serveur avec seulement le port https ouvert à l’internet entier.

### Applications PHP
##### Options de déploiement
PHP fonctionne nativement avec Nginx

##### La communication avec Nginx
L’interpréteur PHP communique avec Nginx par [PHP-FPM](http://php-fpm.org/)
qui est une implémentation de [FastCGI](http://en.wikipedia.org/wiki/FastCGI) implémentation.

##### Les logs
```bash
/var/log/php5-fpm.log
```
**Exemple de paquet YunoHost** : [Owncloud](https://github.com/Kloadut/owncloud_ynh).

### Applications Python 
##### Options de déploiement
Une application python devrait fonctionner avec son propre interpréteur Python et ses propres dépendances. Pour cela, on peut utiliser l’outil `virtualenv`.
D’habitude, un serveur web léger sera utilisé pour fournir l’application derrière Nignx [Uwsgi](https://uwsgi-docs.readthedocs.org/en/latest/) est un bon exemple.


##### La communication avec Nginx
Nginx communique de trois manières avec Python :

- [proxy_pass](http://nginx.org/en/docs/http/ngx_http_proxy_module.html#proxy_pass)
- Websocket
- Native uwsgi : uwsgi_pass : [par exemple](https://github.com/abeudin/searx_ynh/blob/master/conf/nginx.conf#L9-L10)

##### Logs
Logs spécifiques à l’application et/ou au serveur web, par exemple uwsgi :
```bash
/var/log/uwsgi/
```
##### Ressources
[Bonnes ressources en français sur Python et virtualenv](http://sametmax.com/les-environnement-virtuels-python-virtualenv-et-virtualenvwrapper/)

**Exemple de paquet YunoHost en Python** : [Searx](https://github.com/abeudin/searx_ynh)

### Applications Node.js 
##### Options de déploiement
Une application Node.js a son propre serveur web intégré dans l’interpréteur Node. D’habitude, Node va exposer l’application sur un port TCP.

##### Communication avec Nginx
Le point d’accès http va être réalisé en local vers Nginx via proxy_pass.

##### Les Logs
Cela va être spécifique aux applications.

**Exemple de paquet YunoHost en Node.js :** [Etherpad-Lite](https://github.com/abeudin/etherpadlite_ynh).

**Note** : les processus Node peuvent utiliser **beaucoup** de mémoire comparée aux processus des autres applications. Assurez-vous donc d’en avoir assez.

### Autres (Go, Java…)
Les webapp peuvent être déployées de nombreuses manières.
Les applications Go ont généralement un serveur web intégré, Java peut être déployé avec Tomcat ou une autre solution équivalente. Il n’est pas possible d’être exhaustif ici mais la plupart du temps, les déploiements vont exposer une adresse en http que vous pourrez passer dans Nginx via proxy_pass.

##### Note sur Apache
Ne jamais installer le serveur web Apache ou un paquet avec Apache comme dépendance, cela va sûrement casser l’instance YunoHost.

##### Note sur https
Parfois, le serveur web intégré avec l’application est capable de servir du https lui-même.
C’est une bonne chose de l’utiliser quand vous disposez d’une application sans Nginx devant. Dans le cadre de YunoHost, le fait que Nginx serve du https simplifie la configuration. Donc, quand vous passez par proxy_pass, utilisez http et Nginx le mettra a disposition en https pour le reste de l’internet.
