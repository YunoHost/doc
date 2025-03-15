---
title: Spostare la cartella di un'applicazione in una nuova collocazione .
template: docs
taxonomy:
    category: docs
routes:
  default: '/moving_app_folder'
---

Le cartelle dei programmi si trovano (*normalmente*) in `/var/www/$nome_programma`

Quando la cartella di una applicazione diventa molto voluminosa, potrebbe essere utile spostarla in una diversa collocazione (HD esterno, scheda sd, ecc).

Di seguito la guida per spostare la cartelle del programma wordpress. Si presuppone che il [dispositivo esterno sia già montato](/administer/tutorials/external_storage)

#### 1. Spostare la cartella wordpress e tutto il suo contenuto nella destinazione finale

```bash
mv /var/www/wordpress /media/externalharddrive/
```

#### 2. Creare un link simbolico

I programmi che dovranno accedere alla cartella /var/www/wordpress saranno reindirizzati verso il disco esterno

```bash
ln -s /media/externalharddrive/wordpress /var/www/wordpress
```

#### 3. Riconfigurare i permessi (non è sicuro che serva)

Potrebbe rendersi necessario modificare i permessi della destinazione finale `/media/externalharddrive` affinché `www-data` (o l'utente dell'applicazione) possa accederci... Esempio non esaustivo:

```bash
chgrp www-data /media/externalharddrive
chmod g+rx /media/externalharddrive
```

(tutto dipende dal vostro setup... Nel caso siete pregati di aggiornare questa pagina di documentazione indicando quello che avete fatto in concreto)
