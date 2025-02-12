---
title: Migrare o unire server
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/migrate_or_merge_servers'
page-toc:
  active: true
  depth: 3
---


## Migrare un server

Il sistema di archiviazione di YunoHost permette di migrare facilmente un server ma potete anche seguire [questo link per migrare un server ad un altro con rsync](https://www.man42.net/blog/2017/07/how-to-migrate-a-debian-server/).

## Aggregare 2 server YunoHost

Se volete aggregare 2 server dovrete ricreare i domini, gli account utenti e i relativi permessi dal primo al server di destinazione. In seguito potrete ripristinare i programmi uno alla volta.

!! Esiste però un limite che riguarda i programmi che hanno lo stesso ID che saranno difficilmente ripristinabili. Abbiate cura di non cancellare il programma eponymous del server di destinazione :/
