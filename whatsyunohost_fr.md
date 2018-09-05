Qu'est-ce que YunoHost ?
========================

<img src="/images/YunoHost_logo_vertical.png" width=400>

Objectif
--------

YunoHost est un **système d’exploitation serveur** visant à rendre accessible [l’auto-hébergement](selfhosting_fr) à autant de personne que possible, sans délaisser la qualité et la fiabilité du logiciel. YunoHost supporte [plusieurs types de matériel](install_fr) et est basé et compatible avec [Debian GNU/Linux](https://debian.org).

Fonctionnalités
---------------

- <img src="/images/icon-debian.png" width=64> basé sur Debian ;
- <img src="/images/icon-tools.png" width=64> administration via une **gentille interface web** ;
- <img src="/images/icon-package.png" width=64> **deployez facilement des applications** ; 
- <img src="/images/icon-users.png" width=64> gérez des **utilisateurs** <small>(gérés via LDAP)</small> ;
- <img src="/images/icon-globe.png" width=64> gérez des **domaines** ;
- <img src="/images/icon-medic.png" width=64> créez et restaurez des **sauvegardes** ;
- <img src="/images/icon-door.png" width=64> les utilisateurs peuvent se connecter à toutes les apps à travers le système de **Single Sign-On** (SSO) <small>(SSOwat)</small> ;
- <img src="/images/icon-mail.png" width=64> viens avec un **serveur mail complet** <small>(Postfix, Dovecot, Rspamd, DKIM)</small> ;
- <img src="/images/icon-messaging.png" width=64> ... ainsi qu'un **serveur de messagerie instantannée** <small>(XMPP)</small> ;
- <img src="/images/icon-lock.png" width=64> ... un système de gestion de **certificats SSL** <small>(interfacé avec Let's Encrypt)</small> ;
- <img src="/images/icon-shield.png" width=64> et des **systèmes de sécurité** <small>(fail2ban, yunohost-firewall)</small> ;

Origine
-------

YunoHost est un projet né en février 2012 à la suite d’à peu près ça :

 <blockquote><p>« Merde, j’ai la flemme de me reconfigurer un serveur mail... Beudbeud, comment t’as fait pour configurer ton joli serveur sous LDAP ? »</p>
<small>Kload, février 2012</small></blockquote>

Il ne manquait en fait qu’une interface d’administration au serveur de Beudbeud pour en faire quelque chose d’exploitable, alors Kload a décidé de la développer. Finalement, après l’automatisation de quelques configurations et le packaging de quelques applications web, la première version de YunoHost était sortie.

Constatant l’engouement croissant autour de YunoHost et de l’auto-hébergement en général, les développeurs et les nouveaux contributeurs ont alors décidé de prendre le cap d’une version 2, plus accessible, plus extensible, plus puissante, et qui prépare du bon café commerce équitable pour les lutins de Laponie.

But
---

Le but de YunoHost est de rendre accessibles au plus grand nombre l’installation et l’administration d’un serveur, sans délaisser la qualité et la fiabilité du logiciel. 

Tous les efforts sont faits pour simplifier le déploiement sur le plus d’appareils possible et dans toutes les conditions (chez soi, sur son serveur dédié ou sur un VPS).

Nom
---

**YunoHost** vient de l’argot Internet anglais « Y U NO Host » signifiant approximativement « Pourquoi toi ne pas héberger ». Le [mème Internet](http://fr.wikipedia.org/wiki/M%C3%A8me_Internet) qui l’illustre est à peu près celui-ci :
<div class="text-center"><img style="border-radius: 5px; box-shadow: 0 5px 15px rgba(0,0,0,0.15);" src="/images/dude_yunohost.jpg"></div>

Développement
-------------

YunoHost est développé pour être le plus **simple** et le moins intrusif possible pour garder la compatibilité avec Debian. Il propose uniquement un ensemble de configurations automatiques et opère via des interfaces accessibles.

Le tout est bien entendu **entièrement libre**. La philosophie de l’[auto-hébergement](selfhosting_fr) étant à nos yeux incompatible avec tout autre modèle de développement logiciel.

N’hésitez pas à visiter la page « [contribuez](/contribute_fr) ».

Sécurité
--------

Tous les efforts ont été déployés pour sécuriser YunoHost, et **chiffrer tous les protocoles**. Une explication plus détaillée est disponible [ici](/security_fr).

Qu’est-ce que YunoHost n’est pas ?
----------------------------------

Même si YunoHost est multi-domaine et multi-utilisateur, il reste **inapproprié pour un usage mutualisé**.

Premièrement parce que le logiciel est trop jeune, donc non-testé et non-optimisé pour être mis en production pour des centaines d’utilisateurs en même temps. Et quand bien même, ce n’est pas le chemin que l’on souhaite faire suivre à YunoHost. La virtualisation se démocratise, et c’est une façon bien plus étanche et sécurisée de faire de la mutualisation.

Vous pouvez héberger vos amis, votre famille ou votre entreprise sans problème, mais vous devez **avoir confiance** en vos utilisateurs, et ils doivent de la même façon avoir confiance en vous. Si vous souhaitez tout de même fournir des services YunoHost à des inconnus, **un VPS entier par utilisateur** sera la meilleure solution.

Logo
----

Logo Yunohost noir et blanc réalisé par ToZz (400 × 400 px) :

<a href="/images/ynh_logo_black_300dpi.png"><img src="/images/ynh_logo_black_300dpi.png" width=220></a>

<a href="/images/ynh_logo_white_300dpi.png"><img src="/images/ynh_logo_white_300dpi.png" width=220></a>

Cliquer pour télécharger.

Licence: CC-BY-SA 4.0
