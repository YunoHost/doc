---
title: Pi-hole
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_pihole'
---

![logo de Pi-hole](image://pihole_logo.png)

[![Installer Pi-hole avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=pihole)[![Niveau d'intégration](https://dash.yunohost.org/integration/pihole.svg)](https://dash.yunohost.org/appci/app/pihole)

- [Utiliser Pi-Hole comme serveur DHCP](#utiliser-pi-hole-comme-serveur-dhcp)
  - [Configurer Pi-Hole](#configurer-pi-hole)
  - [Configurer mon routeur](#configurer-mon-routeur)
  - [Restaurer le réseau](#restaurer-le-réseau)
- [Liens utiles](#liens-utiles)

Pi-hole est un bloqueur de publicité au niveau du réseau qui agit comme un DNS menteur et éventuellement un serveur DHCP3, destiné à être utilisé sur un réseau privé. Il est conçu pour être installé sur des périphériques intégrés dotés de capacités réseau, tels que le Raspberry Pi, mais il peut être utilisé sur d'autres machines exécutant GNU/Linux ou dans des environnements virtualisés.

## Utiliser Pi-Hole comme serveur DHCP

> **Attention, vous devez savoir que toucher à votre DHCP pourrait casser votre réseau.
Dans le cas où votre serveur serait inaccessible, vous perdriez votre résolution dns et votre adresse IP.
Ainsi, vous perdriez toute connexion à internet et même la connexion à votre routeur.**

> **Si vous rencontrez ce genre de problèmes, merci de lire la section "Comment restaurer mon réseau".**

### Configurer Pi-hole

Il y a 2 manière de configurer Pi-hole pour qu'il soit utilisé comme votre serveur DHCP.
- Soit vous pouvez choisir de l'utiliser lorsque vous installez l'application.
- Soit vous pouvez activer le serveur DHCP par la suite dans l'onglet "Settings", partie "Pi-hole DHCP Server".
Dans ce second cas, il peut être préférable de forcer l'ip du serveur à une adresse statique.

### Configurer mon routeur

Votre routeur ou celui de votre FAI dispose d'un serveur DHCP activé par défaut.
Si vous gardez ce DHCP, en même temps que celui de Pi-hole, vous allez avoir des conflits transparents entre eux.
Le premier serveur DHCP à répondre va distribuer ses propres ip et paramètres.
Donc vous devez éteindre le serveur DHCP de votre routeur et laisser Pi-hole gérer votre réseau.

#### Pourquoi je devrais utiliser le DHCP de Pi-hole ?

En utilisant le DHCP de Pi-hole, vous lui permettez de donner sa configuration dns à chacun de vos clients. De cette manière, chaque requête sera filtrée par Pi-hole.

Un autre cas d'usage du DHCP de Pi-hole est le cas où vous rencontrez des problèmes de hairpinning (Vous ne pouvez pas vous connecter à votre serveur parce que son ip est votre ip publique, et votre routeur n'autorise pas cela).
Dans ce cas, utilisez le dns de Pi-hole va vous permettre de vous connecter à votre serveur par son adresse locale plutôt que son adresse publique.

### Restaurer le réseau

> Oups !
Votre serveur Pi-hole est tombé, et vous n'avez plus de DHCP.
Ne paniquez pas, on va surmonter ça \o/

Utilisez votre terminal favori sur votre ordinateur de bureau.
Et tout d'abord, récupérer votre interface réseau (Le plus souvent `eth0`).
``` bash
sudo ifconfig
```

Ensuite, changer votre ip pour une ip statique.
``` bash
sudo ifconfig eth0 192.168.1.100
```

Maintenant, vous pouvez vous connecter à votre routeur et rallumer son serveur DHCP pour l'utiliser à nouveau.
Vous pouvez maintenant retirer votre ip statique et réobtenir une ip dynamique.
``` bash
sudo ifconfig eth0 0.0.0.0 && sudo dhclient eth0
```

> N'oubliez pas d'éteindre le DHCP de votre routeur si votre serveur fonctionne à nouveau.

## Liens utiles

 + Site web : [pi-hole.net (en)](https://pi-hole.net)
 + Documentation officielle : [docs.pi-hole.net (en)](https://docs.pi-hole.net/)
 + Dépôt logiciel de l'application : [github.com - YunoHost-Apps/pihole](https://github.com/YunoHost-Apps/pihole_ynh)
 + Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/pihole/issues](https://github.com/YunoHost-Apps/pihole_ynh/issues)
 
