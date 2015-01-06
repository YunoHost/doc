#Création de paquet Debian

## Architecture
Le système se compose de rebuildd qui est un front-end pour `pbuilder`, des chroot pbuilder pour i386, amd64, armhf et de `reprepro` pour le système de repo debian.

---

## Workflow

#### Paquets YunoHost

Il existe trois repo (`daily`, `test` et `stable`), les paquets du repo `daily` correspondent à la dernière version du git. Le repo `test` permet de mettre en place une nouvelle version d'un paquet qui sera ensuite testé. Une fois le paquet testé et validé, il est passé manuellement dans le repo  `stable`.

#### Paquets non YunoHost

Pour les paquets « non-YunoHost » (par exemple `python-bottle`) le paquet ne passe pas par le repo `daily`, une fois les tests effectués sur ce paquet, ils devront être envoyés manuellement dans le repo `backport`.

---

## Build des paquets

#### Daily build

Un cron défini pour l'utilisateur `pbuilder` se lance **tous les jours à 01:00**. Ce script va mettre à jour le repo git `packages` et ses submodules (`ssowat`, `moulinette`, `moulinette-yunohost` et `admin_js`). 
Une fois les sources mises à jour, le script va rebuilder les paquets qui ont été mis à jour la veille.

Pour ce faire on va créer des paquets sources qui vont ensuite être mis dans le répertoire `/var/www/repo.yunohost.org/daily/incomming`.

Lancer ensuite l'ajout de ces fichiers source au repo, ce lancera automatiquement un job dans `rebuildd` (voir configuration du repo daily dans `/var/www/repo.yunohost.org/daily/conf/distribustion`).

Une fois les paquets buildés, ils sont ajoutés au repo `daily`.


#### (Re)build d'un paquet YunoHost

Il est possible de relancer manuellement le build d'un paquet.

```bash
daily_build -p nom_du_paquet
```

#### Build d'un paquet non YunoHost

```bash
build_deb -p path_du_paquet
```

### Passage de `daily` à `test`

```bash
push-packages-test -p nom_du_paquet
```

Il est possible d'utiliser l'option `-v` pour définir manuellement la version du paquet.

Le script va récuperer les sources du paquet dans `daily` puis ouvrir le changelog pour y définir la version et la liste des changements. Le build paquet sera ensuite ajouté à la liste des jobs de rebuildd qui le passera dans le repo `test`.

**Attention :** le nom de version ne doit pas contenir `daily` sinon le paquet sera ajouté au repo `daily`.


### Passage de `test` à `stable`

```bash
push-package-stable -p nom_du_paquet
```

Cette commande passe simplement le paquet du repo `test` à `stable`, sans rebuild.


### Gestion du repo avec `reprepro`

* Suppression d'un paquet
```bash
reprepro -V -b /var/www/repo.yunohost.org/nom_du_repo/ remove megusta nom_du_paquet
```

* Ajout d'un paquet debian dans un repo
```bash
reprepro -V -b /var/www/repo.yunohost.org/nom_du_repo/ includedeb megusta nom_du_paquet.deb
```

### Gestion des backports
Pour la gestion des paquets venant du dépôt backport il est possible de les intégrer rapidement dans le repo test de yunohost

Pour ce faire il faut ajouter le nom du paquet dans le fichier `/var/www/repo.yunohost.org/test/conf/list` puis lancer la commande 
```bash
reprepro -V -b /var/www/repo.yunohost.org/test update megusta
```
Les paquets vont être télécharger et ajouté au repo `test` 

