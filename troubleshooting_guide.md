# YunoHost troubleshooting guide

You can consider this as some kind of administrator guide for troubleshooting or what to check when there is something wrong with your YunoHost server. It's not a step by step guide to make your YunoHost work but more of a list of things to check to help diagnose the issue you may have. This can also be useful for debug when packaging a new application or trying to understand YunoHost architecture.

## General notes
### Do not break YunoHost
Best way to troubleshoot is to not have to troubleshoot because you have tested everything before deploying it on your server.
This means that everytime you want to try a new thing (non-official app, new specific config, package an app...), you should try it on a development or testing instance, *not* on your production server. For this, you can [set up a virtualbox](install_on_virtualbox), or for instance a [DigitalOcean droplet](install_on_vps) for 1 cent/hour.

Also: https://wiki.debian.org/DontBreakDebian

### Do not install bad quality apps

Even if it can be tempting to install every [apps](https://yunohost.org/#/apps), be careful to their quality level as a bad quality app can ultimately break your server. If you absolutely wish to install such an app, at least try to do it on a test server or check if issues has been posted to this app's Github repository or on the [forum](http://forum.yunohost.org/).

### Check the official documentation
Answer to your question may be already in [the documentation](https://yunohost.org/#/docs_en).

### Check the command line help
Learn how to use the [YunoHost commands](https://yunohost.org/#/commandline) like a pro.

## Upgrade
Problems often occur after an upgrade. After a YunoHost upgrade you may want to [update your apps](https://yunohost.org/#/app_update_en).

**Check if some processes are using old libraries**

You are probably familiar with:
```bash
$ apt update && apt dist-upgrade
```
Most of the time it's enough. But in some cases it's possible that some process are still using old versions of upgraded files (such as libraries), that can cause bug. In rare cases that can lead to security concern (ex: upgrade OpenSSL because of a security bug, Nginx will continue to use the version it has in memory). The utility Checkrestart will help you to find and restart them.

```bash
$ apt install debian-goodies
$ checkrestart
Found 0 processes using old versions of upgraded files
```
If some process are running with old librairies versions checkrestart will tell you and propose you a way to restart them. In some cases checkrestart can't find a way to restart them.

<img src="/images/checkstart.png" width=600>

Easier way is to reboot if you can.

You can also use [this script](https://github.com/octopuce/octopuce-goodies/blob/master/checkrestart/checkrestart.octopuce) to automaticaly restart some services if needed. More info in French [here](https://www.octopuce.fr/checkrestart-outil-pratique-de-debian-goodies-et-version-octopuce/).

**Force an upgrade on a community app**

/!\ Always check if there is a upgrade script and read it if you can /!\
```bash
$ yunohost app upgrade
Warning: You must provide an URL to upgrade your custom app app_name
Error: No app to upgrade
$ yunohost app upgrade -u https://github.com/user/someapp_ynh app_name
```

## Services
YunoHost uses a bunch of software to accomplish its purpose. Most of theses software are registered as service in Debian. [More info](https://yunohost.org/#/whatsyunohost_fr).

### Check services status
When something doesn't work on your YunoHost, one of the first things to do is to check that all services used by YunoHost are running.
YunoHost include a helper to see the status of all services used by YunoHost:
```bash
$ yunohost service status
```

Sample result:

<img src="/images/services_status.png" width=210>

All services should be enabled and running. Except glances (optional). If some are not, try to restart them. Here is a short description of what they do:

- **Amavis**: anti-spam/virus/malwares, used when receiving email
- **Avahi-daemon**: system which facilitates service discovery on a local network via DNS
- **DNSmasq**: DNS server, you are not forced to use it
- **Dovecot**: IMAP email server, used to receive email
- **Glances**: optional, used by web administration to display server status
- **Metronome**: XMPP instant messaging server, used by Jappix and some external client
- **MySQL**: database, used by some app
- **Nginx**: web server, used by all web app
- **php5-fpm**: PHP service, used by all app written in PHP
- **Postfix**: SMTP email server, used to send email
- **Postgrey**: greylisting policy server, if you use YunoHost email, you should [learn more about greylisting](http://en.wikipedia.org/wiki/Greylisting)
- **Slapd**: LDAP server, used for authentification (SSO and apps)
- [**SSH**](/ssh_en): Secure Shell
- [**SSOwat**](https://github.com/Kloadut/SSOwat/): an simple sign-on
- **YunoHost-API**: YunoHost web administration

Others services installed by applications can also be present. For instance, `seafile-serve` which serves Seafile app and `uwsgi` which serve Python apps such as Searx.

##### Start or stop a service which is registered with YunoHost:

```bash
$ yunohost service start <servicename>
$ yunohost service stop <servicename>
```
You can also use the generic Debian command:
```bash
$ systemctl start/stop/restart/reload <servicename>
```
After a launch attempt, always check that the service is running.

### Logs
If a service won't start you have to check the logs to see what's wrong. There is no generic way for services to store their logs, but there are mainly stocked in: `/var/log/`

Here are the some useful logs files for YunoHost:

##### auth.log
Contains connections or attempt of connection to your server. It includes every web, ssh, cron job connection. It also stockes all the failed (hopefully) attempts to connect by a potential intruders connections.

##### fail2ban.log
When someone tries to connect to your server and fails multiple times, Fail2ban bans the IP address to avoid bruteforce and (D)DOS attacks. Here you can see if some IP have been banned.

##### mail.err, mail.info, mail.log, mail.warn
These are Postfix (the mail server) logs, check theses if you have issues with email.

##### metronome/metronome.err, metronome/metronome.log
XMPP chat server logs.

##### mysql.err, mysql.log, mysql/error.log
MySQL database logs, these should be empty unless you have trouble with MySQL.

##### php7.0-fpm.log
Generic logs for PHP apps.

##### yunohost.log
This is the log created at the YunoHost install. If you have issue installing YunoHost, check this file.

##### YunoHost operations logs
This is the logs created when you install, remove, backup, etc... an apps, they can be found using the Webadmin in Tools > Logs or using the command line: `yunohost log list` and `yunohost log display`.

This list is not exhaustive. Furthermore, some app may put their logs in `/var/log` too. Slapd logs are unfortunately in `/var/log/syslog`.

## RAM usage
Issues can be caused by a lack of RAM. To check your memory usage, do the following command:
```bash
free -m
```
<img src="/images/free_m.png" width=600> 

5-10% of free memory is fine but it's good to have margin (especially for upgrade). Since most of the time you can't upgrade your physical RAM, alternative it to use a swap file. Keep in mind that swap it's a memory 100.000 times slower, so you may to use it only if you got no other choice.

##### Create a swap file:
If `free -m` indicate that you have 0 total for swap line, you may want to add a swap file.
```bash
sudo install -o root -g root -m 0600 /dev/null /swapfile
dd if=/dev/zero of=/swapfile bs=1k count=512k
mkswap /swapfile
swapon /swapfile
echo "/swapfile       swap    swap    auto      0       0" | sudo tee -a /etc/fstab
sudo sysctl -w vm.swappiness=10
echo vm.swappiness = 10 | sudo tee -a /etc/sysctl.conf
```

Change 512 with the quantity of swap memory you want, 512Mb should be enough for YunoHost. After that, check with `free -m` that you swap is activated.
[Source with more explanation](https://meta.discourse.org/t/create-a-swapfile-for-your-linux-server/13880).

## Disk space
One other common issue on a server is lack of disk space. You can check your filesystem are not full with the command:
```bash
df -h
```
This will show you disk usage, if one file-system is near to be full you could encounter issues. You should take appropriate actions to free space or extend your file-system.

<img src="/images/df_h.png" width=400>

## Nginx
Nginx play a big part in YunoHost since it serve all the web applications. YunoHost have a specific way to handle its configuration since there are multiple domain and multiple applications.

### Configuration
##### General configuration structure
```bash
# Main nginx configuration, you don't want to touch this file
/etc/nginx/nginx.conf
# Directory where all YunoHost, domain and app config are located
/etc/nginx/conf.d/
# Configuration of web administration
/etc/nginx/conf.d/yunohost_admin.conf
# Per domain configuration (one per domain)
/etc/nginx/conf.d/example.com.conf
```

##### Application configuration
For each application on a given domain there is a Nginx conf file located in:
```bash
/etc/nginx/conf.d/example.com.d/appname.conf
```
Application configuration file usually follow this type of pattern
```bash
location YNH_WWW_PATH { # path to access the app in browser
 alias YNH_WWW_ALIAS ; # Path to source, usually /var/www/app_name

# Specific configuration for the application according to its programming language and deployment option
...
...
# Include SSOWAT user panel in bottom right
include conf.d/yunohost_panel.conf.inc;
}
```

### Logs
Nginx logs files are located in the directory:
```bash
/var/log/nginx/
```
#### Generic logs
##### access.log
Generic access logs, you will find here all the accesses to the YunoHost administration and sometimes intrusion tentative.

##### error.log
Should be empty with a correct Nginx config. If Nginx doesn't start, error are probably located in this log.

#### For each domain name
##### example.com-access.log
All accesses to the domain, including all apps.

##### example.com-error.log
All error regarding app installed on the domain.

Sometime application may have their logs located here too.

## SSOwat
[SSowat](https://github.com/Kloadut/SSOwat) is the software that connect the web server nginx to the LDAP server. His purpose is to authentificate users to the YunoHost portal to switch easily between apps.

### Configuration
You can view (don't edit it, it is oftently overwritten) your current SSOwat config in the file:
```bash
/etc/ssowat/conf.json
```
Which is generated with the command:
```bash
yunohost app ssowatconf
```
Protip: if you want to add a personalized rule for SSOwat, do it in this file:
```bash
/etc/ssowat/conf.json.persistent
```
### Logs
There is no specific logs for SSOwat. There are are located in Nginx logs files. If you see some line with `lua` in it, it's probably SSOwat.

## YunoHost
### Configuration
YunoHost configuration is located in:
```bash
/etc/yunohost/
```
If you want to keep a custom service configuration use this file:
```bash
/etc/yunohost/yunohost.conf
```
For all the service you pass `yes`, YunoHost will not upgrade the config of the specified service. Do this only if you know what you're doing.

All apps configurations are located in:
```bash
/etc/yunohost/apps/app_name/
```
In each app packages you will find:

* **manifest.json**: manifest of the app
* **scripts/**: directory containing five Shell scripts to manage apps
 * install
 * upgrade
 * remove
 * backup
 * restore
* **config/**: config directory
* **settings.yml**: config of the app, also accessible with:
```bash
yunohost app setting appname settingname
```

### Logs
There is no logfile for application install so when you install an app, keep the log. There is some log about the command line usage in:
```bash
/var/log/yunohost/
```

## Applications
This part is more for packager or to understand the link between Nginx and webapps. First, you should know [how to package a new app](https://yunohost.org/#/packaging_apps_en).

When troubleshooting an application issue can occur at several levels. There is a wide variety of applications and their deployment to YunoHost will depending on the programming language of the app. We will deal here with the most commons cases.
Applications configurations are not treated because it completely differs according to the application.

##### Oversimplified schema
Web browser −> Nginx <− (web server) <− runtime (PHP, Python, Node.js,...) <− app

App is interpretated by the runtime, runtime provide or not a webserver, if not a webserver can be added, webserver or runtime communicate with Nginx, Nginx serve webpage to the web browser.

The purpose of this configuration is to have multiple application on one server with only the https port (443) open to the whole Internet.

### PHP apps
##### Deployment option
PHP works natively with Nginx.

##### Communication with Nginx
The PHP interpreter communicate with Nginx through [PHP-FPM](http://php-fpm.org/) which is a [FastCGI](http://en.wikipedia.org/wiki/FastCGI) implementation.

##### Logs
```bash
/var/log/php5-fpm.log
```
**YunoHost package example**: [Owncloud](https://github.com/Kloadut/owncloud_ynh).

### Python apps
##### Deployment option
A Python webapp should run with it's own Python interpreter with and it's own dependencies, for this, the tool `virtualenv` is used.
Usually, a light web server will be used to serve the app behind Nginx. [Uwsgi](https://uwsgi-docs.readthedocs.org/en/latest/) is a good example.

##### Communication with Nginx
Nginx can talk to Python server via three ways:
- [proxy_pass](http://nginx.org/en/docs/http/ngx_http_proxy_module.html#proxy_pass)
- Websocket
- Native uwsgi: uwsgi_pass: [for instance](https://github.com/abeudin/searx_ynh/blob/master/conf/nginx.conf#L9-L10)

##### Logs
Specific to the app and/or the webserver used, for instance uwsgi:
```bash
/var/log/uwsgi/
```
##### Ressources
[Great resource in french on Python virtualenv](http://sametmax.com/les-environnement-virtuels-python-virtualenv-et-virtualenvwrapper/)

**YunoHost package example**: [Searx](https://github.com/abeudin/searx_ynh)

### Node.js apps
##### Deployment option
A Node.js app have it's own web server integrated in node runtime, usually Node will expose the app to a TCP port.

##### Communication with Nginx
The http endpoint will be passed locally to Nginx via proxy_pass.

##### Logs
This will be specific to the app.

**YunoHost app example:** [Etherpad-Lite](https://github.com/abeudin/etherpadlite_ynh).

**Note**: Node process can use **lot** of memory compared to other app processes, make sure you have enough.

### Other (Go, Java...)
Webapp can take multiple form an can be deployed in many way. Go app have usually an integrated webserver, Java can be deployed with Tomcat or equivalent… There is no way to be exhaustive here, but most of the time your deployment option will expose an http endpoint that you can pass to Nginx via proxy_pass.

##### Note on Apache
Never install Apache or a package withe Apache as dependency, this will probably break your YunoHost intance.

##### Note on https
Sometimes the webserver integrated with the app is capable to serve https on its own, it's right to use this when you have one application on one server and you don't want to install Nginx for intance. But in YunoHost case, Nginx who serve https and it simplify configuration. So when passing the local URL to Nginx via proxy_pass, use http, nginx will https the thing to the open world later.
