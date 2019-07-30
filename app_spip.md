# SPIP for YunoHost

#### SPIP is what?

SPIP is an Internet publishing system that focuses on collective functioning, multilingualism and ease of use. It is free software, distributed under the GNU/GPL license. It can therefore be used for any website, whether associative or institutional, personal or commercial.

Source:[spip.net](https://www.spip.net/fr_rubrique91.html_rubrique91.html)

#### Application functionality for Yunohost

* Installation of the base without going through the installation system
* Multilingual support
* LDAP support

##### Installation

```bash
$ sudo yunohost app install https://github.com/YunoHost-Apps/spip_ynh.git_ynh.git
```

##### Update

```
sudo yunohost app upgrade --verbose spip -u https://github.com/YunoHost-Apps/spip_ynh.git_ynh.git
```

##### Use

Access the administration of the site by entering the following address in your browser.

https://www.domain.tld/spip/ecrire

Make a "forgotten password" request to change your password, you will receive an email telling you how to change your password.