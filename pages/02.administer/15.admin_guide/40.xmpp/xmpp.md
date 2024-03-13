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

## Manual configuration
### Configure BOSH
BOSH is a functionality required so that other softwares can access you XMPP server like Conversejs or JSXC, the XMPP client for NextCloud.

The Metronome module is already activated by default, you just need to install a blank app to make the service BOSH accessible from outside, by installing the app Redirect : yunohost app install redirect -a "domain=your.domain&path=/http-bind&redirect_path=http://localhost:5290/http-bind&redirect_type=public_proxy" -l BOSH

Source : https://forum.yunohost.org/t/unable-to-set-up-bosh-conf-nginx/12995 https://forum.yunohost.org/t/configure-xmpp-in-nextcloud-addon-javascript-xmpp-client/2934/4?u=ashledombos

### Configure TURN/STUN
This service is needed to by able to have audio/video calls in Conversations.
See configuration in https://github.com/YunoHost/issues/issues/1607

### Extend supported MIME-type 
By default, many filetype cannot be sent when using this server.
See configuration in https://forum.yunohost.org/t/metronome-mime-types-for-metronome-again/20073

## Know limitations of Metronome in Yunohost
* https://github.com/maranda/metronome/issues/549 

## Incompatibility with Prosody

Prosody, an alternative XMPP server, is packaged for YunoHost.

It is notably used by Peertube's chat feature, and Jitsi for video conferences. Installing these apps will install Prosody, which needs to disable Metronome to work properly.

! In summary, installing Prosody or an app relying on it will disable the XMPP server.
! A proof of concept of switch from Metronome to Prosody has been documented https://sebseb01.net/blog/2023-poc-yunohost-metronome-prosody (french); experiemental, use at your own risk !
