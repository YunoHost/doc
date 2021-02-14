---
title: Utiliser Git pour packager les applications
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_git'
---

Git... Notre cher Git bien-aimé, que l'on peut aussi décrire comme "Goddamn Idiotic Truckload of sh*t"  (Un stupide putain gros tas de m\*rde), selon Linus.  
Si vous ne connaissez pas encore Git, soyez sûr que vous serez bientôt d'accord avec cette description.

YunoHost et toutes nos applications sont sur la forge Git GitHub. Ce qui veut dire que si vous voulez travailler sur une application, tôt ou tard vous allez devoir faire face à Git.  
Alors voyons comment travailler avec Git pour pouvoir contribuer dans le contexte de YunoHost.

## Travailler avec GitHub

Commençons par la partie facile, GitHub est livré avec une interface web "facile" à utiliser.

*Tout d'abord et malheureusement, il n'y a pas moyen de contourner ça, vous devez avoir un compte sur GitHub.*

#### Branches

Ensuite, et c'est probablement l'une des choses les plus importantes, **ne travaillez pas directement sur la branche master**.  
Désolé, il fallait que ce soit dit !

Les branches sont, comme l'explique GitHub, "*une version parallèle d'un dépôt. Elle est contenue dans le dépôt, mais n'affecte pas les autres branches. Elle vous permet de travailler librement sans perturber la version "live".*"

La branche master est la branche qui contient la version de l'application que les utilisateurs installeront et utiliseront effectivement.  
La bonne habitude à prendre est de travailler à partir de la branche testing, et lorsque tout est réglé et testé, vous pouvez fusionner la branche testing dans master, afin que les utilisateurs puissent profiter de la nouvelle version de votre package.

Pour voir et modifier la branche actuelle, utilisez ce bouton :  
![](image://github_branch.png)

#### Modifier un fichier

Maintenant que vous êtes sur la bonne branche, voyons comment éditer un fichier sur GitHub.

Vous pouvez éditer n'importe quel fichier en utilisant l'icône du petit crayon :  
![](image://github_edit.png)

Si vous n'avez pas la permission d'écrire sur le dépôt, vous verrez (comme sur l'image) que vous allez créer un fork (nous verrons plus loin ce qu'est un fork).  
Si vous avez la permission d'écrire, vous allez simplement modifier le fichier, sans forker.

#### Validez vos modifications

Lorsque vous avez fini de modifier le fichier, vous pouvez faire un commit de vos modifications.  
Derrière ce mot, l'idée est assez simple, vous allez juste enregistrer vos modifications...  
![](image://github_commit.png)

Le premier champ est le nom de votre commit, une phrase très courte pour expliquer pourquoi vous avez fait cette modification.  
Le deuxième champ est un champ plus grand pour une explication plus complète, si vous en avez besoin.

Enfin, si vous modifiez un dépôt sur lequel vous avez la permission d'écrire, vous pouvez soit faire un commit directement sur la branche en cours, soit créer une nouvelle branche.  
Il est généralement préférable de créer une nouvelle branche, de cette façon vous gardez vos modifications sur une version *parallèle* du dépôt. Vos modifications seront discutées dans une pull request (expliquée ci-dessous) puis finalement fusionnées dans la branche d'origine.

#### Forker ou ne pas forker

Un fork est une copie d'un dépôt sur votre propre compte.  
Nous avons déjà vu que si vous n'avez pas l'autorisation d'écrire dans un dépôt, la modification d'un fichier créera automatiquement un fork.  
Comme le fork est sur votre compte, vous avez toujours la permission d'écrire dessus.  
Mais même si un fork n'est pas le véritable dépôt, mais juste une copie, un fork est toujours lié à son parent. Nous verrons plus tard que la création d'un fork est vraiment utile lors de l'ouverture d'une pull request.

Lorsque vous créez un nouveau package, il est courant d'utiliser l'[application exemple](https://github.com/YunoHost/example_ynh) comme base.  
Mais, comme vous ne voulez pas garder ce lien vers l'application d'exemple, vous ne devez pas forker l'application d'exemple. Vous la clonerez plutôt.  
Malheureusement, cloner une application est un peu plus compliqué sur GitHub. Nous verrons plus tard comment cloner vers un dépôt local à la place.

Nous avons vu comment éditer un fichier, et comment cela peut forker l'application.  
Mais, lorsque vous voulez éditer plusieurs fichiers, l'interface GitHub n'est pas vraiment la meilleure solution. Dans une telle situation, vous préférerez cloner le dépôt et travailler sur un dépôt local.  
Il se peut que vous deviez tout de même forker sur votre propre compte pour pouvoir enregistrer vos modifications si vous n'avez pas les autorisations sur le dépôt distant.

#### Pull request

Après avoir effectué vos commits, que ce soit sur une branche ou un fork, vous souhaitez proposer vos modifications pour qu'elles soient intégrées dans le dépôt principal, ou dans la branche d'origine.  
Pour ce faire, vous allez créer une pull request. GitHub vous demande généralement directement si vous souhaitez le faire.
Sinon, vous trouverez le bouton de création d'une pull request juste ici :  
![](image://github_pull_request.png)

Lors de la création d'une pull request à partir d'un fork, pour faciliter le travail de révision du code, **ne jamais** décocher la case *Allow edits from maintainers*. Cette option permet simplement aux mainteneurs du dépôt d'origine de modifier directement votre travail.

#### Organisation YunoHost-Apps

Conformément à la [YEP 1.7](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines.md#yep-17), votre application doit être intégrée à l'organisation YunoHost-Apps, mais si vous n'avez jamais contribué à une application auparavant ou si vous n'avez jamais eu d'application dans cette organisation, vous n'en aurez peut-être pas l'autorisation.

Tout d'abord, vous devez avoir la permission d'écrire dans l'organisation, pour ce faire, demandez au groupe Apps sur le salon XMPP Apps.

Pour transférer votre application sur l'organisation YunoHost-Apps, allez dans votre dépôt et dans l'onglet *Settings*.  
En bas de la page, vous trouverez *Transfer ownership*.  
Dans le champ *New owner’s GitHub username or organization name*, tapez *YunoHost-Apps*.  
Votre dépôt sera déplacé dans l'organisation, vous n'avez pas besoin de supprimer le dépôt d'origine.


## Travailler avec Git en local

Comme nous l'avons vu, vous pouvez faire beaucoup de choses directement sur GitHub.  
Mais lorsque vous devez modifier plusieurs fichiers, ou lorsque vous devez travailler sur votre code de votre côté, il est préférable de travailler directement sur votre ordinateur.

Avant d'aller dans la partie infernale de Git, voyons 2 façons différentes de commencer à travailler avec Git.

#### Premier cas : Créer un nouveau package

Vous avez découvert, choqué, que la merveilleuse application que vous aimez utiliser tous les jours n'a pas encore son package YunoHost. Et parce que vous êtes sympa, vous avez décidé de créer vous-même le package, pour que tout le monde puisse apprécier cette application.  
Quelle bonne idée !

Le mieux est de commencer par l'[application d'exemple](https://github.com/YunoHost/example_ynh). Mais comme nous l'avons déjà expliqué, vous ne voulez pas forker, parce que si vous le faites, vous allez garder ce lien vers l'application d'exemple et c'est vraiment ennuyeux.  
Donc, vous allez le faire différemment. Vous allez cloner !

##### git clone

Pour cloner, vous allez faire :
```bash
git clone https://github.com/YunoHost/example_ynh
```
`git clone` téléchargera une copie du dépôt. Vous aurez le dépôt complet, avec ses branches, ses commits, et tout le reste (dans cet apparent petit répertoire `.git`).

git clone est généralement le point de départ de tout travail local avec Git.

*Toutefois, si vous comptez envoyer vos modifications sur le dépôt distant sur GitHub, assurez-vous d'avoir les droits d'écriture sur ce dépôt. Sinon, forkez avant et clonez votre fork, pour lequel vous avez la permission.*

##### Mon nouveau package, suite

Dans le contexte d'un nouveau package, vous devrez également créer un dépôt sur GitHub pour y mettre votre package.  
Ce qui n'est pas plus compliqué qu'un gros bouton vert *New*.  
Ne vous embêtez pas avec des README, .gitignore ou licence. Créez simplement le dépôt lui-même.  
vous pouvez maintenant cloner ce nouveau dépôt avec Git.  
![](image://github_create_new_repo.png)

Vous disposez maintenant de 2 dépôts clonés sur votre ordinateur.  
Copiez tous les fichiers de l'application example_ynh, **excepté le répertoire .git** (vous voulez juste les fichiers eux-mêmes) dans votre nouveau package.

*Si vous le souhaitez, vous pouvez supprimer l'application example_ynh. Nous n'en avons plus besoin.*

Vous êtes prêt à travailler sur votre nouveau package !

#### Deuxième cas : Travailler localement sur un dépôt

Vous disposez déjà d'un dépôt, mais ce que vous voulez, c'est travailler localement, de sorte que vous puissiez modifier plusieurs fichiers.  
Il vous suffit de cloner le dépôt, le répertoire .git est le lien vers le dépôt distant. Rien d'autre à faire qu'un `git clone`.

#### Branches

Vous avez bien votre copie local du dépôt, mais comme vous avez lu attentivement cette documentation jusque-là, vous savez que vous devez vous assurer d'être sur la branche testing avant de commencer à travailler.

Pour voir les branches, et savoir sur quelle branche vous êtes réellement, alors que vous êtes dans le répertoire de votre dépôt, tapez `git branch`.  
La branche courante est mise en évidence et précédée d'un "*".

#### git checkout

S'il apparaît que vous n'êtes pas sur la branche où vous vouliez être, ou que vous êtes en fait sur master (ce qui est mal !), vous pouvez passer à une autre branche avec `git checkout`.
```bash
git checkout testing
```
*Lisez attentivement ce que Git dit quand vous validez une commande, n'oubliez jamais que Git est sournois...*

#### git pull avant tout

Vous êtes enfin dans la bonne branche, et prêt à travailler.  
**Attendez ! Un vilain piège vous attend...**  
Avant de vous retrouver dans une situation inextricable. Commencez par un `git pull` pour mettre à jour votre branche avec les derniers changements du dépôt distant.

*Parfois, vous rencontrerez une situation impossible où Git vous dira que vous ne pouvez pas pull parce que vous avez des changements locaux. Mais vous ne vous souciez pas de ces modifications locales, vous voulez juste obtenir la dernière version de la branche distante. Mais Git ne se soucie pas de ce que VOUS voulez...*  
*Je dois admettre que ma seule solution est aussi efficace que sale... Un bon vieux `rm -r` du dépôt et un `git clone`*

#### Il est temps de travailler

Vous pouvez finalement travailler sur votre code.  
Lorsque vous êtes enfin d'accord avec ce que vous avez fait, il est temps de valider votre travail.

La première étape consiste à informer Git sur le(s) fichier(s) à valider. Pour ce faire, nous utiliserons `git add`.
```bash
git add mon_fichier
ajouter mon_autre_fichier et_aussi_celui_ci
```
Si vous souhaitez valider l'ensemble de votre travail, vous pouvez aussi simplement faire
```bash
git add --all
```

Pour vérifier l'état actuel de votre validation, vous pouvez utiliser `git status`. Il vous montrera quels fichiers seront inclus dans votre commit, et quels fichiers sont modifiés, mais pas encore inclus.  
`git status -v` vous indiquera également quelle partie des fichiers est modifiée. Une bonne façon de s'assurer que vous n'avez pas fait d'erreur avant de faire un commit.

#### git checkout -b

Avant de faire un commit, ou après, ou avant de commencer à travailler. Quand vous en avez envie !  
Vous devriez envisager d'ajouter votre travail à une branche séparée, de cette façon, il sera facile de créer une pull request dans la branche testing et de discuter avec les autres packagers de ce que vous suggérez de changer.

Pour créer une nouvelle branche et passer à cette branche, vous pouvez utiliser `git checkout -b my_new_branch`.

#### Commit

Faire un commit, c'est simplement valider son travail dans Git. Comme vous pouvez le faire dans GitHub.  
Pour avoir les mêmes champs que vous aviez sur GitHub, avec le nom du commit, et une explication plus longue. Vous pouvez simplement utiliser `git commit`.  
La première ligne, avant les commentaires, est pour le nom du commit.  
Après tous les commentaires, vous pouvez ajouter une explication si vous le souhaitez.

Si vous voulez faire un commit avec seulement un nom pour votre commit, vous pouvez utiliser une simple commande :
```bash
git commit -m "My commit name"
```

#### Push vers le dépôt distant

Vos modifications sont validées, mais uniquement sur votre clone local du dépôt. Maintenant, vous devez renvoyer ces modifications sur le dépôt distant sur GitHub.  
Pour ce faire, vous devez savoir quelle est votre branche actuelle. (Si vous ne le savez pas, `git branch` vous donnera cette information).  
Ensuite, vous pouvez git push
```bash
git push -u origin BRANCH_NAME
```
