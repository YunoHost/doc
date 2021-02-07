---
title: MiniDLNA (Ready Media)
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_minidlna'
---

![logo de MiniDLNA (Ready Media)](image://yunohost_package.png?height=80)

[![Install MiniDLNA with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=minidlna) [![Integration level](https://dash.yunohost.org/integration/minidlna.svg)](https://dash.yunohost.org/appci/app/minidlna)

### Index

- [Configuration](#configuration)
- [Liens utiles](#liens-utiles)

MiniDLNA (renommé Ready Media) est un serveur [DLNA](https://fr.wikipedia.org/wiki/Digital_Living_Network_Alliance) ultra léger.
Il permet de partager très simplement les fichiers multimédias avec tous les appareils compatibles présents sur le réseau local.

MiniDLNA ne dispose pas d’une interface graphique, mais ne nécessite pas de configuration particulière.

## Configuration

### Quels fichiers multimédias sont partagés ?
MiniDLNA partage le dossier `/home/yunohost.multimedia/share`, qui est commun à chaque utilisateur dans le dossier `/home/$USER/Multimedia/Share`.
[Plus d’informations sur les dossiers multimédias](https://github.com/YunoHost-Apps/yunohost.multimedia).

~~Si [Transmission](https://github.com/Kloadut/transmission_ynh) est installé, les médias téléchargés seront disponibles en DLNA.~~

### Comment consulter et lire les fichiers multimédias partagés par MiniDLNA ?
Pour voir et lire les fichiers multimédias, il suffit de disposer d’un client compatible DLNA/UPNP.

La majorité des décodeurs TV fournis par les FAI sont compatibles DLNA, il suffit de chercher les sources de médias externes.
C’est le cas également pour les consoles de jeux dernière génération connectée à internet.

Certaines TV et lecteur Blu-ray sont également compatibles DLNA.

Dans tous les cas, il suffit en général d’aller chercher les sources externes, USB etc., pour trouver le serveur DLNA, affiché sous le nom **YunoHost DLNA**.

Il existe une multitude de clients DLNA pour toutes les plateformes, dont voici une [liste non exhaustive](https://en.wikipedia.org/wiki/List_of_UPnP_AV_media_servers_and_clients#UPnP_AV_clients).
De manière générale, un client DLNA ne nécessite pas de configuration particulière pour accéder au partage de fichiers multimédias.

## Liens utiles

 + Site web : [minidlna.sourceforge.net](http://minidlna.sourceforge.net/)
 + Documentation : [doc.ubuntu-fr.org/minidlna](https://doc.ubuntu-fr.org/minidlna)
 + Dépôt logiciel de l'application : [github.com - YunoHost-Apps/minidlna](https://github.com/YunoHost-Apps/minidlna_ynh)
 + Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/minidlna/issues](https://github.com/YunoHost-Apps/minidlna_ynh/issues)
