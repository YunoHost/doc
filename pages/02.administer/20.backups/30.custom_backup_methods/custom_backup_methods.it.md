---
title: Metodi di backup personalizzati
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/custom_backup_methods'
page-toc:
  active: true
  depth: 3
---

È possibile creare un proprio metodo di backup e includerlo nel sistema di raccolta file di backup di YunoHost. Questo può essere utilizzato ad esempio, nel caso utilizziate un particolare programma di backup o vogliate effettuare delle operazioni di montaggio o smontaggio sui vostri HD.

Dovrete creare un hook che lancerà il backup utilizzando il metodo personalizzato con questo comando:

```bash
yunohost backup create --method custom
```

Di seguito un esempio, semplificato, che esegue il backup con rotazione dei dischi, che vengono sostituiti ogni settimana.

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
