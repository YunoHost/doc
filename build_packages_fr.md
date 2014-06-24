# Les paquets Debian YunoHost

## Architecture

Les paquets YunoHost se trouvent sur la machine yunohost.org dans le répertoire `/home/yunohost/packages.git`.

Le système de build est basé sur debuild et pbuilder. Le fonctionnement de cet ensemble est de générer un chroot qui va embarquer l'ensemble des dépendances et des outils de build Debian.

La configuration de cette environnement est défini dans le fichier `/etc/pbuilder/megusta-amd64` et permet de construire les paquets sans architecture spécifique. 

## Mise à jour d'un paquet

Pour les paquets basés sur des sources GitHub (moulinette, moulinette-yunohost, ssowat, et yunohost-admin) il faut d'abord récupérer les dernière modifications :

```bash
[yunohost@yunohost] ~/packages.git/moulinette $ cd src
[yunohost@yunohost] ~/packages.git/moulinette/src $ git pull
```

Puis lancer la commande de build du paquet (**attention : vous devez la lancer à la racine du répertoire du paquet**)

```bash
[yunohost@yunohost] ~/packages.git/moulinette/src $ cd ..
[yunohost@yunohost] ~/packages.git/moulinette $ commit-and-build "Message de commit"
```

Pour mettre à jour un paquet yunohost-config-* il faut se rendre dans le répertoire, faire les modifications voulues sur le paquet (typiquement modifier un script `debian/postinst`), puis lancer la même commande que pour les paquets avec source : 

```bash
[yunohost@yunohost] ~/packages.git/yunohost-config-nginx $ commit-and-build "Message de commit"
```

La commande de build va mettre à jour le fichier changelog Debian (`debian/changelog`) et lancer la création du paquet. Une fois le paquet créé il est automatiquement ajouté dans le dépôt `test`.

Pour ajouter le paquet dans le dépôt de `megusta` (stable) il vous faudra exécuter la commande :

```bash
[yunohost@yunohost] ~/packages.git/monpaquet $ commit-and-build "Message de commit" production
```

Une fois les modifications effectuées, vous pouvez exécuter `git push` pour envoyer les modifications sur GitHub.

## Ajout manuel de paquets dans un dépôt
Il est possible d'ajouter directement des paquets Debian dans le dépôt, c'est le cas notamment pour les paquets nodejs.

```bash
sudo reprepro -Vb /var/www/repo.yunohost.org/ includedeb nom_du_dépôt nom_du_paquet.deb
```

## Supprimer un paquet d'un dépot

Il est possible de supprimer des paquets Debian dans un dépôt, par exemple pour vider l'ensemble des paquets du dépôt test.

```bash
sudo reprepro -Vb /var/www/repo.yunohost.org/ includedeb nom_du_dépôt nom_du_paquet
```
 
## TODO 
Modifier le script commit-build pour récupérer les messages de commit git et générer le changelog Debian avec la commande `git-dch`.




