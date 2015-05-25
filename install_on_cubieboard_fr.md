# Installer YunoHost sur Cubieboard

## Prérequis

<img src="https://yunohost.org/images/cubieboard2.png">
<img src="https://yunohost.org/images/micro-sd-card.jpg">

* Une Cubieboard 1, 2 ou une CubieTruck
* Une carte micro-SD de capacité minimale de **8GB** et vitesse **class10** fortement recommandée
* Un autre ordinateur pour parcourir ce guide et accéder à votre Cubieboard
* Un écran et un clavier sont recommandés pour pouvoir contrôler votre Cubieboard si un problème apparaît
* Un [fournisseur d’accès correct](/isp_fr), de préférence avec une bonne vitesse d’upload
* L’**image YunoHost pour Cubieboard**, disponible ici (à **dézipper**) :
  * [Pour Cubieboard 2](http://build.yunohost.org/yunohost-cubieboard-a20-2014-10-14.img.zip)

## Étapes d’installation

<a class="btn btn-lg btn-default" href="/copy_image_fr">1. Copier l’image sur une carte SD</a>

Avant de mettre la carte dans la Cubieboard créer le dossier nginx :
```bash
mkdir media/cubieboard/var/log/ngnix
```

<a class="btn btn-lg btn-default" href="/plug_and_boot_fr">2. Brancher & démarrer</a>

<a class="btn btn-lg btn-default" href="/postinstall_fr">4. Post-installation</a>

---

## Recommandé après la post-installation

* Se connecter en [SSH](ssh_fr) : **root@exemple.tld** (mot de passe : **yunohost**)
* Changer le mot de passe root : ```passwd root``` ou utilisez l’[authentification SSH par clé](security_fr)
* Mettre à jour le système d’exploitation : ```apt-get update && apt-get dist-upgrade && cubian-update```

---

### Créer une image YunoHost pour Cubieboard 1, 2 ou 3
* **[Scripts pour Cubian](https://github.com/M5oul/Yunocubian)**
* Une image Debian 7/8 pour Cubieboard compatible avec YunoHost :
    * [ARMbian](http://www.igorpecovnik.com/2013/12/24/cubietruck-debian-wheezy-sd-card-image/)
    * [Cubian](http://cubian.org/)
    * [Cubieez](http://www.cubieforums.com/index.php?topic=442.0)

---

***Si vous avez besoin d’aide lors de ces étapes, n’hésitez pas à utiliser les différents [moyens de support](/support_fr).***