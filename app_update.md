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

------------------------------------------

# <img src="/images/APPLICATION_logo.svg" width="80px" alt="APPLICATION's logo"> APPLICATION

[![Install APPLICATION with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=APPLICATION) [![Integration level](https://dash.yunohost.org/integration/APPLICATION.svg)](https://dash.yunohost.org/appci/app/APPLICATION)

- [Configuration](#Configuration)
- [Limitations with YunoHost](#limitations-with-yunohost)
- [Customer Applications](#Customer-applications)
- [Useful links](#useful-links)

**General presentation of the application.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Configuration

**If the configuration of the application is not done with the admin panel of YunoHost.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Limitations with YunoHost

**Explanation of the current limitations in using the application with YunoHost.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Customer applications

| Application name | Platform | Multi-account | Other supported networks | Play Store | F-Droid | Apple Store | *Other* |
|------------------|----------|---------------|--------------------------|------------|---------|-------------|---------|
|                  |          |               |                          |            |         |             |         |

## Useful links

+ Website: [WEBSITE](#)
+ Official documentation: [DOCUMENTATION](#)
+ Application software repository: [github.com - YunoHost-Apps/APPLICATION](https://github.com/YunoHost-Apps/APPLICATION_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/APPLICATION/issues](https://github.com/YunoHost-Apps/APPLICATION_ynh/issues)
