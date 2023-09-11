---
title: Mopidy
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_mopidy'
---

[![Installer Mopidy with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=mopidy) [![Integration level](https://dash.yunohost.org/integration/mopidy.svg)](https://dash.yunohost.org/appci/app/mopidy)

*Mopidy* allows you to listen to music, podcasts and radio programs from the local disk and various streaming services.

### Screenshots

![Screenshot of Mopidy](https://github.com/YunoHost-Apps/mopidy_ynh/blob/master/doc/screenshots/mopidy_screenshot1.png)

### Disclaimers / important information

* This installation is shipped with various extensions:
    * [MusicBox-Webclient](https://mopidy.com/ext/musicbox-webclient/) to control mopidy from your web browser
    * [local](https://mopidy.com/ext/local/) to make your private music collection on `/home/yunohost.multimedia/share/Music/` browseable and searchable
    * [YouTube](https://pypi.org/project/Mopidy-YouTube/) to play sound from YouTube
    * [YTMusic](https://music.youtube.com/) to access Google’s streaming music named [YouTube Music](https://music.youtube.com/) 
    * [Podcast-iTunes](https://mopidy.com/ext/podcast-itunes/) to search and browse podcasts from the Apple iTunes Store.
    * [RadioNet](https://mopidy.com/ext/radionet/) to play radio channels from the [radio.net](https://www.radio.net/).
    * [Podcast](https://mopidy.com/ext/podcast/) to browse RSS feeds of podcasts and stream the episodes.
    * [Soundcloud](https://pypi.org/project/Mopidy-SoundCloud/) to play music from the [SoundCloud](https://soundcloud.com/) service \([authentication token](https://pypi.org/project/Mopidy-SoundCloud/) needed\).
    * [MPD](https://mopidy.com/ext/mpd/) can be activated in order to use apps that control mopidy via this protocol. (This will open port 6600.) 
* All streams are played on the servers local audio hardware. The web interface is only a kind of remote control. Threrefore it should not be used with VPS or other servers that have no real audio hardware
* To rebuild the database of your local music collection enter `sudo mopidyctl local scan`.
* To list current settings enter `sudo mopidyctl config`.
* Edit the file `/opt/yunohost/mopidy/mopidy.conf` to adjust Mopidy's configuration.

## Useful links

+ Website: [mopidy.com](https://mopidy.com/)
+ Application software repository: [github.com - YunoHost-Apps/mopidy](https://github.com/YunoHost-Apps/mopidy_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/mopidy/issues](https://github.com/YunoHost-Apps/mopidy_ynh/issues)
