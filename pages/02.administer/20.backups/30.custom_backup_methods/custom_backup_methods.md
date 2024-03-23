---
title: Custom backup methods
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/custom_backup_methods'
page-toc:
  active: true
  depth: 3
---

It is possible to create your own backup method and link it to YunoHost's backup file collection system. This can be useful if you want to use your own backup software or conduct disk mount/dismount operations for example.

This operation is done with a hook and will allow you to launch a backup this way:

```bash
yunohost backup create --method custom
```

Below is a simplistic example that can be used to set up a rotational backup with different disks that are changed every week:

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
