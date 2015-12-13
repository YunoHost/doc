# Installer YunoHost sur Raspberry Pi

*Toutes les autres façons d’installer YunoHost sont listées **[ici](/install_fr)**.*

## Prérequis
<img src="https://yunohost.org/images/Raspberry_Pi_2_Model_B_v1.1_front_angle_new.jpg" width=350>
<img src="https://yunohost.org/images/micro-sd-card.jpg">

* Un Raspberry Pi 1 ou 2
* Une carte SD de capacité minimale de **4Go** et une certification de vitesse **class10** sont recommandées
* Un autre ordinateur pour parcourir ce guide et accéder à votre Raspberry Pi
* Un écran et un clavier sont recommandés pour pouvoir contrôler votre Raspberry Pi si un problème apparaît
* Un [fournisseur d’accès correct](/isp_fr), de préférence avec une bonne vitesse d’upload
* L’**image YunoHost pour Raspberry Pi**, disponible ici (à **dézipper**) :

    [Image wheezy pour Raspberry Pi 1 et 2 créée le 4 juin 2015](http://build.yunohost.org/yunohost4rpi2.img.7z)

---

## Étapes d’installation

<a class="btn btn-lg btn-default" href="/copy_image_fr">1. Copier l’image sur une carte SD</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot_fr">2. Brancher & démarrer</a>

<a class="btn btn-lg btn-default" href="/postinstall_fr">3. Post-installation</a>

---

### Recommandé après la post-installation

* Se connecter en [ssh](ssh_fr) : **root@IP.DU.RPI** (mot de passe : **yunohost**)
* Changer le mot de passe root : ```passwd root```

* Mettre à jour le système d’exploitation : ```apt-get update && apt-get dist-upgrade && rpi-update```

---

#### Créer une image
* [Créer une image pour Raspberry](/build_arm_image_en)

---
***Si vous avez besoin d’aide lors de ces étapes, n’hésitez pas à utiliser les différents [moyens de support](/support_fr).***