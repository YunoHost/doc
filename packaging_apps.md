# App packaging

There are few things to know if you want to package an application for YunoHost.

### Content
A YunoHost package looks like [this](https://github.com/Kloadut/roundcube_ynh), and is composed of:

* A JSON file `manifest.json`
* A `scripts` directory, which contains the `install`, `remove` and `upgrade` scripts
* Optionnal other directories, like `sources` or `conf` if you need them


### Manifest
The `manifest.json` file defines the app's constants, a bunch of values that YunoHost needs to identify the app and install it correctly. It looks like this :
```json
{
    "name": "Roundcube",
    "id": "roundcube",
    "description": {
        "en": "Open Source Webmail software",
        "fr": "Webmail Open Source"
    },
    "developer": {
        "name": "kload",
        "email": "kload@kload.fr",
        "url": "http://kload.fr"
    },
    "multi_instance": "true",
    "arguments": {
        "install" : [
            {
                "name": "domain",
                "ask": {
                    "en": "Choose a domain for Roundcube"
                },
                "example": "domain.org"
            },
            {
                "name": "path",
                "ask": {
                    "en": "Choose a path for Roundcube"
                },
                "example": "/webmail",
                "default": "/webmail"
            }
        ]
    }
}
```

* **name** : The name of the app. It does not have to be unique, but it should since it is the shown name to all the YunoHost administrators in the app list.

* **id** : The unique ID of the app. You have to ensure that this ID is unique before submit an app integration request.

* **description** : The complete description of the app. You can make it as detailed as you feel it legit. Only `en` is required right now, but you can translate the description by prepending the locale prefix.

* **developer** : Some informations about the app maintainer.

* **multi_instance** : This defines your app's ability to be installed multiple times. When YunoHost tries to install a second instance of your app, it will replace the `id` in your scripts by an `id__2`. It means that if you want to be `multi_instance`, you have to put all the identifiers in the scripts. 
<br><br>**E.g.** In my roundcube script, I have to call my database `roundcube`, my install directory `roundcube` and my Nginx configuration `roundcube`. This way, the second instance of roundcube will not conflict, and will be installed in the `roundcube__2` database, in the `roundcube__2`directory, and with the `roundcube__2` Nginx configuration.

* **arguments** : The settings to ask to the YunoHost's administrator at installation. You have to set a `name` (for argument identification), and a question in `ask` (at least in `en`) that you can translate like the description above. You can also set a `default` value and an `example` to help administrator to fill the input.

## Scripts

For now, a YunoHost package must contain 3 bash scripts: `install`, `remove`, and `upgrade`.
These scripts will be executed as `admin` on the YunoHost instances.

Here is an example :
```bash
# Retrieve arguments
domain=$1
path=$2

# Check domain/path availability
sudo yunohost app checkurl $domain$path -a roundcube
if [[ ! $? -eq 0 ]]; then
    exit 1
fi

# Generate random DES key & password
deskey=$(dd if=/dev/urandom bs=1 count=200 2> /dev/null | tr -c -d '[A-Za-z0-9]' | sed -n 's/\(.\{24\}\).*/\1/p')
db_pwd=$(dd if=/dev/urandom bs=1 count=200 2> /dev/null | tr -c -d '[A-Za-z0-9]' | sed -n 's/\(.\{24\}\).*/\1/p')

# Use 'roundcube' as database name and user
db_user=roundcube

# Initialize database and store mysql password for upgrade
sudo yunohost app initdb $db_user -p $db_pwd -s $(readlink -e ../sources/SQL/mysql.initial.sql)
sudo yunohost app setting roundcube mysqlpwd -v $db_pwd

# Copy files to the right place
final_path=/var/www/roundcube
sudo mkdir -p $final_path
sudo cp -a ../sources/* $final_path
sudo cp ../conf/main.inc.php $final_path/config/
sudo cp ../conf/db.inc.php $final_path/config/
sudo mv $final_path/plugins/managesieve/config.inc.php.dist $final_path/plugins/managesieve/config.inc.php

# Change variables in Roundcube configuration
sudo sed -i "s/rcmail-ynhDESkeyTOchange/$deskey/g" $final_path/config/main.inc.php
sudo sed -i "s/yunouser/$db_user/g" $final_path/config/db.inc.php
sudo sed -i "s/yunopass/$db_pwd/g" $final_path/config/db.inc.php
sudo sed -i "s/yunobase/$db_user/g" $final_path/config/db.inc.php

# Set permissions to roundcube directory
sudo chown -R www-data: $final_path

# Modify Nginx configuration file and copy it to Nginx conf directory
sed -i "s@PATHTOCHANGE@$path@g" ../conf/nginx.conf
sed -i "s@ALIASTOCHANGE@$final_path/@g" ../conf/nginx.conf
sudo cp ../conf/nginx.conf /etc/nginx/conf.d/$domain.d/roundcube.conf

# Reload Nginx and regenerate SSOwat conf
sudo service nginx reload
sudo yunohost app ssowatconf
```

### Usage
You have to put everything in the script in order to install your app flawlessly. It means that you have to install dependencies, create required repositories, initialize potential databases, copy sources and configure everything in the single `install` script (and of course do the reverse process in the `remove` script).

**Be careful** : For security reason, the script is executed as **admin** user in YunoHost. Be sure to test it as **admin** and prepend `sudo` to requiring commands.

### Architecture and arguments
Since YunoHost has a unified architecture, you will be able to guess most of the settings you need. But if you need variable ones, like domain or web path to configure your app, you will have to ask the administrator at installation (see `arguments` section in the manifest above).

**Note**: The arguments will be passed in the manifest's order to the script. For example for **roundcube**, the `domain` argument will be referenced as `$1` in the script, and `path` as `$2`.

### Hooks
YunoHost provides a hook system which consist in packager's script callbacks in the moulinette (CLI).
The scripts has to be placed in the `hooks` repository at the root of the YunoHost package, and has to be named `priority-hook_name`, for example: `hooks/50-post_user_create` will be executed after each user creation.

**Note**: `priority` is optional, default is `50`.

Take a look at the [OwnCloud package](https://github.com/Kloadut/owncloud_ynh) for a working example.

### Helpers
The CLI [moulinette](#/moulinette) provides a few tools to make the packager's work easier:

<br>

```bash
sudo yunohost app checkport <port>
```
<blockquote>
This helper checks the port and return an error if the port is already in use.
</blockquote>

<br>

```bash
sudo yunohost app setting <id> <key> [ -v <value> ]
```
<blockquote>
This is the most important helper of YunoHost. It allows you to store some settings for a specific app, in order to be either reused afterward or used for YunoHost configuration (**e.g.** for the SSO).
<br><br>
It sets the value if you append ```-v <value>```, and gets it otherwise.
</blockquote>

<br>

```bash
sudo yunohost app checkurl <domain><path> -a <id>
```
<blockquote>
This helper is useful for web apps and allows you to be sure that the web path is not taken by another app. If not, it "reserves" the path.
<br><br>
**Note** : Do not prepend `http://` or `https://` to the `<domain><path>`.
</blockquote>

<br>

```bash
sudo yunohost app initdb <db_user> [ -p <db_pwd> ] [ -s <SQL_file> ]
```
<blockquote>
This helper creates a MySQL database. If you do not append a password, it generates one and returns it. If you append a SQL file, it initializes you database with the SQL statements inside.
</blockquote>

<br>

```bash
sudo yunohost app ssowatconf
```
<blockquote>
This helper reloads the SSO configuration. You have to call it at the end of the script when you are packaging a web app.
</blockquote>

### Test it !
In order to test your app package, you can execute your script standalone as `admin` (do not forget to append required arguments):
```bash
su - admin -c "/bin/bash /path/to/my/script my_arg1 my_arg2"
```

Or you can use the moulinette:
```bash
yunohost app install /path/to/my/app/package
```
Note that it also works with a Git URL:
```bash
yunohost app install https://github.com/author/my_app_package.git
```
