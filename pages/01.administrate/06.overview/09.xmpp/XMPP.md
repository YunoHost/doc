---
title: Chat, VoIP and social network with XMPP
template: docs
taxonomy:
    category: docs
routes:
  default: '/XMPP'
---

![](image://XMPP_logo.png?resize=100)

By default, YunoHost comes installed with an instant messaging server called Metronome which implements the [XMPP protocol](https://en.wikipedia.org/wiki/Extensible_Messaging_and_Presence_Protocol) (previously known as Jabber).

This protocol is already used by millions of people around the world—it is an open protocol.
All applications based on XMPP are compatible with each other: When using an XMPP client, you can interact with anybody who has an XMPP account.

XMPP is an extensible protocol—this means users can configure "extensions" to chatrooms, share messages and files, and make voice and video calls using XMPP.

## XMPP account

To use an XMPP account you need a username, in the format: `user@domain.tld`, and a password.

With YunoHost, an XMPP account is created for all YunoHost users automatically.
The XMPP account credentials corresponds to the user's main e-mail address and password.

## Connecting to your YunoHost XMPP account

You can connect to your YunoHost XMPP account in different ways.

### Web clients

- [Movim](https://movim.eu)
- [ConverseJS](https://conversejs.org/)
- [Libervia/Salut à Toi](https://salut-a-toi.org/)

### Desktop clients

- [Gajim](https://gajim.org/) (Linux, Windows)
- [Dino](https://dino.im) (Linux)
- [Thunderbird](https://www.thunderbird.net/fr/) (multiplatform)
- [Beagle IM](https://beagle.im/) (macOS)
- [Profanity](https://profanity-im.github.io/) (Linux)

### Mobile clients

- [Conversations](https://conversations.im/) (Android)
- [Xabber](https://xabber.com) (Android)
- [Movim](https://movim.eu) (Android)
- [ChatSecure](https://chatsecure.org/) (iOS)
- [Monal](https://monal.im/) (iOS)
- [Siskin IM](https://siskin.im/) (iOS)
- [Kaidan](https://www.kaidan.im/) (Ubuntu Touch / Plasma Mobile)

Here is an exhaustive list of XMPP clients: https://xmpp.org/software/clients.html

## Encrypt conversations with OMEMO

XMPP chats can be made secure and private using [OMEMO encryption](https://xmpp.org/extensions/xep-0384.html), for instance using Gajim:
- Install `gajim` and the plugin `gajim-omemo`.
- Turn on the plugin in `Tools > Plugins`.
- Turn on the encryption in the chat with somebody who also has OMEMO.

## Chatrooms

To create a chatroom (multi-user chat) on your YunoHost server, use the identifier `chatroomname@muc.yourdomain.tld`.

For this to work you need to [add the corresponding `muc.` DNS record](/dns_config) in the DNS configuration.

## VoIP and videoconferences

A practical tool to call an XMPP client, either with voice or voice+video, is to use the [Jitsi](https://jitsi.org/) client.
