---
title: Installazione di YunoHost
template: docs
taxonomy:
    category: docs
never_cache_twig: true
twig_first: true
process:
    markdown: true
    twig: true
page-toc:
  active: true
  depth: 2
routes:
  default: '/install'
  aliases: 
    - '/install_iso'
    - '/install_on_vps'
    - '/install_manually'
    - '/install_on_raspberry'
    - '/install_on_arm_board'
    - '/install_on_debian'
    - '/install_on_virtualbox'
    - '/plug_and_boot'
    - '/burn_or_copy_iso'
    - '/boot_and_graphical_install'
    - '/postinstall'
    - '/hardware'
---
{% set image_type = 'YunoHost' %}
{% set arm, at_home, regular, rpi345, rpi012, show_legacy_arm_menu, arm_sup, arm_unsup, vps, vps_debian, vps_ynh, virtualbox, wsl, internetcube = false, false, false, false, false, false, false, false, false, false, false, false, false, false %}
{% set hardware = uri.param('hardware')  %}

{% if hardware == 'regular' %}
  {% set regular = true %}
{% elseif hardware == 'internetcube' %}
  {% set arm, arm_sup, internetcube = true, true, true %}
  {% set image_type = 'Internet Cube' %}
  {% set show_legacy_arm_menu = true %}
{% elseif hardware == 'rpi345' %}
  {% set arm, rpi345 = true, true %}
{% elseif hardware == 'rpi012' %}
  {% set arm, arm_unsup, rpi012 = true, true, true %}
  {% set hardware = '' %}
{% elseif hardware == 'arm_sup' %}
  {% set arm, arm_sup = true, true %}
  {% set show_legacy_arm_menu = true %}
{% elseif hardware == 'arm' %}
  {% set arm, arm_unsup = true, true %}
  {% set image_type = 'Armbian' %}
{% elseif hardware == 'arm_unsup' %}
  {% set arm, arm_unsup = true, true %}
  {% set show_legacy_arm_menu = true %}
  {% set image_type = 'Armbian' %}
{% elseif hardware == 'vps_debian' %}
  {% set vps, vps_debian = true, true %}
{% elseif hardware == 'vps_ynh' %}
  {% set vps, vps_ynh = true, true %}
{% elseif hardware == 'virtualbox' %}
  {% set at_home, virtualbox = true, true %}
{% elseif hardware == 'wsl' %}
  {% set wsl = true %}
{% endif %}

{% if arm or regular %}
  {% set at_home = true %}
{% endif %}

Selezionate l'hardware sul quale vuoi installare YunoHost:
[div class="flex-container"]

[div class="flex-child hardware{%if virtualbox %} active{% endif %}"]
[[figure caption="VirtualBox"]![](/img/virtualbox.png?height=75)[/figure]](/install/hardware:virtualbox)
[/div]

[div class="flex-child hardware{%if rpi012 or rpi345 %} active{% endif %}"]
[[figure caption="Raspberry Pi"]![](/img/raspberrypi.png?height=75)[/figure]](/install/hardware:rpi345)
[/div]

[div class="flex-child hardware{%if arm_sup or (arm_unsup and not rpi012) or internetcube %} active{% endif %}"]
[[figure caption="scheda ARM"]![](/img/olinuxino.png?height=75)[/figure]](/install/hardware:arm)
[/div]

[div class="flex-child hardware{%if regular %} active{% endif %}"]
[[figure caption="Computer normale"]![](/img/computer.png?height=75)[/figure]](/install/hardware:regular)
[/div]

[div class="flex-child hardware{%if wsl %} active{% endif %}"]
[[figure caption="WSL"]![](/img/wsl.png?height=75)[/figure]](/install/hardware:wsl)
[/div]

[div class="flex-child hardware{%if vps_debian or vps_ynh %} active{% endif %}"]
[[figure caption="Server remoto"]![](/img/vps.png?height=75)[/figure]](/install/hardware:vps_debian)
[/div]

[/div]
[div class="flex-container pt-2"]

{% if rpi012 or rpi345 %}
[div class="flex-child hardware{%if rpi345 %} active{% endif %}"]
[[figure caption="Raspberry Pi 3, 4 o 5"]![](/img/raspberrypi.png?height=50)[/figure]](/install/hardware:rpi345)
[/div]

[div class="flex-child hardware{%if rpi012 %} active{% endif %}"]
[[figure caption="Raspberry Pi 0, 1 or 2"]![](/img/rpi1.png?height=50)[/figure]](/install/hardware:rpi012)
[/div]

{% elseif show_legacy_arm_menu %}

[div class="flex-child hardware{%if internetcube %} active{% endif %}"]
[[figure caption="Internet cube With VPN"]![](/img/internetcube.png?height=50)[/figure]](/install/hardware:internetcube)
[/div]

[div class="flex-child hardware{%if arm_sup and not internetcube %} active{% endif %}"]
[[figure caption="Olinuxino lime1&2 or Orange Pi PC+"]![](/img/olinuxino.png?height=50)[/figure]](/install/hardware:arm_sup)
[/div]

[div class="flex-child hardware{%if arm_unsup %} active{% endif %}"]
[[figure caption="Others boards"]![](/img/odroidhc4.png?height=50)[/figure]](/install/hardware:arm_unsup)
[/div]
{% elseif vps_debian or vps_ynh %}

[div class="flex-child hardware{%if vps_debian %} active{% endif %}"]
[[figure caption="VPS or dedicated server with Debian 12"]![](/img/debian-logo.png?height=50)[/figure]](/install/hardware:vps_debian)
[/div]

[div class="flex-child hardware{%if vps_ynh %} active{% endif %}"]
[[figure caption="VPS or dedicated server with YunoHost pre-installed"]![](/img/logo.png?height=50)[/figure]](/install/hardware:vps_ynh)
[/div]

{% endif %}

[/div]

{% if rpi012 %}
!! Il supporto per Raspberry Pi 0, 1 e 2 è stato purtroppo abbandonato da Debian 12 Bookworm. Si consiglia di migrare a un modello di Raspberry Pi più moderno, supportato da Bookworm.
{% endif %}

{% if hardware != '' %}

{% if wsl %}
!! This setup is mainly meant for local testing by advanced users. Due to limitations on WSL's side (changing IP address, notably), selfhosting from it can be tricky and will not be described here.
{% endif %}

## [fa=list-alt /] Pre-requisiti

{% if regular %}

- Un computer compatibile x86 dedicato a YunoHost: un laptop, nettop, netbook o desktop con almeno 512 MB di RAM e un disco di 16 GB
{% elseif rpi345 %}
- Un Raspberry Pi 3, 4 o 5
{% elseif internetcube %}
- Un Orange Pi PC+ o un Olinuxino Lime 1 o 2
- Una VPN con un IP pubblico dedicato e un file `.cube`
{% elseif arm_sup %}
- Un Orange Pi PC+ o un Olinuxino Lime 1 o 2
{% elseif arm_unsup %}
- Una scheda ARM con almeno 512 MB di RAM
{% elseif vps_debian %}
- Un virtual private server dedicato con Debian 12 <small>(con un **kernel >= 6.1**)</small> preinstallato, almeno 512 MB di RAM e 16 GB disponibili
{% elseif vps_ynh %}
- Un virtual private server dedicato con YunoHost preinstallato, almeno 512 MB di RAM e 16 GB disponibili
{% elseif virtualbox %}
- Un computer x86 con [installato VirtualBox](https://www.virtualbox.org/wiki/Downloads) con sufficiente RAM per far funzionare una piccola macchina virtuale con almeno 1024 MB di RAM e 8 GB di disco
{% endif %}
{% if arm %}
- Una fonte di alimentazione (che può essere un alimentatore o un semplice cavo MicroUSB) adatto alla scheda
- Una scheda microSD: almeno di 16 GB, di [classe "A1"](https://en.wikipedia.org/wiki/SD_card#Class) raccomandata (come [questa SanDisk A1 card](https://www.amazon.fr/SanDisk-microSDHC-Adaptateur-homologu%C3%A9e-Nouvelle/dp/B073JWXGNT/));
{% endif %}
{% if regular %}
- Una chiavetta USB almeno di 1 GB O un CD vergine
{% endif %}
{% if wsl %}
- Windows 10 o superiore
- Diritti di amministratore
- Windows Subsystem per Linux
- *Raccomandato:* Windows Terminal (Preview) app, installato dal Microsoft Store. Assolutamente migliore del terminale standard poiché offre scorciatoie per le distribuzioni WSL.
{% endif %}
{% if at_home %}
- Un [ISP ragionevole](/install/providers/isp/), preferibilmente con una banda in uscita buona senza limiti
{% if not virtualbox %}
- Un cavo ethernet (RJ-45) per collegare il vostro server al router.
{% endif %}
- Un computer per leggere questa guida, copiare l'immagine e accedere al vostro server.
{% else %}
- Un computer o uno smartphone per leggere questa guida e accedere al vostro server.
{% endif %}

{% if virtualbox %}
! N.B. : Installare YunoHost in una macchina virtuale VirtualBox normalmente è indicato solo per esigenze di test o sviluppo. Non è consigliabile far girare un server normale per lunghi periodi in questo modo perché probabilmente il computer ospite non funzionerà in modo continuo ed inoltre VirtualBox aggiunge un ulteriore livello di complessità nell'esposizione del server su Internet.
{% endif %}

{% if wsl %}

## Introduzione

WSL è un'interessante caratteristica di Windows 10 che rende disponibili alcune pseudo-distribuzioni Linux dalla linea di comando. Diciamo pseudo perché, pur non essendo vere macchine virtuali, si basano su capacità di virtualizzazione che rendono molto semplice l'integrazione con Windows.
Ad esempio Docker può usare WSL invece di Hyper-V.

! Tenete presente che questa configurazione *non* è un assolutamente un container: se qualcosa smette di funzionare non ci sono possibilità di usare dei rollback.
! Potrebbe essere necessario eliminare la distribuzione Debian e reinstallare tutto da capo.

## Installazione Debian 12

Installiamo YunoHost all'interno di una distribuzione dedicata senza alterare quella di default. In un terminale PowerShell:

```bash
# Let's go in your home directory and prepare the working directories
cd ~
mkdir -p WSL\YunoHost
# Download the Debian appx package and unzip it
curl.exe -L -o debian.zip https://aka.ms/wsl-debian-gnulinux
Expand-Archive .\debian.zip -DestinationPath .\debian
# Import the Debian base into a new distro
wsl --import YunoHost ~\WSL\YunoHost ~\debian\install.tar.gz --version 2
# Cleanup
rmdir .\debian -R
```

Adesso potete accedervi con il comando `wsl.exe -d YunoHost`

La versione è Debian 9 Stretch che può essere aggiornata:

```bash
# In WSL
sudo sed -i 's/stretch/bookworm/g' /etc/apt/sources.list`
sudo apt update
sudo apt upgrade
sudo apt dist-upgrade
```

## Evitare che WSL modifichi i file di configurazione

Editate `/etc/wsl.conf` con le seguenti configurazioni:

```text
[network]
generateHosts = false
generateResolvConf = false
```

## Forzare l'uso di iptables-legacy

Per varie ragioni YunoHost non usa `nf_tables`, il nuovo software che sostituisce `iptables`.
È comunque possibile usare il buon vecchio `iptables`:

```bash
# In WSL
sudo update-alternatives --set iptables /usr/sbin/iptables-legacy
sudo update-alternatives --set ip6tables /usr/sbin/ip6tables-legacy
```

## Installare systemd

Debian di WSL non usa `systemd`, un programma di configurazione di servizi.
Questo è un elemento chiave per YunHost nonché per qualsiasi distribuzione Debian ragionevole (veramente MS, che combini). Installiamolo:

1. Installazione di dotNET runtime:

    ```bash
    # In WSL
    wget https://packages.microsoft.com/config/debian/12/packages-microsoft-prod.deb -O packages-microsoft-prod.deb
    sudo dpkg -i packages-microsoft-prod.deb
    sudo apt update
    sudo apt install -y apt-transport-https
    sudo apt update
    sudo apt install -y dotnet-sdk-3.1
    ```

2. Installazione di [Genie](https://github.com/arkane-systems/genie):

    ```bash
    # In WSL
    # Add their repository
    echo "deb [trusted=yes] https://wsl-translinux.arkane-systems.net/apt/ /" > /etc/apt/sources.list.d/wsl-translinux.list
    # Install Genie
    sudo apt update
    sudo apt install -y systemd-genie
    ```

## Installazione di YunoHost

```bash
# In WSL
# Let's switch to the root user, if you were not already
sudo su
# Initialize the Genie bottle to have systemd running
genie -s
# Your hostname should have been appended with "-wsl"
# Install YunoHost
curl https://install.yunohost.org | bash -s -- -a
```

### Accesso alla linea di comando

Avviate sempre il comando `genie -s` mentre avviate la vostra distribuzione.

`wsl -d YunoHost -e genie -s`

## Backup e ripristino della distribuzione

### Create il vostro primo backup della distribuzione

Come detto sopra, non c'è la possibilità di usare dei rollback. Onde per cui è necessario esportare la vostra distribuzione appena installata. Comandi PowerShell:

```bash
cd ~
wsl --export YunoHost .\WSL\YunoHost.tar.gz
```

### In caso di crash cancellate e ripristinate la distribuzione intera

```bash
cd ~
wsl --unregister YunoHost
wsl --import YunoHost .\WSL\YunoHost .\WSL\YunoHost.tar.gz --version 2
```

{% endif %}

{% if vps_ynh %}

## Provider VPS con immagini per YunHost

Questi sono alcuni provider di VPS che supportano nativamente YunHost:

[div class="flex-container"]

[div class="flex-child"]
[[figure caption="Alsace Réseau Neutre - FR"]![](/img/vps_ynh_arn.png?height=50)[/figure]](https://arn-fai.net/en/h%C3%A9bergement-alternatif/vps)
[/div]
[div class="flex-child"]
[[figure caption="FAImaison - FR"]![](/img/vps_ynh_faimaison.svg?height=50)[/figure]](https://www.faimaison.net/services/vm.html)
[/div]
[div class="flex-child"]
[[figure caption="ECOWAN - FR"]![](/img/vps_ynh_ecowan.png?height=50)[/figure]](https://www.ecowan.fr/vps-linux?from-yunohost)
[/div]
[/div]
{% endif %}

{% if at_home %}

## [fa=download /] Scaricate l'immagine {{image_type}}

{% if virtualbox or regular %}
!!! Se il vostro computer è a 32 bit assicuratevi di scaricare l'immagine a 32 bit.
{% elseif arm_unsup %}
<a href="https://www.armbian.com/download/" target="_BLANK" type="button" class="btn btn-info col-sm-12" style="background: none;">[fa=external-link] Scaricate l'immagine per la vostra sceda da sito di Armbian</a>

!!! N.B.: dovete scaricare la versione Bookworm di Armbian.
{% endif %}

!!! Se volete controllare la validità delle nostre immagini firmate potete [scaricare la nostra chiave pubblica](https://forge.yunohost.org/keys/yunohost_bookworm.asc).

{% if internetcube or arm_sup %}
! Le immagini attuali sono basate su Debian Buster (YunoHost v4.x) e così dovrete usare il comando da linea di comando apt update in una connessione SSH o direttamente dal terminale per continuare l'aggiornamento.
! Rispondete Yes nella richiesta di cambio da stable a oldstable.
{% endif %}

<div class="hardware-image">
<div id="cards-list">
</div>
</div>
<template id="image-template">
<div id="{id}" class="card panel panel-default">
        <div class="panel-body text-center pt-2">
            <h3>{name}</h3>
            <div class="card-comment">{comment}</div>
            <div class="card-desc text-center">
<img src="/user/images/{image}" height=100 style="vertical-align:middle">
            </div>
        </div>
        <div class="annotations flex-container">
            <div class="flex-child annotation"><a href="{file}.sha256sum">[fa=barcode] Checksum</a></div>
            <div class="flex-child annotation"><a href="{file}.sig">[fa=tag] Signature</a></div>
        </div>
        <div class="btn-group" role="group">
            <a href="{file}" target="_BLANK" type="button" class="btn btn-info col-sm-12">[fa=download] Download <small>{version}</small></a>
        </div>
</div>
</template>
<script>
var hardware = "{{ hardware|escape('js') }}";
/*
###############################################################################
  Script that loads the infos from JavaScript and creates the corresponding
  cards
###############################################################################
*/
$(document).ready(function () {
    console.log("in load");
    $.getJSON('https://repo.yunohost.org/images/images.json', function (images) {
        $.each(images, function(k, infos) {
            if (infos.hide == true) { return; }
            if (infos.tuto.indexOf(hardware) == -1) return;
            // Fill the template
            html = $('#image-template').html()
             .replace('{id}', infos.id)
             .replace('{name}', infos.name)
             .replace('{comment}', infos.comment || "&nbsp;")
             .replace('%7Bimage%7D', infos.image)
             .replace('{image}', infos.image)
             .replace('{version}', infos.version);
            if (!infos.file.startsWith("http"))
                infos.file="https://repo.yunohost.org/images/"+infos.file;
            html = html.replace(/%7Bfile%7D/g, infos.file).replace(/{file}/g, infos.file);
            if ((typeof(infos.has_sig_and_sums) !== 'undefined') && infos.has_sig_and_sums == false)
            {
                var $html = $(html);
                $html.find(".annotations").html("&nbsp;");
                html = $html[0];
            }
            $('#cards-list').append(html);
        });
    });
});
</script>

{% if not virtualbox %}

{% if arm %}

## ![card microSD con l'adattatore](/img/sdcard_with_adapter.png?resize=100,75&class=inline) Flashate l'immagine {{image_type}}

{% else %}

## ![drive USB](/img/usb_key.png?resize=100,100&class=inline) Flashate l'immagine YunoHost

{% endif %}

L'immagine {{image_type}} che avete appena scaricato la potete flashare su {% if arm %}una scheda microSD {% else %}una chiavetta USB stick o su un CD/DVD.{% endif %}

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="(Raccomandato) Usando Etcher"]

Scaricate <a href="https://www.balena.io/etcher/" target="_blank">Etcher</a> per il vostro sistema operativo e installatelo.

Inserite {% if arm %}la scheda SD{% else %}chiavetta USB{% endif %}, selezionate la vostra immagine e cliccate su "Flash!"

![Etcher](/img/etcher.gif?resize=700&class=inline)

[/ui-tab]
[ui-tab title="Usando USBimager"]

Scaricate [USBimager](https://bztsrc.gitlab.io/usbimager/) per il vostro sistema operativo e installatelo.

Inserite {% if arm %}la scheda SD{% else %}chiavetta USB{% endif %}, selezionate la vostra immagine e cliccate su "Write"

![USBimager](/img/usbimager.png?resize=700&class=inline)

[/ui-tab]
[ui-tab title="With dd"]

Se usate GNU/Linux / macOS e avete familiarità con la linea di comando potete flashare la vostra chiave USB o la scheda SD con `dd`. Potete identificare il device corrispondente la chiavetta USB o alla scheda SD con il comando `fdisk -l` oppure `lsblk`. Normalmente il device di una scheda SD è del tipo `/dev/mmcblk0`. PONETE ATTENZIONE ad usare il nome giusto.

Poi date il comando:

```bash
# Replace /dev/mmcblk0 if the name of your device is different...
dd if=/path/to/yunohost.img of=/dev/mmcblk0
```

[/ui-tab]
{% if regular %}
[ui-tab title="Masterizzare un CD/DVD"]
Per computer più vecchi si può masterizzare un CD/DVD. Il programma da usare dipende dal vostro sistema operativo.

- su Windows potete usare [ImgBurn](http://www.imgburn.com/)  per masterizzare l'immagine sul disco

- su macOS potete usare [Disk Utility](http://support.apple.com/kb/ph7025)

- su GNU/Linux ci sono molte possibilità come [Brasero](https://wiki.gnome.org/Apps/Brasero) o [K3b](http://www.k3b.org/)
[/ui-tab]
[ui-tab title="Usare Ventoy"]
Ventoy può risultare utile nel caso in cui non riusciate ad avviare l'immagine di YunoHost con altri metodi.

[Ventoy](https://www.ventoy.net/) è un ottimo strumento che rende molto facile copiare diverse immagini linux su una chiavetta USB. Quando il computer non riesce ad avviarsi da un'immagine su una chiavetta USB, Ventoy riesce comunque ad avviarle.

1. Installate [Ventoy](https://www.ventoy.net/) sulla chiavetta USB facendo riferimento alle [instruzioni per l'installazione](https://www.ventoy.net/en/doc_start.html).
     - Verranno create due partizioni sulla chiavetta.
2. Con il vostro file manager preferito copiate l'immagine YunoHost sulla partizione più grande `Ventoy` (non "VTOYEFI")
     - Non usate °Balena Etcher, USBImager o `dd` per fare la copia!

Quando avvierete il computer dalla chiavetta USB apparirà Ventoy con ò'elenco delle immagini che avete copiato sulla chiavetta; selezionate l'immagine di YunoHost e poi selezionate l'opzione di avvio GRUB2 (oppure qualsiasi opzione che funzioni 😉)
[/ui-tab]
{% endif %}
[/ui-tabs]

{% else %}

## Creare una nuova macchina virtuale

![](/img/virtualbox_1.png?class=inline)

! Va bene anche usare una versione a 32 bit, basta essere sicuri di aver scaricato l'immagine a 32 bit relativa.

## Modifica delle impostazioni di rete

! Questo passo è importante per esporre correttamente la macchina virtuale sulla rete

Selezionate **Settings** > **Network**:

- Selezionate `Bridged adapter`
- Selezionate il nome dell'interfaccia di rete:
   **wlan0** se siete connessi con il wifi altrimenti **eth0**.

![](/img/virtualbox_2.png?class=inline)

{% endif %}

{% if arm %}

## [fa=plug /] Accendete la scheda

- Inserite il cavo ethernet (un capo al vostro router principale e l'altro capo alla scheda).
  - Per utenti esperti che volessero configurare la scheda per connettersi al WiFi provate a guardare ad esempio [qui](https://www.raspberrypi.com/documentation/computers/configuration.html#connect-to-a-wireless-network) ([o qui per versioni precedenti a YunoHost12/bookworm](https://www.raspberryme.com/configurer-le-wifi-sur-un-pi-manuellement-a-laide-de-wpa_supplicant-conf/).
- Inserite la schedina SD nella scheda
- (Opzionale) Potete connettere tastiera e schermo direttamente alla scheda se volete controllare il processo di boot oppure se preferite "vedere quel che accade" o se volete un accesso diretto alla scheda stessa.
- Avviate la scheda
- Attendete un paio di minuti mentre la scheda di autoconfigura durante il primo avvio
- Assicuratevi che il vostro computer (desktop/portatile) sia connesso alla stessa rete locale (ad esempio al router internet) del server.

{% elseif virtualbox %}

## [fa=plug /] Avviate la macchina virtuale

Avviate la macchina virtuale dopo aver selezionato l'immagine di YunoHost.

![](/img/virtualbox_2.1.png?class=inline)

! Se appare l'errore "VT-x is not available", probabilmente dovete abilitare le opzioni di virtualizzazione nel BIOS del vostro computer.

{% else %}

## [fa=plug /] Avviate il computer dalla chiavetta USB

- Inserite il cavo ethernet (un capo al vostro router principale e l'altro capo alla scheda).
- Avviate il vostro server con la chiavetta USB o il CD-ROM inseriti e selezionateli come **device di boot**. A seconda dell'hardware potreste dover premere uno dei seguenti tasti:
`<F9>`, `<F10>`, `<F11>`, `<F12>`, `<DEL>`, `<ESC>` or `<Alt>`.
  - N.B.: se il server aveva come sistema operativo versioni recenti di Windows (maggiori della 8) è necessario comandare Windows perché faccia "realmente il reboot". Questo può essere selezionato in qualche "opzione di Avvio Avanzato".
  
!! Se non riuscite ad avviare l'immagine di YunoHost provate ad usare Ventoy (selezionate "Ventoy" nella sezione precedente "Flashate l'immagine YunoHost").
{% endif %}

{% if regular or virtualbox %}

## [fa=rocket /] Avviate l'installazione grafica

Dovreste vedere una schermata come la seguente:

[figure class="nomargin" caption="Anteprima del manù ISO"]
![](/img/virtualbox_3.png?class=inline)
[/figure]
[ui-tabs position="top-left" active="0" theme="lite"]

[ui-tab title="Installazione classica du un disco intero"]

!! N.B.: una volta confermato il layout della tastiera l'installazione verrà avviata cancellando completamente i dati sul disco!

  1. Seleziona 'Graphical install'
  2. Selezionate la vostra lingua, posizione, la disposizione della tastiera ed eventualmente il vostro fuso orario.
  3. L'installatore scaricherà ed installerà così tutti i pacchetti necessari.
  
[/ui-tab]
[ui-tab title="Installazione in modalità esperto"]

Il progetto YunHost ha semplificato per quanto possibile la classica installazione in modo da evitare per più persone possibili l'eventualità che si perdano dietro a domande troppo tecniche o legate a casi troppo specifici.

Con la modalità esperto sono possibili maggiori opzioni in special modo relative all'esatto partizionamento del vostro media di storage. È possibile anche usare il modo classico e [aggiungere i dischi in seguito](/administer/tutorials/external_storage).

### Elenco dei passi della modalità esperto

  1. Selezionate `Installazione modalità esperto`.
  2. Selezionate la vostra lingua, posizione, la disposizione della tastiera ed eventualmente il vostro fuso orario.
  3. Create le partizioni nei vostri dischi. In questo passo è possibile creare il RAID o cifrare tutto o parte dei dischi del server.
  4. Configurate un eventuale proxy HTTP da usare per installare i pacchetti
  5. Indicate su quale volume deve essere installato grub
  
### A proposito delle partizioni

In generale noi sconsigliamo l'uso di partizioni separate per `/var`, `/opt`, `/usr`, `/bin`, `/etc`, `/lib`, `/tmp` e `/root` perché così non dovrete preoccuparvi del riempimento delle partizioni stesse che può portare al blocco del sistema, oppure all'impossibilità di installare applicazioni oppure anche a corruzioni del database.

Per ragioni di performance è raccomandato l'uso del vostro disco più veloce (SSD) sulla root `/`.

Se avete uno o più dischi per salvare i dati potete scegliere di montarli nelle seguenti directory a seconda dell'uso che ne volete fare.

| Path | Contenuti |
|--------|---|
| `/home` | Cartelle degli utenti accessibili via SFTP |
| `/home/yunohost.backup/archives` | Backup di YunoHost da tenere idealmente in dischi diversi da quelli dedicati ai dati |
| `/home/yunohost.app` | Dati puri delle applicazioni di YunoHost (nextcloud, matrix...) |
| `/home/yunohost.multimedia` | Dati puri condivisi fra diverse applicazioni |
| `/var/mail` | Posta elettronica degli utenti |

Se volete godere di una maggiore flessibilità senza dover cambiare dimensione alle partizioni potete decidere di montarli su `/mnt/hdd` e seguire questo [tutorial per montare tutte queste cartelle con `mount --bind`](/administer/tutorials/external_storage).

### A proposito della cifratura

Ponete attenzione al fatto che se cifrate parti o tutto il vostro disco dovrete inserire la passphrase ogni volta che il server verrà riavviato, cosa che potrebbe creare problemi nel caso in cui non siate presenti. Ci sono delle soluzioni (anche piuttosto difficili da realizzare) che permettono l'inserimento della passphrase via SSH o una pagina web (cercate "dropbear encrypted disk").

### A proposito del RAID

Tenete presente che:

- i dischi del vostro RAID dovrebbero essere di diverse marche, tempo di uso o acquisto (in special modo se sono SSD)
- un RAID di tipo 1 (anche senza uno spare) è più affidabile di un RAID di tipo 5 da un punto di vista di probabilità
- i RAID hardware dipendono dalle schede raid e se queste si guastano è necessario avere un ricambio per leggere e ricostruire il raid

[/ui-tab]
[/ui-tabs]

!!! Se l'installer di YunoHost fallisce e non siete in grado di risolvere il problema è possibile anche installare Debian e poi successivamente YunoHost. Per le istruzioni, in alto in questa pagina selezionate "Server remoto e poi "virtual private server o server dedicato con Debian".
{% endif %}

{% if arm_unsup %}

## [fa=terminal /] Connessione alla scheda

Poi dovete [trovare l'indirizzo IP locale del vostro server](/install/post_install/finding_the_local_ip) per potersi collegare come utente root [via SSH](/administer/admin_guide/command_line) con la password temporanea `1234`.

```bash
ssh root@192.168.x.xxx
```

{% endif %}

{% endif %}

{% if vps_debian or arm_unsup %}

## [fa=rocket /] Avviate lo script di installazione

- Avviate la linea di comando sul vostro server (sia direttamente o [via ssh](/administer/admin_guide/command_line))
- Assicuratevi di essere root (in caso contrario con il comando `sudo -i` potete diventarlo)
- Date il seguente comando:

```bash
curl https://install.yunohost.org | bash
```

!!! Se `curl` non è installato sul vostro sistema potete installarlo con `apt install curl`.
!!! Se invece il comando indicato sopra non desse alcun risultato potreste fare `apt install ca-certificates`

!!! **Nota per gli utenti avanzati preoccupati per l'approccio `curl|bash**: provate a leggere ["Is curl|bash insecure?"](https://sandstorm.io/news/2015-09-24-is-curl-bash-insecure-pgp-verified-install) sul blog di Sandstom, e anche [this discussion on Hacker News](https://news.ycombinator.com/item?id=12766350&noprocess).

{% endif %}

## [fa=cog /] Proseguite con la configurazione iniziale

!!! Se state recuperando un server da un backup YunoHost non dovete seguire questo passaggio e invece [recuperare un backup invece del passo del postinstall](/backup#restoring-during-the-postinstall).

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="From the web interface"]
{%if at_home %}
In an internet browser, type **{% if internetcube %}`https://internetcube.local`{% else %}`https://yunohost.local` (or `yunohost-2.local`, and so on if multiple YunoHost servers are on your network){% endif %}**.

!!! Se non dovesse funzionare potete [cercare il vostro indirizzo IP locale del vostro server](/install/post_install/finding_the_local_ip). L'indirizzo normalmente è del tipo `192.168.x.y` e quindi dovrete scrivere `https://192.168.x.y` nella barra degli indirizzi del vostro browser.
{% else %}
È possibile eseguire la configurazione iniziale dall'interfaccia web digitando nella barra degli indirizzi del vostro browser **l'indirizzo IP locale del vostro server**. Normalmente il provider della vostra VPS vi dovrebbe aver comunicato l'indirizzo IP del server.
{% endif %}

! Al momento della prima visita molto probabilmente troverete un allarme di sicurezza relativo al certificato usato dal server. Per adesso il vostro server sta usando un certificato auto-firmato. {% if not wsl %}Potrete installare successivamente un certificato automaticamente riconosciuto dai browser web come descritto nella [documentazione sul certificato](/administer/admin_guide/domains/certificate). {% endif %} Per adesso potete aggiungere un'eccezione di sicurezza per accettare il certificato corrente. (Però, PER FAVORE, non prendete l'abitudine di accettare ciecamente questo tipo di allarme di sicurezza!)

{% if not internetcube %}
Dovreste arrivare su questa pagina :

[figure class="nomargin" caption="Anteprima della pagina Web della configurazione iniziale"]
![Pagina della configurazione iniziale](/img/postinstall_web.png?resize=100%&class=inline)
[/figure]

{% endif %}
[/ui-tab]
[ui-tab title="Dalla riga di comando"]

Potete eseguire la post-installazione con il comando `yunohost tools postinstall` direttamente sul vostro server, o [via SSH](/administer/admin_guide/command_line).

[figure class="nomargin" caption="Anteprima della riga di comando della post-installazione"]
![Configurazione iniziale con la CLI](/img/postinstall_cli.png?resize=100%&class=inline)
[/figure]

[/ui-tab]
[/ui-tabs]

{% if not internetcube %}

### [fa=globe /] Dominio principale

Questo sarà il dominio usato dagli utenti del server per accedere al **portale di autenticazione**. Potrete aggiungere poi altri domini e scegliere quale è il principale se necessario.

{% if not wsl %}

- Se siete alle prime esperienze del self-hosting e non avete già un nome a dominio noi raccomandiamo l'uso di **.nohost.me** / **.noho.st** / **.ynh.fr** (come ad esempio `homersimpson.nohost.me`). Ammesso che non sia stato già assegnato, il dominio verrà configurato automaticamente e non dovrete compiere nessun altro passo di configurazione. Considerate che di contro non avrete il pieno controllo sulla configurazione del DNS.

- Se avete già un nome a dominio lo potete usare probabilmente qui. Dovrete poi configurare i record DNS come spiegato [qui](/install/post_install/dns_config).

!!! Sì, *è necessario* configurare un nome a dominio. Se non avete un nome a dominio e non volete neanche un dominio **.nohost.me** / **.noho.st** / **.ynh.fr** potete configurare un dominio fasullo come ad esempio `yolo.test` e modificare il vostro file **locale** `/etc/hosts` di modo chequesto dominio fasullo [punti all'IP appropriato come spiegato qui](/administer/tutorials/domains/dns_local_network).

{% else %}

Dovrete scegliere un dominio falso poiché non sarà accessibile dall'esterno come ad esempio `ynh.wsl`.
Il trucco sta nel notificare questo dominio al vostro host.

Modificate il file `C:\Windows\System32\drivers\etc\hosts`. Dovreste avere una linea che inizia con `::1`, aggiornatela o aggiungetela se necessario per avere:

```text
::1    ynh.wsl localhost
```

Se volete creare dei sottodomini non dimenticate di aggiungerli anche nel file `hosts`:

```text
::1    ynh.wsl subdomain.ynh.wsl localhost
```

{% endif %}

### [fa=key /] Primo utente

Il primo utente viene creato a questo passo. Dovreste scegliere un nome utente e una password ragionevolmente complessa. (Non ci stancheremo mai di raccomandare che la password deve essere **robusta**!). Questo utente verrà aggiunto al gruppo Admins e quindi potrà accedere al portale utente, alla pagina web di amministrazione e connettersi [via **SSH**](/administer/admin_guide/command_line) o [**SFTP**](/administer/tutorials/filezilla). Gli utenti del gruppo Admins riceveranno inoltre le email inviate a `root@yourdomain.tld` e `admin@yourdomain.tld`: questi messaggi potrebbero essere usate per mandare informazioni tecniche o allarmi. È possibile aggiungere successivamente ulteriori utenti che possono essere aggiunti al gruppo Admins.

Questo utente rimpiazza il precedente utente `admin` al quale potrebbero far riferimento alcune vecchie pagina della documentazione. Nel caso è sufficiente sostituire `admin` con il vostro nome utente.

## [fa=stethoscope /] Avviate la diagnosi iniziale

Una volta che il passo del postinstall è concluso dovreste essere in grado di fare login alla pagina web di amministrazione usando le credenziali del primo utente che avete appena creato.

{% if wsl %}
! Avvertenza: YunoHost su WSL potrebbe non essere raggiungibile dall'esterno e quindi non potranno essere assegnati nomi a dominio reali e certificati.
{% endif %}
{% if virtualbox %}
! Avvertenza: YunoHost su VirtualBox potrebbe non essere raggiungibile dall'esterno senza ulteriori configurazioni sulla rete nelle impostazioni di VirtualBox. La diagnosi dovrebbe segnalarlo eventualmente.
{% endif %}

Il sistema di diagnosi è pensato per offrire un modo semplice per verificare che tutti gli aspetti critici del vostro server sono correttamente impostati - e guidarvi nel risolvere in problemi. Il sistema di diagnosi si avvierà due volte al giorni e invierà un allarme se verranno individuati dei problemi.

!!! N.B.: **non scappate**! La prima volta che avvierete il sistema di diagnosi vedrete quasi sicuramente molti allarmi gialli e rossi perché normalmente dovete [configurare i record DNS](/install/post_install/dns_config) (a meno che non usiate dei domini `.nohost.me`/`noho.st`/`ynh.fr`), aggiungere un file di swap se non avete sufficiente ram {% if at_home %} e/o [configurare il port forwarding](/install/post_install/isp_box_config){% endif %}.

!!! Se un allarme non è per voi preoccupante (perché per esempio non intendete usare un particolare feature) è assolutamente corretto marcare il problema come `ignora` nella pagina di amministrazione web > Diagnosi cliccando sul bottone ignora del problema in questione.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="(Raccomandato) Dall'interfaccia web"]
Per avviare una diagnosi collegatevi alla pagina web di amministrazione nella sezione Diagnosi. Cliccate su Avvia diagnosi iniziale e dovreste ottenre una schermata simile a questa:

[figure class="nomargin" caption="Anteprima di una pagina diagnostica"]
![](/img/diagnostic.png?resize=100%&class=inline)
[/figure]

[/ui-tab]
[ui-tab title="Dalla riga di comando"]

```bash
yunohost diagnosis run
yunohost diagnosis show --issues --human-readable
```

[/ui-tab]
[/ui-tabs]

## [fa=lock /] Ottenere un certificato Let's Encrypt

Una volta configurati i record DNS ed eventualmente il port forwarding dovreste essere in grado di installare un certificato Let's Encrypt. In questo modo dovrebbero scomparire gli allarmi di sicurezza visti sopra per i nuovi visitatori.

Per maggiori informazioni o per conoscere meglio i certificati SSL/TLS vedi [questa pagina](/administer/admin_guide/domains/certificate).

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Dall'interfaccia web"]

Andate su Domini > cliccate sul vostro dominio > Certificate

[figure class="nomargin" caption="Anteprima di una pagina diagnostica"]
![](/img/certificate-before-LE.png?resize=100%&class=inline)
[/figure]

[/ui-tab]
[ui-tab title="Dalla riga di comando"]

```bash
yunohost domain cert install
```

[/ui-tab]
[/ui-tabs]

## ![](/img/tada.png?resize=32&classes=inline) Congratulazioni

Adesso avete un server ben configurato. Se siete alle prime esperienze di YunoHost è consigliabile guardare [il tour guidato](/overview). Dovreste essere in grado di [installare le vostre applicazioni preferite](https://apps.yunohost.org). Non dimenticate di [programmare i backup](/backup)!

{% endif %}
{% endif %}
