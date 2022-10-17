---
title: Streama
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_streama'
---

[![Installer Streama with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=streama) [![Integration level](https://dash.yunohost.org/integration/streama.svg)](https://dash.yunohost.org/appci/app/streama)

### Index

- [Useful links](#useful-links)

*Streama* is a self hosted streaming media server.

### Screenshots

![Screenshot of Streama](https://github.com/YunoHost-Apps/streama_ynh/blob/master/doc/screenshots/screenshot.jpg)

### Disclaimers / important information

### Disclaimers / important information

### Installation guide

> :warning: Streama must be installed in the root domain or subdomain.

Default upload directory is: `/home/yunohost.app/streama` (must be mentioned in *Settings* page or can be changed)
 
Default local video directory is: `/home/yunohost.app/streama/upload` (must be mentioned in *Settings* page or can be changed)

### Additional information

* After install:
 - **Username**: admin
 - **Password**: admin

This can be changed in settings.

#### Convert video:
``` 
convert_movies -ffmpeg 
convert_movies -avidemux
convert_movies -mencoder
convert_movies -avconv
```
#### Avidemux compilation:
```
git clone https://github.com/mean00/avidemux2/
cd avidemux2
sudo apt-get install build-essential cmake \
pkg-config yasm libsqlite3-dev libfontconfig1-dev \
libfribidi-dev libxvdev libvdpau-dev libva-dev \
libasound2-dev libpulse-dev libfdk-aac-dev \
libpng-dev libmp3lame-dev libx264-dev \
libxvidcore-dev libfaad-dev libfaac-dev libopus-dev \
libvorbis-dev libogg-dev libdca-dev libx265-dev
wget https://www.deb-multimedia.org/pool/main/a/aften/libaften0_0.0.8svn20100103-dmo2_amd64.deb
wget https://www.deb-multimedia.org/pool/main/a/aften/libaften-dev_0.0.8svn20100103-dmo2_amd64.deb
sudo dpkg -i libaften0_0.0.8svn20100103-dmo2_amd64.deb
sudo dpkg -i libaften-dev_0.0.8svn20100103-dmo2_amd64.deb
bash bootStrap.bash --deb --without-qt --with-cli
```
## Useful links

+ Website: [streamaserver.org](https://streamaserver.org)
+ Demonstration: [Demo](https://streama.demo-version.net/login/auth)
+ Application software repository: [github.com - YunoHost-Apps/streama](https://github.com/YunoHost-Apps/streama_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/streama/issues](https://github.com/YunoHost-Apps/streama_ynh/issues)
