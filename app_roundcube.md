#<img src="https://yunohost.org/images/roundcube.png">Roundcube - Webmail

Roundcube is a web client for email messaging also called webmail.

### Install CardDAV support for Roundcube

Roundcube allows you to synchronize your contacts with a CardDAV server, through a third party plugin. Using a CardDAV server like Radicale or owncloud's "Contacts" application, both available in YunoHost, allows you to centralize and manage your contacts.

Similarly to IMAP that allows you to synchronize your emails with your mail server, CardDAV allows you to access your contacts through multiple clients, such as Roundcube. 
Thanks to CardDAV, you will not have to import your contacts in each of your devices.

CardDAV support requires a third party plugin, developped by par Christian Putzke.


Follow the instructions to install:

* Connect to your server (physically or through SSH): 
```bash
ssh admin@your_server_ip
```

* Next you'll need to gain administrator rights (root user): `sudo su`

* Move to the Roundcube plugin directory (plugins):
```bash
cd /var/www/roundcube/plugins/
```

* Download plugin:
```bash
git clone https://github.com/christian-putzke/Roundcube-CardDAV/
```

* Rename downloaded folder to carddav: 
```bash
mv Roundcube-CardDAV carddav
```

* Get MySQL "root" password:
```bash
cat /etc/yunohost/mysql
```

* Add the plugin necessary SQL tables:
```bash
mysql -u root -p roundcube < carddav/Roundcube-CardDAV/SQL/mysql.sql
```

* Type in the MySQL root password and press `Enter`.

* Open Roundcube configuration file:
```bash
nano /var/www/roundcube/config/main.inc.php
```

* Look for Plugins section using the nano search function (Ctrl-W) and identify the line beginning with `$rcmail_config['plugins'] = array('carddav','http_authentication', 'archive', 'new_user_identity'` 

* Add "carddav" at the beginning, in order to result to the following: `array('carddav','http_authentication', 'archive', 'new_user_identity'`

* Exit nano by pressing `Crtl-X` and save.

* Finally, type:
```bash
cp /var/www/roundcube/plugins/carddav/config.inc.php.dist /var/www/roundcube/plugins/carddav/config.inc.php
```

Now, you just have to connect to your Roundcube application, select Parameters located at the top right corner, then select CardDAV in the left panel.

Synchronize your owncloud contacts:

* Go to Contacts section of your owncloud application and click on the gear wheel icon located at the bottom left. Then, click on CardDAV link and copy the URL that appeared.

* Go to Roundcube's CardDAV section and type in ownCloud in Label field, paste the previously copied URL and type your username and password. 

Your contacts are now synchronized! 

Note that even if Roundcube may complain about some time out but process is working.