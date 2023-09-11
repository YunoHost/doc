---
title: Standard Notes
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_snweb'
---

[![Installer Standard Notes avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=snweb) [![Integration level](https://dash.yunohost.org/integration/snweb.svg)](https://dash.yunohost.org/appci/app/snweb)

*Standard Notes* est une application de prise de notes chiffrées.

### Captures d'écran

![Capture d'écran de Standard Notes](https://github.com/YunoHost-Apps/snweb_ynh/blob/master/doc/screenshots/standard_notes.png)

### Avertissements / informations importantes

* Pas d'authentification unique ou d'intégration LDAP.
* L'application nécessite jusqu'à 1500 MB de RAM pour être installée.
* L'application nécessite au moins 100 Mo de RAM pour fonctionner correctement.
* L'application nécessite environ 3500 MB de disque.

* Un domaine dédié est nécessaire si vous voulez utiliser les extensions.
    * notes.votre-domaine.tld/ -> les extensions fonctionnent.
    * notes.votre-domaine.tld/notes/ -> les extensions ne fonctionnent pas.

* Le fichier de configuration est stocké dans "/opt/yunohost/$app/live/.env".

## Liens utiles

+ Site web : [standardnotes.com](https://standardnotes.com/)
+ Démonstration : [Démo](https://demo.snweb.eu/login)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/snweb](https://github.com/YunoHost-Apps/snweb_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/snweb/issues](https://github.com/YunoHost-Apps/snweb_ynh/issues)
