# Backup

Verify that the folder exist in archives 
```bash
/home/yunohost.backup/
```
Launch a backup via 

```bash
sudo yunohost backup create 
```


In this version you can backup with cli or with the web admin. The cli way allows you to do more things. The webadmin way is more accessible.

## Webadmin way
Basically with the webadmin, you can:

- backup into /home/yunohost/archives/
- choose to backup one or more things between mail data, home data, configuration and apps
- list your backup
- see what there is in a backup
- restore selectively a backup

**Caution:** to do a backup, you need to have enough free disk spaces in the destination directory. For example, if you have 20GB in /home/data you need to have enough space to contain this 20GB compressed in a tar.gz. To do the tar.gz, yunohost backup use shallow copy, to avoid to need more spaces to be able to create the tar.gz .
**Caution:** If you use selective restore, be sure to not create discordant operation. For example, if you restore an app using a domain that have been deleted from YunoHost, you need to read the domain or to restore all configuration files.

We have already planned where we will add some feature like:

- backup in an other place
- download/upload a backup
- crypt a backup
Some feature are almost ready in webadmin, but the api is not for the moment.

## CLI way
### Backup
You can make a full backup by running this command:
```bash
admin@yunohost:~# sudo yunohost backup create
Exécution des scripts de sauvegarde...
Attention : backup script '/etc/yunohost/apps/phpmyadmin/scripts/backup' not found
Attention : App 'phpmyadmin' will not be saved
Lancement du script de sauvegarde de l'application 'odoo'...
Création de l'archive de sauvegarde...
Succès ! Sauvegarde terminée
archive:
  hooks:
    conf_ssh: /usr/share/yunohost/hooks/backup/08-conf_ssh
    conf_ynh_firewall: /usr/share/yunohost/hooks/backup/20-conf_ynh_firewall
    data_mail: /usr/share/yunohost/hooks/backup/23-data_mail
    conf_cron: /usr/share/yunohost/hooks/backup/32-conf_cron
    conf_ynh_certs: /usr/share/yunohost/hooks/backup/21-conf_ynh_certs
    conf_ynh_mysql: /usr/share/yunohost/hooks/backup/11-conf_ynh_mysql
    conf_xmpp: /usr/share/yunohost/hooks/backup/26-conf_xmpp
    data_home: /usr/share/yunohost/hooks/backup/17-data_home
    conf_nginx: /usr/share/yunohost/hooks/backup/29-conf_nginx
    conf_ssowat: /usr/share/yunohost/hooks/backup/14-conf_ssowat
    conf_ldap: /usr/share/yunohost/hooks/backup/05-conf_ldap
  created_at: 1448540733
  apps:
    odoo:
      version: -
      name: Odoo
      description: Odoo est une collection d'apps de gestion d'entreprise (ERP : CRM, Comptabilité, Point de Vente, RH, Achats, ...).
  description:
  name: 20151126-132533
admin@yunohost:~#  sudo ls /home/yunohost.backup/archives/
20151126-132533.info.json  20151126-132533.tar.gz
```
By default, it backups in /home/yunohost.backup/archives/, but you can set your own directory with -o option. It could be an usb key or an other mounted filesystem.

If an app has no backup script it warns you. 

As you can see in the answer, there is 2 hooks which backup data (data_home and data_mail). By default, the mysql data aren't saved, because the apps should save themselves their databases.


**Note:** `yunohost backup` is not able currently to create diff backup. But you can use the -r option to avoid compression and use an other backup tool to make diff backup.

### Restore
To do a restore
```bash
admin@yunohost:~# sudo yunohost backup restore 20151126-132533
```
You can choose to apply only some parts of the backup, by selecting which restore hooks and which apps to restore.

## Packaging informations
You can see an example to make backup and restore scripts here
https://github.com/YunoHost/example_ynh/tree/testing
and
https://github.com/zamentur/strut_ynh/

There is some helpers to do shadow copy if you have big quantity of data to backup (owncloud, video apps, etc...).

**Note:** During a backup operation, the restore script associated is saved. So in a restore operation, yunohost use the saved restore script and not the most recent script. 

If you want modify a general conf file, you should use hooks to trigger a modification of the conf file after each call of `yunohost regenconf`.
You can also use the regeneration configuration system to do index your conf file, and allow your user to be warn if an upgrade of your app has change a config file.




## Annex
```bash
usage: yunohost backup create [-h] [-d DESCRIPTION] [-o OUTPUT_DIRECTORY]
                              [-n NAME] [--ignore-hooks]
                              [--hooks [HOOKS [HOOKS ...]]]
                              [--apps [APPS [APPS ...]]] [-r] [--ignore-apps]

optional arguments:
  -h, --help            show this help message and exit
  -d DESCRIPTION, --description DESCRIPTION
                        Short description of the backup
  -o OUTPUT_DIRECTORY, --output-directory OUTPUT_DIRECTORY
                        Output directory for the backup
  -n NAME, --name NAME  Name of the backup archive
  --ignore-hooks        Do not execute backup hooks
  --hooks [HOOKS [HOOKS ...]]
                        List of backup hooks names to execute
  --apps [APPS [APPS ...]]
                        List of application names to backup
  -r, --no-compress     Do not create an archive file
  --ignore-apps         Do not backup apps

usage: yunohost backup restore [-h] [--force] [--hooks [HOOKS [HOOKS ...]]]
                               [--ignore-hooks] [--apps [APPS [APPS ...]]]
                               [--ignore-apps]
                               name

positional arguments:
  name                  Name of the local backup archive

optional arguments:
  -h, --help            show this help message and exit
  --force               Force restauration on an already installed system
  --hooks [HOOKS [HOOKS ...]]
                        List of restauration hooks names to execute
  --ignore-hooks        Do not restore hooks
  --apps [APPS [APPS ...]]
                        List of application names to restore
  --ignore-apps         Do not restore apps


usage: yunohost backup [-h] {info,restore,create,list,delete} ...

optional arguments:
  -h, --help            show this help message and exit

actions:
  {info,restore,create,list,delete}
    info                Show info about a local backup archive
    restore             Restore from a local backup archive
    create              Create a backup local archive
    list                List available local backup archives
    delete              Delete a backup archive
root@staging1:/home/admin# sudo yunohost backup list --help
usage: yunohost backup list [-h] [-i] [-H]

optional arguments:
  -h, --help            show this help message and exit
  -i, --with-info       Show backup information for each archive
  -H, --human-readable  Print sizes in human readable format
```