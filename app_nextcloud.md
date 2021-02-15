# <img src="/images/nextcloud_logo.png" alt="logo de Nextcloud"> Nextcloud  

 - [Discovering the Nextcloud environment](#EnvironmentNextcloud)  
 - [Mobile and computer client software](#ClientSoftware)  
 - [Useful Manipulations & Problems Encountered](#UtileManipulations)  
    - [Add space to Nextcloud](#AddSpace)  
 - [Third Party Applications](#AppsTiers)  
 - [Useful links](#UsefulLinks)  

Nextcloud is a file hosting service, many applications can be installed to offer it new features such as a calendar, a directory, notes and many others (you can find some applications in the [third-party applications](#AppsTiers) part but there are many others depending on your needs).

## Discovering the Nextcloud environment <a name="EnvironmentNextcloud" href=""></a>

Due to the creation of Nextcloud, a database with third-party applications to install, this chapter will only concern the nextcloud database without added applications. More information on applications in the dedicated section or in the nextcloud application catalogue: [apps.nextcloud.com](https://apps.nextcloud.com).  
Nextcloud is before a cloud service (like Seafile and others), it allows synchronization and file sharing on the Internet and between several terminals (computers, smartphone) but also with several people. 

## Mobile and computer client software <a name="ClientSoftware" href=""></a>

There are client software for all platforms. You can find them on the official nextcloud website: https://nextcloud.com/install/#install-clients

## Useful Manipulations & Problems Encountered <a name="UtileManipulations" href=""></a>

### Add storage space <a name="AddSpace" href=""></a>

Solution I. allows you to add a link to a local or remote folder.  
Solution II. allows to move the main storage space of Nextcloud.

#### I. Add an external storage space

Parameter =>[Administration] External storage.

At the bottom of the list you can add a folder (It is possible to define a subfolder using the `folder/subfolder` convention.)  
Select a storage type and specify the requested connection information.  
You can restrict this folder to one or more nextcloud users with the column `Available for`.  
With the gear you can allow or prohibit previewing and file sharing.  
Finally click on the check mark to validate the folder.

#### II. Migrate Nextcloud data to a larger partition

**Note**: The following assumes that you have a hard disk mounted on `/media/storage`. Refer to[this article](/external_storage) to prepare your system.

**Note**: Replace `nextcloud` with the name of its instance, if you have several Nextcloud apps installed.

First turn off the web server with the command:
```bash
systemctl stop nginx  
```

##### Choice of location

**Case A: Blank storage, exclusive to Nextcloud**

For the moment only root can write to it in `/media/storage`, which means that NGINX and Nextcloud will not be able to use it.

```bash
chown -R nextcloud:nextcloud /media/storage
chmod 775 -R /media/storage
```

**Case B: Shared storage, data already present, Nextcloud data in a subfolder**

If you want to use this disk for other applications, you can create a subfolder belonging to Nextcloud.

```bash
mkdir -p /media/storage/nextcloud_data
chown -R nextcloud /media/storage/nextcloud_data
chmod 775 -R /media/storage/nextcloud_data
```

##### Migrate data

Migrate your data to the new disk. To do this *(be patient, it can take a long time)*:

```bash
Case A: shopt -s dotglob
        cp -a /home/yunohost.app/nextcloud/data /media/storage
Case B: shopt -s dotglob
        cp -a /home/yunohost.app/nextcloud/data /media/storage/nextcloud_data
```

To check that everything went well, compare what these two commands display (the content must be identical):

```bash
ls -la /home/yunohost.app/nextcloud

Case A: ls -al /media/storage
Case B: ls -al /media/storage/nextcloud_data
```

##### Configure Nextcloud

To inform Nextcloud of its new directory, modify the `/var/www/nextcloud/config/config.php` file with the command:

```bash
nano /var/www/nextcloud/config/config.php
```

Look for the line:

```bash
'datadirectory' => '/home/yunohost.app/nextcloud/data',
```

That you modify:

```bash
CASE A:'datadirectory' =>'/media/storage/data',
CASE B:'datadirectory' =>'/media/storage/nextcloud_data/data',
```

Back up with `ctrl+x` then `y` or `o` (depending on your server locale).

Restart the web server:

```bash
systemctl start nginx
```

Run a scan of the new directory by Nextcloud:

```bash
cd /var/www/nextcloud
sudo -u nextcloud php7.3 occ files:scan --all
```

It's over now. Now test if everything is fine, try connecting to your Nextcloud instance, upload a file, check its proper synchronization.

### Nextcloud and Cloudflare

If you use Cloudflare for your DNS, *which may be useful if you have a dynamic IP*, you will most likely have authentication problems with the Nextcloud application. On the Internet many people propose to create a rule that disables all options related to security and Cloudflare speed for the URL pointing to your Nextcloud instance. Although it works, it is not the optimal solution. I propose, certainly to create a rule for the URL pointing to your Nextcloud instance but to disable only 2 options. So here's how:

#### Cloudflare Page Rules

In the Cloudflare control panel select your domain and find Page Rules
the URL in your address bar will look like this: https://dash.cloudflare.com/*/domain.tld/page-rules  

##### Add a rule

The rule to be added must apply to the URL of your Nextcloud instance either:

- `https://nextcloud.domain.tld/**` if you use a subdomain
- `https://domain.tld/nextcloud/*` if you have deployed Nextcloud in a directory

The options to disable (Off) are:

- Rocket Loader
- Email Obfuscation

Save and clean your caches (Cloudflare, browser...) and that's it.

## Third Party Applications <a name="AppsTiers" href=""></a>

 - [Calendrier](app_nextcloud_calendar)
 - [Contact](app_nextcloud_contact)
 - [KeeWeb](app_nextcloud_keeweb)
 - [Carnet](app_nextcloud_carnet)

## Useful links <a name="UsefulLinks" href=""></a>

 - Official website: [nextcloud.com](https://nextcloud.com/)  
 - Application catalogue for Nextcloud: [apps.nextcloud.com](https://apps.nextcloud.com/)  
