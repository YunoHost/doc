<a class="btn btn-lg btn-default" href="packaging_apps_en">Application packaging</a>

## Shell helpers

Since YunoHost 2.4 release, **new shell helpers** are available to ease packaging, in particular for common tasks like password generation, MySQL database creation…

Examples are available in the [example application](https://github.com/YunoHost/example_ynh/blob/master/scripts/install). We advise to use them. 

You can find them on this [repository](https://github.com/YunoHost/yunohost/blob/unstable/data/helpers.d).

To use them, you need to add following lines in the shell scripts:
```bash
# Source app helpers
. /usr/share/yunohost/helpers
```

<!--
<br />

#### Moulinette
The CLI [moulinette](/moulinette) provides a few tools to make the packager's work easier:

```bash
sudo yunohost app checkport <port>
```
<blockquote>
This helper checks the port and returns an error if the port is already in use.
</blockquote>

<br>

```bash
sudo yunohost app setting <id> <key> [ -v <value> ]
```
<blockquote>
This is the most important helper of YunoHost. It allows you to store some settings for a specific app, in order to be either reused afterward or used for YunoHost configuration (**e.g.** for the SSO).
<br><br>
It sets the value if you append ```-v <value>```, and gets it otherwise.
<br><br>

** Some useful settings **<br><br>
```skipped_uris```<br><br>
Remove the protection on the uris list provided separated by commas.<br><br>

```protected_uris```<br><br>
Protects the uris list provided separated by commas. Only logged in users will have access.<br><br>

There are also `skipped_regex`, `protected_regex`, `unprotected_uris`, `unprotected_regex`.<br><br>

**Be careful** : you must run `yunohost app ssowatconf` to apply the effect. URIs will be converted into URLs and written to the file /etc/ssowat/conf.json.<br><br>

Example:<br>
```yunohost app setting myapp unprotected_urls -v "/"```<br>
```yunohost app ssowatconf```<br>
These commands will disable the SSO on the root of the aplication like domain.tld/myapp This is useful for public application.
</blockquote>

<br>

```bash
sudo yunohost app checkurl <domain><path> -a <id>
```
<blockquote>
This helper is useful for web apps and allows you to be sure that the web path is not taken by another app. If not, it "reserves" the path.
<br><br>
**Note**: do not prepend `http://` or `https://` to the `<domain><path>`.
</blockquote>

<br>

```bash
sudo yunohost app initdb <db_user> [ -p <db_pwd> ] [ -s <SQL_file> ]
```
<blockquote>
This helper creates a MySQL database. If you do not append a password, it generates one and returns it. If you append a SQL file, it initializes your database with the SQL statements inside.
</blockquote>

<br>

```bash
sudo yunohost app ssowatconf
```
<blockquote>
This helper reloads the SSO configuration. You have to call it at the end of the script when you are packaging a web app.
</blockquote>
-->
