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
