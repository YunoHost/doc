---
title: Propulser une contribution avec Git
template: docs
taxonomy:
    category: docs
routes:
  default: '/doc_use_git'
---

Il est bien sûr possible de contribuer directement sur la documentation de YunoHost, mais ce n’est pas la manière la plus pratique de le faire tant pour le·la contributeur·rice que pour la personne qui va injecter votre contribution dans la documentation. Voici un tutoriel pour comprendre et créer une contribution à la documentation de YunoHost en utilisant l’outil [Git (en)](https://git-scm.com/) et [github.com](http://github.com/) qui est le service de forge Git qui héberge et stocke le code source de YunoHost ainsi que sa documentation.

## Création d’un compte sur github.com
Pour pouvoir envoyer vos contributions via GitHub, il est nécessaire d’avoir un compte sur GitHub. Pour créer le compte vous aurez besoin d’une adresse e-mail valide à laquelle vous avez accès. GitHub est un outil puissant qui propose de nombreuses fonctionnalités, l’interface peut être un peu effrayante au début.
Vous n’êtes pas obligé·e de donner vos noms et prénoms, vous pouvez utiliser un pseudonyme (lors de l’inscription `Username`).


## Forker la documentation de YunoHost dans votre dépôt personnel
Forker le code source permet de créer une nouvelle branche de développement d’un code source de logiciel ou dans le cas présent, le code source de la documentation. En créant une nouvelle branche, cela vous permet de modifier le code et d’ajouter vos contributions sans altérer le code de la branche `master` qui est le rendu public de la documentation. Ce qui vous permet de ne pas devoir tout marquer mais le faire en plusieurs étapes. (Notamment pour les contributions demandant plus de temps de travail).

Forker un projet sur GitHub est extrêmement simple, il suffit de cliquer sur le bouton Fork, cela créera un nouveau dépôt sur votre espace de GitHub.
![Capture d’écran bouton fork GitHub](image://github_fork_button.png)

Dans le titre du nouveau dépôt, vous verrez de quelle provenance vient le dépôt, dans le cas présent `YunoHost/doc`
![Capture d’écran titre et sous-titre du dépot](image://github_fork_title.png)

> **Point de vigilance !**

> Si vous forkez le dépôt d’un·e autre contributeur·rice que YunoHost, vous aurez les mêmes fichiers. Sauf que quand vous enverrez vos modifications, elles seront envoyées au contributeur et non au dépôt YunoHost. L’avantage est que ça vous permet de développer une autre branche créée par le·la contributeur·rice et ainsi travailler avec une autre personne à une amélioration avant proposition au dépôt principal.
> Il n’est pas possible d’avoir un fork du dépot d’un·e contributeur·rice et le fork dépôt d’origine au même moment dans votre propre dépôt.

## Modifier et ajouter votre contribution
Une fois le dépôt forké (copié), il faudra créer une nouvelle branche de développement au sein de votre dépôt. C’est à travers cette branche que vous allez modifier les fichiers et ainsi proposer des améliorations de la documentation. Le fait que ce soit une nouvelle branche vous permettra par la suite de faire une Pull Request, c’est à dire une demande d’ajout de vos contributions au sein de la branche `master` qui est la branche principale de la documentation. Les règles de développement sur GitHub changent selon les développeurs de chaque dépôt, certains ont une branche testing dans laquelle il faut proposer les contributions.
Plus d’informations sur ce qu’est une branche sur git-scm.com : [Les branches avec Git - Ce qu’est une branche](https://git-scm.com/book/fr/v1/Les-branches-avec-Git-Ce-qu-est-une-branche).

## Envoyer votre contribution par une Pull Request
Faire une Pull Request correspond au moment où vous souhaitez partager votre travail avec le reste des contributeurs⋅rices et l’intégrer au dépot master (dépôt principal de YunoHost). Lors de la publication d’une Pull Request, couramment nommée PR, les contributeurs⋅rices pourront amender, commenter, ajouter, corriger votre contribution avant intégration complète au dépôt.

## Suivre votre contribution et prendre en compte les retours des contributeurs·trices
Lorsque vous avez déjà fait une PR (Pull Request), les modifications de votre branche de développement sur le dépôt Git se rajouteront automatiquement à la PR. Cela ne nécessite aucune action supplémentaire. Vous pouvez aussi intégrer les propositions de modifications de contributeurs, qui lorsqu’ils·elles auditeront le code, peuvent trouver des erreurs ou de nouvelles formulations plus adaptées.

## Faire remonter des erreurs et des souhaits par des issues
YunoHost dispose d’un dépôt Git spécifique pour le recueil des issues : [github.com/YunoHost/issues](https://github.com/YunoHost/issues)
Une issue aussi appelé ticket, est un problème identifié ou alors un souhait de développement ; dans le cas présent pour la documentation, mais c’est valable pour tout dépôt logiciel. Dans le cadre de la documentation de YunoHost il sera surtout proposé des issues pour le développement de la documentation, les problèmes identifiés étant facilement corrigeables.

## Aller plus loin avec Git et travailler sur son poste de travail
Utiliser la puissance de Git et ainsi travailler sur son ordinateur personnel, permet entre autres de ne pas avoir à créer de `commit` à chaque enregistrement intermédiaire des pages de documentations modifiées. Cela permet aussi d’utiliser des outils et logiciels qui permettent une distinction plus facile des codes utilisés dans une page de documentation.

- Ressource en ligne : [docs.microsoft.com - Configurer un référentiel Git localement pour la documentation](https://docs.microsoft.com/fr-fr/contribute/get-started-setup-local)

## Quelques ressources ailleurs sur le net pour aller plus loin
 - [Gérer son code avec Git et GitHub - openclassrooms.com](https://openclassrooms.com/fr/courses/2342361-gerez-votre-code-avec-git-et-github)
 - [Interface utilisateurs·trices de Git - git-scm.com](https://git-scm.com/download/gui/linux)
