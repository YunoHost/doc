#<img src="/images/roundcube.png">Roundcube - Webmail

Roundcube is a web client for email messaging also called webmail.

### Synchronize your contacts

Roundcube offers you at the installation to synchronize your contacts with a CardDAV server, through a third party plugin. Using a CardDAV server like Baïkal or ownCloud's "Contacts" application, both available in YunoHost, allows you to centralize and manage your contacts.

Similarly to IMAP that allows you to synchronize your emails with your mail server, CardDAV allows you to access your contacts through multiple clients, such as Roundcube. Thanks to CardDAV, you will not have to import your contacts in each of your devices.

Note that addressbooks defined in Baïkal or ownCloud will be automatically added in Roundcube for each user if they are already installed.

----

In case you've installed ownCloud after, here is how to add your addressbooks:

* Go to "Contacts" section of your owncloud application and click on the gear wheel icon located at the bottom left. Then, click on "CardDAV link" and copy the URL that appeared.

* Go to Roundcube's CardDAV section and type in "ownCloud" in "Label" field, paste the previously copied URL and type your username and password. Your contacts are now synchronized!
