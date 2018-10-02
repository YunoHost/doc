#Baïkal

Baïkal is a server for calendars and address book, which used CalDav and CardDav protocol. Baïkal can be synced with a lot of client like Thunderbird + Lightning.

**WARNING**: Baikal will not work if you have installed a **Nextcloud** ( their cardav/caldav functions conflict).

### Web admin connection
In SSO portal, click on "Baïkal", a link lead to a web page showing a message saying that the service is running. To acces the admin web page, add `/admin` to the URL. For example:

https://domain.org/baikal/admin

The user name specified is "admin" followed by the specific password choosen at Baïkal installation procedure. Please note, the password should not contain special characters.

### Example of creating a new user:

Add users to the "Users and resources" tab.

## CalDAV Connection

### Connection with Thunderbird + Lightning

Add a new agenda with type "Network" and "CalDAV"

The new URL to add is :

https://domain.org/baikal/cal.php/calendars/username/default

Be careful to replace "domain.org" by your own domain and the "username" by your user name.

### Connection to AgenDAV

AgenDAV is a web client for using your calendars. It's packaged for Yunohost and you can used it after installing Baïkal.

AgenDAV is already connected to Baïkal, any other configuration is necessary. If you create a new entry in Thunderbird + Lightning calendar, refresh your AgenDAV page is enough to see your modifications.

AgenDAV also allows you to create a new calendars very easily.

## CardDAV Connection
### Roundcube Connection

Add new adressbook by navigating to Parameters > Preferences > CardDAV.

Make sure it is filled with:
* Addressbook name: `default`
* Username: `username`
* Password: `thePasswordAssociatedToUsername`
* URL : `https://example.com/baikal/card.php/addressbooks/username/default`

* Make sure to replace "example.com" with your domain and "username" with your username*

Save.

Now, the adressbook is accessible.
