<a class="btn btn-lg btn-default" href="packaging_apps_en">Application packaging</a>

## Shell helpers

Since YunoHost 2.4 release, **new shell helpers** are available to ease common packaging tasks like password generation, MySQL database creation…

Usage examples are available in the [example application](https://github.com/YunoHost/example_ynh/blob/master/scripts/install). We advise to use them.

You can find them on this [repository](https://github.com/YunoHost/yunohost/blob/unstable/data/helpers.d).

To use them, you need to add following lines in the shell scripts:
```bash
# Source app helpers
source /usr/share/yunohost/helpers
```

### Available helpers list (non exhaustive)
#### Database

```bash
ynh_mysql_execute_as_root SQL DB
```

> Runs the SQL command `SQL` as database root user on `DB` database (this last argument is optional).

```bash
ynh_mysql_execute_file_as_root FILE DB
```

> Runs the SQL commands listed inside `FILE` as root user on `DB` database (this last argument is optional).

```bash
ynh_mysql_create_db DB USER PWD
```
> Create the `DB` database and grants all rights to `USER` (created on the fly with `PASSWORD` password).

```bash
ynh_mysql_drop_db DB
```
> Delete the `DB` database.

```bash
ynh_mysql_dump_db DB > ./FILE
```

> Exports the `DB` database into the `FILE` file.

#### Debian packages handling

```bash
ynh_package_is_installed PACKAGE
```

> Tests if the Debian package `PACKAGE` is installed on the system.
    > Read command output to know the result. e.g:
> ```bash
> if ! ynh_package_is_installed "yunohost" ; then
>   echo "Oops, package is not installed"
> else
>   echo "Package is installed"
> fi
> ```

```bash
ynh_package_version PACKAGE
```
> Returns the installed version number of `PACKAGE`.

```bash
ynh_package_update
```
> Updates the packages list (`apt update`) in a silent and non-interactive way.

**Be careful, the following commands are to be avoided when possible. Installing (and even more removing) a package without handling conflicts and dependencies is risky. That will be improved in future Yunohost versions.**

```bash
ynh_package_install PACKAGE1 PACKAGE2
```
> Installs (`apt install`) `PACKAGE1`, `PACKAGE2`… packages, in a non interactive and silent way.

```bash
ynh_package_autoremove PACKAGE1 PACKAGE2
```

> Removes (`apt-get autoremove`) `PACKAGE1`, `PACKAGE2`… packages in a silent and non-interactive way.

#### Apps configuration

```bash
ynh_app_setting_set APP KEY VALUE
```

> Store the setting named `KEY` with value `VALUE` for the app `APP`. This allows to reuse it later (typically in the `upgrade` script), or so that YunoHost can autoconfigure the SSO.
> The settings are stored in the /etc/yunohost/apps/${APP}/settings.yml file.
> For example, to store the visibility setting (private or public app), you can use :
> ```bash
> ynh_app_setting_set my_app is_public "yes"
> ```

The SSO uses app stored settings to allow or deny public access to HTTP resources. There are 6 configuration keys :

`skipped_uris`, `unprotected_uris` and `protected_uris` are relative to app path. Example:
> ```bash
> ynh_app_setting_set app_name skipped_uris "/blog"
> ```
> Matches the /blog path of the application: https://domain.tld/path_app/blog and everything under this path, but not https://domain.tld/path_app/.

**skipped_uris**
An URL set with *skipped_uris* key will be totally ignored by the SSO, which means that the access will be public and the logged-in user information will not be passed to the app.

**unprotected_uris**
An URL set with *unprotected_uris* key will be accessible publicly, but if an user is logged in, his information will be accessible (though HTTP headers) to the app.

**protected_uris**
An URL set with *protected_uris* will be blocked by the SSO and accessible only to authenticated and authorized users.

`skipped_regex`, `unprotected_uris` and `protected_regex` are regex counterparts of the above keys.

> The syntax is **not** the "standard" regex syntax ([PCRE](https://en.wikipedia.org/wiki/Perl_Compatible_Regular_Expressions)) but [Lua patterns](http://lua-users.org/wiki/PatternsTutorial).

The regex patterns match the whole URL, unlike the string patterns (which match only the app-local part of the URL, as detailed above). This means you must write complete patterns including the *domain* and *path*.
> For example, to use *skipped_regex* to match /blog followed by a 1+ digit number:
> ```bash
> ynh_app_setting_set app_name skipped_regex "$domain$path/blog%?%d+$"
> ```
> This may lead to an issue : if $domain or $path contain a dash (-), it will interpreted as a pattern magic char. That is why dashes must be escaped with a %.
> ```bash
> domainregex=$(echo "$domain" | sed 's/-/\%&/g')
> pathregex=$(echo "$path" | sed 's/-/\%&/g')
> ynh_app_setting_set app_name skipped_regex "$domainregex$pathregex/blog%?%d+$"
> ```

```bash
ynh_app_setting_get APP KEY
```

> Get the value of the setting named `KEY` for the `APP` app.
> Example :
> ```bash
> is_public=$(ynh_app_setting_get app_name is_public)
> ```


```bash
ynh_app_setting_delete APP KEY
```

Delete the setting named `KEY` for the `APP` app.

#### Users management

```bash
ynh_user_exists USERNAME
```

> Checks the existence of `USERNAME` user in YunoHost.
> Command return code must be checked to know the result.
> Example:
> ```bash
> if ynh_user_exists "johndoe" ; then
>   echo "This user exists!"
> fi
> ```
```bash
ynh_user_get_info USERNAME KEY
```

> Get the `KEY` information on `USERNAME` user.
> Possible `KEY` values are:
> - firstname
> - fullname
> - lastname
> - mail
> - mail-aliases
> - mailbox-quota
> Example:
> ```bash
> mailadmin=$(ynh_user_get_info $admin mail)
> ```


```bash
ynh_system_user_exists USERNAME
```
> Checks if the `USERNAME` unix user exists.
> Command return code must be checked to know the result.
> Example:
> ```bash
> if ynh_system_user_exists "www-data" ; then
>   echo "User exists on system!"
> fi
> ```


#### Other commands
```bash
ynh_string_random LENGTH
```
> Generates a random string of `LENGTH` chars (defaults to 24).


```bash
ynh_die MSG RETCODE
```
> Displays the `MSG` message on stderr and exits the script with `RETCODE` return code (defaults to 1).

<br/>

**Following commands are to be replaced (or even deleted) in future YunoHost versions.**

```bash
sudo yunohost app checkport <port>
```
> This helper checks the port and returns an error if the port is already in use.
> Command return code must be checked to know the result.
> Example:
> ```bash
> port=DEFAULT_PORT
> while ! sudo yunohost app checkport $port ; do
>     port=$((port+1))
> done
> ```


```bash
sudo yunohost firewall allow [--no-upnp] {TCP,UDP,Both} PORT
```
> Opens the port number `PORT` on the firewall, for TCP, UDP or both.
> Automatic port opening via upnp may be disabled on this port using `--no-upnp`

```bash
sudo yunohost firewall disallow {TCP,UDP,Both} PORT
```
> Closes the port number `PORT` on the firewall for TCP, UDP or both.

```bash
sudo yunohost app checkurl DOMAINPATH -a APP
```

> Checks `DOMAIN`/`PATH` url availability. Useful for web apps to make sure the chosen URL is not already taken by another app. If the URL is available, that commands register for the `APP` application.
> **Note**: do not prepend `http://` or `https://` to `DOMAINPATH`.


```bash
sudo yunohost app addaccess [--users=USER] APP
```
> Allow the `USER` user to access `APP`.


```bash
sudo yunohost app removeaccess --users=USER APP
```
> Remove the access authorization to `APP` from `USER` user.


```bash
sudo yunohost service remove NAME
```
> Remove the service `NAME` from the YunoHost management interface.


```bash
sudo yunohost app ssowatconf
```
> This commands rebuilds the SSO configuration. It is called automatically at the end of any script, but you may want to call it by hand before.
