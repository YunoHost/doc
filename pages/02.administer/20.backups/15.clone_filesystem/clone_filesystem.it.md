---
title: Create a filesystem image
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/clone_filesystem'
page-toc:
  active: true
  depth: 3
---

!! Images are missing on this page

Lo strumento di backup di Yunohost salva solamente i files utili e si basa su degli script di ripristino per reinstallare le dipendenze dei vostri programmi installati. In altre parole, il ripristino di YunoHost prevede in un primo tempo la reinstallazione del sistema e in seguito il ripristino dei dati.

Realizzare un'immagine completa può essere un metodo, complementare o alternativo, per un backup del vostro server. Il vantaggio sta nel fatto che il vostro server può essere ripristinato nella stessa configurazione presente al momento del backup.

In base a quale tipo di installazione avete, potrete creare uno snapshot oppure clonare il supporto che ospita il sistema (mentre è spento).

## Eseguire uno snapshot
Lo snapshot permette di congelare l'immagine del file system. Gli snapshot sono molto comodi in caso di aggiornamenti frequenti o di prove, perché vi permettono di tornare facilmente sui vostri passi in caso di problemi. Purtroppo, a meno di non avere un cluster ad altissima affidabilità, gli snapshot non vi proteggono efficacemente contro i guasti hardware o catastrofi (come l'incendio di OVH a Strasburgo nel 2021).

Generalmente gli snapshot non occupano molto spazio sull'hard disk, si basano sul principio del backup differenziale, salvano cioè solo le variazioni dei file avvenute dopo la creazione del primo snapshot. Di conseguenza solo le modifiche prendono spazio.

! Ricordatevi di cancellare i vecchi snapshot, eviterete di consumare inutilmente spazio con backup differenziali troppo datati!

Potete usare questo sistema con la maggior parte dei fornitori VPS (quasi sempre a pagamento), nei programmi di gestione di macchine virtuali oppure, se avete installato YunoHost con un filesystem avanzato quale btrfs, ceph o ZFS potrete creare gli snapshot da riga di comando.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="VPS"]
Sotto la documentazione per i provider più conosciuti:
 * [DigitalOcean (EN)](https://docs.digitalocean.com/products/images/snapshots/)
 * [Gandi](https://docs.gandi.net/fr/simple_hosting/operations_courantes/snapshots.html)
 * [OVH](https://docs.ovh.com/fr/vps/snapshot-vps/)
 * [Scaleway (EN)](https://www.scaleway.com/en/docs/backup-your-data-with-snapshots/)
[/ui-tab]
[ui-tab title="VirtualBox"]
Seleziona la macchina virtuale e clicca su `Snapshot`, poi indica il nome dello snapshot e clicca `OK`.
![Il bottone per gli snapshot button si trova in alto a destra](image://virtualbox-snapshot2.webp)

Per ripristinare, selezionate la macchina virtuale, cliccate su`Snapshots` poi scegliete `Restore Snapshot option`.
![](image://virtualbox-snapshot3.webp)

Infine cliccate su `Restore Snapshot`.
![](image://virtualbox-snapshot4.webp)
[/ui-tab]
[ui-tab title="Proxmox"]

* Selezionate la macchina virtuale
* Andate al tab `Backup`
* Cliccate su `Backup now`
* Scegliete `Snapshot`
* Confermate
[/ui-tab]
[ui-tab title="BTRFS"]
Nell'esempio seguente `/pool/volume` è il volume da salvare.

Creare uno snapshot in sola lettura
```
btrfs subvolume snapshot /pool/volume /pool/volume/$(date +"%Y-%m-%d_%H:%M")
```

Elencare gli snapshots
```
btrfs subvolume show /pool/volume
```

Ripristinare uno snapshots
```
btrfs sub del /pool/volume
btrfs sub snap /pool/volume/2021-07-22_16:12 /pool/volume
btrfs sub del /pool/volume/2021-07-22_16:12
```

Cancellare uno snapshot
```
btrfs subvolume delete /pool/volume/2021-07-22_16:12
```
!! Attenzione a non cancellate il volume originale

!!! Seguite [questo tutorial](https://www.linux.com/training-tutorials/how-create-and-manage-btrfs-snapshots-and-rollbacks-linux-part-2/) per maggiori informazioni
[/ui-tab]
[ui-tab title="CEPH"]
Nell'esempio seguente `pool/volume` è il volume che vogliamo salvare

Creare uno snapshots
```
rbd snap create pool/volume@$(date +"%Y-%m-%d_%H:%M")
```

Elencare gli snapshot
```
rbd snap ls pool/volume
```

Ripristinare uno snapshot
```
rbd snap rollback pool/volume@2021-07-22_16:22
```

Cancellare uno snapshot
```
rbd snap rm pool/volume@2021-07-22_16:12
```
[/ui-tab]
[ui-tab title="ZFS"]
Nell'esempio seguente `pool/volume` è il volume che vogliamo salvare.

Creare uno snapshot
```
zfs snapshot pool/volume@$(date +"%Y-%m-%d_%H:%M")
```

Elencare gli snapshots
```
zfs list -t snapshot -o name,creation
```
Ripristinare uno snapshot
```
zfs rollback pool/volume@2021-07-22_16:22
```

Cancellare uno snapshot
```
zfs destroy pool/volume@2021-07-22_16:12
```

[/ui-tab]
[/ui-tabs]


## Creare una immagine a freddo del server

Potete clonare il supporto del vostro server (scheda SD, disco SSD, volume di un VPS...) al fine di creare una immagine del disco. L'immagine creata, prima che venga compressa, sarà della stessa dimensione del vostro supporto e di conseguenza questa procedura è consigliata per supporti di capacità inferiore a 64GB.

Questo metodo comporta lo spegnimento del server per il tempo necessario alla creazione dell'immagine, eccetto nel caso che possiate usare uno snapshot come origine. Se il server YunoHost è ospitato su un VPS dovrete riavviarlo in modalità rescue dall'interfaccia del vostro provider.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Usando USBimager"]
Questo può essere fatto con il programma [USBimager](https://bztsrc.gitlab.io/usbimager/)  <https://bztsrc.gitlab.io/usbimager/> (N.B.: assicuratevi di scaricare la versione  'Read-write'! Non la versione 'Write-only'!). Il processo poi prosegue "all'opposto" della copia sulla scheda SD:
- Spegnete il vostro server
- Estraete la scheda SD e inseritela nel pc
- Nel programma USBimage cliccate su "Read" per creare l'immagine ("photograph") della scheda SD. Il file ottenuto verrà utilizzato per il ripristino del sistema.

Maggiori informazioni [nella documentazione di USBimager](https://gitlab.com/bztsrc/usbimager/#creating-backup-image-file-from-device)
[/ui-tab]
[ui-tab title="Usando la linea di comando con dd"]

Se siete avezzi al terminale potete ottenere lo stesso risultato con il comando `dd`

```bash
dd if=/dev/mmcblk0 | gzip > ./my_snapshot.gz
```

dove `/dev/mmcblk0` sarà il vostro supporto (scheda SD o disco).

[/ui-tab]
[/ui-tabs]

