---
title: Trovare l'IP locale del server
template: docs
taxonomy:
    category: docs
routes:
  default: '/finding_the_local_ip'
---

Nel caso di un'installazione su un server casalingo, questi dovrebbe essere normalmente accessibile (dalla LAN) digitando l'indirizzo `yunohost.local`. Se per una qualsiasi ragione il server non è raggiungibile, dovrete trovare l'indirizzo IP *locale* del vostro server.

## Cos'è l'indirizzo IP locale?

L'IP locale è l'indirizzo che permette al server di essere raggiunto all'interno di una rete locale (ad esempio in una rete domestica) dove molti apparecchi si collegano allo stesso router . Un indirizzo IP locale è normalmente rappresentato con una sequenza di cifre del tipo `192.168.x.y` (o più raramente `10.0.x.y` oppure `172.16.x.y`)

## Come trovare l'indirizzo IP

Uno dei seguenti metodi, vi permetterà di trovare l'indirizzo IP locale del server.
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="(Raccomandato) Usando AngryIP"]

Potete utilizzare il programma [AngryIP](https://angryip.org/download/). Eseguite la scansione degli intervalli IP nell'ordine riportato di seguito fino a trovare l'indirizzo del vostro server:

- `192.168.0.0` -> `192.168.0.255`
- `192.168.1.0` -> `192.168.1.255`
- `192.168.2.0` -> `192.168.255.255`
- `10.0.0.0` -> `10.0.255.255`
- `172.16.0.0` -> `172.31.255.255`

!!! **Consiglio**:
!!! - ordinate per ping come nell'immagine sotto per visualizzare gli indirizzi IP realmente attivi.
!!! - il vostro server dovrebbe essere visualizzato come in ascolto sulle porte 80 e 443
!!! - nel dubbio digitate in un browser `https://192.168.x.y` per verificare che abbiate raggiunto davvero il server YunoHost.

![](image://angryip.png?class=inline)

[/ui-tab]
[ui-tab title="Dal vostro modem/router"]
Cercate nella configurazione del vostro modem/router, troverete una sezione sugli indirizzi IP che il server DHCP ha assegnato alle varie macchine presenti in rete.
[/ui-tab]
[ui-tab title="With arp-scan"]
Se utilizzate Linux, aprite il terminale e digitate il comando `sudo arp-scan --local` per elencare gli indirizzi IP in uso sulla vostra rete locale (dovrebbe funzionare anche con Windows);

Se il comando `arp-scan` restituisce un numero elevato di indirizzi, potere verificare quali di questi ha la porta SSH aperta con il comando `nmap -p 22 192.168.1.0/24` (usando l'insieme di indirizzi della vostra rete locale)
[/ui-tab]
[ui-tab title="Accesso diretto al server con uno schermo"]
Collegate uno schermo al server, effettuate il login e digitate `hostname --all-ip-address`.

Le credenziali di default (prima della post installazione!) sono:

- login: `root`
- password: `yunohost`

(Se utilizzate un'immagine Armbian grezza al posto di un immagine con YunoHost preinstallato, le credenziali saranno root / 1234)
  
[/ui-tab]
[/ui-tabs]

## Se nonostante tutto non trovo l'indirizzo

Se non riuscite a trovare il vostro server con le istruzioni precedenti, forse il server non si è avviato correttamente:

- assicuratevi che il server sia correttamente alimentato;
- se il vostro server utilizza un scheda SD assicuratevi che la porta sul server sia pulita;
- collegate uno schermo al server e riavviatelo per assicurarvi che non vi siano messaggi di errore;
- assicuratevi che il cavo ethernet sia di buona qualità e correttamente collegato;
