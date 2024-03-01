---
title: Includere o escludere files
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/include_exclude_files'
page-toc:
  active: true
  depth: 3
---

## Includere file

Nella maggior parte dei casi YunoHost conosce quali file devono fare parte del backup. Tuttavia se avete effettuato delle modifiche, ad esempio installando un programma senza avvalervi della procedura ufficiale di YunoHost, dovrete includere altri file da salvare nel vostro schema di backup.

YunoHost tiene traccia delle modifiche effettuate utilizzando gli strumenti di default. Al contrario un programma o un database aggiunti manualmente e/o delle modifiche a file di configurazione, non saranno inseriti nel backup.

Potete creare un hook di backup e un hook di ripristino per aggiungere i file da salvare. Esempio:


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



## Escludere file
Esistono solo due metodi per escludere file dal backup di YunoHost:

### Escludere alcune cartelle presenti in `/home`
Se necessario potete specificare quali cartelle nella `home` di un utente non siano da includere nel comando `yunohost backup`, creando al loro interno un file vuoto con l'estensione `.nobackup`.

Attenzione: questo metodo funziona solo con la **prima sottodirectory di `/home`** ad esempio `/home/user1` o `/home/yunohost.multimedia`. Al contrario non funzionerà per altre sottodirectory come `/home/user1/miacartella`.

### Escludere grandi quantità di dati

Alcuni programmi come Nextcloud sono potenzialmente accompagnati da grandi quantità di dati. In questi casi viene fatto il backup solo del programma stesso (il "core").  
Generalmente negli aggiornamenti dei programmi che contengono grandi quantità di dati, questi vengono esclusi dal backup.


Per disattivare temporaneamente, nei programmi che supportano tale procedura, il backup di file di grandi dimensioni potete definire la variabile `BACKUP_CORE_ONLY`. La variabile deve essere definita prima di eseguire il comando di backup:
```bash
BACKUP_CORE_ONLY=1 yunohost backup create --apps nextcloud
```

Attenzione: dovrete procedere fare  backup dei dati degli utenti Nextcloud separatamente.

Se volete rendere permanente l'impostazione:
```bash
yunohost app setting nextcloud do_not_backup_data -v 1
```
