---
title: Owncast
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_owncast'
---

[![Installer Owncast avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=owncast) [![Integration level](https://dash.yunohost.org/integration/owncast.svg)](https://dash.yunohost.org/appci/app/owncast)

*Owncast* est un serveur de diffusion en direct et de chat open source, auto-hébergé, décentralisé et à utilisateur unique pour exécuter vos propres diffusions en direct dans un style similaire aux grandes options grand public. Il offre une propriété complète sur votre contenu, votre interface, votre modération et votre audience.

### Captures d'écran

![Capture d'écran de Owncast](https://github.com/YunoHost-Apps/owncast_ynh/blob/master/doc/screenshots/owncast-screenshot.png)

### Avertissements / informations importantes

### Configuration

Vous pouvez configurer Owncast dans la page d'administration : `domain.ltd/admin` avec `admin` et `abc123` comme identifiant. N'oubliez pas de changer la clé de flux (Stream Key).

### Application de diffusion en continu

OBS peut être utilisé comme application de streaming vidéo : https://obsproject.com/

1. Installez **OBS** ou **Streamlabs OBS** et faites-le fonctionner avec votre configuration locale.
1. Ouvrez les **paramètres** OBS et allez dans **Stream**.
1. Sélectionnez **Personnalisé…** comme service.
1. Entrez l'URL du serveur exécutant votre service de streaming au format `rtmp://myserver.net/live`.
1. Saisissez votre « Stream key » qui correspond à votre clé de streaming choisie lors de l'installation.
1. Appuyez sur **Démarrer le streaming** (OBS) ou **Go Live** (Streamlabs) sur OBS.

## Liens utiles

+ Site web : [owncast.online](https://owncast.online/)
+ Démonstration : [Démo](https://watch.owncast.online/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/owncast](https://github.com/YunoHost-Apps/owncast_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/owncast/issues](https://github.com/YunoHost-Apps/owncast_ynh/issues)
