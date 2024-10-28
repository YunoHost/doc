---
title: Vista d'insieme dell'ecosistema YunoHost
menu: Tour guidato per l'amministratore
template: docs
taxonomy:
    category: docs
routes:
  default: '/admin_guide'
---

Questa pagina provvede a fornire una vista d'insieme dell'ecosistema di un server YunoHost. Pur contenendo delle approssimazioni e delle scorciatoie, permette di avere una prima vista globale prima di entrare più nel dettaglio dei differenti aspetti.

![](image://ecosystem.png)

Tutto inizia con l'utente speciale **admin**. È l'amministratore della macchina e può installare, configurare e gestire il server con l'interfaccia web di amministrazione, o via SSH attraverso la linea di comando. *(Se hai familiarità con GNU/Linux, è come l'utente root. YunoHost ha un utente aggiuntivo 'admin' per diverse ragioni tecniche.)*

L'amministratore può creare utenti e installare le applicazioni, oltre alle altre azioni amministrative. Gli utenti hanno automaticamente un indirizzo mail. Gli utenti possono connettersi al portale (SSO) per aver accesso alle applicazioni. Alcune applicazioni possono tipicamente essere installate con un accesso pubblico o uno privato, cioè solo gli utenti del server vi possono accedere.

Le applicazioni e le altre funzionalità del server si basano su diversi servizi per funzionare correttamente. I servizi (chiamati anche demoni) sono dei programmi che girano costantemente per assicurare i vari task, come rispondere alle richieste di navigazione web, o inoltrare email.
