---
title: Mumble Web
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_mumble-web'
---

[![Installer Mumble Web avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=mumble-web) [![Integration level](https://dash.yunohost.org/integration/mumble-web.svg)](https://dash.yunohost.org/appci/app/mumble-web)

*Mumble Web* est un client HTML5 Mumble à utiliser dans les navigateurs modernes.
Le protocole Mumble utilise TCP pour le contrôle et UDP pour la voix. Fonctionnant dans un navigateur, les deux ne sont pas disponibles pour ce client. Au lieu de cela, les Websockets sont utilisés pour le contrôle et WebRTC est utilisé pour la voix (en utilisant les Websockets comme solution de secours si le serveur ne prend pas en charge WebRTC).

### Captures d'écran

![Capture d'écran de Mumble Web](https://github.com/YunoHost-Apps/mumble-web_ynh/blob/master/doc/screenshots/screenshot.png)

### Avertissements / informations importantes

### Configuration

- Pour utiliser *Mumble web*, vous devez d'abord installer le [server Mumble](https://github.com/YunoHost-Apps/mumbleserver_ynh). 
- Cette installation suppose que le serveur Mumble est servi par le port `64738`
- Diverses options de configuration sont disponibles pour *Mumble web* sur ce fichier de configuration `/var/www/mumble-web/dist/config.local.js` 

### Documentation

- Documentation Murmur : https://wiki.mumble.info/wiki/Murmurguide
- Documentation Framasoft : https://docs.framasoft.org/fr/jitsimeet/mumble.html

## Liens utiles

+ Site web : [mumble.info](https://www.mumble.info/)
+ Démonstration : [Démo](https://alt.framasoft.org/fr/mumble)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/mumble-web](https://github.com/YunoHost-Apps/mumble-web_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/mumble-web/issues](https://github.com/YunoHost-Apps/mumble-web_ynh/issues)
