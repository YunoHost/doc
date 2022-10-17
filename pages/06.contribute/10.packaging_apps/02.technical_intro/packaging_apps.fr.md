---
title: Packaging d'applications
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps'
---

![](image://yunohost_package.png?resize=100)

Ce document a pour but de vous apprendre à packager une application pour YunoHost.

! This page is outdated and should be reworked

### Prérequis
Pour packager une application, voici les prérequis :
* Un compte sur un serveur Git comme [GitHub](https://github.com/) pour pouvoir ensuite publier l’application ;
* Maîtriser un minimum [Git](/packaging_apps_git), le Shell et d’autres notions de programmation ;
* Une [machine virtuelle ou sur un serveur distant](/install) ou un environnement de développement, [ynh-dev](https://github.com/yunohost/ynh-dev) ou [VirtualBox](/packaging_apps_virtualbox), pour packager et tester son paquet.


Si vous ne comprenez pas ces prérequis, ou si vous ne savez pas comment écrire du code, consulter d'abord l'[introduction au packaging](/packaging_apps_start).

### Contenu
Un paquet YunoHost est composé :

* d’un `manifest.json`
* d’un dossier `scripts`, composé de six scripts Shell `install`, `remove`, `upgrade`, `backup`, `change_url` et `restore`
* de dossiers optionnels, contenant les `sources` ou de la `conf`
* d’un fichier `LICENSE` contenant la licence du paquet
* d’une page de présentation du paquet contenu dans un fichier `README.md`

[div class="btn btn-lg btn-default"] [Paquet de base](https://github.com/YunoHost/example_ynh) [/div] n’hésitez pas à vous en servir comme base de travail.

## Manifeste
[div class="btn btn-lg btn-default"] [Manifeste](/packaging_apps_manifest) [/div]

## Les scripts
[div class="btn btn-lg btn-default"] [Scripts](/packaging_apps_scripts) [/div]

### Architecture et arguments
Comme les instances de YunoHost possèdent une architecture unifiée, vous serez capable de deviner la plupart des réglages nécessaires. Mais si vous avez besoin de réglages spécifiques, comme le nom de domaine ou un chemin web pour configurer l’application, vous devrez les demander aux administrateurs lors de l’installation (voir la section `arguments` dans le § **Manifeste** ci-dessus).

[div class="btn btn-lg btn-default"] [Gestion des arguments](/packaging_apps_arguments_management) [/div]

### Configuration NGINX
[div class="btn btn-lg btn-default"] [Configuration NGINX](/packaging_apps_nginx_conf) [/div]

### Multi-instance
[div class="btn btn-lg btn-default"] [Multi-instance](/packaging_apps_multiinstance) [/div]

### Hooks
[div class="btn btn-lg btn-default"] [Hooks](/packaging_apps_hooks) [/div]

### Commandes pratiques
[div class="btn btn-lg btn-default"] [Commandes pratiques](/packaging_apps_helpers) [/div]


### Améliorer la qualité du paquet d’installation
Vous trouverez ci-dessous une liste des points à vérifier concernant la qualité de vos scripts :
* Vos scripts utilisent bien `sudo cp -a ../sources/. $final_path` plutôt que `sudo cp -a ../sources/* $final_path` ;
* Votre script d’installation contient une gestion en cas d’erreurs du script pour supprimer les fichiers résiduels à l’aide de `set -e` et de [trap](/packaging_apps_trap) ;
* Votre script d’installation utilise une méthode d’installation en ligne de commande plutôt qu’un appel curl via un formulaire web d’installation ;
* Votre script d’installation enregistre les réponses de l’utilisateur ;
* Vous avez vérifié les sources de l’application avec une somme de contrôle (sha256, sha1 ou md5) ou une signature PGP ;
* Vos scripts ont été testés sur Debian Buster 32 bits, 64 bits et ARM ;
* Les scripts backup et restore sont présents et fonctionnels.

Pour mesurer la qualité d'un paquet, celui-ci obtiendra un [niveau](/packaging_apps_levels), déterminé en fonction de divers critères d'installation et selon le respect des [règles de packaging](/packaging_apps_guidelines).

### Script de vérification du paquet
[div class="btn btn-lg btn-default"] [Vérificateur de paquets](https://github.com/YunoHost/package_checker) [/div]

Il s’agit d’un script Python qui vérifie :
* que le paquet est à jour concernant les dernières spécifications
* que tous les fichiers sont présents
* que le manifeste ne comporte pas d’erreur de syntaxe
* que les scripts quittent bien avant de modifier le système lors de vérifications.

### Intégration continue

Un serveur d'intégration continue est a disposition des packagers désirant tester leurs applications.  
[div class="btn btn-lg btn-default"] [Intégration continue](packaging_apps_ci) [/div]

### Publiez et demandez des tests de votre application

* Demandez des tests et des retours sur votre application en publiant un [post sur le Forum](https://forum.yunohost.org/) dans la [catégorie `Discussion > Apps`](https://forum.yunohost.org/c/discuss/discuss-apps/).

* Si votre paquet et l'application qu'il contient sont sous licence libre, faites une demande d’ajout de votre application dans le [dépôt des applications](https://github.com/YunoHost/apps) (voir aussi [la liste des apps](/apps)). Vous pouvez ajouter une application même si celle-ci n'est pour le moment pas fonctionelle : l'état d'avancement peut être `notworking`, `inprogress` ou `working`.

* Si votre application n'est *pas* sous licence libre, il se peut qu'une liste non-officielle soit créée pour gérer ces applications. Ce n'est pour l'instant pas le cas.

### Officialisation d’une application

**!! Section obsolète au 08/03/19** - Le fonctionnement du projet est en cours d'évolution sur ce point.

Pour qu’une application devienne officielle, elle doit être suffisamment testée, stable et fonctionner sous Debian Buster 64 bits, 32 bits et ARM. Si ces conditions vous paraissent réunies, demandez l’[intégration officielle](https://github.com/YunoHost/apps) de votre application.
