#<img src="https://yunohost.org/images/roundcube.png">Roundcube - Webmail libre

Roundcube est un client web de courrier électronique libre ou webmail.



### Installer le support CardDAV pour Roundcube

Roundcube vous permet, via un greffon tiers, de synchroniser vos contacts avec un serveur CardDAV. Utiliser un serveur CardDAV comme Radicale ou l'application "Contacts" d'ownCloud, tous deux disponibles pour YunoHost, a l'avantage de permettre une gestion centralisée de vos contacts. 

De la même façon que le protocole IMAP vous permet de synchroniser vos courriels avec votre serveur mail, CardDAV vous permet d'avoir accès à vos contacts depuis une multitude de clients, dont Roundcube. Avec CardDAV, nous n'aurez donc plus besoin d'importer vos contacts dans chaque client.

Le support de CardDAV nécessite l'installation d'un greffon tiers, développé par Christian Putzke.

Pour l'installer, suivez les indications suivantes :

* Accédez à votre serveur physiquement ou connectez-vous à distance par le biais de SSH : `ssh admin@ip_de_votre_serveur`.

* Il vous faudra ensuite obtenir les droits de l'administrateur (utilisateur "root") en tapant `sudo su`.

* Placez-vous dans le répertoire des greffons ("plugins") de Roundcube : `cd /var/www/roundcube/plugins/`.

* Téléchargez le greffon qui nous intéresse en tapant `git clone https://github.com/christian-putzke/Roundcube-CardDAV/`.

* Renommez le dossier téléchargé en "carddav" : `mv Roundcube-CardDAV carddav`.

* Notez (ou copiez) le mot de passe de l'utilisateur "root" de votre base MySQL qui s'affichera en tapant `cat /etc/yunohost/mysql`.

* Ajoutez les tables SQL nécessaires au greffon en tapant `mysql -u root -p roundcube < carddav/Roundcube-CardDAV/SQL/mysql.sql`

* Entrez le mot de passe que vous venez de noter et appuyez sur Entrée.

* Ouvrez le fichier de configuration de Roundcube : `nano /var/www/roundcube/config/main.inc.php`.

* Cherchez la section "Plugins" en utilisant la fonction de recherche de nano (Ctrl-W) et identifiez la ligne qui commence par `$rcmail_config['plugins'] = array('carddav','http_authentication', 'archive', 'new_user_identity'` 

* Modifiez le début de la ligne en ajoutant l'élément "carddav", de sorte à obtenir ceci : `array('carddav','http_authentication', 'archive', 'new_user_identity'`

* Quittez nano en tapant Crtl-X sans bien entendu oublier d'enregistrer le fichier modifié.

* Pour finir, tapez `cp /var/www/roundcube/plugins/carddav/config.inc.php.dist /var/www/roundcube/plugins/carddav/config.inc.php`

Il vous suffit ensuite de vous connecter à Roundcube via votre panneau YunoHost et de cliquer sur "Paramètres" en haut à droite, puis sur "CardDAV" à gauche.

Pour synchroniser vos contacts ownCloud :

* Rendez-vous dans la section "Contacts" de votre espace ownCloud et cliquez sur l'icône représentant une roue dentée en bas à gauche. Ensuite cliquez sur l'icône "Lien CardDAV" et copiez l'URL qui s'affiche en-dessous.

* Rendez-vous ensuite dans la section CardDAV des paramètres de Roundcube et entrez "ownCloud" dans le champ "Label", collez l'URL que vous venez de copier et enfin entrez votre nom d'utilisateur et votre mot de passe. Vos contacts sont désormais synchronisés ! Notez que Roundcube risque de se plaindre d'un "time out", mais le processus fonctionne quand même.








