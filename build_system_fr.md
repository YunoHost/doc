#Création de paquet Debian

## Architecture
Le système se compose de `rebuildd` qui est un front-end pour `pbuilder`, des chroot pbuilder pour i386, amd64, armhf et de `reprepro` pour le système de repo debian.

---

## Workflow

Il existe trois repo (`unstable`, `testing` et `stable`):
* Les paquets du repo `unstable` (aussi appelé `daily` à certains endroits) correspondent à la dernière version du git, et sont reconstruits de façon automatisée toutes les nuits.

* Le repo `testing` (aussi appelé `test` à certains endroits) permet de mettre en place une nouvelle version d'un paquet qui sera ensuite testé

* Le repo `stable` (aussi appelé `megusta` à certains endroits) contient la version de production

Le but du workflow est d'éviter toute intervention manuelle (lancement d'un script, ...) sur le serveur, et de maîtriser la gestion des paquets via GitHub uniquement.

Ansi, les dépôts de chaque paquet yunohost possèdent 3 branches correspondant aux trois dépôts (`unstable`, `testing` et `stable`). Le serveur de build construit et déploie **automatiquement** les paquets source et binaires Debian correspondant à l'état de ces trois branches sur GitHub.

### Branche unstable

Aucun commit dans la branche unstable ne modifie le fichier `debian/changelog` car celui-ci est modifié automatiquement lors du build quotidien, avec une version correspondant à la date/heure de construction.

Tout commit modifiant fonctionnellement les paquets doit se faire d'abord dans cette branche  `unstable`.

**`TODO`** ajouter un pre-commit hook pour éviter les erreurs ?

### Branche testing et stable - workflow standard

Aucun commit fonctionnel n'est effectué directement dans ces branches. On ne fait que des merges (merge de `unstable` dans `testing` et merge de `testing` dans `stable`).

Les seules modifications spécifiques à ces dépôts sont les changements de versions (modification de `debian/changelog`, puis tag).

Des outils à destinations des mainteneurs de paquets sont disponibles sur le dépôt [yunohost-debhelper](https://github.com/YunoHost/yunohost-debhelper)
```bash
git clone https://github.com/YunoHost/yunohost-debhelper
yunohost-debhelper/setup_git_alias.sh
```
Ceci va configurer un nouvel alias git nommé `yunobump`, global (stocké dans `~/.gitconfig` et donc accessible depuis n'importe quel dépôt git local).

<div class="alert alert-warning">
**Attention :** Pour le moment ce helper `yunobump` ne fonctionne que sous Ubuntu ou Debian Jessie. Vous **devez** installer les paquets `git` et `git-buildpackage` pour que le helper fonctionne correctement.
</div>

#### Sans helper

1. Rendez-vous dans le repo du paquet que vous voulez builder
2. Assurez-vous que la branche `unstable` contient toutes les modifications que vous voulez intégrer dans votre build
3. Récupérez le numéro de version actuel : `head debian/changelog`
4. Rendez-vous sur la branche `testing` ou `stable`
5. Mergez ou cherry-pickez les commits que vous voulez intégrer à la version depuis la branche `unstable`
6. Modifiez le `debian/changelog` en intégrant les messages de commits correspondant aux modifications que vous avez intégrer (ou utilisez `git-dch` pour le faire automatiquement)
7. Taggez la branche actuelle (`testing` ou `stable`) du numéro de version juste supérieur à l'actuel
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

**`TODO`** politique sur les format de tag, actuellement $branch/$version pour autoriser la même version dans deux branches différentes. est-ce vraiment souhaitable ?

**`TODO`** normalement à chaque push sur test ou stable, le dernier commit est un commit de changelog et il est taggué proprement. on doit pouvoir implémenter un hook git de pre-push qui empêche de pousser des trucs à moitié fait (une erreur dans git yunobump, un git tag -d, un commit à la main...)

#### Branche test et stable - faire un hotfix

Il peut arriver, de façon exceptionnelle, qu'on ait besoin de faire un hotfix (de sécurité par exemple) sur les paquets en `stable` ou en `test`, pour lequel le merge de la branche daily n'est pas acceptable (car trop de nouvelles fonctionnalités en développement sur daily).
** Cette situation doit rester exceptionnelle **

**`TODO`** à décrire

**`TODO`** dev un helper 'git yunohotfix ...' qui commit dans stable et cherry-pick tout de suite dans daily ? ou l'inverse ?

#### Paquets non YunoHost

Pour les paquets « non-YunoHost » (par exemple `python-bottle`) le paquet ne passe pas par le repo `unstable`, une fois les tests effectués sur ce paquet, ils devront être envoyés manuellement dans le repo `backport`.

---

## Numéros de version

YunoHost est en version **2** globalement, donc le numéro de la version doit, jusqu'à nouvel ordre, être sous la forme **2.x.x**.

La deuxième partie s'incrémente lors d'un changement fonctionnel important : Ajout d'une nouvelle fonctionnalité, modification d'une façon de fonctionner. Pour l'instant tous les paquets se trouvent en version **2.1.x**.

La troisième partie s'incrémente quasi-arbitrairement, lors d'un bugfix ou d'un changement fonctionnel mineur. On trouve actuellement des paquets en **2.1.3** ou **2.1.5** par exemple.

Enfin, une quatrième partie est réservée dans les cas exceptionnels de bugfixes en stable. Dans ce cas, on veut faire passer un changement unique directement dans la branche stable, on préfixe donc le numéro par **-x**, **x** étant le numéro du hotfix. Donnant par exemple **2.1.3-1**.

---

## Gestion des paquets

#### Daily build

Un cron défini pour l'utilisateur `pbuilder` se lance **tous les jours à 01:00**. Ce script va mettre à jour le repo git `packages` et ses submodules (`ssowat`, `moulinette`, `moulinette-yunohost` et `admin_js`). 
Une fois les sources mises à jour, le script va rebuilder les paquets qui ont été mis à jour la veille.

Pour ce faire on va créer des paquets sources qui vont ensuite être mis dans le répertoire `/var/www/repo.yunohost.org/daily/incomming`.

Lancer ensuite l'ajout de ces fichiers source au repo, ce lancera automatiquement un job dans `rebuildd` (voir configuration du repo daily dans `/var/www/repo.yunohost.org/daily/conf/distribustion`).

Une fois les paquets buildés, ils sont ajoutés au repo `unstable`.


#### (Re)build d'un paquet YunoHost

Il est possible de relancer manuellement le build d'un paquet.

```bash
$ daily_build -p nom_du_paquet
```

#### Build d'un paquet non YunoHost

```bash
$ build_deb /path/du/paquet
```

**`TODO`** à décrire : besoin de bump la version pour un passage test->stable

### Passage de `daily` à `test`

```bash
$ push-packages-test -p nom_du_paquet
```

Il est possible d'utiliser l'option `-v` pour définir manuellement la version du paquet.

Le script va récuperer les sources du paquet dans `daily` puis ouvrir le changelog pour y définir la version et la liste des changements. Le build paquet sera ensuite ajouté à la liste des jobs de rebuildd qui le passera dans le repo `test`.

**Attention :** le nom de version ne doit pas contenir `daily` sinon le paquet sera ajouté au repo `daily`.


### Passage de `test` à `stable`

```bash
$ push-package-stable -p nom_du_paquet
```

Cette commande passe simplement le paquet du repo `test` à `stable`, sans rebuild.


### Gestion du repo avec `reprepro`

* Suppression d'un paquet
```bash
$ reprepro -V -b /var/www/repo.yunohost.org/nom_du_repo/ remove megusta nom_du_paquet
```

* Ajout d'un paquet debian dans un repo
```bash
$ reprepro -V -b /var/www/repo.yunohost.org/nom_du_repo/ includedeb megusta nom_du_paquet.deb
```

### Gestion des backports
Pour la gestion des paquets venant du dépôt backport il est possible de les intégrer rapidement dans le repo test de yunohost

Pour ce faire il faut ajouter le nom du paquet dans le fichier `/var/www/repo.yunohost.org/test/conf/list` puis lancer la commande 
```bash
$ reprepro -V -b /var/www/repo.yunohost.org/test update megusta
```
Les paquets vont être télécharger et ajouté au repo `test` 

