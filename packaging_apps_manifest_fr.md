## Manifeste
Le fichier `manifest.json` définit les constantes de l’application, un ensemble de valeurs dont YunoHost a besoin pour identifier l'application et l’installer correctement. Voici un exemple :
```json
{
    "name": "Roundcube",
    "id": "roundcube",
    "description": {
        "en": "Open Source Webmail software",
        "fr": "Webmail Open Source"
    },
    "url": "http://roundcube.net/",
    "license": "free",
    "maintainer": {
        "name": "kload",
        "email": "kload@kload.fr"
    },
    "multi_instance": "true",
    "services": [
        "nginx",
        "php5-fpm",
        "mysql"
    ],
    "arguments": {
        "install" : [
            {
                "name": "domain",
                "type": "domain",
                "ask": {
                    "en": "Choose a domain for Roundcube",
                    "fr": "Choisissez un domaine pour Roundcube"
                },
                "example": "domain.org"
            },
            {
                "name": "path",
                "type": "path",
                "ask": {
                    "en": "Choose a path for Roundcube",
                    "fr": "Choisissez un chemin pour Roundcube"
                },
                "example": "/webmail",
                "default": "/webmail"
            }
        ]
    }
}
```

* **name** : nom de l’application. Son unicité n’est pas nécessaire. Il est tout de même conseillé étant donné que c’est le nom qui apparaît dans la liste des applications pour les administrateurs de serveurs YunoHost.

* **id** : identifiant de l’application. Vous devez vous assurer de son unicité.

* **description** : description complète de l’application. Vous pouvez la détailler comme bon vous semble. Uniquement le champs `en` (english) est requis, vous pouvez également ajouter la traduction en français :)

* **url**: site de l’application.

* **license** : licence avec laquelle l’application est distribuée : `free`, `non-free`. Attention à ne pas confondre avec la licence du paquet qui doit être mise dans le fichier `LICENSE`.

* **maintainer** : informations à propos du mainteneur du paquet de l’application pour pouvoir le contacter.

* **multi_instance** : définit la possibilité du paquet à être installé plusieurs fois. Quand YunoHost essaie d’installer une seconde fois l’application, il remplaçera l’`id` dans votre script par `id__2`. Cela signifie que si voulez que l’application soit `multi_instance`, vous devez mettre toutes les valeurs identifiantes dans les scripts.
<br /><br />**Par exemple** : dans le script roundcube, il faut nommer la base de donnée `roundcube`, le dossier d’installation `roundcube` et la configuration Nginx `roundcube`. De cette manière, la seconde installation de roundcube ne rentrera pas en conflit avec la première, et sera installée dans la base de donnée `roundcube__2`, dans le répertoire `roundcube__2`, et avec la configuration Nginx `roundcube__2`.

* **services** : liste des services nécessaires au fonctionnement de l’application. `nginx`, `php5-fpm`, `mysql`, `uwsgi`, `metronome`…

* **arguments** :
  * **install** : paramètres à demander à l’administrateur lors de l’installation.
    * **name** : identifiant du paramètre
    * **type** : type de paramètre parmis `domain`, `path` et `password`. Le champ sera caché dans le cas d’un mot de passe.
    * **ask** : question posée (au minimum en anglais – `en`) que vous pouvez traduire dans plusieurs langues.
    * **example** : valeur d’exemple pour aider l’administrateur à remplir le formulaire d’installation.
    * **default** : valeur par défaut.