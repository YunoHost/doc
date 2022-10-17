---
title: Avvisi e linee guida
template: docs
taxonomy:
    category: docs
routes:
  default: '/guidelines'
---

Questa pagina elenca qualche consiglio e delle linee guida che tutti gli amministratori di YunoHost dovrebbero conoscere per prendersi cura del proprio server :).

## Non rompere YunoHost

In altre parole: il tuo server può essere un "server in produzione" (destinato a funzionare), oppure un server di test che ti permette di sperimentare.

Se il tuo obiettivo è avere un server in produzione:
- sii consapevole che i server sono sistemi fragili: sii prudente, metodico e paziente;
- limita gli esperimenti e le personalizzazioni (per le istanze il file config)
- non installare dozzine di installazioni solo per vedere come sono;
- usa le applicazioni non ufficiali con prudenza, e evita di usare quelle 'in progress', 'not working' o che hanno un livello 0;
- se qualcosa dovesse rompersi, pensate due volte prima di cercare di riparare da soli se non sapete quello che state facendo. <small>(Per esempio, non tentate di ricreare da soli l'utente admin solo perché sembra che sia misteriosamente scomparso...)</small>

## Keep it simple !

YunoHost è progettato per funzionare in casi d'uso generici e semplici. Deviare da queste condizioni renderà le cose più difficili e avrai bisogno di conoscenze tecniche perché tutto funzioni. Per esempio,
- non provare ad eseguire YunoHost in un contesto dove non puoi controllare le porte 80 e 443 (o senza Internet del tutto);
- non provare a hostare cinque server dietro la stessa connessione Internet se non sei un utente esperto;
- non cadere nei capricci dei nerd che vogliono sostituire NGINX con Apache (o farli girare tutti e due insieme);
- non cercare di usare certificati SSL personalizzati se non ne hai veramente bisogno;
- ...

Tieni le cose più semplici possibili!

## Non reinstallate tutti i giorni

Alcune persone hanno la tendenza a cadere nella "spirale di reinstallazione" - dove ogni volta che qualcosa nel server si rompe e non è semplice capire come ripararlo, o perché il server diventa "sporco", l'amministratore decide di reinstallare tutto il server da zero perché sembra una soluzione "facile" e veloce per rimettere le cose a posto.

Non farlo. La reinstallazione è un'operazione difficile e non è un buona strategia a lungo termine per risolvere i problemi. Ti stancherai e non imparerai niente. Dimentica il sogno di avere un server "pulito". Nella vita reale il server sarà sempre "sporco". In più, dovrai imparare (progressivamente) a risolvere i problemi che incontrerai. [Chiedi aiuto](/help) con i dettagli dei sintomi, quello che hai provato a fare e cosa è successo e correggi i problemi. Con il tempo, avrai un controllo migliore sul tuo server piuttosto che reinstallare alla cieca tutte le volte.

## Fai i backup

Se ospiti dei servizi e dei dati che sono importanti per i tuoi utenti, è importante mettere in atto una policy di backup. I backup possono essere creati facilmente a partire dall'interfaccia web di amministrazione - anche se non possono attualmente essere scaricati da li (ma possono essere scaricati con un altro mezzo). Dovrai effettuare regolarmente dei backup e custodirli in un luogo fisico diverso dal tuo server. Trovi altre informazioni nella [documentazione di backup](/backup).

## Controlla le mail inviate a root

Come amministratore, dovrai configurare un client di posta per controllare le mail inviate a `root@your.domani.tld` (che dovrà essere un alias per il primo utente che aggiungerai) o trasferitele ad un altro indirizzo mail che controlli attivamente. Queste mail possono contenere informazioni riguardo quello che avviene sul tuo server, come i compiti periodici automatici.

## YunoHost è software libero, mantenuto da volontari.

Infine, tieni presente che YunoHost è software libero mantenuto da volontari - e che l'obiettivo di YunoHost (democratizzare il self-hosting) non è semplice! Il software è fornito senza nessuna garanzia. Il team di volontari fa del suo meglio per mantenere e fornire la migliore esperienza possibile - quindi le funzionalità, le applicazioni e YunoHost nel suo insieme sono lontani dall'essere perfetti e presto o tardi incontrerai piccoli o grossi problemi. Quando accadrà potrai [chiedere aiuto sulla chat o nel forum, o segnalare il problema](/help) :)!

Se ti piace YunoHost e vuoi vedere il progetto aggiornato e sviluppato, non esitare a lasciare un commento di ringraziamento e a [dare un contributo](https://liberpay.com/YunoHost) al progetto e a parlarne agli altri!

Infine, poiché YunoHost è un progetto di software libero, sei autorizzato e benvenuto a [contribuire](/contribute) al progetto, sia per quanto riguarda gli aspetti tecnici (per esempio il codice) e meno tecnici (come per esempio contribuire a questa documentazione ;))!
