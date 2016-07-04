# Administrator web interface

Yunohost has an administrator web interface. The other way to administer your Yunohost install is through the [CLI called "moulinette"](/moulinette)

**Please note** that the web interface is an active work-in-progress and has far fewer features than the CLI moulinette.

### Access

You can access your administrator web interface at this address: https://example.org/yunohost/admin (replace 'example.org' with your own domain name)

<div class="text-center" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">
<img src="/images/manage_en.png" style="max-width:100%;">
</div>

### Reset admin password

<div class="text-error">Deprecated method, will not work on Yunohost 2.4 / Debian Jessie</div>

To reset YunoHost admin password (Need a root user available)

add the following lines to `/etc/slapd/slapd.conf`:
```bash
rootdn "cn=admin,dc=yunohost,dc=org"
rootpw {SSHA}O4kkm2OkgO2DPrrnYXXXXXXXXXXXXXXX
```

where the hash in the last line comes from (or at least that's my understanding)
```bash
slappasswd -h {SSHA}
# A password will be ask, and you'll get the corresponding hash
```

Once the lines are added, [here you might need to restart the ldap service ?], you should be able to connect to the admin interface, rechange the password properly, remove the lines you added in slapd.conf, and that should be all.

### How to move application folder

Sample with WordPress:
```bash
# Move wordpress folder to an external hard drive
$ sudo  mv /var/www/wordpress /media/externalharddrive 
# Symbolic link
$ sudo   ln -s /media/externalharddrive/wordpress /var/www/wordpress
# Folder must belong to www-data
$ sudo  chown -R www-data:www-data /media/externalharddrive/wordpress
```
