---
title: Sbannare un indirizzo IP
template: docs
taxonomy:
    category: docs
routes:
  default: '/fail2ban'
---

**Fail2Ban** è un programma di prevenzione delle intrusioni che protegge i server contro gli attacchi di forza bruta (brute-force), controllando alcuni log e bannando (cioè impedendo ulteriori connessioni) gli indirizzi IP che mostrano questo tipo di comportamento.

In particolare, **Fail2Ban** controlla tentativi di connessione su `SSH`. Dopo cinque tentativi di connessione falliti, Fail2Ban banna l'indirizzo IP impedendogli la connessione SSH per 10 minuti. Se la cosa si ripete altre volte viene bannato per una settimana.

## Togliere il ban ad un indirizzo

Per sbloccare un indirizzo è necessario innanzitutto accedere al server con qualche mezzo (ad esempio da un altro indirizzo IP o da un'altra connessione diversa da quella bannata).

Dopo di che controlla il **log di Fail2Ban** per trovare in quale `jail` è stato bannato l'indirizzo IP:

```bash
sudo tail /var/log/fail2ban.log
2019-01-07 16:24:47 fail2ban.filter  [1837]: INFO    [sshd] Found 11.22.33.44
2019-01-07 16:24:49 fail2ban.filter  [1837]: INFO    [sshd] Found 11.22.33.44
2019-01-07 16:24:51 fail2ban.filter  [1837]: INFO    [sshd] Found 11.22.33.44
2019-01-07 16:24:54 fail2ban.filter  [1837]: INFO    [sshd] Found 11.22.33.44
2019-01-07 16:24:57 fail2ban.filter  [1837]: INFO    [sshd] Found 11.22.33.44
2019-01-07 16:24:57 fail2ban.actions [1837]: NOTICE  [sshd] Ban 11.22.33.44
2019-01-07 16:24:57 fail2ban.filter  [1837]: NOTICE  [recidive] Ban 11.22.33.44
```

In questo esempio l'indirizzo `11.22.33.44` è stato bannato nel `jail` `sshd` e `recidive`.

Quindi togli il ban con il seguente comando:

```bash
sudo fail2ban-client set sshd unbanip 11.22.33.44
sudo fail2ban-client set recidive unbanip 11.22.33.44
```

## Aggiungere un indirizzo IP alla whitelist

Se vuoi impedire che un indirizzo IP "legittimo" venga bloccato da **YunoHost** ancora devi compilare la whitelist del file di configurazione della `jail`.

Aggiornando **Fail2Ban** il file `/etc/fail2ban/jail.conf` originale verrà sovrascritto quindi dovremo scrivere questi cambiamenti su un nuovo file che verrà mantenuto.

1. Comincia creando un nuovo file di configurazione della jail che verrà chiamato `yunohost-whitelist.conf`:

    ```bash
    sudo touch /etc/fail2ban/jail.d/yunohost-whitelist.conf
    ```

2. Modifica questo nuovo file con il tuo editor preferito (in questo esempio viene usato `nano`):

    ```bash
    sudo nano /etc/fail2ban/jail.d/yunohost-whitelist.conf
    ```

3. Incolla il seguente testo nel file cambiando l'indirizzo IP `XXX.XXX.XXX.XXX`:

    ```bash
    [DEFAULT]

    ignoreip = 127.0.0.1/8 XXX.XXX.XXX.XXX #<= the IP address (you can put more than one, separated by a space) that you want to whitelist
    ```

4. Salva il file e ricarica la configurazione di Fail2Ban:

    ```bash
    sudo fail2ban-client reload
    ```

Congratulazioni, non corrererai più il rischio di essere bannato dal tuo server YunoHost!
