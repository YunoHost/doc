# Introduction

Instructions d'installation de la brique écrite en temps réel lors de l'AG FFDN 2015, à compléter.

## Réservation VPN

Cette étape est propre à chaque FAI. Récupérez les certificats et/ou mot de passe nécessaire à la connexion du client VPN, ainsi que les directives OpenVPN spécifiques si besoin.

Chez Neutrinet, nous avons par exemple besoin de la directive `topology subnet` (pour la compatibilité Windows \o/).

## Télécharger l'image

Sur http://repo.labriqueinter.net/ 
(prendre la latest http://repo.labriqueinter.net/labriqueinternet_latest.img.tar.gz

Faire un `dd` de l'image sur la carte SD a destination:

```
sudo dd if=labriqueinternet_latest.img of=/dev/sdX
```

Mettre la carte SD dans la boite, puis la lancer et l'ayant branché sur le réseau locale avec un calbe ethernet.

## Post-configuration

Ensuite, aller sur <code>yunohost.local</code> ou l'ip en ssh et mettre à jours les pkgs.

* user: root
* password: olinux

    apt-get update && apt-get dist-upgrade


Puis y aller en http et accepter le certificat auto signé, puis suivre les instructions de [post install](https://yunohost.org/#/postinstall)

    choisir le nom de domaine

    choisir un mot de passe administrateur


Vous êtes redirigé sur l'interface d'admin et là, faire un nouvel utilisateur avec son mot de passe et co.

Puis, installer les applications ("applications -> installer" et tout en bas foutre l'url vers le répo git):

    hotspot https://github.com/labriqueinternet/hotspot_ynh

    vpnclient https://github.com/labriqueinternet/vpnclient_ynh

    torclient https://github.com/labriqueinternet/torclient_ynh

    piratebox https://github.com/labriqueinternet/piratebox_ynh


Ensuite, aller sur http://monurl.com/vpnadmin (ou ce que vous avez choisi). Là:

    (pour neutrinet) foutre vpn.neutrinet.be

    copier/coller la conf généré pour le vpn dans l'endroit "advanced"

    (pour l'instant pas configurer l'ipv6 pour neutrinet, le script doit être fini pour l'obtenir ou aller le chercher sur https://vpn.neutrinet.be:8000)

    scp auth client.crt client.key ca.crt dans /etc/openvpn/

