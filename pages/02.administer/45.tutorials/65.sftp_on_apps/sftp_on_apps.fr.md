---
title: Donner la permission SFTP d'éditer une application
template: docs
taxonomy:
    category: docs
routes:
  default: '/sftp_on_apps'
---

Dans YunoHost, depuis la gestion des permissions par l'interface d'administration web, vous pouvez spécifier quel utilisateur peut accéder à votre système à travers SFTP.

Cependant ces utilisateurs sont chrootés dans leur répertoire home pour des raisons de sécurité.

Si vous désirez donner accès à une application spécifique à travers SFTP, voici les actions à faire après avoir donné les droits à l'utilisateur dans l'interface d'adminstration web.

Dans les instructions suivantes USER est l'utilisateur à qui sont données les permissions d'éditer des fichiers wordpress.

```bash
mkdir -p /home/USER/apps/wordpress
touch /home/USER/.nobackup
mount --bind /var/www/wordpress /home/USER/apps/wordpress
echo "/var/www/wordpress /home/USER/apps/wordpress none defaults,bind 0 0" >> /etc/fstab
find /var/www/wordpress -type d -exec chmod g+s {} \;

setfacl -R -m u:wordpress:rwX /var/www/wordpress
setfacl -R -d -m u:wordpress:rwX /var/www/wordpress
setfacl -m u:wordpress:r-- /var/www/wordpress/wp-config.php

setfacl -R -m u:USER:rwX /var/www/wordpress
setfacl -R -d -m u:USER:rwX /var/www/wordpress
```
