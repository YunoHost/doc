# Installer YunoHost sur Raspberry Pi

*Toutes les autres façons d'installer YunoHost sont listées **[ici](/install_fr)**.*

## Prérequis
<img src="https://yunohost.org/images/Raspberry_Pi_2_Model_B_v1.1_front_angle_new.jpg" width=350>
<img src="https://yunohost.org/images/micro-sd-card.jpg">

* Un Raspberry Pi 1 (ou 2 mais pas encore disponible pour le moment)
* Une carte SD de capacité minimale de **4Go** et une certification de vitesse **class10** sont recommandées
* Un autre ordinateur pour parcourir ce guide et accéder à votre Raspberry Pi
* Un écran et un clavier sont recommandés pour pouvoir contrôler votre Raspberry Pi si un problème apparaît
* Un [fournisseur d'accès correct](/isp_fr), de préférence avec une bonne vitesse d'upload
* L’**image YunoHost pour Raspberry Pi 1**, disponible ici (à **dézipper**) :

    [http://build.yunohost.org/yunohost-raspberrypi-2014-09-17.zip](http://build.yunohost.org/yunohost-raspberrypi-2014-09-17.zip)

    <div class="alert alert-warning">
    <b>Attention :</b> la configuration réseau par défaut configure l'interface nommée *eth0* en DHCP. Il se peut que vous ayez à changer cette configuration pour que votre Raspberry Pi puisse se connecter à votre réseau si l'interface porte un autre nom. Pour ce faire :
    <ul>
    <li>Connectez-vous localement à votre Raspberry Pi</li>
    <li>Repérez le nom de votre interface réseau : `$ ip link` (*lo* correspondant à l'interface de rebouclage, cela peut-être *eth1* par exemple)</li>
    <li>Éditez le fichier de configuration `/etc/network/interfaces` et remplacez *eth0* par le nom de votre interface</li>
    <li>Redémarrez le service réseau : `sudo service networking restart`</li>
    </ul>
    </div>

---

## Étapes d'installation

<a class="btn btn-lg btn-default" href="/copy_image_fr">1. Copier l'image sur une carte SD</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot_fr">2. Brancher & démarrer</a>

<a class="btn btn-lg btn-default" href="/postinstall_fr">3. Post-installation</a>

---

### Recommandé après la post-installation

* Se connecter en ssh : **root@yunohost.local** (mot de passe : **yunohost**)
* Changer le mot de passe root : ```passwd root``` ou utiliser l’[authentification SSH par clé](security_fr)

* Mettre à jour le système d’exploitation : ```apt-get update && apt-get dist-upgrade && rpi-update```

---
***Si vous avez besoin d'aide lors de ces étapes, n'hésitez pas à utiliser les différents [moyens de support](/support_fr).***


