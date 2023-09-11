---
title: Seafile
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_seafile'
---

[![Installer Seafile with YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=seafile) [![Integration level](https://dash.yunohost.org/integration/seafile.svg)](https://dash.yunohost.org/appci/app/seafile)

*Seafile* is an open Source Cloud Storage application.

It's a Enterprise file sync and share platform with high reliability and performance. It's a file hosting platform with high reliability and performance. Put files on your own server. Sync and share files across different devices, or access all the files as a virtual disk.

### Screenshots

![Screenshot of Seafile](https://github.com/YunoHost-Apps/seafile_ynh/blob/master/doc/screenshots/access-logs.jpg)

### Disclaimers / important information

#### Multi-users support

This app support LDAP and the SSO authentification.

If you have Seafile installed before 7.x and you have more than one domain for users in Yunohost or Seafile app is installed on a different domain, you need to migrate your accounts.
You can use the provided action at https://domain.tld/yunohost/admin/#/apps/seafile/actions. You can also use this following command to migrate all of your accounts:
```
yunohost app action run seafile migrate_user_email_to_mail_email
```
See [issue#44](https://github.com/YunoHost-Apps/seafile_ynh/issues/44)
for more information.

#### Supported architectures

Since seafile 6.3 the i386 architecture is no more supported.

Seafile don't distribute binary for generic armhf architectures but rpi binary generally work on all arm board.

#### Additional informations

#### Links

 * Report a bug: https://github.com/YunoHost-Apps/seafile_ynh/issues
 * App website: https://www.seafile.com
 * YunoHost website: https://yunohost.org/

---

#### Install

From command line:

`yunohost app install seafile`

#### Upgrade

By default a backup is made before the upgrade. To avoid this you have theses following possibilites:
- Pass the `NO_BACKUP_UPGRADE` env variable with `1` at each upgrade. By example `NO_BACKUP_UPGRADE=1 yunohost app upgrade synapse`.
- Set the settings `disable_backup_before_upgrade` to `1`. You can set this with this command:
```
yunohost app setting synapse disable_backup_before_upgrade -v 1
```

After this settings will be applied for **all** next upgrade.

From command line:
```
yunohost app upgrade seafile
```

#### Backup

This app use now the core-only feature of the backup. To keep the integrity of the data and to have a better guarantee of the restoration is recommended to proceed like this:

- Stop seafile service with theses following command:
```
systemctl stop seafile.service seahub.service
```
- Launch the backup of seafile with this following command:
```
yunohost backup create --app seafile
```
- Do a backup of your data with your specific strategy (could be with rsync, borg backup or just cp). The data is stored in `/home/yunohost.app/seafile-data`.
- Restart the seafile service with theses command:
```
systemctl start seafile.service seahub.service
```

#### Remove

Due of the backup core only feature the data directory in `/home/yunohost.app/seafile-data` **is not removed**. It need to be removed manually to purge app user data.

#### Change URL

Since now it's possible to change domain or the url of seafile.

To do this run : `yunohost app change-url seafile -d new_domain.tld -p PATH new_path`

#### Developers infos

Please do your pull request to the [testing branch](https://github.com/YunoHost-Apps/seafile_ynh/tree/testing).

To try the testing branch, please proceed like that.
```
sudo yunohost app install https://github.com/YunoHost-Apps/seafile_ynh/tree/testing --debug
or
sudo yunohost app upgrade seafile -u https://github.com/YunoHost-Apps/seafile_ynh/tree/testing --debug
```

TODO

- Find a way to fix the issue https://github.com/YunoHost-Apps/seafile_ynh/issues/5

## Useful links

+ Website: [seafile.com](https://www.seafile.com/en/home/)
+ Demonstration: [Demo](https://demo.seafile.com/accounts/login/?next=/)
+ Application software repository: [github.com - YunoHost-Apps/seafile](https://github.com/YunoHost-Apps/seafile_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/seafile/issues](https://github.com/YunoHost-Apps/seafile_ynh/issues)
