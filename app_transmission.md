# <img src="/images/transmission.png">Transmission

### What is  Transmission?

Transmission is a share software based on BitTorrent protocol.
* [Transmission web site](http://transmissionbt.com/)

### How to download completed files?

If Transmission is installed on `/torrent/`, you could download your completed files to the following address: https://your-domain-name.org/torrent/downloads/

### Sending files towards server for seeding

In YunoHost, completed files are saved in: `/home/yunohost.transmission/completed`

#### With SFTP

With your [file manager](https://en.wikipedia.org/wiki/File_manager) (under GNU/Linux) do `CTRL + L` then enter:

```bash
sftp://<user>@<your-domain.org>/home/yunohost.transmission/completed
```
user = admin or root

#### With SCP (complex)
To transfer file, type in the following command:

```bash
scp (-r) /your/file/ root@your-domain.org:/home/yunohost.transmission/completed
```

##### How to download a complete folder?
Once connected to your server, using [SSH](ssh), move to the download folder and zip it :
```bash
cd /home/yunohost.transmission/completed
zip -r your_archive.zip [dossier]
```

More informations about file transfer using *scp*: http://doc.ubuntu-fr.org/ssh#transfert_-_copie_de_fichiers (french, need english documentation)

--------------------------------------------------

# <img src="/images/APPLICATION_logo.svg" width="80px" alt="APPLICATION's logo"> APPLICATION

[![Install APPLICATION with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=APPLICATION) [![Integration level](https://dash.yunohost.org/integration/APPLICATION.svg)](https://dash.yunohost.org/appci/app/APPLICATION)

### Index

- [Configuration](#configuration)
- [Limitations with YunoHost](#limitations-with-yunohost)
- [Customer Applications](#customer-applications)
- [Useful links](#useful-links)

**General presentation of the application.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Configuration

**If the configuration of the application is not done with the admin panel of YunoHost.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Limitations with YunoHost

**Explanation of the current limitations in using the application with YunoHost.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Customer applications

| Application name | Platform | Multi-account | Other supported networks | Play Store | F-Droid | Apple Store | *Other* |
|------------------|----------|---------------|--------------------------|------------|---------|-------------|---------|
|                  |          |               |                          |            |         |             |         |

## Useful links

+ Website: [WEBSITE](#)
+ Official documentation: [DOCUMENTATION](#)
+ Application software repository: [github.com - YunoHost-Apps/APPLICATION](https://github.com/YunoHost-Apps/APPLICATION_ynh)
+ Fix a bug or an improvement by creating a ticket (issue): [github.com - YunoHost-Apps/APPLICATION/issues](https://github.com/YunoHost-Apps/APPLICATION_ynh/issues)
