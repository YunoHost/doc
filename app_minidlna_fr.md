# Minidlna

Minidlna est un serveur [dlna](https://fr.wikipedia.org/wiki/Digital_Living_Network_Alliance) ultra léger.
Il permet de partager très simplement les fichiers multimédias avec tous les appareils compatibles présents sur le réseau local.

Minidlna ne dispose pas d’une interface graphique, mais ne nécessite pas de configuration particulière.

### Quels fichiers multimédias sont partagés ?
Minidlna partage le dossier `/home/yunohost.multimedia/share`, qui est commun à chaque utilisateur dans le dossier `/home/$USER/Multimedia/Share`.
[Plus d’informations sur les dossiers multimédias](https://github.com/maniackcrudelis/yunohost.multimedia).

~~Si [transmission](https://github.com/Kloadut/transmission_ynh) est installé, les médias téléchargés seront disponibles en dlna.~~

### Comment consulter et lire les fichiers multimédias partagés par minidlna ?
Pour voir et lire les fichiers multimédias, il suffit de disposer d’un client compatible DLNA/UPNP.

La majorité des décodeurs TV fournis par les FAI sont compatibles DLNA, il suffit de chercher les sources de médias externes.
C’est le cas également pour les consoles de jeux dernière génération connectée à internet.

Certaines TV et lecteur blu-ray sont également compatibles DLNA.

Dans tous les cas, il suffit en général d’aller chercher les sources externes, USB etc., pour trouver le serveur DLNA, affiché sous le nom **YunoHost DLNA**.

Il existe une multitude de clients DLNA pour toutes les plateformes, dont voici une [liste non exhaustive](https://en.wikipedia.org/wiki/List_of_UPnP_AV_media_servers_and_clients#UPnP_AV_clients).
De manière générale, un client DLNA ne nécessite pas de configuration particulière pour accéder au partage de fichiers multimédias.


-----------------------------

# <img src="/images/APPLICATION_logo.svg" width="80px" alt="logo de APPLICATION"> APPLICATION

[![Install APPLICATION with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=APPLICATION) [![Integration level](https://dash.yunohost.org/integration/APPLICATION.svg)](https://dash.yunohost.org/appci/app/APPLICATION)

- [Configuration](#configuration)
- [Limitations avec Yunohost](#limitations-avec-yunohost)
- [Applications clientes](#applications-clients)
- [Liens utiles](#liens-utiles)

**Présentation générale de l'application.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Configuration

**Si la configuration de l'application ne se fait pas avec le panel admin de YunoHost.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Limitations avec Yunohost

**Explication des limitations actuelles en utilisation l'application avec YunoHost.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Applications clientes

| Nom de l'applications | Plateforme | Multi-comptes | Autre réseaux supportés | Play Store | F-Droid | Apple Store | *Autres* |
|-----------------------|------------|---------------|-------------------------|------------|---------|-------------|----------|
|                       |            |               |                         |            |         |             |          |

## Liens utiles

 + Site web : [SITE WEB](#)
 + Documentation officielle : [DOCUMENTATION](#)
 + Dépôt logiciel de l'application : [github.com - YunoHost-Apps/APPLICATION](https://github.com/YunoHost-Apps/APPLICATION_ynh)
 + Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/APPLICATION/issues](https://github.com/YunoHost-Apps/APPLICATION_ynh/issues)
