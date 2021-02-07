---
title: User groups and permissions
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_permissions'
---

Installing an app creates the permission `app.main` with `all_users` allowed by default.

If you wish to make the application publicly available, instead of the old `unprotected_urls` mechanism, you should give access to the special group `visitors`:

```shell
ynh_permission_update --permission "main" --add visitors
```

If you wish to create a custom permission for your app (e.g. to restrict access to an admin interface) you may use the following helpers:

```shell
ynh_permission_create --permission "admin" --url "/admin" --allowed "$admin_user" --label "Label for your permission"
```

You don't need to take care of removing permissions or backing up/restoring them as it is handled by the core of YunoHost.

### Migrating away from the legacy permission management

When migrating/fixing an app still using the legacy permission system, it should be understood that the accesses are now to be managed by features from the core, outside of the application scripts!

Application scripts are only expected to:
- if relevant, during the install script, initialize the main permission of the app as public (`visitors`) or private (`all_users`) or only accessible to specific groups/users ;
- if relevant, create and initialize any other specific permission (e.g. to some admin interface) in the install script (and *maybe* in some migration happening in the upgrade script).

Applications scripts should absolutely **NOT** mess up with any already-existing app accesses (including `unprotected`/`skipped_uris` settings) during any other case, as *it would reset any admin-defined access rule*!

When migrating away from the legacy permission, you should:
- remove any management of `$is_public`-like or `$admin_user`-like setting, except for any manifest question meant to either *initialize* the app as public/private or specific permissions ;
- remove the old legacy permissions. Check out the recommended way to proceed in the example_ynh app (in particular [this code snippet](https://github.com/YunoHost/example_ynh/pull/111/files#diff-57aeb84da86cb7420dfedd8e49bc644fb799d5413d01927a0417bde753e8922f))

It should boil down to : 
```bash
if ynh_legacy_permissions_exists; then
	ynh_legacy_permissions_delete_all

	ynh_app_setting_delete --app=$app --key=is_public

	# Create the permission using the new framework (if your app has relevant additional permissions)
	ynh_permission_create --permission="admin" --url="/admin" --allowed=$admin
fi
```

- remove any call to `yunohost app addaccess` and similar actions that are now obsolete and deprecated.
- if your app use LDAP and support filter, use the filter `'(&(objectClass=posixAccount)(permission=cn=YOUR_APP.main,ou=permission,dc=yunohost,dc=org))'` to allow users who have this permission. (A complete documentation of LDAP [here](https://moulinette.readthedocs.io/en/latest/ldap.html) if you want to undestand how it works with YunoHost)

#### Additional features from 4.1

- Label customization : this is the name displayed to end users in the user portal. You can provide a default label (for example app.admin maybe be labelled 'Admin interface'). The label may be changed later by the admin after installation.
- Enabling/disabling tile : this toggles wether or not an app is shown in the user portal (if the user has the corresponding permission). The corresponding option is called `show_tile` which may be `True` or `False`. A single app may have multiple tiles in the SSO. The url of each tile corresponds to the `url` parameter of the permission.
- Multiple url support: a permission may have additional urls associated to it. This give the possiblity to protect many url with the same permission - in particular for tricky use case (for example several pieces of admin interfaces spread over different subpaths).
- Protecting permission: As a packager, you may choose to "protect" a permission if you believe that it's not relevant for the admin to add/remove this permission to/from the visitors group. For example, this is the case for the API permission of Nextcloud, which in the vast majority of cases should be kept publicly because mobile client won't go through the SSO. Note that when using the helper `ynh_permission_update`, it's still possible to add/remove the `visitor` group of this permission.
- Disabling auth header: some app authentification mecanism do not appreciate that SSOwat injects the Authorization header (which is an essential mecanism for single sign-on). You can now choose to disable the auth header injection from SSOwat to fix this (instead of the previous hack of using `skipped_uris`)

##### Correspondance between the old and new permission mecanism

|             | with auth header | no auth header |
| :---------- | :--------------- | :------------- |
| **public**  | unprotected_uris | skipped_uris   |
| **private** | protected_uris   | N/A            |


|             | with auth header                            | no auth header                               |
| :---------- | :------------------------------------------ | :------------------------------------------- |
| **public**  | auth_header=True, visitor group allowed     | auth_header=False, visitor group allowed     |
| **private** | auth_header=True, visitor group not allowed | auth_header=False, visitor group not allowed |


All of theses feature are managable by theses following helper:
- `ynh_permission_create`
- `ynh_permission_url`
- `ynh_permission_update`

If you have any question, please contact the app team
