---
title: Gli utenti e il SSO
template: docs
taxonomy:
    category: docs
routes:
  default: '/users'
---

## Utenti

Gli utenti sono gli esseri umani che hanno l'accesso alle applicazione e agli altri servizi sul tuo server. L'amministratore può aggiungere e gestire degli utenti tramite l'amministrazione web (nella categoria Utenti) o con la linea di comando (vedi `yunohost user --help`). Dopo queste operazioni, gli utenti avranno un indirizzo mail personale (scelto dall'amministratore), un account XMPP, e potranno connettersi al portale dell'utente (SSO) per accedere alle applicazioni di cui hanno i permessi e configurare altri parametri.

Il primo utente creato avrà automaticamente l'alias mail `root@main.domani.tld` e `admin@main.domani.tld`, in modo che le mail inviate a quegli indirizzi saranno ricevute nella casella mail di questo utente.

! Fai attenzione a chi dai l'accesso al tuo server. In termini di sicurezza ciò aumenta considerevolmente la superficie di attacco di chi vorrebbe compromettere il server in un modo o nell'altro.

## Il portale dell'utente, o SSO

[center]
![](image://user_panel.png)
[/center]

Il portale dell'utente, chiamato anche SSO per 'Single Sign On', permette all'utente di navigare facilmente tra le diverse applicazioni a cui può accedere. In particolare, il termine 'Single Sign On' in pratica fa sì che l'utente debba connettersi al portale per essere automaticamente connesso a tutte le applicazioni che hanno bisogno di un'autenticazione (a comunque quelle che sono integrate con SSO/LDAP, dove ciò non sia tecnicamente complicato o non fosse possibile del tutto).

Nel portale, gli utilizzatori possono anche cliccare sull'avatar in alto a sinistra per configurare altri parametri come il loro nome, l'alias per le mail, l'inoltro automatico delle mail, o per cambiare la propria password.

!!! Devi essere consapevole che il SSO può essere caricato solo dal nome di dominio (per esempio `https://the.domani.tld/yunohost/sso`), e non con l'indirizzo IP del server (per esempio `https://11.22.33.44/yunohost/sso`), al contrario dell'amministratore web! Può creare confusione, ma è necessario per ragioni tecniche. Se sei in una situazione dove è necessario accedere a SSO senza avere i DNS configurati correttamente per diverse ragioni, puoi avere la possibilità di modificare il tuo `/etc/hosts` come descritto in [questa pagina](/dns_local_network).

## Gestione di gruppi di utenti e permessi

Vedi [questa pagina dedicata](/groups_and_permissions).

## Accesso SSH

Gli utenti possono essere autorizzati a connettersi via SSH, e le chiavi SSH possono essere aggiunte per questo scopo. Attualmente questa funzionalità può essere configurata solo con la linea di comando. Vedi `yunohost user ssh --help` per i comandi specifici.

! Fai attenzione a chi dai accesso via SSH. Ciò aumenta ancora di più la superficie di attacco disponibile per un utente malintenzionato.
