---
title: Chat, Voip e social network con XMPP
template: docs
taxonomy:
    category: docs
routes:
  default: '/XMPP'
---

![](image://XMPP_logo.png?resize=100)

L'installazione di YunoHost comprende il server di messaggistica istantanea Metronome che supporta il [protocollo XMPP](https://it.wikipedia.org/wiki/Extensible_Messaging_and_Presence_Protocol) (precedentemente conosciuto come Jabber). 

Questo protocollo utilizzato da milioni di persone nel mondo è un protocollo aperto.
Tutte le applicazioni basate su XMPP sono tra di loro compatibili: quando utilizzate un client XMPP potete interagire con chiunque possieda un account XMPP.

XMPP è un protocollo espandibile: ciò significa che gli utenti possono configurare delle estensioni per le loro "stanze" di discussione, condividere messaggi e file, effettuare chiamate vocali e  video utilizzando XMPP.

## Account XMPP

Per utilizzare XMPP è necessario disporre di un account che rispetti questa sintassi come identificativo: `utente@mio.dominio.tld` e di una password.

In YunoHost un account XMPP è creato automaticamente per ogni utente. 
L'identificativo XMPP corrisponde all'indirizzo mail principale di ogni utente e relativa password.

## Collegarsi al proprio account XMPP YunoHost

Esistono diversi client per connettersi all'account XMPP.

### Client web

- [Movim](https://movim.eu/)
- [ConverseJS](https://conversejs.org/)
- [Libervia/Salut à Toi](https://salut-a-toi.org/)

### Client per pc

- [Gajim](http://gajim.org/) (Linux, Windows)
- [Dino](https://dino.im/) (Linux)
- [Thunderbird](https://www.thunderbird.net/) (multi-piattaforma)
- [Beagle IM](https://beagle.im/) (macOS)
- [Profanity](https://profanity-im.github.io/) (Linux)

### Client per smartphone

- [Conversations](https://conversations.im/) (Android)
- [Xabber](http://xabber.com/) (Android)
- [Movim](https://movim.eu/) (Android)
- [Monal](https://monal.im/) (iOS)
- [ChatSecure](https://chatsecure.org/) (iOS)
- [Siskin IM](https://siskin.im/) (iOS)
- [Kaidan](https://www.kaidan.im/) (Ubuntu Touch / Plasma Mobile)

Qui un elenco completo dei client XMPP [Qui](https://fr.wikipedia.org/wiki/Liste_de_clients_XMPP) trovate

## Cifrare le conversazioni con OMEMO

È possibile proteggere e cifrare le conversazioni con l'uso di [OMEMO encryption](https://xmpp.org/extensions/xep-0384.html), ben supportato in Gajim:
- Installate `gajim` e il plugim `gajim-omemo`.
- Attivate il plugin nel menù `Strumenti > Plugins`.
- Attivate la cifratura in una conversazione con un contatto che adotta OMEMO

## Discussioni di gruppo

Per creare un gruppo di discussione (Multi-user chat) sul vostro server YunoHost, dovete usare l'identificativo `nomedelgruppo@muc.miodominio.tld` (dove miodominio.tld è il dominio principale del vostro server).

Se utilizzate un dominio personale, dovete [aggiungere un record `muc` nel DNS](/dns_config) nella configurazione del DNS.

## VoIP e videochiamate

Il client [Jitsi](https://jitsi.org/) permette di effettuare agevolmente chiamate VoIP e video chiamate.
