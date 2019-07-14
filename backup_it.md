# Eseguire il backup del vostro server e delle app

Eseguire il backup del vostro server, delle app e dei dati è un compito importante nell'amministrazione di un server poiché vi protegge da eventi inaspettati ma sempre possibili (come server distrutto da un incendio, corruzione del database, perdita delle credenziali di accesso, compromissione del server e altro). La policy di backup che adotterete dipende dall'importanza dei dati che state gestendo: ad esempio non sarà tanto importante avere il backup di un server di prova mentre lo sarà per un server contenente dati importanti per un'associazione o una ditta e sarà altrettanto importante tenere questo backup *in un luogo fisico diverso dal server stesso*.

## I backup di YunoHost

YunoHost fornisce un sistema di backup che vi permette di fare il backup (e il suo ripristino) della configurazione e dei dati (come ad esempio le email) e delle app che lo supportano.

Si possono gestire i backup sia da riga di comando (`yunohost backup --help`) sia dalla pagina web di amministrazione (nella sezione Backup) anche se alcune possibilità non sono disponibili in questo modo.

Il metodo di default attuale crea degli archivi `.tar.gz` contenenti tutti i file del backup stesso. Nel futuro YunoHost ha in progetto di usare [Borg](https://www.borgbackup.org/) che è una soluzione più flessibile, efficiente e potente.

## Creare i backup

### Dalla pagina web di amministrazione

Potete creare gli archivi di backup dalla pagina web di amministrazione andando in Backup > Archivi locali e cliccare su "Nuovo backup". Vi verrà chiesto di selezionare quale configurazione, dati e di quale app volete fare il backup.

![picture of Yunohost's backup pannel](/images/backup.png)

### Dalla riga di comando

Potete fare un nuovo archivio di backup dalla riga di comando. Questi sono alcuni esempi di comandi e i relativi risultati:


- Esecuzione di un backup completo (tutti i componenti del sistema e delle app):

  ```bash
  yunohost backup create
  ```

- Backup delle sole app

  ```bash
  yunohost backup create --apps
  ```

- Backup di sole due app (wordpress e shaarli)

  ```bash
  yunohost backup create --apps wordpress shaarli
  ```

- Backup solo delle email

  ```bash
  yunohost backup create --system data_mail
  ```

- Backup delle email e wordpress

  ```bash
  yunohost backup create --system data_mail --apps wordpress
  ```

Per maggiori informazioni e opzioni sulla creazione di backup leggete `yunohost backup create --help`. Potrete anche elencare le parti del sistema delle quali si può farne il backup con `yunohost hook list backup`.


### Configurazioni specifiche per le app

Alcune app come ad esempio Nextcloud possono contenere grandi quantità di dati. È possibile in questi casi eseguire il backup dell'app senza i dati degli utenti, modalità che viene indicata come "backing up only the core" (delle app).  
Eseguendo un aggiornamento, delle app con grandi quantità di dati normalmente verrà eseguito un backup senza questi dati.

Per disabilitare esplicitamente il backup di grandi quantità di dati, per le applicazioni che implementano questa possibilità, dovete impostare la variabile `BACKUP_CORE_ONLY` prima di eseguire il comando di backup: `sudo BACKUP_CORE_ONLY=1 yunohost backup create --apps nextcloud`. Fate attenzione però perché dovrete fare il backup di questi dati autonomamente: è possibile eseguire questi backup, di tipo incrementale o differenziale, opzione che però non è ancora provvista da YunoHost.


## Download e upload dei backup

Dopo aver creato gli archivi di backup è possibile elencarli e ispezionarli sia dalla pagina web di amministrazione relativa sia dalla riga di comando con i comandi `yunohost backup list` e `yunohost backup info <archivename>`. Di default i backup sono copiati nella directory `/home/yunohost.backup/archives/`.

Attualmente il modo più semplice per scaricare gli archivi è usando il programma FileZilla (vedi [questa pagina](/filezilla)).

Una soluzione alternativa è quella di installare Netxcloud o un'applicazione simile e configurarle per accedere ai file contenuti in `/home/yunohost.backup/archives/` da un browser.


Un'altra soluzione è quella di usare `scp` (un programma che si basa su [`ssh`](/ssh)) per copiare i file fra due computer usando la riga di comando. In questo modo usando un computer con Linux potete copiare uno specifico backup con questo comando:

```bash
scp admin@your.domain.tld:/home/yunohost.backup/archives/<archivename>.tar.gz ./
```

Allo stesso modo potete copiare da un computer al vostro server con questo comando:

```bash
scp /path/to/your/<archivename>.tar.gz admin@your.domain.tld:/home/yunohost.backup/archives/
```

## Ripristinare i backup

### Dalla pagina web di amministrazione

Dovete andare in Backup > Archivi locali e selezionare il vostro archivio. È possibile selezionare ciò che volete ripristinare e poi cliccare su 'Ripristina'.


![picture of Yunohost's restore pannel](/images/restore.png)

### Dalla riga di comando

Dalla riga di comando date il comando `yunohost backup restore <archivename>` (senza il `.tar.gz`) per ripristinare un archivio. Così come `yunohost backup create`, questo comando ripristinerà di default tutto il contenuto dell'archivio; se invece volete ripristinare solo alcuni file potete usare ad esempio il comando `yunohost backup restore --apps wordpress` per ripristinare esclusivamente wordpress.


### Limiti

Per ripristinare una app, il dominio sul quale era stata installata dovrà essere già stato configurato oppure dovrete avere già ripristinato la configurazione di sistema relativa. Inoltre non è possibile ripristinare una app che è già installata ... il che comporta che se volete ripristinare una versione passata della app dovrete prima disinstallarla.


### Ripristino durante il postinstall

È possibile ripristinare un archivio completo *invece* di eseguire il passaggio di postinstall. Questo è utile se volete reinstallare un sistema interamente da un backup preesistente. Per fare questo dovrete copiare l'archivio sul server nella directory `/home/yunohost.backup/archives` e poi, **invece di dare il comando** `yunohost tools postinstall` darete il comando:


```bash
yunohost backup restore <archivename>
```

Nota: se il vostro archivio non si trova in `/home/yunohost.backup/archives` potete specificare il path giusto con:


```bash
yunohost backup restore /path/to/<archivename>
``` 

## Ulteriori possibilità

### Tenere i backup su un disco diverso

Potete connettere e montare un disco esterno per tenerci gli archivi di backup (oltre a tutto il resto): per fare questo prima spostate gli archivi e poi aggiungete un link simbolico.


```bash
PATH_TO_DRIVE="/media/my_external_drive" # Come esempio, dipende da dove monterete il vostro disco
mv /home/yunohost.backup/archives $PATH_TO_DRIVE/yunohost_backup_archives
ln -s $PATH_TO_DRIVE/yunohost_backup_archives /home/yunohost.backup/archives
```

### Backup automatici

È possibile aggiungere un semplice job di cron per creare i backup automaticamente. Ad esempio per fare il backup di wordpress su base settimanale create il file `/etc/cron.weekly/backup-wordpress` con queste righe:

```bash
#!/bin/bash
yunohost backup create --apps wordpress
```

e poi rendetelo eseguibile:

```bash
chmod +x /etc/cron.weekly/backup-wordpress
```

Prestate attenzione a ciò di cui fate il backup e quando perché altrimenti è possibile esaurire lo spazio del vostro disco eseguendo, ad esempio, 30 Gb di backup ogni giorno.


#### Backup del server su un server remoto

Potete seguire questo tutorial sul forum per impostare Borg fra due server: <https://forum.yunohost.org/t/how-to-backup-your-yunohost-server-on-another-server/3153>

Alternativamente, la app Archivist permette di impostare un sistema simile: <https://forum.yunohost.org/t/new-app-archivist/3747>

#### Backup completo con `dd`

Se state usando una board ARM un altro metodo per eseguire un backup completo è quello di creare un'immagine della card SD. Per fare questo innanzitutto spegnete la vostra board ARM, prendete la card SD e createne un'immagine completa con un comando come il seguente:


```bash
dd if=/dev/mmcblk0 of=./backup.img status=progress
```

(modificate `/dev/mmcblk0` con il device reale della vostra card)