---
title: DNS e sottodomini per le applicazioni
template: docs
taxonomy:
    category: docs
routes:
  default: '/dns_subdomains'
---

## Sottodomini

YunoHost permette l'uso dei sottodomini. Se possedete un nome a dominio come ad esempio `miodominio.com` dovrete innanzitutto creare i relativi sottodomini desiderati nella configurazione DNS del registrar del dominio principale (nell'esempio seguente useremo Gandi).

## Esempio di configurazione con il registrar Gandi.

Nella configurazione DNS, avremo quindi un record A con l'indirizzo IPv4 del nostro server, un record AAAA con l'indirizzo IPv6 e a seguire, diversi records CNAME, uno per ogni sottodominio che vogliamo creare.

La configurazione sarà simile a questa:

```text
@         A            XYZ.XYZ.XYZ.XYZ
@         AAAA         1234:1234:1234:FFAA:FFAA:FFAA:FFAA:AAFF
*         CNAME        miodominio.com.
agenda    CNAME        miodominio.com.
blog      CNAME        miodominio.com.
rss       CNAME        miodominio.com.
```

questo ci permette di avere i sottodomini `agenda.miodominio.com`, `blog.miodominio.com` e `rss.miodominio.com`.

## Installare un'applicazione in un sottodominio

In yunoHost l'installazione di un'applicazione in un sottodominio, ad esempio in `blog.miodominio.com`, si effettua dal pannello di amministrazione. Per prima cosa dobbiamo aggiungere il sottodominio all'elenco dei domini disponibili. La creazione di un sottodominio in YunoHost genererà i file di configurazione per NGINX (il web server di YunoHost)

Potremo quindi installare l'applicazione seguendo il procedimento comune avendo cura di scegliere il sottodominio desiderato come dominio di installazione (es. `blog.miodominio.com`) indicando come percorso `/` (e non `/wordpress` ad esempio). Avremo un messaggio che ci informa che non potremo installare altre applicazioni nel sottodominio scelto e confermando la procedura di installazione dell'applicazione inizierà.

L'applicazione sarà quindi accessibile all'indirizzo `blog.miodominio.com` (e non `miodominio.com/applicazione`).

### Spostare un'applicazione in un sottodominio

Cosa possiamo fare se abbiamo già installato l'applicazione ma nel dominio sbagliato? Ad esempio se volessimo passare da `miodominio.com/wordpress` a `blog.miodominio.com`?
La soluzione è diversa per le varie applicazioni. 
Alcune applicazioni permettono il cambiamento di dominio. In questo caso di può procedere usando il pannello di amministrazione: Applicazioni > nomeapplicazione > cambia URL. 
Se l'applicazione non permette il cambio di URL allora non esiste una soluzione semplice. Quindi l'unica soluzione è reinstallare l'applicazione.

### Reinstallazione di un'applicazione

Innanzitutto procedete al backup dei dati con il processo di backup. Quindi disinstallate l'applicazione con il pannello di amministrazione, poi reinstallatela sul dominio scelto ed infine ripristinate i dati dal backup.
