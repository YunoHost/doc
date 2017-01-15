# Installer YunoHost sur Raspberry Pi

*Toutes les autres façons d’installer YunoHost sont listées **[ici](/install_fr)**.*

## Prérequis
<img src="/images/Raspberry_Pi_2_Model_B_v1.1_front_angle_new.jpg" width=350>
<img src="/images/micro-sd-card.jpg">

- Un Raspberry Pi 1, 2 ou 3
- Une carte SD de capacité minimale de **4 Go** et une certification de vitesse **class10** sont recommandées
- Un autre ordinateur pour parcourir ce guide et accéder à votre Raspberry Pi
- Un écran et un clavier sont recommandés pour pouvoir contrôler votre Raspberry Pi si un problème apparaît
- Un [fournisseur d’accès correct](/isp_fr), de préférence avec une bonne vitesse d’upload
- Les **images YunoHost pour Raspberry Pi**, disponible ici :
 - [Officielle, Wheezy/YunoHost 2.2 créée le 4 juin 2015](http://build.yunohost.org/yunohost4rpi2.img.7z)
 - [Non officielle Jessie/YunoHost 2.2 créée le 5 décembre 2015](https://forum.yunohost.org/t/building-a-new-image-for-raspberry-debian-jessie-fr-en/1101/2)
- Un tutoriel d'installation basée sur YunoHost 2.4 a été écrit par AviGNU : http://avignu.wiki.tuxfamily.org/doku.php?id=documentation:yunohost-jessie

Il y a deux façon d'installer Yunohost, soit vous pouvez repartir de zéro avec une nouvelle image ou installer manuellement :

---

## Installation avec une image

<a class="btn btn-lg btn-default" href="/copy_image_fr">1. Copier l’image sur une carte SD</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot_fr">2. Brancher & démarrer</a>

<a class="btn btn-lg btn-default" href="/postinstall_fr">3. Post-installation</a>


## Installation manuelle

Utilisez cette méthode si vous ne pouvez pas repartir de zéro et utiliser une image. Attention, ces étapes sont différentes si vous installez sur un Raspberry Pi Zero !

1. Installer git
```bash
sudo apt-get install git
```

2. Cloner le repo Yunohost install script 
```bash
git clone https://github.com/YunoHost/install_script /tmp/install_script
```

3. L'user root doit avoir un mot de passe. Si ce n'est pas le cas l'installation ne marchera pas:
```bash
sudo passwd root
```

4. Mettre à jour le Pi: 
```bash
apt-get update ; apt-get dist-upgrade -y ; apt-get install rpi-update ; rpi-update ; reboot`
```

Cela va mettre à jour le Pi, puis rebooter.

<div class="alert alert-info">
<b>Raspberry Pi Zero :</b> suivez ces étapes pour une installation réussie.

</div>

0.1 Installez metronome manuellement:
```bash
apt-get install -y ssl-cert lua-event lua-expat lua-socket lua-sec lua-filesystem
wget https://github.com/YunoHost/metronome/archive/debian/3.7.9+33b7572-1.zip
unzip 3.7.9+33b7572-1.zip
cd metronome-debian-3.7.9-33b7572-1
dpkg-buildpackage -rfakeroot -uc -b -d
cd ..
dpkg -i metronome_3.7.9+33b7572-1_armhf.deb
apt-mark hold metronome
```

4. Executer le script d' installation
```bash
cd /tmp/install_script && sudo ./install_yunohost
```

---

### Recommandé après la post-installation

* Se connecter en [ssh](ssh_fr) : **root@IP.DU.RPI** (mot de passe : **yunohost**)
* Changer le mot de passe root : ```passwd root```
* Mettre à jour le système d’exploitation : ```apt-get update && apt-get dist-upgrade && rpi-update```
* Configurer la langue, le clavier et le fuseau horaire avec l'outil **raspi-config**

---

#### Créer une image
* [Créer une image pour Raspberry](/build_arm_image_fr)

---
***Si vous avez besoin d’aide lors de ces étapes, n’hésitez pas à utiliser les différents [moyens de support](/support_fr).***
