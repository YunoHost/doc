# Transmission

### Téléchargement des fichiers complétés

Avec un navigateur web, si Transmission est installé sur `https://votre-domaine.org/torrent/` : https://votre-domaine.org/torrent/downloads/

### Comment télécharger un répertoire entier

Il faut archiver le répertoire. Pour cela il y a :
* tar : http://doc.ubuntu-fr.org/tar#utilisation_tar_seulconcatenation_de_fichiers
* zip : http://doc.ubuntu-fr.org/zip

### Transfert de fichier de son ordinateur de bureau vers YunoHost pour partager

Dans YunoHost, les torrent completés sont enregistrer dans :
/home/yunohost.transmission/completed

Pour transferer le fichier entrez la commande suivante :

```bash
scp /votre/fichier/ root@votre-domaine.org:/home/yunohost.transmission/completed
```
Pour plus de détails sur le transfert de fichier voir ici : http://doc.ubuntu-fr.org/ssh#transfert_-_copie_de_fichiers

[Site de transmission](http://transmissionbt.com/)

