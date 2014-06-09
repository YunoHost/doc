# Upgrade to v2

If you already have a YunoHost version prior to RC (`beta2`, `beta3` or `beta4`), you should proceed to upgrade this way:

## <small>1.</small> System

Connect to your server directly or via SSH, and run the following command:

```bash
sudo apt-get update && sudo apt-get dist-upgrade
```

## <small>2.</small> Applications

Once upgraded, you can upgrade your applications too:

```bash
sudo yunohost app fetchlist
sudo yunohost app upgrade
```

**Note** : If you had installed unofficial applications (other than Roundcube, Jappix, Wordpress, TTRSS, Radicale, Agendav, Owncloud, PHPMyAdmin, Zerobin, Jirafeau or Transmission), you will have to upgrade them manually (or leave them like this).

---

***If you need help during one of these steps, do not hesitate to use [our support tools](/support).***
