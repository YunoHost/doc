---
title: BorgBackup
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/borgbackup'
page-toc:
  active: true
  depth: 3
---

YunoHost propone due programmi per [BorgBackup](https://www.borgbackup.org/).

## Funzionalità
con BorgBackup potrete:
* effettuare il backup dei dati in un HD esterno o in un repository borg remoto
* deduplicare e comprimere i file, che permette di mantenere molte versioni precedenti
* la cifratura dei dati, permettendo così di conservare in modo sicuro i file presso soggetti terzi
* definire i tipi di dati da copiare e la frequenza di backup
* ricevere una mail di allerta in caso di fallimento del backup

Oltre ai [fornitori terzi di repository](https://www.borgbackup.org/support/commercial.html), vi è la possibilità di hostare il proprio repository su una differente installazione yunohost con installata l'[applicazione borgserver](https://github.com/YunoHost-Apps/borgserver_ynh).

Il futuro metodo di backup integrato in YunoHost sarà basato su BorgBackup

## Pianificazione del backup

!!!Installate l'[applicazione borg](https://github.com/YunoHost-Apps/borg_ynh), ed eventualmente l'[applicazione borgserver](https://github.com/YunoHost-Apps/borgserver_ynh).


## Test
Con il programma borg una mail viene inviata nel caso la sessione di backup fallisca o nel caso il repository di destinazione non riceva nessun dato. Da terminale possiamo controllare nei minimi dettagli, che tutto funzioni.


```bash
# Elencare i files
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg list "$(yunohost app setting $app repository)" | less

# Elencare le esportazioni del database
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg list "$(yunohost app setting $app repository)" | grep "(db|dump)\.sql"

# Elencare i file contenuti nell'archivio
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg list "$(yunohost app setting $app repository)::ARCHIVE" | less

# Ottenere informazioni sull'archivio
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg info "$(yunohost app setting $app repository)::ARCHIVE"

# Verificare l'integrità dei dati
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg check "$(yunohost app setting $app repository)::ARCHIVE" --verify-data
```

## Ripristino

Se effettuiamo il ripristino dopo una migrazione o una reinstallazione dobbiamo reinstallare borg nello stessa maniera. Se il repository si trova in un server remoto bisogna cambiare la chiave pubblica.

Elencare gli archivi disponibili
```
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg list "$(yunohost app setting $app repository)"
```

Creare gli archivi tar (uno per ogni applicazione e componente del sistema)
```
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg export-tar "$(yunohost app setting $app repository)::ARCHIVE" /home/yunohost/archives/ARCHIVE.tar
```

In seguito ripristinare l'archivio come di consueto.

### Ripristino di archivi di grandi dimensioni
Se lo spazio disponibile è inferiore alla dimensione del vostro archivio, dei dati scompattati e delle dipendenze, dovrete ripristinare un'applicazione alla volta.

Se il ripristino non riesce  o se un archivio è troppo grande, è più prudente creare un archivio tar senza la parte più grande dei dati, cioè come se l'archivio fosse stato creato con l'[opzione BACKUP_CORE_ONLY](/backup/include_exclude_files#don't-save-large-quantities-of-data). Di seguito un esempio con Nextcloud:
```
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg export-tar -e apps/nextcloud/backup/home/yunohost.app "$(yunohost app setting $app repository)::ARCHIVE" /home/yunohost/archives/ARCHIVE.tar
```

In seguito si estrarranno questi dati direttamente con borg
```
cd /home/yunohost.app/
app=borg; BORG_PASSPHRASE="$(yunohost app setting $app passphrase)" BORG_RSH="ssh -i /root/.ssh/id_${app}_ed25519 -oStrictHostKeyChecking=yes " borg extract "$(yunohost app setting $app repository)::ARCHIVE" apps/nextcloud/backup/home/yunohost.app/
mv apps/nextcloud/backup/home/yunohost.app/nextcloud ./
rm -r apps
```

 Procedere poi con il consueto metodo di ripristino 
