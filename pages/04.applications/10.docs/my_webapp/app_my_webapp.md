---
title: My_webapp
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_my_webapp'
---
In addition to the [Readme_en.md](https://github.com/YunoHost-Apps/my_webapp_ynh/blob/testing/README_fr.md) of the application, here are some useful tips.

## Automatic update of the site content.
The application creates a new user with limited rights: he can connect (with a password) in SFTP to access the `/var/www/my_webapp` folder (or `/var/www/my_webapp__<numero>` if there are several installations of this application).

This configuration forces you to update the content of the site by hand, with a password login.
If you want to automate things, you need a connection option without a password to type (called "non-interactive").

Here are the steps to do this:

### On your computer
- Create a public/private key pair, on the client computer and WITHOUT putting a passphrase. (example for an RSA key `ssh-keygen -t rsa -b 4096`)

>By default your keys are in `~/.ssh/your_key` for the private key and `~/.ssh/your_key.pub` for the public key.
- Open a terminal,
- Connect to your YunoHost server with SSH `ssh -p XXX admin@ndd` (`-p` is optional, if you have changed the default SSH port),
- Enable public key login, in `/etc/ssh/sshd_config` (if not already done), with the command `nano /etc/ssh/sshd_config`,
```
PubkeyAuthentication yes
```
- CTRL+X to save
- `sudo service sshd restart` to take over the new settings.

- Switch to `root` via the command `sudo -i`,

>WARNING: You now have full rights to your server.
- Create a `.ssh` folder in `/var/www/my_webapp(__#)` or `/var/www/my_webapp` (if your site is at the root of your ndd) (e.g. `mkdir /var/www/my_webapp/.ssh`),
- place yourself in this folder (e.g. `cd /var/www/my_webapp/.ssh`),
- Create an `authorized_keys` file via the `nano authorized_keys` command,
- Paste the contents of `your_key.pub` generated in step XX,
- Move to the `my_webapp` folder (`cd ./..` or `cd /var/www/my_webapp`),
- Enter the user `my_webapp` who owns the file and folder `chown -hR my_webapp .ssh`,
- Check with the following command `ls -l -a` you should get :
```
root@ndd:/var/www/my_webapp# ls -l -a
total 16
drwxr-x---+ 4 root root 4096 Jan 12 10:56 .
drwxr-xr-x+ 14 root root 4096 Jan 12 10:47 .
drwxr-xr-x 2 my_webapp root 4096 Jan 12 10:57 .ssh
drwxr-xr-x 2 my_webapp www-data 4096 Jan 12 10:47 www
```
- Open another terminal and test the connection via the command `sftp -i ~/.ssh/your_cle -P XXXX my_webapp@ndd`.
```
user@pc_client:~$ sftp -i ~/.ssh/your_cle -P XXXXX my_webapp@ndd
Debian GNU/Linux 11
Connected to ndd.
sftp>
```

>The `-i` and `-P` options are not required if you have a single generated key and/or if your port is the default 22.
You can now connect without a password, with `sftp -b`, `lftp` or other SFTP clients.

>NB: The port number to use for the SFTP connection is the one used for SSH, and configured in `/etc/ssh/sshd_config`.
This trick allows you to automatically update your site. For example, the Makefile for the Pelican tool allows you to use `make ftp_upload`.
