# Chat, VoIP and social network with <img src="/images/XMPP_logo.png" width=100>

YunoHost comes installed with an instant messaging server Metronome which implements the [XMPP protocol](https://en.wikipedia.org/wiki/Extensible_Messaging_and_Presence_Protocol).

XMPP is an open and extensible protocol which allows to create chatrooms, to share status and data, to give calls in VoIP and videoconferences.

All applications based on XMPP are compatible with each other : when using an XMPP client, you can interact with anybody who has an XMPP/Jabber account. This protocol is already used by millions of people around the world.

### XMPP/Jabber account

An XMPP/Jabber account is based on an identifier with the structure `user@domain.tld`, and a password.

In YunoHost, this identifier simply corresponds to the main email address of a user, with his regular password.

### Connecting to XMPP 

There are several web client built with social network features :
- [Movim](https://pod.movim.eu)
- [Libervia/Salut à Toi](http://salut-a-toi.org/).

You can also use a desktop client such as :
- [Pidgin](http://pidgin.im/) (multiplatform), 
- [Gajim](http://gajim.org/) (Linux), 
- [Dino](https://dino.im) (Linux),
- [Thunderbird](https://www.thundebird.net/) (multiplatform), 
- [Jitsi](http://jitsi.org/) (multiplatform) 
- [Adium](https://adium.im/) (Mac OS).

... or a mobile client
* [Xabber](http://xabber.com) (Android)
* [Conversations](https://conversations.im/) (Android)
* [Movim under Android](https://movim.eu)
* [Monal](https://itunes.apple.com/us/app/monal-free-xmpp-chat/id317711500?mt=8) (iOS)

Here is an exhaustive list of XMPP clients : https://en.wikipedia.org/wiki/Comparison_of_XMPP_clients

### Encrypt conversations with OMEMO

XMPP chats can be encrypted with the help of [OMEMO](https://xmpp.org/extensions/xep-0384.html), for instance using Gajim :
* Install `gajim` and the plugin `gajim-omemo`
* Enable the plugin in `Tools > Plugins`
* Enable it
* Enable the encryption in the chat with somebody who also has OMEMO

### Chatrooms

To create a chatroom (multi-user chat) on your YunoHost server, use the identifier `chatroomname@muc.yourdomain.tld`.

For this to workm you need to [add the corresponding `muc.` DNS record](dns_config_fr) in the DNS configuration.

### VoIP and visioconferences

A practical tool to call an XMPP client, either with voice or voice+video, is to use the client [Jitsi](http://jitsi.org/).
