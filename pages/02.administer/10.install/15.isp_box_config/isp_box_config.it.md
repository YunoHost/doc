---
title: Configurare il port-forwarding (reindirizzamento delle porte)
template: docs
taxonomy:
    category: docs
routes:
  default: '/isp_box_config'
  aliases:
    - '/port_forwarding'
---

Se il vostro server è ospitato in casa e non avete configurato una VPN, dovrete configurare le porte del vostro router ("machin-box"). Lo schema qui sotto, cerca di spiegare, brevemente, il ruolo del reindirizzamento delle porte nella configurazione di un server casalingo.

[figure caption="Immagine dell'importanza del reindirizzamento delle porte."]![](image://portForwarding_en.png)[/figure]

### 0. Visualizzare le porte aperte

Lo strumento di diagnostica presente in YunoHost a partire dalla versione 3.8, vi permetterà di verificare se
le porte sono correttamente esposte.

### 1. Accedere all'interfaccia di configurazione del router

L'interfaccia di amministrazione del vostro router è, quasi sempre, raggiungibile all'indirizzo [http://192.168.0.1](http://192.168.0.1) o [http://192.168.1.1](http://192.168.1.1). Da qui dovrete autenticarvi con le credenziali fornite dal provider.

### 2. Trovare l'IP del server sulla vostra rete locale

Cercate l'IP *locale* del vostro server così:
- dalla pagina di amministrazione del vostro router, che potrebbe elencarvi i dispositivi connessi
- dalla pagina webadmin di YunoHost, sezione 'Diagnostica' 'Connettività internet', scegliete 'Dettagli' nella riga IPv4.
- dalla linea di comando del vostro server con il comando `hostname -I`
    
Un indirizzo IP locale assomiglia, normalmente, a `192.168.xx.yy` oppure `10.0.xx.yy`.

L'indirizzo IP locale deve essere necessariamente statico di modo che il reindirizzamento che state configurando nei prossimi passi raggiungerà sempre il vostro server. Per fare ciò dovrete configurare il router in modo che l'indirizzo del vostro server sia definito statico anziché dinamico.

### 3. Reindirizzamento delle porte

Nella pagina di amministrazione del vostro router cercate la sezione 'port forwarding' o 'configurazione del router. L'indicazione varia a seconda del router.

Dovete reindirizzare ognuna delle porte elencate di seguito, verso l'IP locale del vostro server, al fine di permettere il funzionamento dei servizi di YunoHost. Ogni servizio necessita di un reindirizzamento 'TCP'. Alcuni router nominano le porte in 'esterne' e 'interne', si tratta comunque della stessa porta.

- Web: `80` <small>(HTTP)</small>, `443` <small>(HTTPS)</small>
- [SSH](/ssh): `22`
- [XMPP](/XMPP): `5222` <small>(client)</small>, `5269` <small>(server)</small>
- [Email](/email): `25`, `587` <small>(SMTP)</small>, `993` <small>(IMAP)</small>

Se utilizzate modem e router separati, dovete:

1. prima sul modem (l'apparecchio più vicino ad internet) dovrete creare delle regole per reindirizzare le porte di cui sopra al router;
2. Successivamente sul router (l'apparecchio che sta in mezzo fra il modem e gli altri apparecchi della rete locale) Reindirizzare le porte dal router all'indirizzo statico del vostro server. 

! [fa=exclamation-triangle /] Alcuni internet provider bloccano l'apertura della porta 25 (mail SMTP) per combattere lo spam. Altri, più raramente, non permettono l'uso delle porte 80/443. A seconda dell'ISP è possibile aprirle nella configurazione del router... Controllate [questa pagina](/isp) per maggiori informazioni.

## Reindirizzamento automatico / UPnP

Alcuni router dispongono permettono di attivare l'UPnP. L'UPnP si occupa di reindirizzare automaticamente le porte verso un computer che ne faccia richiesta. Se UPnP è attivo, eseguendo il comando:

```bash
sudo yunohost firewall reload
```

le porte del router dovrebbero essere automaticamente reindirizzate verso il server.




