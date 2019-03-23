# Packaging d’applications <img src="/images/yunohost_package.png" width=100/>

Ce document a pour but de vous apprendre à packager une application pour YunoHost.

### Prérequis
Pour packager une application, voici les prérequis :
* Un compte sur un serveur git comme [GitHub](https://github.com/) pour pouvoir ensuite publier l’application ;
* Maîtriser un minimum `git`, le Shell et d’autres notions de programmation ;
* Une [machine virtuelle ou sur un serveur distant](/install_fr) ou un environnement de développement, [ynh-dev](https://github.com/yunohost/ynh-dev) ou [VirtualBox](/packaging_apps_virtualbox_fr), pour packager et tester son paquet.


Si vous ne comprenez pas ces prérequis, ou si vous ne savez pas comment écrire du code, consulter d'abord l'[introduction au packaging](/packaging_apps_start_fr).

### Contenu
Un paquet YunoHost est composé :

* d’un `manifest.json`
* d’un dossier `scripts`, composé de six scripts Shell `install`, `remove`, `upgrade`, `backup`, `change_url` et `restore`
* de dossiers optionnels, contenant les `sources` ou de la `conf`
* d’un fichier `LICENSE` contenant la licence du paquet
* d’une page de présentation du paquet contenu dans un fichier `README.md`

<a class="btn btn-lg btn-default" href="https://github.com/YunoHost/example_ynh">Paquet de base</a> n’hésitez pas à vous en servir comme base de travail.

## Manifeste
<a class="btn btn-lg btn-default" href="packaging_apps_manifest_fr">Manifeste</a>

## Les scripts
<a class="btn btn-lg btn-default" href="packaging_apps_scripts_fr">Scripts</a>

### Architecture et arguments
Comme les instances de YunoHost possèdent une architecture unifiée, vous serez capable de deviner la plupart des réglages nécessaires. Mais si vous avez besoin de réglages spécifiques, comme le nom de domaine ou un chemin web pour configurer l’application, vous devrez les demander aux administrateurs lors de l’installation (voir la section `arguments` dans le § **Manifeste** ci-dessus).

<a class="btn btn-lg btn-default" href="packaging_apps_arguments_management_fr">Gestion des arguments</a>

### Configuration Nginx
<a class="btn btn-lg btn-default" href="packaging_apps_nginx_conf_fr">Configuration Nginx</a>

### Multi-instance
<a class="btn btn-lg btn-default" href="packaging_apps_multiinstance_fr">Multi-instance</a>

### Hooks
<a class="btn btn-lg btn-default" href="packaging_apps_hooks_fr">Hooks</a>

### Commandes pratiques
<a class="btn btn-lg btn-default" href="packaging_apps_helpers_fr">Commandes pratiques</a>

### Référencement des logs
Dans de nombreuses situations, vous pouvez vouloir indexer un fichier de log pour qu'il soit affiché dans la webadmin. Pour indexer un log, il faut créer un fichier d'indexation dans `/var/log/yunohost/categories/app/APPNAME.yml`.

Il est possible de spécifier la date de début en commençant le nom de fichier par la date `YYYYMMDD-HHMMSS`.

Exemple de fichier de log d'indexation:
```bash
log_path: /chemin/vers/le/fichier.log
```

Il est possible d'afficher des infos complémentaires, la variable env sera affichée dans la partie "Contexte" :
```bash
extra:
  env:
    args1: value1
    args2: value2
    args3: value3
```

Il est possible de rattacher le log à une application précise et/ou un service, un nom de domaine, une personne :
```bash
related_to:
    - ['app', 'APPNAME']
    - ['service', 'SERVICE1']
    - ['service', 'SERVICE2']
    - ['domain', 'DOMAIN.TLD']
```

Ces informations seront utilisées pour permettre de filtrer les logs en relation avec une de ces entités application, service, domaine, personne.


### Améliorer la qualité du paquet d’installation
Vous trouverez ci-dessous une liste des points à vérifier concernant la qualité de vos scripts :
* Vos scripts utilisent bien `sudo cp -a ../sources/. $final_path` plutôt que `sudo cp -a ../sources/* $final_path` ;
* Votre script d’installation contient une gestion en cas d’erreurs du script pour supprimer les fichiers résiduels à l’aide de `set -e` et de [trap](/packaging_apps_trap_fr) ;
* Votre script d’installation utilise une méthode d’installation en ligne de commande plutôt qu’un appel curl via un formulaire web d’installation ;
* Votre script d’installation enregistre les réponses de l’utilisateur ;
* Vous avez vérifié les sources de l’application avec une somme de contrôle (sha256, sha1 ou md5) ou une signature PGP ;
* Vos scripts ont été testés sur Debian Stretch 32 bits, 64 bits et ARM ;
* Les scripts backup et restore sont présents et fonctionnels.

Pour mesurer la qualité d'un paquet, celui-ci obtiendra un [niveau](packaging_apps_levels_fr), déterminé en fonction de divers critères d'installation et selon le respect des [règles de packaging](packaging_apps_guidelines_fr).

### Script de vérification du paquet
<a class="btn btn-lg btn-default" href="https://github.com/YunoHost/package_checker">Vérificateur de paquets</a>

Il s’agit d’un script Python qui vérifie :
* que le paquet est à jour concernant les dernières spécifications
* que tous les fichiers sont présents
* que le manifeste ne comporte pas d’erreur de syntaxe
* que les scripts quittent bien avant de modifier le système lors de vérifications.

### Intégration continue

Un serveur d'intégration continue est a disposition des packagers désirant tester leurs applications.  
<a class="btn btn-lg btn-default" href="packaging_apps_ci">Intégration continue</a>

### Publiez et demandez des tests de votre application

* Demandez des tests et des retours sur votre application en publiant un [post sur le Forum](https://forum.yunohost.org/) dans la [catégorie `App integration`](https://forum.yunohost.org/c/app-integration).

* Si votre paquet et l'application qu'il contient sont sous licence libre, faites une demande d’ajout de votre application dans le [dépôt des applications](https://github.com/YunoHost/apps) (voir aussi [la liste des apps](apps_fr)). Vous pouvez ajouter une application même si celle-ci n'est pour le moment pas fonctionelle : l'état d'avancement peut être `notworking`, `inprogress` ou `working`.

* Si votre application n'est *pas* sous licence libre, il se peut qu'une liste non-officielle soit créée pour gérer ces applications. Ce n'est pour l'instant pas le cas.

### Officialisation d’une application

**!! Section obsolète au 08/03/19** - Le fonctionnement du projet est en cours d'évolution sur ce point.

Pour qu’une application devienne officielle, elle doit être suffisamment testée, stable et fonctionner sous Debian Stretch 64 bits, 32 bits et ARM. Si ces conditions vous paraissent réunies, demandez l’[intégration officielle](https://github.com/YunoHost/apps) de votre application.
