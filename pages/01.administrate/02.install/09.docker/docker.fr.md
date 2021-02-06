---
title: Docker et YunoHost
template: docs
taxonomy:
    category: docs
routes:
  default: '/docker'
---

<div class="alert alert-danger">
<b>
YunoHost ne supporte plus officiellement Docker depuis les problèmes rencontrés avec la version 2.4+.
En cause, YunoHost dépend désormait de systemd et docker a décidé qu’ils ne le
supporteraient pas nativement (et il y a d'autres problèmes liés au firewall et aux
services).
</b>
</div>

## Images communautaires

Cependant il existe des images communautaires disponibles sur Docker Hub :

  * [AMD64 (classique) (YunoHost v4+)](https://hub.docker.com/r/domainelibre/yunohost/)
  * [I386 (anciens pc) (YunoHost v4+)](https://hub.docker.com/r/domainelibre/yunohost-i386/)
  * [ARMV7 (Raspberry Pi 2/3 ...) (YunoHost v4+)](https://hub.docker.com/r/domainelibre/yunohost-arm/)
  * [ARMV6 (Raspberry Pi 1) (ancienne version de YunoHost)](https://hub.docker.com/r/tuxalex/yunohost-armv6/)
