---
title: Applicazioni
template: docs
taxonomy:
    category: docs
page-toc:
  active: true
routes:
  default: '/apps_overview'
---

Una delle caratteristiche principali di YunoHost è la possibilità di installare facilmente applicazioni che saranno immediatamente utilizzabili. Ad esempio possiamo installare un blog, un "cloud" (per salvare e sincronizzare file), un sito web, un lettore RSS...

Le applicazioni possono essere installate e gestite tramite l'interfaccia di amministrazione web nella sezione `[fa=cubes /] Applicazioni`, oppure utilizzando i comandi della categoria `yunohost app`. 

[center]
![Apps list](image://apps_list.png?resize=512&classes=caption "Lista di applicazioni nella pagina webadmin con il relativo bottone Installa.")
[/center]

È possibile consultare il catalogo delle applicazioni nella pagina di amministrazione cliccando sul bottone `[fa=plus /] Installa` oppure dalla documentazione relativa all'applicazione stessa.

<center><a href="/apps" style="background: orange; border-color: orange;" class="btn btn-lg btn-error"><i class="fa fa-cubes"></i>Lista applicazioni</a></center>


! Siate ragionevoli sul numero di programmi che installate. Ogni programma aumenta le possibilità
di errori e attacchi dall'esterno. È preferibile, se desiderate effettuare dei test, utilizzare una [macchina virtuale](https://yunohost.org/en/install/hardware:virtualbox) con un'altra istanza.

## Installare un'applicazione

Diciamo che volete installare una *Custom Webapp*. Prima di avviare i passi dell'installazione YunoHost  normalmente richiede di compilare un form per eseguire correttamente l'installazione.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Dalla pagina di amministrazione"]

![Form di installazione di Custom Webapp](image://app_install_form.png?resize=512&classes=caption "Form di pre-installazione di Custom Webapp")

[/ui-tab]
[ui-tab title="Dalla riga di comando"]

![Form di installazione di Custom Webapp con la CLI](image://app_install_form_cli.png?resize=512&classes=caption "Form di pre-installazione con la CLI")

[/ui-tab]
[/ui-tabs]

## Sotto-directory e domini individuale per le applicazioni

Fra le domande specifiche i form normalmente chiedono di scegliere un dominio ed un path da dove sarà accessibile l'applicazione.

In un'installazione normale di YunoHost è normale avere un dominio singolo (o al limite un piccolo numero di domini) per tutte le applicazioni installate si "sotto-directory" con una configurazione di questo tipo:

```bash
yolo.com
     ├── /blog  : Wordpress (a blog)
     ├── /cloud : Nextcloud (a cloud service)
     ├── /rss   : TinyTiny RSS (a RSS reader)
     ├── /wiki  : DokuWiki (a wiki)
```

È però possibile scegliere di installare ogni applicazione (o un gruppo di esse) in un dominio dedicato. AL di là di un aspetto puramente estetico, usare sotto-domini invece di sotto-directory permette di spostare un sevizio da un server ad un altro più facilmente. Inoltre alcune applicazioni devono essere installate su un dominio proprio dedicato per ragioni tecniche con lo svantaggio che è necessario aggiungere un dominio per ogni applicazione e di conseguenza configurare ulteriori record DNS, riavviare il sistema di diagnostica e installare un nuovo certificato Let's Encrypt.

{::comment}
Questo non lo metto perché pare una ripetizione
Questo può sembrare più facile per gli utenti finali ma è considerato più complicato e meno efficiente nel contesto di YunoHost poiché è necessario aggiungere un dominio ogni volta. Ad ogni modo alcune applicazioni hanno necessità di un dominio dedicato per ragioni tecniche.
{:/comment}

Se le applicazioni dell'esempio precedente fossero state installate su un dominio separato questo potrebbe essere il risultato:

```bash
blog.yolo.com  : Wordpress (a blog)
cloud.yolo.com : Nextcloud (a cloud service)
rss.yolo.com   : TinyTiny RSS (a RSS reader)
wiki.yolo.com  : DokuWiki (a wiki)
```


!!! Molte applicazioni integrano una caratteristica che permette di cambiare l'URL dell'applicazione. La scelta fra sotto-directory e sotto-dominio in alcuni casi può essere cambiata con una semplice modifica nell'interfaccia di amministrazione.

### Gestione accessi utente e applicazioni pubbliche

Il form di installazione normalmente chiede se l'applicazione deve essere o meno accessibile pubblicamente. Se non viene resa pubblica possono raggiungerla solo gli utente loggati su YunoHost.

!!!! Dopo l'installazione è possibile configurare questa cosa dall'interfaccia via web [Gestisci i gruppi e i permessi](/groups_and_permissions) e allo stesso modo con la riga di comando con la categoria `yunohost user permission`.

## Istruzioni post installazione

Alcune applicazioni, una volta installate, mostrano delle informazioni, possono essere URL o credenziali, per cui è necessario consultare la mail dell'account principale o dell'account amministratore selezionato prima dell'installazione se viene richiesto.

### Applicazioni multi-instanza

Per alcune applicazioni è possibile installarne più copie (in diverse directory) ! Per fare ciò è sufficiente cliccare su `Applicazioni > [fa=plus /] Installa` e selezionare nuovamente l'applicazione da installare.

## Integrazione LDAP / SSO

Le applicazioni che permettono la registrazione degli utenti possono supportare l'integrazione con i sistemi LDAP / Sing Sign On di YunoHost di modo che una volta connessi al portare gli utenti vengono loggati direttamente nell'applicazione.

Però alcune applicazioni non lo supportano e non è possibile neanche implementare il supporto nell'applicazione originaria oppure l'applicazione non funziona in questa funzione. Normalmente queste informazioni si trovano nel file README dell'applicazione stessa.

## Configurazione dell'applicazione

Alcune impostazioni possono essere gestite da YunoHost dopo l'installazione come ad esempio i permessi di utenti e gruppi, il tile e l'etichetta dell'applicazione nella pagina SSO e il relativo URL di connessione.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Dalla pagina di amministrazione"]

È possibile accedere alla pagina relative alle operazioni dell'applicazione cliccando sul nome nella lista delle applicazioni.

![Pagina con le operazioni per le applicazioni](image://app_config_operations.png?resize=768&classes=caption "Pagina con le operazioni dell'applicazione nella pagina di amministrazione")

Da questa pagina è anche possibile eliminare l'applicazione.

[/ui-tab]
[ui-tab title="Dalla riga di comando"]

Dalla riga di comando è possibile cambiare:

* l'etichetta dell'applicazione nel sistema SSO: `yunohost app change-label <app> <new_label>`
* l'url di connessione: `yunohost app change-url <app> [-d <DOMAIN>] [-p <PATH>]`

È anche possibile eliminare l'applicazione: `yunohost app remove <app>`

dove `<app>` deve essere sostituito con l'identificativo dell'applicazione. Se questa ha una sola istanza, come ad esempio Nextcloud l'identificativo è `nextcloud`, se invece è il secondo allora è `nextcloud__2` e così via. È possibile elencare tutte le applicazioni e i loro identificativi con il comando `yunohost app info`.

[/ui-tab]
[/ui-tabs]

### Pannelli di configurazione

Alcune applicazioni includono un *pannello di configurazione* che contiene azioni e impostazioni specifiche per ogni applicazione che vengono normalmente gestite al suo interno. Inoltre includono anche la possibilità di modificare file di configurazione senza doverlo fare da soli.

!!!! I pannelli di configurazione non sono realizzati per modificare ogni aspetto dell'applicazione: userete sicuramente molto più spesso i pannelli di configurazione interni di quelli forniti da YunoHost.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Dalla pagina di amministrazione"]

È possibile accedere alla pagina relative alle operazioni dell'applicazione cliccando sul bottone `[fa=cogs /] Configurazione`.

![Pannello di configurazione di My Webapp](image://app_config_panel.png?resize=768&classes=caption "Pannello di configurazione di MyWebapp")

[/ui-tab]
[ui-tab title="Dalla riga di comando"]

Dalla riga di comando è possibile elencare le impostazione del pannello di configurazione con il comando `yunohost app config get <app>`

```
$ yunohost app config get my_webapp
main.php_fpm_config.phpversion:
  ask: PHP version
  value: none
main.sftp.password:
  ask: Set a password for the SFTP access
  value: **************
main.sftp.with_sftp:
  ask: Do you need a SFTP access?
  value: yes
```

Per modificare una configurazione si può usare il comando `yunohost app config set <app>` per avere la richiesta di modifica di ogni impostazione oppure il comando`yunohost app config set <app>` per modficarne una specifica.

La parola `<key>` è il nome dell'impostazione come nell'esempio sopra `main.sftp.with_sftp`.

[/ui-tab]
[/ui-tabs]

## Eseguire comandi dall'applicazione

Dalla versione di YunoHost v11.1.21.4 è possibile eseguire un comando con il binario dell'applicazione o comandi PHP con il comando `yunohost app shell <app>`.
In questo modo:
- verrà avviata una shell Bash come l'utente di sistema dell'applicazione
- verrà aperta la directory di lavoro dell'applicazione (ad esempio `/var/www/<app>`)
- carico di tutte le variabili d'ambiente come da file service dell'applicazione se queste esistono
- verrà il usata la versione di `php` usata dall'applicazione

## Packaging delle applicazioni

Le applicazioni devono essere preparate (packaging) manualmente dai programmatori (packagers)/manutentori. Le applicazioni possono essere integrate con YunoHost perché supportino gli upgrade, i backup e restore e l'integrazione con LDAP/SSO fra le altre cose. 

## Integrazione e qualità

Test automatici sono regolarmente eseguiti per controllare l'integrazione e la qualità dei programmi che sono stati dichiarati "working" dai packagers. I risultati vengono classificati con una scala da 0 a 8, il significato dei valori è spiegato su [questa pagina](https://yunohost.org/en/packaging_apps_levels)

Alcuni risultati sono disponibili su [questa pagina](https://dash.yunohost.org/appci/branch/stable).


Solo i programmi con una qualità sufficiente sono inseriti nell'elenco delle applicazioni installabili. Nel caso i test dovessero segnalare una diminuzione dell'indice di qualità, gli aggiornamenti saranno sospesi e le nuove installazioni non saranno possibili fino alla soluzione del problema che ha causato l'abbassamento dell'indice.

