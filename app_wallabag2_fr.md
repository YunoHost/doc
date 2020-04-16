## <img src="https://yunohost.org/images/Logo-wallabag-svg.svg">


[Wallabag](https://www.wallabag.org/) est une application de lecture différée : elle  permet simplement d’archiver une page web en ne conservant que le contenu. Les éléments superflus (menus, publicités, etc.) sont supprimés.

Sont disponibles: une interface web, des add-ons pour navigateurs (Firefox / Chrome / Opera), des applications pour mobile (Android / iOS / Windows Phone) et même sur liseuse (PocketBook / Kobo).

[![Installer avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=wallabag2)

### Fonctionnalités

En plus des fonctionnalités principales de Wallabag, ce paquet propose également:

 * Une intégration avec le système de gestion des utilisateurs et le SSO de Yunohost - e.g. un bouton de déconnexion
 * De permettre à un utilisateur d'être administrateur (réglage lors de l'installation)
 * Un import asynchrone utilisant Redis (à activer dans les *Paramètres Internes*). L'import via RabbitMQ n'est pas (encore ?) supporté.

### Liens

 * Rapport de bug: https://github.com/YunoHost-Apps/wallabag2_ynh/issues
 * Site web de Wallabag: https://www.wallabag.org/
 * Documentation de Wallabag: https://doc.wallabag.org/ (fr/en/it/de)
 * [Demo vidéo](https://player.vimeo.com/video/167435064)
 
 ----
 
 ### Mettre à niveau depuis la v1.x

La mise à niveau depuis le paquet Yunohost de [Wallabag v1](https://github.com/YunoHost-Apps/wallabag_ynh) demande une opération manuelle, c'est pourquoi un nouveau paquet est fournit.
Pour le processus de migration, merci de vous référer à [la documentation officiel de Wallabag](https://doc.wallabag.org/fr/user/import/wallabagv1.html).
