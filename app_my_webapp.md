# Documentation My_webapp

In addition to the application's Readme.md, here are some useful tips.

## Automatic update of the site content

The application creates a new user with limited rights: it can connect (with a password) through SFTP to access the `/var/www/my_webapp` directory (or `/var/www/my_webapp__<number>` if there are several installations of this application).

This configuration requires updating the site content manually, with a password connection.

If you want to automate things, you need to be able to connect without typing a password (i.e. "non-interactive"). Here are the steps to follow to get there:
- Enable public key connection, in `/etc/ssh/ssh/sshd_config`, on the server
- Create a public/private key pair for your script on the "writing" computer - without a protective passphrase.
- Copy the public key to the server, in `/var/www/my_webapp(__#)/.ssh/authorized_keys`
- Set the user `webapp#` as owner of the file and directory
- You can now connect without a password, with `sftp -b`, `lftp` or other SFTP clients.

NB: The port number to use for the SFTP connection is the one used for the SSH, and configured in `/etc/ssh/sshd_config`.

This tip allows you to automatically update your site. For example, the makefile of the Pelican tool allows you to use `make ftp_upload`.
