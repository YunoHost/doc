---
title: Baikal
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_baikal'
---

![Baïkal's logo](image://baikal_logo.png?height=80)

[![Install Baïkal with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=baikal) [![Integration level](https://dash.yunohost.org/integration/baikal.svg)](https://dash.yunohost.org/appci/app/baikal)

### Index

- [Configuration](#Configuration)
  - [Connexion à l'interface d'administration](#Connexion-à-l-interface-d-administration)
  - [Création d'un nouvel utilisateur](#Création-d-un-nouvel-utilisateur)
- [Connexion CalDAV](#Connexion-CalDAV)
  - [Connexion de Thunderbird avec Lightning](#Connexion-de-Thunderbird-avec-Lightning)
  - [Connexion de AgenDAV](#Connexion-de-AgenDAV)
- [Connexion CardDAV](#Connexion-CardDAV)
- [Liens utiles](#liens-utiles)

Baïkal est un serveur de calendriers et de contacts accessible par les protocoles CalDAV (calendriers) et CardDAV (carnets d’adresses), autorisant ainsi la synchronisation avec de nombreux clients (Thunderbird + Lightning par exemple).

**AVERTISSEMENT** : Baïkal ne fonctionnera pas si vous avez installé un **Nextcloud** (leurs fonctions cardav/caldav entrent en conflit).

## Configuration

### Connexion à l’interface d’administration

Pour configurer l'appliation il faut se rendre à l'adresse : `sous.domaine.tld/admin` ou `domaine.tld/baikal/admin`
Le nom d’utilisateur à spécifier est `admin` suivi du mot de passe spécifique que vous avez choisi lors de l’installation de Baïkal. Attention, le mot de passe ne doit pas contenir de carractères spéciaux.

### Authentification LDAP

Par défaut, Baïkal est configuré pour importer les utilisateurs depuis l'annuaire LDAP de YunoHost. Les utilisateurs YunoHost apparaîtront dans le menu `Users and ressources` après une première authentification.

## Connexion CalDAV

### Connexion de Thunderbird avec Lightning

Ajoutez un nouvel agenda de type « Réseau » puis « CalDAV ».

L’URL à entrer est la suivante :

`https://example.com/baikal/cal.php/calendars/username/default`

*En prenant soin de remplacer « example.com » par votre domaine puis « username » par votre nom d’utilisateur*

### Connexion de AgenDAV

AgenDAV est un client web permettant de manipuler vos calendriers. Il est packagé pour YunoHost et vous pouvez donc l’installer juste après avoir installé Baïkal.

AgenDAV est déjà connecté à Baïkal, aucune manipulation n’est nécessaire. Si vous créez une entrée dans le calendrier Thunderbird + Lightning, il vous suffit d’actualiser votre page AgenDAV pour voir les modifications apparaître.

AgenDAV vous permet également de créer de nouveaux calendriers très simplement.

## Connexion CardDAV

En utilisant l'exemple avec RoundCube Ajoutez un nouveau carnet d’adresses en allant dans Paramètres > Préférences > CardDAV.

Renseigner :
+ Nom du carnet d’adresses : `default`
+ Nom d’utilisateur : `username`
+ Mot de passe : `leMotDePasseAssociéAUusername`
+ URL : `https://example.com/baikal/card.php/addressbooks/username/default`

*En prenant soin de remplacer « example.com » par votre domaine et « username » par votre nom d’utilisateur*

Enregistrer

Le carnet d’adresses est maintenant accessible.

## Liens utiles

 + Site web : [www.baikal-server.com (en)](http://www.baikal-server.com/)
 + Documentation officielle : [sabre.io - baikal (en)](https://sabre.io/baikal/)
 + Dépôt logiciel de l'application : [github.com - YunoHost-Apps/bikal](https://github.com/YunoHost-apps/baikal_ynh)
 + Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/baikal/issues](https://github.com/YunoHost-apps/baikal_ynh/issues)
