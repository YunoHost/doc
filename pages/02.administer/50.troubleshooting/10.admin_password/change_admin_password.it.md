---
title: Cambiare la password dell'amministratore
template: docs
taxonomy:
    category: docs
routes:
  default: '/change_admin_password'
---

Potrebbe essere necessario cambiare la password dell'amministratore per ragioni di sicurezza o perché l'hai dimenticata.

Se hai dimenticata la password dell'amministratore o se non puoi collegarti usando l'utente `admin` puoi sempre cambiare la password se riesci a collegarti come `root` via SSH (esclusivamente dalla tua rete locale! o usando il modo rescue se stai usando una VPS...)

## Usando l'interfaccia web di amministrazione

Innanzitutto collegati all'interfaccia web d'amministrazione.

Poi vai su Strumenti > Cambia password amministrazione.

## Usando l'interfaccia a linea di comando

```bash
yunohost tools rootpw
```
