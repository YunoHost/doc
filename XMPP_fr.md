#Chat, VoIP et réseau social avec <img src="/images/XMPP_logo.png" width=100>

Yunohost est installé par défaut avec un serveur de messagerie instantanée Metronome qui implémente le [protocole XMPP](https://fr.wikipedia.org/wiki/Extensible_Messaging_and_Presence_Protocol) (anciennement connu sous le nom Jabber).

Ce protocole est déjà utilisé par des millions de personnes dans le monde - c'est un protocole ouvert. Toutes les applications basées sur XMPP sont compatibles entre elles : lorsque vous utilisez un client XMPP, vous pouvez interagir avec quiconque possède un compte XMPP.

XMPP est un protocole extensible - cela signifie que les utilisateurs peuvent configurer des "extensions" pour les salons de discussions, partager des messages et des fichiers, et passer des appels voix et vidéo en utilisant XMPP.

## Compte XMPP

Pour utiliser XMPP, il est nécessaire de disposer d'un compte dont l'identifiant prends la forme `utilisateur@domaine.tld`, ainsi qu’un mot de passe.

Sous Yunohost, un compte XMPP est créé automatiquement pour chaque utilisateur. Les identifiants XMPP sont simplement l’adresse courriel principale de l'utilisateur ainsi que son mot de passe.

## Se connecter à son compte XMPP YunoHost

Il existe différents types de clients pour se connecter à XMPP.

### Clients web

- [Movim](https://pod.movim.eu)
- [Libervia/Salut à Toi](http://salut-a-toi.org/).

### Clients de bureau

- [Pidgin](http://pidgin.im/) (multiplateforme),
- [Gajim](http://gajim.org/index.fr.html) (Linux, Windows),
- [Dino](https://dino.im) (Linux),
- [Thunderbird](https://www.mozilla.org/fr/thunderbird/) (multiplateforme),
- [Jitsi](http://jitsi.org/) (multiplateforme)
- [Adium](https://adium.im/) (Mac OS).

### Clients sur mobile

* [Xabber](http://xabber.com) (Android)
* [Conversations](https://conversations.im/) (Android)
* [Movim sous Android](https://movim.eu)
* [Monal](https://itunes.apple.com/us/app/monal-free-xmpp-chat/id317711500?mt=8) (iOS)
- [Kaidan](https://github.com/KaidanIM/Kaidan) (Ubuntu Touch / Plasma Mobile)

Voici une liste plus exhaustive des clients XMPP : https://fr.wikipedia.org/wiki/Liste_de_clients_XMPP

## Chiffrer ses conversations avec OMEMO

Il est possible de rendre les conversations plus sécurisées et privées en les chiffrants à l'aide de [OMEMO](https://xmpp.org/extensions/xep-0384.html), notamment en utilisant Gajim :
- Installer `gajim` et le plugin `gajim-omemo`
- Activez le plugins dans `Outils > Plugins`
- L'activer
- Activez le chiffrement dans une conversation avec un contact disposant de OMEMO.

## Salon de discussion

Pour créer un salon de discussion (Multi-user chat) sur votre serveur Yunohost utilisez l’identifiant nomsalon@muc.domaine.tld (où domaine.tld est le domaine principal de votre serveur).

Si vous utilisez un nom de domaine personnel, il est nécessaire d’[ajouter une redirection de type CNAME pour le sous domaine `muc.`](dns_config_fr) au niveau de votre serveur DNS.

## VoIP et visioconférence

Un moyen pratique d’appeler un contact XMPP, en VoIP ou en appel vidéo, est d’utiliser le client [Jitsi](http://jitsi.org/).
