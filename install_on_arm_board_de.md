# Installiere YunoHost auf einem ARM board

*Andere Wege, YunoHost zu installieren, sind **[hier](/install)** zu finden.*

<center>
<img src="/images/olinuxino.jpg" width=250 style="padding-bottom:20px">
<img src="/images/micro-sd-card.jpg">
</center>

<div class="alert alert-info" markdown="1">
Bevor du deinen Heimserver einrichtest, solltest du dich mit den the [moeglichen Limitationen](/isp), welche durch deinen ISP entstehen, auseinandersetzen. 
Sollten sie dich zu sehr einschraenken, dann koenntest du einen VPN verwenden, um sie zu umgehen.
</div>

## Vorraussetzungen

- Ein ARM board mit einer mind. 500MHz CPU und 512 MB RAM;
- Ein Netzteil fuer dein Board;
- Eine microSD-Karte: (mindestens) **8GB** Speicher und Geschwindigkeitsklasse **Class 10**;
- Ein Ethernet-Kabel (RJ-45), um dein Board mit deinem Router zu verbinden;
- Einen [vernuenftigen ISP](/isp), am besten mit einer hohen Upload-Bandbreite.

---

## Installation mit einem vorgefertigtem Image (empfohlen)

<a class="btn btn-lg btn-default" href="/images">0. Image fuer dein Board herunterladen</a>
<br>
<small class="text-info">Sollte kein Image fuer dein Board existieren, kannst du die Anleitung unten befolgen</small>

<a class="btn btn-lg btn-default" href="/burn_or_copy_iso">1. Image auf die SD-Karte brennen</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">2. Board anschalten und starten lassen</a>

<a class="btn btn-lg btn-default" href="/ssh">3. Via SSH verbinden</a>

<a class="btn btn-lg btn-default" href="/postinstall">4. Mit der Konfiguration fortfahren (post-installation)</a>

---

## Auf einer ARMbian-Installation installieren

<a class="btn btn-lg btn-default" href="https://www.armbian.com/download/">0. ARMbian image fuer dein Board herunterladen</a>

<a class="btn btn-lg btn-default" href="/burn_or_copy_iso">1. Image auf SD-Karte brennen</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">2. Einstecken & starten</a>

<a class="btn btn-lg btn-default" href="/ssh">3. Via SSH verbinden</a>

<a class="btn btn-lg btn-default" href="/install_manually">4. Der Installationsanleitung folgen</a>
