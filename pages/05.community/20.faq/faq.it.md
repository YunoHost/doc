---
title: Domande frequenti
template: docs
taxonomy:
    category: docs
routes:
  default: '/faq'
---

#### Con quale licenza è rilasciato YunoHost?

I pacchetti che si trovano in YunoHost sono rilasciati con licenza GNU AGPL v.3.

YunoHost è basato sulla distribuzione Debian, quindi rispetta le licenze degli elementi sui quali Debian è costruito.

I programmi e i pacchetti hanno la loro propria licenza.

#### Quale obbiettivo si prefigge YunoHost? {#quale-obbiettivo-si-prefi}

Siamo convinti che la decentralizzazione di Internet, e il riappropriarsi della responsabilità e del controllo dei nostri dati e servizi, sia una questione essenziale per garantire una società libera e democratica.

Il progetto YunoHost cerca di democratizzare il self hosting.

Mettiamo a disposizione un software che facilita la gestione e l'amministrazione, in proprio, di un server, riducendo le competenze necessarie e il tempo richiesto.

#### In pratica cosa *fa* YunoHost?

YunoHost è contemporaneamente una distribuzione, cioè una versione di GNU/Linux-Debian dedicata ad uno scopo preciso e arricchita da un insieme di applicazioni che YunoHost contempla nel suo catalogo, sia un "semplice" programma che configura Debian in maniera automatica e gestisce per voi le configurazioni più difficili.

Ad esempio, per installare una istanza WordPress manualmente si devono eseguire una serie complessa di comandi per creare gli utenti, installare un server web,  un server SQL, scaricare l'archivio di WordPress, decomprimerlo, configurare il sever web e il server SQL ed infine configurare WordPress. YunoHost effettua tutte queste operazioni al vostro posto, affinché possiate concentrarvi su cose più importanti.

Maggiori informazioni le potete trovare [qui](/whatsyunohost) !

#### Posso ospitare un sito internet in YunoHost?

Certamente! [Qui](https://github.com/YunoHost-Apps/my_webapp_ynh). trovate tutto quello che vi serve. Questa applicazione fornisce un "contenitore vuoto": alla fine dell'installazione sarà sufficiente inviare i vostri file (via SSH/SCP o SFTP) alla destinazione corretta. Se necessario potrete usare codice PHP o un database SQL.

#### Posso ospitare più di un sito internet con nomi di dominio diversi?

Si è possibile ospitare più siti con domini diversi in quanto YunoHost accetta più nomi di dominio e alcuni programmi di gestione di siti web, come *Wordpress* o *My Webapp*, gestiscono più istanze, potendo quindi installarli più volte.

#### Perché non posso accedere alle mie applicazioni con l'indirizzo  IP del server?

Per motivi tecnici il [SSO](https://github.com/YunoHost/SSOwat/) (Single Sign On) non permette agli utilizzatori di connettersi alla propria dashboard quando si accede al server con il suo indirizzo IP. Se non potete configurare il DNS, una soluzione temporanea è quella di modificare il [file 'hosts' (ultimo §)](/dns_local_network) del proprio computer.

#### Su quale modello economico si basa YunoHost ?

YunoHost è sviluppato da una comunità di volontari durante il loro tempo libero. Il progetto riceve regolarmente donazioni che finanziano principalmente le spese per i server  e le spese di marketing (gli adesivi ;P). Il progetto ha ricevuto (o riceve attualmente) sovvenzioni da parte di organizzazioni quali [NLnet](https://nlnet.nl/) o [CodeLutin](https://www.codelutin.com/) al fine di finaziare lo sviluppo di parti ben definite.

Le donazioni al progetto stanno aumentando e quindi sono allo studio delle iniziative per ridistribuire il ricavato ai principali sviluppatori, al fine di consolidare nel tempo il progetto. Inoltre alcuni sviluppatori svolgono parte della loro attività professionale avvalendosi di YunoHost.

#### Posso fare una donazione al progetto ?

Si è possibile! YunoHost paga server e nomi di dominio, e ci piacerebbe permettere ai nostri collaboratori/trici, di continuare a sviluppare YunoHost piuttosto di doversi cercare un altro lavoro.

Potete donare tramite il [nostro portale per le donazioni](https://donate.yunohost.org)

Se potete, accettiamo anche contributi di diversa natura (una parte della nostra infrastruttura proviene da associazioni che ci forniscono alcuni server).

#### Come posso contribuire al progetto ?

Esistono [diversi modi per contribuire](/contribute) :).

Fateci conoscere le vostre idee!

Un malinteso comune per i nuovi arrivati nei progetti di software libero è quello di credere di "non essere abbastanza competenti". Nella realtà nessuno è "sufficientemente competente" :). Quello che veramente conta è: [piacere per quello che si fa](https://www.youtube.com/watch?v=zIbR5TAz2xQ&t=113s), essere empatici con le persone del progetto, essere pazienti e testardi con i computer, e avere tempo libero. Fare il possibile è già abbastanza!

#### Quale è lo progetto politico di YunoHost ?

È spiegato in [questo documento](/project_organization) :).

#### Potete migrare YunoHost verso la mia [distro preferita] ?

Se vi appassiona la guerriglia tra distribuzioni, o pensate che 'Debian fa schifo', YunoHost non fa per voi.

YunoHost è rivolto ad un pubblico di semplici appassionati, che desiderano semplicemente che tutto funzioni senza dover passare settimane a configurare un servizio. Debian ha dei difetti, ma è una tra (se non "la") le distribuzioni più conosciute e utilizzate per la gestione dei server. È stabile. La maggior parte dei servizi che si possono hostare sono in qualche modo compatibili con Debian. Debian è facilmente personalizzabile da chiunque abbia già utilizzato la linea di comando anche solo sul proprio pc. Nessuna altra distribuzione ha caratteristiche così uniche che renderebbero indispensabile la migrazione di YunoHost verso di essa.

Se questo non vi convince, esistono altri progetti basati su altre distribuzioni e altre filosofie.

#### Ho studiato come funziona il packaging delle app. Perché reinventate [il mio formato preferito dei pacchetti]?

Qualcuno ha cercato di paragonare il sistema di packaging di YunoHost con altri (come ad esempio il `.deb` di Debian) nonostante abbiano scopi diversi. I sistemi di packaging tradizionali sono pensati per installare gli elementi di basso livello come i files, comandi, programmi o servizi sul sistema. Spesso è poi delegato a voi il compito di configurarli opportunamente, semplicemente perché non esiste un ambiente standard. Normalmente le applicazioni web richiedono un importante lavoro di configurazione in quanto hanno bisogno di interfacciarsi con un server web e un database (e l'interfaccia di connessione unica / SSO).

YunoHost esegue delle astrazioni di alto livello (applicazioni, domini, utenti...) e configura un ambiente standard (NGINX, Metronome, SSOwat...) e, grazie a questo, può gestire la configurazione  invece che delegarla all'amministratore.

#### Quando implementerete [il programma che mi piacerebbe]? Perché [la mia app preferita] non è stata compilata? Trovo incredibile che non abbiate ancora implementato [la mia app preferita]!

Noi non fissiamo un calendario.

Siamo una manciata di volontari che impiegano il loro tempo libero per sviluppare e mantenere YunoHost. Non abbiamo un management, non siamo un'azienda, semplicemente facciamo quello che possiamo quando possiamo e per solo amore verso questo software.

Se desiderate che la vostra app preferita sia implementata e documentata [aiutateci](/contribute)! Non vediamo l'ora di aiutarvi a mettervi al lavoro.

### Qual'è la policy a riguardo delle applicazioni incluse nel catalogo ufficiale?

La regola principale è includere nel catalogo ufficiale solo programmi distribuiti con una licenza di software libero.

Tuttavia nello sviluppo di YunoHost sono apparsi alcuni casi dubbi a causa di programmi che potrebbero essere importanti per gli scopi e che coincidono con il suo spirito pur non essendo precisamente software libero. Sono situazioni come:

- programmi che promuovono l'uso di servizi centralizzati pensato proprio per evitarne l'uso diretto;
- programmi che hanno dipendenze o altro non liberi;
- "nuove" licenze post-open-source / etiche-ma-non-libere come ad esempio [ACSL](https://anticapitalist.software/), the [HL3](https://firstdonoharm.dev/) o [CoopCycle License](https://github.com/coopcycle/coopcycle-web/blob/master/LICENSE);
- modelli "open-core", clausole di protezione di marchi o su licenze "business-related" (come ad esempio BSL) pensate per mantenere i progetti pur rimanendo eticamente accettabili.

Pur rimanendo convinti che i principi del software libero siano un passi essenziali per quelli che sono [gli obbiettivi di YunoHost](#quale-obbiettivo-si-prefi) pensiamo anche che questi siano mezzi e non fini. Rifiutiamo la visione purista secondo la quale il software è libero o proprietario e la premessa erronea che la tecnologia sia fondamentalmente neutrale. Crediamo che i programmi e la tecnologia possano e debbano esistere oltre la definizione di software libero pensata 40 anni fa (vedi anche: [Freedom isn't Free](https://logicmag.io/failure/freedom-isnt-free/) e [Post-Open Source](https://www.boringcactus.com/2020/08/13/post-open-source.html)).

Di conseguenza il progetto permette l'inclusione nel catalogo ufficiale ***caso per caso*** di applicazioni che non si definiscono "software libero" ma considerati etici e degni di interesse per [gli obbiettivi di YunoHost](#quale-obbiettivo-si-prefi). Queste applicazioni sono segnalate nel catalogo e un messaggio apposito viene mostrato prima dell'installazione.

Se trovate un'applicazione mancante di tale segnalazione potete parire una discussione o aprire una pull request sul [catalogo della applicazioni](https://github.com/YunoHost/apps/).

Se usate YunoHost per la vostra iniziativa commerciale è vostra responsabilità controllare la licenza dei programmi che volete installare sul vostro server.

### Perché non includete la [caratteristica X]?

YunoHost è pensata per utenti non particolarmente capaci tecnicamente e cerca di rimanere semplice nell'interfaccia. Allo stesso tempo, il progetto è tempi ed energie limitate per la manutenzione e lo sviluppo. Di conseguenza dobbiamo abbassare la priorità delle richieste di caratteristiche o anche di rifiutarle completamente basandosi sui seguenti criteri:

- è utile solo per utenti avanzati, fuori dallo scopo del progetto;
- introduce troppe complicazioni nell'interfaccia;
- copre solo problemi poco realistici;
- soddisfa solo necessità da puristi;
- e soprattutto è troppo pesante in termini di sviluppo e manutenzione, tempo ed energia rispetto al guadagno del progetto.
