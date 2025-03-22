---
title: Scambiare i files con il proprio server tramite un'interfaccia grafica.
template: docs
taxonomy:
    category: docs
routes:
  default: '/filezilla'
---

Questa parte spiega come scambiare dei files (backup, musica, foto, video...) con il proprio server, servendosi di un'interfaccia grafica. Utilizzeremo un metodo alternativo al tradizionale comando `scp` perché troppo tecnico e criptico, o alla installazione di un'applicazione come Nextcloud.

Per compiere questa operazione utilizzeremo [FileZilla](https://filezilla-project.org/), un software libero disponibile per Windows, GNU/Linux et macOS.

## Scaricare e installare FileZilla

Potete scaricare FileZilla [da questa pagina](https://filezilla-project.org/download.php?type=client). Il sito dovrebbe proporvi automaticamente la versione adatta al vostro sistema operativo. Nel caso contrario seguite le istruzioni per installare il [client](https://wiki.filezilla-project.org/Client_Installation) corretto.

Installate e lanciate *FileZilla*

## Configurazione

1. Cliccate sull'icona in alto a sinistra *Site Manager*.

   ![Pagina principale di Filezilla](/img/filezilla_1.png)

2. Cliccate su **New Site** e assegnate un nome al server che volete connettere: in questo esempio *Family*. Completate i parametri come nell'immagine (con i vostri dati) e cliccate su **Connect** (N.B. : se volete editare i file dell'applicazione [custom webapp](https://github.com/YunoHost-Apps/my_webapp_ynh), dovrete utilizzare un utente diverso da `admin`. Fate riferimento alla documentazione di custom webapp).

   ![Schermata del site manager](/img/filezilla_2.png)

3. Apparirà un avviso poiché vi state collegando per la prima volta al server. *Se è la prima connessione, potete ignorarlo*

   ![Avviso per la fingerprint del server sconosciuta](/img/filezilla_3.png)

4. Filezilla vi chiederà la password di `admin` del server.

   ![schermata per la richiesta della password](/img/filezilla_4.png)

5. Una volta salvato nei segnalibri, il server verrà salvato e vedrete questa schermata.

   ![Schermata del "site manager" con il server appena aggiunto](/img/filezilla_5.png)

## Utilizzo

1. Collegatevi al server con le credenziali salvate in precedenza. *A volte viene richiesta la password*

   La parte sinistra della finestra del programma si riferisce al vostro pc. La parte destra corrisponde al server YunoHost remoto. Potete navigare tra file e cartelle e effettuare drag-and-drop tra i due computer.

   ![vista della connessione al server remoto](/img/filezilla_6.png)

2. Nel pannello di destra, raggiungete `/home/yunohost.backup/archives` dove si trovano gli [archivi di backup](https://yunohost.org/it/backup)

   ![la directory dove si trovano i backup di YunoHost](/img/filezilla_7.png)

! [fa=cloud-download /] Assicuratevi di scaricare i file `.tar.gz` e `.json`

![Copia dei backup da YunoHost ad un computer locale](/img/filezilla_8.png)

---

Link a fonti esterne:

- [Documentazione ufficiale](https://wiki.filezilla-project.org/FileZilla_Client_Tutorial_(en))
- [Tutorial generale su FileZilla](https://www.rc.fas.harvard.edu/resources/documentation/sftp-file-transfer/)

## Alternative a FileZilla

### GNU/Linux

Qualsiasi distribuzione recente di GNU/Linux dovrebbe permettere di accedere al server remoto utilizzando il gestore dei file.

Nautilus di Gnome3 integra delle funzionalità simili a FileZilla:

- <https://help.gnome.org/users/gnome-help/stable/nautilus-connect.html.en>
- <https://www.techrepublic.com/article/how-to-use-linux-file-manager-to-connect-to-an-sftp-server/>

### Windows

- [WinSCP](https://winscp.net/) è un ottimo programma per Windows

### MacOS

- [Cyberduck](https://cyberduck.io/) un programma libero per macOS
