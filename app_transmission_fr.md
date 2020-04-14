# <img src="/images/transmission.png">Transmission

### C’est quoi Transmission ?
Transmission est un logiciel de téléchargement et de partage de fichiers basé sur le protocole BitTorrent.
* [Site de transmission](http://transmissionbt.com/)

### Comment télécharger des fichiers complétés ?
Il est possible de télécharger les fichiers complétés en cliquant sur le bouton « Download ».

Si vous avez installé Transmission sur `/torrent/`, vous pourrez télécharger vos fichiers complétés à l’adresse suivante : https://votre-domaine.org/torrent/downloads/

### Envoi de fichier vers le serveur pour seeder
Dans YunoHost, les fichiers complétés sont enregistrés dans : `/home/yunohost.transmission/completed`

#### Avec SFTP (simple)
À partir de votre [gestionnaire de fichiers](https://fr.wikipedia.org/wiki/Gestionnaire_de_fichier) (sous GNU/Linux) faites `CTRL + L` puis entrez :
```bash
sftp://<utilisateur>@<votre-domaine.org>/home/yunohost.transmission/completed
```
utilisateur = admin ou root

#### Avec SCP (avancé)
Pour transférer le fichier, entrez la commande suivante :

```bash
scp -r /votre/fichier/ root@votre-domaine.org:/home/yunohost.transmission/completed
```

##### Comment télécharger un répertoire entier ?
Une fois connecté en [SSH](/ssh), placez-vous dans le répertoire de téléchargement et zippez le répertoire :
```bash
cd /home/yunohost.transmission/completed
zip -r votre_archive.zip [dossier]
```

Pour plus de détails sur le transfert de fichier avec *scp* voir ici : http://doc.ubuntu-fr.org/ssh#transfert_-_copie_de_fichiers

#### Problèmes de droits
Si vous rencontrez des problèmes de droits `Permission denied` après l’ajout de fichiers à seeder, changez l’utilisateur qui possède les droits sur ces fichiers :
```bash
chown -R debian-transmission: /home/yunohost.transmission/completed/*
```

--------------------

# <img src="/images/APPLICATION_logo.svg" width="80px" alt="logo de APPLICATION"> APPLICATION

[![Install APPLICATION with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=APPLICATION) [![Integration level](https://dash.yunohost.org/integration/APPLICATION.svg)](https://dash.yunohost.org/appci/app/APPLICATION)

### Index

- [Configuration](#configuration)
- [Limitations avec YunoHost](#limitations-avec-yunohost)
- [Applications clientes](#applications-clientes)
- [Liens utiles](#liens-utiles)

**Présentation générale de l'application.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Configuration

**Si la configuration de l'application ne se fait pas avec le panel admin de YunoHost.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Limitations avec YunoHost

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
