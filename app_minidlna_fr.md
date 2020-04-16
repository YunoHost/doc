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
