---
title: Installer YunoHost sur Raspberry Pi
template: docs
taxonomy:
    category: docs
---

*Toutes les autres façons d’installer YunoHost sont listées **[ici](/install)**.*

<center>
<img src="/images/raspberrypi.jpg" width=300 style="padding-bottom:20px">
<img src="/images/micro-sd-card.jpg">
</center>

<div class="alert alert-info" markdown="1">
Avant d'héberger un serveur chez vous, il est recommandé de prendre connaissance des [possibles limitations liées à votre FAI](/isp). Si votre FAI est trop contraignant, vous pouvez envisager d'utiliser un VPN pour contourner ces limitations.
</div>

## Prérequis

- Un Raspberry Pi 2, 3 ou 4 (Les RPi 0 et 1 peuvent fonctionner mais nécessitent de bricoler un peu ... voir [cette issue](https://github.com/YunoHost/issues/issues/1423)) ;
- Un adaptateur secteur pour alimenter la carte ;
- Une carte microSD : au moins **8 Go** et **Classe 10** (par exemple une [Transcend 300x](http://www.amazon.fr/Transcend-microSDHC-adaptateur-TS32GUSDU1E-Emballage/dp/B00CES44EO)) ;
- Un câble ethernet/RJ-45 pour brancher la carte à votre routeur/box internet. (Avec le Raspberry Pi 0, vous pouvez connecter votre carte avec un câble OTG et un adaptateur Wifi USB.)
- Un [fournisseur d’accès correct](/isp), de préférence avec une bonne vitesse d’upload.

---

## Installation avec l'image pré-installée (recommandée)

<a class="btn btn-lg btn-default" href="/images">1. Télécharger l'image pour Raspberry Pi</a>

<a class="btn btn-lg btn-default" href="/burn_or_copy_iso">2. Flasher la carte SD avec l'image</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">3. Démarrer la carte et se connecter à l'interface web sur `yunohost.local`</a>

<a class="btn btn-lg btn-default" href="/postinstall">4. Effectuer la configuration initiale (post-installation)</a>

---

## Installation manuelle (déconseillée)

<div class="alert alert-warning" markdown="1">
Nous déconseillons l'installation manuelle car elle est plus technique et plus longue que l'installation via l'image pré-installée. Cette documentation est surtout destinée aux utilisateurs avancés.
</div>

<div class="alert alert-warning" markdown="1">
Les dernières versions de Raspbian nécessitent un écran et un clavier, car il n'est plus possible de se connecter directement en SSH au Raspberry par défaut. Néanmoins, il est possible de réactiver le lancement de SSH au boot : il suffit de placer dans la partition boot de la carte SD un fichier nommé `ssh`, vide et sans extension.
</div>

0. Installez Raspberry Pi OS Lite ([instructions](https://www.raspberrypi.org/downloads/raspberry-pi-os/)) sur la carte SD. 
Le lien vers Raspberry Pi OS Lite est ici : https://downloads.raspberrypi.org/raspbian_lite/images/

1. Connectez-vous en SSH au Raspberry Pi avec l'utilisateur pi. Définissez un mot de passe root avec 
```bash
sudo passwd root
```

2. Modifiez `/etc/ssh/sshd_config` pour autoriser root à se logger en SSH, en remplaçant `PermitRootLogin without-password` par `PermitRootLogin yes`. Rechargez le daemon SSH avec `service ssh reload`, puis re-connectez-vous en root.

3. Déconnectez-vous et reconnectez-vous avec l'utilisateur root cette fois.

4. Poursuivez avec la <a href="/install_manually">procédure d'installation manuelle générique</a>.

