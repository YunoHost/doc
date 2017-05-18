#Nextcloud

### Utiliser un autre support mémoire

**Prérequis :** connaître les commandes d’administration Unix

Le répertoire des donnés de Nextcloud (contenant les fichiers) sont dans `/home/yunohost.app/nextcloud/data`

Il est possible de déplacer ces données sur autre support mémoire.

Pour cela, il faut spécifier le nouveau chemin dans le fichier `/var/www/nextcloud/config/config.php` à la ligne `datadirectory`

Il faut également s’assurer de donner les droits à Nextcloud sur ce répertoire

```bash
chown -R nextcloud /le/chemin
```

Il faut également que ce support mémoire soit automatiquement monté au démarrage de YunoHost.
