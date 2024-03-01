---
title: Sicurezza
template: docs
taxonomy:
    category: docs
routes:
  default: '/security'
---

YunoHost è stato sviluppato per la migliore sicurezza senza troppe complicazioni. Ogni protocollo in YunoHost è **cifrato** e view salvato solo un hash delle password e di default gli utenti possono accedere solo alla propria directory personale.

Rimangono due punti importanti da notare:

* L'installazione di applicazioni addizionali può **aumentare significativamente** il numero di potenziali problemi di sicurezza. È importante chiedere informazioni relative a problemi di sicurezza **prima di installare un'applicazione** e provare ad installare solo le applicazioni necessarie.

* Poiché YunoHost è un software molto conosciuto ed usato aumenta le possibilità di un attacco. Se viene scoperto un problema potrebbe essere usato contemporaneamente contro tutte le istanze. Mantenete **aggiornato** il vostro sistema per aumentare la sicurezza. Gli aggiornamenti possono essere automatizzati installando l'[applicazione "Unattended_upgrades"](https://install-app.yunohost.org/?app=unattended_upgrades).

!!!! Se avete bisogno di aiuto non esitate a [chiedere](/help). 

!! [fa=shield /] Per discutere di problemi di sicurezza contattate il [team YunoHost security](/security_team).

---

## Migliorare la sicurezza

Se il vostro server YunoHost è usato in situazioni critiche di produzione oppure se volete migliorarne la sicurezza potreste seguire le seguenti buone pratiche.

! **ATTENZIONE:** Per seguire queste istruzioni è necessario essere in possesso di conoscenze avanzate di amministrazione di sistema.

!!!! **SUGGERIMENTO** Non chiudete mai la connessione SSH in uso prima di aver controllato che le modifiche fatte siano corrette. Provate la nuova configurazione aprendo un nuovo terminale o una nuova finestra cosicché possiate eliminare le modifiche se c'è qualcosa di sbagliato. 

### Autenticazione SSH con la chiave

Di default l'autenticazione SSH chiede la password dell'amministratore. È consigliato disattivare questo tipo di autenticazione per sostituirlo con il sistema basato sulle chiavi. 

**Sul client**:

```bash
ssh-keygen
ssh-copy-id -i ~/.ssh/id_rsa.pub <username@your_yunohost_server>
```

!!! Se incontrate problemi di permessi impostate `username` come proprietario della directory `~/.ssh` con il comando `chown`. Fate attenzione al fatto che, per ragiorni di sicurezza questa directory deve essere con il modo `700`. 

!!! Se state usando Ubuntu 16.04 dovete avviare `ssh-add` per avviare l'agente SSH.

Digitate la password di amministrazione e la chiave verrà copiata nel vostro server.

**Sul vostro server** la modifica della configurazione di SSH per disattivare l'autenticazione a password è gestita da un'impostazione di sistema:

```bash
sudo yunohost settings set security.ssh.password_authentication -v no
```
---

### Modificare la porta SSH

Per prevenire i tentativi di connessione dei robot che fanno scan di internet alla ricerca di server con SSH attivato è possibile cambiare la porta SSH.
Questa impostazione è gestita da un'impostazione di sistema che aggiorna le configurazioni di SSH e di fail2ban.

! Se modificate una qualsiasi impostazione nel file `/etc/ssh/sshd_config`, anche solo la porta di ascolto, YunoHost non gestirà più il file. Per questa ragione è necessario usare sempre gli strumenti di amministrazione per fare modifiche ai file di configurazione del sistema. 

```bash
sudo yunohost settings set security.ssh.port -v <new_ssh_port_number>
```

**Per tutte le connessioni SSH seguenti** è necessario aggiungere l'opzione `-p` seguita dal numero della porta di SSH.

**Esempio**:

```bash
ssh -p <new_ssh_port_number> admin@<your_yunohost_server>
```

---

### Cambiare la configurazione della compatibilità dei cifrari

La configurazione TLS di default per i servizi è pensata per offrire una buona compatibilità di supporto ai vecchi device. È possibile configurare questa policy per specifici servizi come SSH e NGINX. La configurazione di default di NGINX segue il documento [intermediate compatibility recommendation](https://wiki.mozilla.org/Security/Server_Side_TLS#Intermediate_compatibility_.28default.29) di Mozilla. Potete scegliere di cambiare nella modalità di configurazione 'moderna' che usa le raccomandazioni di sicurezza più recenti che però abbassano la compatibilità potendo portare a problemi con i vostri utenti che usano device più vecchi. Si possono trovare maggiori dettagli relativi alla compatibilità in [questa pagina](https://wiki.mozilla.org/Security/Server_Side_TLS#Modern_compatibility).

Il cambio di livello di compatibilità non è definitivo e può essere ripristinato nel caso in cui non si adatti alle vostre necessità.

**Sul vostro server**, cambio della policy per NGINX
```bash
sudo yunohost settings set security.nginx.compatibility -v modern
```

**Sul vostro server**, cambio della policy per SSH
```bash
sudo yunohost settings set security.ssh.compatibility -v modern
```

### Disabilitare le API di YunoHost

La pagina di amministrazione di YunoHost è accessibile da un **API HTTP** che ascolta di default sulla porta 6787 (solo su localhost).
Può essere usata per amministrare molti aspetti del vostro server e di conseguenza attori maligni possono usarla per danneggiarlo.
La cosa migliore da fare, se conoscete l'iso dell'[interfaccia a lina di comando (CLI)](/commandline), è disattivare il servizio `yunohost-api`.`

! Facendo così verranno completamente disabilitate le API di YunoHost e la pagina di amministrazione che si basa su queste.
! Procedete solo nel caso in cui siate a vostro agio usando l'interfaccia a linea di comando.

```bash
sudo systemctl disable yunohost-api
sudo systemctl stop yunohost-api
```

Poiché il servizio `yunohost-api` è stato disabilitato e non sta girando Diagnosi riporterà un errore che non può essere ignorato.
Se volete far sì che l'errore venga ignorato potete configurare in tal senso YunoHost dalla linea di comando.

```bash
sudo yunohost diagnosis ignore --filter services service=yunohost-api
```
