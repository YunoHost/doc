# The KeeWeb application for NextCloud

The KeeWeb application is a password manager integrated into Nextcloud. For example, it allows you to read a KeePass file (*.kdbx*) stored on your Nextcloud instance.
But sometimes Nextcloud does not let the application support these files, which makes it impossible to read them from KeeWeb. To remedy this,
[a solution](https://github.com/jhass/nextcloud-keeweb/blob/master/README.md#mimetype-detection) exists.

Go to the Nextcloud configuration directory:

```bash
cd /var/www/nextcloud/config/
```

If it does not exist, create the *mimetypemapping.json* file whose owner is the user *nextcloud* :

```bash
sudo su nextcloud -c "nano mimetypemapping.json"
```

Then add in this file the following text:

```bash
{
    "kdbx": ["x-application/kdbx"]
}
```

Save the file (**CTRL** + **o**) and exit nano (**CTRL** + **c**).

Then run a scan by executing next command as root:

```bash
sudo -u nextcloud php /var/www/nextcloud/occ files:scan --all
```

Now the problem is fixed.
