---
title: h5ai
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_h5ai'
---

[![Installer h5ai avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=h5ai) [![Integration level](https://dash.yunohost.org/integration/h5ai.svg)](https://dash.yunohost.org/appci/app/h5ai)

*h5ai* est un serveur moderne d'index pour NGINX.

### Avertissements / informations importantes

#### Configuration

Après avoir installé l'application, vous pouvez ajouter des documents dans `/var/www/documents` (ou le chemin correspondant que vous avez choisi).
h5ai ne permet pas de modifier ou de télécharger de nouveaux documents directement à partir du navigateur Web. Vous pouvez imaginer coupler le dossier `/var/www/documents` à Nextcloud ou un FTP pour permettre à certains utilisateurs de télécharger du contenu et d'utiliser h5ai comme interface publique en lecture seule.
Le fichier de configuration principal est `_h5ai/private/conf/options.json`. Vous souhaiterez peut-être modifier certains des paramètres documentés. Mais il y a d'autres fichiers dans `_h5ai/private/conf` que vous pourriez consulter.

## Liens utiles

+ Site web : [larsjung.de/h5ai](https://larsjung.de/h5ai/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/h5ai](https://github.com/YunoHost-Apps/h5ai_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/h5ai/issues](https://github.com/YunoHost-Apps/h5ai_ynh/issues)
