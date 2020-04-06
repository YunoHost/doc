# L'application KeeWeb pour NextCloud

L'application Keeweb sur le catalogue de nextcloud - [apps.nextcloud.com/keeweb](https://apps.nextcloud.com/apps/keeweb)

L'application KeeWeb est un gestionnaire de mots de passe incorporé à Nextcloud. Elle permet par exemple de lire un fichier de type KeePass (*.kdbx*) stocké sur votre instance Nextcloud.

Mais il arrive parfois que Nextcloud ne laisse pas l'application prendre en charge ces fichiers, ce qui rend alors impossible leur lecture de KeeWeb. Pour remédier à cela,
[une solution](https://github.com/jhass/nextcloud-keeweb/blob/master/README.md#mimetype-detection) existe.

Se rendre dans le répertoire de configuration de Nextcloud :

```bash
cd /var/www/nextcloud/config/
```

S'il n'existe pas, créer le fichier *mimetypemapping.json* dont le propriétaire est l'utilisateur *nextcloud* :

```bash
sudo su nextcloud -c "nano mimetypemapping.json"
```

Puis ajouter dans ce fichier le texte suivent :

```bash
{
    "kdbx": ["x-application/kdbx"]
}
```

Enregistrer le fichier (**CTRL** + **o**) et quitter nano (**CTRL** + **c**).

Ensuite lancer un scan en tant que root:

```bash
sudo -u nextcloud php /var/www/nextcloud/occ files:scan --all
```

A présent, le problème est corrigé.
