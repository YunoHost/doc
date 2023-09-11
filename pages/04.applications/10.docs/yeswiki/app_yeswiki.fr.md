---
title: YesWiki
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_yeswiki'
---

[![Installer YesWiki avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=yeswiki) [![Integration level](https://dash.yunohost.org/integration/yeswiki.svg)](https://dash.yunohost.org/appci/app/yeswiki)

*YesWiki* est un wiki conçu pour rester simple, très facile à installer, en français traduit en anglais, espagnol, catalan, flamand...

Néanmoins, avec un YesWiki on peut fabriquer un site internet aux usages multiples :
- Rassembler toutes les infos d'un projet ou d'un groupe (fonction de "gare centrale")
- Cartographier des membres ou des lieux de façon participative
- Partager des ressources, des listes, des agendas grâce à des bases de données coopératives puissantes
- Faire communiquer des flux d'informations
- Cultiver un bout de liberté...

### Captures d'écran

![Capture d'écran de YesWiki](https://github.com/YunoHost-Apps/yeswiki_ynh/blob/master/doc/screenshots/yeswiki_screenshots.png)

### Avertissements / informations importantes

##### Support multi-utilisateurs

L'intégration au LDAP est la seule méthode supportée pour les nouvelles installations. Il est possible de la désactiver sur les anciennes installations en retirant l'extension loginldap. **Attention : Ne pas retirer l'extension sans connaitre d'identifiants administrateurs du wiki**

Pour le moment l'authentification SSO n'est pas prise en charge. Il est nécessaire de se connecter sur le wiki.

## Liens utiles

+ Site web : [yeswiki.net](https://yeswiki.net)
+ Démonstration : [Démo](https://ferme.yeswiki.net/?CreerSonWiki)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/yeswiki](https://github.com/YunoHost-Apps/yeswiki_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/yeswiki/issues](https://github.com/YunoHost-Apps/yeswiki_ynh/issues)
