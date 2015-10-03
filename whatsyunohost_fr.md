#Qu’est-ce que YunoHost ?

YunoHost est un **système d'exploitation serveur** visant à simplifier l'auto-hébergement de services Internet.   
Il est basé et reste totalement compatible avec [Debian GNU/Linux](http://debian.org).

<img src="https://yunohost.org/images/debian-logo.png" width=100>

---

### Logiciels

Concrètement, YunoHost **installe et configure automatiquement** quelques services autour de LDAP, et **fournit des outils** pour les administrer.

On peut donc le considérer comme une distribution, comprenant les logiciels suivant :

<img src="https://yunohost.org/images/nginx.png"><img src="https://yunohost.org/images/postfix.png"><img src="https://yunohost.org/images/dovecot.png"><img src="https://yunohost.org/images/spamassassin.png"><img src="https://yunohost.org/images/XMPP_logo.png" width=80>

* [Nginx](http://nginx.org/) : un serveur web
* [Postfix](http://www.postfix.org/) : un serveur de messagerie électronique SMTP
* [Dovecot](http://www.dovecot.org/) : un serveur de messagerie électronique IMAP et POP3
* [Amavis](http://amavis.org/) : un antispam
* [Metronome](http://www.lightwitch.org/metronome) : un serveur XMPP
* [OpenLDAP](http://www.openldap.org/) : un système d'annuaire
* [Bind](https://www.isc.org/downloads/bind/) : un serveur de DNS
* [SSOwat](https://github.com/Kloadut/SSOwat) : un (SSO) système d’authentification web
<!--* [Tahoe-LAFS](https://tahoe-lafs.org/trac/tahoe-lafs) : un système de sauvegarde (pas encore mis en place)-->

---

### Système d’app

En complément, YunoHost fournit un système d'« app » qui n'est autre qu'un **dépôt communautaire** de scripts aidant à installer des services et applications web supplémentaires.

La chose la plus intéressante avec ce système est que **les applications web profitent de la base LDAP** via le SSO (Single Sign On), qui authentifie les utilisateur du serveur avec un unique nom d'utilisateur/mot de passe.

Vous serez peut-être intéressé à la lecture de la [documentation sur le packaging](/packaging_apps_fr) et la page GitHub d'[SSOwat](https://github.com/Kloadut/SSOwat) pour aller plus loin.

<img src="https://yunohost.org/images/roundcube.png"><img src="https://yunohost.org/images/ttrss.png"><img src="https://yunohost.org/images/wordpress.png"><img src="https://yunohost.org/images/transmission.png"><img src="https://yunohost.org/images/jappix.png">

---

### Origine

YunoHost est un projet né en février 2012 à la suite d'à peu près ça :

 <blockquote><p>« Merde, j'ai la flemme de me reconfigurer un serveur mail... Beudbeud, comment t'as fait pour configurer ton joli serveur sous LDAP ? »</p>
<small>Kload, février 2012</small></blockquote>

Il ne manquait en fait qu'une interface d’administration au serveur de Beudbeud pour en faire quelque chose d’exploitable, alors Kload a décidé de la développer. Finalement, après l'automatisation de quelques configurations et le packaging de quelques applications web, YunoHost version 1 était sorti.

Constatant l'engouement croissant autour de YunoHost et de l'auto-hébergement en général, les développeurs et les nouveaux contributeurs ont alors décidé de prendre le cap d'une version 2, plus accessible, plus extensible, plus puissante, et qui prépare du bon café commerce équitable pour les lutins de Laponie.

---

### But

Le but de YunoHost est de rendre accessible au plus grand nombre l'installation et l'administration d'un serveur, sans délaisser la qualité et la fiabilité du logiciel. 

Tous les efforts sont faits pour simplifier le déploiement sur le plus d'appareil possible et dans toutes les conditions (chez soi, sur son serveur dédié ou sur un VPS).

---

### Nom

**YunoHost** vient de l'argot Internet anglais « Y U NO Host » signifiant approximativement « Pourquoi toi ne pas héberger ». Le [mème Internet](http://fr.wikipedia.org/wiki/M%C3%A8me_Internet) qui l'illustre est à peu près celui-ci :
<div class="text-center"><img style="border-radius: 5px; box-shadow: 0 5px 15px rgba(0,0,0,0.15);" src="https://yunohost.org/images/dude_yunohost.jpg"></div>

---

### Développement

YunoHost est développé pour être le plus **simple** et le moins intrusif possible pour garder la compatibilité avec Debian. Il propose uniquement un ensemble de configurations automatiques et opère via des interfaces accessibles.

Le tout est bien entendu **entièrement libre**. La philosophie de l'[auto-hébergement](selfhosting_fr) étant à nos yeux incompatible avec tout autre modèle de développement logiciel.

N'hésitez pas à visiter la page « [contribuez](/contribute_fr) ».

---

### Sécurité

Tous les efforts ont été déployés pour sécuriser YunoHost, et **chiffrer tous les protocoles**. Une explication plus détaillée est disponible [ici](/security_fr).

---

### Qu’est-ce que YunoHost n’est pas ?

Même si YunoHost est multi-domaine et multi-utilisateur, il reste **inapproprié pour un usage mutualisé**.

Premièrement parce que le logiciel est trop jeune, donc non-testé et non-optimisé pour être mis en production pour des centaines d'utilisateurs en même temps. Et quand bien même, ce n'est pas le chemin que l'on souhaite faire suivre à YunoHost. La virtualisation se démocratise, et c'est une façon bien plus étanche et sécurisée de faire de la mutualisation.

Vous pouvez héberger vos amis, votre famille ou votre entreprise sans problème, mais vous devez **avoir confiance** en vos utilisateur, et ils doivent de la même façon avoir confiance en vous. Si vous souhaitez tout de même fournir des services YunoHost à des inconnus, **un VPS entier par utilisateur** sera la meilleure solution.