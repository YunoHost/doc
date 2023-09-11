---
title: Mopidy
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_mopidy'
---

[![Installer Mopidy avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=mopidy) [![Integration level](https://dash.yunohost.org/integration/mopidy.svg)](https://dash.yunohost.org/appci/app/mopidy)

*Mopidy* permet d'écouter de la musique, des podcasts et des programmes radio depuis le disque local et divers services de streaming.

### Captures d'écran

![Capture d'écran de Mopidy](https://github.com/YunoHost-Apps/mopidy_ynh/blob/master/doc/screenshots/mopidy_screenshot1.png)

### Avertissements / informations importantes

* Cette installation est livrée avec diverses extensions :
    * [MusicBox-Webclient](https://mopidy.com/ext/musicbox-webclient/) pour contrôler Mopidy depuis votre navigateur web
* [local](https://mopidy.com/ext/local/) pour rendre votre collection de musique privée sur `/home/yunohost.multimedia/share/Music/` consultable et interrogeable.
    * YouTube](https://pypi.org/project/Mopidy-YouTube/) pour lire les sons de YouTube.
    * [YTMusic](https://music.youtube.com/) pour accéder à la musique en continu de Google appelée [YouTube Music](https://music.youtube.com/) 
    * [Podcast-iTunes](https://mopidy.com/ext/podcast-itunes/) pour rechercher et parcourir les podcasts de l'Apple iTunes Store.
    * RadioNet](https://mopidy.com/ext/radionet/) pour lire les chaînes de radio du site [radio.net](https://www.radio.net/).
    * Podcast](https://mopidy.com/ext/podcast/) pour parcourir les flux RSS de podcasts et diffuser les épisodes.
    * Soundcloud](https://pypi.org/project/Mopidy-SoundCloud/) permet de lire la musique du service [SoundCloud](https://soundcloud.com/) [[jeton d'authentification](https://pypi.org/project/Mopidy-SoundCloud/) nécessaire].
    * [MPD](https://mopidy.com/ext/mpd/) peut être activé afin d'utiliser des applications qui contrôlent le Mopidy via ce protocole. (Cela ouvrira le port 6600). 
* Tous les flux sont joués sur le matériel audio local des serveurs. L'interface web n'est qu'une sorte de télécommande. C'est pourquoi elle ne doit pas être utilisée avec des VPS ou d'autres serveurs qui n'ont pas de matériel audio réel.
* Pour reconstruire la base de données de votre collection de musique locale, entrez `sudo mopidyctl local scan`.
* Pour lister les paramètres actuels, entrez dans `sudo mopidyctl config`.
* Editez le fichier `/opt/yunohost/mopidy/mopidy.conf` pour ajuster la configuration de Mopidy.

## Liens utiles

+ Site web : [mopidy.com](https://mopidy.com/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/mopidy](https://github.com/YunoHost-Apps/mopidy_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/mopidy/issues](https://github.com/YunoHost-Apps/mopidy_ynh/issues)
