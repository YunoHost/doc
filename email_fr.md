# Messagerie électronique

### Relever ses courriels
#### Le Webmail Rouncube
Pour relever simplement ses [courriels](https://fr.wikipedia.org/wiki/Courrier_%C3%A9lectronique), Yunohost propose [Rouncube](https://roundcube.net/), un client webmail que vous pouvez installer depuis l'interface d'administration :

<img src="https://yunohost.org/images/mailview.jpg" width=650>

#### Client de messagerie externe
Vous pouvez également configurer un [client de messagerie indépendant](email_configure_client_fr), pour par exemple relever les messages de plusieurs adresses courriel simultanément ou relever vos courriels depuis un smartphone.

### Configuration pour la messagerie

#### Configurer les DNS MX
Si vous avez opté pour un nom de domaine personnel, il est nécessaire de [configurer votre serveur DNS](/dns_config_fr) pour faire fonctionner la messagerie électronique.

#### Ouverture des ports
Vérifiez également que les ports correspondant à la messagerie (n° 25, 465, 993) sont bien ouverts au niveau de votre box/routeur : [Ouverture des ports de la box](/isp_box_config_fr)

### Aller plus loin
La messagerie électronique est basée sur les protocoles SMTP pour l'envoi de mail et IMAP (ou anciennement POP3) pour la récupération des messages depuis un serveur. En arrière plan, Yunohost fournit :
* [Postfix](http://www.postfix.org/) en tant que serveur SMTP.
* [Dovecot](http://www.dovecot.org/) pour le serveur IMAP.
* [Amavis](http://amavis.org/) logiciel antispam, filtrant les messages indésirables.

Pour approfondir la compréhension du courriel et de ses protocoles, voici une [conférence éclairante](https://www.youtube.com/watch?v=f_ORZDNHMXM) (en français).

### Sommaire
* [Ouverture des ports de la box](/isp_box_config_fr)
* [Migration emails](email_migration_fr)
* [Formulaires pour enlever son adresse IP des listes noires](blacklist_forms_fr)
* [Mettre en place DKIM](dkim_fr)