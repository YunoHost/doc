---
title: Email
template: docs
taxonomy:
    category: docs
routes:
  default: '/email'
---

YunoHost include un completo server mail, avrete quindi il controllo della vostra posta elettronica con il vostro nome di dominio.

Questo ecosistema comprende un server SMTP (postfix), un server IMAP (Dovecot), un antispam (rspamd) e una configurazione DKIM.

## Assicurare una corretta configurazione

La posta elettronica è un ecosistema complesso con un numero elevato di dettagli, che se mal configurati, possono impedire il suo corretto funzionamento.

Per assicurarsi una configurazione corretta:

- se installate il server a casa e non utilizzate una VPN, assicuratevi che  [il vostro internet provider non blocchi la porta 25](/install/providers/isp/) ;
- reindirizzate le porte [seguendo questa documentazione](/install/post_install/isp_box_config) ;
- configurate con cura i record DNS riguardanti il servizio mail seguendo [questa documentazione](/install/post_install/dns_config) ;
- provate la configurazione utilizzando gli strumenti di diagnostica (`Webadmin > Diagnostic > Email`). Utilizzate il servizio di [mail-tester.com](https://mail-tester.com), un punteggio di 8~9/10 è un risultato ragionevole.  <small>(attenzione : sono concessi solo 3 test per dominio al giorno)</small>

## Programmi (client) per la posta elettronica

Per interagire con il vostro server mail, ricevere e inviare le mail, potete installare un client web come Roundcube o Rainloop sul vostro server, oppure configurare un client su pc o smartphone, come descritto [in questa pagina](/email_configure_client).

I client sul pc e smartphone godono del vantaggio di scaricare i messaggi sul device, permettendo la consultazione dei messaggi anche off line e una parziale protezione dalla perdita dei messaggi in caso di guasti al vostro server.

## Configurazione degli alias e degli inoltri automatici

Per ogni utente possono essere configurati gli alias e l'inoltro dei messaggi. Ad esempio, il primo utente registrato sul server dispone automaticamente dell'alias `root@mio.dominio.tld` - quindi ogni mail inviata a questo indirizzo, si troverà anche nella casella del primo utente registrato. Gli inoltri automatici possono essere configurati per inviare le mail ad un indirizzo diverso (ad esempio gmail) senza dover configurare un account del proprio server sul dispositivo (telefono o pc aziendale).

Una funzione non molto conosciuta riguarda l'utilizzo dei suffissi contrassegnati con il simbolo "+".Ad esempio le mail inviate all'indirizzo `johndoe+sncf@mio.dominio.tld` finiranno nella cartella 'sncf' dell'account di John Doe (oppure semplicemente in Posta in Arrivo se la cartella 'sncf' non esiste). Questa funzione permette di ricevere le mail direttamente nella cartella di destinazione.

I gruppi di utenti, possono utilizzare gli alias. Il gruppo `admins` di default dispone degli indirizzi `root@<mio.dominio.tld>` e `webmaster@<mio.dominio..tld>`. [Ulteriori informazioni qui](/groups_and_permissions#&eacute;érer-les-alias-des-groupes).

## Cosa succede se il mio server è irraggiungibile?

Se il vostro server diventa non più raggiungibile le mail inviate al vostro server rimarranno in una lista di attesa nel server che vi ha spedito la mail per un periodo di circa 5 giorni. Il server proverà ad intervalli regolari ad inviare la mail. Passati i 5 giorni la mail viene cancellata.

## Cancellare il proprio IP dalle black lists

Può succedere che le mail inviate dal vostro server YunoHost siano considerate come spam dai grandi provider di posta elettronica.
A volte il vostro indirizzo IP viene considerato come dannoso o come fonte di spam perché è stato usato in precedenza per tale scopo da altri.
Per accertarsi che il vostro indirizzo IP non sia presente nell'elenco degli indirizzi ritenuti dannosi, e nel caso rimuoverlo, potete seguire questo [link](/blacklist_forms).

## Migrazione delle vostre mail da un fornitore terzo al vostro server YunoHost

Consultate [questa pagina](/email_migration).

## Configurazione di un relay SMTP

Consultate [questa pagina](/email_configure_relay).

## Per saperne di più

Per migliorare la comprensione del sistema mail e dei suoi protocolli questa è un'[esaustiva presentazione](https://www.octopuce.fr/conference-lemail-vaste-sujet-par-benjamin-sonntag/) (in francese).
