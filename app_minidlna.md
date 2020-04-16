# Minidlna

Minidlna is a lightweight [dlna](https://fr.wikipedia.org/wiki/Digital_Living_Network_Alliance) server.
It allows to easily share multimedia files with any compatible devices present on the LAN.

Minidlna does not have a graphical interface, but it does not require any special configuration.

### What multimedia files are shared?
Minidlna sharing the folder `/home/yunohost.multimedia/share`, which is common to each user in `/home/$USER/Multimedia/Share`.
[More information about multimedia files here.](Https://github.com/maniackcrudelis/yunohost.multimedia)

~~If [transmission](https://github.com/Kloadut/transmission_ynh) is installed, the downloaded media will be available in dlna.~~  

### How to view and play media files shared by minidlna?
To view and play media files, all you need is a compatible client DLNA/UPNP.

The majority of set-top boxes provided by ISPs are DLNA compatible, simply look for sources of external media.
This is also true for the latest generation game consoles connected to internet.

Some TV and blu-ray player is also DLNA compatible.

In any case, it is generally sufficient to seek external sources, USB etc, to find the DLNA server, displayed under the name **YunoHost DLNA**.

There are a multitude of DLNA client for all platforms, including the following [not exhaustive list](https://en.wikipedia.org/wiki/List_of_UPnP_AV_media_servers_and_clients#UPnP_AV_clients).
In general, a DLNA client does not require any special configuration to access the media sharing.
