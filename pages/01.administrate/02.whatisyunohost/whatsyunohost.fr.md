---
title: Qu'est-ce que YunoHost ?
template: docs
taxonomy:
    category: docs
routes:
  default: '/whatsyunohost'
---

![YunoHost logo](image://YunoHost_logo_vertical.png?resize=400&id=ynhlogo)

YunoHost est un **système d’exploitation** qui vise à simplifier autant que possible l'administration d'un **serveur** pour ainsi démocratiser [l’auto-hébergement](/selfhosting) tout en restant fiable, sécurisé, éthique et léger. C'est un projet de logiciel libre maintenu exclusivement par des bénévoles. Techniquement, il peut être vu comme une distribution basée sur [Debian GNU/Linux](https://debian.org) et peut s'installer sur [de nombreux types de matériel](/install).

## Fonctionnalités

- ![](image://icon-debian.png?resize=32&classes=inline) basé sur Debian ;
- ![](image://icon-tools.png?resize=32&classes=inline) administration via une **interface web simple et claire** ;
- ![](image://icon-package.png?resize=32&classes=inline) déployez des **applications en quelques clics** ;
- ![](image://icon-users.png?resize=32&classes=inline) ajoutez des **utilisateurs** <small>(gérés via un annuaire LDAP)</small> ;
- ![](image://icon-globe.png?resize=32&classes=inline) gérez des **noms de domaine** ;
- ![](image://icon-medic.png?resize=32&classes=inline) créez et restaurez des **sauvegardes** ;
- ![](image://icon-door.png?resize=32&classes=inline) connexion simultanée à toutes les apps via un **portail utilisateur** <small>(nginx, SSOwat)</small> ;
- ![](image://icon-mail.png?resize=32&classes=inline) fourni avec un **serveur mail complet** <small>(Postfix, Dovecot, Rspamd, DKIM)</small> ;
- ![](image://icon-messaging.png?resize=32&classes=inline) ... ainsi qu'un **serveur de messagerie instantanée** <small>(XMPP)</small> ;
- ![](image://icon-lock.png?resize=32&classes=inline) gère les **certificats SSL** <small>(basé sur Let's Encrypt)</small> ;
- ![](image://icon-shield.png?resize=32&classes=inline) ... et des **systèmes de sécurité** <small>(Fail2Ban, yunohost-firewall)</small> ;

## Origine

YunoHost est un projet né en février 2012 à la suite d’à peu près ça :

 <blockquote><p>« Merde, j’ai la flemme de me reconfigurer un serveur mail... Beudbeud, comment t’as fait pour configurer ton joli serveur sous LDAP ? »</p>
<small>Kload, février 2012</small></blockquote>

Il ne manquait en fait qu’une interface d’administration au serveur de Beudbeud pour en faire quelque chose d’exploitable, alors Kload a décidé de la développer. Finalement, après l’automatisation de quelques configurations et le packaging de quelques applications web, la première version de YunoHost était sortie.

Constatant l’engouement croissant autour de YunoHost et de l’auto-hébergement en général, les développeurs et les nouveaux contributeurs ont alors décidé de prendre le cap d’une version 2, plus accessible, plus extensible, plus puissante, et qui prépare du bon café commerce équitable pour les lutins de Laponie.

Le nom **YunoHost** vient de l’argot Internet anglais « Y U NO Host » signifiant approximativement « Pourquoi toi ne pas héberger ». Le [mème Internet](http://fr.wikipedia.org/wiki/M%C3%A8me_Internet) qui l’illustre est à peu près celui-ci :
![](image://dude_yunohost.jpg)

## Qu’est-ce que YunoHost n’est pas ?

Même si YunoHost est multi-domaine et multi-utilisateur, il reste **inapproprié pour un usage mutualisé**.

Premièrement parce que le logiciel est trop jeune, donc non-testé et non-optimisé pour être mis en production pour des centaines d’utilisateurs en même temps. Et quand bien même, ce n’est pas le chemin que l’on souhaite faire suivre à YunoHost. La virtualisation se démocratise, et c’est une façon bien plus étanche et sécurisée de faire de la mutualisation.

Vous pouvez héberger vos amis, votre famille ou votre entreprise sans problème, mais vous devez **avoir confiance** en vos utilisateurs, et ils doivent de la même façon avoir confiance en vous. Si vous souhaitez tout de même fournir des services YunoHost à des inconnus, **un VPS entier par utilisateur** sera la meilleure solution.

## Logo

Logo YunoHost noir et blanc réalisé par ToZz (400 × 400 px) :

[![](image://ynh_logo_black_300dpi.png?resize=220)](image://ynh_logo_black_300dpi.png)
[![](image://ynh_logo_white_300dpi.png?resize=220)](image://ynh_logo_white_300dpi.png)

Licence: CC-BY-SA 4.0
