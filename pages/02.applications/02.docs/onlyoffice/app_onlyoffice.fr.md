---
title: OnlyOffice Server
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_onlyoffice'
---

![logo de OnlyOffice](image://OnlyOffice_logo.png?height=80)

[![Installer OnlyOffice avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=onlyoffice) [![Integration level](https://dash.yunohost.org/integration/onlyoffice.svg)](https://dash.yunohost.org/appci/app/onlyoffice)

### Index

- [Liens utiles](#liens-utiles)
- [Configurer OnlyOffice Server avec Nextcloud](#Configurer-OnlyOffice-Server-avec-Nextcloud)  

OnlyOffice Server est une suite bureautique collaborative en ligne gratuite comprenant des visualiseurs et des éditeurs de texte, de feuilles de calcul et de présentations, entièrement compatible avec les formats Office Open XML : .docx, .xlsx, .pptx et permettant l'édition collaborative en temps réel.

## Configurer OnlyOffice Server avec Nextcloud

1. Installer [OnlyOffice Server](https://github.com/YunoHost-Apps/onlyoffice_ynh) dans un domaine différent de celui utilisé par Nextcloud : `https://onlyoffice.domain.org` et `https://domain.org/nextcloud` (par exemple)

2. Installer [ONLYOFFICE connector](https://apps.nextcloud.com/apps/onlyoffice) dans Nextcloud
- Connectez-vous à Nextcloud en tant qu'administrateur et installer ONLYOFFICE Connector : -> Applications -> installez ONLYOFFICE. (Le numéro de version d'ONLYOFFICE Connector n'a pas besoin d'être le même que celui d'OnlyOffice Server).
- Dans Paramètres (`https://domain.org/nextcloud/settings/admin/onlyoffice`), entrez l'adresse de votre serveur OnlyOffice Server (par exemple : `https://onlyoffice.domain.org`)

OnlyOffice Server est maintenant connecté à Nextcloud.

## Liens utiles

+ Site web : [www.onlyoffice.com](https://www.onlyoffice.com/)
+ ONLYOFFICE connector : [Nextcloud ONLYOFFICE Connector](https://apps.nextcloud.com/apps/onlyoffice)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/onlyoffice_ynh](https://github.com/YunoHost-Apps/onlyoffice_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/onlyoffice/issues](https://github.com/YunoHost-Apps/onlyoffice_ynh/issues)
