---
title: BorgBackup
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/borgbackup'
page-toc:
  active: true
  depth: 3
---


YunoHost propose un couple d'applications pour [BorgBackup](https://www.borgbackup.org/).

## Fonctionnalité
Cette application propose:
* la sauvegarde des données sur un disque externe ou sur un dépôt borg distant
* la déduplication et la compression des fichiers ce qui permet de conserver de nombreuses copies antérieures
* le chiffrement des données, ce qui permet de pouvoir stocker chez un tiers
* de définir finement la fréquence et le type de données à sauvegarder
* un système d'alerte mail en cas de défaut de sauvegarde.

Il existe des [fournisseurs de dépôts borg distants](https://www.borgbackup.org/support/commercial.html), il est également possible de créer son propre dépôt sur un autre YunoHost avec l'[application borgserver](https://github.com/YunoHost-Apps/borgserver_ynh).

La future méthode de sauvegarde intégrée par défaut dans YunoHost sera basée sur ce logiciel.

## Mise en place de la sauvegarde
!!! Pour la mise en place, il faut d'abord installer l'[application borg](https://github.com/YunoHost-Apps/borg_ynh), puis éventuellement l'[application borgserver](https://github.com/YunoHost-Apps/borgserver_ynh).

### Configurer Borg pour des sauvegardes locales :

1. créer le répertoire qui accueillera le dépot de sauvegardes 
- Pour éviter tout conflit de permissions, il peut être pratique de placer ce répertoire à la racine du serveur, par exemple `~/borgbackups/`
- Dans le cas d'un dépot sur un disque externe (suivre [ce super guide](https://yunohost.org/fr/external_storage) pour le monter automatiquement), créer le répertoire à l'endroit désiré avec `mkdir /dossier/sur/disque/externe` et créer à la racine du serveur un lien symbolique vers le répertoire du dépot `ln /dossier/sur/disque/externe /borgbackups`

2. installer l'application Borg depuis l'interface d'administration Yunohost (Borg Server n'est pas utile dans ce cas d'usage) :
- renseigner le chemin du repo (ou de son lien symbolique dans le cas d'un disque externe) 
- comme indiqué sur la page d'install : conserver précieusement la passphrase (dans un gestionnaire de mot de passe idéalement) car il sera impossible de restaurer les sauvegardes sans elle
- pour ne pas sauvegarder certaines applications il est possible d'ajouter le tag `exclude` suivi des apps à exclure
- la fréquence des sauvegardes est par défaut `Daily` soit quotidiennement à minuit mais il est possible de paramètrer ce qu'on veut :
    - Monthly
    - Weekly
    - Daily : quotidiennement à minuit
    - Hourly : chaque heure 0 minute
    - Sat --1..7 18:00:00 : Le premier samedi du mois à 18h
    - 4:00 : tous les jours à 04h
    - 5,17:00 : tous les jours à 05h et 17h 

Plus d'info : https://wiki.archlinux.org/index.php/Systemd/Timers#Realtime_timer

3. Lancer une première sauvegarde en démarrant le service Borg dans l'administration Yunohost (admin > outils > services > borg > démarrer le service) ou avec la commande `systemctl start borg`

4. Vérifier dans les journaux (admin > outils > journaux) si toutes les sauvegardes se sont bien déroulées

5. Bravo !






## Tester
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

## Restaurer

### Restaurer une seule application depuis un dépot local

1. lister les archives de votre dépot :
    `$ borg list /chemin/du/dépot/`
	Le serveur devrait demander la clef de récupération du dépot borg puis lister toutes les archives en commençant par la plus ancienne :
```
Enter passphrase for key /externalbackup:
_auto_conf-2023-11-26_04:00          Sun, 2023-11-26 04:00:08 [4daed8508d3a52ed6e90aac4e0ed49b07fc56301950b817ce49ede6bb2f59dd0]
_auto_data-2023-11-26_04:00          Sun, 2023-11-26 04:00:29 [25c837f478c39d30bf6956441e64583d42d4a2f25d1ec35f07ab41480bbb92bd]
etc.
```

2. trouver l'archive que l'on souhaite restaurer et copier son nom, par exemple : `_auto_conf-2023-11-26_04:00`

3. demander l'export de l'archive vers le dossier des backups Yunohost (par défaut /home/yunohost.backup/archives/) :
```
borg export-tar /externalbackup::_auto_conf-2023-11-26_04:00 /home/yunohost.backup/archives/UN_NOM_PRATIQUE.tar.gz
```

5. l'archive devrait apparaître dans la liste des backups yunohost, il ne reste qu'à la restaurer comme une sauvegarde habituelle !

Si on est dans le cas d'une migration ou d'une réinstallation, il faut réinstaller borg de la même façon. Si le repo est distant il faut changer la clé publique.

Lister les archives disponibles
```
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg list "$(yunohost app setting $app repository)"
```

Créer les archives tar (une archive par app et partie de système)
```
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg export-tar "$(yunohost app setting $app repository)::ARCHIVE" /home/yunohost.backup/archives/ARCHIVE.tar
```

Puis restaurer l'archive de façon classique.

### Restaurer des grosses archives
Si l'espace disponible est inférieur au poids de votre archive, des données décompressées et des dépendances, vous devrez restaurer partie par partie, app par app.

Si restaurer app par app ne suffit pas OU si une archive est trop grosse, il peut être judicieux de générer une archive tar sans les "grosses" données d'une app comme si elle avait été générée avec l'[option BACKUP_CORE_ONLY](/backup/include_exclude_files#ne-pas-sauvegarder-les-grosses-quantites-de-donnees). Exemple avec Nextcloud:
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
