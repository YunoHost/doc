# Installer YunoHost sur Raspberry Pi

*Toutes les autres façons d’installer YunoHost sont listées **[ici](/install_fr)**.*

<center>
<img src="/images/raspberrypi.jpg" width=300 style="padding-bottom:20px">
<img src="/images/micro-sd-card.jpg">
</center>

<div class="alert alert-info" markdown="1">
Avant d'héberger un serveur chez vous, il est recommandé de prendre connaissance des [possibles limitations liées à votre FAI](/isp). Si votre FAI est trop contraignant, vous pouvez envisager d'utiliser un VPN pour contourner ces limitations.
</div>

## Prérequis

- Un Raspberry Pi 0, 1, 2 ou 3 ;
- Un adaptateur secteur pour alimenter la carte ;
- Une carte microSD : au moins **8 Go** et **Classe 10** (par exemple une [Transcend 300x](http://www.amazon.fr/Transcend-microSDHC-adaptateur-TS32GUSDU1E-Emballage/dp/B00CES44EO)) ;
- Un câble ethernet/RJ-45 pour brancher la carte à votre routeur/box internet. (Avec le Raspberry Pi 0, vous pouvez connecter votre carte avec un câble OTG et un adaptateur Wifi USB.)
- Un [fournisseur d’accès correct](/isp_fr), de préférence avec une bonne vitesse d’upload.

---

## Installation avec l'image pré-installée (recommandée)

<a class="btn btn-lg btn-default" href="/images_fr">1. Télécharger l'image pour Raspberry Pi</a>

<a class="btn btn-lg btn-default" href="/copy_image_fr">2. Flasher la carte SD avec l'image</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot_fr">3. Brancher la carte et la laisser démarrer</a>

<a class="btn btn-lg btn-default" href="/ssh_fr">4. Se connecter en SSH sur le serveur</a>

<a class="btn btn-lg btn-default" href="/postinstall_fr">5. Effectuer la configuration initiale (post-installation)</a>

---

## Installation manuelle (déconseillée)

<div class="alert alert-warning" markdown="1">
Nous déconseillons l'installation manuelle car elle est plus technique et plus longue que l'installation via l'image pré-installée. Cette documentation est surtout destinée aux utilisateurs avancés.
</div>

<div class="alert alert-warning" markdown="1">
Les dernières versions de Raspbian nécessitent un écran et un clavier, car il n'est plus possible de se connecter directement en SSH au Raspberry par défaut. Néanmoins, il est possible de réactiver le lancement de SSH au boot : il suffit de placer dans la partition boot de la carte SD un fichier nommé `ssh`, vide et sans extension.
</div>

0. Installez Raspbian Stretch Lite ([instructions](https://www.raspberrypi.org/downloads/raspbian/)) sur la carte SD. 
Le lien vers la Raspbian Stretch Lite est ici: https://downloads.raspberrypi.org/raspbian_lite/images/raspbian_lite-2019-04-09/

1. Connectez-vous en ssh au Raspberry Pi avec l'utilisateur pi. Définissez un mot de passe root avec 
```bash
sudo passwd root
```

2. Modifiez `/etc/ssh/sshd_config` pour autoriser root à se logger en ssh, en remplaçant `PermitRootLogin without-password` par `PermitRootLogin yes`. Rechargez le daemon ssh avec `service ssh reload`, puis re-connectez-vous en root.

3. Déconnectez-vous et reconnectez-vous avec l'utilisateur root cette fois.

4. Poursuivez avec la <a href="/install_manually_fr">procédure d'installation manuelle générique</a>.

