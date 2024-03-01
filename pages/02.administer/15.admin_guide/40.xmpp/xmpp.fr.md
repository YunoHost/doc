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

## Incompatibilité avec Prosody

Prosody, un serveur XMPP alternatif, est packagé pour YunoHost.

Il est notamment utilisé par le plugin de chat de Peertube, et Jitsi pour des vidéoconférences. Installer ces apps installera Prosody, qui nécessite de désactiver Metronome pour fonctionner.

! En résumé, installer Prosody ou une app en dépendant désactivera le serveur XMPP.