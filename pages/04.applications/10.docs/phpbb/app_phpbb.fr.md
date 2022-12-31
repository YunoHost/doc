---
title: phpBB
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_phpbb'
---

[![Installer phpBB avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=phpbb) [![Integration level](https://dash.yunohost.org/integration/phpbb.svg)](https://dash.yunohost.org/appci/app/phpbb)

*phpBB* est une solution logicielle gratuite de forum "à plat" qui peut être utilisée pour rester en contact avec un groupe de personnes ou pour alimenter l'ensemble de votre site Web. Avec une vaste base de données d'extensions créées par les utilisateurs et une base de données de styles contenant des centaines de styles et d'images pour personnaliser votre forum, vous pouvez créer un forum unique en quelques minutes.

### Captures d'écran

![Capture d'écran de phpBB](https://github.com/YunoHost-Apps/phpbb_ynh/blob/master/doc/screenshots/screenshot.png)

### Avertissements / informations importantes

### Configuration

1. L'application devra terminer le processus d'enregistrement une fois l'installation terminée en **visitant le domaine** sur lequel *phpBB* est installé.
1. Les informations d'identification de la base de données MySQL seront envoyées à la **messagerie admin**.
1. Veuillez supprimer, déplacer ou renommer le répertoire d'installation (`mv /var/www/phpbb/install /var/www/phpbb/install_old`) avant d'utiliser votre forum. Si ce répertoire est toujours présent, seul le panneau de configuration d'administration (ACP) sera accessible.

## Liens utiles

+ Site web : [phpbb.com](https://www.phpbb.com/)
+ Démonstration : [Démo](https://www.phpbb.com/demo/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/phpbb](https://github.com/YunoHost-Apps/phpbb_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/phpbb/issues](https://github.com/YunoHost-Apps/phpbb_ynh/issues)
