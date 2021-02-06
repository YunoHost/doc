---
title: Installer YunoHost sur carte ARM
template: docs
taxonomy:
    category: docs
---

*Toutes les autres façons d’installer YunoHost sont listées **[ici](/install)**.*

<center>
<img src="/images/olinuxino.jpg" width=250 style="padding-bottom:20px">
<img src="/images/micro-sd-card.jpg">
</center>

<div class="alert alert-info" markdown="1">
Avant d'héberger un serveur chez vous, il est recommandé de prendre connaissance des [possibles limitations liées à votre FAI](/isp). Si votre FAI est trop contraignant, vous pouvez envisager d'utiliser un VPN pour contourner ces limitations.
</div>

- Une carte ARM avec un processeur de 500 MHz et 512 Mo de mémoire vive ; 
- Un adaptateur secteur pour alimenter la carte ;
- Une carte microSD : au moins **8 Go** et **Classe 10** (par exemple une [Transcend 300x](http://www.amazon.fr/Transcend-microSDHC-adaptateur-TS32GUSDU1E-Emballage/dp/B00CES44EO)) ;
- Un câble ethernet/RJ-45 pour brancher la carte à votre routeur/box internet. (Avec le Raspberry Pi 0, vous pouvez connecter votre carte avec un câble OTG et un adaptateur Wifi USB.)
- Un [fournisseur d’accès correct](/isp), de préférence avec une bonne vitesse d’upload.

---

## Installation avec l'image pré-installée (recommandée)

<a class="btn btn-lg btn-default" href="/images">0. Télécharger l'image pré-installée pour votre carte ARM</a>
<br>
<small class="text-info">Si il n'existe pas d'image pré-installée pour votre carte, vous pouvez suivre la section "Installation par dessus ARMbian".</small>

<a class="btn btn-lg btn-default" href="/burn_or_copy_iso">1. Flasher la carte SD avec l'image</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">2. Démarrer la carte et se connecter à l'interface web sur `yunohost.local`</a>

<a class="btn btn-lg btn-default" href="/postinstall">3. Effectuer la configuration initiale (post-installation)</a>

---

## Installation par dessus ARMbian

<a class="btn btn-lg btn-default" href="https://www.armbian.com/download/">0. Télécharger l'image ARMbian pour votre carte ARM</a>

<a class="btn btn-lg btn-default" href="/burn_or_copy_iso">1. Flasher la carte SD avec l'image</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">2. Brancher & démarrer</a>

<a class="btn btn-lg btn-default" href="/ssh">3. Se connecter en SSH</a>

<a class="btn btn-lg btn-default" href="/install_manually">4. Suivre la procédure d'installation générique</a>

