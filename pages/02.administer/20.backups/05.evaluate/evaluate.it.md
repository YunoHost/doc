# ---
title: Strategie di backup
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup_strategies'
page-toc:
  active: true
  depth: 3
---


In un contesto di self hosting le strategie di backup sono un fattore chiave per sopperire ad eventi inattesi (incendio, corruzione del database, impossibilità di accedere al server, compromissione del server...). La tipologia di backup da adottare dipende dalla importanza dei dati e dei servizi che vogliamo proteggere. Ad esempio, nel contesto di un server di test possiamo evitare un backup integrale (dati e sistema operativo), al contrario, dovremo porre molta più attenzione nel caso di un server in produzione che contenga dati importanti. In questo caso è necessario conservare più copie di backup *in posti diversi*.

## Ottimizzare il backup
Un buon backuo consiste in almeno **tre copie dei dati** (compreso l'originale), salvate su almeno **due supporti distinti** che si trovano a loro volta **in due luoghi distinti** (sufficientemente lontani tra loro) e con due diversi sistemi di stoccaggio. Se il vostro backup è cifrato **questa regola aurea si applica anche alla password o frase di decifrazione**.

Un buon backup deve anche essere recente, dovrete quindi essere molto precisi e quando possibile **automatizzare il processo**.

Controllate sempre l'integrità del file di backup.

Per ultimo, un buon backup **deve essere facilmente e velocemente accessibile**. Ricorda di documentare il metodo di recupero e di controllare la velocità delle connessioni in download specialmente se la connessione Internet non è simmetrica.


!! Esempi di **backup sicuro e facilmente recuperabile**.
* backup remoto e automatizzato con borg
* backup automatizzato su unità locale esterna con borg
* snapshot o immagine (eseguiti prima di ogni aggiornamento)
* server monitorato con RAID 1 (o una VPS commerciale che può essere su un array)
* password di decifratura salvata su (tre supporti e due luoghi diversi)

## Alcuni esempi di esecuzione del backup

* [creare un file di backup e salvarlo manualmente (scelta di default per YunoHost)](/backup#manual-backup)
* [backup automatizzato (scelta consigliata)](/backup#automatic-or-remote-backup)
* [backup su disco esterno](/external_storage)
* [creazione di un'immagine o snapshot](/backup/clone_filesystem)
* [salvataggio dei dati con metodo personalizzato](/backup/custom_backup_methods)


## Rischi
Di seguito un elenco di errori in ordine crescente di pericolosità. L'ordine proposto varia in base alla vostra situazione (tipo di server, complessità dell'installazione, permessi degli utenti), ponete attenzione alla vostra configurazione, avendo ben presenti le conseguenze di una possibile perdita dei dati.

!!! Tenete presente che i rischi reali sono collegati all'evenienza di 2 eventi contemporanei

* **Imprecisione**: i backup manuali richiedono rigore e regolarità
* **Errata gestione**: cancellazione involontaria di un file di backup in un sistema di sincronizzazione client server di backup, cancellazione che si propaga instantaneamente
* **Cryptolocker**: si tratta di virus che cifrano i file e chiedono un riscatto. Se i vostri utenti usano nextcloud e windows un sistema windows infetto può sincronizzare file cifrati perdendo così le copie di backup.
* **Guasto hardware**: le schede SD sono i supporti meno affidabili nel tempo (si stima meno di 2 anni di vita in un server), seguite dai dischi SSD (circa 3 anni di vita) e i dischi HD (3 anni). Ricordate che neppure un'infrastruttura nuova è esente al 100% da guasti nei primi sei mesi di vita. In ogni caso le copie non devono stare sugli stessi supporti fisici.
* **Bug software**: il malfunzionamento del software può portare alla perdita dei dati oppure potreste non sapere come risolvere un problema e quindi vorrete recuperare il vostro sistema.
* **Assenza di energia elettrica o connessione**: prevedete un piano di azione se dovesse succedere...quando siete in vacanza.
* **Catastrofi naturali e non**: un bambino o di un gatto, un fulmine o una perdita di acqua, incendio e inondazioni possono rovinare il vostro backup custodito nella stanza adiacente.
* **Compromissione del server**: un attacco informatico diretto al vostro server potrebbe cancellarne i dati
* **Furto**: nel caso di furto potreste perdere il software di gestione della password per decriptare il backup.
* **Problemi legali**: per poter dimostrare la vostra innocenza i vostri pc potrebbero essere sequestrati, a casa vostra e altrove
* **Decesso o malattia**: potreste non essere più in grado di digitare la vostra password 

## Qualche info sulla sincronizzazione Nextcloud o Thunderbird (IMAP)
Un metodo per un parziale backup consiste nello salvare i file e le mail tramite dei programmi di sincronizzazione quali Nextcloud o Thunderbird. In questo modo eviterete le perdite dovute ad un guasto fisico.

La semplicità di tale operazione comporta qualche rischio intrinseco nella natura stessa del metodo, sopratutto se usato in ambiente mac o windows. Un [crytolocker](https://en.wikipedia.org/wiki/Ransomware) sul vostro pc porterebbe come conseguenza la perdita dei file sul server nextcloud, così come una involontaria cancellazione del file sul pc. Normalmente la sincronizzazione tra il pc e il server nextcloud è istantanea e quindi i danni sono irreparabili.

Anche se il rischio di evento del genere può essere attenuato con programmi quali Timeshift, solo il backup su un supporto non connesso vi proteggerà dai crytolocker.
    
    
    
