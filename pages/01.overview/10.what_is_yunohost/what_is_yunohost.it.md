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
- ![](image://icon-tools.png?resize=32&classes=inline) Amministra il tuo server attraverso **un'interfaccia web amichevole** ;
- ![](image://icon-package.png?resize=32&classes=inline) Installa le **applicazioni in pochi clic**;
- ![](image://icon-users.png?resize=32&classes=inline) Gestisci **gli utenti** <small>(basato su LDAP)</small>;
- ![](image://icon-globe.png?resize=32&classes=inline) Gestisci **i nomi di dominio**;
- ![](image://icon-medic.png?resize=32&classes=inline) Crea e ripristina  **i backup**;
- ![](image://icon-door.png?resize=32&classes=inline) Connettiti contemporaneamente a tutte le applicazioni  attraverso **il portale utente** <small>(NGINX, SSOwat)</small>;
- ![](image://icon-mail.png?resize=32&classes=inline) Include uno **stack di posta elettronica completo** <small>(Postfix, Dovecot, Rspamd, DKIM)</small>;
- ![](image://icon-lock.png?resize=32&classes=inline) Gestisce i **certificati SSL** <small>(basati su Let's Encrypt)</small> ;
- ![](image://icon-shield.png?resize=32&classes=inline)... e i **sistemi di sicurezza** <small>(`fail2ban`, `yunohost-firewall`)</small>;

## Origine

YunoHost è stata creata nel febbraio 2012 dopo qualcosa del genere:

> "Merda, sono troppo pigro per riconfigurare il mio server di posta... Beudbeud, come sei riuscito a far funzionare il tuo piccolo server con LDAP?"
> <small>Kload, Febbraio 2012</small>

Tutto ciò che serviva era un'interfaccia di amministrazione per il server di Beudbeud per creare qualcosa di utilizzabile, così Kload ha deciso di svilupparne una. Alla fine, dopo aver automatizzato diverse configurazioni e aver inserito alcune applicazioni web, YunoHost versione 1 è stato completato.

Notando il crescente entusiasmo intorno a YunoHost e al self-hosting in generale, gli sviluppatori originari e i nuovi collaboratori hanno deciso di iniziare a lavorare alla versione 2, una versione più estensibile, più potente, più facile da usare e che prepara una bella tazza di caffè equo-solidale per gli elfi della Lapponia.

Il nome **YunoHost** deriva dal gergo "Y U NO Host". Il [meme Internet](https://en.wikipedia.org/wiki/Internet_meme) dovrebbe illustrarlo:
![](image://dude_yunohost.jpg)

## Cosa non è YunoHost?

Anche se YunoHost è in grado di gestire più domini e più utenti, **non è pensato per essere un sistema mutualizzato.**.

In primo luogo, il software è troppo giovane, non è stato testato su larga scala e quindi probabilmente non è sufficientemente ottimizzato per centinaia di utenti contemporaneamente. Detto questo, non vogliamo sviluppare il software in quella direzione. La virtualizzazione è sempre più diffusa e il suo utilizzo è consigliato in quanto è un modo più sicuro per ottenere la mutualizzazione rispetto a un sistema "full-stack" come YunoHost.

Potete ospitare i vostri amici, la vostra famiglia e la vostra azienda in tutta sicurezza e facilità, ma dovete **fidarvi dei vostri utenti**, e soprattutto loro devono fidarsi di voi. Se volete comunque fornire i servizi YunoHost a persone sconosciute, un VPS completo per utente andrà benissimo e riteniamo che sia una soluzione migliore.

## Logo

Il logo PNG di YunoHost in bianco e nero di ToZz (400 × 400 px):

![](image://ynh_logo_black_300dpi.png?resize=220)
![](image://ynh_logo_white_300dpi.png?resize=220&id=whitelogo)

Licenza: CC-BY-SA 4.0
