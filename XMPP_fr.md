#Chat, VoIP et réseau social avec <img src="/images/XMPP_logo.png" width=100>

Yunohost est installé avec un serveur de messagerie instantanée <abbr title="Extensible Messaging and Presence Protocol">XMPP</abbr> (metronome).

Vous pouvez discuter simplement avec des contacts XMPP/Jabber en installant l’application [Jappix](https://jappix.com/) le lien GitHub `https://github.com/YunoHost-Apps/jappix_ynh` ou depuis Jappix du dépôt communautaire.

[XMPP](https://fr.wikipedia.org/wiki/Extensible_Messaging_and_Presence_Protocol) est un protocole ouvert et extensible qui permet également de créer des salons de discussions, de partager des statuts et des données, de passer des appels en VoIP et de faire de la visioconférence.

Toutes les applications basées sur XMPP sont compatibles entre-elles : lorsque vous utilisez un client XMPP vous pouvez discuter avec n’importe quel.le possesseur.e d’un compte XMPP/Jabber. Ce protocole est déjà utilisé par des millions de personnes dans le monde.

### Compte XMPP/Jabber

Un compte XMPP/Jabber est basé sur un identifiant sous la forme `utilisateur@domaine.tld`, ainsi qu’un mot de passe.

Sous yunohost, cet identifiant correspond simplement à l’adresse courriel principale d’un utilisateur. Le mot de passe est celui du compte de l’utilisateur.

### Utiliser un autre client XMPP

En plus de Jappix, il existe d’autres clients web orientés réseau social, comme [Movim](https://pod.movim.eu) ou [Libervia/Salut à Toi](http://salut-a-toi.org/).

Vous pouvez également utiliser un client desktop comme [Pidgin](http://pidgin.im/) (multiplateforme), [Gajim](http://gajim.org/index.fr.html) (Linux), [thunderbird](https://www.mozilla.org/fr/thunderbird/) (multiplateforme), [Jitsi](http://jitsi.org/) (multiplateforme) ou [Adium](https://adium.im/) (Mac OS).

... ou un client smartphone
* [Xabber](http://xabber.com) (Android)
* [Movim sous Android](https://movim.eu)
* [Monal](https://itunes.apple.com/us/app/monal-free-xmpp-chat/id317711500?mt=8) (iOS)

Voici une liste plus exhaustive des clients XMPP : https://fr.wikipedia.org/wiki/Liste_de_clients_XMPP

### Chiffrer ses conversations avec OMEMO

Il est possible de chiffrer ses conversations XMPP à l’aide de [OMEMO](https://xmpp.org/extensions/xep-0384.html), notamment en utilisant Gajim :
* Installer `gajim` et le plugin `gajim-omemo`
* Activez le plugins dans `Outils > Plugins`
* L'activer
* Activez le chiffrement dans une conversation avec un contact disposant de OMEMO.

### Salon de discussion

Pour créer un salon de discussion (Multi-user chat) sur votre serveur Yunohost utilisez l’identifiant nomsalon@muc.domaine.tld (où domaine.tld est le domaine principal de votre serveur).

Si vous utilisez un nom de domaine personnel, il est nécessaire d’[ajouter une redirection de `type CNAME` pour le sous domaine `muc.`](dns_config_fr) au niveau de votre serveur DNS.

### VoIP et visioconférence

Un moyen pratique d’appeler un contact XMPP, en VoIP ou en appel vidéo, est d’utiliser le client [Jitsi](http://jitsi.org/).
