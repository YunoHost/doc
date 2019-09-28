<a class="btn btn-lg btn-default" href="packaging_apps_en">Application packaging</a>

## Manifest
The `manifest.json` file defines the app's constants, a bunch of values that YunoHost needs to identify the app and install it correctly. It looks like this:
```json
{
    "name": "Roundcube",
    "id": "roundcube",
    "packaging_format": 1,
    "description": {
        "en": "Open Source Webmail software",
        "fr": "Webmail Open Source"
    },
    "url": "http://roundcube.net/",
    "version": "1.0.1~ynh7",
    "license": "free",
    "maintainer": {
        "name": "kload",
        "email": "kload@kload.fr"
    },
    "requirements": {
        "yunohost": ">= 2.4.0"
    },
    "multi_instance": true,
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

* **name**: app name. It does not have to be unique, but it should be, since it is the name shown to all the YunoHost administrators in the app list. Any characters are allowed.

* **id**: ID of the app. You have to ensure that this ID is unique before submit an app integration request. See [packaging_apps_guidelines.md#yep-11](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines.md#yep-11) for valid rules.

- **packaging_format**: package version. Actual version is **1**. This key has been set up to make independant packaging evolution versions from YunoHost versions evolution.

* **description**: complete app description. You can make it as detailed as you feel it should be. Only `en` is required right now, but you can translate the description by prepending the locale prefix.

* **url**: software website.

* **version**: version of the package built from the upstream version number and an incremental number for each change in the package without upstream change. Example "1.0.1~ynh7". Must be a string.

* **license**: application license: `free`, `non-free` or a value from the Identifier column from https://spdx.org/licenses/. Be careful to not confuse with package license which must be put in `LICENSE` file.

* **maintainer**: informations about the app maintainer for contact.

- **requirements**: dependency of the application package to a Debian YunoHost package version. For instance, "yunohost": ">> 2.3.12", `yunohost` package version must be up to `2.3.12`.

* [**multi_instance**](packaging_apps_multiinstance_en): it defines app's ability to be installed multiple times.

* **services**: services needed by the application among `nginx`, `php5-fpm`, `mysql`, `uwsgi`, `metronome`, `postfix`, `dovecot`…

* **arguments**:
  * **install**: argument for the YunoHost's administrator to enter at installation.
    * **name**: argument identification.
    * **type**: (optional) argument type among `domain`, `path`, `user`, `app`, `boolean`, `string` and `password`. The field will be hidden in the password case.
    * **choices** : (optional) restrict value to several choices.
    * **optional** : (optional) field which indicate if this argument is optional. It can have `true` and `false` value.
    * **ask**: question (at least in `en`) that you can translate.
    * **example**: (optional) example value to help administrator to fill the input.
    * **default**: (optional) default value.
