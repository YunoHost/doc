# <img src="https://yunohost.org/images/transmission.png">Transmission

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

