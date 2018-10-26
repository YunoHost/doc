# My_webapp documentation
In addition to the Readme.md of the app, here are some useful tips.
## non-interactive login
This app creates a new user with very limited rights : use of sftp, and access to a `/var/www/my_webapp(__#)` directory. Password login is enabled, with a Chroot to the directory. This forces you to update the contents of the website by hand, with a login and a password input.
To allow non-interactive login, you must follow those steps :
- Enable public-key login in `/etc/ssh/sshd_config`, on the server
- Create a public/private key pair for your script, on your "redacting" computer
- Copy the public key in `/var/www/my_webapp(__#)/.ssh/authorized_keys`
- Adjust the owner of the file and directory to the `webapp#` user
- you may now login without a password input, using  `sftp -b`, `lftp` of other sftp-enabled clients.

NB : The port number to use for sftp connexions is the one used for SSH, specified in `/etc/ssh/sshd_config`.

This setup then allows for auto-update scripts of the site contents. (For example with the Pelican makefile : `make ftp_upload`)
