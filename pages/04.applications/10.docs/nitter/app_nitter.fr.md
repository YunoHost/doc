---
title: Nitter
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_nitter'
---

[![Installer Nitter avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=nitter) [![Integration level](https://dash.yunohost.org/integration/nitter.svg)](https://dash.yunohost.org/appci/app/nitter)

*Nitter* est une interface alternative pour Twitter qui est plus rapide que le site officiel. Cette application respecte votre vie privée et ne nécessite pas de s'enregistrer. Son interface s'adapte aux écrans de toutes tailles. Nitter offre aussi de générer des flux RSS à partir des timelines des utilisateurs Twitter.

### Fonctionnalités

- Pas de JavaScript ni de publicités
- Toutes les demandes passent par le backend, le client ne communique jamais avec Twitter
- Empêche Twitter de suivre votre adresse IP ou votre empreinte JavaScript
- Utilise l'API non officielle de Twitter (aucune limite de débit ni compte de développeur requis)
- Léger (pour @nim_lang, 60KB contre 784KB de twitter.com)
- Flux RSS
- Thèmes
- Support mobile (conception réactive)

## Captures d'écran

![Capture d'écran de Nitter](https://github.com/YunoHost-Apps/nitter_ynh/blob/master/doc/screenshots/screenshot.png)

### Avertissements / informations importantes

#### Configuration

Cette application nécéssite un domaine dedié.

Le ficher de configuration de Nitter se trouve à `/var/www/nitter/nitter.conf` (pour la première installation, les prochaines installations iront dans `nitter__2`, `nitter__3`, etc). Les utilisateurs peuvent modifier les paramétres par défaut en visitant `https://instance-domain.tld/settings`.

### :red_circle: Fonctions indésirables

- **Services de réseau non libres** : Favorise ou dépend entièrement d'un service de réseau non libre.

## Liens utiles

+ Site web : [nitter.net](https://nitter.net/)
+ Démonstration : [Démo](https://nitter.net/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/nitter](https://github.com/YunoHost-Apps/nitter_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/nitter/issues](https://github.com/YunoHost-Apps/nitter_ynh/issues)
