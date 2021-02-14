---
title: Qué es YunoHost?
template: docs
taxonomy:
    category: docs
routes:
  default: '/whatsyunohost'
---

![](image://YunoHost_logo_vertical.png?resize=400&id=ynhlogo)

YunoHost es un **sistema operativo** que persigue simplificar la administración de un **servidor** para democratizar el [autoalojamiento](/selfhosting), asegurando que se mantiene fiable, seguro, ético y ligero. Es un proyecto de software libre copyleft mantenido exclusivamente por voluntarios. Se puede considerar técnicamente como una distribución basada en [Debian GNU/Linux](https://debian.org) y se puede instalar en [muchos tipos de hardware](/install).

## Características

- ![](image://icon-debian.png?resize=32&classes=inline) Basado en Debian ;
- ![](image://icon-tools.png?resize=32&classes=inline) Administra tu servidor mediante un **interfaz web amigable** ;
- ![](image://icon-package.png?resize=32&classes=inline) Despliega **apps en sólo unos pocos clics** ;
- ![](image://icon-users.png?resize=32&classes=inline) Administra **usuarios** <small>(con soporte en LDAP)</small>;
- ![](image://icon-globe.png?resize=32&classes=inline) Administra **nombres de dominio** ;
- ![](image://icon-medic.png?resize=32&classes=inline) Crea y restaura **copias de respaldo** ;
- ![](image://icon-door.png?resize=32&classes=inline) Conecta simultáneamente a todas las apps mediante el **portal del usuario** <small>(NGINX, SSOwat)</small> ;
- ![](image://icon-mail.png?resize=32&classes=inline) Incluye una **instalación completa de correo electrónico** <small>(Postfix, Dovecot, Rspamd, DKIM)</small> ;
- ![](image://icon-messaging.png?resize=32&classes=inline) … así como **un servidor de mensajería instanea** <small>(XMPP)</small> ;
- ![](image://icon-lock.png?resize=32&classes=inline) Administra **certificados SSL** <small>(apoyándose en Let's Encrypt)</small> ;
- ![](image://icon-shield.png?resize=32&classes=inline) … y **sistemas de seguridad** <small>(fail2ban, yunohost-firewall)</small> ;

## Origen

YunoHost se creó en Febrero de 2012 tras algo así:

 <blockquote><p>"¡Mierda, soy muy vago para reconfigurar mi servidor de correo!… Beudbeud, ¿Cómo  hiciste para conectar tu pequeño servidor a LDAP?"</p>
<small>Kload, Febrero de 2012</small></blockquote>

Todo lo que se necesitaba para hacer algo útil era un interfaz de admin para el servidor de Beudbeud, así que Kload decidió desarrollar uno. Finalmente, tras automatizar varias configuraciones y empaquetar algunas apps web, YunoHost v1 quedó terminado.

Notando un entusiasmo creciente alrededor de YunoHost y el autoalojamiento en general, los desarrolladores originales junto con nuevos participantes decidieron comenzar a trabajar en la versión 2, más extensible, potente, fácil de usar, y ya de paso preparar una taza de café de comercio justo para los elfos de Laponia.

El nombre **YunoHost** viene de la jerga "Y U NO Host". El [meme de Internet ](https://en.wikipedia.org/wiki/Internet_meme) debería ilustrarlo:
![](image://dude_yunohost.jpg)

## ¿Qué no es YunoHost?

Incluso aunque YunoHost puede manejar multiples dominios y multiples usuarios, **no está diseñado para ser un sistema mancomunado**.

Primero, el software es demasiado joven, no está probado a gran escala y por tanto probáblemente tampoco suficientemente optimizado para centenares de usuarios a la vez. Dicho esto, no queremos llevar al software en esa dirección. La virtualización se democratiza y se recomienda usarla ya que es un modo más impermeable de lograr mutualización que un sistema "monolítico" como YunoHost.

Puedes alojar a tus amistades, tu familia y a tu compañía con facilidad y seguridad, pero tienes que **confiar en tus usarios**, y sobre todo ellos tienen que confiar en tí. Si aún así quieres proveer servicios YunoHost a desconocidos, creemos que es mejor un VPS por usuario.

## Arte

PNG con el logotipo de YunoHost en blanco y negro por ToZz (400 × 400 px):

![](image://ynh_logo_black_300dpi.png?resize=220)
![](image://ynh_logo_white_300dpi.png?resize=220&id=whitelogo)

Licencia: CC-BY-SA 4.0
