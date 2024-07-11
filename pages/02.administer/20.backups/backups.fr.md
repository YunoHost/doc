---
title: Sauvegardes
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup'
page-toc:
  active: true
  depth: 3
---

Dans le contexte de l'auto-hébergement, les sauvegardes (backups) sont un élément important pour pallier les événements inattendus (incendies, corruption de base de données, perte d'accès au serveur, serveur compromis...). La politique de sauvegardes à mettre en place dépend de l'importance des services et des données que vous gérez. Par exemple, sauvegarder un serveur de test aura peu d'intérêt, tandis que vous voudrez être très prudent si vous gérez des données critiques pour une association ou une entreprise - et dans ce genre de cas, vous souhaiterez stocker les sauvegardes *dans un endroit différent*.

## Sauvegarde manuelle

### Sauvegarder

YunoHost contient un système de sauvegarde, qui permet de sauvegarder (et restaurer) les configurations du système, les données « système » (comme les mails) et les applications si elles le supportent.

Vous pouvez gérer vos sauvegardes via la ligne de commande (`yunohost backup --help`) ou la webadmin (dans la section Sauvegardes) bien que certaines fonctionnalités ne soient pas disponibles via celle-ci.

La méthode de sauvegarde actuelle consiste à créer des archives `.tar` qui contiennent les fichiers pertinents.

#### Créer une sauvegarde

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="À partir de l'interface web"]

Vous pouvez facilement créer des archives depuis la webadmin en allant dans `Sauvegardes > Archives locales` et en cliquant sur `Nouvelle sauvegarde`. Vous pourrez ensuite sélectionner les éléments à sauvegarder (configuration, données "système", applications).

![Image de l'écran de sauvegarde de YunoHost dans la webadmin](image://backup.png)

[/ui-tab]
[ui-tab title="À partir de la ligne de commande"]

Vous pouvez créer de nouvelles archives depuis la ligne de commande. Voici quelques exemples de commandes et leur comportement correspondant :

- Tout sauvegarder (système et apps) :

```bash
yunohost backup create
```

- Sauvegarder seulement les apps :

```bash
yunohost backup create --apps
```

- Sauvegarder seulement deux apps (WordPress et Shaarli) :

```bash
yunohost backup create --apps wordpress shaarli
```

- Sauvegarder seulement les mails :

```bash
yunohost backup create --system data_mail
```

- Sauvegarder les mails et WordPress :

```bash
yunohost backup create --system data_mail --apps wordpress
```

Pour plus d'informations et d'options sur la création d'archives, consultez `yunohost backup create --help`. Vous pouvez également lister les parties du système qui sont sauvegardables avec `yunohost hook list backup`.

[/ui-tab]
[/ui-tabs]

#### Télécharger la sauvegarde

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
scp admin@votre.domaine.tld:/home/yunohost.backup/archives/<nom_darchive>.tar ./
```

En cas de port SSH autre que 22 :

```bash
scp -P port_ssh admin@votre.domaine.tld:/home/yunohost.backup/archives/<nom_darchive>.tar ./
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

À partir de la ligne de commande, vous pouvez exécuter `yunohost backup list` pour obtenir les noms des archives disponibles. Il s'agit essentiellement de leur nom de fichier sans extension.

Vous pouvez ensuite exécuter `yunohost backup restore <archivename>` (donc sans son extension .tar) pour restaurer une archive. Comme pour `yunohost backup create`, cela restaurera tout ce qui se trouve dans l'archive par défaut. Si vous voulez restaurer uniquement des éléments spécifiques, vous pouvez utiliser par exemple `yunohost backup restore <archivename> --apps wordpress` qui restaurera uniquement l'application wordpress.

!!! Dans le cas d'une restauration complète, il est possible de restaurer à la place de lancer la configuration initiale.
[/ui-tab]
[/ui-tabs]

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
scp /path/to/your/<nom_d'archive>.tar admin@your.domain.tld:/home/yunohost.backup/archives/
```

En cas de port SSH autre que 22 :

```bash
scp -P port_ssh /path/to/your/<nom_d'archive>.tar admin@your.domain.tld:/home/yunohost.backup/archives/
```

[/ui-tab]
[/ui-tabs]
