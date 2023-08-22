---
title: Hooks
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_hooks'
---

YunoHost includes a hook mechanism triggered on a lot of operation changing the system. You can use this mechanism in order to extend the behaviour of a YunoHost command.

The most obvious case is adding a user. If you had a `post_user_create` hook, this hook will be triggered as soon as a user is added.

## How to add a custom hook on a specific instance
!!! Below we imagine we want to run a command after each user creation to add the user to samba user.

You should create a directory with the name of the hooks into `/etc/yunohost/hooks.d/`:
```
mkdir -p /etc/yunohost/hooks.d/post_user_create
```


Next create a bash script inside this directory prefixed by 2 numbers and a dash:
```bash
nano /etc/yunohost/hooks.d/post_user_create/05-add-user-to-samba
```

By default, the directory must be readable and traversable by root, but if you notice your hook is not run at all by YunoHost, you can check permissions with `ls -l /etc/yunohost/hooks.d/` and apply these commands if needed:
```
chown root:root /etc/yunohost/hooks.d/post_user_create
chmod u+rx /etc/yunohost/hooks.d/post_user_create
```

## How to add a hook in an app package
If you are packaging an app, you should not set by yourself the hook into `/etc/yunohost/hooks.d` instead you should create a hooks dir at the root of your package.
```
.
├── conf
├── hooks
├── scripts
```

In the hooks dir, create a bash script called with the type of hook you want to create for example `post_create_user`.

## Hooks referencies
### User and permissions
#### post_user_create
[details summary="<i>Triggered after user creation</i>" class="helper-card-subtitle text-muted"]

This hook is run at the end of the command `yunohost user create` or equivalent action in webadmin.

##### Environment variables

 - YNH_USER_USERNAME: The username of the created user
 - YNH_USER_MAIL: The mail of the created user
 - YNH_USER_PASSWORD: The **clear** password of the created user
 - YNH_USER_FIRSTNAME: The firstname of the created user ([should be removed in future](https://github.com/YunoHost/issues/issues/296))
 - YNH_USER_LASTNAME: The lastname of the created user ([should be removed in future](https://github.com/YunoHost/issues/issues/296))

##### Positionnal arguments (deprecated)

 - $1: The username of the created user
 - $2: The mail of the created user

##### No waited return

##### Examples

###### Send automatically a mail to new user
```bash
#!/bin/bash
domain=$(cat /etc/hostname)

message="Hello $YNH_USER_FIRSTNAME,
Welcome on $domain ! 
Feel free to <a href='https://$domain/yunohost/sso/edit.html'>change your password</a>.
Let me know if you have a problem,
The admin of $domain
"

echo $message | mail -s "Welcome on $domain !" $YNH_USER_MAIL
```
[/details]



#### post_user_delete
[details summary="<i>Triggered at the end of user deletion</i>" class="helper-card-subtitle text-muted"]

This hook is run at the end of the command `yunohost user delete` or equivalent action in webadmin.

##### No environment variables

##### Positionnal arguments

 - $1: The username of the user deleted
 - $2: True if --purge option is used

##### No waited return

##### Examples

###### 
```bash
#!/bin/bash
```
[/details]



### post_user_update
[details summary="<i>Triggered at the end of the user update</i>" class="helper-card-subtitle text-muted"]

This hook is run at the end of the command `yunohost user update` or equivalent action in webadmin.

##### Environment variables

! Only arguments given to the cli/api are given as environment variable.
 - YNH_USER_USERNAME: The username of the updated user
 - YNH_USER_FIRSTNAME: The firstname of the updated user ([should be removed in future](https://github.com/YunoHost/issues/issues/296))
 - YNH_USER_LASTNAME: The lastname of the updated user ([should be removed in future](https://github.com/YunoHost/issues/issues/296))
 - YNH_USER_PASSWORD: The new password of the updated user
 - YNH_USER_MAILS: The mail and mail aliases of the updated user seperated by comma
 - YNH_USER_MAILFORWARDS: The list of forward mails of the updated user separated by comma 
 - YNH_USER_MAILQUOTA: The quota of the updated user (could be 0 or a number following by one of this unit: b, k, M, G or T)

##### No positionnal arguments

##### No waited return

##### Examples

###### Send a mail on password changing
```bash
#!/bin/bash
"
domain=$(cat /etc/hostname)

message="Hello,
Your password has been successfully changed on $domain.
If you have not asked for changing your password, you probably should contact the admin of $domain.
"

echo $message | mail -s "Your password has been changed on $domain !" $YNH_USER_USERNAME
```
[/details]



### post_app_addaccess
[details summary="<i>Triggered after adding a permission to users or groups </i>" class="helper-card-subtitle text-muted"]

This hook is run at the end of the command `yunohost user permission add` or equivalent action in webadmin.

##### No environment variables

##### Positionnal arguments (deprecated)

 - $1: The app name
 - $2: The list of users added separated by comma
 - $3: The name of the sub permission (`main`, `admin`, etc.)
 - $4: The list of groups added separated by comma

##### No waited return

##### Examples
[/details]



### post_app_removeaccess
[details summary="<i>Triggered after removing a pemission to users or groups</i>" class="helper-card-subtitle text-muted"]

This hook is run at the end of the command `yunohost user permission remove` or equivalent action in webadmin.

##### No environment variables

##### Positionnal arguments (deprecated)

 - $1: The app name
 - $2: The list of users removed from the permission separated by comma
 - $3: The name of the sub permission (`main`, `admin`, etc.)
 - $4: The list of groups removed from the permission separated by comma

##### No waited return

##### Examples
[/details]







## Domain, certificates and DNS
### post_domain_add
[details summary="<i>Triggered at the end of the domain add operation</i>" class="helper-card-subtitle text-muted"]

This hook is run at the end of the command `yunohost domain add` or equivalent action in webadmin.

##### No environment variable

##### Positionnal arguments (deprecated)

 - $1: The domain added 

##### No waited return

##### Examples

###### 
```bash

```
[/details]




### post_domain_remove
[details summary="<i>Triggered after removing the domain</i>" class="helper-card-subtitle text-muted"]

This hook is run at the end of the command `yunohost domain remove` or equivalent action in webadmin.

##### No environment variable

##### Positionnal arguments (deprecated)

 - $1: The domain removed

##### No waited return

##### Examples
[/details]




### post_cert_update
[details summary="<i>Triggered after Let's encrypt certificate update</i>" class="helper-card-subtitle text-muted"]

This hook is run at the end of the command `yunohost domain cert update` or equivalent action in webadmin.

##### No environment variable

##### Positionnal arguments

 - $1: The domain for which we have updated the certificate

##### No waited return

##### Examples

###### Restart a service after cert renewal
```bash
#!/bin/bash
systemctl restart gemserv
```
[/details]




### custom_dns_rules
[details summary="<i>Customized your DNS rules for your domains</i>" class="helper-card-subtitle text-muted"]

This hook is run at the end of the command `yunohost domain dns suggest` or equivalent action in webadmin.

Thanks to This hook you can customize 

##### No environment variable

##### Positionnal arguments

 - $1: The base domain for which we want to build a DNS suggestion

##### Waited return
The script should return a JSON array with dictionnary in this format:
```json
[
    {
        'type': 'SRV',
        'name': 'stuff.foo.bar',
        'value': 'yoloswag',
        'ttl': 3600
    }
]
```


##### Examples

###### Validate Let's Encrypt DNS challenge with a YunoHost DynDNS domain
```bash
#!/bin/bash
if [[ "$1" == "XXXX.nohost.me" ]] ; then
    echo "[
        {
            'type': 'TXT',
            'name': '_acme-challenge',
            'value': 'LETSENCRYPT_VALUE',
            'ttl': 3600
        }
    ]"
fi

```
[/details]





## Apps
### post_app_change_url
[details summary="<i>Triggered after an app has changed of URL</i>" class="helper-card-subtitle text-muted"]

This hook is run at the end of the command `yunohost app change-url` or equivalent action in webadmin.

##### Environment variables

 - YNH_APP_OLD_DOMAIN: The old domain of the app
 - YNH_APP_OLD_PATH: The old path of the app
 - YNH_APP_NEW_DOMAIN: The new domain of the app
 - YNH_APP_NEW_PATH: The new path of the app

##### No positionnal arguments

##### No waited return

##### Examples
[/details]

### post_app_upgrade
[details summary="<i>Triggered on app upgrade</i>" class="helper-card-subtitle text-muted"]

This hook is run at the end of the command `yunohost app upgrade` or equivalent action in webadmin.

##### Environment variables

 - YNH_APP_ID: The app id (for example nextcloud)
 - YNH_APP_INSTANCE_NAME: The app instance name (for example nextcloud__2)
 - YNH_APP_INSTANCE_NUMBER: The app instance number (for example 2)
 - YNH_APP_MANIFEST_VERSION: The app manifest version (for example 1 or ?)
 - YNH_ARCH: The arch as returned by `dpkg --print-architecture`
 - YNH_APP_UPGRADE_TYPE: The type of upgrade (UPGRADE_PACKAGE, UPGRADE_APP, UPGRADE_FULL)
 - YNH_APP_MANIFEST_VERSION: The version number 
 - YNH_APP_CURRENT_VERSION: The version number of the app (in the yunohost format)
 - NO_BACKUP_UPGRADE: 1 if we don't want to backup else 0

##### No positionnal arguments

##### No waited return

##### Examples

###### Change a settings in an app config file (unmanaged by config panel)
```bash
#!/bin/bash

source /usr/share/yunohost/helpers
app=$YNH_APP_INSTANCE_NAME

if [[ "$app" == "etherpad_mypads" ]]; then
  ynh_write_var_in_file --file=/var/www/etherpad_mypads/settings.json --key=max --value=100 --after=importExportRateLimiting
  systemctl restart etherpad_mypads
fi

```
[/details]

### post_app_install
[details summary="<i>Triggered at the end of an app installation</i>" class="helper-card-subtitle text-muted"]

This hook is run at the end of the command `yunohost app install` or equivalent action in webadmin.

##### Environment variables

 - YNH_APP_ID: The app id (for example nextcloud)
 - YNH_APP_INSTANCE_NAME: The app instance name (for example nextcloud__2)
 - YNH_APP_INSTANCE_NUMBER: The app instance number (for example 2)
 - YNH_APP_MANIFEST_VERSION: The app manifest version (for example 1 or ?)
 - YNH_ARCH: The arch as returned by `dpkg --print-architecture`
 - YNH_APP_ARG_XXXXXXX: The argument of the manifest

##### No positionnal arguments

##### No waited return

##### Examples
[/details]


### post_app_remove
[details summary="<i>Triggered after removing an app</i>" class="helper-card-subtitle text-muted"]

This hook is run at the end of the command `yunohost app remove` or equivalent action in webadmin.

##### Environment variables

 - YNH_APP_ID: The app id (for example nextcloud)
 - YNH_APP_INSTANCE_NAME: The app instance name (for example nextcloud__2)
 - YNH_APP_INSTANCE_NUMBER: The app instance number (for example 2)
 - YNH_APP_MANIFEST_VERSION: The app manifest version (for example 1 or ?)
 - YNH_ARCH: The arch as returned by `dpkg --print-architecture`
 - YNH_APP_PURGE: 1 if the --purge option has been activated

##### No positionnal arguments

##### No waited return

##### Examples
[/details]

## Backup / Restore
### backup
[details summary="<i>Add some files to backup</i>" class="helper-card-subtitle text-muted"]

This hook is run at the end of the command `yunohost backup create` or equivalent action in webadmin.

##### Environment variables

 - YNH_BACKUP_DIR: The work dir in which we can store temporary data to backup like database dump
 - YNH_BACKUP_CSV: The CSV in which we add the things to backup. Don't use this directly and use ynh_backup helper instead.
 - YNH_APP_BACKUP_DIR: To document

##### Positionnal arguments
 - $1: The work dir in which we can store temporary data to backup like database dump

##### No waited return

##### Examples

###### Backup some files in more (for example your custom hooks)
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

# MISC
ynh_backup_dest "conf/custom/misc"
ynh_backup "/etc/sysctl.d/noipv6.conf"
ynh_backup "/usr/local/bin/"

ynh_backup "/etc/yunohost/hooks.d/backup/99-conf_custom"
ynh_backup "/etc/yunohost/hooks.d/restore/99-conf_custom"

```
[/details]

### restore
[details summary="<i>Restore some files</i>" class="helper-card-subtitle text-muted"]

This hook is run at the end of the command `yunohost backup restore` or equivalent action in webadmin.

##### Environment variables

 - YNH_BACKUP_DIR: The work dir in which we can store temporary data to backup like database dump
 - YNH_BACKUP_CSV: The CSV in which we add the things to backup. Don't use this directly and use ynh_backup helper instead.

##### Positionnal arguments
 - $1: The work dir in which we can store temporary data to backup like database dump

##### No waited return

##### Examples

###### restore custom files
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

# MISC
ynh_restore_dest "conf/custom/misc"
ynh_restore_file "/etc/sysctl.d/noipv6.conf"
ynh_restore_file "/usr/local/bin/"

ynh_restore_file "/etc/yunohost/hooks.d/backup/99-conf_custom"
ynh_restore_file "/etc/yunohost/hooks.d/restore/99-conf_custom"


```

[/details]

### backup_method
[details summary="<i>Define a new way to backup and restore files</i>" class="helper-card-subtitle text-muted"]

This hook is run during the command `yunohost backup create` or equivalent action in webadmin.

This hook is called several times with different action keywords.

##### No environment variables

##### Positionnal arguments
 

 - $1: The action ("need_mount", "backup", "mount")
 - $2: The work dir
 - $3: The name of the backup
 - $4: The repository in which the backup should be done
 - $5: An estimation size of the files to backup
 - $6: A description of the archive


##### No waited return

##### Examples

###### A very simple backup on rotationnal disks
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
[/details]

## Configuration and firewall
### post_iptable_rules
[details summary="<i>Triggered after reloaded the firewall rules</i>" class="helper-card-subtitle text-muted"]

This hook is run at the end of the command `yunohost firewall reload` or equivalent action in webadmin.

##### No environment variables


##### Positionnal arguments

 - $1: True if upnp has succeeded 
 - $2: True if ipv6 is available

##### No waited return

##### Examples

###### Forbid completely the outgoing 25 port except for postfix user
```bash
#!/bin/bash
iptables -A OUTPUT -p tcp --dport 25 -m owner --uid-owner postfix -j ACCEPT
iptables -A OUTPUT -p tcp --dport 25 -m tcp -j REJECT --reject-with icmp-port-unreachable
```
[/details]

### conf_regen
[details summary="<i>Change configuration suggested as default config in regen-conf mechanism</i>" class="helper-card-subtitle text-muted"]

This hook is run during the command `yunohost tools regen-conf` or equivalent action in webadmin.

This hook is called several times with different actions keywords (pre and post operations).

##### Environment variables

 - YNH_DOMAINS: The list of domains managed by YunoHost separated by comma
 - YNH_MAIN_DOMAINS: The list of main domains separated by comma

##### Positionnal arguments

 - $1: The pre or post action
 - $2: Empty string due to legacy
 - $3: Empty string due to legacy
 - $4: In post mode the list of file which should be modified. In pre mode the dir in which we store pending configuration

##### No waited return

##### Examples

###### Fix the warning about postfix compatibility mode in postfix logs
```bash
#!/bin/bash

action=$1
pending_dir=$4
postfix_conf=$pending_dir/../postfix/etc/postfix/main.cf

[[ "$action" == "pre" ]] || exit 0
[[ -e $postfix_conf ]] || exit 0
echo '
compatibility_level = 2' >> $postfix_conf
```
[/details]

