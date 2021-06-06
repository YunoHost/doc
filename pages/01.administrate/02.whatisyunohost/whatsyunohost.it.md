---
title: Cosa è YunoHost?
template: docs
taxonomy:
    category: docs
routes:
  default: '/whatsyunohost'
---

![YunoHost logo](image://YunoHost_logo_vertical.png?resize=400&id=ynhlogo)

YunoHost è un **sistema operativo** che mira a rendere il più semplice possibile l'amministrazione di un **server**  e quindi a permettere ad un numero sempre maggiore di persone di avvicinarsi al [self-hosting](/selfhosting), assicurandosi che la gestione del server rimanga affidabile, sicura ed etica. Si tratta di un progetto basato su software libero e copyleft gestito esclusivamente da volontari. Tecnicamente YunoHost può essere vista come una distribuzione basata su [Debian GNU/Linux](https://debian.org) che può essere installata su [diverse tipologie di hardware](/install).

## Caratteristiche

- ![](image://icon-debian.png?resize=32&classes=inline) Basato su Debian;
- ![](image://icon-tools.png?resize=32&classes=inline) Amministra il tuo server attraverso una **semplice interfaccia grafica** ;
- ![](image://icon-package.png?resize=32&classes=inline) Installa **applicazioni e servizi in pochi click**;
- ![](image://icon-users.png?resize=32&classes=inline) Gestisci gli **utenti** <small>(basato su LDAP)</small>;
- ![](image://icon-globe.png?resize=32&classes=inline) Manage **domain names**;
- ![](image://icon-medic.png?resize=32&classes=inline) Create and restore **backups**;
- ![](image://icon-door.png?resize=32&classes=inline) Connect to all apps simultaneously through the **user portal** <small>(NGINX, SSOwat)</small>;
- ![](image://icon-mail.png?resize=32&classes=inline) Includes a **full e-mail stack** <small>(Postfix, Dovecot, Rspamd, DKIM)</small>;
- ![](image://icon-messaging.png?resize=32&classes=inline)... as well as **an instant messaging server** <small>(XMPP)</small>;
- ![](image://icon-lock.png?resize=32&classes=inline) Manages **SSL certificates** <small>(based on Let's Encrypt)</small> ;
- ![](image://icon-shield.png?resize=32&classes=inline)... and **security systems** <small>(Fail2ban, yunohost-firewall)</small>;

## Origine

YunoHost fu creato nel febbraio 2012 quando successe qualcosa di questo genere:

<blockquote><p>"Merda, sono troppo sfaticato per riconfigurare il mio server mail... Beudbeud, come sei riuscito a far funzionare il tuo piccolo server con LDAP?"</p><small>Kload, febbraio 2012</small></blockquote>

Era necessaria un'interfaccia di configurazione per il server di Beudbeud che fosse abbastanza usabile così Kload decise di svilupparne una. Così, dopo aver automatizzato alcune configurazioni e l'installazione di alcune applicazioni web, YunoHost v1 fu terminata.

Notando il crescente entusiasmo per YunoHost e per il self-hosting in generale, i primi sviluppatori e alcuni nuovi contributori decisero di iniziare lo sviluppo della versione 2, più estensibile, potente e facile da usare come una piacevole tazza di caffè equo e solidale per gli elfi di Lapland.

Il nome **YunoHost** deriva dallo slang jargon "Y U NO Host". Il [meme Internet](https://en.wikipedia.org/wiki/Internet_meme) dovrebbe renderlo più chiaro:
![](image://dude_yunohost.jpg)

## Cosa non è YunoHost?

Sebbene YunoHost possa gestire domini e utenti multipli **non è pensato per essere un sistema condiviso**.

Innanzitutto il software è troppo giovane e non testato in produzione, di conseguenza probabilmente non è ottimizzato per essere utilizzato con centinaia di utenti contemporanei.

Detto questo non è nostra intenzione sviluppare il software in quella direzione. La virtualizzazione semplifica e usarla è raccomandabile poiché è una modalità più stabile per ottenere un sistema condiviso rispetto ad un sistema "full-stack" come YunoHost.

È possibile ospitare in sicurezza e con facilità i propri amici, familiari e la tua ditta ma è necessario **avere utenti fidati** e soprattutto questi devono potersi fidare di te. Se invece vuoi offrire i servizi di YunoHost per persone sconosciute una VPS dedicata per ogni utente è preferibile e secondo noi è un modo migliore.

## Artwork

Logo di YunoHost in bianco e nero creato da ToZz (400 × 400 px):

![](image://ynh_logo_black_300dpi.png?resize=220)
![](image://ynh_logo_white_300dpi.png?resize=220&id=whitelogo)

Licence: CC-BY-SA 4.0
