---
title: Chat avec XMPP
template: docs
taxonomy:
    category: docs
routes:
  default: '/XMPP_server'
---

![](image://XMPP_logo.png?resize=100)

YunoHost est installé par défaut avec un serveur de messagerie instantanée Metronome qui implémente le [protocole XMPP](https://fr.wikipedia.org/wiki/Extensible_Messaging_and_Presence_Protocol) (anciennement connu sous le nom de Jabber).

Ce protocole est déjà utilisé par des millions de personnes dans le monde - c'est un protocole ouvert. Toutes les applications basées sur XMPP sont compatibles entre elles : lorsque vous utilisez un client XMPP, vous pouvez interagir avec quiconque possède un compte XMPP.

XMPP est un protocole extensible - cela signifie que les utilisateurs peuvent configurer des « extensions » pour les salons de discussions, partager des messages et des fichiers, et passer des appels voix et vidéo en utilisant XMPP.

## Compte XMPP

Pour utiliser XMPP, il est nécessaire de disposer d'un compte dont l'identifiant prend la forme `utilisateur@votre.domaine.tld`, ainsi qu’un mot de passe.

Sous YunoHost, un compte XMPP est créé automatiquement pour chaque utilisateur. Les identifiants XMPP sont simplement l’adresse email principale de l'utilisateur ainsi que son mot de passe.

Si vous souhaitez en savoir plus sur l'utilisation de XMPP, référez-vous au [Guide de l'utilisateur](/XMPP).

## Configuration manuelle
### Configurer le service BOSH
BOSH est une fonctionnalité requise pour que d'autres logiciels comme Conversejs ou JSXC (le client XMPP client pour NextCloud), puissent accéder à votre serveur XMPP.

Le module Metronome est déjà activé par défaut. Vous avez simplement besoin d'installer une application vide pour rendre le service BOSH accessible depuis l'extérieur, ceci en installant l'application Redirect : `yunohost app install redirect -a "domain=your.domain&path=/http-bind&redirect_path=http://localhost:5290/http-bind&redirect_type=public_proxy" -l BOSH`

Sources : 
- https://forum.yunohost.org/t/unable-to-set-up-bosh-conf-nginx/12995 (anglais)
- https://forum.yunohost.org/t/configure-xmpp-in-nextcloud-addon-javascript-xmpp-client/2934/4?u=ashledombos (anglais)

### Configurer le service TURN/STUN
Ce service est nécessaire pour être capable de prendre part à des appels audio ou vidéo, par exemple dans l'application Android Conversations.
Des [instructions pour sa configuration](https://github.com/YunoHost/issues/issues/1607) sont disponibles (anglais).

### Étendre la compatibilité à davantage de types de fichiers (MIME).  
Par défaut, beaucoup de types de fichiers ne peuvent pas être transférés en utilisant ce serveur.
Pour être en mesure d'en utiliser d'autres, il faut ajouter au fichier de configuration XMPP pour votre domaine situé dans `/etc/metronome/conf.d/` la ligne suivante:
```
http_file_add_mime_types = { ["txt"] = "text/plain", ["png"] = "image/png",["jpg"] = "image/jpg", ["pdf"] = "application/pdf", ["doc"] = "application/msword", ["htm"] = "text/html",  ["html"] = "text/html", ["mp3"] = "audio/mpeg3", ["gif"] = "image/gif", ["mp4"] = "video/mp4", ["mpeg"] = "video/mpeg", ["m4a"] = "audio/m4a", ["ogg"] = "application/ogg", ["gpx"] = "application/gpx+xml", ["vcf"] = "text/vcard", ["ics"] = "text/calendar", ["sxw"] = "application/vnd.sun.xml.writer", ["stw"] = "application/vnd.sun.xml.writer.template", ["sxg"] = "application/vnd.sun.xml.writer.global", ["sdw"] = "application/vnd.stardivision.writer", ["vor"] = "application/vnd.stardivision.writer", ["sgl"] = "application/vnd.stardivision.writer-global", ["sxc"] = "application/vnd.sun.xml.calc", ["stc"] = "application/vnd.sun.xml.calc.template", ["sdc"] = "application/vnd.stardivision.calc", ["sxi"] = "application/vnd.sun.xml.impress", ["sti"] = "application/vnd.sun.xml.impress.template", ["sdd"] = "application/vnd.stardivision.impress", ["sdp"] = "application/vnd.stardivision.impress", ["sxd"] = "application/vnd.sun.xml.draw", ["std"] = "application/vnd.sun.xml.draw.template", ["sda"] = "application/vnd.stardivision.draw", ["sxm"] = "application/vnd.sun.xml.math", ["smf"] = "application/vnd.stardivision.math", ["odt"] = "application/vnd.oasis.opendocument.text", ["ott"] = "application/vnd.oasis.opendocument.text-template", ["oth"] = "application/vnd.oasis.opendocument.text-web", ["odm"] = "application/vnd.oasis.opendocument.text-master", ["odg"] = "application/vnd.oasis.opendocument.graphics", ["otg"] = "application/vnd.oasis.opendocument.graphics-template", ["odp"] = "application/vnd.oasis.opendocument.presentation", ["otp"] = "application/vnd.oasis.opendocument.presentation-template", ["ods"] = "application/vnd.oasis.opendocument.spreadsheet", ["ots"] = "application/vnd.oasis.opendocument.spreadsheet-template", ["odc"] = "application/vnd.oasis.opendocument.chart", ["odf"] = "application/vnd.oasis.opendocument.formula", ["odb"] = "application/vnd.oasis.opendocument.database", ["odi"] = "application/vnd.oasis.opendocument.image" }
```

## Les limites de Metronome dans Yunohost
- https://github.com/maranda/metronome/issues/549 (anglais)

## Incompatibilité avec Prosody

Prosody, un serveur XMPP alternatif, est packagé pour YunoHost.

Il est notamment utilisé par le plugin de chat de Peertube, et Jitsi pour des vidéoconférences. Installer ces apps installera Prosody, qui nécessite de désactiver Metronome pour fonctionner.

! En résumé, installer Prosody ou une app en dépendant désactivera le serveur XMPP.
! Un essai visant à remplacer Metronome par Prosody [a été documenté](https://sebseb01.net/blog/2023-poc-yunohost-metronome-prosody); ceci est toutefois communiqué à titre expérimental, et donc à utiliser à vos risques et périls!
