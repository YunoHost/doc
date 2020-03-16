Sauvegarder son serveur et ses apps
===================================

Dans le contexte de l'auto-hébergement, les sauvegardes (backup) sont un élément important pour palier les événements inattendus (incendies, corruption de base de données, perte d'accès au serveur, serveur compromis, ...). La politique de sauvegardes à mettre en place dépend de l'importance des services et des données que vous gérez. Par exemple, sauvegarder un serveur de test aura peu d'intérêt, tandis que vous voudrez être très prudent si vous gérez des données critiques pour une association ou une entreprise - et dans ce genre de cas, vous souhaiterez stocker les sauvegardes *dans un endroit différent*.

Les sauvegardes avec YunoHost
-----------------------------

YunoHost contient un système de sauvegarde, qui permet de sauvegarder (et restaurer) les configurations du système, les données "système" (comme les mails) et les applications si elles le supportent.

Vous pouvez gérer vos sauvegardes via la ligne de commande (`yunohost backup --help`) ou la webadmin (dans la section Sauvegardes) bien que certaines fonctionnalités ne soient pas disponibles via celle-ci.

Actuellement, la méthode de sauvegarde actuelle consiste à créer des archives `.tar.gz` qui contiennent les fichiers pertinents. Pour le futur, YunoHost envisage de supporter nativement [Borg](https://www.borgbackup.org/) qui est une solution plus flexible, performante et puissante pour gérer des sauvegardes.

Créer des sauvegardes
---------------------

#### Depuis la webadmin

Vous pouvez facilement créer des archives depuis la webadmin en allant dans Sauvegardes > Archives locales et en cliquant sur "Nouvelle sauvegarde". Vous pourrez ensuite sélectionner les éléments à sauvegarder (configuration, données "système", applications).

![](/images/backup.png)

#### Depuis la ligne de commande

Vous pouvez créer de nouvelles archives depuis la ligne de commande. Voici quelques exemples de commandes et leur comportement correspondant:

- Tout sauvegarder (système et application)
```bash
yunohost backup create
```

- Sauvegarder seulement les apps
```bash
yunohost backup create --apps
```

- Sauvegarder seulement deux apps (wordpress et shaarli)
```bash
yunohost backup create --apps wordpress shaarli
```

- Sauvegarder seulement les mails
```bash
yunohost backup create --system data_mail
```

- Sauvegarder les mails et wordpress
```bash
yunohost backup create --system data_mail --apps wordpress
```

Pour plus d'informations et d'options sur la création d'archives, consultez `yunohost backup create --help`. Vous pouvez également lister les parties de système qui sont sauvegardables avec `yunohost hook list backup`.

#### Configuration spécifique à certaines apps

Certaines apps comme Nextcloud sont potentiellement rattachées à des quantités importantes de données. Il est possible de ne pas les sauvegarder par défaut. Dans ce cas, on dit que l'app "sauvegarde uniquement le core" (de l'app).  
Lors d'une mise à jour, les apps contenant une grande quantité de données effectuent généralement une sauvegarde sans ces données.

Pour désactiver manuellement la sauvegarde des données volumineuses, pour les applications qui implémentent cette fonctionnalité, vous pouvez définir la variable `BACKUP_CORE_ONLY`. Pour ce faire, la variable doit être définie avant la commande de backup : `sudo BACKUP_CORE_ONLY=1 yunohost backup create --apps nextcloud`. Soyez prudent : il vous faudra alors sauvegarder vous même les données des utilisateurs de nextcloud. Choisir ce type de sauvegarde vous permettra de mettre en place manuellement des sauvegardes incrémentielles ou différentielles (que yunohost ne permet pas encore de faire automatiquement).

Télécharger et téléverser des sauvegardes
-----------------------------------------

Après avoir créé des sauvegardes, il est possible de les lister et de les inspecter grâce aux vues correspondantes dans la webadmin, ou via `yunohost backup list` et `yunohost backup info <nom_d'archive>` depuis la ligne de commande. Par défaut, les sauvegardes sont stockées dans `/home/yunohost.backup/archives/`.

À l'heure actuelle, la solution la plus accessible pour récupérer les sauvegardes est d'utiliser le programme FileZilla comme expliqué dans [cette page](/filezilla_fr).

Une autre solution alternative consiste à installer une application comme Nextcloud et à la configurer pour être en mesure d'accéder aux fichiers dans `/home/yunohost.backup/archives/` depuis un navigateur web.

Enfin, il est possible d'utiliser `scp` (un programme basé sur [`ssh`](/ssh)) pour copier des fichiers entre deux machines grâce à la ligne de commande. Ainsi, depuis une machine sous Linux, vous pouvez utiliser la commande suivante pour télécharger une archive :

```bash
scp admin@your.domain.tld:/home/yunohost.backup/archives/<nom_d'archive>.tar.gz ./
```

De façon similaire, vous pouvez téléverser une sauvegarde depuis une machine vers votre serveur avec :

```bash
scp /path/to/your/<nom_d'archive>.tar.gz admin@your.domain.tld:/home/yunohost.backup/archives/
```

Restaurer des sauvegardes
-------------------------

#### Depuis la webadmin

Allez dans Sauvegardes > Sauvegardes locales et sélectionnez l'archive. Vous pouvez ensuite choisir les différents éléments que vous voulez restaurer puis cliquer sur "Restaurer".

![](/images/restore.png)

#### Depuis la ligne de commande

Depuis la ligne de commande, vous pouvez utiliser `yunohost backup restore <nom_d'archive>` (sans le `.tar.gz`) pour restaurer une archive. Tout comme `yunohost backup create`, cela restaure tout le contenu par défaut. Si vous souhaitez restaurer seulement certaines parties, vous pouvez utiliser par exemple `yunohost backup restore --apps wordpress` qui restaurera seulement l'app wordpress.

#### Contraintes

Pour restaurer une application, le domaine sur laquelle elle est installée doit déjà être configuré (ou il vous faut restaurer en même temps la configuration correspondante). Aussi, il n'est pas possible de restaurer une application déjà installée... ce qui veut dire que pour restaurer une sauvegarde d'une app, il vous faut déjà la désinstaller.

#### Restauration d'une archive à la place de la post-installation

Une fonctionnalité particulière est la possibilité de restaurer une archive entière *à la place* de faire la post-installation. Ceci est utile pour réinstaller un système entièrement à partir d'une sauvegarde existante. Pour faire cela, il vous faudra d'abord téléverser l'archive sur le serveur et la placer dans `/home/yunohost.backup/archives`.

Ensuite, **à la place de** `yunohost tools postinstall`, réalisez la restauration de l'archive téléversée par cette ligne de commande avec le nom de l'archive (sans le `.tar.gz`) :

```bash
yunohost backup restore <nom_d'archive>
```

Note: si votre archive n'est pas dans `/home/yunohost.backup/archives`, vous pouvez créer le répertoire et déplacer l'archive comme ceci :

```bash
mkdir -p /home/yunohost.backup/archives
mv /chemin/vers/<nom_d'archive> /home/yunohost.backup/archives/
yunohost backup restore <nom_d'archive>
``` 


Pour aller plus loin
--------------------

#### Stocker les archives sur un autre disque

Si vous le souhaitez, vous pouvez connecter un disque externe à votre serveur pour (parmi d'autres choses) stocker les archives de backup dessus. Pour cela, il faut d'abord déplacer les archives existantes vers le disque, puis créer un lien symbolique: 

```bash
PATH_TO_DRIVE="/media/mon_disque_externe" # Par exemple - Tout dépend d'où le disque est monté
mv /home/yunohost.backup/archives $PATH_TO_DRIVE/yunohost_backup_archives
ln -s $PATH_TO_DRIVE/yunohost_backup_archives /home/yunohost.backup/archives
```

#### Sauvegardes automatiques

Vous pouvez ajouter une tâche cron pour déclencher automatiquement une sauvegarde régulièrement. Par exemple pour sauvegarder l'application wordpress toutes les semaines, créez un fichier `/etc/cron.weekly/backup-wordpress` avec le contenu suivant :

```bash
#!/bin/bash
yunohost backup create --apps wordpress
```
puis rendez-le exécutable :

```bash
chmod +x /etc/cron.weekly/backup-wordpress
```

Soyez prudent à propos de ce que vous sauvegardez et de la fréquence : il vaut mieux éviter de se retrouver avec un disque saturé car vous avez voulu sauvegarder 30 Go de données tous les jours...

#### Sauvegarder sur un serveur distant

Vous pouvez suivre ce tutoriel sur le forum pour mettre en place Borg entre deux serveurs : https://forum.yunohost.org/t/how-to-backup-your-yunohost-server-on-another-server/3153

Il existe aussi l'application Archivist qui permet un système similaire : https://forum.yunohost.org/t/new-app-archivist/3747

#### Eviter de sauvegarder certains dossiers
Si besoin, vous pouvez spécifier que certains dossiers `home` d'utilisateurs ne soient pas sauvegardés par la commande `yunohost backup`, en créant un fichier vide nommé `.nobackup` à l'intérieur.

#### Backup complet avec `dd`

Si vous êtes sur une carte ARM, une autre méthode pour créer une sauvegarde complète consiste à créer une image (copie) de la carte SD. Pour cela, éteignez votre serveur, insérez la carte SD dans votre ordinateur et créez une image avec une commande comme :

```bash
dd if=/dev/mmcblk0 of=./backup.img status=progress
```

(remplacez `/dev/mmcblk0` par le vrai nom de votre carte SD)

Vous pouvez aussi compresser l'image à l'aide de gzip :

```bash
dd if=/dev/mmcblk0 | gzip > ./image.gz
```
