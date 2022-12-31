---
title: Minchat
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_minchat'
---

[![Installer Minchat avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=minchat) [![Integration level](https://dash.yunohost.org/integration/minchat.svg)](https://dash.yunohost.org/appci/app/minchat)

*Minchat* est une application de chat libre et minimaliste. Elle est basée sur [wojtek77/chat](https://github.com/wojtek77/chat), elle-même basée sur [le tutoriel de Gabriel Nava](http://code.tutsplus.com/tutorials/how-to-create-a-simple-web-based-chat-application--net-5931).

### Captures d'écran

![Capture d'écran de Minchat](https://github.com/YunoHost-Apps/minchat_ynh/blob/master/doc/screenshots/minchat_ynh_screenshot01.gif)

### Avertissements / informations importantes

#### Configuration

la configuration est facultative. Si vous le laissez tel quel, il y a une seule salle sans nom, ouverte à tous les utilisateurs. Si vous voulez personnaliser le contrôle d'accès, éditez le fichier `conf/setup.ini` (s'il manque, copiez-le depuis `conf/sample/setup.ini`). Le paramètre intéressant est `auth` qui indique quel utilisateur est autorisé à accéder à quelle salle.

Dans cet exemple `auth = John:Game,John:Family,Mary:Game,Tim:Family,admin:*,*:Public,*:`,
- `John:Jeux,John:Famille` = John peut accéder à la salle Jeux et à la salle Famille 
- `Mary:Jeux` = Mary peut accéder à la salle Jeux 
- `Tim:Famille` = Tim peut accéder à la salle Famille 
- `admin:*` = admin peut accéder à toutes les salles
- `*:Public` = tout le monde peut accéder à la salle Public
- `*:` = tout le monde peut accéder à la salle sans nom

#### Conseils aux utilisateurs

- Les URLs que vous envoyez sont liées ou transformées en images lorsqu'elles sont précédées d'un `!`.
- Si plusieurs salles sont autorisées par l'administrateur dans le `setup.ini`, vous pouvez avoir plusieurs onglets ouverts sur différentes salles dans le même navigateur.

## Liens utiles

+ Site web : [github.com/wojtek77/chat](https://github.com/wojtek77/chat)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/minchat](https://github.com/YunoHost-Apps/minchat_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/minchat/issues](https://github.com/YunoHost-Apps/minchat_ynh/issues)
