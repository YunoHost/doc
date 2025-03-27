---
title: Domini
template: docs
taxonomy:
    category: docs
routes:
  default: '/domains'
shortcode-ui:
  theme:
    tabs: lite
---

YunoHost permette l'installazione e la gestione di più domini sullo stesso server. Potrete quindi ospitare, ad esempio, un blog e un'istanza Nextcloud su un primo dominio `yolo.com`, e un client webmail su un secondo dominio `swag.nohost.me`. Ogni dominio viene automaticamente configurato affinché possa gestire i servizi web e l'email.

I domini possono essere configurati a partire dalla sezione 'Domini' della pagina webadmin, o attraverso la sezione `yunohost domain` da linea di comando.

Ogni volta che aggiungete un dominio, sia esso vostro o del quale abbiate facoltà di gestione, dovete averne il pieno controllo per la poter effettuare la [configurazione del DNS](/install/post_install/dns_config). Fanno eccezione i [domini in .nohost.me, .noho.st et ynh.fr](/administer/tutorials/domains/dns_nohost_me) offerti dal progetto YunoHost, che possono essere direttamente integrati nel vostro server YunoHost grazie alla configurazione automatica di un servizio DynDns. Al fine di impedire abusi e limitare i costi, un'istanza YunoHost può essere configurata con un solo dominio offerto, tuttavia potete aggiungere tutti i suoi sottodomini che desiderate. Ad esempio, se scegliete il dominio `exemple.ynh.fr` potrete in un secondo tempo aggiungere i domini `video.exemple.ynh.fr` o `www.exemple.ynh.fr` o qualsiasi altro sottodominio che possa servirvi.

I domini possono essere configurati a partire dalla sezione 'Domini' della pagina webadmin, o attraverso la sezione `yunohost domain` da linea di comando.

![L'interfaccia webadmin di gestione dei domini, con il pulsante "Aggiungere un dominio" e l'elenco dei domini](/img/webadmin_domain.png)

## 3 tipologie di domini

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Domini gestiti dal progetto YunoHost (semplice e gratuito)"]]

Al fine di facillitare la gestione di un server, il progetto YunoHost fornisce un servizio di nomi di dominio *gratuiti* e *automaticamente configurati*. Utilizzando questo servizio, non dovrete [configurare i record DNS](/dns.config) operazione delicata e tecnica. Prendete atto del fatto che non sarete i veri proprietari del dominio scelto.

Sono disponibili i seguenti (sotto) domini:

- `miodominio.nohost.me` ;
- `miodominio.noho.st` ;
- `miodominio.ynh.fr`.

YunoHost utilizza un sistema di DNS dinamico, assicurando al vostro server di essere sempre raggiungibile anche quando il vostro IP pubblico cambia.

Per ottenere un dominio tra quelli proposti, sarà sufficiente scegliere `Non ho ancora un nome di dominio...` durante la configurazione post installazione o in un secondo tempo nella sezione `Aggiungere un dominio` della webadmin/domini.

![Pagina webadmin, sezione domini « Aggiungere un dominio » dove potete scegliere « Non ho ancora un nome di dominio »](/img/webadmin_dyndns.png)

! Al fine di impedire abusi e limitare i costi, una istanza YunoHost può essere configurata con un solo dominio offerto, tuttavia potete aggiungere tutti i suoi sotto domini che desiderate. Ad esempio, se scegliete il dominio `exemple.ynh.fr` potrete in un secondo tempo aggiungere i domini `video.exemple.ynh.fr` o `www.exemple.ynh.fr` o qualsiasi altro sottodominio che possa servirvi. In questo caso dovete scegliere `Possiedo un nome di dominio`.

[Per maggiori informazioni sui domini offerti dal progetto YunoHost](/administer/tutorials/domains/dns_nohost_me)

[/ui-tab]
[ui-tab title="Il vostro dominio"]]
Possedere un proprio dominio comporta molti vantaggi:

- maggiore controllo e maggiore autonomia
- un nome più semplice e più chiaro (con il solo .net, .org, ecc dopo il nome del dominio).

Avere un proprio dominio implica però dei costi (a partire da circa 15€ per anno...) e dovrete effettuare alcune [configurazioni sulla zona DNS](/dns.config). Lo strumento di diagnostica integrato in YunoHost, può esservi di aiuto nella configurazione dei record DNS.

Se già possedete un nome di dominio, dovete semplicemente scegliere "Ho già un nome di dominio…". Nel caso non abbiate ancora un vostro dominio, vi suggeriamo di acquistarlo presso un registrar con [API supportate da YunoHost](/providers/registrar) semplificando così la configurazione del DNS.

[Pagina "Aggiungere un dominio" dove potere scegliere "Ho già un nome di dominio"](/img/webadmin_domain_owndomain.png)

[Ulteriori informazioni sulla zona DNS](/install/post_install/dns_config)

[/ui-tab]
[ui-tab title="Domini locali (raggiungibili solo all'interno della LAN)"]]

Dalla versione v4.3 di YunoHost, i domini che terminano con `.local` sono pienamente supportati, oltre al `yunohost.local` di default.
Questi non utilizzano il protocollo DNS ma il protocollo mDNS (chiamato anche Zeroconf, Bonjour), che permette la loro diffusione senza particolari configurazioni ma esclusivamente sulla LAN o sulla vostra VPN.
Sono quindi perfettamente utilizzabili se non dovete esporre le vostre app in internet.

[Pagina "Aggiungere un dominio" dove potete scegliere "Ho già un nome di dominio" e configurare un dominio che termina con .local](/img/webadmin_domain_local.png)

!!!! Il protocollo mDNS non permette l'aggiunta di sotto domini. Quindi `miodominio.local` sarà valido, `sotto.miodominio.local` non lo sarà.

Il compito di annunciare l'esistenza dei vostri domini `.local` sulla LAN è affidato al servizio `yunomdns`
Il suo file di configurazione `/etc/yunohost/mdns.yml` permette di scegliere quali domini diffondere e su quali interfacce di rete.
Questo file viene rigenerato automaticamente ogni volta che aggiungete o cancellate un dominio `.local`.

Il servizio `yunomdns` cercherà di annunciare sempre il dominio `yunohost.local`. Se avete più di un server YunoHost sulla LAN, probabilmente esso prenderà il nome di `yunohost-2.local`, `yunohost-3.local` ecc.
La numerazione rischia però di cambiare in base a quale server si avvierà per primo. Assegnate sempre un nome di dominio locale univoco ad ogni server.

! Purtroppo, i device con una versione di Android antecedente alla 12 (rilasciata nel 2021) non sempre gestiscono il protocollo mDNS.
! Per poter accedere ai server `.local` su tail device sarà necessario digitare l'indirizzo IP del vostro server YunoHost.

[/ui-tab]
[/ui-tabs]

## Configurazione DNS

DNS (Domain Name System) è lo strumento che permette ai computer di tradurre i nomi di dominio, dal formato leggibile all'essere umano (ad esempio `yolo.com`) in indirizzi IP, leggibili dai computer (esempio `11.22.33.44`). Affinché questa traduzione (ed altre funzioni) avvenga è necessario configurare con cura i record DNS.

YunoHost può generare una configurazione DNS consigliata per ogni dominio, compresi i record necessari al servizio mail. La configurazione DNS consigliata è disponibile nella pagina web di amministrazione nella sezione Domini > (dominio) > configurazione DNS, oppure tramite il comando `yunohost domain dns-conf suggest the.domain.tld`.

## Caratteri non latini

Se il vostro dominio include caratteri speciali non latini, essi verranno convertiti da YunoHost in [versione internazionale](https://en.wikipedia.org/wiki/Internationalized_domain_name) o in [Punycode](https://en.wikipedia.org/wiki/Punycode). Nel caso di utilizzo della linea di comando, dovete utilizzare il formato punycode restituito dal comando `yunohost domain list`.

## Certificati SSL/HTTPS

Un altro aspetto importante nella configurazioni dei domini è il certificato SSL/HTTPS. In YunoHost viene integrato il servizio Let's Encrypt, e quindi, al fine di rendere raggiungibile il vostro server da tutto l'internet tramite il nome  di dominio, l'amministratore può richiedere l'installazione del certificato Let's Encrypt. Vedi la documentazione sui [certificati](/administer/admin_guide/domains/certificate) per ulteriori informazioni.
