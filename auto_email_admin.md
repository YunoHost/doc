This article lists the different mails that are sent automatically by different treatments and automated processes from a Yunohost server.

# Prerequisites - email aliases

In Yunohost's administration area, on the first user's file created, there are the following email aliases:

_Email Aliases_

* root@mondomaine.fr
* admin@mondomaine.fr
* webmaster@mondomaine.fr
* postmaster@mondomaine.fr

Any message sent to one of these addresses is sent to the user's primary email address.

Note: all these mails are sent by the mail server running on Yunohost to itself (if the aliases are on the domain linked to the Yunohost machine), 
but can also be sent as a copy to an external e-mail, if the field "Transfer addresses" is also filled in._

# E-mails automatically sent by Yunohost

## Self-diagnostic emails

* Sender: Cron Daemon
* Subject: 'Cron test -x /usr/sbin/anacron || ( cd / && run-parts -report /etc/cron.daily )'
* Recipient: root@mondomaine.fr
* Message body: 
> Automatic diagnosis on mondomaine.fr 'Issues found by automatic diagnosis on mondomaine.fr' The automatic diagnosis on your YunoHost server identified some issues on your server. You will find a description of the issues below. You can manage those issues in the 'Diagnosis' section in your webadmin.

Since version 3.8, Yunohost offers, in graphical form within the administration area and via command line, a complete automatic diagnostic tool
indicating the offsets between the optimum settings for a server and the current situation.

This report is sent periodically, if errors or faults are found, and have not already been set to "ignore".


## Certificate Renewal (Let's Encrypt)

* Sender: certmanager@mondomaine.fr
* Recipient : root@mondomaine.fr
* Subject : Certificate renewing attempt for mondomaine.fr failed !
* Message body : 
> An attempt to renewing the certificate for domain mondomaine.fr failed with the following
error: Certificate renewing for mondomaine.fr failed! Here's the tail of /var/log/yunohost/yunohost-cli.log, which might help to investigate :

Domains and subdomains for which the self-signed certificate has been replaced by a Let's Encrypt certificate have their certificates renewed automatically. 
Sometimes the renewal may have an error (temporary or permanent) which is sent to the administrator.

## Following the installation of an application

* Sender: root
* Topic :`etherpad_mypads` has just been installed
* Recipient: root@mondomaine.fr
* Message body: 
> This is an automated message from your beloved YunoHost server. Specific information for the application etherpad_mypads.

Yunohost's packaging tools allow to propose, when installing a new application, to send an email to the root account with the operation information.
Not all apps use this functionnality.

## Mail not sent

* Sender: MAILER-DAEMON@mondomaine.fr
* Recipient: genma@mondomaine.fr
* Subject: Undelivered Mail Returned to Sender

When you use your mailbox (and thus the Yunohost server as a mail server) and there was a problem sending the mail (unknown recipient or other ...), it informs you of errors.

# The other automatic mails
## Connection alert message

* Sender: user1@mondomaine.fr
* Subject: *** SECURITY information for mondomaine.ynh.fr ***
* Message body: 
> yunohost: Apr 30 12:23:09: user1: 1 incorrect password attempt; TTY=pts/1; PWD=/var/www/nextcloud/config; USER=root; COMMAND=/bin/nano config.php

When you try to log in several times using the `sudo` command and make a typo in your password, the account gets an email informing them of the error (and the potential bruteforce attempt for example).

## The security bulletin

* Sender: daemon@mondomaine.fr
* Recipient: root@mondomaine.fr
* Subject: Debian security status of Yunohost

Not sent by default by Yunohost, this mail is linked to the `Unattended Upgrades` package which can be installed manually, to get automatic security updates on its server.
