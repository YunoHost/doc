# Installer YunoHost sur carte ARM

## Prérequis

<img src="/images/cubieboard2.png">
<img src="/images/micro-sd-card.jpg">

* Une carte ARM avec un processeur de 500 MHz et 512 Mo de mémoire vive.
* Une carte micro SD de capacité minimale de **4 GB** et de vitesse **class10**.
* Un [fournisseur d’accès correct](/isp_fr), de préférence avec une bonne vitesse d’upload.

## Installation

* Télécharger la dernière **[image d’ARMbian Jessie pour la carte ARM](http://www.armbian.com/download)**.

<a class="btn btn-lg btn-default" href="/copy_image_fr">Copier l’image sur une carte SD</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot_fr">Brancher & démarrer</a>

* Se connecter en [SSH](ssh_fr) : **root@exemple.tld/adresse_ip** avec le mot de passe : **1234**.

<a class="btn btn-lg btn-default" href="/install_manually_fr">Installation de YunoHost</a>

<a class="btn btn-lg btn-default" href="/postinstall_fr">Post-installation</a>

---

#### Recommandé après la post-installation
* Utilisez l’[authentification SSH par clé](security_fr)

---

#### Créer une image
* [Créer une image pour la carte ARM](build_arm_image_en)

---

***Si vous avez besoin d’aide lors de ces étapes, n’hésitez pas à utiliser les différents [moyens de support](/support_fr).***
