---
title: Guide d'installation
template: docs
taxonomy:
    category: docs
routes:
  default: '/install'
---

On which hardware do you want install Yunohost ?
<select>
    <option value="" disabled>An ARM board (raspberry pi, olinuxino...)
    <option id="install_internetcube" value="">→ An internetcube with .cube VPN
    <option id="install_rpi2p" value="">→ A Rpi 2, 3 or 4
    <option id="install_arm_supported" value="">→ An Orange Pi PC+ / Olinuxino Lime 1&2
    <option id="install_rpi1" value="">→ A Rpi 1 (no xmpp features)
    <option id="install_rpi0" value="">→ A Rpi 0 (no xmpp features)
    <option id="install_arm_others" value="">→ An other arm board
    <option id="install_x86athome" value="">→ A regular computer
    <option value="" disabled>A dedicated or a virtual private server
    <option id="install_vpsdebian10" value="">→ with debian 10
    <option id="install_vpsyunohost" value="">→ with yunohost pre-installed
    <option id="install_virtualbox" value="">virtualbox
</select>





Il existe plusieurs manières d’installer YunoHost. La méthode d’installation diffère légèrement si vous souhaitez l’installer chez vous ou à distance, et du matériel utilisé : **[voir le matériel compatible](/hardware)**

Cette page liste plusieurs types d’installations, classés par catégories.

---









<h1 style="font-weight: 100">Essayer</h1>

<div class="row">

<div class="col col-md-3 text-center">
<a href="/try"><img height=150 src="/images/logo.png" style="vertical-align:bottom"><b><p>Serveur de démo</p></b></a>
</div>

<div class="col col-md-3 text-center">
<a href="/install_on_virtualbox"><img src="/images/virtualbox.png" height=150 style="vertical-align:bottom"><b><p>Essayer dans une machine virtuelle</p></b></a>
</div>

</div>

<br>

---

<h1 style="font-weight: 100">Installer à la maison</h1>

<div class="row">

<div class="col col-md-3 text-center">
<a href="/install_on_raspberry"><img src="/images/raspberrypi.jpg" height=150 style="vertical-align:bottom"><b><p>Sur un Raspberry Pi</p></b></a>
</div>

<div class="col col-md-3 text-center">
<a href="/install_on_arm_board"><img src="/images/olinuxino.jpg" height=150 style="vertical-align:bottom; padding:20px"><b><p>Sur une carte ARM</p></b></a>
</div>

<div class="col col-md-3 text-center">
<a href="/install_iso"><img src="/images/computer.png" height=150 style="vertical-align:bottom"><b><p>Sur un ordinateur standard</p></b></a>
</div>

</div>

<br>

---

<h1 style="font-weight: 100">Installer à distance</h1>

<div class="alert alert-info" markdown="1">
<span class="glyphicon glyphicon-heart"></span> Des FAI associatifs près de chez vous sont peut-être capable de vous fournir un *Serveur Privé Virtuel* (VPS), géré par des humains qui respectent les utilisateurs et la [Neutralité du Net](https://fr.wikipedia.org/wiki/Neutralit%C3%A9_du_r%C3%A9seau) ! Voir [cette page](https://db.ffdn.org/) pour plus d'informations.
</div>

<div class="row">

<div class="block-center text-center">
<a href="/install_on_vps"><img src="/images/vps.png" height=150 style="vertical-align:bottom; text-align:center"><b><p>Sur un serveur dédié ou virtuel (VPS)</p></b></a>
</div>

</div>

<br>

---

<h1 style="font-weight: 100">Avancé / autres</h1>

<div class="row">

<div class="col col-md-3 text-center">
<a href="/install_on_debian"><img height=150 src="/images/debian-logo.png" style="vertical-align:bottom">
<b><p>Sur Debian 10/Buster</p></b></a>
</div>

<div class="col col-md-3 text-center">
<a href="/dev"><img src="/images/lxc.png" height=150 style="vertical-align:bottom"><b><p>Environnement de dev avec LXD/LXC</p></b></a>
</div>

<div class="col col-md-3 text-center">
<a href="/docker"><img src="/images/docker.png" height=150 style="vertical-align:bottom"><b><p>(Non-officiel !) Images docker</p></b></a>
</div>

</div>
