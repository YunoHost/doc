# Docker and YunoHost

<div class="alert alert-danger">
<b>
Yunohost doesn't support Docker officially since issues with versions 2.4+.
In question, YunoHost 2.4+ doesn't work anymore on Docker
because YunoHost requires systemd and Docker has chosen to not support it natively (and
there are other problems link to the firewall and services).
</b>
</div>

## Community images

However, community images exist and are available on Docker Hub :

  * AMD64 (classic)
    * https://hub.docker.com/r/domainelibre/yunohost3/ (Yunohost v3)
  * I386 (old computers)
    * https://hub.docker.com/r/domainelibre/yunohost3-i386/ (Yunohost v3)
  * ARMV7 (raspberry pi 2/3 ...)
    * https://hub.docker.com/r/domainelibre/yunohost3-arm/ (Yunohost v3)
  * ARMV6 (raspberry pi 1)
    * https://hub.docker.com/r/tuxalex/yunohost-armv6/ (old yunohost version)
