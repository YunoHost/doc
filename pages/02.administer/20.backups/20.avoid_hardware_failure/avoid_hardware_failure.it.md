---
title: Evitare i problemi hardware
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/avoid_hardware_failure'
page-toc:
  active: true
  depth: 3
---


## Rendere sicuro fisicamente il tuo server

Frequentemente la persone che fanno selfhosting non dispongono di spazi adatti per posizionare il proprio server. Posizionare il server, o parti di esso, in un luogo di passaggio, accessibile a bambini o animali, o in un luogo poco ventilato, può avere conseguenze catastrofiche.

## Fissate i vostri HD

Sarebbe opportuno fissare saldamente i propri hard disk al fine di evitare vibrazioni che provocano usura prematura del disco, o ne pregiudicano le performance, in particolar modo se si trovano vicini ad altri dischi.

## Ridurre lo swapiness nelle schede SD e nei dischi SSD

Se utilizzate un file di swap, in un disco SSD o in una scheda SD, con uno swapiness troppo elevato correte il serio rischio di usurare prematuramente il vostro supporto a causa di un numero eccessivo di scritture sul disco.

Per evitare il problema

```bash
cat /proc/sys/vm/swappiness
```

Se il comando restituisce un valore superiore a 10:

```bash
sysctl vm.swappiness=10
nano /etc/sysctl.conf
```

Se la riga è presente, cambiate il valore vm.swappiness con 10. In caso contrario aggiungete la riga:

```text
vm.swappiness = 10:
```

## Ridondanza dei supporti

Al fine di limitare i guasti dei supporti si dovrebbe ricorrere ad un cluster di dischi in modalità mirror (RAID, ZFS). Il concetto è che tutto quello che verrà scritto su un disco verrà scritto anche negli altri. In questo modo se un disco subisce un guasto, gli altri garantiranno la funzionalità del server.

Altre configurazioni più evolute, migliorano la tolleranza ai guasti (guasto di 2 dischi nel RAID6) o la suddivisione dei dati (RAID 5).

Comunque i sistemi RAID non vanno considerati come metodi di backup. Un RAID deve essere considerato un normale supporto dei dati. Se questo sistema permette di evitare reinstallazioni in caso di guasto ad un disco, esso non ci garantisce che i nostri dati non correranno nessun rischio.

Alcune situazioni ben conosciute dagli amministratori di sistema.

- i dischi di un cluster creato con dischi della stessa marca possono guastarsi quasi contemporaneamente nel giro di poche ore
- se non monitoriamo lo stato di salute dei nostri dischi, probabilmente ci accorgeremo di un problema ai dischi della  configurazione RAID solo quando si guasterà un secondo disco (><)
- se non abbiamo un HD di scorta, nell'attesa che arrivi il disco nuovo per sostituire quello danneggiato, si guasterà anche l'altro
- un disco che non funziona correttamente può provocare errori in tutta la catena
- anche i controller RAID o i connettori possono guastarsi o dare errori
- più complessa è la nostra catena, maggiori sono le possibilità di un guasto

!!! Se pianificate di creare una catena RAID o utilizzare il filesystem btrfs, la procedura più semplice è quella di installare YunoHost in modalità esperto (nella parte relativa alle partizioni del disco).
