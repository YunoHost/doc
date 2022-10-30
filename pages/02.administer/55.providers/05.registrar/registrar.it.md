---
title: Registrar
template: docs
taxonomy:
    category: docs
never_cache_twig: true
twig_first: true
process:
    markdown: true
    twig: true
routes:
  default: '/providers/registrar'
  aliases:
    - '/autodns'
---

Dalla versione 4.3 YunoHost include un meccanismo per interfacciare il vostro server con le API del vostro registrar del DNS di modo da rendere più semplice ed automatica la registrazione e la manutenzione dei record DNS.

La procedura richiede una configurazione iniziale che richiede di generare una chiave API dall'interfaccia del vostro registrar.

Non sono supportati tutti i registrar. Fino ad ora la comunità ha testato e validato l'interfaccia con [Gandi](https://gandi.net) e [OVH](https://ovh.com), che sono i registrar raccomandati. L'interfaccia con altri potrebbe funzionare ma è ancora considerata sperimentale fino a quando non avremo raccolto sufficiente feedback dalla comunità.

Questa lista può aiutarti a scegliere un registrar se conti di acquistare un nome a dominio da usare con YunoHost.


| Registrar | Compatibilità | Facilità per ottenere una chiave API | Howto |
| --------- | ------------- | ------------------ |
| [Gandi](https://www.gandi.net)     | ✔ (testato)    | ✔ |  [Obtain an API key](/providers/registrar/gandi/autodns)                |
| [OVH](https://www.ovh.com/domaines/)       | ✔ (testato)    | ✘ | [Obtain an API key](/providers/registrar/ovh/autodns) <br> [Configure manually](/providers/registrar/ovh/manualdns) |
| [Namecheap](https://www.namecheap.com/) | ✘ (in lexicon ma non testato)    | ✘✘✘ API non disponibile senza 50$ nell'account  | |
