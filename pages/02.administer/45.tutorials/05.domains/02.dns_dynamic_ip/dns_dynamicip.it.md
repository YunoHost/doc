---
title: DNS con IP dinamico
template: docs
taxonomy:
    category: docs
routes:
  default: '/dns_dynamicip'
---

! Prima di continuare, assicuratevi che il vostro indirizzo IP pubblico sia dinamico utilizzando: [`ip.yunohost.org`](http://ip.yunohost.org/). L'indirizzo IP del vostro router cambia quasi ogni giorno.

Questo tutorial cerca di risolvere il problema con gli IP dinamici: quando l'IP pubblico del vostro router cambia, la zona DNS non viene aggiornata per riflettere il nuovo indirizzo IP e di conseguenza il vostro server non è più raggiungibile con il nome di dominio.

Dopo aver applicato le configurazioni proposte in questo tutorial la redirezione dal vostro nome di dominio del vostro server all'IP reale non verrà più persa.

La configurazione che adotteremo consiste nel rendere automatica la comunicazione del router al servizio di DNS dinamico la variazione dell'indirizzo IP pubblico e che la zona DNS può essere aggiornata.

### Registrars

Di seguito un elenco, non esaustivo, dei registrar. Qui potere acquistare il vostro dominio:

- [OVH](http://ovh.com/)
- [GoDaddy](https://godaddy.com)
- [Gandi](http://gandi.net)
- [Namecheap](https://www.namecheap.com)
- [BookMyName](https://www.bookmyname.com)
- [Ionos](https://ionos.com)
- [Infomaniak](https://infomaniak.com)

Se siete in possesso di un dominio presso **OVH**, saltate al punto 4 e proseguite con il [tutorial](/OVH) considerando che OVH propone un servizio DynDNS.

#### 1. Create un account per il servizio DynDNS

Di seguito un elenco, non esaustivo, di offerte dei servizi DynDNS:

- [DNSexit](https://www.dnsexit.com/Direct.sv?cmd=dynDns)
- [No-IP](https://www.noip.com/remote-access)
- [ChangeIP](https://changeip.com/)
- [DynDNS.it (in italiano, a pagamento)](https://dyndns.it/)
- [DynDNS con il suo nome di dominio](https://github.com/opi/DynDNS-with-HE.NET)
- [Duck DNS](https://www.duckdns.org/)
- [ydns.io](https://ydns.io/)

Create un account presso il fornitore scelto. Dovrebbe comunicarvi uno (o più) indirizzi IP per raggiungere il servizio e un login (che dovreste poter configurare da soli).

#### 2. Configurate la zona DNS

Copiate la [zona DNS](/dns_config), tranne il record NS, del vostro [registrar](#registrars) verso il DNS dinamico del servizio DynDNS che avete scelto al punto 1 del tutorial.

#### 3. Reindirizzate la gestione del vostro dominio verso il server DNS dinamico

In questo passaggio informeremo il [registrar](#registrars) che il servizio DNS sarà affidato al servizio DyDNS.

Reindirizzate il campo NS verso l'indirizzo IP fornito dal servizio DyDNS.

In seguito cancellate la [zona DNS](/dns_config) (eccetto il precedente campo NS) nel vostro [registrar](#registrars).

## 4. Configurazione del router/client

Configurate il vostro router o un client specifico installato sul vostro server come ad esempio `ddclient` con i dati del vostro account DNS dinamico.
Qui useremo il client fornito dal router che è il sistema sicuramente più facile.

Inserite il login del servizio di DNS dinamico e l'indirizzo IP pubblico nel vostro router (l'interfaccia varierà sicuramente a seconda dell'ISP che state usando).

![](image://dns_dynamic-ip_box_conf.png?resize=600)
