---
title: Writing app scripts
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_scripts'
---


App scripts are the essential logic defining what happens when an app is `install`ed, `remove`d, `upgrade`d, `backup`ed, or `restore`d. They are written in [Bash](https://en.wikipedia.org/wiki/Bash_(Unix_shell)) which is the same stuff you type in interactive mode in a terminal, though we added a bunch of custom YunoHost functions that we call `helpers` to standardize many common operations - for example adding the nginx configuration.

Note that starting from packaging v2, the logic or what happens when an app is installed, etc. is also contained partially in the resource configuration in the `manifest.toml`.

In the `scripts` folder of an app, you can expect to find:

```text
manifest.toml
scripts/
   - _common.sh   # Some "common" definition, typically custom helpers or global variables used accross all scripts
   - install      # The install procedure
   - remove       # The remove procedure
   - upgrade      # The upgrade procedure
   - backup       # The backup procedure - in fact it only "declares" what should be backup / no actual real backup happens at this point except dumping SQL databases
   - restore      # The restore procedure
   - change_url   # Some apps do also provide a change url script, which corresponds to changing the URL endpoint of the app, which may be as simple as changing the nginx conf, or may involve significant changes in the app DB
```

Here is an example of the simple install script for the `helloworld` app:

```bash
#!/bin/bash

# This is where we load the official YunoHost helpers
source /usr/share/yunohost/helpers

#=================================================
# DOWNLOAD, CHECK AND UNPACK SOURCE
# This is where we would usually fetch the .tar.gz archive 
# from the upstream and extract it into our local install dir
#=================================================
# At the beginning of each major operation, we call this helper
# that creates a progress bar
ynh_script_progression --message="Setting up source files..." --weight=1

echo "Hello world!" > $install_dir/index.html
chown -R www-data: "$install_dir"

#=================================================
# NGINX CONFIGURATION
# This is where the nginx conf snippet for the app is created using the
# configuration template provided in conf/nginx.conf
# and added to /etc/nginx/conf.d/$domain.d/$app.conf
#=================================================
ynh_script_progression --message="Configuring nginx web server..." --weight=1

ynh_add_nginx_config
```

Note that the scripts are run with the `set -eu` options (except for the remove script), which means that any failing command or use of non-existing variable will trigger an error and stop the script execution.

## Variables available in a script context

Special variables are automatically defined in the context of a script:

- `$app` is the app ID. It will typically be the ID from the app's manifest.toml, for example `helloworld`, but will be `helloworld__2`, `__3` etc for multi-instance installs.
- During install, answers to install questions are automatically available as bash variables. Typically, `$domain` and `$path` will contain the answers to the default install questions assuming they are defined in the `manifest.toml`. Answer values associated to any custom install questions will be available the same way, e.g. `$prefered_pet` for the custom question `[install.prefered_pet]` that would be defined in the manifest. Note that - apart from special questions such as `init_main_permission` or user-provided passwords - they are also automatically saved as settings (cf. next section).
- During other scripts, all app settings are also loaded and automatically available.
- Note that some settings are automatically created/updated by app ressources. For example, the `install_dir` setting will automatically be available too and corresponds to typically `/var/www/$app`
- In the `change_url` context, variables called `new_domain`, `new_path`, `old_domain`, `old_path` will be available, as well as `change_domain` and `change_path` equal to `0` (false) or `1` (true) depending if the domain / path changed

## Setting system

Application often need to store long term information in between scripts triggered by the admin. For this, YunoHost has a key-value store for each application called "setting" and is stored in `/etc/yunohost/apps/$app/settings.yml`.

Apps can interact with this key value store in this way:

```bash
# Retrieve a setting into variable "db_name"
db_name=$(ynh_app_setting_get --app=$app --key=db_name)

# Update a setting
ynh_app_setting_set --app=$app --key=db_name --value=$db_name
```

## Helper system

We call helpers a set of custom bash function created by the YunoHost project to standardize common operations accross all apps. They are all prefixed with `ynh_`. The full list and documentation of these helpers is available on [this page](/packaging_apps_helpers). Some of these helpers are now partially obsolete as they are now handled by the core via app resources.

Here is the list of the major ones:

- `ynh_app_setting_get` / `ynh_app_setting_set`
- `ynh_script_progression`
- `ynh_setup_source`
- nginx: `ynh_add_nginx_config` / `ynh_remove_nginx_config`
- php: `ynh_add_fpm_config` / `ynh_remove_fpm_config`
- systemd: `ynh_add_systemd_config` / `ynh_remove_systemd_config`
- fail2ban: `ynh_add_fail2ban_config` / `ynh_remove_fail2ban_config`
- custom: `ynh_add_config`
- nodejs: `ynh_install_nodejs` / `ynh_use_nodejs`
- `ynh_exec_warn_less`
- `ynh_local_curl`
- `ynh_secure_remove`
- `ynh_backup` / `ynh_restore_file`

## Configuration/template system

App scripts will often need to create a bunch of configuration files.

Configuration templates are canonically stored provided in the `conf/` folder of the app, such as `nginx.conf`, `extra_php-fpm.conf`, `systemd.conf`, or `some-custom-app-conf.env` ...

In these templates, you can use the syntax `__FOOBAR__` which will automatically be replaced by the variable `$foobar` during runtime, when the conf is installed via the `ynh_add_*_config` helpers.

For example, an app's NGINX conf snippet may look like:

```text
# The next line starting with '#sub_path_only' is automatically uncommented only when $path is not /
#sub_path_only rewrite ^__PATH__$ __PATH__/ permanent;
location __PATH__/ {

  alias __INSTALL_DIR__/;

  # Some headers and tweaks

}
```

## App sources

App sources were historically defined in `conf/app.src` files containing the URL + checksum of assets to download.

This is now integrated in `manifest.toml` using the `sources` resource, which pre-download the assets prior to entering the install or upgrade scripts. The sources can then be effectively deployed using `ynh_setup_source`.

For example, for YesWiki, the sources are defined in `manifest.toml` using:

```toml
[resources.sources.main]
url = "https://github.com/YesWiki/yeswiki/archive/refs/tags/v4.4.0.tar.gz"
sha256 = "5ceb12d225c20de2ba3cb4ce483348ed1a8ad5b1789d4f4f8f89dc4871524007"
```

More infos on the `source` resource in [the resource system documentation](/packaging_apps_resources).

## Common operations (TODO/FIXME)

### installing/upgrading app sources

### adding configurations

### adding a systemd service

### curl / automatizing install forms

### classic stuff for nodejs apps

### classic stuff for php apps

### classic stuff for python apps

### classic stuff for ??? apps
