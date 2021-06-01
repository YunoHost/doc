---
title: Haste
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_haste'
---

![logo de Haste](image://yunohost_package.png?height=80)

[![Installer Haste avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=haste) [![Integration level](https://dash.yunohost.org/integration/haste.svg)](https://dash.yunohost.org/appci/app/haste)

### Index

- [Configuration](#Configuration)
- [Liens utiles](#useful-links)

Haste est un logiciel pastebin open-source écrit en Node.js, facilement installable sur n'importe quel réseau. Le projet YunoHost utilise Haste comme pastebin pour le partage de log : [paste.yunohost.org](https://paste.yunohost.org/)

## Configuration

Ce paquet de Haste pour YunoHost comprend une commande [`haste`](https://github.com/diethnis/standalones/blob/master/hastebin.sh), vous permettant de partager du contenu avec le terminal :

```bash
cat something | haste
https://haste.example.com/zuyejeduzu
```

Le [client Haste](https://github.com/seejohnrun/haste-client) est un client simple pour télécharger des données sur votre serveur Haste.

## Liens utiles

+ Documentation officielle : [hastebin.com - about](https://hastebin.com/about.md)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/haste](https://github.com/YunoHost-Apps/haste_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/haste/issues](https://github.com/YunoHost-Apps/haste_ynh/issues)
