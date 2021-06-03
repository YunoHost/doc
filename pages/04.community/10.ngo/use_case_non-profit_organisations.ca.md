---
title: Use cases for NGOs
template: docs
taxonomy:
    category: docs
routes:
  default: '/use_case_non-profit_organisations'
page-toc:
  active: true
---

L'objectiu d'aquest document és presentar un cas d'ús específic de [YunoHost](https://yunohost.org) per a organitzacions sense ànim de lucre.

## Qui

Organitzacions sense ànim de lucre, ONGs o qualsevol tipus d'associació.

## Què

Normalment les organitzacions sense ànim de lucre han de donar alguns serveis públics:

* Consell d'administració / Comitè director / Voluntàries amb:
 * [Correus electrònics](#mails)
 * [Calendari](#calendar)
 * [Contacte](#contact)
 * [Fitxers compartits / Drive](#shared-files)
 * [Missatgeria instantània](#instant-communication)
 * [Intranet / base de coneixements](#intranet)
 * [ERP / Comptabilitat](#erp-accounting)
* Membres amb:
 * [Pàgina web pública amb accés privat i individual](#public-web-site)
 * [Adhesió](#membership)
 * [Inscripció a esdeveniments](#events-registration)
 * [Butlletí d'informació](#newsletter-mailing)
 * [Fòrum](#forum)
* Públic amb:
 * [Pàgina web pública](#public-web-site)
 * [Butlletí d'informació](#newsletter-mailing)

## Quan

Quan l'organització estigui preparada per a fer el pas.

## On

El servidor YunoHost de l'organització pot estar allotjat en diferents llocs:
* Allotjament propi en un servidor, ordinador o Raspberry darrera una connexió ADSL, SDSL o fibra
* Serveis d'allotjament de [Chatons](https://chatons.org), [librehosters](https://framagit.org/librehosters/awesome-librehosters)
* Serveis d'allotjament comercials que ofereixin màquines virtuals Debian

## Per què

YunoHost pot cobrir la majoria de necessitats d'una organització sense ànim de lucre i permet tenir el control sobre les dades de l'organització.


## Com

### YunoHost

YunoHost és una distribució GNU/Linux basada en Debian empaquetada amb programari lliure que automatitza la instal·lació d'un servidor web personal. L'objectiu de YunoHost és permetre a les usuàries allotjar fàcilment els seus propis serveis web al oferir una interfície web en la que es poden instal·lar diferents aplicacions només amb uns quants clics.

![](https://upload.wikimedia.org/wikipedia/commons/0/07/Yunohost_user_portal.png)

YunoHost de base ofereix:
* Un sistema d'aplicacions
* Una interfície web
* Una interfície per línia de comandes (CLI): Moulinette
* Un servidor web: NGINX
* Un servidor DNS: Dnsmasq
* Una base de dades: MariaDB
* Un sistema de còpies de seguretat
* Un SSO: SSOwat
* OpenLDAP
* Correu electrònic:
  * SMTP: Postfix
  * IMAP & POP3: Dovecot
  * Un antispam: rspamd, rmilter
* Un servidor de missatgeria instantània XMPP: Metronome IM

### Nom de domini

La primera cosa que s'haurà de tenir per poder instal·lar un servidor YunoHost és un nom de domini. Habitualment el nom de domini el pot oferir el mateix servei d'allotjament.

### Correus electrònics

De base, YunoHost ofereix un sistema de correus electrònics disponible utilitzant POP / IMAP / SMTP.
Els comptes de correu electrònic es poden gestionar per mitjà de la interfície web o de la línia de comandes. Els comptes creats es guarden en l'OpenLDAP.

Es poden instal·lar paquets addicionals per donar més funcionalitats al sistema de correu electrònic de YunoHost:
* Un client web utilitzant [Roundcube](https://github.com/YunoHost-Apps/roundcube_ynh), [Rainloop](https://github.com/YunoHost-Apps/rainloop_ynh)
* ActiveSync utilitzant [Z-Push](https://github.com/YunoHost-Apps/z-push_ynh)
* Un grup de difusió interna utilitzant [Mailman](https://github.com/YunoHost-Apps/mailman_ynh)

### Calendari

Per oferir calendaris personals o compartits haureu d'instal·lar:
* [Nextcloud](https://github.com/YunoHost-Apps/nextcloud_ynh)
* [Baikal](https://github.com/YunoHost-Apps/baikal_ynh)

### Contactes

Per oferir un sistema de contactes personal haureu d'instal·lar:
* [Nextcloud](https://github.com/YunoHost-Apps/nextcloud_ynh)
* [Baïkal](https://github.com/YunoHost-Apps/baikal_ynh)

### Fitxers compartits

Per oferir un sistema de fitxers compartit: carpetes personals i compartides, podeu instal·lar [Nextcloud](https://github.com/YunoHost-Apps/nextcloud_ynh).
Els fitxers estaran disponibles a través d'una interfície web o bé utilitzant un client de sincronització.

### Missatgeria instantània

De base YunoHost ofereix un servidor XMPP, pel que podeu instal·lar un client web: [Jappix](https://github.com/YunoHost-Apps/jappix_ynh).

També podeu instal·lar un servidor matrix:
* El servidor: [Synapse](https://github.com/YunoHost-Apps/synapse_ynh)
* Un client web: [Riot](https://github.com/YunoHost-Apps/riot_ynh)

### Intranet

Per a una organització sense ànim de lucre, una bona manera d'implementar una intranet és oferir una wiki interna per a que les usuàries puguin llegir, editar i afegir contingut. Vegeu aquí alguns paquets que permeten implementar una wiki:
* [DokuWiki](https://github.com/YunoHost-Apps/docuwiki_ynh) utilitzant la sintaxi wiki
* [Wiki.js](https://github.com/YunoHost-Apps/wikijs_ynh) utilitzant la sintaxi markdown

### ERP / Comptabilitat

Arribats a un cert punt una organització sense ànim de lucre podria necessitar un sistema de comptabilitat / ERP, aquí hi ha dos propostes:
* [OpenERP/Odoo](https://github.com/YunoHost-Apps/libreerp_ynh)
* [Dolibarr](https://github.com/YunoHost-Apps/dolibarr_ynh)

### Pàgina web pública

Hi ha múltiples maneres d'implementar una pàgina web pública:
* Un pàgina simple amb HTML, CSS, etc. utilitzant: [Custom Webapp](https://github.com/YunoHost-Apps/my_webapp_ynh)
* Utilitzant un CMS (sistema de gestió de contingut) com [Wordpress](https://github.com/YunoHost-Apps/_ynh), [Drupal](https://github.com/YunoHost-Apps/drupal_ynh) , [Grav](https://github.com/YunoHost-Apps/grav_ynh), [PluXml](https://github.com/YunoHost-Apps/pluxml_ynh)

Però us proposem una alternativa una mica més potent: [CiviCRM on Drupal 7](https://github.com/YunoHost-Apps/civicrm_drupal7_ynh):
* Drupal és un entorn de treball potent de codi obert per la gestió de contingut
* amb CiviCRM que és un CRM de codi obert per a les organitzacions sense ànim de lucre

### Adhesió

Amb CiviCRM podeu tenir adhesions en línia i pagament.

### Inscripció a esdeveniments

Amb CiviCRM, podeu posar a disposició una agenda en línia per permetre als membres o al públic inscriure's gratuïtament o pagant.

### Butlletí d'informació

La millor manera de gestionar-ho és utilitzar el mòdul de llistes de difusió de CiviCRM.

### Fòrum

Hi ha múltiples opcions, tenir un fòrum integrat a Drupal o utilitzar un sistema dedicat com ara [Flarum](https://github.com/YunoHost-Apps/flarum_ynh).

### Còpies de seguretat

YunoHost ofereix el seu propi sistema de còpies de seguretat. Abans de cada actualització, YunoHost fa una còpia de seguretat de la versió actual del paquet i la restaura automàticament si falla l'actualització.
Les còpies de seguretat de YunoHost s'emmagatzemen localment a `/home/yunohost.backup/archives`.

Però per un servidor en producció, còpies de seguretat locals no són suficients, així que s'hauran d'implementar còpies de seguretat alternatives:
* Còpia de seguretat de la màquina virtual si ho permet el sistema d'allotjament.
* [Archivist](https://github.com/YunoHost-Apps/archivist_ynh) és un sistema de còpies de seguretat automàtiques del servidor. Les còpies de seguretat es poden enviar a d'altres llocs, locals o distants.
* [Borg](https://github.com/YunoHost-Apps/borg_ynh) i [Borg Server](https://github.com/YunoHost-Apps/borgserver_ynh) permeten externalitzar les còpies de seguretat.
* [Fallback](https://github.com/YunoHost-Apps/fallback_ynh), si teniu de servidors YunoHost, permet tenir un servidor secundari que pot ser utilitzat en cas que caigui el servidor principal. Aquest servidor secundari permetrà desplegar una còpia del servidor i tornar a posar en marxar YunoHost durant la caiguda.

### Anar més enllà

#### Galeria de fotografies federada

* [Pixelfed](https://github.com/YunoHost-Apps/pixelfed_ynh)

#### Galeria àudio federada

* [Reel2Bits](https://github.com/YunoHost-Apps/reel2bits_ynh)
* [Funkwhale](https://github.com/YunoHost-Apps/funkwhale_ynh)

#### Galeria vídeo federada

* [PeerTube](https://github.com/YunoHost-Apps/peertube_ynh)

#### Xarxa social federada

* [Mastodon](https://github.com/YunoHost-Apps/mastodon_ynh)
* [Pleroma](https://github.com/YunoHost-Apps/pleroma_ynh)
* [Mobilizon](https://github.com/YunoHost-Apps/mobilizon_ynh)
   
#### Blog federat

* [Plume](https://github.com/YunoHost-Apps/plume_ynh)
* [Writefreely](https://github.com/YunoHost-Apps/writefreely_ynh)

#### Xat

* [Mattermost](https://github.com/YunoHost-Apps/mattermost_ynh)

## Conclusió

YunoHost por cobrir el 99% de les necessitats de les organitzacions sense ànim de lucre, permetent així que recuperin la sobirania i puguin protegir les seves dades, així com escollir les aplicacions que volen utilitzar.
I si n'hi ha alguna que no està disponible, poden [empaquetar-la per YunoHost](/contributordoc), és molt senzill.
