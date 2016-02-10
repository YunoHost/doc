<a class="btn btn-lg btn-default" href="packaging_apps_en">Application packaging</a>

## Arguments management
#### Retrieve arguments in the install script from manifest
Arguments are given to the install script from the manifest in it's order. For instance, for Roundcube, `domain` and `path` arguments will respectively be retreived from `$1` and `$2` parameters in the install script.

```bash
# Retrieve arguments
domain=$1
path=$2
```

#### Save arguments for other scripts
Remove, upgrade, backup and restore scripts could need arguments.

YunoHost could save arguments with this command which is generally used in the install script:
```bash
# Store config on YunoHost instance
sudo yunohost app setting $app domain -v $domain
```

Then, the script can retrieve saved arguments with this command:
```bash
domain=$(sudo yunohost app setting $app domain)
```

Those data are saved in `/etc/yunohost/apps/<app_name>/settings.yml`.
