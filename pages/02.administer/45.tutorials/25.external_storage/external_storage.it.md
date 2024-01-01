---
title: Aggiungere un disco esterno al vostro server
template: docs
taxonomy:
    category: docs
routes:
  default: '/external_storage'
  aliases:
    - '/moving_app_folder'
---

## Introduzione


Oltre al monitoraggio delle dimensioni delle partizioni (che controlla che non siano troppo piccole), YunoHost non si occupa, al momento, dell'organizzazione delle partizioni dei vostri dischi.

Se la vostra configurazione è basata su una board ARM con scheda SD, oppure il server dispone di un disco SSD di piccole dimensioni, potreste, per motivi di spazio o di sicurezza, voler aggiungere uno o più dischi al vostro server.

! Se avete esaurito lo spazio sul disco del vostro server, potete provare con il comando `apt clean` per tentare di recuperarne un po' e avere modo di seguire le istruzioni di seguito riportate.
 
Troverete qui le istruzioni per riuscire a spostare i vostri dati su un disco esterno in modo corretto e con un impatto minimo sul funzionamento di YunoHost. Potete eseguire lo spostamento durante l'installazione o in un secondo momento, quando si presenterà la necessità di più spazio o temete per l'affidabilità della scheda SD.

!!! Il procedimento presentato qui inizia montando l'unica partizione del disco, in seguito utilizza una o più sotto-cartelle per creare diversi punti di montaggio sull'albero del file system del pc. Questo metodo è preferibile rispetto al utilizzo di link simbolici poiché questi possono entrare in conflitto con alcune applicazioni, tra le quali il sistema di backup di YunoHost. Potreste scegliere di montare le partizioni invece che le sotto-cartelle, ma sorge la difficoltà di prevedere la stima della dimensione della cartella.

## [fa=list-alt /] Prerequisiti

* Prevedere un periodo temporale nel quale gli utenti del vostro server possono sopportare una interruzione dei servizi. I passaggi da compiere, anche se relativamente semplici, sono tecnicamente complessi e necessitano di un lasso di tempo **da dedicare in modo esclusivo**.

* Conoscenza della connessione come root sul server anche via [SSH](/ssh). (Nota bene: se siete connessi come utente `admin`, potete passare root con il comando `sudo su`)

* Conoscere i comandi `cd`, `ls`, `mkdir`, `rm`.
    
* Disporre di un backup nel caso le cose non vadano come previsto

* Disporre di un disco aggiuntivo (SSD, hard disk, chiavetta USB) collegato al server via USB o SATA

## 1. Identificare le cartelle da spostare

Il comando `ncdu` vi permette di navigare tra le cartelle del vostro server affinché possiate conoscerne la loro dimensione.

Di seguito, alcuni esempi di percorsi che possono essere di notevoli dimensioni e qualche consiglio su come ridurre la loro dimensione o perché sceglierli tra quelli da spostare.

| Percorso                    | Contenuto                                                                                    | Consigli                                                                                                                                                              |
|-----------------------------|----------------------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| `/home`                     | Cartelle Utenti accessibile via SFTP                                                         | Spostabile                                                                                                                                                            |
| `/home/yunohost.backup`     | Backup di YunoHost                                                                           | In base alla vostra strategia di backup è consigliabile spostare questa cartella su un disco diverso da quello che contiene i dati e i database                       |
| `/home/yunohost.app`        | Cartella di grandi dimensioni contenente i dati delle varie applicazioni (nextcloud, matrix) | Spostabile                                                                                                                                                            |
| `/home/yunohost.multimedia` | Cartella di grandi dimensioni condivisa tra varie applicazioni (nextcloud, matrix)           | Spostabile                                                                                                                                                            |
| `/var/lib/msql`             | Database utilizzato dalle applicazioni                                                       | Per motivi di velocità è consigliato lasciarlo sul disco principale                                                                                                   |
| `/var/lib/postgresql`       | Database utilizzato dalle applicazioni                                                       | Per motivi di velocità è consigliato lasciarlo sul disco principale                                                                                                   |
| `/var/mail`                 | Mail degli utenti                                                                            | Spostabile                                                                                                                                                            |
| `/var/www`                  | Cartella delle applicazioni WEB                                                              | Per motivi di velocità è consigliato lasciarla sul disco principale                                                                                                   |
| `/var/log`                  | Log degli eventi (messaggi di errore, connessioni...)                                        | Questa cartella dovrebbe essere di dimensioni ridotte, in caso contrario potrebbe esserci un errore nella rotazione dei log che deve essere risolto.                  |
| `/opt`                      | Programmi e dipendenze di alcune applicazioni YunoHost                                       | Per motivi di velocità è consigliato lasciare sul disco principale. Per le applicazioni nodejs è possibile recuperare dello spazio cancellando le versioni non in uso |
| `/boot`                     | Kernel e file di avvio                                                                       | Non spostare se non perfettamente a conoscenza delle possibili conseguenze. Si possono eliminare vecchi kernel non in uso                                             |


## 2. Collegare e identificare il disco

Collegate il disco al server e identificate il nome assegnato dal sistema.

Utilizzate il comando:

```bash
lsblk
```

La risposta potrebbe essere qualcosa di simile

```bash
NAME        MAJ:MIN RM   SIZE RO TYPE MOUNTPOINT
sda           8:0    0 931.5G  0 disk
└─sda1        8:1    0 931.5G  0 part
mmcblk0     179:0    0  14.9G  0 disk
├─mmcblk0p1 179:1    0  47.7M  0 part /boot
└─mmcblk0p2 179:2    0  14.8G  0 part /
```

In questo caso `mmcblk0` corrisponde ad una scheda SD di 16 GB (si nota che le partizioni `mmcblk0p1` e `mmcblk0p2` corrispondono rispettivamente alla partizione di `/boot` e alla partizione di sistema `/`). Il disco esterno collegato corrisponde a `sda`, ha una capacità di circa 1GB, e contiene una sola partizione `sda1` che non è montata (non ha nessun riferimento nella colonna "MOUNTPOINT").

! [fa=exclamation-triangle /] In alcuni casi il sistema operativo è installato su `sda` e di conseguenza il vostro disco sarà `sdb`

!!! Suggerimento! se la dimensione del disco non è sufficiente per essere riconosciuto, potete scollegare il disco e eseguire il comando `lsblk`, ricollegare il disco, eseguire nuovamente `lsblk` e osservare le differenze di output.

## 3. Formattare il disco (Se necessario)

Se il vostro disco è formattato con un filesystem supportato da Linux (quindi non FAT32 o NTFS) potete andare al punto successivo, diversamente.

Create un partizione sul disco:

```bash
fdisk /dev/miodisco
```

digitate in sequenza `n`, `p`, `1`, `Invio`, `Invio`, `w` per creare una nuova partizione

Controllate con `lsblk` che il vostro disco contenga solo una partizione.

Prima di poter essere utilizzato il disco deve essere formattato.

! [fa=exclamation-triangle /] **Se il vostro disco è già formattato potete saltare questa parte. La formattazione di un disco comporta la cancellazione di tutti i dati presenti! Ponete attenzione nel digitare il nome del disco, potreste formattare un disco diverso da quello dove volete intervenire! Nell'esempio sopra, il disco si chiama `/dev/sda`. Se il vostro disco è già formattato potete saltare questa parte.

Per formattare la partizione digitate :

```bash
mkfs.ext4 /dev/miodisco
# e poi 'y' per confermare
```

Sostituite `miodisco` con il nome della prima partizione del disco di destinazione, nel nostro esempio `sda1`.

!!! Potete variare queste istruzioni se volete creare un volume raid 1 o cifrare la cartella.

## 4. Montare il disco

Contrariamente a Windows, dove i dischi sono contraddistinti da lette (C:/), in linux i dischi sono accessibili dall'albero del gestore dei file. "Montare" un disco significa renderlo accessibile nell'albero dei file. Sceglieremo di montare il disco in `/mnt/hdd` ma possiamo anche assegnare un nome di fantasia. (Ad esempio `/mnt/disco` ...).

Iniziamo creando la directory:
```bash
mkdir /mnt/hdd
```

Montiamo il disco con il comando:

```bash
mount /dev/miodisco /mnt/hdd
```

(In questo caso, `/dev/miodisco` corrisponde alla prima partizione del disco)

## 5. Montare una cartella /mnt/hdd nella cartella che contiene i dati da spostare

Ipotizzeremo, di seguito, lo spostamento delle mail e di una notevole quantità di dati delle applicazioni, che si trovano in `/home/yunohost.app`.

### 5.1 Creazione delle sotto cartelle sul disco
Iniziamo creando due cartelle nel disco di destinazione.

```bash
mkdir -p /mnt/hdd/home/yunohost.app
mkdir -p /mnt/hdd/var/mail
```

### 5.2 Passaggio alla modalità manutenzione
Precauzionalmente portiamo nello stato di manutenzione le applicazioni che potrebbero scrivere dei dati nella cartella che vogliamo spostare.

Ad esempio, per nextcloud:

```bash
sudo -u nextcloud /var/www/nextcloud/occ maintenance:mode --on
```

Per la mail:

```bash
systemctl stop postfix
systemctl stop dovecot
```

! Se desiderate spostare dei database come ad esempio mariadb (mysql), dovete necessariamente fermare i servizi del database, pena la corruzione dei dati.

### 5.3 Creazione dei punti di montaggio

Procediamo con rinominare la cartella di origine e crearne una fittizia

```bash
mv /home/yunohost.app /home/yunohost.app.bkp
mkdir /home/yunohost.app
mv /var/mail /var/mail.bkp
mkdir /var/mail
```

Servendoci del comando `mount --bind` montiamo la cartella del nostro disco nel nuovo ramo dell'albero dei file.

```bash
mount --bind /mnt/hdd/home/yunohost.app /home/yunohost.app
mount --bind /mnt/hdd/var/mail /var/mail
```

### 5.4 Copia dei dati

Copiamo quindi i dati, mantenendo le proprietà delle cartelle e dei file. Questa operazione può impiegare un po' di tempo, aprendo un altro terminale potete seguire la progressione dell'operazione osservando la dimensione del punto di montaggio con il comando `df -h`

```bash
cp -a /home/yunohost.app.bkp/. /home/yunohost.app/
cp -a /var/mail.bkp/. /var/mail/
```

Terminata la copia, assicuratevi che sia andato tutto a buon fine con il comando `ls`

```bash
ls -la /home/yunohost.app/
ls -la /var/mail/
```

### 5.5 Uscita dalla modalità manutenzione

Da questo momento potete uscire dalla modalità manutenzione, il comando illustrato qui sotto va adattato in base ai servizi che avevate sospeso o arrestato.

```bash
sudo -u nextcloud /var/www/nextcloud/occ maintenance:mode --off
systemctl start postfix
systemctl start dovecot
```

Dopo aver impartito i comandi di avvio, le applicazioni e i servizi sfrutteranno il disco esterno per i loro dati. Dobbiamo quindi effettuare qualche test per capire in quale misura la velocità di esecuzione è impattata dal disco esterno (in particolar modo se il disco utilizza l'interfaccia USB 2.0).

## 6. Automatizzare il montaggio all'avvio


Fino ad ora, abbiamo montato manualmente il disco e le sotto cartelle. È però necessario  configurare il sistema affinché il disco esterno venga montato in automatico ad ogni avvio.

Se i test di velocità sono soddisfacenti, bisogna rendere definitivo il punto di montaggio. In caso contrario affrettatevi a fare dietro front iniziando a ripristinare la modalità di manutenzione. 

Iniziamo cercando l'UUID (universal identifier, identificatore universale) del nostro disco:

```bash
blkid | grep "/dev/miodisco"
# Restituisce una stringa del tipo :
# /dev/sda1:UUID="cea0b7ae-2fbc-4f01-8884-3cb5884c8bb7" TYPE="ext4" PARTUUID="34e4b02c-02"
```

Aggiungiamo una riga di codice al file `/etc/fstab` deputato alla gestione dei montaggi dei dischi all'avvio. Aprite il file con `nano`:

```bash
nano /etc/fstab
```

Digitiamo questa riga in fondo al file:

```bash
UUID="cea0b7ae-2fbc-4f01-8884-3cb5884c8bb7" /mnt/hdd ext4 defaults,nofail 0 0
/mnt/hdd/home/yunohost.app /home/yunohost.app none defaults,bind 0 0
/mnt/hdd/var/mail /var/mail none defaults,bind 0 0
```

(dovremo modificare la riga in base alle nostre scelte precedenti)

Salvate le modifiche con CTRL+x e `o`.

Riavviate il server per assicurarvi che il disco e le sotto cartelle vengano montate in automatico.

## 7. Cancellare i dati precedenti
Quando siete sicuri che la configurazione sia corretta, potete procedere alla cancellazione della configurazione creata nel punto 5.3:

```bash
rm -Rf /home/yunohost.app.bkp
rm -Rf /var/mail.bkp
```

### ![](image://tada.png?resize=32&classes=inline) Complimenti!!!

Se siete giunti fino qui senza incidenti, avete configurato un server che sfrutta uno o più dischi per il salvataggio dei dati.

