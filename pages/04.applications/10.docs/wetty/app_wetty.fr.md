---
title: Wetty
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_wetty'
---

[![Installer Wetty avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=wetty) [![Integration level](https://dash.yunohost.org/integration/wetty.svg)](https://dash.yunohost.org/appci/app/wetty)

*Wetty* est une application Terminal sur HTTP et HTTPS. WeTTy est une alternative à ajaxterm et anyterm mais bien meilleure qu'eux car WeTTy utilise xterm.js qui est une implémentation complète de l'émulation de terminal écrite entièrement en JavaScript. WeTTy utilise des websockets plutôt que Ajax et donc un meilleur temps de réponse.

### Captures d'écran

![Capture d'écran de Wetty](https://github.com/YunoHost-Apps/wetty_ynh/blob/master/doc/screenshots/terminal.png)

### Avertissements / informations importantes

#### Configuration

Il y a peu de configuration dans Wetty :
* La configuration de démarrage (port d'écoute, chemin d'URL, hôte SSH) est contenue dans le fichier de service systemd
* La configuration de l'interface utilisateur se fait via l'interface graphique Web elle-même.

* L'authentification LDAP et HTTP est-elle prise en charge ? **Non**
  * Vous devez vous connecter manuellement.
  * Vous pouvez spécifier l'utilisateur en accédent directement `https://<host>/wetty/ssh/<username>`

* Vous pouvez spécifier à l'installation si Wetty devrait être accessible par des visiteurs non connectés sur YunoHost.

* Vous ne pouvez pas vous authentifier par une clé SSH.

## Liens utiles

+ Site web : [github.com/butlerx/wetty](https://github.com/butlerx/wetty)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/wetty](https://github.com/YunoHost-Apps/wetty_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/wetty/issues](https://github.com/YunoHost-Apps/wetty_ynh/issues)
