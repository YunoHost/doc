#Les paquets Debian Yunohost

## Architecture

Les paquets yunohost se trouve sur la machine yunohost.org dans le répertoire <code>packages.git</code>.

Le système de build est basé sur debuild et pbuilder. Le fonctionnement de cette ensemble est de générer un chroot qui va embarqué l'ensemble des dépendances et les outils de build Debian.

La configuration de cette environnement est défini dans le fichier <code>/etc/pbuilder/megusta-amd64</code> qui permet de contruire les paquets sans architecture spécifique. 

## Mise à jour d'un paquet

Pour les paquets moulinette, moulinette-yunohost, SSOwat, et yunohost-admin il faut d'abord récupérer les dernière sources.

```bash
[yunohost@yunohost] ~/packages.git/moulinette $ cd sources
[yunohost@yunohost] ~/packages.git/moulinette $ git pull
```

Pour mettre à jour un paquet yunohost-config-* il faut se rendre dans le répertoire faire les modification sur le paquets puis lancer la commande 

```bash
[yunohost@yunohost] ~/packages.git $ commit-and-build "Message de commit"
```

Cette commande va mettre à jour le fichier changelog Debian et lancer la création du paquet. Une fois le paquets créé il est automatiquement ajouté dans le dépôt <code>test</code>

Pour ajouter le paquet dans le dépôt de production il faut faire la commande

```bash
[yunohost@yunohost] ~/packages.git $ commit-and-build "Message de commit" production
```

Une fois les modification il faire un ```git push``` pour envoyer sur github les modifications

## Ajout manuel de paquets dans un dépôt
Il est possible d'ajouter directement des paquets debian dans le dépots c'est le cas pour les paquets nodesjs.

```bash
sudo reprepro -Vb /var/www/repo.yunohost.org/ includedeb nom_du_dépôt nom_du_paquet.deb
```

## Supprimer un paquet d'un dépots

Il est possible de supprimer des paquets Debian dans un repot exemple pour vider l'ensemble des paquets du dépôt test

```bash
sudo reprepro -Vb /var/www/repo.yunohost.org/ includedeb nom_du_dépôt nom_du_paquet
```
 
##TODO 
Modifier le script commit-build pour récupérer les message de commit git pour générer le changelog Debian avec la commande <code>git-dch</code>




