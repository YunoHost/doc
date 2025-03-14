---
title: YunoHost Installieren
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

Wähle die Hardware, auf der du YunoHost installieren willst :
[div class="flex-container"]

[div class="flex-child hardware{%if virtualbox %} active{% endif %}"]
[[figure caption="VirtualBox"]![](image://virtualbox.png?height=75)[/figure]](/install/hardware:virtualbox)
[/div]

[div class="flex-child hardware{%if rpi012 or rpi345 %} active{% endif %}"]
[[figure caption="Raspberry Pi"]![](image://raspberrypi.png?height=75)[/figure]](/install/hardware:rpi345)
[/div]

[div class="flex-child hardware{%if arm_sup or (arm_unsup and not rpi012) or internetcube %} active{% endif %}"]
[[figure caption="ARM Board"]![](image://olinuxino.png?height=75)[/figure]](/install/hardware:arm)
[/div]

[div class="flex-child hardware{%if regular %} active{% endif %}"]
[[figure caption="Normaler Computer"]![](image://computer.png?height=75)[/figure]](/install/hardware:regular)
[/div]

[div class="flex-child hardware{%if wsl %} active{% endif %}"]
[[figure caption="WSL"]![](image://wsl.png?height=75)[/figure]](/install/hardware:wsl)
[/div]

[div class="flex-child hardware{%if vps_debian or vps_ynh %} active{% endif %}"]
[[figure caption="Remote Server"]![](image://vps.png?height=75)[/figure]](/install/hardware:vps_debian)
[/div]

[/div]
[div class="flex-container pt-2"]

{% if rpi012 or rpi345 %}
[div class="flex-child hardware{%if rpi345 %} active{% endif %}"]
[[figure caption="Raspberry Pi 3, 4 oder 5"]![](image://raspberrypi.png?height=50)[/figure]](/install/hardware:rpi345)
[/div]

[div class="flex-child hardware{%if rpi012 %} active{% endif %}"]
[[figure caption="Raspberry Pi 0, 1 oder 2"]![](image://rpi1.png?height=50)[/figure]](/install/hardware:rpi012)
[/div]

{% elseif show_legacy_arm_menu %}

[div class="flex-child hardware{%if internetcube %} active{% endif %}"]
[[figure caption="Internet cube mit VPN"]![](image://internetcube.png?height=50)[/figure]](/install/hardware:internetcube)
[/div]

[div class="flex-child hardware{%if arm_sup and not internetcube %} active{% endif %}"]
[[figure caption="Olinuxino lime1&2 oder Orange Pi PC+"]![](image://olinuxino.png?height=50)[/figure]](/install/hardware:arm_sup)
[/div]

[div class="flex-child hardware{%if arm_unsup %} active{% endif %}"]
[[figure caption="Andere Boards"]![](image://odroidhc4.png?height=50)[/figure]](/install/hardware:arm_unsup)
[/div]
{% elseif vps_debian or vps_ynh %}

[div class="flex-child hardware{%if vps_debian %} active{% endif %}"]
[[figure caption="VPS oder dedizierter Server mit Debian 12"]![](image://debian-logo.png?height=50)[/figure]](/install/hardware:vps_debian)
[/div]

[div class="flex-child hardware{%if vps_ynh %} active{% endif %}"]
[[figure caption="VPS oder dedizierter Server mit YunoHost vorinstalliert"]![](image://logo.png?height=50)[/figure]](/install/hardware:vps_ynh)
[/div]

{% endif %}

[/div]

{% if rpi012 %}
!! Die Unterstützung für Raspberry Pi 0, 1 und 2 wurde leider seit Debian 12 Bookworm eingestellt. Wir empfehlen Ihnen, auf ein moderneres Raspberry Pi-Modell umzusteigen, das von Bookworm unterstützt wird.
{% endif %}

{% if hardware != '' %}

{% if wsl %}
!! Dieses Setup ist vorwiegend für lokales Testing durch fortgeschrittene Benutzer gedacht. Aufgrund Limitierungen auf WSL Seite (insbesondere veränderliche IP Adresse), selfhosting kann damit knifflig sein und wird hier nicht weiter beschrieben.
{% endif %}

## [fa=list-alt /] Pre-requisites

{% if regular %}

- Eine x86-kompatible für YunoHost bestimmte (dedizierte) Hardware: Laptop, Nettop, Netbook, Desktop mit 512MB RAM und 16GB Speicherkapazität (Minimum)
{% elseif rpi345 %}
- Ein Raspberry Pi 3, 4 oder 5
{% elseif internetcube %}
- Ein Orange Pi PC+ oder ein Olinuxino Lime 1 oder 2
- Ein VPN mit einer festen öffentlichen IP Adresse und einer `.cube` Datei
{% elseif arm_sup %}
- Ein Orange Pi PC+ oder ein Olinuxino Lime 1 oder 2
{% elseif arm_unsup %}
- Ein ARM Board mit mindestens 512MB RAM
{% elseif vps_debian %}
- Ein dedizierter oder Virtual Private Server mit Debian 12 (Bookworm) <small>(mit **kernel >= 6.1**)</small> vorinstalliert, 512MB RAM und 16GB Speicherkapazität (Minimum)
{% elseif vps_ynh %}
- Ein dedizierter oder Virtual Private Server mit YunoHost vorinstalliert, 512MB RAM und 16GB Speicherkapazität (Minimum)
{% elseif virtualbox %}
- Ein x86 Computer mit [VirtualBox installiert](https://www.virtualbox.org/wiki/Downloads) und ausreichend Arbeitsspeicherkapazität (RAM), um eine kleine virtuelle Maschine mit 1024MB RAM und 8GB Speicherkapazität (Minimum) betreiben zu können
{% endif %}
{% if arm %}
- Eine Spannungsversorung (entweder ein Netzteil oder ein MicroUSB Kabel) für dein Board;
- Eine microSD Karte: 16GB Speicherkapazität (Minimum), [class "A1"](https://en.wikipedia.org/wiki/SD_card#Class) nachdrücklich empfohlen (so wie [diese SanDisk A1 Karte](https://www.amazon.fr/SanDisk-microSDHC-Adaptateur-homologu%C3%A9e-Nouvelle/dp/B073JWXGNT/));
{% endif %}
{% if regular %}
- Ein USB Stick mit mindestens 1GB Speicherkapazität ODER einem Standard CD-Rohling
{% endif %}
{% if wsl %}
- Windows 10 und neuer
- Administrator Rechte
- Windows Subsystem for Linux, aus dem Optional Features Menü von Windows installiert
- *Empfohlen:* Windows Command Prompt App, aus dem Microsoft Store installiert. Viel besser als der Standard Terminal, weil sie Shortcuts für WSL distros bietet.
{% endif %}
{% if at_home %}
- Ein [vernünftiger ISP](/isp), vorzugsweise mit einer guten und unbegrenzten Upstream Bandbreite
{% if not virtualbox %}
- Ein Ethernet Kabel (RJ-45), um deinen Server mit deinem Router zu verbinden.
{% endif %}
- Ein Computer, um diese Anleitung zu lesen, das Image zu flashen und auf deinen Server zuzugreifen.
{% else %}
- Ein Computer oder ein Smartphone, um diese Anleitung zu lesen und auf deinen Server zuzugreifen.
{% endif %}

{% if virtualbox %}
! Anmerkung : YunoHost in einer VirtualBox zu installieren ist normalerweise nur zu Test- oder Entwicklungszwecken gedacht . Es ist nicht dafür geeignet einen wirklichen Server langfristig zu betreiben, weil die Machine auf der es installiert ist wahrscheinlich nicht 24/7 laufen wird und weil VirtualBox eine zusätzliche Komplexitätsschicht beim Freigeben der Maschine zum Internet mitbringt.
{% endif %}

{% if wsl %}

## Vorstellung

WSL ist ein cooles Windows 10 Feature, das Linux pseudo-Distributionen durch die Kommandozeile verfügbar macht. Lass es uns pseudo nennen, weil auch obwohl sie nicht wirklich wie virtuelle Maschinen sind, sind sie auf Virtualisierungskapazitäten angewiesen, die deren Integration mit Windows fast nahtlos machen.
So kann z.B. Docker für Windows jetzt auf WSL bauen, anstatt auf Hyper-V.

! Beachte, dass dieses Setup selbst *kein* Container jeglicher Art ist. Falls etwas bricht, gibt es keine Rollback Möglichkeit.
! Vielleicht musst du die Debian Distro vollkommen löschen und ganz wiederherstellen.

## Installation in Debian 12

Lass uns YunoHost in einem PowerShell Terminal in seine eigene Distro installieren und nicht die default Distro verändern:

```bash
# Geh in dein home Verzeichnis und bereite die Arbeitsverzeichnisse vor
cd ~
mkdir -p WSL\YunoHost
# Lade das Debian appx Paket herunter und entpacke es (unzip)
curl.exe -L -o debian.zip https://aka.ms/wsl-debian-gnulinux
Expand-Archive .\debian.zip -DestinationPath .\debian
# Importiere Debian als Grundlage in eine neue Distro
wsl --import YunoHost ~\WSL\YunoHost ~\debian\install.tar.gz --version 2
# Aufräumen
rmdir .\debian -R
```

Nun kannst du darauf zugreifen: Führe `wsl.exe -d YunoHost` aus.

Da es Debian 9 Stretch ist, lass uns ein Upgrade auf Debian 12 Bookworm machen:

```bash
# In WSL
sudo sed -i 's/stretch/bookworm/g' /etc/apt/sources.list`
sudo apt update
sudo apt upgrade
sudo apt dist-upgrade
```

## Verhindern, dass WSL an Konfigurationsdateien herumfeilt

Bearbeite `/etc/wsl.conf` und füge den folgenden Code darin ein:

```text
[network]
generateHosts = false
generateResolvConf = false
```

## Erzwinge die Verwendung von iptables-legacy

Irgendwie mag die YunoHost Post-Installation `nf_tables` nicht, die neue Software ersetzt `iptables`.
Wir können trotzdem immer noch explizit die guten alten `iptables` benutzen:

```bash
# In WSL
sudo update-alternatives --set iptables /usr/sbin/iptables-legacy
sudo update-alternatives --set ip6tables /usr/sbin/ip6tables-legacy
```

## Systemd installieren

Unter WSL fehlt Debian `systemd`, eine Service-Konfigurations-Software.
Diese ist ein Schlüsselelement für YunoHost, und für jede anständige Debian Distro (also ernsthaft Microsoft, was zum Henker). Lass es uns installieren:

1. Installation der dotNET Runtime:

    ```bash
    # In WSL
    wget https://packages.microsoft.com/config/debian/12/packages-microsoft-prod.deb -O packages-microsoft-prod.deb
    sudo dpkg -i packages-microsoft-prod.deb
    sudo apt update
    sudo apt install -y apt-transport-https
    sudo apt update
    sudo apt install -y dotnet-sdk-3.1
    ```

2. Installation von [Genie](https://github.com/arkane-systems/genie):

    ```bash
    # In WSL
    # Das repository hinzufügen
    echo "deb [trusted=yes] https://wsl-translinux.arkane-systems.net/apt/ /" > /etc/apt/sources.list.d/wsl-translinux.list
    # Genie installieren
    sudo apt update
    sudo apt install -y systemd-genie
    ```

## YunoHost Installation

```bash
# In WSL
# zum root user wechseln, wenn you das nicht schon bist
sudo su
# Die Genie Flasche initialisiern, um systemd am Laufen zu haben 
genie -s
# Dein hostname sollte mit "-wsl" enden
# Installiere YunoHost
curl https://install.yunohost.org | bash -s -- -a
```

### Öffne die Kommandozeile

Rufe `genie -s` immer während des Startes deiner Distro auf.

`wsl -d YunoHost -e genie -s`

## Backup und Wiederherstellung der Distro

### Mache dein erstes Distro Backup

Wie zuvor gesagt, gibt es keine Rollback Möglichkeit. Lass uns deshal deine frische Distro exportieren. In PowerShell:

```bash
cd ~
wsl --export YunoHost .\WSL\YunoHost.tar.gz
```

### Im Falle eines Crash, lösche und stelle die gesamte Distro wieder her

```bash
cd ~
wsl --unregister YunoHost
wsl --import YunoHost .\WSL\YunoHost .\WSL\YunoHost.tar.gz --version 2
```

{% endif %}

{% if vps_ynh %}

## YunoHost VPS Provider

Hier sind ein paar VPS Provider, die YunoHost nativ unterstützen :

[div class="flex-container"]

[div class="flex-child"]
[[figure caption="Alsace Réseau Neutre - FR"]![](image://vps_ynh_arn.png?height=50)[/figure]](https://arn-fai.net/en/h%C3%A9bergement-alternatif/vps)
[/div]
[div class="flex-child"]
[[figure caption="FAImaison - FR"]![](image://vps_ynh_faimaison.svg?height=50)[/figure]](https://www.faimaison.net/services/vm.html)
[/div]
[div class="flex-child"]
[[figure caption="ECOWAN - FR"]![](image://vps_ynh_ecowan.png?height=50)[/figure]](https://www.ecowan.fr/vps-linux-yunohost?from-yunohost)
[/div]
[/div]
{% endif %}

{% if at_home %}

## [fa=download /] Lade das {{image_type}} Image herunter

{% if virtualbox or regular %}
!!! Achte darauf, dass du das 32-bit Image herunterlädst, wenn dein Host ein 32 Bit System ist.
{% elseif arm_unsup %}
<a href="https://www.armbian.com/download/" target="_BLANK" type="button" class="btn btn-info col-sm-12" style="background: none;">[fa=external-link] Lade das Image für dein Board auf der Armbian Website herunter.</a>

!!! Anmerkung: Du solltest das Image Armbian Bookworm downloaden.
{% endif %}

!!! Wenn du die Validität deiner signierten Images prüfen will, kannst du [unseren public key downloaden](https://forge.yunohost.org/keys/yunohost_bookworm.asc).

{% if internetcube or arm_sup %}
! Aktuelle Images stammen von Debian Buster (YunoHost v4.x) und erfordern, dass du einen manuellen apt update Befehl per SSH oder CLI durchführst, um weiter zu aktualisieren.
! Antworte mit Ja auf die Warnung über den Wechsel von stable zu oldstable.
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

## ![microSD Karte mit Adapter](image://sdcard_with_adapter.png?resize=100,75&class=inline) Flash das {{image_type}} Image

{% else %}

## ![USB Stick](image://usb_key.png?resize=100,100&class=inline) Flash das YunoHost Image

{% endif %}

Jetzt wo du das Image von {{image_type}} heruntergeladen hast, solltest du es auf {% if arm %}einer microSD Karte{% else %}einem USB stick oder einer CD/DVD flashen.{% endif %}

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="(Empfohlen) Mit Etcher"]

Lade <a href="https://www.balena.io/etcher/" target="_blank">Etcher</a> für dein Betriebssystem herunter und installiere es.

Steck {% if arm %}die SD Karte{% else %}den USB Stick{% endif %} an, wähle dein Image und klicke "Flash".

![Etcher](image://etcher.gif?resize=700&class=inline)

[/ui-tab]
[ui-tab title="Mit USBimager"]

Lade [USBimager](https://bztsrc.gitlab.io/usbimager/) für dein Betriebssystem herunter und installiere es.

Steck {% if arm %}die SD Karte{% else %}den USB Stick{% endif %} an, wähle dein Image und klicke "Write".

![USBimager](image://usbimager.png?resize=700&class=inline)

[/ui-tab]
[ui-tab title="Mit dd Befehl"]

Wenn du mit GNU/Linux / macOS arbeitest und dich mit der Kommandozeile auskennst, kannst du deinen USB Stick oder deine SD Karte auch mit `dd` flashen. Du kannst mit `fdisk -l` oder `lsblk` feststellen welches Device deinem USB stick oder deiner SD Karte entspricht. Ein typischer SD Karten Name ist sowas wie `/dev/mmcblk0`. SEI VORSICHTIG und stelle sicher, dass du den richtigen Namen hast.

Führe dann Folgendes aus :

```bash
# Ersetze /dev/mmcblk0 durch das richtige Device, wenn der Name deines Device anders ist...
dd if=/path/to/yunohost.img of=/dev/mmcblk0
```

[/ui-tab]
{% if regular %}
[ui-tab title="Eine CD/DVD brennen"]
Für ältere Geräte könntest du eine CD/DVD brennen wollen. Die zu verwendende Software hängt von deinem Betriebssystem ab.

- Auf Windows, benutze [ImgBurn](http://www.imgburn.com/), um die Image Datei auf die Disc zu schreiben.

- Auf macOS, benutze [Disk Utility](http://support.apple.com/kb/ph7025)

- Auf GNU/Linux hat man eine große Auswahl, wie [Brasero](https://wiki.gnome.org/Apps/Brasero) oder [K3b](http://www.k3b.org/)
[/ui-tab]
{% endif %}
[/ui-tabs]

{% else %}

## Erzeuge eine neue virtuelle Maschine

![](image://virtualbox_1.png?class=inline)

! Es ist in Ordnung, wenn du nur 32-bit Versionen haben kannst. Sei einfach sicher, dass du zuvor das 32-bit Image heruntergeladen hast.

## Netzwerk Einstellungen justieren

! Dieser Schritt ist wichtig, um die virtuelle Maschine ordnungsgemäß im Netzwerk zugänglich zu machen.

Gehe zu **Settings** > **Network**:

- Wähle `Bridged adapter`
- Wähle den Namen deines Interface:
    **wlan0**, wenn du kabellos verbunden bist, oder andernfalls **eth0**.

![](image://virtualbox_2.png?class=inline)

{% endif %}

{% if arm %}

## [fa=plug /] Das Board einschalten

- Schließe das Ethernet Kabel an (ein Ende an deinem Router, das andere an deinem Board).
  - Fortgeschrittene Nutzer, die das Board konfigurieren möchten, um sich stattdessen per WiFi zu verbinden, können bspw. [hier](https://www.raspberrypi.org/documentation/configuration/wireless/wireless-cli.md) nachlesen.
- Stecke die SD Karte in dein Board.
- (Optional) Du kannst Bildschirm+Tastatur direkt an deinem Board anschließen, wenn du Fehler am Boot Prozess beheben willst oder wenn du dich wohler fühlst zu "sehen was passiert" oder du direkten Zugriff auf das Board haben willst.
- Schalte das Board ein.
- Warte ein paar Minuten während sich das Board beim ersten Boot automatisch selbst konfiguriert.
- Stelle sicher, dass dein Computer (Desktop/Laptop) mit dem selben lokalen Netzwerk verbunden ist (z.B. mit der selben Internet Box) wie dein Server.

{% elseif virtualbox %}

## [fa=plug /] Die virtuelle Maschine hochfahren

Starte die virtuelle Maschine nach der Auswahl des YunoHost Image.

![](image://virtualbox_2.1.png?class=inline)

! Wenn du an den Fehler "VT-x ist nicht erreichbar" gerätst, musst du wahrscheinlich Virtualisierung im BIOS deines Computers einschalten.

{% else %}

## [fa=plug /] Die Maschine von deinem USB Stick booten

- Schließe das Ethernet Kabel an (ein Ende an deinem Router, das andere an deinem Board).
- Fahre deinen Server mit dem USB Stick oder einer eingesteckten CD-ROM hoch und wähle es durch Drücken einer der folgenden (Hardware spezifischen) Tasten als **bootable device** aus:
`<ESC>`, `<F9>`, `<F10>`, `<F11>`, `<F12>` oder `<DEL>`.
  - Anmerkung: Wenn auf dem Server zuvor eine aktuelle Windows Version (8+) installiert war, musst du Windows zuerst "actually reboot" sagen. Das kann irgendwo in "Advanced startup options" gemacht werden.
{% endif %}

{% if regular or virtualbox %}

## [fa=rocket /] Die grafische Installation starten

Du solltest einen Bildschirm wie diesen sehen:

[figure class="nomargin" caption="Vorschau des ISO Menüs"]
![](image://virtualbox_3.png?class=inline)
[/figure]
[ui-tabs position="top-left" active="0" theme="lite"]

[ui-tab title="Klassische Installation auf einer ganzen Festplatte"]

!! Anmerkung: Sobald du das Tastaturlayout bestätigt hast, wird die Installation gestartet und die Daten auf deiner Festplatte werden vollständig gelöscht!

  1. Wähle `Graphical install` aus
  2. Wähle deine Sprache, deinen Standort, dein Tastaturlayout und schließlich deine Zeitzone aus.
  3. Das Installationsprogramm lädt dann alle erforderlichen Pakete herunter und installiert sie.

[/ui-tab]
[ui-tab title="Installation im Expertenmodus"]

Das YunoHost-Projekt hat die klassische Installation so weit wie möglich vereinfacht, damit sich möglichst viele Menschen nicht in zu technischen oder fallbezogenen Fragen verlieren.

Mit der Installation im Expertenmodus hast du mehr Möglichkeiten, insbesondere was die genaue Partitionierung deiner Speichermedien betrifft. Du kannst dich auch für den klassischen Modus entscheiden und [deine Festplatten anschließend hinzufügen](/external_storage).

### Zusammenfassung der Schritte im Expertenmodus

  1. Wähle `Expert graphical install` aus.
  2. Wähle deine Sprache, deinen Standort, dein Tastaturlayout und möglicherweise deine Zeitzone aus.
  3. Partitioniere deine Festplatten. Hier kanst du ein RAID einrichten oder den Server ganz oder teilweise verschlüsseln.
  4. Gib einen möglichen HTTP-Proxy an, der für die Installation der Pakete verwendet werden soll.
  5. Gib an, auf welchen Volumes Grub installiert werden soll.

### Bezüglich der Partitionierung

Im Allgemeinen raten wir davon ab, „/var“, „/opt“, „/usr“, „/bin“, „/etc“, „/lib“, „/tmp“ und „/root“ auf separaten Partitionen zu partitionieren. Dadurch musst du dir keine Sorgen über volle Partitionen machen, die deinen Computer zum Absturz bringen, zum Scheitern von App-Installationen führen oder sogar deine Datenbanken beschädigen könnten.

Aus Performance Gründen wird empfohlen, den schnellsten Speicher (SSD) als root `/` zu mounten.

Wenn du über eine oder mehrere Festplatten zum Speichern von Daten verfügst, kannst du diese je nach Nutzung in einem dieser Ordner bereitstellen:

| Path | Contents |
|--------|---|
| `/home` | Benutzerordner, auf die über SFTP zugegriffen werden kann |
| `/home/yunohost.backup/archives` | YunoHost-Backups, die idealerweise an anderer Stelle als auf den Datenträgern platziert werden, auf denen die Daten verwaltet werden |
| `/home/yunohost.app` | Umfangreiche Datenmengen aus YunoHost Apps (nextcloud, matrix...) |
| `/home/yunohost.multimedia` | Große Datenmenge, die von mehreren Anwendungen gemeinsam genutzt wird |
| `/var/mail` | User mail |

Wenn du Flexibilität haben möchtest und die Größe von Partitionen nicht (verändern) möchtest, kannst du dich auch dafür entscheiden, auf `/mnt/hdd` zu mounten und dieser [Anleitung zum Mounten aller dieser Ordner mit `mount --bind`](/external_storage) zu folgen.

### Über Verschlüsselung

Beachte: Wenn du deine Festplatten ganz oder teilweise verschlüsselst, musst du bei jedem Neustart deines Servers die Passphrase eingeben. Das kann ein Problem darstellen, wenn du nicht vor Ort bist. Es gibt jedoch (ziemlich schwierig zu implementierende) Lösungen, die es dir ermöglichen, die Passphrase über SSH oder über eine Webseite einzugeben (suche nach "Dropbear Encrypted Disk").

### Über RAID

Denk daran, dass:

- die Festplatten in deinen RAIDs von unterschiedlichen Marken, Abnutzungserscheinungen oder Chargen sein müssen (insbesondere, wenn es sich um SSDs handelt).
- ein RAID 1 (auch ohne Ersatz) aus Wahrscheinlichkeitssicht zuverlässiger als ein RAID 5 ist.
- und Hardware-Raids von der Raid-Karte abhängen. Wenn die Karte ausfällt, benötigst du einen Ersatz, um das Array zu lesen und neu aufzubauen.

[/ui-tab]
[/ui-tabs]
{% endif %}

{% if arm_unsup %}

## [fa=terminal /] Verbindung zum Board

Als nächstes musst du [die lokale IP-Adresse deines Servers finden](/finding_the_local_ip), um dich als Root-Benutzer [über SSH](/ssh) mit dem temporären Passwort `1234` zu verbinden.

```bash
ssh root@192.168.x.xxx
```

{% endif %}

{% endif %}

{% if vps_debian or arm_unsup %}

## [fa=rocket /] Das Installationsskript ausführen

- Öffne eine Kommandozeile auf deinem Server (entweder direkt oder [über SSH](/ssh))
- Stelle sicher, dass du Root bist (oder gib „sudo -i“ ein, um Root zu werden)
- Führe den folgenden Befehl aus:

```bash
curl https://install.yunohost.org | bash
```

!!! Falls `curl` nicht auf deinem System installiert ist, kann es sein, dass du es mit `apt install curl` installieren musst.
!!! Falls der Befehl nichts bewirkt, kann es sein, dass du möglicherweise `apt install ca-certificates` ausführen musst.

!!! **Hinweis für fortgeschrittene Benutzer, die sich mit dem `curl|bash`-Ansatz befassen approach:** Ziehe das Lesen von ["Ist curl|bash unsicher?"](https://sandstorm.io/news/2015-09-24-is-curl-bash-insecure-pgp-verified-install) auf Sandstoms Blog und möglicherweise [diese Diskussion auf Hacker News](https://news.ycombinator.com/item?id=12766350&noprocess) in Erwägung.

{% endif %}

## [fa=cog /] Mit der Erstkonfiguration fortfahren

!!! Wenn du dabei bist, einen Server mithilfe eines YunoHost-Backups wiederherzustellen, solltest du diesen Schritt überspringen und [anstelle des Postinstallationsschritts das Backup wiederherstellen](/backup#restoring-during-the-postinstall).

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Über die Weboberfläche"]
{%if at_home %}
Gib in einem Internet Browser **{% if internetcube %}`https://internetcube.local`{% else %}`https://yunohost.local` (oder `yunohost-2.local` usw., wenn mehrere YunoHost Server in deinem Netzwerk sind){% endif %}** ein.

!!! Wenn das nicht funktioniert, kannst du [nach der lokalen IP-Adresse deines Servers suchen](/finding_the_local_ip). Die Adresse sieht normalerweise wie `192.168.x.y` aus und du solltest daher `https://192.168.x.y` in die Adressleiste deines Browsers eingeben.
{% else %}
Du kannst die Erstkonfiguration mit der Weboberfläche durchführen, indem du in die Adresszeile deines Webbrowsers **die öffentliche IP-Adresse deines Servers** eingibst. Normalerweise sollte dir dein VPS-Anbieter die IP des Servers mitgeteilt haben.
{% endif %}

! Beim ersten Besuch wirst du höchstwahrscheinlich auf eine Sicherheitswarnung bezüglich des vom Server verwendeten Zertifikats stoßen. Im Moment verwendet dein Server ein selbstsigniertes Zertifikat. {% if not wsl %}Später kannst du ein von Webbrowsern automatisch erkanntes Zertifikat hinzufügen, wie in der [Zertifikatdokumentation](/certificate) beschrieben ist. {% endif %} Zunächst solltest du eine Sicherheitsausnahme hinzufügen, um das aktuelle Zertifikat zu akzeptieren. (Aber BITTE gewöhne dir nicht an, diese Art von Sicherheitswarnung blind zu akzeptieren!)

{% if not internetcube %}
Dann solltest du auf dieser Seite landen:

[figure class="nomargin" caption="Vorschau der Web-Erstkonfigurationsseite"]
![Initial configuration page](image://postinstall_web.png?resize=100%&class=inline)
[/figure]

{% endif %}
[/ui-tab]
[ui-tab title="Mit der Kommandozeile"]

Du kannst die Post-Installation auch mit dem Befehl `yunohost tools postinstall` direkt auf dem Server oder [über SSH](/ssh) durchführen.

[figure class="nomargin" caption="Vorschau der Kommandozeile nach der Post-Installation"]
![Initial configuration with CLI](image://postinstall_cli.png?resize=100%&class=inline)
[/figure]

[/ui-tab]
[/ui-tabs]

{% if not internetcube %}

### [fa=globe /] Haupt-Domain

Dies ist die Domäne, über die die Benutzer deines Servers auf das **Authentifizierungsportal** zugreifen. Du kannst später weitere Domains hinzufügen und bei Bedarf ändern, welche Domain die Haupt-Domain ist.

{% if not wsl %}

- Wenn du neu im Self-Hosting bist und noch keinen Domain-Namen hast, empfehlen wir die Verwendung eines **.nohost.me** / **.noho.st** / **.ynh.fr** (z.B. `homersimpson.nohost.me`). Sofern die Domain noch nicht vergeben ist, wird sie automatisch konfiguriert und du benötigst keinen weiteren Konfigurationsschritt. Bitte beachte, dass der Nachteil darin besteht, dass du nicht die vollständige Kontrolle über die DNS-Konfiguration hast.

- Wenn du bereits einen Domain-Namen besitzt, möchtest du ihn wahrscheinlich hier verwenden. Später musst du DNS-Einträge konfigurieren, so wie [hier](/dns_config) beschrieben.

!!! Ja, du *musst* eine Domain-Namen konfigurieren. Wenn du keinen Domain-Namen hast und auch keine **.nohost.me** / **.noho.st** / **.ynh.fr** möchtest, kannst du eine Dummy-Domain einrichten wie `yolo.test` und passt deine **lokale** `/etc/hosts` Datei so an, dass diese Dummy-Domain [auf die entsprechende IP verweist, wie hier erklärt](/dns_local_network).

{% else %}

Du musst eine Fake-Domain wählen, da diese von außen nicht zugänglich ist.
Zum Beispiel `ynh.wsl`. Der schwierige Teil besteht darin, diese Domain bei deinem Host zu bekannt zu machen.

Ändere deine `C:\Windows\System32\drivers\etc\hosts` Datei. Du solltest eine Zeile haben, die mit `::1` beginnt. Aktualisiere sie oder füge sie bei Bedarf hinzu, um Folgendes zu erhalten:

```text
::1    ynh.wsl localhost
```

Wenn du Subdomains erstellen möchtest, denk daran, diese auch in der Datei `hosts` hinzuzufügen:

```text
::1    ynh.wsl subdomain.ynh.wsl localhost
```

{% endif %}

### [fa=key /] Der erste Benutzer

In dieser Phase wird der erste Benutzer erstellt. Du solltest einen Benutzernamen und ein einigermaßen komplexes Passwort wählen. (Wir können nicht genug betonen, dass das Passwort **robust** sein sollte!) Dieser Benutzer wird der Administratoren-Gruppe hinzugefügt und kann daher auf das Benutzerportal und die Webadministrationsoberfläche zugreifen und eine Verbindung  [über **SSH**](/ssh) oder [**SFTP**](/filezilla) herstellen. Administratoren erhalten außerdem E-Mails an `root@yourdomain.tld` und `admin@yourdomain.tld`: Diese E-Mails können zum Versenden technischer Informationen oder Warnungen verwendet werden. Du kannst später weitere Benutzer hinzufügen, die du auch zur Administratoren-Gruppe hinzufügen kannst.

Dieser Benutzer ersetzt den alten `admin` Benutzer, auf den sich einige alte Dokumentationsseiten möglicherweise noch beziehen. In diesem Fall: Ersetzen Sie einfach `admin` durch Ihren Benutzernamen.

## [fa=stethoscope /] Die Erstdiagnose durchführen

Sobald die Post-Installation abgeschlossen ist, solltest du dich tatsächlich mit den Credentials des ersten Benutzers, den du gerade erstellt hast, bei der Webadministrationsoberfläche anmelden können.

{% if wsl %}
! Erinngerung: YunoHost wird in der WSL von außen wahrscheinlich nicht erreichbar sein und ihr können keine echten Domains und Zertifikate zugewiesen werden.
{% endif %}
{% if virtualbox %}
! Erinnerung: YunoHost wird in VirtualBox ohne weitere Netzwerkkonfiguration in den Virtualbox-Einstellungen wahrscheinlich nicht von außen erreichbar sein. Die Diagnose wird sich darüber wahrscheinlich beschweren.
{% endif %}

Das Diagnosesystem soll eine einfache Möglichkeit bieten, zu überprüfen, ob alle kritischen Aspekte deines Servers ordnungsgemäß konfiguriert sind – und dich bei der Behebung von Problemen unterstützen. Die Diagnose wird zweimal täglich ausgeführt und sendet eine Warnung, wenn Probleme erkannt werden.

!!! Anmerkung : **Lauf nicht davon** ! Wenn du die Diagnose zum ersten Mal ausführst, ist es durchaus zu erwarten, dass eine Reihe gelber/roter Warnungen angezeigt werden, da du normalerweise [DNS-Einträge konfigurieren](/dns_config) musst (wenn du keine `.nohost.me`/`noho.st`/`ynh.fr` Domain verwendest). Lege ein Swapfile an, wenn nicht genügend RAM vorhanden ist {% if at_home %} und/oder richte [Portweiterleitung](/isp_box_config) ein.{% endif %}

!!! Ist eine Warnung für dich nicht relevant (z.B. weil du nicht vor hast, eine bestimmte Funktion zu verwenden), ist es völlig in Ordnung, das Problem als 'ignoriert' zu markieren, indem du im Webadmin > Diagnose auf den "Ignorieren" Button (für diese bestimmte Funktion) klickst.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="(Empfohlen) Über die Weboberfläche"]
Um eine Diagnose auszuführen, gehe im Web Admin auf den Abschnitt "Diagnose". Klicke auf "Erstdiagnose ausführen". Du solltest nun einen Bildschirm wie diesen erhalten:

[figure class="nomargin" caption="Vorschau des Diagnosepanels"]
![](image://diagnostic.png?resize=100%&class=inline)
[/figure]

[/ui-tab]
[ui-tab title="In der Kommandozeile"]

```bash
yunohost diagnosis run
yunohost diagnosis show --issues --human-readable
```

[/ui-tab]
[/ui-tabs]

## [fa=lock /] Ein Let's Encrypt Zertifikat holen

Sobald du die DNS-Einträge und die Portweiterleitung (falls erforderlich) konfiguriert hast, solltest du ein Let's Encrypt-Zertifikat einrichten können. Dadurch entfällt für neue Besucher die gruselige Sicherheitswarnung von vorhin.

Ausführlichere Anweisungen oder weitere Informationen zu SSL/TLS-Zertifikaten findest du [hier auf der entsprechenden Seite](/certificate).

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Über die Weboberfläche"]

Gehe zu Domains > Klicke auf deine Domain > SSL Zertifikat

[figure class="nomargin" caption="Vorschau des Diagnosepanels"]
![](image://certificate-before-LE.png?resize=100%&class=inline)
[/figure]

[/ui-tab]
[ui-tab title="In der Kommandozeile"]

```bash
yunohost domain cert install
```

[/ui-tab]
[/ui-tabs]

## ![](image://tada.png?resize=32&classes=inline) Gratulation!

Jetzt hast du ein sehr gut konfigurierten Server. Wenn du neu bei YunoHost bist, empfehlen wir dir, einen Blick auf [die geführte Tour](/overview) zu werfen. Du solltest auch in der Lage sein, [deine Lieblingsanwendungen zu installieren](/apps). Vergiss nicht, [Backups zu planen](/backup)!

{% endif %}
{% endif %}
