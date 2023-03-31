---
title: Packaging v2
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_v2'
---


Packaging v2 is a major improvement for the packaging introduced in YunoHost 11.1

### Motivation 

The motivations for this new format is:
- to get rid of some boring or unecessarily complex or duplicateds stuff such as saving/loading settings, creating a system user, etc.. during the install/upgrade/restore script, which are common things accross many apps.
- to get rid of funky historical, not-super-semantic stuff such as `__FINALPATH__` being replaced by `$final_path` (with underscore), or `__PATH__` being replaced by `$path_url`, etc.
- formalize some aspects such as the existence of the install dir, data dir, apt dependencies, database, etc. which in turn unlock possible future developments such as computing the space used by an app at one given moment, auto-upgrading apt dependencies during Debian major migration, etc.
- formalize some meta-info such as LDAP/SSO support, architectures supports, and other pre-install / post-install, pre-upgrade / post-upgrade notifications (replacing the infamous `ynh_send_readme_to_admin`) for better UI/UX during the install and upgrade process.

However, this "v2" is not the end of the story and should be seen as an intermediate stage before a "v3" packaging. In particular this "v3" packaging should also formalize the handling of the system and app configurations files and ultimately rework the entire paradigm of the install/remove/upgrade/backup/restore scripts.


### Adapting a v1 app to v2

A script is available in https://github.com/YunoHost/apps/tree/master/tools/packaging_v2 and will attempt to convert what it can from the v1 format to the v2 format, in particular:
- initializing a `manifest.toml` and prefilling it with info scrapped from the various scripts
- comment out now-unecessary lines in the various scripts

Usage: `python3 convert_app_to_packaging_v2.py /path/yo/your/app`

This will edit the file in place and you should then carefully review and iterate over what the script did for you.

### Highlights of the new format

The [example repo](https://github.com/YunoHost/example_ynh) illustrates the below.

- **The manifest is now written as toml (`manifest.toml`)** instead of json (`manifest.json`). The structure of the manifest itself has been reworked and now include:
   - The `upstream` section (now mandatory)
   - An `integration` section meant to formalize what minimum YunoHost version is required, the list of supported architectures, declare if SSO/LDAP is supported, typical resource usage. This is meant to be displayed both in the catalog (similar to app stores) and on the app info page after installing the app - though this is still work in progress. 
   - A `resource` section (detailed below)
- **Install questions are now automatically saved as settings** (except user-provided password and other specific infos)
- **All settings are now automatically loaded in app script environments** (so e.g. directly define `$domain`, etc.)
- **Auto-enable `set -eu`** a.k.a. `ynh_abort_if_errors` in appropriate scripts
- **The safety-backup-before-upgrade is now automatically handled by the core**
- **Simplify writing change-url scripts**: old the `new`/`old`/`change` `domain`/`path` are now automatically available in the context and a new helper `ynh_change_url_nginx_config` takes care of tweaking the nginx conf. Your script should essentially just call that helper and possibly tweak the app's conf and possibly restart the app's service
- **Introduce a new `resource` mechanism**
    - Resources are declared in the `manifest.toml`. 
    - They are meant to formalize recurring app needs that are to be provisioned/deprovisioned by the core. 
    - They include for example: system user, apt dependencies, install dir, data dir, port, permissions, SQL database... 
    - Each resource is to be provisioned *before* running the install script, deprovisioned *after* the remove script, and automatically upgraded if needed before running the upgrade script (or provisionned if introduced in the new app version, or deprovisioned if removed w.r.t. the previous app version)
    - More infos about resources and their options and behavior are available in the dedicated doc page
- **Permissions are automatically initialized using the answer to the `init_main_permission` install question** (replacing the `is_public` question). No need to write a boring `if $is_public ...` in the install script to add visitors anymore ! There is a similar mechanism to init other permissions, eg `init_admin_permission` (cf also the doc about the `permission` resource)
- **The content of the `doc/` folder is now meant to be integrated in the webadmin** (though this is still WIP as of writing this). In particular:
    - `DESCRIPTION.md` and the `screenshots/` folder are expected to be displayed prior to the app install form (similar to app stores on mobile)
    - `ADMIN.md` is expected to be made available somewhere in the info page and should contain technical admin notes. Other pages can be defined (just name it `WHATEVER.md`). Lang codes are also supported following the existing scheme for the README, eg `README_fr.md` is the French version, hence you can create `ADMIN_fr.md`, etc.
    - Note that the `ADMIN.md` page supports the `__FOOBAR__` notation that will be automatically replaced with the app's `foobar` setting
- **Special files called 'notifications' are meant to replace the `ynh_send_readme_to_admin` mechanics**. They are also to be added to the `doc` folder: 
    - `doc/PRE_INSTALL.md`: a note to be displayed prior to the app install. Typically to warn of something unusual, such as "the app install will automatically add 1GB swap to the system".
    - `doc/POST_INSTALL.md`: a note to be displayed after the app install. Typically to explain post-install operations to be performed manually by the admin and that cannot be automated.
    - `doc/PRE_UPGRADE.md`: a note to be displayed prior to any upgrade of this app.
    - `doc/PRE_UPGRADE.d/{version}.md`: a note to be displayed prior to a specific version upgrade.
    - `doc/POST_UPGRADE.md`: a note to be displayed after the app upgrade. For example in the context of Nextcloud, the fact that you may need to re-enable custom modules manually?
    - Note that the notifications, like `ADMIN.md`, supports the `__FOOBAR__` notation that will be automatically replaced with the app's `foobar` setting
 - **Replace some historical names with more sensible ones**, or homogenize some practices:
    - `final_path` is now `install_dir` (this migration should be automatically handled by the core and the `convert_app_to_packaging_v2.py` script)
    - `datadir` is now `data_dir` to be consistent with `install_dir` (this migration should be automatically handled by the core and the `convert_app_to_packaging_v2.py` script)
    - `path` is now always loaded as `$path`, no funky `$path_url`-but-it-is-saved-as-`path` anymore (this migration should be automatically handled by the core and the `convert_app_to_packaging_v2.py` script)
    - `mysqldbpwd` and `psqlpwd` or whatever are now always saved as `db_pwd` (cf the `database` resource) (this migration should be automatically handled by the core and the `convert_app_to_packaging_v2.py` script)
    - ports settings are now always named either `$port` or `$port_foo_bar` instead of `$foo_bar_port` (cf the `port` resource) (this migration should be automatically handled by the core and the `convert_app_to_packaging_v2.py` script)
    - the install dir is to be set to `/var/www/$app` by default for web apps (or can be changed to `/opt/????` for non-webapps). Note that YunoHost will **automatically move** the old install dir to the new `install_dir` during the corresponding upgrade.
