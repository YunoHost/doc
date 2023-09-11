---
title: Osada
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_osada'
---

[![Installer Osada avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=osada) [![Integration level](https://dash.yunohost.org/integration/osada.svg)](https://dash.yunohost.org/appci/app/osada)

*Osada* utilise le protocole **Zot6** qui est la prochaine version du protocole **zot5**. Osada a un support natif pour le **protocole ActivityPub** (norme W3C) ainsi que pour les fonctionnalités plus avancées. Il peut inter-opérer avec d'autres applications et projets de réseaux sociaux dans l'un ou l'autre de ces espaces, notamment **Mastodon, Pleroma, Pixelfed, PeerTube, Funkwhale, Zap, Friendica, Hubzilla,** et bien d'autres.

### Captures d'écran

![Capture d'écran de Osada](https://github.com/YunoHost-Apps/osada_ynh/blob/master/doc/screenshots/comment_on_posts.gif)

### Avertissements / informations importantes

### Cette application présente les caractéristiques suivantes :
- [X] intégration LDAP
- [X] Multi-instance
- [X] Ajout du fichier php.log dans le dossier root pour le débogage de PHP, avec logrotate intégré à celui-ci (accessible par **admin->logs** et en entrant le fichier **php.log**)
- [X] Fail2Ban
- [X] Option pour choisir entre **Mysql** et **PostgreSQL** pour Osada

### Droits d'utilisateur de l'administrateur Ldap, journaux et échecs de mise à jour de la base de données :

- **Pour les droits d'administrateur** : Une fois l'installation terminée, vous devrez vous rendre sur la page de votre nouveau hub et vous connecter avec le **nom d'utilisateur du compte admin** qui a été saisi au moment de l'installation. Vous devriez alors être en mesure de créer votre premier canal et avoir les **droits d'administrateur** pour le hub.

- **Pour les utilisateurs standards de YunoHost** : Les utilisateurs standards ils peuvent se connecter via l'authentification LDAP et créer leurs canaux.

- **Non obtention des droits d'administrateur** : Si l'administrateur ne peut pas accéder aux paramètres d'administration à l'adresse `https://osada.example.com/admin`, vous devez **ajouter manuellement 4096** aux **account_roles** sous **comptes** pour cet utilisateur dans la **base de données via phpMyAdmin**.

- **Pour les journaux** : Allez dans **admin->logs** et entrez le nom du fichier **php.log**.

- La mise à jour de la base de données échoue parfois après la mise à niveau de la version. Vous pouvez aller sur le hub, par exemple `https://osada.example.com/admin/dbsync/`, et vérifier le nombre de mises à jour qui ont échoué. Ces mises à jour devront être exécutées manuellement par **phpMyAdmin**.

## Liens utiles

+ Site web : [codeberg.org/zot/osada](https://codeberg.org/zot/osada)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/osada](https://github.com/YunoHost-Apps/osada_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/osada/issues](https://github.com/YunoHost-Apps/osada_ynh/issues)
