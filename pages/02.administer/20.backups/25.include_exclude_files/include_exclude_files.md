---
title: Include or exclude files
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/include_exclude_files'
page-toc:
  active: true
  depth: 3
---

## Include files

YunoHost usually already knows what needs to be backed up. However, if you have made manual changes, such as installing an app outside of the YunoHost application system, you may want to extend YunoHost's mechanism to specify other files to be backed up.

By default, if configurations tracked by YunoHost are changed, they will be backed up. On the other hand, a database or an app added by hand, changes on some configurations not tracked, will not be backed up.

You can create a backup hook and a restore hook to add data to backup. Here is an example:


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
app="custom_openvpn" # This variable is important for the following helper
ynh_install_app_dependencies "openvpn openvpn-auth-ldap samba"

ynh_restore_dest "conf/custom/openvpn"
ynh_restore_file "/etc/sysctl.d/openvpn.conf"
ynh_restore_file "/etc/openvpn"
ynh_restore_file "/etc/fail2ban/jail.d/openvpn.conf"
ynh_restore_file "/etc/fail2ban/filter.d/openvpn.conf"

# Samba
app="custom_samba" # This variable is important for the following helper
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



## Exclude files
There is no mechanism to exclude specific files from a YunoHost backup, other than the 2 options presented below:

### Avoid backing up certain `/home` folders
If needed, you can specify that certain user `home` folders not be backed up by the `yunohost backup` command, by creating an empty file named `.nobackup` inside.

Caution: this setup only works with **first-level subfolders of `/home`**, such as `/home/user1` or `/home/yunohost.multimedia`. It does not work for other levels of subfolders, like `/home/user1/bigfolder/`.

### Do not backup large amounts of data

Some apps like Nextcloud are potentially attached to large amounts of data. It is possible to not backup them by default. In this case, the app is said to "backup only the core" (of the app).  
During an update, apps containing a large amount of data usually make a backup without these data.


To temporarily disable backup of large data, for applications that implement this feature, you can set the `BACKUP_CORE_ONLY` variable. To do this, the variable must be set before the backup command: 
```bash
BACKUP_CORE_ONLY=1 yunohost backup create --apps nextcloud
```

Be careful: you will have to backup Nextcloud users' data yourself.

If you want this behavior to be permanent:
```bash
yunohost app setting nextcloud do_not_backup_data -v 1
```

