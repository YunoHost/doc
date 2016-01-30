#Owncloud

### Utiliser un autre support mémoire

**Prérequis :** connaître les commandes d’administration Unix

Le répertoire des donnés d’Owncloud (contenant les fichiers) sont dans `/home/yunohost.app/owncloud/data`

Il est possible de déplacer ces donnés sur autre support mémoire.

Pour cela, il faut spécifier le nouveau chemin dans le fichier `/var/www/owncloud/config` à la ligne `datadirectory`

Il faut également s’assurer de donner les droits à Owncloud sur ce répertoire

```bash
chown -R owncloud /le/chemin
```

Il faut également que ce support mémoire soit automatiquement monté au démarrage de YunoHost.