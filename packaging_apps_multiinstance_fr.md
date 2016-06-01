<a class="btn btn-lg btn-default" href="packaging_apps_fr">Packaging d’application</a>

### Multi-instances
Le multi-instance est la capacité d’une application à être installée plusieurs fois.

#### Scripts
Lorsque YunoHost installe une seconde fois l’application, il passe au script en dernier paramètre `id__2` avec l’identifiant de l’application `id` provenant du manifeste. La valeur `n` dans `id__n` est incrémentée à chaque nouvelle instance de l’application.

**Par exemple** : dans le script roundcube, il faut nommer la base de données `roundcube`, le dossier d’installation `roundcube` et la [configuration Nginx](packaging_apps_nginx_conf_fr) `roundcube`. De cette manière, la seconde installation de roundcube ne rentrera pas en conflit avec la première, et sera installée dans la base de données `roundcube__2`, dans le répertoire `roundcube__2`, et avec la configuration Nginx `roundcube__2`.


Récupération de la dernière variable passée aux scripts :
```bash
APP=${!#}
```

#### Manifeste
Passer la variable `multi_instance` à `true` dans le [manifeste](packaging_apps_manifest_fr) :
```json
 "multi_instance": true,
```
