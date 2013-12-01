# Packaging d'applications

Il y a peu de choses à connaître si tu veux packager une application pour Yunohost.

### Contenu
Un paquet YunoHost ressemble à [ça](https://github.com/Kloadut/roundcube_ynh), et est composé de :

* un fichier JSON `manifest.json`
* un répertoire `scripts`, qui contient les scripts `install`, `remove` et `upgrade`
* d'autres répertoires optionnels, comme `sources` ou `conf` si tu en a besoin


### Manifeste
Le fichier `manifest.json` défini les constantes de l'application, un ensemble de valeus que YunoHost a besoin pour identifier l'application et l'installer correctement. Ça ressemble à ça :
```json
{
    "name": "Roundcube",
    "id": "roundcube",
    "description": {
        "en": "Open Source Webmail software",
        "fr": "Webmail Open Source"
    },
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

* **name** : Le nom de l'application. Il n'a pas besoin d'être unique, mais il faut jusqu'à ce qu'il soit le nom qui apparaît pour tous les administrateurs YunoHost dans la liste des applications.

* **id** : L'identidé unique de l'application. Tu dois t'assurer que cette identité est unique avant de soumettre une demande d'intégration de l'application.

* **description** : La description complète de l'application. Tu peux la détailler comme bon te semble. Seulement `en` est requis jusqu'à présent, mais tu peux traduire la description en faisant précéder le préfixe de la langue.

* **developer** : Quelques informations à propos du mainteneur de l'application.

* **multi_instance** : Ceci défini la possibilité de ton application a être installée plusieurs fois. Quand YunoHost essaie d'installer une seconde fois ton application, il remplaçera `id` dans ton scripts par un `id__2`. Cela signifie que si tu veux être `multi_instance`, tu doit mettre tous les identificateurs dans les scripts.
<br><br>**Par exemple** Dans mon script roundcube, je dois nommer ma base de donné `roundcube`, mon répertoire d'installation `roundcube` et ma configuration Nginx `roundcube`. De cette manière, la seconde installation de roundcube ne rentrera pas en conflit, et sera installée dans la base de donné `roundcube__2`, dans le répertoire `roundcube__2`, et avec la configuration Nginx `roundcube__2`.

* **arguments** : Les réglages à demander aux administrateurs de YunoHost lors de l'installation. Tu dois régler un `name` (pour les arguments d'identification), et une question dans `ask` (au minimum en `en`) que tu peux traduire comme dans la description ci-dessus. Tu peux aussi mettre une valeur `default` et un `example` pour aider l'administrateur à remplir la contribution.

## Les scripts
À présent, un paquet YunoHost doit contenir trois scripts bash : `install`, `remove`, et `upgrade`.
Ces scripts seront exécuté en tant qu'`admin` sur les serveurs YunoHost.

Voici un exemple :
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
Tu doit tout mettre dans le script afin d'installer ton application parfaitement. Ça signifie que tu doit installer les dépendances, créer les répertoires requis, initialiser les bases de donnés nécessaires, copier les sources et configurer tout dans l'unique script `install` (et bien sûr coder la procédure inverse dans le script `remove`).

**Attention** : Pour des raisons de sécurité, le script est exécuté en tant qu'**administrateur** dans YunoHost. Soit certain de l'essayer en tant qu'**administrateur** et préfixe de `sudo` les commandes requises.

### Architecture et arguments
Depuis que YunoHost a une architecture unifié, tu sera en position de deviner la plupart des réglages nécessaires. Mais si tu as besoin de réglages variables, comme le nom de domaine ou un chemin web pour configurer ton application, tu devra demander aux administrateurs lors de l'installation (regarde la section `arguments` dans manifeste ci-dessus).

**Remarque** : Les arguments seront passés dans l'ordre du manifeste dans le script. Par exemple pour **roundcube**, l'argument `domain` sera référencé en tant que `$1` dans le script, et  `path` en tant que `$2`.

### Aides
La CLI [moulinette](#/moulinette) fournis des outils pour rendre le packaging plus facile :

<br>

```bash
sudo yunohost app checkport <port>
```
<blockquote>
Cette aide vérifie le port et retourne une erreur si le port déjà utilisé.
</blockquote>

<br>

```bash
sudo yunohost app setting <id> <key> [ -v <value> ]
```
<blockquote>
C'est l'aide la plus importante de YunoHost. Il te permet de stocker des réglages pour un application spécifique, afin de ne plus la réutiliser plus tard ou l'utiliser pour la configuration de YunoHost (**par exemple** pour le SSO).
<br><br>
Il régle la valeur si tu ajoute ```-v <value>```, et sinon l'obtient.
</blockquote>

<br>

```bash
sudo yunohost app checkurl <domain><path> -a <id>
```
<blockquote>
Cette aide est utile pour les applications web et te permet d'être sûr que le chemin n'est pas pris par une autre application, il "réserve" le chemin.
<br><br>
**Remarque** : Ne pas préfixer par `http://` ou par `https://` dans le `<nom de domaine><chemin>`.
</blockquote>

<br>

```bash
sudo yunohost app initdb <db_user> [ -p <db_pwd> ] [ -s <SQL_file> ]
```
<blockquote>
Cette aide crée une base de donnée MySQL. Si tu n'ajoute pas de mot de passe, il en génère un et te l'affiche. Si tu ajoute un fichier SQL, il initialise ta base de donné avec la déclaration SQL à l'intérieur.
</blockquote>

<br>

```bash
sudo yunohost app ssowatconf
```
<blockquote>
Cette aide recharge la configuration SSO. Tu dois l'appeler à la fin du script quand tu est en train de packager une application web.
</blockquote>

### Essaye le !
Afin d'essayer ton packaging, tu peux exécuter ton script en tant qu'`administrateur` (n'oublie pas d'ajouter les arguments requis) :
```bash
su - admin -c "/bin/bash /path/to/my/script my_arg1 my_arg2"
```

Ou tu peux utiliser la moulinette :
```bash
yunohost app install /path/to/my/app/package
```
Remarque : ça fonctionne aussi avec une URL Git :
```bash
yunohost app install https://github.com/author/my_app_package.git
```
