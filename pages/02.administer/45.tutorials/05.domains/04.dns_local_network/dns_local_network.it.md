---
title: Accesso al server dalla rete locale
template: docs
taxonomy:
  category: docs
routes:
  default: '/dns_local_network'
---

Dopo aver concluso l'installazione del server, è possibile che il vostro dominio non sia accessibile dalla rete locale del server. Questo problema è noto con il nome di [hairpinning](http://en.wikipedia.org/wiki/Hairpinning) ed è una caratteristica non supportata da alcuni router.

Per risolvere questo problema dobbiamo:

- configurare i DNS del nostro router
- o in alternativa modificare il file /etc/hosts dei client dai quali vogliamo raggiungere il server

### Trovare l'indirizzo IP del server nella rete locale

Dobbiamo innanzitutto conoscere l'IP locale del server

- utilizziamo uno di questi [metodi](https://yunohost.org/en/finding_the_local_ip)
- dalla pagina di amministrazione, sezione Diagnostica > Connessione Internet > IPv4 cliccando su 'Dettagli' dovrebbe apparire il valore di 'IP locale'
- dal terminale con il comando: `hostname -I`

## Configurare il DNS del router

Andremo a creare un reindirizzamento attivo su tutta la LAN. Lo scopo è di creare, nel router, un reindirizzamento DNS verso l'IP del server YunoHost. Dobbiamo accedere all'interfaccia di configurazione del router, nella sezione DNS e creare il reindirizzamento nella LAN (ad esempio, `yunohost.local` invia a `192.168.1.21`).

### Box SFR

Se non trovate l'indirizzo IP privato lo potete trovare nel pannello di amministrazione:
   Andate su Etichetta Network > Generale
<img src="/user/images/ip_serveur.png" width=800>

#### Configurare il DNS del box SFR

Andate all'etichetta Network > DNS e aggiungete il vostro nome a dominio al DNS del box.
<img src="/user/images/dns_9box.png" width=800>

## Configurare il file [hosts](https://en.wikipedia.org/wiki/Host_%28Unix%29) del client

L'opzione di modificare il file /etc/hosts deve essere presa in considerazione solo se non è possibile configurare il DNS del router, perché tale modifica avrà effetto solo sul pc specifico.

- In windows trovate il file qui:
     `%SystemRoot%\system32\drivers\etc\`
     > È necessario abilitare la visualizzazione dei file nascosti e di sistema per rendere visibile il file hosts.
- In sistemi UNIX (GNU/Linux, macOS), trovate il file qui:
    `/etc/hosts`
    > Dovrete avere i privilegi di root per modificare il file.

Aggiungete alla fine del file una riga contenente l'indirizzo IP del server seguito dal dominio

```bash
192.168.1.62 domain.tld
```
