#Création de paquet Debian

## Architecture
Le système se compose de `rebuildd` qui est un front-end pour `pbuilder`, des chroot pbuilder pour i386, amd64, armhf et de `reprepro` pour le système de repo debian.

---

## Workflow

#### Paquets YunoHost

Il existe trois repo (`daily`, `test` et `stable`):
* Les paquets du repo `daily` correspondent à la dernière version du git, et sont reconstruits de façon automatisée toutes les nuits.

* Le repo `test` permet de mettre en place une nouvelle version d'un paquet qui sera ensuite testé

* Le repo `stable` contient la version de production

Le but du workflow est d'éviter toute intervention manuelle (lancement d'un script, ...) sur le serveur, et de maîtriser la gestion des paquets via GitHub uniquement.

Ansi, les dépôts de chaque paquet yunohost possèdent 3 branches correspondant aux trois dépôts (`daily`, `test` et `stable`). Le serveur de build construit et déploie **automatiquement** les paquets source et binaires Debian correspondant à l'état de ces trois branches sur GitHub.

###### Branche daily

Aucun commit dans la branche daily ne modifie le fichier `debian/changelog` car celui-ci est modifié automatiquement lors du build d'un paquet daily, avec une version correspondant à la date-heure de construction.

TODO : ajouter un pre-commit hook pour éviter les erreurs ?

Tout commit modifiant fonctionnellement les paquets doit se faire dans cette branche daily.

###### Branche test et stable - workflow standard

Aucun commit fonctionnel n'est effectué directement dans ces branches. On ne fait que des merge (merge de daily dans test et merge de test dans stable)

Les seules modifications spécifiques à ces dépôts sont les changements de versions (modification de `debian/changelog` puis tag)

Des outils à destinations des mainteneurs de paquets sont disponibles sur le dépôt [yunohost-debhelper](https://github.com/YunoHost/yunohost-debhelper)
```bash
$ git clone https://github.com/YunoHost/yunohost-debhelper
$ yunohost-debhelper/setup_git_alias.sh
```
Ceci va configurer un nouvel alias git nommé `yunobump`, global (stocké dans `~/.gitconfig` et donc accessible depuis n'importe quel dépôt git local).

Pour mettre à jour une version dans `test` ou `stable`, exécuter simplement:
```bash
git yunobump x.y.z-p
```
Ceci a pour effet d'utiliser `git-dch` pour mettre à jour le changelog, et de créer un nouveau `tag` sur le commit modifiant le changelog.
Le tag sera lui-même utilisé lors des exécutions ultérieures de git-dch pour connaître la nouvelle liste des commits à prendre en compte. Il doit donc avoir un format bien particulier, mais ceci est géré grâce à yunobump.

TODO : politique sur les numéros de version. git-dch ne supporte pas les ~ dans les numéros de version

TODO : politique sur les format de tag, actuellement $branch/$version pour autoriser la même version dans deux branches différentes. est-ce vraiment souhaitable ?

###### Branche test et stable - faire un hotfix

Il peut arriver, de façon exceptionnelle, qu'on ait besoin de faire un hotfix (de sécurité par exemple) sur les paquets en `stable` ou en `test`, pour lequel le merge de la branche daily n'est pas acceptable (car trop de nouvelles fonctionnalités en développement sur daily).
** Cette situation doit rester exceptionnelle **

TODO : à décrire

TODO : dev un helper 'git yunohotfix ...' qui commit dans stable et cherry-pick tout de suite dans daily ? ou l'inverse ?

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

