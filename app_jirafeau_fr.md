# <img src="/images/jirafeau_logo.png" alt="logo de Jirafeau"> Jirafeau

**Index**
 - [Utilisation de Jirafeau](#UtilisationJirafeau)  
 - [Administrer Jirafeau](#AdminJirafeau)  
    - [Interface d'administation](#AdminPhpJirafeau)  
    - [Modifier les paramètres de fonctionnements](#AdminParametres)  
    - [Modifier les Conditions Générales d'Utilisations](#AdminCgu)  
 - [Liens utiles](#LiensUtiles)

[![Installer Jirafeau avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=jirafeau)

Jirafeau est un service simple de partage de fichiers en un lien. Il permet de limiter la durée de la disponibilité du fichier dans le temps ou au nombre de téléchargements. Il est aussi possible de protéger l'accès au fichier avec un mot de passe. Une démonstration de la dernière version disponible est disponible ici : [jirafeau.net](https://jirafeau.net/).

## Utilisation de Jirafeau <a name="UtilisationJirafeau"></a>

l'utilisation de Jirafeau est simple il existe de façons pour envoyer le fichier :
 + Il est possible de le sélectionner en cliquant sur le `+` au milieu de la page et en allant chercher le fichier concerné dans l'arborescence.  
 + Le fichier peut être déposé par un glisser/déposer à partir de votre explorateur de fichiers.

![Capture d'écran de Jirafeau](/images/app_jirafeau_capture.png)

## Administrer Jirafeau <a name="AdminJirafeau"></a>

### Interface d'administration <a name="AdminPhpJirafeau"></a>

**Pour accéder à la page d'administration vous devez être connecté avec le compte administrateur déclaré lors de l'installation de l'application Jirafeau sur votre serveur**
L'interface d'administration de Jirafeau est disponible en allant sur la page : `https://nom.domaine.tld/service/admin.php`

### Modifier les paramètres de fonctionnement <a name="AdminParametres"></a>

**Pour modifier les paramètres il faut être connecté en `root` à l'aide d'un terminal.**
Le fichier de configuration se trouve ici : `/var/www/jirafeau/lib/`  
Il faut modifier le fichier `config.local.php`

Dans le cas ou le fichier n'existe pas il est nécessaire de copier et renommer le fichier `config.original.php` à l'aide la commande `cp`

#### Utilisation de la commande `cp`
```
$ cd /var/www/jirafeau/lib/  
$ cp config.original.php config.local.php

```
Plus d'information sur la commande `cp` : `$cp --help`

Quelques paramètres de configurations

| Fonctions | Ligne de code | Utilisation | Commentaire |
|-----------|---------------|-------------|-------------|
| Modifier la durée et les options de stockage des fichiers | `$cfg['availabilities'] = array(`| Valeur boléen : `true` `false` | Si l'option est `true` l'option est utilisé |
| Modifier le nom de l'installation | `$cfg['title'] = 'Nom de l'Installation';` | Valeur texte | Le nom que vous désirez afficher |

Cette liste n'est pas exhaustive, explorer le fichier de configuration.


### Modifier les Conditions Générales d'Utilisations <a name="AdminCgu"></a>

**Pour modifier les Conditions Générales d'Utilisations il faut être connecté en `root` à l'aide d'un terminal.**
Le fichier des CGU se trouve ici : `/var/wwww/jirafeau/lib/`
Il faut modifier le fichier `tos.original.txt`

## Liens Utiles <a name="LiensUtiles"></a>
 - Site officiel du projet - [gitlab.com/mojo42/Jirafeau](https://gitlab.com/mojo42/Jirafeau)
 - Site de démonstration de Jirafeau [jirafeau.net](https://jirafeau.net/)
 - Depot de l'application Jirafeau pour Yunohost - [github.com/YunoHost-apps/jirafeau_ynh](https://github.com/YunoHost-apps/jirafeau_ynh)
 - Trouver de l'aide et poser toutes vos questions : [forum.yunohost.org](https://forum.yunohost.org/c/support)
