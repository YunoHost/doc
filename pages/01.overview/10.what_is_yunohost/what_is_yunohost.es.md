---
title: Qué es YunoHost?
template: docs
taxonomy:
    category: docs
routes:
  default: '/whatsyunohost'
---

![](image://YunoHost_logo_vertical.png?resize=400&id=ynhlogo)

YunoHost es un **sistema operativo** que persigue simplificar la administración de un **servidor** para democratizar el [autoalojamiento](/selfhosting), asegurando que se mantiene fiable, seguro, ético y ligero. Es un proyecto de software libre mantenido exclusivamente por voluntariado. Técnicamente se le puede considerar como una distribución basada en [Debian GNU/Linux](https://debian.org) y que puede ser instalado en [muchos tipos de material](/install).

## Características

- ![](image://icon-debian.png?resize=32&classes=inline) Basado en Debian ;
- ![](image://icon-tools.png?resize=32&classes=inline) Administración mediante un **interfaz web simple y conciso** ;
- ![](image://icon-package.png?resize=32&classes=inline) Despliega las **aplicaciones en unos pocos clics** ;
- ![](image://icon-users.png?resize=32&classes=inline) añade **cuentas de usuario** <small>(gestionados por una agenda LDAP)</small>;
- ![](image://icon-globe.png?resize=32&classes=inline) Administra los **nombres de dominio** ;
- ![](image://icon-medic.png?resize=32&classes=inline) Crea y restaura las **copias de seguridad** ;
- ![](image://icon-door.png?resize=32&classes=inline) Conecta simultáneamente a todas las aplicaciones mediante un **portal de usuario** <small>(NGINX, SSOwat)</small> ;
- ![](image://icon-mail.png?resize=32&classes=inline) Incluye un **servidor de correo electrónico completo** <small>(Postfix, Dovecot, Rspamd, DKIM)</small> ;
- ![](image://icon-messaging.png?resize=32&classes=inline) … así como un **servidor de mensajería instanea** <small>(XMPP)</small> ;
- ![](image://icon-lock.png?resize=32&classes=inline) Administra **certificados SSL** <small>(generados por Let's Encrypt)</small> ;
- ![](image://icon-shield.png?resize=32&classes=inline) … y los **sistemas de seguridad** <small>(fail2ban, yunohost-firewall)</small> ;

## Origen

YunoHost se creó en Febrero de 2012 tras algo así:

 <blockquote><p>"¡Mierda, soy muy vago para reconfigurar mi servidor de correo!… Beudbeud, ¿Cómo  hiciste para conectar tu pequeño servidor a LDAP?"</p>
<small>Kload, Febrero de 2012</small></blockquote>

Lo único que necesitaba era un interfaz de administración para el servidor de Beudbeud para tener algo usable, así que Kload decidió desarrollar uno. Finalmente, tras automatizar varias configuraciones y empaquetar algunas aplicaciones web, YunoHost v1 quedó terminado.

Notando un entusiasmo creciente alrededor de YunoHost y del autoalojamiento en general, los desarrolladores originales junto con nuevas personas contribuyentes decidieron comenzar a trabajar en la versión 2, una versión más extensible, más potente, más fácil de usar, y ya de paso, una que prepare ricas tazas de café de comercio justo para los elfos de Laponia.

El nombre **YunoHost** viene de la jerga "Y U NO Host". El [meme de Internet ](https://en.wikipedia.org/wiki/Internet_meme) debería ilustrarlo:
![](image://dude_yunohost.jpg)

## ¿Qué no es YunoHost?

Incluso aunque YunoHost puede manejar multiples dominios y multiples usuarios, **no está diseñado para ser un sistema mancomunado**.

Primero, porque el software es demasiado joven, no está probado ni optimizado para ser usado por cientos de usuarios simultáneamente. Y además no es el camino que deseamos hacer recorrer a YunoHost. La virtualización se democratiza y es una manera mucho más estanca y segura de hacer mancomunados.

Puedes alojar a tus amistades, tu familia y a tu compañía sin problema, pero debes **confiar en las personas usarias** de la misma manera que esas personas deben confiar en tí. Si aún así quieres proveer servicios YunoHost a desconocidos, **un VPS por usuario** será la mejor solución.

## Logo

Logo YunoHost en blanco y negro por ToZz (400 × 400 px):

![](image://ynh_logo_black_300dpi.png?resize=220)
![](image://ynh_logo_white_300dpi.png?resize=220&id=whitelogo)

Licencia: CC-BY-SA 4.0
