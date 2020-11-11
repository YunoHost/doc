---
title: Qué es YunoHost?
template: docs
taxonomy:
    category: docs
---

<img src="/images/YunoHost_logo_vertical.png" width=400>

YunoHost es un **sistema operativo** que persigue simplificar la administración de un **servidor** para democratizar el [autoalojamiento](selfhosting), asegurando que se mantiene fiable, seguro, ético y ligero. Es un proyecto de software libre copyleft mantenido exclusivamente por voluntarios. Se puede considerar técnicamente como una distribución basada en [Debian GNU/Linux](https://debian.org) y se puede instalar en [muchos tipos de hardware](install).

## Características

- <img src="/images/icon-debian.png" width=32 style="margin-right:5px"> Basado en Debian ;
- <img src="/images/icon-tools.png" width=32 style="margin-right:5px" width=64> Administra tu servidor mediante un **interfaz web amigable** ;
- <img src="/images/icon-package.png" width=32 style="margin-right:5px"> Despliega **apps en sólo unos pocos clics** ;
- <img src="/images/icon-users.png" width=32 style="margin-right:5px"> Administra **usuarios** <small>(con soporte en LDAP)</small>;
- <img src="/images/icon-globe.png" width=32 style="margin-right:5px"> Administra **nombres de dominio** ;
- <img src="/images/icon-medic.png" width=32 style="margin-right:5px"> Crea y restaura **copias de respaldo** ;
- <img src="/images/icon-door.png" width=32 style="margin-right:5px"> Conecta simultáneamente a todas las apps mediante el **portal del usuario** <small>(NGINX, SSOwat)</small> ;
- <img src="/images/icon-mail.png" width=32 style="margin-right:5px"> Incluye una **instalación completa de correo electrónico** <small>(Postfix, Dovecot, Rspamd, DKIM)</small> ;
- <img src="/images/icon-messaging.png" width=32 style="margin-right:5px"> … así como **un servidor de mensajería instanea** <small>(XMPP)</small> ;
- <img src="/images/icon-lock.png" width=32 style="margin-right:5px"> Administra **certificados SSL** <small>(apoyándose en Let's Encrypt)</small> ;
- <img src="/images/icon-shield.png" width=32 style="margin-right:5px"> … y **sistemas de seguridad** <small>(fail2ban, yunohost-firewall)</small> ;

## Origen

YunoHost se creó en Febrero de 2012 tras algo así:

 <blockquote><p>"¡Mierda, soy muy vago para reconfigurar mi servidor de correo!… Beudbeud, ¿Cómo  hiciste para conectar tu pequeño servidor a LDAP?"</p>
<small>Kload, Febrero de 2012</small></blockquote>

Todo lo que se necesitaba para hacer algo útil era un interfaz de admin para el servidor de Beudbeud, así que Kload decidió desarrollar uno. Finalmente, tras automatizar varias configuraciones y empaquetar algunas apps web, YunoHost v1 quedó terminado.

Notando un entusiasmo creciente alrededor de YunoHost y el autoalojamiento en general, los desarrolladores originales junto con nuevos participantes decidieron comenzar a trabajar en la versión 2, más extensible, potente, fácil de usar, y ya de paso preparar una taza de café de comercio justo para los elfos de Laponia.

El nombre **YunoHost** viene de la jerga "Y U NO Host". El [meme de Internet ](https://en.wikipedia.org/wiki/Internet_meme) debería ilustrarlo:
<div class="text-center"><img style="border-radius: 5px; box-shadow: 0 5px 15px rgba(0,0,0,0.15);" src="/images/dude_yunohost.jpg"></div>

## ¿Qué no es YunoHost?

Incluso aunque YunoHost puede manejar multiples dominios y multiples usuarios, **no está diseñado para ser un sistema mancomunado**.

Primero, el software es demasiado joven, no está probado a gran escala y por tanto probáblemente tampoco suficientemente optimizado para centenares de usuarios a la vez. Dicho esto, no queremos llevar al software en esa dirección. La virtualización se democratiza y se recomienda usarla ya que es un modo más impermeable de lograr mutualización que un sistema "monolítico" como YunoHost.

Puedes alojar a tus amistades, tu familia y a tu compañía con facilidad y seguridad, pero tienes que **confiar en tus usarios**, y sobre todo ellos tienen que confiar en tí. Si aún así quieres proveer servicios YunoHost a desconocidos, creemos que es mejor un VPS por usuario.

## Arte

PNG con el logotipo de YunoHost en blanco y negro por ToZz (400 × 400 px):

<a href="/images/ynh_logo_black_300dpi.png"><img src="/images/ynh_logo_black_300dpi.png" width=220></a>

<a href="/images/ynh_logo_white_300dpi.png"><img src="/images/ynh_logo_white_300dpi.png" width=220></a>

Clic para descargar.

Licencia: CC-BY-SA 4.0
