---
title: Domoticz
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_domoticz'
---

[![Installer Domoticz avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=domoticz) [![Integration level](https://dash.yunohost.org/integration/domoticz.svg)](https://dash.yunohost.org/appci/app/domoticz)

*Domoticz* est un système domotique open source très léger qui vous permet de surveiller et de configurer divers appareils.

### Avertissements/informations importantes

Domoticz est un système de domotique permettant de controler différents objets et de recevoir des données de divers senseurs Il peut par exemple être utilisé avec :

    des interrupteurs
    des senseurs de portes
    des sonnettes d'entrées
    des systèmes de sécurité
    des stations météo pour les UV, la pluie, le vent...
    des sondes de températures
    des sondes d'impulsions
    des voltmètres et bien d'autres

Version incluse : Toujours la dernière version stable. La dernière version compilée est récupérée dans ce répertoire lors de l'installation. Une fois installée, les mises à jour de l'application sont gérées depuis les menus de l'application elle même. Le script de mise à jour YunoHost mettra uniquement à jour de nouvelles version du package.

Le broker MQTT Mosquitto est intégré au package et nécessite un sous-domaine ou un domaine distinct. Il est optionnel et si vous indiquez lors de l'installation le même domaine que le domaine principal, il ne sera pas installé.

### Configuration

#### Broker MQTT Mosquitto

À l'installation, un broker MQTT, Mosquitto, est installé en même temps que Domoticz. La version installée est celle du dépot officiel du projet, et non des dépots Debian. Ce broker nécessite un domaine ou un sous-domaine particulier pour fonctionner (ex : mqtt.your.domain.tld). Il est nécessaire de créer ce domaine auparavant.

##### Ajout dans Domoticz

Pour pouvoir l'utiliser, vous devez paramétrer la communication avec entre Domoticz et le broker en suivant la documentation de Domoticz dans la partie Add hardware "MQTT Client Gateway". Les utilisateurs et mot de passe du broker sont automatiquement générés lors de l'installation. Vous pouvez les récupérer avec
```
sudo yunohost app setting domoticz mqtt_user
sudo yunohost app setting domoticz mqtt_pwd
```

##### Publier/souscrire

Par défaut, Mosquitto va écouter sur deux ports :

    Le 1883 sur localhost en protocole MQTT
    Le 8883 en protocole WebSocket. NGINX redirige le port 443 externe vers ce port en interne. Pour publier/souscrire sur un topic depuis l'exterieur, vous devez donc utiliser un programme supportant le protocole WebSocket (ex : la bibliothèque Python paho-mqtt).

##### Mosquitto_pub et mosquitto_sub

Ces deux programmes ne supportent pas le protocole WebSocket mais uniquement le MQTT : le paramétrage de base ne vous autorise donc pas à les utiliser pour communiquer depuis un client externe. Si vous les utilisez directement depuis votre serveur, ce genre de syntaxe devrait marcher :

`mosquitto_pub -u *user* -P *password* -h mqtt.your.domain.tld -p 1883 -t 'domoticz/in' -m '{ "idx" : 1, "nvalue" : 0, "svalue" : "25.0" }'`

De la même manière :

`mosquitto_sub -u *user* -P *password* -h mqtt.your.domain.tld -p 1883 -t 'domoticz/out'`

Si vous souhaitez ouvrir le protocole MQTT depuis l'extérieur afin de pouvoir les utiliser depuis un autre serveur, il vous faudra :

    ouvrir le port 1883 sur le firewall YunoHost (attention, risque de sécurité)
    autoriser les adresses IP souhaitées dans la configuration de Mosquitto
    paramétrer le TLS dans la configuration de Mosquitto en donnant accès au crt.pem et key.pem de votre domaine MQTT en les paramétrant respectivement avec les variables certfile et keyfile. Ceci est obligatoire pour sécuriser la connexion.

##### Mise à jour depuis les versions n'ayant pas Mosquitto

Si vous êtes sur le package ynh3 ou inférieur, Mosquitto n'est pas installé par défaut. De même si vous avez choisi de ne pas indiquer de domaine pour Mosquitto lors de l'installation initiale. Pour pouvoir l'installer après coup, effectuez les actions suivantes :

    créez un domaine ou sous-domaine pour recevoir les informations (par exemple : 'mqtt.your.domain.tld')
    connecter vous en ligne de commande à votre serveur
    tapez la commande suivante : `yunohost app setting domoticz mqtt_domain -v mqtt.your.domain.tld`
    Procédez à la mise à jour. Si vous êtes déjà sur la dernière version, utiliser la commmande suivante : `yunohost app upgrade domoticz --force`

### Configuration

#### Capteurs, langue...

Toute la configuration de l'application a lieu dans l'application elle-même.

#### Access et API

Par défaut, l'accès aux API JSON est autorisé sur cette URL `/votredomaine.tld/api_/chemindedomoticz`. Donc, si vous accédez à domoticz par `https://votredomaine.tld/domoticz`, utilisez le chemin suivant pour l'api : `/votredomaine.tld/api_/domoticz/json.htm?votrecommandeapi`

Par défaut, seuls la mise à jour de capteur et les interrupteurs sont autorisés. Pour autoriser une nouvelle commande, vous devez (pour l'instant) manuellement éditer le fichier de configuration NGINX :

`sudo nano /etc/nginx/conf.d/yourdomain.tld.d/domoticz.conf`

Puis éditer le bloc suivant en y ajoutant le regex de la commmande à autoriser :
```
  #set the list of authorized json command here in regex format
  #you may retrieve the command from https://www.domoticz.com/wiki/Domoticz_API/JSON_URL's
  #By default, sensors updates and toggle switch are authorized
  if ( $args ~* type=command&param=udevice&idx=[0-9]*&nvalue=[0-9]*&svalue=.*$|type=command&param=switchlight&idx=[0-9]*&switchcmd=Toggle$) {
    set $api "1";
    }
```

Par exemple, pour ajouter la commmande json pour retrouver le statut d'un équipement (`/json.htm?type=devices&rid=IDX`),il faut modifier la ligne comme ceci :
```
  #set the list of authorized json command here in regex format
  #you may retrieve the command from https://www.domoticz.com/wiki/Domoticz_API/JSON_URL's
  #By default, sensors updates and toggle switch are authorized
  if ( $args ~* type=command&param=udevice&idx=[0-9]*&nvalue=[0-9]*&svalue=.*$|type=command&param=switchlight&idx=[0-9]*&switchcmd=Toggle$|type=devices&rid=[0-9]* ) {
    set $api "1";
    }
```
Toutes les adresses IPv4 du réseau local (192.168.0.0/24) et toutes les adresses IPv6 sont autorisées pour l'API. À ma connaissance, il n'y a pas moyen d'effectuer un filtre pour les adresses IPv6 sur le réseau local, vous pouvez donc retirer leur autorisation en enlevant ou en commentant la ligne suivante dans `/etc/nginx/conf.d/yourdomain.tld.d/domoticz.conf` :

`allow ::/1;`

Ceci autorisera seulement les adresses IPv4 local a accéder aux API de Domoticz. Vous pouvez ajouter des adresses IPv6 de la même façon.

### Limitations

    Pas de gestion d'utilisateurs ni d'intégration LDAP. L'application ne prévoit pas de gérer les utilisateurs par LDAP, donc le package non plus.
    Un backup ne peut pas être restauré sur un type de machine différente de celle d'origine (x86, arm...) car les sources compilées doivent être différentes

## Liens utiles

+ Site web : [domoticz.com](https://domoticz.com/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/domoticz](https://github.com/YunoHost-Apps/domoticz_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/domoticz/issues](https://github.com/YunoHost-Apps/domoticz_ynh/issues)
