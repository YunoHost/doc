# Installer YunoHost sur Raspberry Pi

*Toutes les autres façons d’installer YunoHost sont listées **[ici](/install_fr)**.*

<center>
<img src="/images/raspberrypi.jpg" width=350>
</center>

<div class="alert alert-info" markdown="1">
Avant d'héberger un serveur chez vous, il est recommandé de prendre connaissance des [limitations liées à votre FAI](/isp). Si votre FAI est trop contraignant, il est possible d'utiliser un VPN pour contourner ces limitations.
</div>

## Prérequis

- Un Raspberry Pi 0, 1, 2 ou 3 ;
- Une carte SD : au moins **8 Go** et **Classe 10** (par exemple une [Transcend 300x](http://www.amazon.fr/Transcend-microSDHC-adaptateur-TS32GUSDU1E-Emballage/dp/B00CES44EO)) ;
- Un adaptateur secteur pour la alimenter la carte ;
- Un câble ethernet/RJ-45 pour brancher la carte à votre routeur/box internet. Avec le Raspberry Pi Zero vous pouvez connecter votre carte avec un câble OTG et un adaptateur Wifi USB.
- L'image YunoHost pour Raspberry Pi, à télécharger sur [build.yunohost.org](http://build.yunohost.org/). (Pas nécessaire si vous souhaitez faire une installation manuelle sur un système Debian déjà installé)
- **(Optionnel)** Un écran et un clavier s'il n'est pas possible de se connecter directement en SSH au Raspberry. (Pas nécessaire si vous installez depuis l'image)

---

## Installation avec une image

<a class="btn btn-lg btn-default" href="/copy_image_fr">1. Copier l’image sur une carte SD</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot_fr">2. Brancher & démarrer</a>

<a class="btn btn-lg btn-default" href="/ssh_fr">3. Se connecter en SSH</a>

<a class="btn btn-lg btn-default" href="/postinstall_fr">4. Procéder à la post-installation</a>

---

## Installation manuelle


0. Installez Raspbian sur la carte SD puis connectez-vous en ssh au Raspberry Pi. 
<!-- [TODO : Cette partie n'est pas triviale et dois être détaillée comme pour OLinuXino !!] -->


1. L'user root doit avoir un mot de passe. (Si ce n'est pas le cas l'installation ne marchera pas.)
```bash
sudo passwd root
```

2. Installer git
```bash
sudo apt-get install git
```

3. Récupérer le script d'installation de Yunohost
```bash
git clone https://github.com/YunoHost/install_script /tmp/install_script
```

4. Executez le script d' installation
```bash
cd /tmp/install_script && sudo ./install_yunohost
```

---

***Si vous avez besoin d’aide lors de ces étapes, n’hésitez pas à utiliser les différents [outils de support](/support_fr).***
