---
title: Domini nohost.me
template: docs
taxonomy:
    category: docs
routes:
  default: '/dns_nohost_me'
---

Al fine di rendere il self-hosting accessibile al maggior numero di persone, il progetto YunoHost fornisce un servizio *gratuito* di nomi di dominio *configurati automaticamente*. Utilizzando questo servizio non dovrete [configurare i record DNS](/dns_config), in generale un'operazione abbastanza complessa.

Potete scegliere tra i (sotto-) domini seguenti:

- `miosito.nohost.me`;
- `miosito.noho.st`;
- `miosito.ynh.fr`.

Per usare questo servizio sarà sufficiente scegliere uno di questi domini nella fase di post installazione e YunoHost si occuperà di configurare il tutto!

!!! Per ragioni di equità, **non potete avere più di un dominio nohost.me** per ogni installazione di YunoHost.

### Sotto domini

Il servizio di domini `nohost.me`, `noho.st` e `ynh.fr` permette la creazione di sotto domini.

YunoHost permette l'installazione di applicazioni in sotto domini (ad esempio avere l'applicazione NextCloud accessibile dall'indirizzo `cloud.miosito.org`), e questa funzionalità è permessa anche con i domini `nohost.me`, `noho.st` e `ynh.fr.` e quindi è possibile avere un sotto-sotto dominio com ad esempio `cloud.miosito.nohost.me`. Per creare un sotto dominio in un dominio `nohost.me`, `noho.st` e `ynh.fr` è sufficiente aggiungere quest'ultimo a YunoHost, con la stessa procedura di un qualsiasi altro nome di dominio.

### Aggiungere un dominio nohost.me, noho.st e ynh.fr dopo la post-installazione

Se avete già effettuato la post-installazione e desiderate aggiungere un dominio del tipo nohost.me, potere utilizzare la sezione "Domini" dall'interfaccia web di amministrazione,
scegliendo l'opzione "Non ho un nome di dominio.."

Potete compiere la stessa operazione da shell con i seguenti comandi.

```bash
# Aggiungere il domino
yunohost domain add miosito.nohost.me

# Registrare il dominio nel servizio dydns
yunohost dyndns subscribe -d miosito.nohost.me

# [ attendere ~ 30 secondi ]

# Aggiornare la configurazione DNS
yunohost dyndns update

# Impostarlo come dominio principale
yunohost domain main-domain -n miosito.nohost.me
```

### Ripristinare un dominio nohost.me, noho.st, ynh.fr

Se dovete reinstallare il vostro server e volete utilizzare un dominio offerto da YunoHost ma già utilizzato precedentemente, dovete chiedere la reinizializzazione del dominio [nella specifica sezione del forum](https://forum.yunohost.org/t/nohost-domain-recovery/442).

### Cambiare uno dominio nohost.me, noho.st, ynh.fr

Se volete cambiare il dominio automatico, dovete inizialmente cancellare quello già configurato seguendo le istruzioni seguenti:

1. Cancellare il dominio dalla vostra istanza (utilizzando l'interfaccia web oppure il comando da shell `yunohost domain remove`).
2. Richiedere la cancellazione del nome del dominio [nella specifica sezione del forum](https://forum.yunohost.org/t/nohost-domain-recovery/442).
3. Cancellare i file di configurazione automatica sulla vostra istanza (al momento solamente da linea di comando: `sudo rm /etc/cron.d/yunohost-dyndns && sudo rm -r /etc/yunohost/dyndns`

Potete quindi registrare un nuovo nome di dominio.
