---
title: Chatcon XMPP
template: docs
taxonomy:
    category: docs
routes:
  default: '/XMPP_server'
---

![](image://XMPP_logo.png?resize=100)

YunoHost está instalado con un servidor de mensajería instantánea Metronome que implementa el [protocolo XMPP](https://es.wikipedia.org/wiki/Extensible_Messaging_and_Presence_Protocol).

XMPP es un protocolo abierto y extensible que también permite crear salones de discusión, compartir status y datos, echar llamadas en VoIP y hacer videoconferencias. 

Todas las aplicaciones basadas en XMPP son compatibles entre ellas : cuando utilizas un cliente XMPP puedes discutir con cualquier persona que tenga una cuenta XMPP/Jabber. Este protocolo ya es utilizado por millones de personas en el mundo. 

## Cuenta XMPP/Jabber

Una cuenta XMPP/Jabber está basada en un ID bajo la forma `usuario@dominio.tld`, así como una contraseña. La contraseña es la de la cuenta del usuario de YunoHost.

Si desea saber más sobre el uso de XMPP, consulte el [Manual del usuario](/XMPP).

## Incompatibilidad con Prosody

Prosody, un servidor XMPP alternativo, está empaquetado para YunoHost.

En particular, lo utilizan el plugin de chat Peertube y Jitsi para las videoconferencias. Estas aplicaciones instalará Prosody, que requiere que Metronome esté desactivado para funcionar.

! En pocas palabras, la instalación de Prosody o de una aplicación que dependa de ella desactivará el servidor XMPP.