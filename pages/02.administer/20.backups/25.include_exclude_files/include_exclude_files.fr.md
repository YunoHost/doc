---
title: Inclure/exclure des fichiers
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/include_exclude_files'
page-toc:
  active: true
  depth: 3
---

## Inclure des fichiers

YunoHost sait en général déjà ce qui doit être sauvegardé. Toutefois, si vous avez procédé à des modifications manuelles, par exemple en installant une app en dehors du système d'applications de YunoHost, vous pouvez avoir envie d'étendre le mécanisme de YunoHost pour spécifier d'autres fichiers à sauvegarder.

Par défaut, si des configurations suivies par YunoHost sont modifiées, elles seront sauvegardées. En revanche, une base de données ou une app ajoutée à la main, des modifs sur certaines configurations non suivies, ne le seront pas.

Vous pouvez créer un hook de sauvegarde et un hook de restauration pour ajouter des données à sauvegarder. Ci-dessous un exemple:

`/etc/yunohost/hooks.d/backup/99-conf_custom`

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

`/etc/yunohost/hooks.d/restore/99-conf_custom`

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

## Exclure des fichiers

Il n'existe pas de mécanisme pour exclure d'une sauvegarde au format YunoHost des fichiers spécifiques, en dehors des 2 options présentées ci-dessous:

### Éviter de sauvegarder certains dossiers du `/home`

Si besoin, vous pouvez spécifier que certains dossiers `home` d'utilisateurs ou utilisatrices ne soient pas sauvegardés par la commande `yunohost backup`, en créant un fichier vide nommé `.nobackup` à l'intérieur.

Attention ce mécanisme ne fonctionne que pour les **sous-dossiers de premier niveau** du `/home`, comme par exemple `/home/user1` ou `/home/yunohost.multimedia` . Cela ne fonctionne pas pour les autres dossiers ou sous-dossiers, comme par exemple `/home/user1/grosdossier`.

### Ne pas sauvegarder les grosses quantités de données

Certaines apps comme Nextcloud sont potentiellement rattachées à des quantités importantes de données. Il est possible de ne pas les sauvegarder par défaut. Dans ce cas, on dit que l'app "sauvegarde uniquement le core" (de l'app).  
Lors d'une mise à jour, les apps contenant une grande quantité de données effectuent généralement une sauvegarde sans ces données.

Pour désactiver temporairement la sauvegarde des données volumineuses, pour les applications qui implémentent cette fonctionnalité, vous pouvez définir la variable `BACKUP_CORE_ONLY`. Pour ce faire, la variable doit être définie avant la commande de backup :

```bash
BACKUP_CORE_ONLY=1 yunohost backup create --apps nextcloud
```

Faites montre de prudence : il vous faudra alors sauvegarder vous-même les données des utilisateurs et utilisatrices de Nextcloud.

Si vous souhaitez que ce comportement soit permanent:

```bash
yunohost app setting nextcloud do_not_backup_data -v 1
```
