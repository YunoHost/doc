---
title: Bitwarden
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_bitwarden'
---

![logo de Bitwarden](image://bitwarden_logo.png?width=80)

[![Install Bitwarden with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=bitwarden) [![Integration level](https://dash.yunohost.org/integration/bitwarden.svg)](https://dash.yunohost.org/appci/app/bitwarden)

### Index

- [Configuration](#configuration)
- [Limitations avec YunoHost](#limitations-avec-yunohost)
- [Applications clientes](#applications-clientes)
- [Liens utiles](#liens-utiles)

Bitwarden est un gestionnaire de mots de passe freemium et open source sous licence AGPL, qui permet de générer et de conserver des mots de passe de manière sécurisée. Ces éléments sont protégés par un seul et unique mot de passe appelé « mot de passe maître ». Il est créé en 2016 par Kyle Spearrin, un architecte logiciel.

Le logiciel est disponible sur la plupart des systèmes d'exploitation (GNU/Linux, Windows, macOS, iOS, Android ainsi qu'en ligne de commande), et comme module d'extension pour navigateur web. Il est également possible de consulter ses mot de passe depuis un site web.[¹](#sources)

## Configuration

Pour configurer l'appliation il faut se rendre à l'adresse : `sous.domaine.tld/admin`

## Limitations avec YunoHost

Les authentification HTTP et LDAP ne sont pas pris en charges.

## Applications clientes

| Nom de l'application [²] | Plateforme | Multi-comptes | Source | Play Store | F-Droid | Apple Store |
|--------------------------|------------|---------------|--------|------------|---------|-------------|
| Bitwarden | GNU/Linux / macOS / Windows  | Oui | [bitwarden.com - download](https://bitwarden.com/#download) |
| Bitwarden | Android / iOS | ? |  | [Playstore - Birwarden](https://play.google.com/store/apps/details?id=com.x8bit.bitwarden) | X | [App Store - Bitwarden](https://itunes.apple.com/app/bitwarden-free-password-manager/id1137397744?mt=8) |


> [²]: (of) : Officielle / (no) : non officiel

## Liens utiles

 + Site web : [bitwarden.com (en)](https://bitwarden.com/)
 + Documentation officielle : [help.bitwarden.com (en)](https://help.bitwarden.com/)
 + Dépôt logiciel de l'application : [github.com - YunoHost-Apps/bitwarden](https://github.com/YunoHost-Apps/bitwarden_ynh)
 + Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/bitwarden/issues](https://github.com/YunoHost-Apps/bitwarden_ynh/issues)

 ------

 ### Sources

¹ [wikipedia.org - Bitwarden](https://fr.wikipedia.org/wiki/Bitwarden)
