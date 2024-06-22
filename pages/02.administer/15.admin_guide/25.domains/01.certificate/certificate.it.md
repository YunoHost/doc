---
title: Certificati
template: docs
taxonomy:
    category: docs
routes:
  default: '/certificate'
---

I certificati sono utilizzati per garantire la confidenzialità e l'autenticità delle comunicazioni tra il browser e il server. In particolare proteggono il visitatore del sito da usurpazioni dell'identità del server.

YunoHost fornisce di default un certificato **auto firmato**, cioè il vostro server garantisce la validità del certificato. Questo metodo è valido per un **uso personale** del vostro server, del quale certamente vi fidate, mentre non è sufficiente se volete esporre il vostro server su internet ad esempio se esso ospita un sito web.

Con questa configurazioni chi accede al vostro sito vedrà una schermata del tipo:

![](image://postinstall_error.png)

Il browser fondamentalmente ci chiede **«Potete fidarvi del server che ospita questo sito?»** e giustamente molti visitatori possono preoccuparsi davanti a tale domanda.

Per evitare questa situazione è possibile ottenere un certificato riconosciuto dai browser e firmato da un'autorità conosciuta come **Let's Encrypt**, **Gandi**, **RapidSSL**, **StartSSL**, **Cacert**.

In particolare **Let's Encrypt** offre i certificati gratuitamente. Dalla versione 2.5 YunoHost permette di installare il certificato direttamente dall'interfaccia di amministrazione web o da linea di comando. Di seguito troverete la documentazione per l'installazione e la gestione di un certificato. È comunque possibile [installare ugualmente un certificato di un'autorità diversa da Let's Encrypt](/certificate_custom).

### Installare un certificato Let's Encrypt

Prima di installare il certificato Let's Encrypt, assicuratevi che il vostro DNS
sia correttamente configurato (nomevostrodominio.tld deve puntare all'indirizzo
IP del vostro server) e che il vostro sito sia accessibile in HTTP dall'esterno
(la porta 80 deve essere aperta e rediretta verso il vostro server).

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Dall'interfaccia web"]

Recatevi nella sezione 'Domini' dell'interfaccia di amministrazione, scegliete la sezione del vostro dominio, qui troverete un pulsante 'Certificato SSL'

![](image://domain-certificate-button.png)

Nella sezione 'Certificati SSL' potere visualizzare lo stato attuale del
certificato. Se avete appena creato il dominio, esso disporrà di un certificato
auto firmato.

![](image://certificate-before-LE.png)

Se il vostro dominio è correttamente configurato è possibile installare il certificato Let's Encrypt con il bottone verde.

![](image://certificate-after-LE.png)

Una volta installato il certificato potete verificarne il corretto funzionamento collegandovi con il vostro browser al dominio in HTTPS. Il certificato verrà automaticamente rinnovato ogni tre mesi.

![](image://certificate-signed-by-LE.png)

[/ui-tab]
[ui-tab title="Dalla riga di comando"]

Collegatevi al server con SSH.

Potete controllare lo stato del certificato in uso con il comando:

```bash
yunohost domain cert status your.domain.tld
```

Installate il certificato Let's Encrypt con il comando:

```bash
yunohost domain cert install your.domain.tld
```

Che dovrebbe dare come risultato:

```bash
Success! The SSOwat configuration has been generated
Success! Successfully installed Let's Encrypt certificate for domain DOMAIN.TLD!
```

Una volta installato il certificato potete verificarne il corretto funzionamento collegandovi con il vostro browser al dominio in HTTPS. Il certificato verrà automaticamente rinnovato ogni tre mesi.

[/ui-tab]
[/ui-tabs]

### Problemi e soluzioni

Se il vostro certificato risultasse non funzionante a causa di qualche errore (ad esempio lo avete perso oppure non siete in grado di leggere i file) potete ripulire la situazione rigenerando un certificato autofirmato con questo comando:

```bash
yunohost domain cert install your.domain.tld --self-signed --force
```

Se YunoHost pensa che il vostro dominio non è configurato correttamente nonstante abbiate controllato la configurazione del DNS e riuscite a collegarvi in HTTP al vostro server anche dall'esterno della rete locale allora potete:

- aggiungere una linea `127.0.0.1 vostrodominio.tld` nel file `/etc/hosts` sul vostro server;
- se nonostante questo l'installazione del certificato dovesse ancora fallire potete disabilitare il controllo con l'opzione `--no-checks` dopo il comando `cert install`.
