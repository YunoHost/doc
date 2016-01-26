## Manifest
The `manifest.json` file defines the app's constants, a bunch of values that YunoHost needs to identify the app and install it correctly. It looks like this:
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

* **name**: the app name. It does not have to be unique, but it should be, since it is the name shown to all the YunoHost administrators in the app list.

* **id**: the unique ID of the app. You have to ensure that this ID is unique before submit an app integration request.

* **description**: the complete description of the app. You can make it as detailed as you feel it should be. Only `en` is required right now, but you can translate the description by prepending the locale prefix.

* **url**: software website.

* **license**: software license type: `free` or `non-free`. Be careful to not confuse with package license which must be put in `LICENSE` file.

* **maintainer**: informations about the app maintainer.

* **multi_instance**: this defines your app's ability to be installed multiple times. When YunoHost tries to install a second instance of the app, it will replace the `id` in the scripts by an `id__2`. It means that, if you want to be `multi_instance`, you have to put all the identifiers in the scripts. 
<br><br>**E.g.** in the roundcube script, database is called `roundcube`, the install directory `roundcube` and the Nginx configuration `roundcube`. This way, the second instance of roundcube will not conflict with the first one, and will be installed in the `roundcube__2` database, in the `roundcube__2`directory, and with the `roundcube__2` Nginx configuration.

* **services**: services needed by the application among `nginx`, `php5-fpm`, `mysql`, `uwsgi`, `metronome`…

* **arguments**: the settings for the YunoHost's administrator to enter at installation. You have to set a `name` (for argument identification), and a question in `ask` (at least in `en`) that you can translate like the description above. You can also set a `default` value and an `example` to help administrator to fill the input.