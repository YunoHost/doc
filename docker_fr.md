# Docker et YunoHost

<div class="alert alert-danger">
<b>
Yunohost ne supporte plus officiellement Docker depuis les problèmes rencontrés avec la version 2.4+.
En cause, YunoHost dépend désormait de systemd et docker a décidé qu'ils ne le
supporteraient pas nativement (et il y a d'autres problèmes liés au firewall et aux
services).
</b>
</div>

## Images communautaires

Cependant il existe des images communautaires disponibles sur Docker Hub :

  * AMD64 (classique)
    * https://hub.docker.com/r/domainelibre/yunohost3/ (Yunohost v3)
  * I386 (anciens pc)
    * https://hub.docker.com/r/domainelibre/yunohost3-i386/ (Yunohost v3)
  * ARMV7 (raspberry pi 2/3 ...)
    * https://hub.docker.com/r/domainelibre/yunohost3-arm/ (Yunohost v3)
  * ARMV6 (raspberry pi 1)
    * https://hub.docker.com/r/tuxalex/yunohost-armv6/ (ancienne version de Yunohost)
