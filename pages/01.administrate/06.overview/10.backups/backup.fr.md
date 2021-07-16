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

## Définir sa stratégie de sauvegarde
#### Qu'est-ce qu'une bonne sauvegarde ?
Une bonne sauvegarde est constituée d'au moins **3 copies des données** (en comptant les données originales), sur au moins **2/3 stockages distincts**, dans au moins **2 lieux distincts** (suffisament éloignés) et idéalement avec 2 méthodes distinctes. Si vos sauvegardes sont chiffrées **ces règles s'appliquent aussi à la phrase/clé de déchiffrement**.

Une bonne sauvegarde est aussi dans de nombreux cas, une sauvegarde récente, il faut donc soit beaucoup de rigueur, soit **automatiser** le processus.

Une bonne sauvegarde est vérifiée régulièrement afin de s'assurer de l'effectivité et de l'intégrité des données.

Enfin, une bonne sauvegarde est une sauvegarde **restaurable dans des délais acceptables** pour vous. Pensez notamment à documenter votre méthode de restauration et à estimer le temps de transfert d'une copie notamment si les connexions internet en jeu ne sont pas symétriques.

!!! Exemple d'**une combinaison** robuste et comfortable:
!!!  * une sauvegardes distantes et automatique avec borg
!!!  * une sauvegarde sur disque externe et automatique avec borg
!!!  * un snapshot/image régulier (et avant les mise à jour)
!!!  * une grappe RAID 1 monitorée (ou un VPS du commerce qui sera aussi sur une grappe)
!!!  * une passphrase de déchiffrement stockée sur 3 supports dans 2 lieux


#### Méthodes possibles

* **[générer une archive et la télécharger manuellement (méthode par défaut de YunoHost)](#generer-une-archive-et-la-telecharger-manuellement-methode-par-defaut)**
* **[sauvegarder automatiquement via une app (méthode conseillée)](#sauvegarder-automatiquement-via-une-app-methode-conseillee)**
* **[générer une archive directement sur un autre disque](#generer-une-archive-directement-sur-un-autre-disque)**
* **[faire une image du disque à froid](#creer-une-image-du-systeme-de-fichier-a-froid)** ou **[déclencher un snapshot](#declencher-un-snapshot)**
* [sauvegarder les données utiles via une méthode personnalisée](#etendre-yunohost-avec-une-methode-personnalisee) \*
* [augmenter la redondance des données de production](#redondance-de-stockage) \*
* [synchroniser de façon bi-directionnel grâce à un logiciel comme Nextcloud ou via IMAP](#synchronisation-nextcloud-ou-thunderbird-imap) \*

!! \* Ces 3 dernières méthodes ne sont souvent pas suffisantes, peuvent être mal exécutées et peuvent vous donner un sentiment de fausse sécurité.

#### Risques
Ci-dessous, une liste de risques triés du plus au moins probables, dont la probabilité reste à adapter selon votre situation (lieu du serveur, qualité des installations, profils d'usagers, etc.). A vous de mettre le curseur là où il faut, notamment en considérant les conséquences d'une perte de données. 

!!! Gardez en tête que les vrais accidents sont liés à la survenue de 2 évènements de façon simultannés. 

* **Manque de rigueur**: les stratégies à base de sauvegardes manuelles nécessitent beaucoup de rigueur dans la régularité
* **Mauvaise manipulation**: il peut arriver d'effacer une sauvegarde par erreur lors d'une restauration ou si vous comptez sur un système de synchronisation, vous pourriez supprimer un fichier et que la suppression soit synchronisée de façon instantannée
* **Cryptolocker**: il s'agit de virus qui chiffre les fichiers et réclament une ranson. Si vos utilisateurs utilisent nextcloud et windows, un windows infecté pourrait synchroniser des fichiers chiffrés et ainsi vous perdez votre copie.
* **Panne matériel**: les cartes SD sont les supports les moins fiables dans le temps (~2ans de vie dans un serveur), viennent ensuite les disques SSD (environ 3 ans de vie) et les disques durs (3 ans). A noter qu'un équipement neuf a aussi des probabilité de tomber en panne lors des 6 premiers mois. Dans tous le scas, vos copies ne devraient pas être sur le même support physique.
* **Panne logiciel/bug**: un bug logiciel peut aboutir à la suppression de données ou vous pourriez ne pas savoir réparer un problème et souhaiter restaurer votre système.
* **Panne d'électricité ou d'internet**: avez-vous un plan si ça arrive? Quid si vous êtes en vacances ?
* **Catastrophe ou événement naturel ou non**: un petit enfant, un chat, la foudre ou une simple fuite peuvent détruire votre matériel. Les incendies ou innondations peuvent aussi mettre à mal votre copie de sauvegarde à l'autre bout de votre logement...
* **Compromission du serveur**: une personne malveillante ou un robot pourrait attaquer votre serveur et supprimer vos données
* **Vol de machine**: un cambriolage ou le vol d'un ordinateur sur lequel se trouve votre gestionnaire de mots de passe pour déchiffrer vos sauvegardes
* **Perquisition**: que vous soyez coupable ou non, une perquisition peut aboutir à la saisie entière du matériel informatique d'un lieu (voir de plusieurs)
* **Décés/problème de santé**: vous pourriez ne plus être en mesure de tapper votre phrase de passe


## Sauvegarder

Nous vous proposons de faire un ou des choix parmi les méthodes suivantes:

### Générer une archive et la télécharger manuellement (méthode par défaut)

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

De façon similaire, vous pouvez téléverser une sauvegarde depuis une machine vers votre serveur avec :

```bash
scp /path/to/your/<nom_d'archive>.tar.gz admin@your.domain.tld:/home/yunohost.backup/archives/
```

### Sauvegarder automatiquement via une app (méthode conseillée)

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

### Générer une archive directement sur un autre disque


Si vous le souhaitez, vous pouvez connecter un disque externe à votre serveur pour stocker les archives de backup dessus. Voir ce guide pour [Ajouter un stockage externe à son serveur](/external_storage)


### Créer une image du système de fichier à froid
Si vous êtes sur une carte ARM, une autre méthode de backup consiste à créer une image de la carte SD.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Avec USBimager"]
Ceci peut être effectué avec [USBimager](https://bztsrc.gitlab.io/usbimager/) (N.B. : assurez-vous de télécharger la version 'Read-write' ! Pas la version 'Write-only' !). Le processus consiste ensuite à "l'inverse" du processus de flashage de la carte SD:
- Éteignez votre serveur
- Récupérez la carte SD et branchez la dans votre ordinateur
- Dans USBimager, cliquez "Read" pour créer une image ("photographie") de la carte SD. Vous pouvez utiliser le fichier obtenu pour plus tard restaurer le système en entier.

Plus de détails dans [la doc d'USBimager](https://gitlab.com/bztsrc/usbimager/#creating-backup-image-file-from-device)
[/ui-tab]
[ui-tab title="En ligne de commande avec dd"]

Il est possible d'obtenir la même chose avec `dd` si vous êtes à l'aise avec la ligne de commande:

```bash
dd if=/dev/mmcblk0 | gzip > ./my_snapshot.gz
```

(remplacez `/dev/mmcblk0` par le vrai nom de votre carte SD)
[/ui-tab]
[/ui-tabs]

### Déclencher un snapshot
Un snapshot permet de figer une image du système de fichier et d'y revenir en cas de soucis. Trés pratique lorsque l'on fait une mise à jour, en revanche ça ne protège pas des pannes matérielles (cf. incendie d'OVH à Strasbourg en 2021).

Si vous utilisez un VPS, il est possible que votre fournisseur propose des fonctionnalités de snapshot. Attention tout de même, n'oubliez pas que ces snapshot sont probablement stockés sur les mêmes supports de stockage que votre VPS.

Si vous utilisez proxmox, btrfs ou d'autres systèmes de fichiers comme ceph ou ZFS, il y a de forte chance pour que vous puissiez aussi déclencher des snapshot.

## Tester régulièrement

Vous devriez tester régulièrement vos sauvegardes à minima en listant le contenu des archives et en vérifiant le poids des données associées. Le mieux est de s'entrainer règulièrement à restaurer.
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Archive tar"]
```bash
# Lister les fichiers
tar -tvf /home/yunohost.backup/archives/ARCHIVE.tar | less

# Lister les exports de base de données
tar -tvf /home/yunohost.backup/archives/ARCHIVE.tar | grep "(db|dump)\.sql"

# Vérifier le poids
ls -lh /home/yunohost.backup/archives/ARCHIVE.tar
```
[/ui-tab]
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

## Restaurer

!!! SPOILER: Plus votre volume de données et le nombre d'applications sont important, plus votre restauration sera complexe.
### Cas simple : peu de données, archive déjà présente

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="À partir de l'interface web"]

Allez dans `Sauvegardes > Archives locales` et sélectionnez l'archive. Vous pouvez ensuite choisir les différents éléments que vous voulez restaurer puis cliquer sur "Restaurer".

![](image://restore.png)


[/ui-tab]
[ui-tab title="À partir de la ligne de commande"]
Depuis la ligne de commande, vous pouvez utiliser `yunohost backup restore <nom_d'archive>` (sans le `.tar`) pour restaurer une archive. Tout comme `yunohost backup create`, cela restaure tout le contenu par défaut. Si vous souhaitez restaurer seulement certaines parties, vous pouvez utiliser par exemple `yunohost backup restore --apps wordpress` qui restaurera seulement l'app WordPress.
[/ui-tab]
[/ui-tabs]

#### Contraintes

Pour restaurer une application, le domaine sur laquelle elle est installée doit déjà être configuré (ou il vous faut restaurer en même temps la configuration correspondante). Aussi, il n'est pas possible de restaurer une application déjà installée... ce qui veut dire que pour restaurer une sauvegarde d'une app, il vous faut déjà la désinstaller.

### Téléverser une archive
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

### Reconstituer une archive depuis borg

Si on est dans le cas d'une migration ou d'une réinstallation, il faut réinstaller borg de la même façon. Si le repo est distant il faut changer la clé publique.

Lister les archives disponibles
```
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg list "$(yunohost app setting $app repository)"
```

Créer les archives tar (une archive par app et partie de système)
```
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg export-tar "$(yunohost app setting $app repository)::ARCHIVE" /home/yunohost/archives/ARCHIVE.tar
```

Puis restaurer de façon classique

### Si l'archive est trop grosse ou représente plus de 50% de l'espace disponible
Si votre archive + les données décompréssées + le poids des dépendances représentent plus que l'espace disponible, vous devrez restaurer partie par partie, app par app.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Archive tar"]
A la fin il faudra générer une ou des archives ne contenant plus que les données de tel ou tel app.

TODO: commande pour faire ça.
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


### Restauration d'une archive à la place de la post-installation

Une fonctionnalité particulière est la possibilité de restaurer une archive entière *à la place* de faire la post-installation. Ceci est utile pour réinstaller un système entièrement à partir d'une sauvegarde existante. Pour faire cela, il vous faudra d'abord téléverser l'archive sur le serveur et la placer dans `/home/yunohost.backup/archives`.

Ensuite, **à la place de** `yunohost tools postinstall`, réalisez la restauration de l'archive téléversée par cette ligne de commande avec le nom de l'archive (sans le `.tar`) :

```bash
yunohost backup restore <nom_d'archive>
```
### Cas de la fusion de serveur
Si vous fusionner 2 serveurs ensemble, vous devrez recréer les utilisateurs, les domaines et les permissions du premier serveur sur le serveur de destination. Puis vous pourrez restaurer app par app. 

!! Il existe tout de même une limite concernant les apps qui ont le même ID. Il ne sera pas possible de les restaurer facilement. Attention également à ne pas supprimer l'app eponyme du serveur de destination :/

## Usages avancés

### Synchronisation Nextcloud ou Thunderbird (IMAP)
Une méthode qui permet une sauvegarde partielle consiste à sauvegarder les fichiers et les emails via des logiciels de synchronisation comme Nextcloud client ou ThunderBird. De cette façon, vous éviter le risque de panne matériel. En revanche, si vous êtes sur windows ou mac vous augmenter de façon non négligeable le risque de perte de données suite au chiffrement des fichiers par un cryptolocker. Par ailleurs une fausse manipulation peut supprimer l'ensemble de vos copies sur le serveur et sur les équipements qui synchronise. Ce soucis est agravé par le fait que la synchronisation de suppression est en général plutôt instantannée.

!! Ces outils de synchronisation bi-directionnel peuvent donner un faux sentiment de sécurité. Il convient donc d'utiliser **en plus** un logiciel pour automatiser une copie des dossiers Nextcloud et Mozilla Thunderbird ( dont l'emplacement dépend de votre système) dans le but de contrer l'aspect bi-directionnel. Sous linux, on peut citer Timeshift.

### Redondance de stockage
Afin de limiter les pannes matérielles des supports de stockage, il peut être pertinent de mettre en place une grappe de disques en miroirs (RAID, ZFS). L'idée ici est que tout ce qui est écrit sur un disque le sera sur l'autre.AInsi si l'un tombe en panne, l'autre continue de fonctionner et le serveur est toujours fonctionnel.

Il existe aussi des grappes plus évoluées qui maximisent la tolérance de panne (panne de 2 disques) ou le stockage (voir RAID 5).

Toutefois, ces techniques de grappes de disques ne devraient pas être considérées comme des copie de sauvegarde. Une grappe RAID devrait être considérée comme un seul support de stockage. En effet, si cette technique permet d'éviter de devoir réinstaller en cas de crash probable d'un disque, on est loin du risque zéro.

Quelques exemples de situations connues des administrateurs systèmes professionnels:
* les disques d'une grappe montée avec des disques de la même marque peuvent tomber en panne quasiment en même temps en moins de quelques heures
* sans monitoring de la santé des disques, il y a de fortes chance que l'on ne remarque la panne d'un disque de la grappe que lorsqu'un deuxième tombe en panne (><)
* si on a pas de disque de rechange, le délais d'achat peut aboutir à un crash de l'autre disque
* un disque à moitié fonctionnel qui produit des erreurs peut propager son erreur à travers la grappe
* les connectiques des disques ou le controlleur RAID peuvent produire des erreurs aussi ou tomber en panne
* plus on compléxifie l'architecture avec de nombreux composants, plus il y a des chances que l'un d'eux tombe en panne

!!! Si vous souhaitez mettre en place une grappe RAID ou utiliser btrfs, le plus simple est de la faire à l'installation avec l'iso YunoHost en mode expert (lors du partitionnement du système).


### Ne pas sauvegarder les grosses quantités de données

Certaines apps comme Nextcloud sont potentiellement rattachées à des quantités importantes de données. Il est possible de ne pas les sauvegarder par défaut. Dans ce cas, on dit que l'app "sauvegarde uniquement le core" (de l'app).  
Lors d'une mise à jour, les apps contenant une grande quantité de données effectuent généralement une sauvegarde sans ces données.

Pour désactiver temporairement la sauvegarde des données volumineuses, pour les applications qui implémentent cette fonctionnalité, vous pouvez définir la variable `BACKUP_CORE_ONLY`. Pour ce faire, la variable doit être définie avant la commande de backup : 
```bash
BACKUP_CORE_ONLY=1 yunohost backup create --apps nextcloud
```

Soyez prudent : il vous faudra alors sauvegarder vous-même les données des utilisateurs de Nextcloud.

Si vous souhaitez que ce comportement soit permanent:
```bash
yunohost app setting nextcloud do_not_backup_data -v 1
```

### Éviter de sauvegarder certains dossiers
Si besoin, vous pouvez spécifier que certains dossiers `home` d'utilisateurs ne soient pas sauvegardés par la commande `yunohost backup`, en créant un fichier vide nommé `.nobackup` à l'intérieur.

### Sauvegarder un serveur modifié manuellement
YunoHost est un système qui peut être modifié manuellement, par exemple vous pouvez installé des applications manuellement comme avec une debian classique.

Par défaut, si des configurations suivies par YunoHost sont modifiées, elles seront sauvegardés. En revanche, une base de données ou une app ajoutée à la main, des modifs sur certaines configuration non suivies, ne le seront pas.

Toutefois, vous pouvez créer un hook de sauvegarde et un hook de resturation pour ajouter des données à sauvegarder. Ci-dessous un exemple:

/etc/yunohost/hooks.d/backup/99-conf_custom
```bash
#!/bin/bash

# Source YNH helpers
source /usr/share/yunohost/helpers

ynh_backup_dest (){
    YNH_CWD="${YNH_BACKUP_DIR%/}/$1"
    mkdir -p $YNH_CWD
    cd "$YNH_CWD"
}

# Exit hook on subcommand error or unset variable
ynh_abort_if_errors

# Openvpn
ynh_backup_dest "conf/custom/openvpn"
ynh_backup "/etc/sysctl.d/openvpn.conf"
ynh_backup "/etc/openvpn"
ynh_backup "/etc/fail2ban/jail.d/openvpn.conf"
ynh_backup "/etc/fail2ban/filter.d/openvpn.conf"

# Samba
ynh_backup_dest "conf/custom/samba"
ynh_backup "/etc/samba"
ynh_backup "/var/lib/samba"
ynh_backup "/etc/yunohost/hooks.d/post_user_create/99-samba"
ynh_backup "/etc/yunohost/hooks.d/post_user_delete/99-samba"
ynh_backup --src_path="/etc/yunohost/hooks.d/post_user_update/99-samba" --not_mandatory
ynh_backup "/etc/cron.daily/clean-trash"

# MISC
ynh_backup_dest "conf/custom/misc"
ynh_backup "/etc/sysctl.d/noipv6.conf"
ynh_backup "/usr/local/bin/"
ynh_backup "/etc/yunohost/hooks.d/backup/99-conf_custom"
ynh_backup "/etc/yunohost/hooks.d/restore/99-conf_custom"
```

/etc/yunohost/hooks.d/restore/99-conf_custom
```bash
#!/bin/bash

# Source YNH helpers
source /usr/share/yunohost/helpers

ynh_restore_dest (){
    YNH_CWD="${YNH_BACKUP_DIR%/}/$1"
    cd "$YNH_CWD"
}

# Exit hook on subcommand error or unset variable
ynh_abort_if_errors

# Openvpn
app="custom_openvpn" # Cette variable est importante pour le helper suivant
ynh_install_app_dependencies "openvpn openvpn-auth-ldap samba"

ynh_restore_dest "conf/custom/openvpn"
ynh_restore_file "/etc/sysctl.d/openvpn.conf"
ynh_restore_file "/etc/openvpn"
ynh_restore_file "/etc/fail2ban/jail.d/openvpn.conf"
ynh_restore_file "/etc/fail2ban/filter.d/openvpn.conf"

# Samba
app="custom_samba" # Cette variable est importante pour le helper suivant
ynh_install_app_dependencies "samba"

ynh_restore_dest "conf/custom/samba"
ynh_restore_file "/etc/samba"
ynh_restore_file "/var/lib/samba"
ynh_restore_file "/etc/yunohost/hooks.d/post_user_create/99-samba"
ynh_restore_file "/etc/yunohost/hooks.d/post_user_delete/99-samba"
ynh_restore_file --src_path="/etc/yunohost/hooks.d/post_user_update/99-samba" --not_mandatory
ynh_restore_file "/etc/cron.daily/clean-trash"
chown -R openvpn:openvpn /etc/openvpn

# MISC
ynh_restore_dest "conf/custom/misc"
ynh_restore_file "/etc/sysctl.d/noipv6.conf"
ynh_restore_file "/usr/local/bin/"
ynh_restore_file "/etc/yunohost/hooks.d/backup/99-conf_custom"
ynh_restore_file "/etc/yunohost/hooks.d/restore/99-conf_custom"
```

### Etendre Yunohost avec une méthode de sauvegarde personnalisée
Il est possible de créer votre propre méthode de sauvegarde et de la lier au système de collecte de fichiers à sauvegarder de YunoHost. Ceci peut être utile si vous souhaitez utiliser votre propre logiciel de sauvegarde ou mener des opérations de montages démontages de disques par exemple.

Cette opération se fait à l'aide d'un hook et vous permetra de lancer une sauvegarde de cette façon:
```
yunohost backup create --method custom
```

Ci-dessous, un exemple simpliste qui peut permettre de mettre en place un backup rotationnel avec des différents disques que l'on change toutes les semaines:

/etc/yunohost/hooks.d/backup_method/05-custom
```bash
#!/bin/bash
set -euo pipefail

work_dir="$2"
name="$3"
repo="$4"
size="$5"
description="$6"

case "$1" in
  need_mount)
    # Set false if your method can itself put files in good place in your archive
    true
    ;;
  backup)
    mount /dev/sda1 /mnt/hdd
    if [[ "$(df /mnt/hdd | tail -n1 | cut -d" " -f1)" != "/dev/sda1" ]]
    then
        exit 1
    fi
    pushd "$work_dir"
    current_date=$(date +"%Y-%m-%d_%H:%M")
    cp -a "${work_dir}" "/mnt/hdd/${current_date}_$name"
    popd
    umount /mnt/hdd
    ;;
  *)
    echo "hook called with unknown argument \`$1'" >&2
    exit 1
    ;;
esac

exit 0
```
### Migration de serveur

Si le système d'archive de YunoHost est assez pratique pour migrer un serveur, on peut aussi [migrer de serveur à serveur avec rsync](https://www.man42.net/blog/2017/07/how-to-migrate-a-debian-server/).
