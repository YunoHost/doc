# SSH

## What's SSH?

**SSH** sta per Secure Shell, un protocollo che permette di controllare da remoto un computer usando l'interfaccia a linea di comando (command line interface, CLI in inglese). È disponibile di default in ogni emulazione di terminale su Linux e MacOS / OSX. Su Windows è possibile usare [MobaXterm](https://mobaxterm.mobatek.net/download-home-edition.html) (dopo averlo avviato si deve cliccare su Session e poi SSH).

## Durante l'installazione di Yunohost

#### Individuare il proprio IP

Se stai installando su un VPS allora il provider dovrebbe averti indicato il tuo indirizzo IP.

Se stai installando su un computer casalingo (ad esempio un Raspberry Pi o un OLinuXino) devi individuare l'indirizzo IP che è stato attribuito al computer dopo averlo collegato al router. Questi sono alcuni sistemi:
- avvia un terminale e dai il comando `sudo arp-scan --local` per elencare gli indirizzi IP sulla rete locale;
- usa l'interfaccia del router per vedere la lista dei computer collegati o controllane i log;
- collega un monitor al tuo server yunohost, fai login e digita `hostname --all-ip-address`.

#### Collegamento

Se come esempio il tuo indirizzo IP è `111.222.333.444` avvia un terminale e digita:

```bash
ssh root@111.222.333.444
```

Ti verrà richiesta una password. Nel caso tu stia utilizzando un VPS questa ti dovrebbe essere stata comunicata dal provider. Se invece stai utilizzando un'immagine pre-installata (per computer di tipo x86 o ARM) la password sarà `yunohost`.

<div class="alert alert-warning">
Dalla versione 3.4 di YunoHost, dopo aver completato il processo di post installazione, non sarà più possibile fare login da `root`: invece **sarà necessario fare login usando l'utente `admin`!**. Nel caso in cui il server LDAP non stia funzionando e l'utente `admin` sia inutilizzabile sarà sempre possibile fare login da `root` solo dalla rete locale.
</div>

#### Cambio della password

Dopo esserci loggati per la prima volta è necessario cambiare la password di root e ti dovrebbe essere richiesto dal server stesso; nel caso in cui questo non accada usa il comando `passwd`. È importante scegliere una password ragionevolmente robusta. Nota che la password di root verrà sovrascritta dalla password di admin dal processo di postinstallazione.

## Dopo l'installazione

Se hai installato il server a casa e stai provando a collegarti dall'esterno della tua rete locale verifica che la porta 22 sia regolarmente forwardata al server. (Ricorda, dalla versione 3.4 di YunoHost dovrai usare l'utente `admin`!).

Se conosci esclusivamente l'indirizzo IP del tuo server:

```bash
ssh admin@111.222.333.444
```

Dopo di che dovrai inserire la password di amministratore creata nella [procedura di postinstallazione](postinstall).

Se invece hai configurato il DNS (o hai modificato il file `/etc/hosts`), puoi semplicemente usare il tuo nome di dominio:

```bash
ssh admin@your.domain.tld
```

Se hai modificato la porta in ascolto per SSH devi aggiungere l'opzione `-p <portnumber>` al comando, cioè:

```bash
ssh -p 2244 admin@your.domain.tld
```

<div class="alert alert-info">
Se sei loggato come `admin` ma vuoi usare l'utente `root` per maggiore comodità (ad esempio per evitare di scrivere `sudo` prima di ogni comando) puoi usare il comando `sudo su`.
</div>

## Utenti abilitati

Di default solo l'utente `admin` può loggarsi al server ssh di YunoHost.

Gli utenti creati dall'interfaccia di amministrazione sono gestiti dalla directory LDAP e di default non possono connettersi via SSH per ragioni di sicurezza. Se invece vuoi abilitare all'accesso SSH alcuni utenti usa il comando:

```bash
yunohost user ssh allow <username>
```

È sempre possibile eliminare l'accesso ssh con il comando:

```bash
yunohost user ssh disallow <username>
```

Infine è possibile aggiungere, eliminare ed elencare le chiavi ssh, usate per migliorare la sicurezza degli accessi ssh con i comandi:

```bash
yunohost user ssh add-key <username> <key>
yunohost user ssh remove-key <username> <key>
yunohost user ssh list-keys <username>
```

## Sicurezza e SSH

N.B.: `fail2ban` bannerà il tuo IP per 10 minuti nel caso di almeno 5 tentativi di accesso falliti. Se devi togliere il ban al tuo IP leggi la pagina relativa [fail2ban](/fail2ban)

Una discussione più approfondita relativa a sicurezza & SSH è su [questa pagina](security_en).
