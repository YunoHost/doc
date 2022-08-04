---
title: Chat with XMPP
template: docs
taxonomy:
    category: docs
routes:
  default: '/XMPP_server'
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

If you wish to know more about using XMPP, refer to the [User guide](/XMPP).

## Incompatibility with Prosody

Prosody, an alternative XMPP server, is packaged for YunoHost.

It is notably used by Peertube's chat feature, and Jitsi for video conferences. Installing these apps will install Prosody, which needs to disable Metronome to work properly.

! In summary, installing Prosody or an app relying on it will disable the XMPP server.