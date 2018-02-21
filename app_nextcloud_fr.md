# Nextcloud

### Utiliser un autre support mémoire

**Prérequis :** connaître les commandes d’administration Unix.

**Remarque :** remplacez `nextcloud` par le nom de son instance si vous avez plusieurs apps Nextcloud installées.

Le répertoire des donnés de Nextcloud (contenant les fichiers) sont dans `/home/yunohost.app/nextcloud/data`

Si le nouvel emplacement est sur un support mémoire, il faut qu'il soit automatiquement monté au démarrage de YunoHost. Vous pouvez utiliser le fichier `/etc/fstab` par exemple.

Si le nouvel emplacement est vierge, vous pouvez déplacer l'ancien dossier vers le nouveau :
```bash
mv /home/yunohost.app/nextcloud/data /le/chemin
```

Si le nouvel emplacement contient déjà des données d'une ancienne instance Owncloud/Nextcloud, privilégiez un `cp -ir` au lieu du `mv` pour copier les données et choisir quoi faire en cas de conflit de fichier.

Assurez-vous de donner les droits à Nextcloud sur ce répertoire :
```bash
chown -R nextcloud /le/chemin
```

Il faut ensuite spécifier le nouveau chemin dans le fichier `/var/www/nextcloud/config/config.php` à la ligne `datadirectory`

Enfin, vous pouvez forcer le scan de ce nouvel emplacement par Nextcloud, si vous avez ajouté de nouveaux fichiers.
```
sudo -u nextcloud php /var/www/nextcloud/occ files:scan --all
```
