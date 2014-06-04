# Packaging d'applications

Il y a quelques petites choses à connaître si vous voulez packager une application pour Yunohost.

### Contenu
Un paquet YunoHost ressemble à [ça](https://github.com/Kloadut/roundcube_ynh), et est composé de :

* un fichier JSON `manifest.json`
* un répertoire `scripts`, qui contient les scripts `install`, `remove` et `upgrade`
* d'autres répertoires optionnels, comme `sources` ou `conf` si tu en as besoin


### Manifeste
Le fichier `manifest.json` définit les constantes de l'application, un ensemble de valeurs dont YunoHost a besoin pour identifier l'application et l'installer correctement. Ça ressemble à ça :
```json
{
    "name": "Roundcube",
    "id": "roundcube",
    "description": {
        "en": "Open Source Webmail software",
        "fr": "Webmail Open Source"
    },
    "license": "GPL-3",
    "developer": {
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

* **name** : Le nom de l'application. Il n'a pas besoin d'être unique, mais c'est conseillé puisque c'est le nom qui apparaît dans la liste des applications pour tous les administrateurs de serveurs YunoHost.

* **id** : L’identifiant unique de l'application. Vous devez vous assurer qu'il est unique avant de soumettre une demande d'intégration de l'application.

* **description** : La description complète de l'application. Vous pouvez la détailler comme bon vous semble. Seulement `en` (English) est requis, mais vous pouvez la traduire en `fr` :)

* **license** : La licence avec laquelle l'application est distribuée. Veuillez utiliser le nom abrégé de la licence, par exemple `GPL-3` pour la GNU General Public License version 3. Vous pouvez trouver une liste des abréviations standards ici : https://www.debian.org/doc/packaging-manuals/copyright-format/1.0/#license-field

* **developer** : Quelques informations à propos du mainteneur de l'application.

* **multi_instance** : Définit la possibilité de votre application à être installée plusieurs fois. Quand YunoHost essaie d'installer une seconde fois votre application, il remplaçera `id` dans votre script par un `id__2`. Cela signifie que si voulez être `multi_instance`, vous devez mettre toutes les valeurs identifiantes dans les scripts.
<br><br>**Par exemple** : Dans mon script roundcube, je dois nommer ma base de donnée `roundcube`, mon répertoire d'installation `roundcube` et ma configuration Nginx `roundcube`. De cette manière, la seconde installation de roundcube ne rentrera pas en conflit, et sera installée dans la base de donnée `roundcube__2`, dans le répertoire `roundcube__2`, et avec la configuration Nginx `roundcube__2`.

* **arguments** : Les paramètres à demander aux administrateurs du serveur lors de l'installation. `name` est l'identifiant du paramètre, et `ask` la question à poser (au minimum en Anglais -- `en`) que vous pouvez traduire de la même manière que la description ci-dessus. Vous pouvez aussi proposer une valeur par défaut (`default`) et un exemple (`example`) pour aider l'administrateur à remplir le formulaire d’installation.

## Les scripts
Pour le moment, un paquet YunoHost doit contenir trois scripts bash : `install`, `remove`, et `upgrade`.
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

### Usage
Vous devez tout mettre dans le script pour que votre application soit entièrement installée. Cela signifie que vous devez installer les dépendances, créer les répertoires requis, initialiser les bases de donnés nécessaires, copier les sources et configurer tout dans l'unique script `install` (et bien sûr faire la procédure inverse dans le script `remove`).

**Attention** : Pour des raisons de sécurité, le script est exécuté en tant qu'**admin** dans YunoHost. Assurez-vous de l'essayer en tant qu'**admin** et de préfixer `sudo` aux commandes requises.

### Architecture et arguments
Comme les instances de YunoHost possèdent une architecture unifiée, vous serez capable de deviner la plupart des réglages nécessaires. Mais si vous avez besoin de réglages spécifiques, comme le nom de domaine ou un chemin web pour configurer l’application, vous devrez les demander aux administrateurs lors de l'installation (voir la section `arguments` dans **manifeste** ci-dessus).

**Remarque** : Les arguments seront passés au script dans l'ordre du manifeste. Par exemple pour **roundcube**, l'argument `domain` sera passé en tant que `$1` dans le script, et  `path` en tant que `$2`.

### Commandes pratiques
La CLI [moulinette](/moulinette) fournit quelques outils pour rendre le packaging plus facile :

<br>

```bash
sudo yunohost app checkport <port>
```
<blockquote>
Cette commande vérifie le port et retourne une erreur si le port déjà utilisé.
</blockquote>

<br>

```bash
sudo yunohost app setting <id> <key> [ -v <value> ]
```
<blockquote>
C'est la commande la plus importante. Elle vous permet de stocker des réglages d'une application spécifique, afin de les réutiliser plus tard (typiquement dans le script ```upgrade```) ou pour que YunoHost puisse se configurer automatiquement (par exemple pour le SSO).
<br><br>
La commande définit la valeur si vous ajoutez ```-v <valeur>```, sinon la récupère.
</blockquote>

<br>

```bash
sudo yunohost app checkurl <domain><path> -a <id>
```
<blockquote>
Cette commande est utile pour les applications Web et vous permet d'être sûr que le chemin n'est pas utilisé par une autre application. Si le chemin est inutilisé, elle le « réserve ».
<br><br>
**Remarque** : Ne pas préfixer par `http://` ou par `https://` dans le `<domain><path>`.
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

### Essais
Afin d'essayer votre packaging d'application, vous pouvez exécuter votre script en tant qu'`admin` (n'oubliez pas d'ajouter les arguments requis) :
```bash
su - admin -c "/bin/bash /path/to/my/script my_arg1 my_arg2"
```

Ou vous pouvez utiliser la moulinette :
```bash
yunohost app install /path/to/my/app/package
```
Remarque : ça fonctionne aussi avec une URL Git :
```bash
yunohost app install https://github.com/author/my_app_package.git
```
