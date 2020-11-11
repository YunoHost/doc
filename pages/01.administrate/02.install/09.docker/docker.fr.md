---
title: Docker et YunoHost
template: docs
taxonomy:
    category: docs
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

  * AMD64 (classique)
    * https://hub.docker.com/r/domainelibre/yunohost/ (YunoHost v4+)
  * I386 (anciens pc)
    * https://hub.docker.com/r/domainelibre/yunohost-i386/ (YunoHost v4+)
  * ARMV7 (Raspberry Pi 2/3 ...)
    * https://hub.docker.com/r/domainelibre/yunohost-arm/ (YunoHost v4+)
  * ARMV6 (Raspberry Pi 1)
    * https://hub.docker.com/r/tuxalex/yunohost-armv6/ (ancienne version de YunoHost)
