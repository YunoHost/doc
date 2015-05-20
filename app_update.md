#Upgrade your applications

Once you installed applications, you may need to updgrade them, sooner or later. 

** Attention : ** Please be advised to backup your databases (using phpmyadmin application for example) and files before any upgrade.

### Upgrade using the admin panel
Go to Tools > Update system

Once the applications packages list is retrieved, you will be able to update official applications that have a pending upgrade.

### Upgrade using command line
First, connect to your server through SSH and type in the following command (WordPress update):
```bash
yunohost app upgrade wordpress
```
** Note : ** In case you have multiple instances of the same type (ex : 2 wordpress) installed, you will need to specify the instance name (ex : wordpress ou wordpress__2 ).

#### Upgrade an unofficial application
Spcify the git repository containing the updgrade. 

FOr example, to upgrade LimeSurvey :
```bash
yunohost app upgrade limesurvey -u https://github.com/zamentur/limesurvey_ynh
```

** Note : ** Be cautious when installing unofficial applications and upgrades. Be sure that theses updates are stables and are not a step in the development process. There may be a good reason if an application is not listed in the official repository.

** Attention : ** Be sure to check the content of any update ; installing or upgrading an unofficial application allows it to run scripts with the highest privileges.
