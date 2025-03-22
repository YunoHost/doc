---
title: Configurare un relay SMTP
template: docs
taxonomy:
    category: docs
routes:
  default: '/email_configure_relay'
  aliases: 
    - '/smtp_relay'
---

Se il vostro internet provider blocca la porta 25, o nel caso riscontriate dei problemi nell'uso del server SMTP nativo di YunoHost, potere configurare il vostro server YunoHost affinché utilizzi un relay SMTP.

## Cos'è un relay SMTP

Si tratta di un server SMTP che si occupa dell'invio della posta elettronica in luogo del server SMTP locale (il servizio postfix di YunoHost).
Una volta configurato correttamente l'utilizzo è trasparente per gli utenti e i vostri corrispondenti visualizzeranno i messaggi di posta, come se arrivassero dal vostro server YunoHost. In realtà sarà il server relay SMTP che si occuperà dell'invio.

## [fa=exclamation-triangle /] Svantaggi del server relay

È importante sottolineare che in un sistema di selfhosting, utilizzare un relay SMTP rappresenta un importante compromesso. In effetti non solo il RELAY SMTP sarà in grado di inviare le email per conto vostro, ma avrà accesso al contenuto e potrebbe anche modificarlo. (Ad esempio MailJet di default analizza i link HTML presenti nei messaggi per profilare l'attività degli utilizzatori del servizio.) Inoltre questa configurazione riguarderà tutto il server YunoHost: non sarà quindi possibile scegliere quale utente o quale indirizzo debba utilizzare il relay e quale no.

Oltre alle considerazioni sulla privacy discusse sopra, un relay SMTP può imporre dei limiti tecnici che non avremmo se la nostra porta 25 fosse aperta. Ad esempio, per la maggior parte dei server relay, se un utente del vostro server YunoHost imposta **un indirizzo di "reindirizzamento automatico"** delle mail ricevute, **questo non funzionerà** per i messaggi proveniente dall'esterno senza comunicare niente all'utente. Questo perché i relay richiedono, generalmente, che i messaggi che reinviano abbiano l'indirizzo di invio del vostro dominio (al fine di combattere lo spam e mantenere la reputazione del loro servizio), situazione che non si presenta in caso di "reindirizzamento automatico", dove l'indirizzo originale di spedizione viene conservato: il messaggio viene quindi bloccato dal relay (che normalmente, avvisa l'amministratore del server YunoHost).

## Come utilizzare un relay SMTP con YunoHost?

YunoHost supporta dalla versione 4.1 la configurazione di un relay SMTP. Al momento la configurazione non è disponibile dall'interfaccia di amministrazione ma solo da linea di comando.

### Primo punto: creare un account presso un relay SMTP

Esistono molti fornitori di relay SMTP. Alcuni sono gratuiti e altri propongono il servizio a pagamento in diverse opzioni. Come detto sopra, dovete essere sicuri di potervi fidare del provider, considerazione che spetta solo a voi.

### Secondo punto: Configurare correttamente i DNS

Dopo aver creato l'account, le impostazioni del relay SMTP prevedono la modifica del DNS.
La procedura normale, prevede l'aggiunta di una chiave DKIM e SPF al record DNS.
I parametri da inserire e le modalità di modifica variano in base al fornitore dei servizi di DNS e relay SMTP che avete scelto.

Normalmente i provider di relay SMTP forniscono le guide per modificare questi record insieme a programmi di controllo automatico della correttezza delle impostazioni del DNS. Questo passo è obbligatorio per assicurare "al mondo" che voi, gestori del vostro nome di dominio, autorizzate esplicitamente il vostro provider di relay SMTP ad inviare le email al vostro posto.  

Notate che la modifica dei record DNS può avere effetto anche dopo 24 ore per cui siate pazienti!

! [fa=exclamation-triangle /] Attenzione! dopo aver registrato la zona DNS, il relay SMTP può inviare mail a nome vostro, senza avvisarvi.

### Terzo punto: configurare YunoHost

La configurazione può avvenire sia attraverso l'interfaccia web di amministrazione che da linea di comando.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Da interfaccia web di amministrazione"]
Dalla pagina web di amministrazione scegliere `Strumenti` > `Impostazioni` e scegliere la scheda `Email`.
Attivate l'opzione e compilate i campi necessari:

- **SMTP relay host** : l'indirizzo del server SMTP.
- **SMTP relay port** : La porta utilizzata dal relay SMTP.
- **SMTP relay user** : Utente del vostro account sul relay SMTP.
- **SMTP relay password** : La password del vostro account sul relay SMTP.

! [fa=exclamation-triangle /] Le password contenenti il carattere `#` non funzioneranno correttamente a causa di una regola di postfix (altri caratteri potrebbero non essere riconosciuti, se li scoprite comunicatelo agli sviluppatori di YunoHost affiché possano aggiornare questa guida).

![Option-Relais-Smtp](/img/relay_smtp_option_webadmin_en.png?resize=800)

[/ui-tab]
[ui-tab title="Da linea di comando"]
Per configurare YunoHost per usare il relay, bisogna configurare questi quattro punti:

1. L'indirizzo del relay SMTP (per questo documento utilizzeremo `smtprelay.tld`)
2. La porta che utilizzeremo per accedere al relay (per questo documento utilizzeremo la porta 2525)
3. Il vostro nome utente SMTP (per questo documento utilizzeremo `username`)
4. La password SMTP (per questo documento utilizzeremo password)

! [fa=exclamation-triangle /] Le password contenenti il carattere `#` non funzioneranno correttamente a causa di una regola di postfix (altri caratteri potrebbero non essere riconosciuti, se li scoprite comunicatelo agli sviluppatori di YunoHost affiché possano aggiornare questa guida).

Questi parametri devono essere ovviamente forniti dal provider relay SMTP e dovrebbero trovarsi in un pannello di controllo o che altro.

Per prima cosa colleghiamoci al proprio server via SSH:

```bash
ssh admin@domain.tld
```

Aggiorniamo le impostazioni seguenti:

```bash
sudo yunohost settings set email.smtp.smtp_relay_enabled -v yes
sudo yunohost settings set smtp.relay.host -v smtprelay.tld
sudo yunohost settings set smtp.relay.port -v 2525
sudo yunohost settings set smtp.relay.user -v username
sudo yunohost settings set smtp.relay.password -v password
```

Possiamo controllare le impostazioni con il comando:

```bash
sudo yunohost settings list
```

[/ui-tab]
[/ui-tabs]

La configurazione del relay SMTP è terminata!

! [fa=exclamation-triangle /] Da questo momento il relay SMTP è in grado di leggere e utilizzare le informazioni contenute nelle mail che inviate, senza il vostro consenso (Ma non sarà in grado di leggere le informazioni delle mail che riceverete).

### Quarto passo: Verificare la configurazione

Potete verificare la configurazione inviando una mail e assicurarvi che arrivi a destinazione.
Alcuni relay SMTP vi inviano dei report a proposito delle amil che inviate così che possiate controllare che tutto funzioni regolarmente.
Oppure potete utilizzare [mail-tester.com](https://www.mail-tester.com/) per scoprire errori o problemi nel vostro relay SMTP.
