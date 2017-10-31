# Administrator web interface

Yunohost has an administrator web interface. The other way to administer your Yunohost install is through the [CLI called "moulinette"](/moulinette)

**Please note** that the web interface is an active work-in-progress and has far fewer features than the CLI moulinette.


### Access

You can access your administrator web interface at this address: https://example.org/yunohost/admin (replace 'example.org' with your own domain name)

<div class="text-center" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">
<img src="/images/manage_en.png" style="max-width:100%;">
</div>


### Reset admin password

To reset the admin password (as root) :

```bash
$ yunohost-reset-ldap-password
```

A temporary password will be created, which you can use to define the new password.


### How to move application folder

To change an application folder, only a few commands are needed: move content, create a symlink and set access rights.

Sample with WordPress:
```bash
# Move wordpress folder to an external hard drive
$ sudo  mv /var/www/wordpress /media/externalharddrive 
# Symbolic link
$ sudo   ln -s /media/externalharddrive/wordpress /var/www/wordpress
# Folder must belong to www-data
$ sudo  chown -R www-data:www-data /media/externalharddrive/wordpress
```
