---
title: I Hate Money
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_ihatemoney'
---

[![Installer I Hate Money avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=ihatemoney) [![Integration level](https://dash.yunohost.org/integration/ihatemoney.svg)](https://dash.yunohost.org/appci/app/ihatemoney)

*I Hate Money* est une application web conçue pour faciliter la gestion partagée du budget. Elle permet de savoir qui a acheté quoi, quand et pour qui, et aide à régler les factures.

### Captures d'écran

![Capture d'écran de I Hate Money](https://github.com/YunoHost-Apps/ihatemoney_ynh/blob/master/doc/screenshots/screenshot_1_global.webp)
![Capture d'écran de I Hate Money](https://github.com/YunoHost-Apps/ihatemoney_ynh/raw/master/doc/screenshots/screenshot_2_new_operation.webp)

### Avertissements / informations importantes

* L'authentification LDAP et login unifié (SSO) n'est pas supportée. Le mécanisme de connexion sur IHateMoney se fait par projet et ne peut donc pas être intégrée dans YunoHost

- **app non publique**:
  - authentification YunoHost requise
  - identifiants de projets requis
  - Tout utilisateur YunoHost avec accès à l'app peut créer un nouveau projet.
- **app publique** :
  - authentification YunoHost non requise
  - identifiants de projets requis
  - Tout visiteur peut créer un nouveau projet.

* Lors de la mise à jour de la version 4.1.5~ynh3, un nouveau mot de passe administrateur est généré et envoyé à root.

## Liens utiles

+ Site web : [github.com/spiral-project/ihatemoney](https://github.com/spiral-project/ihatemoney)
+ Démonstration : [Démo](https://ihatemoney.org/authenticate?project_id=demo)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/ihatemoney](https://github.com/YunoHost-Apps/ihatemoney_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/ihatemoney/issues](https://github.com/YunoHost-Apps/ihatemoney_ynh/issues)
