---
title: Gotify
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_gotify'
---

![logo de Gotify](image://gotify_logo.png?width=80)

[![Install Gotify with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=gotify) [![Integration level](https://dash.yunohost.org/integration/gotify.svg)](https://dash.yunohost.org/appci/app/gotify)

### Index

- [Configuration](#configuration)
- [Limitations avec YunoHost](#limitations-avec-yunohost)
- [Applications clientes](#applications-clientes)
- [Liens utiles](#liens-utiles)

Un simple serveur pour envoyer et recevoir des messages.

## Configuration

Editer le fichier config.yml via SSH.

## Limitations avec YunoHost

Exiger un domaine dédié comme gotify.domain.tld.
Pas de support LDAP (bloqué jusqu'à ce que le noyau Gotify en amont le mette en œuvre)

## Applications clientes

| Nom de l'application¹ | Plateforme | Multi-comptes |  Play Store | F-Droid | Apple Store |
|:----------------------:|:----------:|:-------------:|:-----------:|:-------:|:-----------:|
| Gotify (of) | Android | ? | [play.google.com - Gotify](https://play.google.com/store/apps/details?id=com.github.gotify) | [f-droid.org - Gotify](https://f-droid.org/de/packages/com.github.gotify/) | X |

> ¹ (of) : Officielle / (no) : non officiel

## Liens utiles

 + Site web : [gotify.net (en)](https://gotify.net/)
 + Documentation officielle : [gotify.net - docs (en)](https://gotify.net/docs/index)
 + Dépôt logiciel de l'application : [github.com - YunoHost-Apps/gotify](https://github.com/YunoHost-Apps/gotify_ynh)
 + Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/gotify/issues](https://github.com/YunoHost-Apps/gotify_ynh/issues)
