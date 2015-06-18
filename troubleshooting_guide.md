# YunoHost troubleshooting guide

You can consider this as some kind of administrator guide for troubleshooting or what to check when there is something wrong with your YunoHost server. It's not a step by step guide to make your YunoHost work but more of a list of things to check to help diagnose the issue you may have. This can also be useful for debug when packaging a new application or trying to understand YunoHost architecture.

## General notes
### Don't break YunoHost
Best way to troubleshoot is to not have to troubleshoot because you have tested everything before deploying it on your server.
That means everytime you want to try a new thing (unofficial app, new specific config, package an app…) try it on a development or testing server not on your production one. For this, use whatever way you think appropriate, you can use YunoHost on a [DigitalOcean droplet](install_on_digitalocean_en) for 1 cent/hour, locally with Docker or a VM for example.
Also: https://wiki.debian.org/DontBreakDebian

### Use non-official apps with caution
While it's tempting to install every [non-official apps](https://yunohost.org/#/apps_in_progress_en) please don't. Even if the app is marked as ready. Before testing an app you should read at least part of the package source code. Install, remove and upgrade script should be present. 
Keep in mind that when you install an app, you execute code on your server with administrator privileges, code that a stranger have put on internet.
From my experience some packaging are excellent, some can break some part of your YunoHost with one install and some others are unmaintained. So before install check package issues, the Forum and the YunoHost support channel to see if other have problem with the app.

### Check the official documentation
Answer to your question may be already in [the documentatioon](https://yunohost.org/#/sitemap_en).

### Check the command line help
Learn to use the [YunoHost command line](https://yunohost.org/#/moulinette_en) like a pro.

## Upgrade
Problems oftenly occurs after an upgrade. After a YunoHost upgrade you may want to [update your apps](https://yunohost.org/#/app_update_en).

**Check if some processes are using old librairies**

You're probably familiar with:
```bash
sudo apt-get update && sudo apt-get dist-upgrade
```
Most of the time it's enough. But in some cases it's possible that some process are still using old versions of upgraded files (such as libraries), that can cause bug. In rare cases that can lead to security concern (ex: upgrade OpenSSL because of a security bug, Nginx will continue to use the version it has in memory). The utility Checkrestart will help you to find and restart them.

```bash
sudo apt-get install debian-goodies
sudo checkrestart
Found 0 processes using old versions of upgraded files
```
If some process are running with old librairies versions checkrestart will tell you and propose you a way to restart them. In some cases checkrestart can't find a way to restart them.

<img src="https://yunohost.org/images/checkstart.png" width=600>

Easier way is to reboot if you can.

You can also use [this script](https://github.com/octopuce/octopuce-goodies/blob/master/checkrestart/checkrestart.octopuce) to automaticaly restart some services if needed. More info in French [here](https://www.octopuce.fr/checkrestart-outil-pratique-de-debian-goodies-et-version-octopuce/).

**Force an upgrade on a community app**

/!\ Always check if there is a upgrade script and read it if you can /!\
```bash
sudo yunohost app upgrade
Warning: You must provide an URL to upgrade your custom app someapp
Error: No app to upgrade
sudo yunohost app upgrade -u https://github.com/user/someapp_ynh someapp
```

## Services
YunoHost uses a bunch of software to accomplish its purpose. Most of theses software are registered as service in Debian. [More info](https://yunohost.org/#/whatsyunohost_fr).

### Check services status
When something doesn't work on your YunoHost, one of the first things to do is to check that all services used by YunoHost are running.
YunoHost include a helper to see the status of all services used by YunoHost:
```bash
sudo yunohost service status
```

Sample result:

<img src="https://yunohost.org/images/services_status.png" width=210>

All services should be enabled and running. Except glances (optional) and tahoe-lafs. If some are not, try to restart them. Here is a short description of what they do:

 - **Amavis**: anti-spam/virus/malwares, used when receiving email
 - **Avahi-daemon**: system which facilitates service discovery on a local network via DNS
 - **DNSmasq**: DNS server, you may or may not use it
 - **Dovecot**: IMAP email server, used to receive email
 - **Glances**: optional, used by web administration to display server status
 - **Metronome**: XMPP instant messaging server, used by Jappix and some external client
 - **MySQL**: database, used by some app
 - **Nginx**: web server, used by all web app
 - **php5-fpm**: PHP service, used by all app written in PHP
 - **Postfix**: SMTP email server, used to send email
 - **Postgrey**: Greylisting policy server, if you use YunoHost email, you should [read this](http://en.wikipedia.org/wiki/Greylisting)
 - **Slapd**: LDAP server, used for authentification (sso and app)
 - **SSH**: Secure Shell, speaks for himself
 - **YunoHost-api**: yunohost web administration

Others services installed by applications can also be present. In my example I have seafile-server wich serves Seafile app and uwsgi which is used to serve python app such as Searx.

**Start or stop a service which is registered with YunoHost:**
```bash
sudo yunohost service start <servicename>
sudo yunohost service stop <servicename>
```
You can also use the generic Debian command:
```bash
sudo service <servicename> start/stop/restart
```
After a launch attempt, always check that the service is running.

**Note**: Debian Jessie now uses systemd instead of upstart, but, for now it's fully compatible with Debian Wheezy way to handle services. [Useful resource on systemd](https://fedoraproject.org/wiki/SysVinit_to_Systemd_Cheatsheet).

### Logs
If a service doesn't start you have to check the logs to see what's wrong. There is no generic way for service to store their logs, but most of the times they are in:
```bash
/var/log/
```
Here are the some useful for YunoHost:
##### auth.log
connection or attempt to connection to your server. That includes every the time you connect with ssh, every the time a cron job connects, and all the failed (hopefully) attempts to connect by potential intruders.

##### fail2ban.log
when someone tries to connect to your server and fails multiple times, Fail2ban bans the IP address to avoid bruteforce and (D)DOS attacks. Here you can see if some ip have been banned.

##### mail.err, mail.info, mail.log, mail.warn
these are Postfix (the mail server) logs, check theses if you have issues with email.

##### metronome/metronome.err, metronome/metronome.log
XMPP chat server logs.

##### mysql.err, mysql.log, mysql/error.log
MySQL database logs, these should be empty unless you have trouble with MySQL.

##### php5-fpm.log
Genereic log for PHP apps.

##### yunohost.log
this is the log created by the YunoHost installation. If you have issue just after installing YunoHost, check this one.

This list is not exhaustive. Also some app may put their log in `/var/log` too. Slapd logs are unfortunatly in `/var/log/syslog`.

## Memory
Sometime issues are caused because you don't have enough free memory. To check it use the following command to check it:
```bash
free -m
```
<img src="https://yunohost.org/images/free_m.png" width=600> 

5-10% of free memory is fine but it's good to have margin (especially for upgrade). Since most of the time you can't upgrade your physical RAM, alternative it to use a swap file. Keep in mind that swap is memory but 100.000 times slower so you want to use it only when you have no other choice.

**Create a swap file:**
If free -m indicate that you have 0 total for swap line, you may want to add a swap file.
```bash
sudo install -o root -g root -m 0600 /dev/null /swapfile
dd if=/dev/zero of=/swapfile bs=1k count=512k
mkswap /swapfile
swapon /swapfile
echo "/swapfile       swap    swap    auto      0       0" | sudo tee -a /etc/fstab
sudo sysctl -w vm.swappiness=10
echo vm.swappiness = 10 | sudo tee -a /etc/sysctl.conf
```

Change 512 with the number of Mb of swap you want, 512Mb should be enough for YunoHost. After that, check with `free -m` that you swap is activated.
[Source with more explanation](https://meta.discourse.org/t/create-a-swapfile-for-your-linux-server/13880).

## Disk space
One other common issue on a server is lack of disk space. You can verify that your filesystem are not full with the command:
```bash
df -h
```
This will show you disk usage, if one of Filesystem is approching to 100% use you may have issue and want to take appropriate actions to liberate space or extend your filesystem.

<img src="https://yunohost.org/images/df_h.png" width=400>

## Nginx
Nginx play a big part in YunoHost since it serve all the web applications. YunoHost have a specific way to handle its configuration since there are multiple domain and multiple applications.

### Configuration
**General configuration structure**
```bash
# Main nginx configuration, you don't want to touch this file
/etc/nginx/nginx.conf
# Directory where all yunohost, domain and app config are located
/etc/nginx/conf.d/
# Configuration of web administration
/etc/nginx/conf.d/yunohost_admin.conf
# Per domain configuration (one per domain)
/etc/nginx/conf.d/example.com.conf
```

**Application configuration**

For each application on a given domain there is a nginx conf file located in:
```bash
/etc/nginx/conf.d/example.com.d/appname.conf
```
Application configuration file usually follow this type of pattern
```bash
location YNH_WWW_PATH { # path to access the app in browser
 alias YNH_WWW_ALIAS ; # Path to source, usually /var/www/appname

# Specific configuration for the application according to its programming language and deployment option
...
...
# Include SSOWAT user panel in bottom right
include conf.d/yunohost_panel.conf.inc;
}
```

### Logs
Nginx logs files are located in this directory:
```bash
/var/log/nginx/
```
#### Generic logs:
##### access.log
generic access logs, you will find here all the access to the YunoHost administration and sometimes intrusion tentative.

##### error.log
should be empty with a correct Nginx config. If Nginx doesn't start, error are probably located in this log.

#### For each domain name:
##### example.com-access.log
all access to the domain, including all apps.

##### example.com-error.log
all error regarding app installed on the domain.

Sometime application may have their logs located here too.

## SSOwat
SSowat is the software that connect the web server nginx to the LDAP server. His purpose is to authentificate users to the YunoHost portal and all web apps. [More info](https://github.com/Kloadut/SSOwat).

### Configuration
You can view (don't edit it, it will be often overwritten) your current SSOwat config in the file:
```bash
/etc/ssowat/conf.json
```
Which is generated by:
```bash
sudo yunohost app ssowatconf
```
Protip: if you want to add a personalized rule for SSOwat, do it in this file:
```bash
/etc/ssowat/conf.json.persistent
```
### Logs
There is no specific log for SSOwat, logs are located in nginx logs files. If you see some line with "lua' in it, it's probably ssowat.

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
For all the service you pass "yes", yunohost will not upgrade the config of the specified service. Do this only if you know what you're doing.

All apps configurations are located in:
```bash
/etc/yunohost/apps/appname/
```
For each app you will find in this directory:

* **manifest.json**: manifest of the app
* **scripts/**: directory containing all Shell scripts to manage apps
 * install
 * upgrade
 * remove
 * backup
 * restore
* **config/**: config directory
* **settings.yml**: config of the app, also accessible via sudo YunoHost app setting appname settingname
* **LICENSE**: license of the package

### Logs
As far as I know there is no logfile for application installation so when you install an app, keep the log. There is some log about the command line utilisation in:
```bash
/var/log/yunohost/
```

## Applications
This part is more for packager or to understand the link between Nginx and webapps. For packaging a new app you should [read this first](https://yunohost.org/#/packaging_apps_en).

When troubleshooting an application issue can occur at several levels. There is a wide variety of applications and their deployement to YunoHost will differ depending the programation langage of the app. We will deal here with the most common case.
Applications configurations are not treated because it completely differs according to the application.

**Oversimplified schema**
your browser -> nginx <- (web server) <- runtime (php, python, node.js,...) <- app

App is interpretated by the runtime, runtime provide or not a webserver, if not a webserver can be added, webserver or runtime communicate with nginx, nginx serve webpage to your browser.

The purpose of this configuration is to have multiple application on one server but with only the https port (443) open to the world.

### PHP app
##### Deployment option
PHP works natively with Nginx.

##### Communication with Nginx
The php interpreter communicate with nginx throught [PHP-FPM](http://php-fpm.org/) which is a [FastCGI](http://en.wikipedia.org/wiki/FastCGI) implementation.

##### Logs
```bash
/var/log/php5-fpm.log
```
**YunoHost package example**: [Owncloud](https://github.com/Kloadut/owncloud_ynh).

### Python app
##### Deployment option
A Python webapp should run with it's own Python interpreter with it's own dependancies, for this, the tool virtualenv is used.
Usually, a light web server will be used to serve the app behind Nginx. [Uwsgi](https://uwsgi-docs.readthedocs.org/en/latest/) is a good example.

##### Communication with Nginx
Nginx can talk too python server via three ways:
 - [proxy_pass](http://nginx.org/en/docs/http/ngx_http_proxy_module.html#proxy_pass)
 - Websocket
 - Native uwsgi: uwsgi_pass [Example](https://github.com/abeudin/searx_ynh/blob/master/conf/nginx.conf#L9-L10)

##### Logs
Specific to the app and/or the webserver used, for example uwsgi:
```bash
/var/log/uwsgi/
```
##### Ressources
[good resource in french on Python virtualenv](http://sametmax.com/les-environnement-virtuels-python-virtualenv-et-virtualenvwrapper/)

**YunoHost package example**: [Searx](https://github.com/abeudin/searx_ynh)

### Node.js app
##### Deployment option
A Node.js app have it's own web server integrated in node runtime, usually Node will expose the app to a TCP port.

##### Communication with nginx
The http endpoint will be passed locally to Nginx via proxy_pass.

##### Logs
This will be app specific.

##### Ressources

##### YunoHost app example
[Etherpad-Lite (non-official but good package)](https://github.com/abeudin/etherpadlite_ynh).

**note**: node runtime can use "a lot" of memory comparated to other app, make sure you have enough.

### Other (go binary, Java...)
Webapp can take multiple form an can be deployed in many different manner. Go app have usually an integrated webserver, Java can be deployed with Tomcat or equivalent… There is no way I can be exhaustive here, but most of the time your deployement option will expose an http endpoint that you can pass to nginx via proxy_pass.

**Note on Apache**: never install Apache or a package that have Apache as dependancy, this will probably break YunoHost.

**Note on https**: sometimes the webserver integrated with the app is capable to serve https on its own, it's ok to use this when you have one application on one server and you don't want to install nginx for example. But in YunoHost case, it's nginx who serve https and this should be only nginx (mostly to simplify configuration). So when passing the local url to nginx via proxy_pass, use http, nginx will https the thing to the open world later.