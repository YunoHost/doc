# <img src="https://yunohost.org/images/transmission.png">Transmission

### C’est quoi Transmission ?
Transmission est un logiciel de téléchargement et de partage de fichiers basé sur le protocole BitTorrent.
* [Site de transmission](http://transmissionbt.com/)

### Comment télécharger des fichiers complétés ?
Si vous avez installé Transmission sur `/torrent/`, vous pourrez télécharger vos fichiers complétés à l’adresse suivante : https://votre-domaine.org/torrent/downloads/

### Envoi de fichier vers le serveur pour seeder
Dans YunoHost, les fichiers complétés sont enregistrés dans : `/home/yunohost.transmission/completed`

#### Avec SFTP (recommandé)
À partir de votre [gestionnaire de fichiers](https://fr.wikipedia.org/wiki/Gestionnaire_de_fichier) (sous GNU/Linux) faites `CTRL + L` puis entrez :
```bash
sftp://<utilisateur>@<votre-domaine.org>/home/yunohost.transmission/completed
```
utilisateur = admin ou root

#### Avec SCP (compliqué)
Pour transférer le fichier entrez la commande suivante :

```bash
scp (-r) /votre/fichier/ root@votre-domaine.org:/home/yunohost.transmission/completed
```

##### Comment télécharger un répertoire entier ?
Une fois connecté en [SSH](ssh_fr), placez-vous dans le répertoire de téléchargement et zippez le répertoire :
```bash
cd /home/yunohost.transmission/completed
zip -r votre_archive.zip [dossier]
```

Pour plus de détails sur le transfert de fichier avec *scp* voir ici : http://doc.ubuntu-fr.org/ssh#transfert_-_copie_de_fichiers

