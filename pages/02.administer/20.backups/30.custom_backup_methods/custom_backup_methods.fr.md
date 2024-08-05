---
title: Méthodes personnalisées
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/custom_backup_methods'
page-toc:
  active: true
  depth: 3
---

Il est possible de créer votre propre méthode de sauvegarde et de la lier au système de collecte de fichiers à sauvegarder de YunoHost. Ceci peut être utile si vous souhaitez utiliser votre propre logiciel de sauvegarde ou mener des opérations de montages démontages de disques par exemple.

Cette opération se fait à l'aide d'un hook et vous permettra de lancer une sauvegarde de cette façon:

```bash
yunohost backup create --method custom
```

Ci-dessous, un exemple simpliste qui peut permettre de mettre en place un backup rotationnel avec différents disques que l'on change toutes les semaines:

`/etc/yunohost/hooks.d/backup_method/05-custom`

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
