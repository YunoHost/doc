#Upgrade your applications

Once you installed applications, you may need to upgrade them, sooner or later. 

** Caution: ** please be advised to backup your databases (using phpmyadmin application for example) and files before any upgrade.

### Upgrade using the admin panel
Go to Tools > Update system

Once the applications packages list is retrieved, you will be able to update official applications that have a pending upgrade.

### Upgrade using command line
First, connect to your server through SSH and type in the following command (WordPress update):
```bash
yunohost app upgrade wordpress
```
** Note: ** in case you have multiple instances of the same type (ex: 2 wordpress) installed, you will need to specify the instance name (ex: wordpress or wordpress__2).

#### Upgrade an unofficial application
Specify the git repository containing the upgrade. 

For intance, to upgrade LimeSurvey:
```bash
yunohost app upgrade limesurvey -u https://github.com/zamentur/limesurvey_ynh
```

** Note: ** be cautious when installing unofficial applications and upgrades. Be sure that theses updates are stables and are not a step in the development process. There may be a good reason if an application is not listed in the official repository.

** Caution: ** be sure to check the content of any update; installing or upgrading an unofficial application allows it to run scripts with the highest privileges.

#### Command line options

When upgrading apps from the command line, you can specify specific options to change the behaviour of the upgrade script.  
To set those options, set the corresponding variable before the upgrade command: `sudo OPTION_TO_SET=1 yunohost app upgrade wordpress`

Available options are:
- `NO_BACKUP_UPGRADE`: Do not perform the backup before the upgrade. Which means the upgrade will be operated without a security backup.
- `YNH_FORCE_UPGRADE`: Force the upgrade of the app and the package, even if the app is already up to date.
