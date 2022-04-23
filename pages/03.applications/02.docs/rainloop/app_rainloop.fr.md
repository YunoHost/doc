---
title: Rainloop
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_rainloop'
---

![logo de Rainloop](image://yunohost_package.png?height=80)

[![Install Rainloop with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=rainloop) [![Integration level](https://dash.yunohost.org/integration/rainloop.svg)](https://dash.yunohost.org/appci/app/rainloop)

### Index

- [Configuration](#Configuration)
- [Liens utiles](#liens-utiles)

Rainloop est un webmail simple et léger.

## Configuration

Pour le configurer après l'installation, veuillez vous rendre sur http://DOMAIN.TLD/rainloop/app/?admin

- Le nom d'utilisateur admin par défaut est : admin
- Le mot de passe admin par défaut est : Mot de passe choisi lors de l'installation
- Si vous avez oublié votre mot de passe, vous pouvez le retrouver avec `sudo yunohost app setting rainloop password`

### Carnet d'adresses
Rainloop intègre par défaut un carnet d'adresse avec les utilisateurs du serveur YunoHost. Chaque utilisateur peut ajouter un carnet d'adresse distant CardDAV via leurs propres paramètres.
- Si vous utilisez Baïkal, l'adresse à renseigner est du type : https://DOMAIN.TLD/baikal/card.php/addressbooks/UTILISATEUR/default/
- Si vous utilisez Nextcloud, l'adresse à renseigner est du type : https://DOMAIN.TLD/nextcloud/remote.php/carddav/addressbooks/USER/contacts

### Gestion des domaines
Les utilisateurs peuvent se servir de Rainloop pour accéder à d'autres boites mail que celle fournie par YunoHost (par exemple gmail.com ou laposte.net). L'option est disponible par le bouton "compte -> ajouter un compte".
L'administrateur doit pour cela autoriser la connexion à des domaines tiers, via une liste blanche dans l'interface administration.

### Gestion des clés PGP
Rainloop stocke les clés PGP privées dans le stockage de navigateur. Cela implique que vos clés seront perdues quand vous videz le stockage de navigateur (navigation incognito, changement d'ordinateur, ...). Ce paquet intègre donc [PGPback de chtixof](https://github.com/chtixof/pgpback_ynh) pour que vous puissiez stocker vos clés privées PGP de manière sécurisée sur le serveur. Rendez-vous à l'adresse **http://DOMAIN.TLD/rainloop/pgpback** pour stocker vos clés privées PGP sur le serveur ou les restaurer dans un nouveau navigateur.

### Mise à jour
Pour mettre à jour Rainloop lorsqu'une nouvelle version est disponible, lancez en console locale (SSH ou autre) :
`sudo yunohost app upgrade -u https://github.com/YunoHost-Apps/rainloop_ynh rainloop`

## Liens utiles

+ Site web : [www.rainloop.net](https://www.rainloop.net/)
+ Documentation officielle : [www.rainloop.net/docs/configuration](https://www.rainloop.net/docs/configuration/)
+ Démonstration : [Démo](https://mail.rainloop.net/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/rainloop](https://github.com/YunoHost-Apps/rainloop_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com -YunoHost-Apps/rainloop/issues](https://github.com/YunoHost-Apps/rainloop_ynh/issues)
