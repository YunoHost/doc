Emails
======

YunoHost est livré avec un écosystème complet de serveur mail, vous permettant d'héberger votre propre serveur de messagerie, et donc d'avoir vos propres adresses email dans `quelquechose@votre.domaine.tld`.

Cet écosystème comprend un serveur SMTP (postfix), un serveur IMAP (Dovecot), un antispam (rspamd) et une configuration DKIM.

S'assurer que votre configuration est correcte
-------------------------------

Les emails sont un écosystème compliqué et un grand nombre de détails peuvent les empêcher de fonctionner correctement.

Pour valider que votre configuration est correcte :
- si vous vous hébergez chez vous et n'utilisez pas de VPN, assurez-vous que [votre FAI ne bloque pas le port 25](isp) ;
- routez les ports selon [cette documentation](isp_box_config) ;
- configurez soigneusement les enregistrements DNS du courrier électronique selon [cette documentation](dns_config) ;
- Testez votre configuration en utilisant [Mail-tester.com](https://mail-tester.com) <small>(attention : seuls 3 tests par domaine et par jour sont autorisés)</small> ;

Un score d'au moins 8~9/10 est un but raisonnable.

Clients de messagerie
-------------

Pour interagir avec le serveur de mail, c'est-à-dire lire et envoyer des emails, vous pouvez soit installer un client web comme Roundcube ou Rainloop sur votre serveur - ou configurer un client de bureau ou mobile comme décrit dans [cette page](email_configure_client).

Les clients de bureau ou mobile ont l'avantage de copier vos emails sur l'équipement permettant ainsi la consultation hors ligne et une protection relative face à d'éventuelles pannes matériel de votre serveur.

Configuration des alias de messagerie et des redirections automatiques
-------------------------------------------

Des alias de messagerie et des redirections peuvent être configurés pour chaque utilisateur. Par exemple, le premier utilisateur créé sur le serveur dispose automatiquement d'un alias `root@votre.domaine.tld` - ce qui signifie qu'un email envoyé vers cette adresse se retrouvera dans la boîte de réception de cet utilisateur. Les redirections automatiques peuvent être configurées, par exemple si un utilisateur ne veut pas configurer un compte de messagerie supplémentaire et souhaite simplement recevoir des courriels du serveur sur, disons, son adresse gmail.

Une autre fonctionnalité méconnue est l'utilisation de suffixe commencant par "+". Par exemple, les emails envoyés à `johndoe+sncf@votre.domaine.tld` atteriront dans le dossier 'sncf' de la boîte mail de John Doe (ou bien directement dans la boîle mail si ce dossier n'existe pas). C'est une technique pratique pour par exemple fournir une adresse mail à un site puis facilement trier (via des filtres automatiques) les courriers venant de ce site.

Que se passe-t-il si mon serveur devient indisponible ?
-----------------------------------------------

Si votre serveur devient indisponible, les courriels envoyés à votre serveur resteront dans une file d'attente du côté de l'expéditeur pendant environ 5 jours. L'hébergeur de l'expéditeur tentera régulièrement de renvoyer le courrier, jusqu'à ce qu'il le jette s'il n'a pas pu l'envoyer.

## Formulaires pour enlever son adresse IP des listes noires
Il est possible que les emails envoyés depuis votre instance YunoHost soient considérés comme du spam par les grands services de mails.
Il est possible que l’adresse IP de votre serveur a autrefois été utilisé pour envoyé du spam ou que ces services de mails considèrent votre serveur comme émetteur de spams.
Pour s’assurer que l’adresse IP de votre serveur n’est pas dans ces listes et pour l’enlever dans le cas échéant suivez ce [lien](/blacklist_forms_fr).


Pour aller plus loin
--------------------

- Il existe une page de documentation pour [migrer ses emails d'un fournisseur de messagerie vers une instance YunoHost](email_migration).
- Pour approfondir votre compréhension du courriel et de ses protocoles, voici une [conférence éclairante](https://www.iletaitunefoisinternet.fr/post/7-email-sonntag/)(en français).
