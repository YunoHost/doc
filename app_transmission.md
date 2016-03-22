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