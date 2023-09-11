---
title: OwnTracks
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_owntracks'
---

[![Installer OwnTracks avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=owntracks) [![Integration level](https://dash.yunohost.org/integration/owntracks.svg)](https://dash.yunohost.org/appci/app/owntracks)

*OwnTracks* permet de gérez votre historique de géolocalisation.

### Captures d'écran

![Captures d'écran de OwnTracks](https://github.com/YunoHost-Apps/owntracks_ynh/blob/master/doc/screenshots/screenshot.png)

### Avertissements / informations importantes

### Caractéristiques

- [Fonctionnalités d'OwnTracks pour une API HTTP](http://owntracks.org/booklet/tech/http/), limité aux [fonctionnalités implémentées par l'enregistreur PHP](https://github.com/tomyvi/php-owntracks-recorder#features). Notamment, pas de fonction Amis. L'[enregistreur PHP en amont a été modifié](https://github.com/tituspijean/php-owntracks-recorder) pour supprimer une dépendance PHP encombrante.
- Multi-utilisateur : chaque utilisateur YunoHost peut se connecter via l'authentification HTTP de base, et n'a accès qu'à ses données.

### Installation

- Installez l'application sur votre serveur YunoHost
- Installez l'application mobile sur votre appareil, consultez le [site Web d'OwnTracks](http://owntracks.org)
- Configurez votre application mobile :
  - Autorisez-le à accéder à votre emplacement
  - Préférence > Connexion
    - Mode : `http privé`
    - Hébergeur : `https://DOMAIN/PATH/record.php`
    - Identification
       - Authentification: `enabled`
       - Nom d'utilisateur/mot de passe : vos identifiants YNH
       - ID de l'appareil : comme vous le souhaitez
   - Reportez-vous à la [documentation d'OwnTracks](http://owntracks.org/booklet) pour les autres paramètres

## Liens utiles

+ Site web : [owntracks.org](https://owntracks.org/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/owntracks](https://github.com/YunoHost-Apps/owntracks_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/owntracks/issues](https://github.com/YunoHost-Apps/owntracks_ynh/issues)
