#Owncloud

**Comment déplacer son répertoire Owncloud sur un disque USB?**

**Prérequis :** connaître les commandes d'administration Linux

Le répertoire data de Owncloud (contenant les fichiers) doit normalement être dans
```bash
/home/yunohost.app/owncloud/data
```

Il est possible de déplacer ce dossier vers un disque externe en USB (par exemple).

Il faut pour cela spécifier le nouveau chemin dans le fichier

```bash
/var/www/owncloud/config à la ligne datadirectory
```

Il faut s'assurer de bien mettre les droits à Owncloud sur ce répertoire

```bash
chown -R owncloud /le/chemin
```

Il faut aussi que le disque dur externe soit monté automatiquement au démarrage de Yunohost.