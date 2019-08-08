# YunoHost per organizacion sens tòca lucrativa

## Ensenhador
* [Introduccion](#introduccion) 
* [Qual ](#qual) 
* [Qué](#qué) 
* [Quand](#quand) 
* [Ont](#ont) 
* [Perque](#perque) 
* [Cossí](#cossí) 
* [Conclusion](#conclusion) 

## Introduccion

L'objectiu d’aqueste document es de presentar una utilizacion especifica de [YunoHost](https://yunohost.org/) per d’organizacions sens tòca lucrativa.

## Qual

Organizacions sens tòca lucrativa, ONG o qualque siá associacion.

## Qué

Las organizacions sens tòca lucrativa devon generalament fornir diferents servicis a diferents publics :

* Conselh d'administracion / Comitat director / Benevòls amb :
  * [Mails](#mails)
  * [Calendièr](#calendièr)
  * [Contacte](#contacte)
  * [Fichièrs partejats / Drive](#fichièrs-partejats)
  * [Comunicacion instantanèa](#comunicacion-instantan-a)
  * [Intranet / Basa de coneissenças](#intranet)
  * [ERP / Comptabilitat](#erp-comptabilitat)
* Membres amb :
  * [Site Web public amb accès privat e individual](#site-web-public)
  * [Adhesion](#adhesion)
  * [Inscripcions als eveniments](#inscriptions-als-eveniments)
  * [Infoletras](#infoletras)
  * [Forum](#forum)
* Public amb :
  * [Site Web public](#site-web-public)
  * [Infoletras](#newsletter-mailing)

## Quand

Quand l'organizacion sens tòca lucrativa es prèsta a passar lo pas.

## Ont

Lo servidor YunoHost pòt èsser albergat a diferents endreches :
* Albergament en pròpri sus un servidor, un ordenador o Raspberry darrièr una connexion ADSL, SDSL o Fibra
* [Chatons](https://chatons.org), [librehosters](https://framagit.org/librehosters/awesome-librehosters)
* Servicis d'albergament comercial que fornís una maquina virtuala Debian

## Perque

YunoHost pòt correspondre als besonhs d'una organizacion sens tòca lucrativa e li permetre de servar lo mestritge  de sas donadas.

## Cossí

### YunoHost

YunoHost es una distribucion basada sus Debian GNU/Linux qu’automatiza l’installacion d’un servidor Web personal. La tòca de YunoHost es de permetre als utilizaires d’albergar facilament lors pròpris servicis Web en prepausant una interfàcia Web simpla, als clics, per installar divèrsas aplicacions Web.

![](https://upload.wikimedia.org/wikipedia/commons/0/07/Yunohost_user_portal.png)

YunoHost provesís sul pic:
* Un sistèma d'aplicacion
* Una interfàcia web
* Una interfàcia en linha de comanda (CLI) : Moulinette
* Un servidor Web : Nginx
* Un servidor DNS : Dnsmasq
* Una basa de donadas : MariaDB
* Un sistèma de salvagarda
* Un SSO: SSOwat
* OpenLDAP
* Corrièls :
  * SMTP: Postfix
  * IMAP & POP3 : Dovecot
  * Un antispam : rspamd, rmilter
* Servidor XMPP de messatjariá instantanèa : Metronome IM

### Nom de domeni

La primièra causa que vos fa mestièr per installar un servidor YunoHost es un nom de domeni. Lo nom de domeni pòt èsser generalament fornit amb lo servici d’albergament.

### Corrièls

A la prima installacion YunoHost fornís un sistèma de messatjariá disponible en utilizant POP / IMAP / SMTP.
Los comptes de messatjariá seràn gerits amb l'interfàcia Web o en linha de comanda. Los comptes creats seràn gardats dins l’OpenLDAP.

De paquets suplementaris pòdon èsser installats per provesir mai de foncionalitats al sistèma de messatjariá YunoHost :
* un webmail en utilizant [Roundcube](https://github.com/YunoHost-Apps/roundcube_ynh), [Rainloop](https://github.com/YunoHost-Apps/rainloop_ynh)
* ActiveSync utilizant [Z-Push](https://github.com/YunoHost-Apps/z-push_ynh)
* Grop de distribucion intèrne en utilizant [Mailman](https://github.com/YunoHost-Apps/mailman_ynh)

### Calendièr

Per fornir de calendièrs personals o partejats, vos calrà installar :
* [Nextcloud](https://github.com/YunoHost-Apps/nextcloud_ynh)
* [Baikal](https://github.com/YunoHost-Apps/baikal_ynh)

### Contacte

Per fornir un sistèma de contacte personal, vos caldrà installar :
* [Nextcloud](https://github.com/YunoHost-Apps/nextcloud_ynh)
* [Baikal](https://github.com/YunoHost-Apps/baikal_ynh)

### Fichièrs partejats

Per fornir un sistèma de fichièrs partejats : dorsièrs personals e dorsièrs partejats, podètz installar [Nextcloud](https://github.com/YunoHost-Apps/nextcloud_ynh).
Las fichièrs seràn disponibles d’una interfàcia web estant o amb un client de sincronizacion.

### Comunicacion instantanèa

Tras l’installacion YunoHost fornís sul pic un servidor XMPP per lo qual podètz installar un client Web :  [Jappix](https://github.com/YunoHost-Apps/jappix_ynh)

Podètz tanben installar un servidor Matrix :
* Lo servidor: [Synapse](https://github.com/YunoHost-Apps/synapse_ynh)
* Un client web: [Riot](https://github.com/YunoHost-Apps/_ynh)

### Intranet

Per una organizacion sens tòca lucrativa, un bon biais de metre en plaça un intranet es de fornir un wiki que permet als utilizaires intèrne de legir, modificar e ajustar de contengut. Vaquí unes paquets per installar un wiki :
* [DokuWiki](https://github.com/YunoHost-Apps/docuwiki_ynh) utiliza la sintaxi wiki
* [Wiki.js](https://github.com/YunoHost-Apps/wikijs_ynh) utiliza la sintaxi markdown

### ERP / Comptabilitat

Arriba un moment ont a l’organizacion sens tòca lucrativa li pòsca far besonh un sistèma de comptabilitat / ERP, vaquí doas proposicions :
* [OpenERP/Odoo](https://github.com/YunoHost-Apps/libreerp_ynh)
* [Dolibarr](https://github.com/YunoHost-Apps/dolibarr_ynh)

### Site Web Public

Existís mantuns biaisses de construire un site Web public :
* Un simple site HTML, CSS, etc... en utilizant : [Custom Webapp](https://github.com/YunoHost-Apps/my_webapp_ynh)
* Utilizar un CMS (sistèma de gestion de contengut) coma  [Wordpress](https://github.com/YunoHost-Apps/_ynh), [Drupal](https://github.com/YunoHost-Apps/drupal_ynh) , [Grav](https://github.com/YunoHost-Apps/grav_ynh), [PluXml](https://github.com/YunoHost-Apps/pluxml_ynh)

Mas prepausam quicòm de mai potent : [CiviCRM on Drupal 7](https://github.com/YunoHost-Apps/civicrm_drupal7_ynh):
* Drupal qu’es un framework potent de gestion de contengut
* amb CiviCRM qu’es un CRM OpenSource a destinacion de las organizacions sens tòca lucrativa

#### Adhesion

Amb CiviCRM, poiretz metre en plaça d’adhesions en linha amb pagament.

#### Inscripcions als eveniments

Amb CiviCRM, poiretz metre a disposicion un agenda en linha amb la possibilitat pels membres o lo public de s’inscriure gratuitament o en pagant.

#### Infoletra/Lista de difusion

Çò melhor per gerir aquò es d’utilizar CiviCRM e son modul de lista de difusion.

### Forum

Avètz mantun possibilitats, aver un forum integrat a Drupal o utilizar un sistèma dedicat coma [Flarum](https://github.com/YunoHost-Apps/flarum_ynh).

### Salvagarda

YunoHost fornís son pròpri sistèma de salvagarda. Abans tota mesa a nivèl de paquet, YunoHost salvagarda la version actuala del paquet e la restaura automaticament se la mesa a nivèl se debana pas corrèctament.
Las salvagardas Yunohost son gardadas localament dins `/home/yunohost.backup/archives`.

Mas per la produccion, la salvagarda gardada localament basta pas, vos cal emplegar d’estrategias de salvagarda suplementàrias :
* Salvagarda de la maquina virtuala se fornida pel sistèma d’albergament.
* [Archivist](https://github.com/YunoHost-Apps/archivist_ynh) es un sistèma de salvagarda automatic de vòstre servidor. Vòstras salvagardas pòdon èsser enviadas a mantun endreches, locals o alonhats.
* [Borg](https://github.com/YunoHost-Apps/borg_ynh) e [Borg Server](https://github.com/YunoHost-Apps/borgserver_ynh) permeton d’externalizar las salvagardas.
* [Fallback](https://github.com/YunoHost-Apps/fallback_ynh), se avètz dos servidors YunoHost, ajatz los mejans d’aver un servidor segondari que poiretz utilizar se lo primièr ven a foncionar pas mai. Aqueste servidor segondari vos permetrà de restablir una còpia de vòstre servidor per dire de corregir los problèmas de l’autre servidor YunoHost.

### Anar mai luènh

#### Galariá de fotografias federada

* [Pixelfed](https://github.com/YunoHost-Apps/pixelfed_ynh)

#### Galariá àudio federada

* [Reel2Bits](https://github.com/YunoHost-Apps/reel2bits_ynh)
* [Funkwhale](https://github.com/YunoHost-Apps/funkwhale_ynh)

#### Galariá vidèo federada

* [PeerTube](https://github.com/YunoHost-Apps/peertube_ynh)

#### Malhums socials federats

* [Mastodon](https://github.com/YunoHost-Apps/mastodon_ynh)
* [Pleroma](https://github.com/YunoHost-Apps/pleroma_ynh)
* [Mobilizon](https://github.com/YunoHost-Apps/mobilizon_ynh)

#### Blog federats

* [Plume](https://github.com/YunoHost-Apps/plume_ynh)
* [Writefreely](https://github.com/YunoHost-Apps/writefreely_ynh)

#### Chat

* [Mattermost](https://github.com/YunoHost-Apps/mattermost_ynh)

## Conclusion

YunoHost pòt cumplir 99% dels besonhs de las organizacions sens tòca lucrativa, en lor permetent de téner e protegir lors donadas, de causir las aplicacions que vòlon utilizar.
E se son pas disponiblas, pòdon [crear un paquet per YunoHost](https://yunohost.org/#/contributordoc), es fòrça simple.
