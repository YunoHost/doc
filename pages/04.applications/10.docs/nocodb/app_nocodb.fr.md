---
title: NocoDB
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_nocodb'
---

[![Installer NocoDB avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=nocodb) [![Integration level](https://dash.yunohost.org/integration/nocodb.svg)](https://dash.yunohost.org/appci/app/nocodb)

*NocoDB* est une plateforme NoCode open source qui transforme n'importe quelle base de données en un tableur intelligent, c'est une alternative à Airtable.

* Connectez-vous à une base de données SQL nouvelle/existante et transformez-la en feuille de calcul.
* Créez une grille, une galerie, une vue kanban et une vue calendrier sur vos données.
* Recherchez, triez, filtrez les colonnes et les lignes avec une grande facilité.
* Invitez votre équipe avec un contrôle d'accès précis.
* Partage des vues publiquement et également avec une protection par mot de passe
* Fournit des API REST et GraphQL avec une interface graphique Swagger et GraphiQL.

*(issu du site web de NocoDB)*

### Captures d'écran

![Capture d'écran de NocoDB](https://github.com/YunoHost-Apps/nocodb_ynh/blob/master/doc/screenshots/example.png)

### Avertissements / informations importantes

NocoDB possède son propre système d'authentification qui ne repose pas sur le SSO ou le serveur LDAP de YunoHost.
  * Vous pouvez le rendre public, notamment si vous avez besoin de son API.
  * Vous devrez créer le premier administrateur juste après l'installation.

## Liens utiles

+ Site web : [nocodb.com](https://www.nocodb.com/)
+ Démonstration : [Démo](https://www.nocodb.com/demos)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/nocodb](https://github.com/YunoHost-Apps/nocodb_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/nocodb/issues](https://github.com/YunoHost-Apps/nocodb_ynh/issues)
