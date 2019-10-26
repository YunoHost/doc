User groups and permissions
===========================

Warning : for now, these features are only available through the command line (c.f. `yunohost user group --help` and `yunohost user permission --help`)

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

By default, installing an app creates the permission `app.main` with `all_users` allowed by default.

If you wish to make the application publicly available, instead of the old `unprotected_urls` mechanism, you should give access to the special groups `visitors`:

```bash
ynh_permission_update --permission "main" --remove "all_users" --add "visitors"
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
- remove any call to `yunohost app addaccess` and similar actions that are now obsolete and deprecated.

