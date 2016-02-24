<a class="btn btn-lg btn-default" href="packaging_apps_fr">Packaging d’application</a>

### Multi-instances
Le multi-instance est la capacité d’une application a être installée plusieurs fois.

#### Scripts
Lorsque YunoHost installe une seconde fois l’application, il passe au script en dernier paramètre `id__2` avec `id` provenant du manifeste. La valeur après l’`id` est incrémentée.

Récupération de la dernière variable passée aux scripts :
```bash
APP=${!#}
```

Utilisation de la variable :
```bash
sudo yunohost app checkurl $domain$path -a $APP
```

#### Manifeste
Passer la variable `multi_instance` à `true` dans le [manifeste](packaging_apps_manifest_fr) :
```json
 "multi_instance": "true",
```