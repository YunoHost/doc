---
title: Give SFTP permission to edit an app
template: docs
taxonomy:
    category: docs
routes:
  default: '/sftp_on_apps'
---

In YunoHost permission management web admin interface, you can specify which user can access your system through SFTP.

However, those user are chrooted in their home directory for security reasons.

If you want to give access to a specific apps through SFTP, here are additional steps to do after giving the SFTP permission in the web interface.

In instructions below, USER is the user to whom you wish to give permission to edit wordpress files.

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


