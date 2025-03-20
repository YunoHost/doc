---
title: Configurare un programma per mail
template: docs
taxonomy:
    category: docs
routes:
  default: '/email_configure_client'
---

Con la vostra istanza YunoHost potete inviare e ricevere email grazie a programmi come Thunderbird Desktop sul pc o K-9 Mail sul vostro smartphone.

Normalmente, il vostro client email si configura automaticamente quando aggiungete un account. Nel caso la configurazione automatica non funzionasse, è possibile configurare manualmente il client, seguendo i passaggi successivi. (la mancata configurazione automatica del client, è da considerarsi come un bug di YunoHost, sarebbe gentile da parte vostra farci pervenire una segnalazione, potremmo così cercare di correggere il problema!)

### Impostazioni generiche

Ecco i valori da immettere per la configurazione manuale del vostro client mail (`vostro.dominio.tld` si riferisce a quello che appare dopo la @ nel vostro indirizzo mail, `nome utente` è riferito a quello che appare prima della @).

|Protocollo | Porta | Sicurezza della connessione | Metodo di autenticazione | Nome utente |
| :--:     | :-:  | :--:       | :--:            | :--:                                   |
| IMAP | 993 | SSL/TLS | Password normale | nome utente (senza `@vostro.domino.tld`) |
| SMTP | 587 | STARTTLS | Password normale| nome utente (senza `@vostro.domino.tld`) |

### Esempio di alcuni client

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Thunderbird Desktop"]

#### ![](/img/thunderbird.png?resize=50&classes=inline)  Configurazione di Thunderbird Desktop (su computer desktop)

Per configurare manualmente un nuovo account in Thunderbird Desktop, iniziate ad inserire le informazioni iniziali (nome, indirizzo e password), cliccate su Continua e poi su Configurazione Manuale selezionando la porta 993 con SSL/TLS per IMAP e la porta 587 con STARTTLS per SMTP. Selezionate 'Password normale' come autenticazione e poi cliccate su 'Configurazione avanzata'. Può darsi che dobbiate accettare l'eccezione per il certificato prima di riuscire a scaricare l'email e prima di riuscire ad inviare la prima email. Non dimenticate di togliere il punto prima del nome del dominio.

![](/img/thunderbird_config_1.png?resize=900)
![](/img/thunderbird_config_2.png?resize=900)

- [Gestione alias email](https://support.mozilla.org/en-US/kb/configuring-email-aliases)

[/ui-tab]
[ui-tab title="K-9 Mail / Thunderbird Mobile"]

#### ![](/img/k9mail.png?resize=50&classes=inline) Configurazione di K-9 Mail / Thunderbird Mobile (per Android)

Seguite le istruzioni seguenti (come per dovrete forse accettare i certificati affinché tutto funzioni correttamente):

![](/img/thunderbird_mobile_config_1.png?resize=280&classes=inline)
![](/img/thunderbird_mobile_config_2.png?resize=280&classes=inline)
![](image:/thunderbird_mobile_config_3.png?resize=280&classes=inline)

[/ui-tab]
[ui-tab title="Dekko"]

#### ![](/img/dekko-app.png?resize=50&classes=inline) Configurazione di Dekko (per Ubuntu Touch)

Se nessun account è già configurato, potete semplicemente scegliere "Aggiungi account". Se un account è già presente, premete sul menù a panino e in seguito sugli ingranaggi, scegliete Mail, Accounts e il simbolo '+'.

Selezionate IMAP. Compilate i campi e premete Successivo. Dekko cercherà la configurazione necessaria. Controllate che tutti i campi siano corretti. Assicuratevi di aver inserito come nome utente il nome utente di YunoHost e NON il vostro indirizzo mail, scegliete "Autorizza certificati non firmati". Effettuate queste operazioni per IMAP e per SMTP e premete Successivo. Aspettate che Dekko termini la sincronizzazione dell'account. Avete finito! Complimenti!

![](/img/dekko_config_1.png?resize=280&classes=inline)
![](/img/dekko_config_2.png?resize=280&classes=inline)
![](/img/dekko_config_3.png?resize=280&classes=inline)
![](/img/dekko_config_4.png?resize=280&classes=inline)
  </TabItem>
</Tabs>
