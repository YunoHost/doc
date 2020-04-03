# <img src="https://yunohost.org/images/wallabag_logo.svg" width="80px" alt="logo de Wallabag"> Wallabag

[![Install Wallabag with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=wallabag2) [![Integration level](https://dash.yunohost.org/integration/wallabag2.svg)](https://dash.yunohost.org/appci/app/wallabag2)

- [Limitations avec Yunohost](#limitations-avec-yunohost)
- [Fonctionnalités](fonctionnalite)
- [Mettre à niveau depuis la V1.x](#mettre-a-niveau-depuis-la-version-1.x)
- [Applications clientes](#applications-clients)
- [Liens utiles](#liens-utiles)

Wallabag est une application de lecture différée : elle  permet simplement d’archiver une page web en ne conservant que le contenu. Les éléments superflus (menus, publicités, etc.) sont supprimés.

## Fonctionnalités

En plus des fonctionnalités principales de Wallabag, ce paquet propose également:

 * Une intégration avec le système de gestion des utilisateurs et le SSO de Yunohost - e.g. un bouton de déconnexion
 * De permettre à un utilisateur d'être administrateur (réglage lors de l'installation)
 * Un import asynchrone utilisant Redis (à activer dans les *Paramètres Internes*). L'import via RabbitMQ n'est pas (encore ?) supporté.


## Mettre à niveau depuis la version 1.x

 La mise à niveau depuis le paquet Yunohost de [Wallabag v1](https://github.com/YunoHost-Apps/wallabag_ynh) demande une opération manuelle, c'est pourquoi un nouveau paquet est fournit.
 Pour le processus de migration, merci de vous référer à [la documentation officiel de Wallabag](https://doc.wallabag.org/fr/user/import/wallabagv1.html).

## Applications clientes

| Nom de l'applications | Plateforme | Multi-comptes | Autre réseaux supportés | Play Store | F-Droid | Apple Store |
|-----------------------|------------|---------------|-------------------------|------------|---------|-------------|
## Liens utiles

 + Site web : [www.wallabag.org](https://www.wallabag.org/fr)
 + Documentation officielle : [doc.wallabag.org](https://doc.wallabag.org/fr/)
 + Dépôt logiciel de l'application : [github.com - YunoHost-Apps/wallabag2](https://github.com/YunoHost-Apps/wallabag2_ynh)
 + Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com -YunoHost-Apps/wallabag2/issues](https://github.com/YunoHost-Apps/wallabag2_ynh/issues)
