User groups and permissions
===========================

You can access the group and permissions management interface from the webadmin
by going into the 'Users' section and clicking the corresponding button:

![](./images/button_to_go_to_permission_interface.png)

Managing groups
---------------

The group mechanism can be used to define group of users which then can be used to restrict permissions for applications and other services such as mail or xmpp. Note that it is *not* mandatory to create a group to do so : you can also restrict access to an app or service to just a specific list of user.

Using groups is however useful for semantic, for example if you host multiple group of friends, association or enterprise on your server, you might want to create groups like `association1` and `association2` and add members of each association to the relevant group.

### List existing groups

To list the currently existing groups :

```bash
$ yunohost user group list
groups:
  all_users:
    members:
      - alice
      - bob
      - charlie
      - delphine
```

By default, a special group called `all_users` exists and contain all users registered on YunoHost. This group can not be edited.

### Creating a new group

To create a new group called `yolo_crew`

```bash
$ yunohost user group create yolo_crew
```

Let's add Charlie and Delphine to this group:

```bash
$ yunohost user group update yolo_crew --add charlie delphine
```

(similarly, `--remove` can be used to remove members from a group)

Now in the group list we should see :

```bash
$ yunohost user group list
groups:
  all_users:
    members:
      - alice
      - bob
      - charlie
      - delphine
  yolo_crew:
    members:
      - charlie
      - delphine
```

### Deleting groups

To delete the group `yolo_crew`, you may run

```bash
$ yunohost user group delete yolo_crew
```

Managing permissions
--------------------

The permission mechanism allow to restrict access to services (for example mail, xmpp, ...) and apps, or even specific part of the apps (for example the administration interface of wordpress).

### List permissions

To list permissions and corresponding accesses:

```bash
$ yunohost user permission list
permissions:
  mail.main:
    allowed: all_users
  wordpress.admin:
    allowed:
  wordpress.main:
    allowed: all_users
  xmpp.main:
    allowed: all_users
```

Here, we find that all registered users can use mails, xmpp, and access the wordpress blog. However, nobody can access the wordpress admin interface.

More details can be displayed by adding the `--full` option which will display the list of users corresponding to groups allowed, as well as urls associated to a permission (relevant for web apps).

### Add accesses to group or users

To allow a group to access the wordpress admin interface:

```bash
$ yunohost user permission update wordpress.admin --add yolo_crew
```

Note that you can also allow a single user:

```bash
$ yunohost user permission update wordpress.admin --add alice
```

And now we may see that both the YoloCrew and Alice have access to the wordpress admin interface :

```bash
$ yunohost user permission list
  [...]
  wordpress.admin:
    allowed:
      - yolo_crew
      - alice
  [...]
```

Note that, for example, if we want to restrict permission for email so that only Bob is allowed to email, we should also remove `all_users` from the permission :

```bash
$ yunohost user permission update mail --remove all_users --add bob
```

Notes for apps packagers
------------------------

Installing an app creates the permission `app.main` with `all_users` allowed by default.

If you wish to make the application publicly available, instead of the old `unprotected_urls` mechanism, you should give access to the special groups `visitors`:

```bash
ynh_permission_update --permission "main" --add visitors
```

If you wish to create a custom permission for your app (e.g. to restrict access to an admin interface) you may use the following helpers:

```bash
ynh_permission_create --permission "admin" --url "/admin" --allowed "$admin_user"
```

You don't need to take care of removing permissions or backing up/restoring them as it is handled by the core of YunoHost.

### Migrating away from the legacy permission management

When migrating/fixing an app still using the legacy permission system, it should be understood that the accesses are now to be managed by features from the core, outside the application scripts!

Application scripts are only expected to:
- if relevant, during the install script, initialize the main permission of the app as public (`visitors`) or private (`all_users`) or only accessible to specific groups/users ;
- if relevant, create and initialize any other specific permission (e.g. to some admin interface) in the install script (and *maybe* in some migration happening in the upgrade script).

Applications scripts should absolutely **NOT** mess up with any already-existing app accesses (including `unprotected`/`skipped_uris` settings) during any other case, as *it would reset any admin-defined access rule*!

When migrating away from the legacy permission, you should:
- remove any management of `$is_public`-like or `$admin_user`-like setting, except for any manifest question meant to either *initialize* the app as public/private or specific permissions ;
- remove any management of `skipped_`, `unprotected_` and `protected_uris` (and `_regex`) settings that are now considered obsolete and deprecated. (N.B.: you should **explicitly delete them in the upgrade script**). Instead, you should now rely on the new `ynh_permission_*` helpers instead. If you do feel like you still need to use them, please contact the core team to provide your feedback and we'll figure out something ;
For example, in the upgrade script if you used the `protected_uris` key before, you may use this code in the `DOWNWARD COMPATIBILITY` section:

```bash
protected_uris=$(ynh_app_setting_get --app=$app --key=protected_uris)

# Unused with the permission system
if [ ! -z "$protected_uris" ]; then
	ynh_app_setting_delete --app=$app --key=protected_uris
fi
```

- remove any call to `yunohost app addaccess` and similar actions that are now obsolete and deprecated.
- if your app use LDAP and support filter, use the filter `'(&(objectClass=posixAccount)(permission=cn=YOUR_APP.main,ou=permission,dc=yunohost,dc=org))'` to allow users who have this permission. (A complete documentation of LDAP [here](https://moulinette.readthedocs.io/en/latest/ldap.html) if you want to undestand how it works with YunoHost)

Here an example of how to migrate the code from legacy to new permission system: [example](https://github.com/YunoHost/example_ynh/pull/111/files)

#### Specific case: regex protection

If you still need to use regex to protect or unprotect urls, you can't use the new permission system (for now).

But you can create a fake permission and use hooks to handle if there is a change in this faked permission.

In the install script, create the fake permission (with no url):

`ynh_permission_create --permission="create poll" --allowed "visitors" "all_users"`

Then use the legacy protection:

```bash
# Make app public if necessary
if [ $is_public -eq 1 ]
then
	if [ "$path_url" == "/" ]; then
	    # If the path is /, clear it to prevent any error with the regex.
	    path_url=""
	fi
	# Modify the domain to be used in a regex
	domain_regex=$(echo "$domain" | sed 's@-@.@g')
	ynh_app_setting_set --app=$app --key=unprotected_regex --value="$domain_regex$path_url/create_poll.php?.*$","$domain_regex$path_url/adminstuds.php?.*"
else
	ynh_permission_update --permission="create poll" --remove="visitors"
fi
```

In this example, if the app is public the group `visitors` has access to the permission `create poll`, the group is removed from this permission otherwise.

Then create two files in the directory `hooks` at the root of the git repository: `post_app_addaccess` and `post_app_removeaccess`. In these hooks, you'll remove or readd the regex protection if the `visitors` group is add or remove from this permission:

`post_app_addaccess`:

```bash
#!/bin/bash

# Source app helpers
source /usr/share/yunohost/helpers

app=$1
added_users=$2
permission=$3
added_groups=$4

if [ "$app" == __APP__ ]; then
    if [ "$permission" = "create poll" ]; then # The fake permission "create poll" is modifed.
        if [ "$added_groups" = "visitors" ]; then # As is it a fake permission we can only grant/remove the "visitors" group.
            domain=$(ynh_app_setting_get --app=$app --key=domain)
            path_url=$(ynh_app_setting_get --app=$app --key=path)

            if [ "$path_url" == "/" ]; then
                # If the path is /, clear it to prevent any error with the regex.
                path_url=""
            fi
            # Modify the domain to be used in a regex
            domain_regex=$(echo "$domain" | sed 's@-@.@g')
            ynh_app_setting_set --app=$app --key=unprotected_regex --value="$domain_regex$path_url/create_poll.php?.*$","$domain_regex$path_url/adminstuds.php?.*"

            # Sync the is_public variable according to the permission
            ynh_app_setting_set --app=$app --key=is_public --value=1

            yunohost app ssowatconf
        else
            ynh_print_warn --message="This app doesn't support this authorisation, you can only add or remove visitors group."
        fi
    fi
fi
```

`post_app_removeaccess`

```bash
#!/bin/bash

# Source app helpers
source /usr/share/yunohost/helpers

app=$1
removed_users=$2
permission=$3
removed_groups=$4

if [ "$app" == __APP__ ]; then
    if [ "$permission" = "create poll" ]; then # The fake permission "create poll" is modifed.
        if [ "$removed_groups" = "visitors" ]; then # As is it a fake permission we can only grant/remove the "visitors" group.
            
            # We remove the regex, no more protection is needed.
            ynh_app_setting_delete --app=$app --key=unprotected_regex

            # Sync the is_public variable according to the permission
            ynh_app_setting_set --app=$app --key=is_public --value=0

            yunohost app ssowatconf
        else
            ynh_print_warn --message="This app doesn't support this authorisation, you can only add or remove visitors group."
        fi
    fi
fi
```

Don't forget to replace `__APP__` during the install/upgrade script.

Here some apps that use this specific case: [Lutim](https://github.com/YunoHost-Apps/lutim_ynh/pull/44/files) and [Opensondage](https://github.com/YunoHost-Apps/opensondage_ynh/pull/59/files)

If you have any questions, please contact someone from the apps-group.
