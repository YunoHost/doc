# Minidlna

Minidlna est un serveur [dlna](https://fr.wikipedia.org/wiki/Digital_Living_Network_Alliance) ultra léger.
Il permet de partager très simplement les fichiers multimédias avec tout les appareils compatibles présent sur le réseau local.

Minidlna ne dispose pas d'une interface graphique, mais ne nécessite pas de configuration particulière.

### Quels fichiers multimédias sont partagés?
Minidlna partage le dossier /home/yunohost.multimedia/share, qui est commun à chaque utilisateur dans le dossier /home/$USER/Multimedia/Share.
[Plus d'informations sur les dossiers multimedia ici.](https://github.com/maniackcrudelis/yunohost.multimedia)

~~Si [transmission](https://github.com/Kloadut/transmission_ynh) est installé, les médias téléchargés seront disponible en dlna.~~

### Comment consulter et lire les fichiers multimédias partagés par minidlna?
Pour voir et lire les fichiers multimédias, il suffit de disposer d'un client compatible DLNA/UPNP.

La majorité des décodeurs TV fourni par les FAI sont compatible DLNA, il suffit de chercher les sources de médias externe.
C'est le cas également pour les consoles de jeux dernière génération connectée à internet.

Certaines TV et lecteur blu-ray sont également compatibles DLNA.

Dans tout les cas, il suffit en général d'aller chercher les sources externes, USB etc, pour trouver le serveur DLNA, affiché sous le nom **Yunohost DLNA**.

Il existe une multitude de client DLNA pour toutes les plateformes, dont voici une [liste non exhaustive](https://en.wikipedia.org/wiki/List_of_UPnP_AV_media_servers_and_clients#UPnP_AV_clients).
De manière générale, un client DLNA ne nécessite pas de configuration particulière pour accéder au partage de fichiers multimédias.
