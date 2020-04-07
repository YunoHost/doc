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

------------------------------------

# <img src="/images/APPLICATION_logo.svg" width="80px" alt="APPLICATION's logo"> APPLICATION

[![Install APPLICATION with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=APPLICATION) [![Integration level](https://dash.yunohost.org/integration/APPLICATION.svg)](https://dash.yunohost.org/appci/app/APPLICATION)

- [Configuration](#Configuration)
- [Limitations with YunoHost](#limitations-with-yunohost)
- [Customer Applications](#Customer-applications)
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
