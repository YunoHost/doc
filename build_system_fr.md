#Création de paquet Debian

## Architecture du sytème de build

Le système se compose de rebuildd qui est un front-end pour pbuilder, des chroot pbuilder pour i386 et amd64 et reprepro pour le sytème repo debian

## Workflow

### Pour les paquets YunoHost

Il existe trois repo (daily, test et stable), les paquets sont tous disponible dans la dernière version du git dans le repo daily. Le repo test permet de mettre en place une nouvelle version d'un paquet qui sera ensuite testé. Une fois le paquet testé et validé il passera dans le repo stable.

### Pour les paquet non YunoHost

Pour les paquets non yunohost (exemple python-bottle) le paquet ne passe pas par le repo daily (TODO)


## Build des paquets

### Daily build

Un cron défini dans l'utilisateur pbuilder se lance tous les jours à 01:00. Ce script va mettre à jours le repo git de packages et des submodule (ssowat, moulinette, moulinette-yunohost, adminjs). 
Une fois les sources mise à jour le script va rebuilder les paquets qui ont été mis à jour la veille.

Pour se faire on va créé des paquets sources qui va ensuite mettre dans le répertoire /var/www/repo.yunohost.org/daily/incomming

Puis lancer l'ajout de ces fichier source au repo se qui va automatiquement lancé un job dans rebuildd (voir configuration du repo daily dans /var/www/repo.yunohost.org/daily/conf/distribustion)

Quand les paquets sont terminé d'être buildé, ils sont ajouté au repo daily

### Rebuild d'un paquet YunoHost

Il est possible de relancer manuellement le rebuild d'un paquet, pour se faire il faut lancer la commande :
```bash
daily_build -p nom_du_paquet
```

## Build d'un paquet non YunoHost

TODO

### Passage de daily à test

Le passage de daily à test se fait avec la commande : 
```bash
push-packages-test -p nom_du_paquet
```

Il est possible d'utiliser l'option -v pour définir la version du paquet

Le script va récuperer les sources du paquet daily puis il va ouvrir le changelog pour y définir la version mais aussi le changelog

Après avoir rempli le changelog le paquet va être ajouté la liste des jobs de rebuildd pour être ajouté au repo test. 
Attention le nom de version ne doit pas contenir daily sinon le paquet sera ajouté au repo daily.


### Passage de test à stable

Le passage du paquet en stable est réalisé avec la commande : 
```bash
push-package-stable -p nom_du_paquet
```

Le n'est pas rebuildé il est récupéré du repo test est ajouté au repo stable

## Gestion repo

### Suppression d'un paquet

```bash
reprepro -V -b /var/www/repo.yunohost.org/nom_du_repo/ remove megusta nom_du_paquet
```

### Ajout d'un paquet debian dans un repo
```bash
reprepro -V -b /var/www/repo.yunohost.org/nom_du_repo/ includedeb megusta nom_du_paquet.deb
```

