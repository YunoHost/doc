---
title: KeeWeb for Nextcloud
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_nextcloud_keeweb'
---

The KeeWeb application is a password manager integrated into Nextcloud. For example, it allows you to read a KeePass file (*.kdbx*) stored on your Nextcloud instance.

# Fix: .kbdx files don't open in keeweb

Sometimes Nextcloud does not let the application support these files, which makes it impossible to read them from KeeWeb. To remedy this,
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

# Fix: the interface does not load propely

If when opening keeweb you see a glitched interface, try disabling the "Yunohost portal shortcut" in `Yunohost Admin panel` → `Tools` → `Yunohost Settings` → `Other` → `Enable the small 'YunoHost' portal shortcut square on apps` (set to disabled). See https://github.com/jhass/nextcloud-keeweb/issues/143#issuecomment-1686937448
