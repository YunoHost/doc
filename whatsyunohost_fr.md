Qu'est-ce que YunoHost ?
========================

<img src="/images/YunoHost_logo_vertical.png" width=400>

YunoHost est un **système d’exploitation** qui vise à simplifier autant que possible l'administration d'un **serveur** pour ainsi démocratiser [l’auto-hébergement](selfhosting_fr) tout en restant fiable, sécurisé, éthique et léger. C'est un projet de logiciel libre maintenu exclusivement par des bénévoles. Techniquement, il peut être vu comme une distribution basé sur [Debian GNU/Linux](https://debian.org) et peut s'installer sur [de nombreux types de matériel](install_fr).

Fonctionnalités
---------------

- <img src="/images/icon-debian.png" width=32 style="margin-right:5px"> basé sur Debian ;
- <img src="/images/icon-tools.png" width=32 style="margin-right:5px"> administration via une **interface web simple et claire** ;
- <img src="/images/icon-package.png" width=32 style="margin-right:5px"> déployez des **applications en quelques clics** ;
- <img src="/images/icon-users.png" width=32 style="margin-right:5px"> ajoutez des **utilisateurs** <small>(gérés via un annuaire LDAP)</small> ;
- <img src="/images/icon-globe.png" width=32 style="margin-right:5px"> gérez des **noms de domaine** ;
- <img src="/images/icon-medic.png" width=32 style="margin-right:5px"> créez et restaurez des **sauvegardes** ;
- <img src="/images/icon-door.png" width=32 style="margin-right:5px"> connexion simultanée à toutes les apps via un **portail utilisateur** <small>(nginx, SSOwat)</small> ;
- <img src="/images/icon-mail.png" width=32 style="margin-right:5px"> fourni avec un **serveur mail complet** <small>(Postfix, Dovecot, Rspamd, DKIM)</small> ;
- <img src="/images/icon-messaging.png" width=32 style="margin-right:5px"> ... ainsi qu'un **serveur de messagerie instantanée** <small>(XMPP)</small> ;
- <img src="/images/icon-lock.png" width=32 style="margin-right:5px"> gères les **certificats SSL** <small>(basé sur Let's Encrypt)</small> ;
- <img src="/images/icon-shield.png" width=32 style="margin-right:5px"> ... et des **systèmes de sécurité** <small>(fail2ban, yunohost-firewall)</small> ;

Origine
-------

YunoHost est un projet né en février 2012 à la suite d’à peu près ça :

 <blockquote><p>« Merde, j’ai la flemme de me reconfigurer un serveur mail... Beudbeud, comment t’as fait pour configurer ton joli serveur sous LDAP ? »</p>
<small>Kload, février 2012</small></blockquote>

Il ne manquait en fait qu’une interface d’administration au serveur de Beudbeud pour en faire quelque chose d’exploitable, alors Kload a décidé de la développer. Finalement, après l’automatisation de quelques configurations et le packaging de quelques applications web, la première version de YunoHost était sortie.

Constatant l’engouement croissant autour de YunoHost et de l’auto-hébergement en général, les développeurs et les nouveaux contributeurs ont alors décidé de prendre le cap d’une version 2, plus accessible, plus extensible, plus puissante, et qui prépare du bon café commerce équitable pour les lutins de Laponie.

Le nom **YunoHost** vient de l’argot Internet anglais « Y U NO Host » signifiant approximativement « Pourquoi toi ne pas héberger ». Le [mème Internet](http://fr.wikipedia.org/wiki/M%C3%A8me_Internet) qui l’illustre est à peu près celui-ci :
<div class="text-center"><img style="border-radius: 5px; box-shadow: 0 5px 15px rgba(0,0,0,0.15);" src="/images/dude_yunohost.jpg"></div>

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
