---
title: Concedere permessi SFTP per modificare un'applicazione
template: docs
taxonomy:
    category: docs
routes:
  default: '/sftp_on_apps'
---

Nell'interfaccia di amministrazione web di YunoHost nella sezione gestione permessi potete specificare gli utenti che possono accedere al sistema via SFTP.

D'altro canto questi utenti hanno un chroot nella loro home directory per ragioni di sicurezza.

Se volete dare accesso a delle specifiche applicazioni attraverso SFTP sono necessari alcuni passaggi ulteriori dopo aver concesso i permessi SFTP nell'interfaccia di amministrazione via web.

Nelle istruzioni qui sotto USER è l'utente al quale volete dare il permesso di modifica dei file di wordpress.

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



