# Messagerie électronique

### Relever ses courriels
#### Le Webmail Rouncube
Pour relever simplement ses [courriels](https://fr.wikipedia.org/wiki/Courrier_%C3%A9lectronique), Yunohost propose [Rouncube](https://roundcube.net/), un client webmail que vous pouvez installer depuis l'interface d'administration :

<img src="https://yunohost.org/images/mailview.jpg" width=650>

#### Client de messagerie alternatif
Vous pouvez également configurer un [client de messagerie indépendant](email_configure_client_fr), pour par exemple relever les messages de plusieurs adresses courriel simultanément ou [relever vos courriels depuis un smartphone](email_configure_client_fr#K9mail).

### Configurations supplémentaires pour la messagerie

#### Configurer les DNS MX
Si vous avez opté pour un nom de domaine personnel, il est nécessaire de [configurer votre serveur DNS](/dns_config_fr) pour faire fonctionner la messagerie électronique.

#### Ouverture des ports
Vérifiez également que les ports correspondant à la messagerie (n° 25, 465, 993) sont bien ouverts au niveau de votre box/routeur : [Ouverture des ports de la box](/isp_box_config_fr)

#### Configurer l'authentification DKIM/SPF (facultatif)
Le protocole SMTP ne prévoit pas de mécanisme de vérification de l'expéditeur. Il est donc possible d'envoyer un courrier avec une adresse d'expéditeur factice ou usurpée. SPF et DKIM sont deux méchanismes possible d'authentification de l'expéditeur d'un email : [configurer DKIM/SPF](dkim_fr)

### Résoudre les problèmes

#### Votre serveur est sur une liste noire...

Si les courriels envoyés à un type d'adresse spécifique (par exemples les adresses gmail) n'arrivent pas à destination, votre serveur (son adresse IP) a peut être été ajouté à la liste noire du fournisseurs d'adresse courriel en question : [formulaires de retrait de liste noires](blacklist_forms_fr)

### Aller plus loin
La messagerie électronique est basée sur les protocoles SMTP pour l'envoi de mail et IMAP (ou anciennement POP3) pour la récupération des messages depuis un serveur. En arrière plan, Yunohost fournit :
* [Postfix](http://www.postfix.org/) en tant que serveur SMTP.
* [Dovecot](http://www.dovecot.org/) pour le serveur IMAP.
* [Amavis](http://amavis.org/) logiciel antispam, filtrant les messages indésirables.

Pour approfondir votre compréhension du courriel et de ses protocoles, voici une [conférence éclairante](https://www.youtube.com/watch?v=f_ORZDNHMXM) (en français).



### Sommaire
* [Migration emails](email_migration_fr)