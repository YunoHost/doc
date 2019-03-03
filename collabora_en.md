# Install Collabora with Nextcloud, using Docker
**Note :** This walkthrough is based on a Debian 8 instance, and has not been tested since version 3 upgrade of Yunohost. As a prerequisite, you must have configured your domains and sub-domains in the DNS, in compliance with : [DNS](/dns_en), [Sub-domain install of an app](/dns_subdomains_en), [DNS settings](/dns_config_en) and [noho.st / nohost.me / ynh.fr domains](/dns_nohost_me)).

### 0. Install Nextcloud

If Nextcloud is not already installed on your Yunohost instance, you may do so with this link : [Install Nextcloud](https://install-app.yunohost.org/?app=nextcloud)

### 1. Install Collabora app within yunohost
**In the admin interface :**

Applications > Install > at the bottom _Install a custom application_ > enter this url « https://github.com/aymhce/collaboradocker_ynh  » > Enter the domain/subdomain name you wish for the Collabora application.

### 2. Configuration within Nextcloud

 **Add the Collabora Online application in Nextcloud :**

Click on the user icon (top right) >  Applications  >  Desktop & Text > Under the « Collabora Online » tile, click on  `Activate` .

**Setup Collabora in Nextcloud :**

Click on the user icon (top right) > Parametres > Under _Administration_, _Collabora Online_ .
Specify the  « Online Collabora server » with the domain name chosen during the collabora install in Yunohost (full with « https:// »).

### 3. Reboot
To allow all the pieces to work, system must be reboot. You can do so through the admin interface (Tools > Stop/reboot > `Reboot`) or via the command line interface : ``sudo reboot now``.

## Debugging
Following some system, Yunohost or app updates, Collabora may display an error message such as "It's embarrassing...". To put things back in order, you just have to restart the docker machine, with the command ``systemctl restart docker``.
