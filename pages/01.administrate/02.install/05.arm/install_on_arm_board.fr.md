---
title: Installer YunoHost sur carte ARM
template: docs
taxonomy:
    category: docs
routes:
  default: '/install_on_arm_board'
---

*Toutes les autres façons d’installer YunoHost sont listées **[ici](/install)**.*

![](image://olinuxino.jpg?resize=250)
![](image://micro-sd-card.jpg)

!!! Avant d'héberger un serveur chez vous, il est recommandé de prendre connaissance des [possibles limitations liées à votre FAI](/isp). Si votre FAI est trop contraignant, vous pouvez envisager d'utiliser un VPN pour contourner ces limitations.

- Une carte ARM avec un processeur de 500 MHz et 512 Mo de mémoire vive ; 
- Un adaptateur secteur pour alimenter la carte ;
- Une carte microSD : au moins **8 Go** et **Classe 10** (par exemple une [Transcend 300x](http://www.amazon.fr/Transcend-microSDHC-adaptateur-TS32GUSDU1E-Emballage/dp/B00CES44EO)) ;
- Un câble ethernet/RJ-45 pour brancher la carte à votre routeur/box internet. (Avec le Raspberry Pi 0, vous pouvez connecter votre carte avec un câble OTG et un adaptateur Wifi USB.)
- Un [fournisseur d’accès correct](/isp), de préférence avec une bonne vitesse d’upload.

---

## Installation avec l'image pré-installée (recommandée)

[div class="btn btn-lg btn-default"] [0. Télécharger l'image pré-installée pour votre carte ARM](/images) [/div]
<br>
<small class="text-info">Si il n'existe pas d'image pré-installée pour votre carte, vous pouvez suivre la section "Installation par dessus ARMbian".</small>

[div class="btn btn-lg btn-default"] [1. Flasher la carte SD avec l'image](/burn_or_copy_iso) [/div]

[div class="btn btn-lg btn-default"] [2. Démarrer la carte et se connecter à l'interface web sur `yunohost.local`](/plug_and_boot) [/div]

[div class="btn btn-lg btn-default"] [3. Effectuer la configuration initiale (post-installation)](/postinstall) [/div]

---

## Installation par dessus ARMbian

[div class="btn btn-lg btn-default"] [0. Télécharger l'image ARMbian pour votre carte ARM](https://www.armbian.com/download/) [/div]

[div class="btn btn-lg btn-default"] [1. Flasher la carte SD avec l'image](/burn_or_copy_iso) [/div]

[div class="btn btn-lg btn-default"] [2. Brancher & démarrer](/plug_and_boot) [/div]

[div class="btn btn-lg btn-default"] [3. Se connecter en SSH](/ssh) [/div]

[div class="btn btn-lg btn-default"] [4. Suivre la procédure d'installation générique](/install_manually) [/div]

