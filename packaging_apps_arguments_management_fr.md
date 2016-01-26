<a class="btn btn-lg btn-default" href="packaging_apps_fr">Packaging d’application</a>

## Gestion des arguments
#### Récupérer les arguments du manifeste dans le script d’installation
Les arguments sont passés au script d’installation dans l’ordre du manifeste. Par exemple pour Roundcube, les arguments `domain` et `path` seront respectivement récupérés avec les paramètres `$1` et `$2` dans le script d’installation.

```bash
# Retrieve arguments
domain=$1
path=$2
```

#### Sauvegarder des arguments pour les autres scripts
Les scripts remove, upgrade, backup et restore peuvent avoir besoin de ces arguments.

Pour cela, YunoHost peut sauvegarder les arguments avec cette commande :
```bash
# Store config on YunoHost instance
sudo yunohost app setting $app domain -v $domain
```
Elle est généralement utilisée dans le script d’installation.

Ensuite, le script peux récupérer les arguments sauvegardés avec cette commande :
```bash
domain=$(sudo yunohost app setting $app domain)
```

Ces données sont sauvegardées dans `/etc/yunohost/apps/<app_name>/settings.yml`.