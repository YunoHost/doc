# Messagerie électronique

### Relever ses courriels
#### Le webmail Rouncube
Pour relever simplement ses [courriels](https://fr.wikipedia.org/wiki/Courrier_%C3%A9lectronique), le client webmail [Rouncube](https://roundcube.net/) est proposé dans YunoHost. Il est installable depuis l’interface d’administration :

<img src="https://yunohost.org/images/mailview.jpg" width=650>

#### Client de messagerie alternatif
Vous pouvez également configurer un [client de messagerie indépendant](email_configure_client_fr), pour par exemple relever les messages de plusieurs adresses de courriels simultanément ou [relever vos courriels depuis un smartphone](email_configure_client_fr#Android)<!-- proposer plus de clients et rendre plus verbeux -->.

#### Transférer ou migrer ses mails vers un autre serveur
Suivez [ce guide](email_migration_fr)<!-- à clarifier --> pour transférer vos mails sur votre serveur YunoHost en utilisant le protocole IMAP.

### Configurations supplémentaires pour la messagerie
#### Configurer les DNS MX
Si vous avez opté pour un nom de domaine personnel, il est nécessaire de [configurer votre serveur DNS](/dns_config_fr)<!-- explication spécifique des DNS MX à ajouter sur cette page--> pour faire fonctionner la messagerie électronique.

#### Ouverture des ports
Vérifiez également que les ports correspondant à la messagerie (n° 25, 465 et 993) sont bien ouverts au niveau de votre box ou de votre routeur. [Tutoriel d’ouverture des ports de la box](/isp_box_config_fr).

#### Configurer l’authentification DKIM/SPF (facultatif)
Le protocole SMTP ne prévoit pas de mécanisme de vérification de l’expéditeur. Il est donc possible d’envoyer un courrier avec une adresse d’expéditeur factice ou usurpée. SPF et DKIM sont deux mécanismes possible d’authentification de l’expéditeur d’un email. [Tutoriel pour configurer DKIM/SPF](dkim_fr).<!-- compliqué, à clarifier ? -->

### Résolution de problèmes
#### Votre serveur est sur une liste noire…
Si les courriels envoyés à un type d’adresse spécifique (par exemples les adresses Gmail) n’arrivent pas à destination, votre serveur (son adresse IP) a peut être été ajouté à la liste noire du fournisseur d’adresse courriel en question. Pour résoudre ce problème voici les [formulaires de retrait de liste noires](blacklist_forms_fr).

#### Consulter les fichiers de log pour identifier le problème
De nombreux messages permettant d’identifier les problèmes se trouvent enregistrés dans les fichiers de log du système. [Apprenez à les consulter](check_logfile_fr), pour pouvoir mieux comprendre ce qui cloche et trouver de l’aide sur le forum ou le salon de support.

<!-- ajouter une doc pour consulter ses logs des services mail -->

### Aller plus loin
La messagerie électronique est basée sur les protocoles SMTP pour l’envoi de mail et IMAP (ou anciennement POP3) pour la récupération des messages depuis un serveur. En arrière plan, YunoHost fournit :
* [Postfix](http://www.postfix.org/) en tant que serveur SMTP.
* [Dovecot](http://www.dovecot.org/) pour le serveur IMAP.
* [Amavis](http://amavis.org/) logiciel antispam, filtrant les messages indésirables.

Pour approfondir votre compréhension du courriel et de ses protocoles, voici une [conférence éclairante](https://www.youtube.com/watch?v=f_ORZDNHMXM)<!-- le site iletaitunefoisinternet est inaccessible. S'il revient virer ce youtube.--> (en français).