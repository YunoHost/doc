Emails
======

YunoHost comes with a complete mail stack allowing you to host your own email server, and therefore to have your own email addresses in `something@your.domain.tld`.

The mail stack includes a SMTP server (postfix), an IMAP server (Dovecot), an antispam (rspamd) and DKIM configuration.

Making sure your setup is right
-------------------------------

Mails are a complicated ecosystem and quite a lot of details can cause them to not work properly.

To validate that your setup is right :
- if you are self-hosting at home and not using a VPN, make sur [your ISP won't block port 25](isp) ;
- route ports according to [this documentation](isp_box_config) ;
- carefully configure mail DNS records according [this documentation](dns_config) ;
- test your setup using [Mail-tester.com](https://mail-tester.com) <small>(be careful : only 3 tests per domain per day are allowed)</small> ;

A score of at least 8~9/10 is a reasonnable goal.

Email clients
-------------

To interact with the email sever (read and send emails), you can either install a webclient such as Roundcube or Rainloop on your serveur - or configure a desktop/mobile client as described in [this page](email_configure_client).

Desktop and mobile clients have the advantage of copying your emails to the equipment, allowing offline consultation and relative protection against possible hardware failures of your server.

Configuring email aliases and auto-forwards
-------------------------------------------

Mail aliases and forwards can be configured for each users. For instance, the first user created on the server automatically has an alias `root@the.domain.tld` configured - meaning that sending email to this adress will end in the inbox of this user. Automatic forwards may be configured, for instance if an user doesn't want to configure an additional email account and just want to receive emails from the server on, say, his/her gmail address.

Another feature which few people know about is the use of suffixes beginning with "+". For example, emails sent to `johndoe+booking@votre.domaine.tld` will land in John Doe's mailbox. It is a practical technique for example to provide an e-mail address to a website, then easily sort (via automatic filters) the mail coming from this website.

What happens if my server becomes unavailable ?
-----------------------------------------------

If your server becomes unavailable, emails sent to your server will stay in a pending queue on the sender's side for as long as ~5 days. The sender's hoster will regularly try to resend the mail, until it drops it if it was unable to send it.

Migrating email from an email provider to a YunoHost instance
-------------------------------------------------------------

See [this page](email_migration).
