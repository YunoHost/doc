---
title: Matrix Signal bridge
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_mautrix_signal'
---

[![Installer Matrix Signal bridge avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=mautrix_signal) [![Integration level](https://dash.yunohost.org/integration/mautrix_signal.svg)](https://dash.yunohost.org/appci/app/mautrix_signal)

*Matrix Signal bridge* est une passerelle entre Matrix et Signal empaquetée comme un service YunoHost. Les messages, médias et notifications sont relayées entre un compte Signal et un compte Matrix. 
La passerelle ["Mautrix-Signal"](https://docs.mau.fi/bridges/python/signal/index.html) consiste en un Service d'Application Matrix-Synapse et repose sur une base-de-données postgresql. C'est pourquoi [Synapse for YunoHost](https://github.com/YunoHost-Apps/synapse_ynh) doit être préalablemnet installé.

** Attention : sauvegardez et restaurez toujours les deux applications Yunohost matrix-synapse et mautrix_signal en même temps!**.

### Avertissements / informations importantes

#### Liste de passerelles publiques

* Demandez sur un des salons suivants: `#mautrix_yunohost:matrix.fdn.fr` ou `#signal:maunium.net`

### Usages de la passerelle
** Notez que plusieurs comptes Signal et Matrix peuvent être relayés, chaque compte Signal connecté a son propre Salon d'Administration. Si plusieurs utilisateur.ice.s du Robot sont dans un même groupe Signal, seul un Salon Matrix sera créé par la passerelle. **

#### Relayer TOUTES les conversations entre UN compte Signal et UN compte Matrix
* Prérequis : votre compte Matrix ou le serveur sur lequel il est hébergé doit être autorisé dans la configuration de la passerelle (voir ci-dessous)
* Invitez le Robot (par défaut @signalbot:synapse.votredomaine) à une nouvelle conversation.
* Ce nouveau salon d'administration du Robot Mautrix-Signal est appelé "Administration Room".
* Envoyez ``help`` au Robot dans le "Administration Room" pour une liste des commandes d'administration de la passerelle.
Voir aussi [upstream wiki Authentication page](https://docs.mau.fi/bridges/python/signal/authentication.html)

#### Relier la passerelle comme un appareil secondaire
* Tapez ``!sg link``
* Ouvrez l'application Signal de votre appareil principal
* Ouvrez Paramètres => Appareils reliés => + => filmer le QR
* Par défaut, seules les conversations avec des messages très récents seront mises-en-miroir
* Acceptez les invitations aux salons

#### Enregistrer la passerelle comme appareil principal
* Tapez ``!sg register <phone>``, où ``<phone>`` est votre numéro de téléphone au format international sans espace, p.ex. ``!sg register +33612345678``
* Répondez dans le salon d'administration avec le code de vérification reçu par SMS.
* Définissez une nom de profil ``!sg set-profile-name <name>``

#### Robot-Relai "Relaybot": Relayer les conversations de TOUS les comptes Matrix et TOUS les comptes Signal présents dans UN groupe/salon
* Pas implémenté pour l'instant

### Configuration de la passerelle

La passerelle est [configurée avec les paramètres standards adaptés pour votre YunoHost et l'instance Matrix-Synapse sélectionnée](`https://github.com/YunoHost-Apps/mautrix_signal_ynh/blob/master/conf/config.yaml`). Vous pouvez par exemple ajouter des administrateur.ice.s et utilisateur.ice.s du Robot autorisés en modifiant le fichier de configuration par liaison SSH : 
```
sudo nano /opt/yunohost/mautrix_signal/config.yaml
```
puis en redémarrant le service: 
```
sudo yunohost service restart mautrix_signal
```

## Liens utiles

+ Site web : [mautrix_signal.eu (fr)](https://mautrix_signal.eu/site/fr/)
+ Démonstration : [Démo](https://demo.mautrix_signal.eu/login)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/mautrix_signal](https://github.com/YunoHost-Apps/mautrix_signal_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/mautrix_signal/issues](https://github.com/YunoHost-Apps/mautrix_signal_ynh/issues)
