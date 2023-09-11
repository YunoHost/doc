---
title: Emails
template: docs
taxonomy:
    category: docs
routes:
  default: '/email'
---

YunoHost est livré avec un écosystème complet de serveur mail, vous permettant d'héberger votre propre serveur de messagerie, et donc d'avoir vos propres adresses email dans le style `quelquechose@votre.domaine.tld`.

Cet écosystème comprend un serveur SMTP (postfix), un serveur IMAP (Dovecot), un antispam (rspamd) et une configuration DKIM.

## S'assurer que votre configuration est correcte

Les emails sont un écosystème compliqué et un grand nombre de détails peuvent les empêcher de fonctionner correctement.

Pour valider que votre configuration est correcte :
- si vous vous hébergez chez vous et n'utilisez pas de VPN, assurez-vous que [votre FAI ne bloque pas le port 25](/isp) ;
- routez les ports selon [cette documentation](/isp_box_config) ;
- configurez soigneusement les enregistrements DNS du courrier électronique selon [cette documentation](/dns_config) ;
- Testez votre configuration en utilisant les fonctionnalités de diagnostic (`Webadmin > Diagnostic > Email`). Vous pouvez également utiliser le service [mail-tester.com](https://mail-tester.com), un score d'au moins 8~9/10 est un but raisonnable <small>(attention : seuls 3 tests par domaine et par jour sont autorisés)</small> ;

## Clients de messagerie

Pour interagir avec le serveur de mail, c'est-à-dire lire et envoyer des emails, vous pouvez soit installer un client web comme Roundcube ou Rainloop sur votre serveur, soit configurer un client de bureau ou mobile comme décrit dans [cette page](/email_configure_client).

Les clients de bureau ou mobile ont l'avantage de copier vos emails sur l'équipement permettant ainsi la consultation hors ligne et une protection relative face à d'éventuelles pannes matérielles de votre serveur.

## Configuration des alias de messagerie et des redirections automatiques

Des alias de messagerie et des redirections peuvent être configurés pour chaque utilisateur. Par exemple, le premier utilisateur créé sur le serveur dispose automatiquement d'un alias `root@votre.domaine.tld` - ce qui signifie qu'un email envoyé vers cette adresse se retrouvera dans la boîte de réception de cet utilisateur. Les redirections automatiques peuvent être configurées, par exemple si un utilisateur ne veut pas configurer un compte de messagerie supplémentaire et souhaite simplement recevoir des courriels du serveur sur, disons, son adresse Gmail.

Une autre fonctionnalité méconnue est l'utilisation de suffixes commencant par "+". Par exemple, les emails envoyés à `johndoe+sncf@votre.domaine.tld` atteriront dans le dossier 'sncf' de la boîte mail de John Doe (ou bien directement dans la boîte mail si ce dossier n'existe pas). C'est une technique pratique pour, par exemple, fournir une adresse mail à un site puis facilement trier (via des filtres automatiques) les courriers venant de ce site.

Les groupes aussi peuvent utiliser des alias, par défaut le groupe `admins` dispose de `root@<domain.tld>` ou encore `webmaster@<domain.tld>`. [Plus d'information dans la page dédiée](/groups_and_permissions#&eacute;érer-les-alias-des-groupes).

## Que se passe-t-il si mon serveur devient indisponible ?

Si votre serveur devient indisponible, les courriels envoyés à votre serveur resteront dans une file d'attente du côté de l'expéditeur pendant environ 5 jours. L'hébergeur de l'expéditeur tentera régulièrement de renvoyer le courrier, jusqu'à ce qu'il le jette s'il n'a pas pu l'envoyer.

## Formulaires pour enlever son adresse IP des listes noires

Il est possible que les emails envoyés depuis votre instance YunoHost soient considérés comme du spam par les grands services de mails.
Il est possible que l’adresse IP de votre serveur ait, autrefois, été utilisée pour envoyer du spam ou que ces services de mails considèrent votre serveur comme émetteur de spams.
Pour s’assurer que l’adresse IP de votre serveur n’est pas dans ces listes et pour l’enlever dans le cas échéant suivez ce [lien](/blacklist_forms).

## Migration des emails d'un fournisseur d'emails vers une instance de YunoHost

Voir [cette page](/email_migration).

## Configuration du relais SMTP

Voir [cette page](/email_configure_relay).

## Pour aller plus loin

Pour approfondir votre compréhension de l'email et de ses protocoles, voici une [conférence éclairante](https://www.octopuce.fr/conference-lemail-vaste-sujet-par-benjamin-sonntag/) (en français).
