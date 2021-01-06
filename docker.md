# Docker and YunoHost

<div class="alert alert-danger">
<b>
YunoHost doesn’t support Docker officially since issues with versions 2.4+.
In question, YunoHost 2.4+ doesn’t work anymore on Docker
because YunoHost requires systemd and Docker has chosen to not support it natively (and
there are other problems link to the firewall and services).
</b>
</div>

## Community images

However, community images exist and are available on Docker Hub:

  * AMD64 (classic)
    * https://hub.docker.com/r/domainelibre/yunohost/ (YunoHost v4+)
  * I386 (old computers)
    * https://hub.docker.com/r/domainelibre/yunohost-i386/ (YunoHost v4+)
  * ARMV7 (Raspberry Pi 2/3 ...)
    * https://hub.docker.com/r/domainelibre/yunohost-arm/ (YunoHost v4+)
  * ARMV6 (Raspberry Pi 1)
    * https://hub.docker.com/r/tuxalex/yunohost-armv6/ (old yunoHost version)
