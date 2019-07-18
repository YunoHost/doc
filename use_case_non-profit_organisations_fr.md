# YunoHost for non-profit

## Table of Contents
* [Introduction](#introduction) 
* [Qui ](#qui) 
* [Quoi](#quoi) 
* [Quand](#quand) 
* [Où](#o-) 
* [Pourquoi](#pourquoi) 
* [Comment](#comment) 
* [Conclusion](#conclusion) 

## Introduction

L'objet de ce document est de présenter une utilisation spécifique de [YunoHost](https://yunohost.org/) pour des organisations à but non lucratif.

## Qui

Organisations à but non lucratif, ONG ou tout type d'association.

## Quoi

Les organisations à but non lucratif doivent généralement fournir différents services à différents publics:

* Conseil d'administration / Comité directeur / Bénévoles avec:
  * [Mails](#mails)
  * [Calendrier](#calendrier)
  * [Contact](#contact)
  * [Fichiers partagés / Drive](#fichiers-partag-s)
  * [Communication instantanée](#communication-instantan-e)
  * [Intranet / Base de connaissances](#intranet)
  * [ERP / Comptabilité](#erp-comptabilit-)
* Membres avec:
  * [Site Web public avec accès privé et individuel](#site-web-public)
  * [Adhésion](#adh-sion)
  * [Inscriptions aux événements](#inscriptions-aux-v-nements)
  * [Mailings](#newsletter-mailing)
  * [Forum](#forum)
* Public avec:
  * [Site Web public](#site-web-public)
  * [Newsletter](#newsletter-mailing)

## Quand

Lorsque l'organisation à but non lucratif est prête à franchir le pas.

## Où

Le serveur YunoHost peut être hébergé à différents endroits :
* Hébergement en propre sur un serveur, un ordinateur ou Raspberry derrière ADSL, SDSL ou Fibre
* [Chatons](https://chatons.org), [librehosters](https://framagit.org/librehosters/awesome-librehosters)
* Services d'hébergement commercial fournissant une machine virtuelle Debian

## Pourquoi

YunoHost peut répondre à tous les besoins d'une organisation à but non lucratif et lui permettre de conserver la maîtrise de ses données.

## Comment

### YunoHost

YunoHost est une distribution basée sur Debian GNU/Linux qui automatise l’installation d’un serveur Web personnel. Le but de YunoHost est de permettre aux utilisateurs d’héberger facilement leurs propres services Web en proposant une interface Web simple, pointer-cliquer, pour installer diverses applications Web.

![](https://upload.wikimedia.org/wikipedia/commons/0/07/Yunohost_user_portal.png)

YunoHost fournit immédiatement:
* Un système d'application
* Une interface web
* Une interface de ligne de commande (CLI): Moulinette
* Un serveur Web : Nginx
* Un serveur DNS : Dnsmasq
* Une base de données: MariaDB
* Un système de sauvegarde
* Un SSO: SSOwat
* OpenLDAP
* Email :
  * SMTP: Postfix
  * IMAP & POP3 : Dovecot
  * Un antispam : rspamd, rmilter
* Serveur XMPP de messagerie instantanée : Metronome IM

### Nom de domaine

La première chose dont vous aurez besoin pour implémenter un serveur YunoHost est un nom de domaine. Le nom de domaine peut généralement être fourni avec votre service d'hébergement.

### Mails

De base, YunoHost fournit un système de messagerie disponible en utilisant POP / IMAP / SMTP.
Les comptes de messagerie seront gérés à l'aide de l'interface Web ou de la ligne de commande. Les comptes créés sont stockés dans OpenLDAP.

Des packages supplémentaires peuvent être installés pour fournir davantage de fonctionnalités au système de messagerie YunoHost :
* un webmail en utilisant [Roundcube](https://github.com/YunoHost-Apps/roundcube_ynh), [Rainloop](https://github.com/YunoHost-Apps/rainloop_ynh)
* ActiveSync utilisant [Z-Push](https://github.com/YunoHost-Apps/z-push_ynh)
* Groupe de distribution interne en utilisant [Mailman](https://github.com/YunoHost-Apps/mailman_ynh)

### Calendrier

Pour fournir des calendriers personnels ou partagés, vous devrez installer :
* [Nextcloud](https://github.com/YunoHost-Apps/nextcloud_ynh)
* [Baikal](https://github.com/YunoHost-Apps/baikal_ynh)

### Contact

Pour fournir un système de contact personnel, vous devrez installer :
* [Nextcloud](https://github.com/YunoHost-Apps/nextcloud_ynh)
* [Baikal](https://github.com/YunoHost-Apps/baikal_ynh)

### Fichiers partagés

Pour fournir un système de fichiers partagés : dossiers personnels et dossiers partagés, vous pouvez installer [Nextcloud](https://github.com/YunoHost-Apps/nextcloud_ynh).
Les fichiers seront disponibles à partir d'une interface Web ou à l'aide d'un client de synchronisation.

### Communication instantanée

De base, YunoHost fournit immédiatement un serveur XMPP pour lequel vous pouvez installer un client Web:  [Jappix](https://github.com/YunoHost-Apps/jappix_ynh)

Vous pouvez également installer un serveur Matrix :
* Le serveur: [Synapse](https://github.com/YunoHost-Apps/synapse_ynh)
* Un client web: [Riot](https://github.com/YunoHost-Apps/_ynh)

### Intranet

Pour une organisation à but non lucratif, un bon moyen de mettre en œuvre un intranet est de fournir un wiki permettant aux utilisateurs internes de lire, éditer et ajouter du contenu. Voici quelques paquets pour implémenter un wiki :
* [DokuWiki](https://github.com/YunoHost-Apps/docuwiki_ynh) using wiki syntax
* [Wiki.js](https://github.com/YunoHost-Apps/wikijs_ynh) using markdown syntax

### ERP / Comptabilité

À un moment donné, une organisation à but non lucratif pourrait avoir besoin d’un système de Comptabilité / ERP, voici deux propositions :
* [OpenERP/Odoo](https://github.com/YunoHost-Apps/libreerp_ynh)
* [Dolibarr](https://github.com/YunoHost-Apps/dolibarr_ynh)

### Site Web Public

Il existe plusieurs façons d'implémenter un site Web public :
* Un simple site HTML, CSS, etc... en utilisant : [Custom Webapp](https://github.com/YunoHost-Apps/my_webapp_ynh)
* Utiliser un CMS (système de gestion de contenu) comme  [Wordpress](https://github.com/YunoHost-Apps/_ynh), [Drupal](https://github.com/YunoHost-Apps/drupal_ynh) , [Grav](https://github.com/YunoHost-Apps/grav_ynh), [PluXml](https://github.com/YunoHost-Apps/pluxml_ynh)

Mais nous proposerons quelque chose de plus puissant : [CiviCRM on Drupal 7](https://github.com/YunoHost-Apps/civicrm_drupal7_ynh):
* Drupal qui est un puissant framework de gestion de contenu
* avec CiviCRM qui est un CRM OpenSource à destination des organisations à but non lucratif

#### Adhésion

Avec CiviCRM, vous pourrez mettre en place des adhésions en ligne avec paiement.

#### Inscriptions aux événements

Avec CiviCRM, vous pourrez mettre à disposition un agenda en ligne avec la possibilité pour les membres ou le public de s'inscrire gratuitement ou en payant.

#### Newsletter/Mailing

Le meilleur moyen de gérer cela consiste à utiliser CiviCRM et son module de mailing.

### Forum

Vous avez plusieurs choix, avoir un forum intégré dans Drupal ou utiliser un système de forum dédié tel que [Flarum](https://github.com/YunoHost-Apps/flarum_ynh).

### Sauvegarde

YunoHost fournit son propre système de sauvegarde. Avant toute mise à niveau de paquet, YunoHost sauvegarde la version actuelle du paquet et la restaure automatiquement si la mise à niveau échoue.
Les sauvegardes Yunohost sont stockées localement dans `/home/yunohost.backup/archives`.

Mais pour la production, la sauvegarde stockée localement ne suffit pas, vous devez donc mettre en œuvre des stratégies de sauvegarde supplémentaires :
* Sauvegarde de la machine virtuelle si fournie par le système d'hébergement.
* [Archivist](https://github.com/YunoHost-Apps/archivist_ynh) est un système de sauvegarde automatique de votre serveur. Vos sauvegardes peuvent être envoyées à de nombreux autres endroits, locaux ou distants.
* [Borg](https://github.com/YunoHost-Apps/borg_ynh) and [Borg Server](https://github.com/YunoHost-Apps/borgserver_ynh) permettent d'externaliser les sauvegardes.
* [Fallback](https://github.com/YunoHost-Apps/fallback_ynh), si vous avez deux serveurs YunoHost, fournissez un moyen d'avoir un serveur secondaire que vous pourrez utiliser si votre serveur principal tombe en panne. Ce serveur secondaire vous permettra de déployer une copie de votre serveur pour ramener votre YunoHost lors de votre panne.

### Aller plus loin

#### Galerie de photos fédérées

* [Pixelfed](https://github.com/YunoHost-Apps/pixelfed_ynh)

#### Galerie audio fédérée

* [Reel2Bits](https://github.com/YunoHost-Apps/reel2bits_ynh)
* [Funkwhale](https://github.com/YunoHost-Apps/funkwhale_ynh)

#### Galerie vidéo fédérée

* [PeerTube](https://github.com/YunoHost-Apps/peertube_ynh)

#### Réseaux sociaux fédérés

* [Mastodon](https://github.com/YunoHost-Apps/mastodon_ynh)
* [Pleroma](https://github.com/YunoHost-Apps/pleroma_ynh)
* [Mobilizon](https://github.com/YunoHost-Apps/mobilizon_ynh)

#### Blog fédéré

* [Plume](https://github.com/YunoHost-Apps/plume_ynh)
* [Writefreely](https://github.com/YunoHost-Apps/writefreely_ynh)

#### Chat

* [Mattermost](https://github.com/YunoHost-Apps/mattermost_ynh)

## Conclusion

YunoHost peut couvrir 99% des besoins des organisations à but non lucratif, leur permettant de posséder et de protéger leurs données, de choisir les applications qu'elles souhaitent utiliser.
Et s’ils ne sont pas disponibles, ils peuvent [les packager pour YunoHost](https://yunohost.org/#/contributordoc), c’est très simple.
