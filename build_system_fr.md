# Système de construction des paquets

## Dépôts

Tout d'abord, aussi bien au niveau des dépôts que des paquets YunoHost, il faut savoir qu'il y a trois *composants* (`unstable`, `testing` et `stable`) :

* `unstable` correspondent à la dernière version du dépôt git sur la branche `unstable`, et sont reconstruits de façon automatisée toutes les nuits s’il y a eu une modification sur la cette branche.

* `testing` permet de mettre en place une nouvelle version d’un paquet qui sera ensuite testée.

* `stable` contient la version de production.

Le terme *composant* vient de la façon dont les dépôts sont configurés. Afin de se rapprocher de la façon dont les dépôts sont structurés dans Debian, l'entrée à ajouter dans les sources APT se construit ainsi :

```bash
deb http://repo.yunohost.org/debian/ nom_de_code composant [composant ...]
```

Avec *nom_de_code* la "version" de Debian installée sur l'hôte (ex. : `jessie`). Pour les composants, il est nécessaire de spécifier au moins `stable`, puis les différents intermédiaires. Par exemple, sur un système sous Debian Jessie, voici les différentes possibilités :

```bash
# composant stable
deb http://repo.yunohost.org/debian/ jessie stable
# composant testing
deb http://repo.yunohost.org/debian/ jessie stable testing
# composant unstable
deb http://repo.yunohost.org/debian/ jessie stable testing unstable
```

## Workflow

Le but du workflow est d’éviter toute intervention manuelle (lancement d’un script, …) sur le serveur, et de maîtriser la gestion des paquets via GitHub uniquement.

Ansi, les dépôts de chaque paquet yunohost possèdent trois branches correspondant aux trois composants (`unstable`, `testing` et `stable`). Le serveur de build construit et déploie **automatiquement** les paquets source et binaires Debian correspondant à l’état de ces trois branches sur GitHub.

### Branche unstable

Aucun commit dans la branche unstable ne modifie le fichier `debian/changelog` car celui-ci est modifié automatiquement lors du build quotidien, avec une version correspondant à la date/heure de construction.

Tout commit modifiant fonctionnellement les paquets doit se faire d’abord dans cette branche  `unstable`.

**TODO** ajouter un pre-commit hook pour éviter les erreurs ?

### Branche testing et stable - workflow standard

Aucun commit fonctionnel n’est effectué directement dans ces branches. On ne fait que des merges (merge de `unstable` dans `testing` et merge de `testing` dans `stable`).

Les seules modifications spécifiques à ces dépôts sont les changements de versions (modification de `debian/changelog`, puis tag).

Des outils à destinations des mainteneurs de paquets sont disponibles sur le dépôt [yunohost-debhelper](https://github.com/YunoHost/yunohost-debhelper)

```bash
git clone https://github.com/YunoHost/yunohost-debhelper
yunohost-debhelper/setup_git_alias.sh
```

Ceci va configurer un nouvel alias git nommé `yunobump`, global (stocké dans `~/.gitconfig` et donc accessible depuis n’importe quel dépôt git local).

<div class="alert alert-warning">
**Attention :** pour le moment ce helper `yunobump` ne fonctionne que sous Ubuntu ou Debian Jessie. Vous **devez** installer les paquets `git` et `git-buildpackage` pour que le helper fonctionne correctement.
</div>

#### Sans helper

1. Rendez-vous dans le repo du paquet que vous voulez builder
2. Assurez-vous que la branche `unstable` contient toutes les modifications que vous voulez intégrer dans votre build
3. Récupérez le numéro de version actuel : `head debian/changelog`
4. Rendez-vous sur la branche `testing` ou `stable`
5. Mergez ou cherry-pickez les commits que vous voulez intégrer à la version depuis la branche `unstable`
6. Modifiez le `debian/changelog` en intégrant les messages de commits correspondant aux modifications que vous avez intégré (ou utilisez `git-dch` pour le faire automatiquement)
7. Taguez la branche actuelle (`testing` ou `stable`) du numéro de version juste supérieur à l’actuel
8. Pushez vos modifications **ainsi que vos tags** sur le repo GitHub
9. Retournez sur la branche `unstable`
10. Mergez le changelog mis à jour précédemment
11. Pushez la branche `unstable`

#### Avec helper

```bash
# You Only Clone Once
$ git clone git@github.com:YunoHost/yunohost-config-nginx.git
$ cd yunohost-config-nginx

# Be sure to be up-to-date, and don't forget to get the tags !
$ git fetch --tags

# Checkout your branch : stable or testing
$ git checkout testing

# Do your 'functional' modifications: either merge unstable in testing, or merge testing in stable
$ git pull origin unstable
# Or just
$ git merge unstable

# What is the current version number in test ?
$ dpkg-parsechangelog | grep "^Version" | cut -d ' ' -f 2
# Or just
$ head debian/changelog

# Update changelog and do a proper tag (explained below)
$ git yunobump x.y.z-p

# Push the branch state AND the tags to the remote repository
$ git push origin --tags testing:testing

# Merge changelog modifications to the `unstable` branch
$ git checkout unstable
$ git merge testing
$ git push origin unstable
```

**TODO** politique sur les formats de tag, actuellement $branch/$version pour autoriser la même version dans deux branches différentes. est-ce vraiment souhaitable ?

**TODO** normalement à chaque push sur test ou stable, le dernier commit est un commit de changelog et il est taggué proprement. On doit pouvoir implémenter un hook git de pre-push qui empêche de pousser des trucs à moitié fait (une erreur dans git yunobump, un git tag -d, un commit à la main...)

#### Branche test et stable - faire un hotfix

Il peut arriver, de façon exceptionnelle, qu’on ait besoin de faire un hotfix (de sécurité par exemple) sur les paquets en `stable` ou en `test`, pour lequel le merge de la branche daily n’est pas acceptable (car trop de nouvelles fonctionnalités en développement sur daily).
**Cette situation doit rester exceptionnelle**

**TODO** à décrire

**TODO** dev un helper 'git yunohotfix ...' qui commit dans stable et cherry-pick tout de suite dans daily ? ou l’inverse ?

#### Paquets non YunoHost

Pour les paquets « non-YunoHost » (par exemple `rspamd`) le paquet ne passe pas par le composant `unstable`, mais uniquement `testing` et `stable` une fois les tests effectués sur ce paquet.


## Numéros de version

La version d'un paquet YunoHost est sous la forme : ``X.x.y[.z]``.

La première partie, ``X``, correspond à la version majeure de YunoHost, actuellement **2**.

La deuxième partie, ``x``, s’incrémente lors d’un changement fonctionnel important : ajout d’une nouvelle fonctionnalité, modification d’une façon de fonctionner, ... Les chiffres pairs correspondent à une version ``stable`` (ex. : **2.4.x**), tandis que les chiffres impairs à une version ``testing``.

La troisième partie, ``y``, s’incrémente quasi-arbitrairement, lors d’un lot de bugfixes ou d’un changement fonctionnel mineur. On peut trouver par exemple des paquets en **2.1.3** ou **2.1.5**.

Enfin, une quatrième partie, ``z``, est réservée dans les cas exceptionnels de bugfix. Dans ce cas, on veut faire passer un changement unique, généralement directement dans la branche ``stable`` (voir la partie s'y rapportant). Cela donne, par exemple, **2.1.3.1**.

Note : les paquets de YunoHost étants natfis pour Debian (dans le sens où nous gérons directement le *packaging* Debian avec le paquet), il n'y a pas de révision Debian dans le numéro de version (caractérisé par **-debian_revision**). Pour plus de détails sur les numéros de version, voir le [Debian Policy Manual](https://www.debian.org/doc/debian-policy/ch-controlfields.html#s-f-Version).


## Gestion des paquets

### Outils et méthode

#### Logiciels et scripts utilisés

Les principaux logiciels utilisés pour la gestion et construction des paquets sont les suivants :

 * [reprepro](https://mirrorer.alioth.debian.org/) : gérer localement un dépôt de paquets Debian
 * [rebuildd](https://julien.danjou.info/projects/rebuildd) : reconstruire des paquets Debian, avec un historique, une interface Web, ...

Pour plus de flexibilité, *rebuildd* délègue la construction du paquet à [pbuilder](https://pbuilder.alioth.debian.org/). Ce dernier permet notamment d'avoir différents environnements, architectures, ...

Enfin, pour gérer au mieux ces outils, deux scripts ont été développé, stockés dans `/usr/local/bin` :

 * `daily_build` : construire un ou tous les paquets YunoHost dans le composant **unstable** uniquement
 * `build_deb` : construire un paquet Debian depuis un répertoire, dans un composant et un nom de code donné

À noter également que d'autres scripts ont été fait pour *rebuildd* et *reprepro*, afin notamment de faire le pont entre les deux. Ils se trouvent dans `/usr/local/bin/{rebuildd,reprepro}`.

#### Déroulement de la construction d'un paquet

Tout est déclenché par *reprepro*, configuré (voir `/var/www/repo.yunohost.org/debian/conf/distribustion`) pour exécuter le script `/usr/local/bin/repo/process-include` chaque fois qu'un paquet est inclus dans un dépôt (plus précisément, qu'un fichier `.changes` est inclus, via la commande `reprepro include`). Ce dernier va vérifier un certain nombre de chose, dont le fait qu'il s'agit bien d'un paquet source, puis va ajouter une nouvelle tâche pour *rebuildd*, afin que le paquet soit créé.

Lorsque la tâche est reçue par *rebuildd*, si le paquet correspond bien à une distribution et architecture supportée (voir `/etc/rebuildd/rebuilddrc`), trois scripts seront exécutés les uns après les autres, si aucune erreur n'intervient :

1. `/usr/local/bin/rebuildd/get-sources` : récupération des sources depuis le dépôt local pour le paquet et la version demandée
2. `/usr/local/bin/rebuildd/build-binaries` : construction du paquet via *pbuilder* et l'environnement correspondant à la distribution et l'architecture
3. `/usr/local/bin/rebuildd/upload-binaries` : ajout du paquet binaire précédemment créé à *reprepro* dans le bon dépôt et composant

### Utilisation de daily\_build

Un cron défini pour l’utilisateur `pbuilder` se lance **tous les jours à 01:00**, qui exécute le script `daily_build`. Pour chaque paquet (`ssowat`, `yunohost` et `yunohost-admin`), le script met d'abord à jour le dépôt git correspondant depuis la branche *unstable*. Si de nouveaux commits ont été fait depuis la veille, une nouvelle version du paquet sera construit.

Plus précisément, une nouvelle entrée dans le *changelog* sera d'abord ajoutée, avec une version sous la forme **YYYY.MM.DD+HHMM**. Un paquet source sera ensuite construit, avant de passer le relais au script `/usr/local/bin/repo/include-changes`. Ce dernier va exécuter les bonnes commandes pour *reprepro* afin d'inclure dans le bon dépôt et composant le paquet source fraîchement créé.

#### (Re)build d’un paquet YunoHost

Il est possible de relancer manuellement le build d’un paquet :

```bash
$ daily_build -p <nom_du_paquet>
```

Il est aussi possible d'utiliser une branche autre que *unstable* :

```bash
$ daily_build -p <nom_du_paquet> -b <branch>
```

*Notez bien que ce script permet uniquement de construire des paquets dans le composant **unstable** !*

### Utilisation de build\_deb

Ce script permet de construire un paquet Debian quelconque, et de l'inclure dans un dépôt donné. Il est notamment utilisé pour construire les paquets `rspamd` et `rmilter`. Une fois le paquet source récupéré et extrait, il suffit de lancer la commande suivante :

```bash
$ build_deb -c distribution -d <composant> /chemin/du/paquet/source
```

### Gestion du dépôt

#### Lister les paquets

```bash
$ reprepro -V -b /var/www/repo.yunohost.org/debian -C <composant> list <nom_de_code>
```

#### Suppression d’un paquet

```bash
$ reprepro -V -b /var/www/repo.yunohost.org/debian -C <composant> remove <nom_de_code> nom_du_paquet
```

#### Gestion des backports

Pour la gestion des paquets venant du dépôt backport, il est possible de les intégrer rapidement dans le dépôt de yunohost.

Pour ce faire il faut ajouter le nom du paquet dans le fichier `/var/www/repo.yunohost.org/debian/conf/<nom_de_code>-<composant>.list`, puis exécuter la commande : 

```bash
$ reprepro -V -b /var/www/repo.yunohost.org/debian -C <composant> update <nom_de_code>
```
