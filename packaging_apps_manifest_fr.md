## Manifeste
Le fichier `manifest.json` définit les constantes de l'application, un ensemble de valeurs dont YunoHost a besoin pour identifier l'application et l'installer correctement. Voici un exemple :
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

* **license** : type de licence avec laquelle le logiciel est distribué : `free`, `non-free`. Attention à ne pas confondre avec la licence du paquet qui doit être mise dans le fichier `LICENSE`.

* **maintainer** : informations à propos du mainteneur du paquet de l'application.

* **multi_instance** : définit la possibilité de votre package à être installée plusieurs fois. Quand YunoHost essaie d'installer une seconde fois votre application, il remplaçera l’`id` dans votre script par `id__2`. Cela signifie que si voulez être `multi_instance`, vous devez mettre toutes les valeurs identifiantes dans les scripts.
<br></br>**Par exemple** : dans le script roundcube, il faut nommer la base de donnée `roundcube`, le dossier d'installation `roundcube` et la configuration Nginx `roundcube`. De cette manière, la seconde installation de roundcube ne rentrera pas en conflit avec la première, et sera installée dans la base de donnée `roundcube__2`, dans le répertoire `roundcube__2`, et avec la configuration Nginx `roundcube__2`.

* **arguments** : les paramètres à demander aux administrateurs du serveur lors de l'installation. `name` est l'identifiant du paramètre, et `ask` la question à poser (au minimum en Anglais -- `en`) que vous pouvez traduire de la même manière que la description ci-dessus. Vous pouvez aussi proposer une valeur par défaut (`default`) et un exemple (`example`) pour aider l'administrateur à remplir le formulaire d’installation.