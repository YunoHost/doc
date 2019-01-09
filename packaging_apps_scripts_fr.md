<a class="btn btn-lg btn-default" href="packaging_apps_fr">Packaging d’application</a>

## Les scripts

Un paquet YunoHost doit contenir cinq scripts Shell : `install`, `remove`, `upgrade`, `backup` et `restore`. Un 6ème script `change_url` peut aussi être ajouté de façon optionnelle.
Ces scripts seront exécutés en tant que `root` sur les serveurs YunoHost.

Des exemples de ces scripts sont disponibles dans l'[application d'exemple](https://github.com/YunoHost/example_ynh/tree/master/scripts).

### Utilisation
Vous devez tout mettre dans le script d’`install` pour que votre application soit entièrement installée. Cela signifie que vous devez installer les dépendances, créer les répertoires requis, initialiser les bases de données nécessaires, copier les sources et configurer tout dans l’unique script `install` (et bien sûr faire la procédure inverse dans le script `remove`).

Il est possible d'utiliser des helpers et d'importer une librairie de fonction par exemple depuis un fichier `_common.sh`.

### Variables disponibles pour tous ces scripts
#### YNH_CWD
Cette variable contient le chemin du répertoire de travail courant du contexte d'exécution du script. Elle peut être utile pour retrouver le chemin initial si on s'est déplacé pendant l'exécution du script. Elle est utilisée par certains helpers pour être sûr d'utiliser le bon.

#### YNH_APP_ID
Contient l'identifiant de l'application sans le numéro d'instance

Exemple: strut
#### YNH_APP_INSTANCE_NAME
Contient le nom d'instance qui sera utilisé dans de nombreuses situation pour pouvoir gérer l'installation multiple d'une même app.

Exemple: strut__3
#### YNH_APP_INSTANCE_NUMBER
Contient le numéro de l'instance. Attention il ne s'agit pas forcément du nombre d'instance toujours installée, car une ancienne application peut avoir été désinstallée.

Exemple: 3

### Variables spécifiques pour `install`
#### YNH_APP_ARG_XXXXXXX
Pour chaque question posée lors de l'installation, une variable d'environnement est disponible.

Par exemple, si dans le manifest nous avons une question de cette forme
```json
{
    "name": "domain",
    "type": "domain",
    "ask": {
        "en": "Choose a domain for OpenSondage",
        "fr": "Choisissez un nom de domaine pour OpenSondage",
        "de": "Wählen Sie bitte einen Domain für OpenSondage"
    },
    "example": "domain.org"
}
```

Le nom de la question `domain` donc dans le script on peut accéder à cette variable via $YNH_APP_ARG_DOMAIN. L'usage est de créer une variable plus courte comme ceci:

```bash
domain=$YNH_APP_ARG_DOMAIN
```

### Variables spécifiques pour `change_url`
#### YNH_APP_OLD_DOMAIN
L'ancien domaine où était installée l'app.

#### YNH_APP_OLD_PATH
L'ancien chemin où était installée l'app.

#### YNH_APP_NEW_DOMAIN
Le nouveau domaine où doit être installée l'app.

#### YNH_APP_NEW_PATH
Le nouveau chemin où doit être installée l'app.
