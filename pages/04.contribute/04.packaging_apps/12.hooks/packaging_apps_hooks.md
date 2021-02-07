---
title: Hooks
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_hooks'
---

Hooks allow you to trigger a script when an action is performed by the system.  
The most obvious case is adding a user. If the app has a `post_user_create` hook, this hook will be triggered as soon as a user is added.  
Therefore, this allows an application to execute actions based on events occurring on the system.

### List of available hooks

- `post_domain_add`  
After adding a domain.
- `post_domain_remove`  
After deleting a domain.
- `post_user_create`  
After adding a user.
- `post_user_delete`  
After deleting a user.
- `post_iptable_rules`  
After reloading the firewall.
- `pre_backup_delete`  
Before deleting a backup.
- `post_backup_delete`  
After deleting a backup.
- `post_app_addaccess`  
After adding an authorized user to an application.
- `post_app_removeaccess`  
After the removal of a user's authorization on an application.
- `post_app_clearaccess`  
After erasing all the access rules on an application.
- `post_app_install`
After installing an application.
- `post_app_upgrade`
After upgrading an application.
- `post_app_remove`
After removing an application.
- `post_app_change_url`
After modifying the path and/or the domain name of an application.
- `post_cert_update`
After updating a certificate
- `conf_regen`  
Before and after the regeneration of a service configuration.  
Services supported by `regen-conf`:
 - avahi-daemon
 - dnsmasq
 - dovecot
 - fail2ban
 - glances
 - metronome
 - mysql
 - nginx
 - nslcd
 - nsswitch
 - postfix
 - rspamd
 - slapd
 - ssh
 - ssl

### Hooks setup

With the exception of the `conf_regen` hook, all hooks are used in the same way.  
First of all, you have to understand that a hook is a simple bash script that will be executed by YunoHost when the indicated event occurs.  
To add a hook to YunoHost, you must use a "hooks" folder at the root of the application package. Then, put your script in this folder under the name of the corresponding hook.

> For example:  
For the hook `post_user_create`, the script which will have to be executed for this hook should be placed in `hooks/post_user_create` in the app package.

During the installation and the upgrade of the application, the scripts in the hooks folder will be duplicated in the folder `/etc/yunohost/hooks.d/` in the folder corresponding to the hook, then under the name `50-$app`.  
All hooks belonging to an application will be removed when the apllication is deleted.

### Building a hook script

As a bash script, a hook script must start with the bash shebang.

```bash
#!/bin/bash
```

Then you have to take the arguments given by YunoHost when calling the script.  
Each hook offers different arguments.

##### `post_domain_add` and `post_domain_remove`

```bash
domain=$1
```

##### `post_user_create`

```bash
username=$1
mail=$2
password=$3 # Clear password
firstname=$4
lastname=$5
```
##### `post_user_delete`

```bash
username=$1
purge=$2  # True/False Indicates whether the user folder has been deleted or not.
```

##### `post_iptable_rules`

```bash
upnp=$1  # True/False Indicates if UPnP is activated or not.
ipv6=$2  # True/False Indicates whether IPV6 is enabled or not.
```

##### `pre_backup_delete` and `post_backup_delete`

```bash
backup_name=$1
```

##### `post_app_install`, `post_app_upgrade`, `post_app_remove` and `post_app_change_url`

Usable variables in these scripts are the same as those available in [associated actions scripts](/packaging_apps_scripts).

Example: for `post_app_install` the variables are the same as for the script `install`

##### `post_app_addaccess` and `post_app_removeaccess`

```bash
app_id=$1
users=$2  # All authorized users on the app. Separated by commas.
```

##### `post_app_clearaccess`

```bash
app_id=$1
```

##### `post_cert_update`
```bash
domain=$1
```

The rest of the script depends on what you want to do in it.

### `conf_regen` special case 
The `conf_regen` hook is a more delicate hook, either for its implementation or for its content.

##### `conf_regen` hook setup

A `conf_regen` hook should not be placed in the application's hooks folder. It must be set up manually.  
The hook should be copied, indicating to which service it is linked.
```bash
cp hook_regen_conf /usr/share/yunohost/hooks/conf_regen/50-SERVICE_$app
```

> When removing the application, this hook must be removed manually.

##### Building `conf_regen` hook script

`conf_regen` hook is called two times, a first time after analysis of the configuration and before any modification of the files, then a second time after applying the modifications, if there has been modifications.

`conf_regen` hook script should look like this:

```bash
#!/bin/bash

force=${2:-0}  # 0/1 --force argument
dryrun=${3:-0}  # 0/1 --dry-run argument
pending_conf=$4 # Path of the pending conf file

do_pre_regen() {
  # Put your code here for pre regen conf.
}

do_post_regen() {
  # Put your code here for post regen conf.
  # Be careful, this part will be executed only if the configuration has been modified.
}

case "$1" in
  pre)
    do_pre_regen
    ;;
  post)
    do_post_regen
    ;;
  *)
    echo "Hook called with unknown argument \`$1'" >&2
    exit 1
    ;;
esac

exit 0
```
