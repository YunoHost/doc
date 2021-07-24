---
title: Sauvegarder son serveur
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup'
page-toc:
  active: true
  depth: 3
---

Dans le contexte de l'auto-hébergement, les sauvegardes (backup) sont un élément important pour pallier les événements inattendus (incendies, corruption de base de données, perte d'accès au serveur, serveur compromis...). La politique de sauvegardes à mettre en place dépend de l'importance des services et des données que vous gérez. Par exemple, sauvegarder un serveur de test aura peu d'intérêt, tandis que vous voudrez être très prudent si vous gérez des données critiques pour une association ou une entreprise - et dans ce genre de cas, vous souhaiterez stocker les sauvegardes *dans un ou des endroits différents*.

## Sauvegarde manuelle

### Sauvegarder

YunoHost contient un système de sauvegarde, qui permet de sauvegarder (et restaurer) les configurations du système, les données "système" (comme les mails) et les applications (niveau 4+).

Vous pouvez gérer vos sauvegardes via la ligne de commande (`yunohost backup --help`) ou la webadmin (dans la section Sauvegardes) bien que certaines fonctionnalités ne soient pas disponibles via celle-ci.

La méthode de sauvegarde actuelle consiste à créer des archives `.tar` qui contiennent les fichiers pertinents.

##### Créer une sauvegarde

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="À partir de l'interface web"]

Vous pouvez facilement créer des archives depuis la webadmin en allant dans Sauvegardes > Archives locales et en cliquant sur "Nouvelle sauvegarde". Vous pourrez ensuite sélectionner les éléments à sauvegarder (configuration, données "système", applications).

![](image://backup.png)

[/ui-tab]
[ui-tab title="À partir de la ligne de commande"]

Vous pouvez créer de nouvelles archives depuis la ligne de commande. Voici quelques exemples de commandes et leur comportement correspondant :

- Tout sauvegarder (système et apps)
```bash
yunohost backup create
```

- Sauvegarder seulement les apps
```bash
yunohost backup create --apps
```

- Sauvegarder seulement deux apps (WordPress et Shaarli)
```bash
yunohost backup create --apps wordpress shaarli
```

- Sauvegarder seulement les mails
```bash
yunohost backup create --system data_mail
```

- Sauvegarder les mails et WordPress
```bash
yunohost backup create --system data_mail --apps wordpress
```

Pour plus d'informations et d'options sur la création d'archives, consultez `yunohost backup create --help`. Vous pouvez également lister les parties du système qui sont sauvegardables avec `yunohost hook list backup`.

[/ui-tab]
[/ui-tabs]

##### Télécharger la sauvegarde
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="À partir de l'interface web"]
Après avoir créé des sauvegardes, il est possible de les lister et de les inspecter grâce aux vues correspondantes dans l'interface d'administration web. Un bouton propose de télécharger l'archive. Si l'archive fait plus de 3Go, il peut être préférable de procéder via SFTP.

`Sauvegarde > Archives locales > <Nom de l'archive> > Télécharger`

[/ui-tab]
[ui-tab title="Via un client SFTP"]
À l'heure actuelle, la solution la plus accessible pour récupérer les sauvegardes de grosse taille est d'utiliser le programme FileZilla comme expliqué dans [cette page](/filezilla).

Par défaut, les sauvegardes sont stockées dans `/home/yunohost.backup/archives/`.

[/ui-tab]
[ui-tab title="À partir de la ligne de commande"]
Les commandes `yunohost backup list` et `yunohost backup info <nom_d'archive>` permettent d'obtenir des infiormations sur les noms et tailles des sauvegardes.

Il est possible d'utiliser `scp` (un programme basé sur [`ssh`](/ssh)) pour copier des fichiers entre deux machines grâce à la ligne de commande. Ainsi, depuis une machine sous GNU/Linux, vous pouvez utiliser la commande suivante pour télécharger une archive :

```bash
scp admin@your.domain.tld:/home/yunohost.backup/archives/<nom_d'archive>.tar.gz ./
```
[/ui-tab]
[/ui-tabs]

! N'oubliez pas de stocker votre sauvegarde dans un lieu différents de celui ou se trouve votre serveur.


!!! Si vous le souhaitez, vous pouvez connecter un disque externe à votre serveur pour que les archives arrivent directement dessus. Voir ce guide pour [Ajouter un stockage externe à son serveur](/external_storage)



### Tester

Vous devriez tester régulièrement vos sauvegardes à minima en listant le contenu des archives et en vérifiant le poids des données associées. Le mieux est de s'entrainer règulièrement à restaurer.
```bash
# Lister les fichiers
tar -tvf /home/yunohost.backup/archives/ARCHIVE.tar | less

# Lister les exports de base de données
tar -tvf /home/yunohost.backup/archives/ARCHIVE.tar | grep "(db|dump)\.sql"

# Vérifier le poids
ls -lh /home/yunohost.backup/archives/ARCHIVE.tar
```

### Restaurer

!!! SPOILER: Plus votre volume de données et le nombre d'applications sont important, plus votre restauration sera complexe.
#### Cas simple : peu de données, archive déjà présente

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="À partir de l'interface web"]

Allez dans `Sauvegardes > Archives locales` et sélectionnez l'archive. Vous pouvez ensuite choisir les différents éléments que vous voulez restaurer puis cliquer sur "Restaurer".

![](image://restore.png)


[/ui-tab]
[ui-tab title="À partir de la ligne de commande"]
Depuis la ligne de commande, vous pouvez utiliser `yunohost backup restore <nom_d'archive>` (sans le `.tar`) pour restaurer une archive. Tout comme `yunohost backup create`, cela restaure tout le contenu par défaut. Si vous souhaitez restaurer seulement certaines parties, vous pouvez utiliser par exemple `yunohost backup restore --apps wordpress` qui restaurera seulement l'app WordPress.

!!! Dans le cas d'une restauration complète, il est possible de restaurer à la place de lancer la configuration initiale.
[/ui-tab]
[/ui-tabs]

##### Contraintes

Pour restaurer une application, le domaine sur laquelle elle est installée doit déjà être configuré (ou il vous faut restaurer en même temps la configuration correspondante). Aussi, il n'est pas possible de restaurer une application déjà installée... ce qui veut dire que pour restaurer une sauvegarde d'une app, il vous faut déjà la désinstaller.

#### Téléverser une archive
Dans de nombreux cas, l'archive n'est pas sur le serveur sur lequel on souhaite la restaurer. Il faut donc la téléverser, ce qui selon son poids peut prend plus ou moins de temps.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Via un client SFTP"]
À l'heure actuelle, la solution la plus accessible pour téléverser les sauvegardes est d'utiliser le programme FileZilla comme expliqué dans [cette page](/filezilla).

Par défaut, les sauvegardes sont à placer dans `/home/yunohost.backup/archives/`.
[/ui-tab]
[ui-tab title="À partir de la ligne de commande"]
Vous pouvez téléverser une sauvegarde depuis une machine vers votre serveur avec :

```bash
scp /path/to/your/<nom_d'archive>.tar.gz admin@your.domain.tld:/home/yunohost.backup/archives/
```
[/ui-tab]
[/ui-tabs]



## Sauvegarde automatique ou distante

### Sauvegarder
Il existe 3 applications YunoHost qui proposent d'étendre YunoHost avec une méthode de sauvegarde automatisées.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="BorgBackup (conseillée)"]
Cette application propose:
* la sauvegarde des données sur un disque externe ou sur un dépot borg distant
* la déduplication et la compression des fichiers ce qui permet de conserver de nombreuses copies antèrieures
* le chiffrement des données, ce qui permet de pouvoir stocker chez un tiers

Le paquet permet aussi de définir finement la fréquence et le type de données à sauvegarder et intégre un système d'alerte mail en cas de défaut de sauvegarde.

Il existe des [fournisseurs de dépots borg distant](https://www.borgbackup.org/support/commercial.html), il est également possible de créer son propre dépot sur un autre YunoHost avec l'[application borgserver](https://github.com/YunoHost-Apps/borgserver_ynh).

La future méthode de sauvegarde intégrée par défaut dans YunoHost sera basée sur ce logiciel.

!!! Pour la mise en place, il faut d'abord installé l'[application borg](https://github.com/YunoHost-Apps/borg_ynh), puis éventuellement l'[application borgserver](https://github.com/YunoHost-Apps/borgserver_ynh).


[/ui-tab]
[ui-tab title="Restic"]
Cette application propose:
* la sauvegarde des données sur un stockage distant (support de différents types de stockage)
* la déduplication et la compression des fichiers ce qui permet de conserver de nombreuses copies antèrieures
* le chiffrement des données, ce qui permet de pouvoir stocker chez un tiers

Le paquet permet aussi de définir finement la fréquence et le type de données à sauvegarder et intégre un système d'alerte mail en cas de défaut de sauvegarde.


[/ui-tab]
[ui-tab title="Archivist (rsync)"]

Il existe aussi l'application Archivist qui se base sur rsync : [https://forum.yunohost.org/t/new-app-archivist/3747](https://forum.yunohost.org/t/new-app-archivist/3747)

[/ui-tab]
[/ui-tabs]

### Tester
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Archive borg"]
Avec les apps borg un email est envoyé pour dire si la sauvegarde échoue ou si le repo distant n'a rien reçu. On peut toutefois analyser manuellement pour s'assurer que tout va bien de façon plus complète.

```bash
# Lister les fichiers
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg list "$(yunohost app setting $app repository)" | less

# Lister les exports de base de données
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg list "$(yunohost app setting $app repository)" | grep "(db|dump)\.sql"

# Lister les fichiers de l'archive
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg list "$(yunohost app setting $app repository)::ARCHIVE" | less

# Voir les infos de l'archive
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg info "$(yunohost app setting $app repository)::ARCHIVE"

# Vérifier l'intégrité des données
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg check "$(yunohost app setting $app repository)::ARCHIVE" --verify-data
```
[/ui-tab]
[/ui-tabs]

### Restaurer

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="BorgBackup (conseillée)"]
Si on est dans le cas d'une migration ou d'une réinstallation, il faut réinstaller borg de la même façon. Si le repo est distant il faut changer la clé publique.

Lister les archives disponibles
```
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg list "$(yunohost app setting $app repository)"
```

Créer les archives tar (une archive par app et partie de système)
```
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg export-tar "$(yunohost app setting $app repository)::ARCHIVE" /home/yunohost/archives/ARCHIVE.tar
```

Puis restaurer l'archive allégée de façon classique.
[/ui-tab]
[/ui-tabs]

## Restaurer des grosses archives
Si l'espace disponible est inférieur au poids de votre archive, des données décompréssées et des dépendances, vous devrez restaurer partie par partie, app par app.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Archive tar"]
### Générer une archive par app, à partir d'une grosse archive

TODO

### Retirer les fichiers lourds d'une archive

TODO

[/ui-tab]
[ui-tab title="Archive borg"]
Si restaurer app par app ne suffit pas OU si une archive est trop grosse, il peut être judicieux de génerer une archive tar sans les "grosses" données d'une app comme si elle avait étét générée avec l'[option BACKUP_CORE_ONLY](#ne-pas-sauvegarder-les-grosses-quantites-de-donnees). Exemple avec nextcloud:
```
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg export-tar -e apps/nextcloud/backup/home/yunohost.app "$(yunohost app setting $app repository)::ARCHIVE" /home/yunohost/archives/ARCHIVE.tar
```

Il faudra ensuite extraire ces données directement avec borg
```
cd /home/yunohost.app/
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg extract "$(yunohost app setting $app repository)::ARCHIVE" apps/nextcloud/backup/home/yunohost.app/
mv apps/nextcloud/backup/home/yunohost.app/nextcloud ./
rm -r apps
```

Puis restaurer de façon classique
[/ui-tab]
[/ui-tabs]

## Aller plus loin


