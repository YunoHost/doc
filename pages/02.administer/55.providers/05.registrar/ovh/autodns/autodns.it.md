---
title: Ottenere una chiave API da OVH
template: docs
taxonomy:
    category: docs
routes:
  default: '/providers/registrar/ovh/autodns'
  aliases:
    - '/registar_api_ovh'
---

Questa parte ha lo scopo di guidarvi nella procedura necessaria all'ottenimento di una chiave API di OVH, necessaria per impostare la procedura di configurazione automatica dei DNS di YunoHost.

! NB. : **Non divulgate MAI i vostri token API !** Un attaccante maligno con i vostri token potrebbe prendere il controllo del vostro dominio ed anche eventualmente del vostro server!

1. Recatevi su <https://eu.api.ovh.com/createToken/>

2. Compilate il formulario con le informazioni richieste, come nell'esempio seguente:

- ID dell'account o indirizzo mail: il vostro User OVH
- Password: la vostra password OVH
- Date un nome allo script: es. `YunoHost Auto DNS`
- Date una sommaria descrizione: es. `YunoHost Auto DNS`
- Validità: `Unlimited`
- Rights: utilizzate il pulsante `+` per aggiungere le seguenti linee
  - `GET` : `/domain/zone/*`
  - `POST` : `/domain/zone/*`
  - `PUT` : `/domain/zone/*`
  - `DELETE` : `/domain/zone/*`

![](image://registrar_api_ovh_1.png?resize=800)

3. Otterrete tre tokens (una chiave segreta, una chiave pubblica, e una chiave consumer) che dovranno essere utilizzate nella configurazione di YunoHost
