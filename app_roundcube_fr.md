#<img src="/images/roundcube.png">Roundcube - Webmail libre

Roundcube est un client web de courrier électronique libre ou aussi appelé un webmail.

### Synchronisation des contacts

Roundcube vous propose à l'installation, via un greffon tiers, de pouvoir synchroniser vos contacts avec un serveur CardDAV. Utiliser un serveur CardDAV comme Baïkal ou l’application « Contacts » d’ownCloud, tous deux disponibles pour YunoHost, a l’avantage de permettre une gestion centralisée de vos contacts.

De la même façon que le protocole IMAP vous permet de synchroniser vos courriels avec votre serveur mail, CardDAV vous permet d’avoir accès à vos contacts depuis une multitude de clients, dont Roundcube. Avec CardDAV, nous n’aurez donc plus besoin d’importer vos contacts dans chaque client.

Notez que si Baïkal ou ownCloud sont déjà installés, les carnets d'adresses qui y sont définis seront automatiquement ajoutés pour chaque utilisateur dans Roundcube.

----

Si vous avez installé ownCloud après, voici comment ajouter vos carnets d'adresses :

* Rendez-vous dans la section « Contacts » de votre espace ownCloud et cliquez sur l’icône représentant une roue dentée en bas à gauche. Ensuite, cliquez sur l’icône « Lien CardDAV » et copiez l’URL qui s’affiche en dessous.

* Rendez-vous ensuite dans la section CardDAV des paramètres de Roundcube et entrez « ownCloud » dans le champ « Label », collez l’URL que vous venez de copier et enfin entrez votre nom d’utilisateur et votre mot de passe. Vos contacts sont désormais synchronisés !
