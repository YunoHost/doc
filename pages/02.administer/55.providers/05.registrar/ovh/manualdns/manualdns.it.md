---
title: Configurazioen del DNS con OVH
template: docs
taxonomy:
    category: docs
routes:
  default: '/providers/registrar/ovh/manualdns'
  aliases:
    - '/OVH'
---

Vediamo come configurare il DNS con [OVH](http://www.ovh.com).

Una volta acquistato il vostro nome a dominio, entrate nel Control Panel, cliccate sul nome del vostro dominio che trovate sul lato sinistro:

![](image://ovh_control_panel.png?resize=800)

Scegliete la sezione **Zona DNS**, e poi **Aggiungere un record**:

![](image://ovh_dns_zone.png?resize=800)

Ora dovrete aggiungere la redirezione del DNS così come specificato nella [configurazione standard delle zone del DNS](/dns_config)

Cliccate su "Modifica in modalità testo", lasciando invariate le prime 4 righe:
```bash
$TTL 3600
@	IN SOA dns104.ovh.net. tech.ovh.net. (2020083101 86400 3600 3600000 60)
                         IN NS     dns104.ovh.net.
                         IN NS     ns104.ovh.net.
```
cancellate tutto il resto e sostituitelo con la configurazione necessaria per raggiungere il vostro server come illustrato nel paragrafo [questa pagina](/dns config).


### IP dinamico

[Istruzioni generiche per l'IP dinamico](/dns_dynamicip).

Seguite queste istruzioni se il vostro IP è dinamico.

Per sapere se la vostra connessione è del tipo con IP dinamico [vedi](/isp).

Create un account DynHost.

Seguite [questa guida](http://blog.developpez.com/brutus/p6316/ubuntu/configurer_dynhost_ovh_avec_ddclient) per l'installazione di ddclient.
ddclient si occuperà di avvisare OVH quando il vostro IP cambierà e OVH adatterà la sua configurazione.

Nel file di configurazione di ddclient dovrete aggiungere:
* il vostro user e la vostra password DynHost
* il nome del vostro dominio

Seguite anche questa [guida creata da OVH](https://docs.ovh.com/fr/fr/web/domains/utilisation-dynhost/).

