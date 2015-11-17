# Packaging d’applications <img src="https://yunohost.org/images/yunohost_package.png" width=100/>

Ce document a pour but de vous apprendre à packager une application pour YunoHost.

### Prérequis
Pour packager une application, voici les prérequis :
* Un compte sur un serveur git comme [GitHub](https://github.com/) pour pouvoir ensuite publier l’application ;
* Maîtriser un minimum `git`, le Shell et d’autres notions de programmation ;
* Une [machine virtuelle ou sur un serveur distant](/install_fr) pour packager et tester son paquet.

### Contenu
Un paquet YunoHost est composé :

* d’un `manifest.json`
* d’un dossier `scripts`, composé de cinq scripts Shell `install`, `remove`, `upgrade`, `backup` et `restore`
* de dossiers optionnels, contenant les `sources` ou de la `conf`
* d’un fichier `LICENSE` contenant la licence du paquet
* d’une page de présentation du paquet contenu dans un fichier `README.md`

**[Paquet de base](https://github.com/YunoHost/example_ynh)** : n'hésitez pas à vous en servir comme base de travail.

### Manifeste
Le fichier `manifest.json` définit les constantes de l'application, un ensemble de valeurs dont YunoHost a besoin pour identifier l'application et l'installer correctement. Voici un exemple :
```json
{
    "name": "Roundcube",
    "id": "roundcube",
    "description": {
        "en": "Open Source Webmail software",
        "fr": "Webmail Open Source"
    },
    "license": "free",
    "maintainer": {
        "name": "kload",
        "email": "kload@kload.fr",
        "url": "http://kload.fr"
    },
    "multi_instance": "true",
    "arguments": {
        "install" : [
            {
                "name": "domain",
                "ask": {
                    "en": "Choose a domain for Roundcube"
                },
                "example": "domain.org"
            },
            {
                "name": "path",
                "ask": {
                    "en": "Choose a path for Roundcube"
                },
                "example": "/webmail",
                "default": "/webmail"
            }
        ]
    }
}
```

* **name** : le nom de l'application. Son unicité n'est pas nécessaire. Il est tout de même conseillé étant donné que c'est le nom qui apparaît dans la liste des applications pour les administrateurs de serveurs YunoHost.

* **id** : l’identifiant unique de l'application. Vous devez vous assurer de son unicité.

* **description** : la description complète de l'application. Vous pouvez la détailler comme bon vous semble. Uniquement le champs `en` (English) est requis, mais vous pouvez tout de même ajouter la traduction en français :)

* **license** : type de licence avec laquelle le logiciel est distribué : `free`, `non-free`. Attention à ne pas confondre avec la licence du paquet qui doit être mise dans le fichier `LICENSE`.

* **maintainer** : informations à propos du mainteneur du paquet de l'application.

* **multi_instance** : définit la possibilité de votre package à être installée plusieurs fois. Quand YunoHost essaie d'installer une seconde fois votre application, il remplaçera l’`id` dans votre script par `id__2`. Cela signifie que si voulez être `multi_instance`, vous devez mettre toutes les valeurs identifiantes dans les scripts.
<br></br>**Par exemple** : dans le script roundcube, il faut nommer la base de donnée `roundcube`, le dossier d'installation `roundcube` et la configuration Nginx `roundcube`. De cette manière, la seconde installation de roundcube ne rentrera pas en conflit avec la première, et sera installée dans la base de donnée `roundcube__2`, dans le répertoire `roundcube__2`, et avec la configuration Nginx `roundcube__2`.

* **arguments** : les paramètres à demander aux administrateurs du serveur lors de l'installation. `name` est l'identifiant du paramètre, et `ask` la question à poser (au minimum en Anglais -- `en`) que vous pouvez traduire de la même manière que la description ci-dessus. Vous pouvez aussi proposer une valeur par défaut (`default`) et un exemple (`example`) pour aider l'administrateur à remplir le formulaire d’installation.

## Les scripts
Un paquet YunoHost doit contenir cinq scripts Shell : `install`, `remove`, `upgrade`, `backup` et `restore`.
Ces scripts seront exécutés en tant qu'`admin` sur les serveurs YunoHost.

Voici un exemple de script d'`install`:
```bash
# Retrieve arguments
domain=$1
path=$2

# Check domain/path availability
sudo yunohost app checkurl $domain$path -a roundcube
if [[ ! $? -eq 0 ]]; then
    exit 1
fi

# Generate random DES key & password
deskey=$(dd if=/dev/urandom bs=1 count=200 2> /dev/null | tr -c -d '[A-Za-z0-9]' | sed -n 's/\(.\{24\}\).*/\1/p')
db_pwd=$(dd if=/dev/urandom bs=1 count=200 2> /dev/null | tr -c -d '[A-Za-z0-9]' | sed -n 's/\(.\{24\}\).*/\1/p')

# Use 'roundcube' as database name and user
db_user=roundcube

# Initialize database and store mysql password for upgrade
sudo yunohost app initdb $db_user -p $db_pwd -s $(readlink -e ../sources/SQL/mysql.initial.sql)
sudo yunohost app setting roundcube mysqlpwd -v $db_pwd

# Copy files to the right place
final_path=/var/www/roundcube
sudo mkdir -p $final_path
sudo cp -a ../sources/* $final_path
sudo cp ../conf/main.inc.php $final_path/config/
sudo cp ../conf/db.inc.php $final_path/config/
sudo mv $final_path/plugins/managesieve/config.inc.php.dist $final_path/plugins/managesieve/config.inc.php

# Change variables in Roundcube configuration
sudo sed -i "s/rcmail-ynhDESkeyTOchange/$deskey/g" $final_path/config/main.inc.php
sudo sed -i "s/yunouser/$db_user/g" $final_path/config/db.inc.php
sudo sed -i "s/yunopass/$db_pwd/g" $final_path/config/db.inc.php
sudo sed -i "s/yunobase/$db_user/g" $final_path/config/db.inc.php

# Set permissions to roundcube directory
sudo chown -R www-data: $final_path

# Modify Nginx configuration file and copy it to Nginx conf directory
sed -i "s@PATHTOCHANGE@$path@g" ../conf/nginx.conf
sed -i "s@ALIASTOCHANGE@$final_path/@g" ../conf/nginx.conf
sudo cp ../conf/nginx.conf /etc/nginx/conf.d/$domain.d/roundcube.conf

# Reload Nginx and regenerate SSOwat conf
sudo service nginx reload
sudo yunohost app ssowatconf
```

### Utilisation
Vous devez tout mettre dans le script d’`install` pour que votre application soit entièrement installée. Cela signifie que vous devez installer les dépendances, créer les répertoires requis, initialiser les bases de donnés nécessaires, copier les sources et configurer tout dans l'unique script `install` (et bien sûr faire la procédure inverse dans le script `remove`).

**Attention** : pour des raisons de sécurité, le script est exécuté en tant qu'**admin** dans YunoHost. Assurez-vous de l'essayer en tant qu'**admin** et de préfixer `sudo` aux commandes requises.

### Architecture et arguments
Comme les instances de YunoHost possèdent une architecture unifiée, vous serez capable de deviner la plupart des réglages nécessaires. Mais si vous avez besoin de réglages spécifiques, comme le nom de domaine ou un chemin web pour configurer l’application, vous devrez les demander aux administrateurs lors de l'installation (voir la section `arguments` dans le § **Manifeste** ci-dessus).

**Remarque** : les arguments seront passés au script dans l'ordre du manifeste. Par exemple pour **roundcube**, l'argument `domain` sera passé en tant que `$1` dans le script, et  `path` en tant que `$2`.

### Commandes pratiques
La CLI [moulinette](/moulinette) fournit quelques outils pour faciliter le packaging :

<br>

```bash
sudo yunohost app checkport <port>
```
<blockquote>
Cette commande vérifie le port et retourne une erreur si le port est déjà utilisé.
</blockquote>

<br>

```bash
sudo yunohost app setting <id> <key> [ -v <value> ]
```
<blockquote>
C'est la commande la plus importante. Elle vous permet de stocker des réglages d'une application spécifique, afin de les réutiliser plus tard (typiquement dans le script ```upgrade```) ou pour que YunoHost puisse se configurer automatiquement (par exemple pour le SSO).
<br><br>
La commande définit la valeur si vous ajoutez ```-v <valeur>```, sinon la récupère.
<br><br>

** Quelques paramètres pratiques **<br><br>
```skipped_uris```<br><br>
Indique à SSOwat de ne pas s'occuper de la liste d'uris fournies séparées par des virgules. Celles-ci ne seront donc pas protégées et ne pourront pas utiliser le mécanisme d'authentification centralisée.<br><br>

```protected_uris```<br><br>
Protège la liste d'uris fournies séparées par des virgules. Seul un utilisateur connecté y aura accès.<br><br>

```unprotected_uris```<br><br>
Indique à SSOwat de ne pas s'occuper de la liste d'uris fournies séparées par des virgules que si l'utilisateur est connecté. Ces uris sont donc publiquement accessibles mais peuvent utiliser le mécanisme d'authentification centralisée.<br><br>

Il existe aussi `skipped_regex`, `protected_regex`, `unprotected_uris`, `unprotected_regex`.<br><br>

**Attention** : il est nécessaire de lancer `yunohost app ssowatconf` pour appliquer les effets. Les uris seront alors converties en urls et écrites dans le fichier /etc/ssowat/conf.json.<br><br>

Exemple :<br>
```yunohost app setting myapp unprotected_urls -v "/"```<br>
```yunohost app ssowatconf```<br>
Ces commandes vont désactiver le SSO sur la racine de l'aplication soit domain.tld/myapp, ceci est utile pour une application publique.
</blockquote>

<br>

```bash
sudo yunohost app checkurl <domain><path> -a <id>
```
<blockquote>
Cette commande est utile pour les applications web et vous permet d'être sûr que le chemin n'est pas utilisé par une autre application. Si le chemin est inutilisé, elle le « réserve ».
<br><br>
**Remarque** : ne pas préfixer par `http://` ou par `https://` dans le `<domain><path>`.
</blockquote>

<br>

```bash
sudo yunohost app initdb [ -d  <db_name> ]  [ -s <SQL_file> ] [ -p <db_pwd> ] user
<db_user> [ -p <db_pwd> ] [ -s <SQL_file> ]
```
<blockquote>
Cette commande crée une base de donnée `db_name` et un utilisateur `user` associé à cette base, possédant les permissions nécessaires à manipuler la base de donnée.
<br>
Si vous ne définissez pas de nom de base de donnée avec `-d <db_name>`, `user` est utilisé comme nom de base de donnée.
<br>
Si vous ne définissez pas de mot de passe avec `-p`, la commande en génère un et le retourne.
<br>
Si vous ajoutez un fichier SQL avec `-s`, la commande initialise la base de donnée avec les commandes SQL du fichier.
</blockquote>

<br>

```bash
sudo yunohost app ssowatconf
```
<blockquote>
Cette commande régénère la configuration du SSO. Vous devez l'appeler à la fin des scripts lorsque vous packagez une application Web.
</blockquote>

### Tests
Afin de tester votre paquet, vous pouvez exécuter votre script en tant qu'`admin` (n'oubliez pas d'ajouter les arguments requis) :
```bash
su - admin -c "/bin/bash /répertoire/de/mon/script my_arg1 my_arg2"
```

Ou vous pouvez utiliser la moulinette :
```bash
yunohost app install /répertoire/de/mon/paquet
```
Remarque : ça fonctionne aussi avec une URL Git :
```bash
yunohost app install https://github.com/auteur/mon_paquet.git
```

### Améliorer la qualité du paquet d’installation
Vous trouverez ci-dessous une liste des point à vérifier concernant la qualité de vos scripts :
* Vos scripts utilisent bien `sudo cp -a ../sources/. $final_path` plutôt que `sudo cp -a ../sources/* $final_path` ;
* Votre script d’installation contient une gestion en cas d’erreurs du script pour supprimer les fichiers résiduels à l'aide de `set -e` et de `trap` ;
* Votre script d’installation utilise une méthode d’installation en ligne de commande plutôt qu'un appel curl via un formulaire web d’installation ;
* Votre script d’installation enregistre les réponses de l'utilisateur ;
* Vous avez vérifié les sources de l’application avec une somme de contrôle (sha256, sha1 ou md5) ou une signature PGP ;
* Vos scripts ont été testé sur Debian Wheezy et Jessie ainsi que sur les architectures 32 bits, 64 bits et ARM ;
* Les scripts backup et restore sont présents et fonctionnels.

### Publiez et demandez des tests de votre application
* Demandez des tests et des retours sur votre application en publiant un [post sur le Forum](https://forum.yunohost.org/) dans la [catégorie `App integration`](https://forum.yunohost.org/c/app-integration).

* Faire une demande d’ajout de votre application dans le [dépôt des applications](https://github.com/YunoHost/apps) afin qu’elle soit affichée dans [la liste des apps non officielles](https://yunohost.org/#/apps_in_progress_en). Préciser également son état d’avancement : `notworking`, `inprogress`, ou `ready`

### Officialisation d’une application
Pour qu’une application devienne officielle, elle doit être suffisamment testée, stable et fonctionner sous les architectures 64 bits, 32 bits et ARM sur Debian Wheezy et Jessie. Si ces conditions vous paraissent réunies, demandez l’[intégration officielle](https://github.com/YunoHost/apps) de votre application.