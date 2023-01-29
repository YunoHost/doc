---
title: Retroarch Web Player
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_retroarch'
---

[![Installer RetroArch avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=retroarch) [![Integration level](https://dash.yunohost.org/integration/retroarch.svg)](https://dash.yunohost.org/appci/app/retroarch)

*RetroArch* est une interface pour les émulateurs, les moteurs de jeux et les lecteurs multimédias.
Il vous permet d'exécuter des jeux classiques sur un large éventail d'ordinateurs et de consoles grâce à son interface graphique élégante. Les paramètres sont également unifiés afin que la configuration soit effectuée une fois pour toutes.
En outre, vous êtes en mesure d'exécuter des disques de jeux originaux (CD) à partir de RetroArch.
RetroArch dispose de fonctions avancées telles que les shaders, le netplay, le rembobinage, les temps de réponse de l'image suivante, le runahead, la traduction automatique, les fonctions d'accessibilité aux aveugles, et bien plus encore !

### Captures d'écran

![Captures d'écran de RetroArch](https://github.com/YunoHost-Apps/retroarch_ynh/blob/master/doc/screenshots/ozone-main-menu.jpg)

### Avertissements / informations importantes

#### Bibliothèque partagée

Même si vous pouvez uploader une ROM depuis l'application, RetroArch peut accéder à celle déjà sur votre serveur:
* Les jeux sont situés dans `/opt/yunohost/retroarch/assets/cores`. Un lien symbolique est créé vers `/home/yunohost.multimedia/share/Games` de façon à ce que vous puissiez les y mettre facilement.
* Les cores doivent être indexés pour fonctionner : le script `/opt/yunohost/retroarch/indexer.sh` tourne toutes les 5 minutes pour indexer tous les jeux dans `opt/yunohost/retroarch/assets/cores`

#### Limitations

* On ne peut pas sauvegarder. En fait, on ne peut pas écrire dans les fichiers du tout, donc la configuration est perdue à chaque fois...
* Pas de gestion d'utilisateurs
* Certains cores sont listés mais ne sont pas implémentés : ils ne fonctionnent donc pas, le problème vient de l'application elle même.

## Liens utiles

+ Site web : [retroarch.com](https://www.retroarch.com/)
+ Démonstration : [Démo](https://web.libretro.com/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/retroarch](https://github.com/YunoHost-Apps/retroarch_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/retroarch/issues](https://github.com/YunoHost-Apps/retroarch_ynh/issues)
