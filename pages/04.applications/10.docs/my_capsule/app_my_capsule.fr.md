---
title: my_capsule
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_my_capsule'
---

[![Installer my_capsule avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=my_capsule) [![Integration level](https://dash.yunohost.org/integration/my_capsule.svg)](https://dash.yunohost.org/appci/app/my_capsule)

*my_capsule* est une capsule Gemini personnalisée avec un accès SFTP et HtmGem pour rendre vos pages Gemini accessibles sur le web.

### Captures d'écran

![Capture d'écran de my_capsule](https://github.com/YunoHost-Apps/my_capsule_ynh/blob/master/doc/screenshots/screenshot2.png)
![Capture d'écran de my_capsule](https://github.com/YunoHost-Apps/my_capsule_ynh/blob/master/doc/screenshots/screenshot1.png)

### Avertissements / informations importantes

* Une fois installé, allez à l'URL choisie pour connaître l'utilisateur, le domaine et le port que vous devrez utiliser pour l'accès SFTP ** Le mot de passe est celui que vous avez choisi lors de l'installation. Sous le répertoire Web, vous verrez un dossier `www` qui contient les fichiers publics servis par cette application. Vous pouvez y mettre tous les fichiers de votre application Web personnalisée.
* L'application peut aussi créer une base de données MySQL, permettant l'accès aux fichiers par [SFTP] (https://yunohost.org/en/filezilla).
* Il peut également créer une base de données MySQL qui sera sauvegardée et restaurée avec votre application. Les détails de connexion seront stockés dans le fichier `db_accesss.txt` situé dans le répertoire racine.

* Port SFTP
Vous pouvez modifier le port SSH comme décrit dans cette section :
[Modifier le port SSH](https://yunohost.org/en/security#modify-the-ssh-port) ;
alors vous devez utiliser ce port pour mettre à jour votre site web avec SFTP.

## Liens utiles

+ Site web : [tildegit.org/Sbgodin/htmgem](https://tildegit.org/Sbgodin/htmgem)
+ Démonstration : [Démo](https://gmi.sbgodin.fr/htmgem/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/my_capsule](https://github.com/YunoHost-Apps/my_capsule_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/my_capsule/issues](https://github.com/YunoHost-Apps/my_capsule_ynh/issues)
