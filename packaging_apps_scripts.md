<a class="btn btn-lg btn-default" href="packaging_apps_en">Application packaging</a>

## Scripts

For now, a YunoHost package must contain five Shell scripts: `install`, `remove`, `upgrade`, `backup` and `restore`. A 6th script `change_url` can also be added optionally.
These scripts will be executed as `root` on the YunoHost instances.

Examples scripts are available in the [example app](https://github.com/YunoHost/example_ynh/tree/master/scripts)

### Usage
You have to put everything in the `install` script in order to get the app to install without issue. It means that you have to install dependencies, create required repositories, initialize potential databases, copy sources and configure everything in the single `install` script (and of course do the reverse process in the `remove` script).

It's possible to use helpers and import function library by example from a `_common.sh` file.

### Available variables for these scripts
#### YNH_CWD
This var contains the current working directory path of the executed script. It can be useful for find out the initial path if we have move of directory during the script execution. It is used by some helpers to be sure to use the good directory.

#### YNH_APP_ID
It contains the application's identifier without the instance's number.

Example: strut

#### YNH_APP_INSTANCE_NAME
It contains the instance name which will is used in a lot of situation to manage multiple setup of the same app.

Example: strut__3
#### YNH_APP_INSTANCE_NUMBER
It contains the instance's number. Warning, it's not the number of running instances because an old app might be deleted.

Example: 3

### Variables specific to `install`
#### YNH_APP_ARG_XXXXXXX
An environment variable is available for each question asked in the installation.

For example, if in the manifest we have a question like this
```json
{
    "name": "domain",
    "type": "domain",
    "ask": {
        "en": "Choose a domain for OpenSondage",
        "fr": "Choisissez un nom de domaine pour OpenSondage",
        "de": "Wählen Sie bitte einen Domain für OpenSondage"
    },
    "example": "domain.org"
},
```

The name of the question is `domain` so in the script we can access it with YNH_APP_ARG_DOMAIN. The usage is to create a shorter name in the script like this:

```bash
domain=$YNH_APP_ARG_DOMAIN
```

### Variables specific to `change_url`
#### YNH_APP_OLD_DOMAIN
The old domain where the app was installed.
#### YNH_APP_OLD_PATH
The old path where the app was installed.
#### YNH_APP_NEW_DOMAIN
The new domain where move the app.
#### YNH_APP_NEW_PATH
The new path where move the app.

