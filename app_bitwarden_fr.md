# <img src="https://yunohost.org/images/bitwarden_logo.png" width="80px" alt="logo de Bitwarden"> Bitwarden

[![Install Bitwarden with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=bitwarden) [![Integration level](https://dash.yunohost.org/integration/bitwarden.svg)](https://dash.yunohost.org/appci/app/bitwarden)

- [Limitations avec Yunohost](#limitations-avec-yunohost)
- [Fonctionnalités](fonctionnalite)
- [Mettre à niveau depuis la V1.x](#mettre-a-niveau-depuis-la-version-1.x)
- [Applications clientes](#applications-clients)
- [Liens utiles](#liens-utiles)

Bitwarden est un gestionnaire de mots de passe freemium et open source sous licence AGPL, qui permet de générer et de conserver des mots de passe de manière sécurisée. Ces éléments sont protégés par un seul et unique mot de passe appelé « mot de passe maître ». Il est créé en 2016 par Kyle Spearrin, un architecte logiciel.

Le logiciel est disponible sur la plupart des systèmes d'exploitation (Linux, Windows, macOS, iOS, Android ainsi qu'en ligne de commande), et comme module d'extension pour navigateur web. Il est également possible de consulter ses mot de passe depuis un site web.[¹]

## Fonctionnalités

En plus des fonctionnalités principales de Wallabag, ce paquet propose également:

 * Une intégration avec le système de gestion des utilisateurs et le SSO de Yunohost - e.g. un bouton de déconnexion
 * De permettre à un utilisateur d'être administrateur (réglage lors de l'installation)
 * Un import asynchrone utilisant Redis (à activer dans les *Paramètres Internes*). L'import via RabbitMQ n'est pas (encore ?) supporté.


## Mettre à niveau depuis la version 1.x

 La mise à niveau depuis le paquet Yunohost de [Wallabag v1](https://github.com/YunoHost-Apps/wallabag_ynh) demande une opération manuelle, c'est pourquoi un nouveau paquet est fournit.
 Pour le processus de migration, merci de vous référer à [la documentation officiel de Wallabag](https://doc.wallabag.org/fr/user/import/wallabagv1.html).

## Applications clientes

| Nom de l'applications | Plateforme | Multi-comptes | Lien |
|-----------------------|------------|---------------|------|
| Bitwarden | Linux / Mac / Windows  | Oui | [bitwarden.com/download](https://bitwarden.com/#download)

## Liens utiles

 + Site web : [bitwarden.com](https://bitwarden.com/)
 + Documentation officielle : [help.bitwarden.com](https://help.bitwarden.com/)
 + Dépôt logiciel de l'application : [github.com - YunoHost-Apps/bitwarden](https://github.com/YunoHost-Apps/bitwarden_ynh)
 + Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com -YunoHost-Apps/bitwarden/issues](https://github.com/YunoHost-Apps/bitwarden_ynh/issues)

 ------

 [¹]: [wikipedia.org - Bitwarden](https://fr.wikipedia.org/wiki/Bitwarden)
