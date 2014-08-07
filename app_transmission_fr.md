# <img src="https://yunohost.org/images/transmission.png">Transmission

### C’est quoi Transmission ?
Transmission est un logiciel de téléchargement et de partage de fichiers basé sur le protocole BitTorrent.
* [Site de transmission](http://transmissionbt.com/)

### Comment télécharger des fichiers complétés ?

Si vous avez installé Transmission sur `/torrent/`, vous pourrez télécharger vos fichiers complétés à l’adresse suivante : https://votre-domaine.org/torrent/downloads/

### Comment télécharger un répertoire entier ?

Une fois connecté en [SSH](ssh_fr), placez-vous dans le répertoire de téléchargement et zipper le répertoire :
```bash
cd /home/yunohost.transmission/completed
zip -r votre_archive.zip [dossier]
```
### Transfert de fichier de son ordinateur de bureau vers YunoHost pour le partage
#### Avec SFTP
À partir de votre gestionnaire de fichier :
```bash
sftp://<utilisateur>@<votre-domaine.org>/home/yunohost.transmission/completed
```

#### Avec SCP

Dans YunoHost, les torrents completés sont enregistrés dans :
/home/yunohost.transmission/completed

Pour transferer le fichier entrez la commande suivante :

```bash
scp (-r) /votre/fichier/ root@votre-domaine.org:/home/yunohost.transmission/completed
```
Pour plus de détails sur le transfert de fichier voir ici : http://doc.ubuntu-fr.org/ssh#transfert_-_copie_de_fichiers

