---
title: Domini, configurazioni DNS e certificati
template: docs
taxonomy:
    category: docs
routes:
  default: '/domains'
---

Yunohost permette l'installazione e la gestione di più domini sullo stesso server. Potrete quindi ospitare, ad esempio, un blog e una istanza Nextcloud sul dominio primario yolo.com, e un altro servizio su un secondo dominio swag.nohost.me. Ogni dominio viene automaticamente configurato affinché possa gestire i servizi web, le mail, e un servizio di chat XMPP.

I domini possono essere configurati a partire dalla sezione 'Domini' della pagina di amministrazione web, o attraverso la sezione `yunohost domain` da linea di comando. 

Ogni volta che aggiungete un dominio, sia esso vostro o del quale abbiate facoltà di gestione, dovete averne il pieno controllo per la poter effettuare la sua [configurazione DNS](/dns_config). Fanno eccezione i [domini in .nohost.me, .noho.st et ynh.fr](/dns_nohost_me) offerti dal progetto YunoHost, che possono essere direttamente integrati nel vostro server YunoHost grazie alla configurazione automatica di un servizio DynDns. Al fine di impedire abusi e limitare i costi, una instanza YunoHost può essere configurata con un solo dominio offerto, tuttavia potete aggiungere tutti i suoi sotto domini che desiderate. Ad esempio, se scegliete il dominio `exemple.ynh.fr` potrete in un secondo tempo aggiungere i domini `video.exemple.ynh.fr` o `www.exemple.ynh.fr` o qualsiasi altro sottodominio che possa servirvi.

Il dominio scelto durante la configurazione iniziale (post-installazione) viene definito come dominio principale del server: a quell'indirizzo saranno disponibili l'SSO e la pagina di amministrazione web. Il domino principale può essere modificato ulteriormente attraverso ls pagina di amministrazione web nella sezione Domini > (dominio) > Renderlo di defaut, o da linea di commando con il comando `yunohost tools maindomain`.

Infine, bisogna notare che, nel contesto di YunoHost, non esiste un ordine gerarchico tra i domini conosciuti. Nell'esempio precedente possiamo aggiungere un terzo dominio, ad esempio, `foo.yolo.com` - ma verrà considerato come un dominio indipendente da `yolo.com`.

## Domini locali

Dalla versione 4.3 di YunoHost i domini che terminano in `.local` sono pienamente supportati oltre al già presente di default `yunohost.local`.
Essi non utilizzano il protocollo DNS ma il protocollo mDNS (conosciuto anche come Zeroconf, Bonjour), che permette il loro utilizzo senza bisogno di particolari configurazioni ma solo sulla rete locale o sulla vostra VPN.
Il loro utilizzo è quindi adatto in caso di server non esposti su internet.

!!!! Il protocollo mDNS non permette di aggiungere dei sotto domini, quindi `dominio.local` è valido, mente non lo è `sotto.dominio.local`.

`yunomdns` è il servizio preposto all'esposizione del vostro dominio `.local` sull'interfaccia di rete locale.
È possibile configurarlo modificando il file `/etc/yunohost/mdns.yml` che permette di scegliere quali domini devono essere esposti e su quali interfacce di rete.
Questo file viene rigenerato automaticamente ogni volta che aggiungete o eliminate un dominio `.local`.

Il servizio cercherà comunque di esporre il dominio `yunohost.local`, se avete più server YunoHost sulla vostra rete, provate a nominare il vostro server `yunohost-2.local`, `yunohost-3.local` etc.
Purtroppo il numero rischia di cambiare in base all'ordine di avvio dei server, numerare i server è quindi un metodo inaffidabile per cui è preferibile creare differenti domini locali.

! Sfortunatamente i device Android con versioni antecedenti alla 12 (pubblicata nel 2021), non supportano il protocollo mDNS
! Di conseguenza per usare il dominio `.local` dovete inserire l'indirizzo IP del server YunoHost nella configurazione del DNS.

## Sotto domini

! Ricordate che YunoHost separa la gestione dei domini e dei loro sotto domini.
! **È necessario** quindi registrare ogni dominio e sotto dominio che volete utilizzare.

## Configurazione DNS

DNS (Domain Name System) è il sistema che permette, ai computer di tutto il mondo di tradurre i nomi di dominio leggibili dall'uomo (es. `yolo.com`), in un indirizzo IP comprensibile dal computer (es `11.22.33.44`). Affinché questa traduzione (e altre funzionalità) avvenga, bisogna configurare con estrema cura i record DNS.

YunoHost può generare una configurazione DNS raccomandata per ogni dominio che comprende le configurazioni necessarie per le componenti email e XMPP. La configurazione DNS raccomandata è disponibile nella pagina di amministrazione web all'indirizzo Domini > (il dominio) > configurazione DNS oppure con il comando `yunohost domain dns-conf the.domain.tld`.

## Certificati SSL/HTTPS

Un altro importante aspetto della configurazione dei domini è quello riguardante il certificato SSL/HTTPS. YuhoHost integra Let's Encrypt, potete installare il certificato e impostare il rinnovo automatico. La documentazione relativa e altre informazioni si trovano alla pagina [certificati](/certificate).







