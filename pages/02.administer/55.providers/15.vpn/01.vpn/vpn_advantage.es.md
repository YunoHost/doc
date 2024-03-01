---
title: Ventajas de una VPN para el autoalojamiento
template: docs
taxonomy:
    category: docs
routes:
  default: '/vpn_advantage'
---

Dado que la instalación de un servidor en casa es una práctica poco habitual, la mayoría de las conexiones a Internet que se proporcionan a los particulares no son adecuadas para este fin. Una VPN de red neutra que proporcione una dirección IPv4 fija y direcciones IPv6 puede ayudar a superar algunas limitaciones o dificultades.

! <b>Advertencia</b>: no todos los proveedores de VPN existentes cumplen estos requisitos, asegúrese de que el que elija los cumpla. 

## Ventajas

### Plug & Play

Configurando una VPN en tu servidor, podrás hacerlo accesible al resto de Internet sin tener que cambiar la configuración del router al que lo conectas. Esto puede ser realmente útil si te vas de vacaciones, te mudas de casa o si tienes un corte de Internet, porque podrás conectarlo fácilmente a una persona de confianza sin tener que configurar el router de la persona que te ayuda.

De la misma manera, te ahorrarás abrir los puertos de tu router, así como evitar el hairpinning.

### Sin microcortes DNS

Si su conexión a Internet no tiene una IP pública fija, se verá obligado a configurar un nombre de dominio dinámico (DNS dinámico). Esto puede ser aceptable, pero el DNS sólo se actualizará a intervalos regulares (cada dos minutos si es un nombre de dominio noho.st o nohost.me). Por lo tanto, existe la posibilidad de que ocasionalmente se produzcan errores de visualización en el navegador, o incluso que se muestre otro sitio (los riesgos se reducen, sin embargo, porque la práctica del autoalojamiento no está muy extendida).

Con una VPN neutra, este problema se sortea porque la VPN puede compararse con una Conexión Virtual a Internet, que tiene su propia dirección IPv4 fija, por lo que no es necesario actualizar el nombre de dominio.

### El caso del correo electrónico

El correo es uno de los protocolos más complejos de autoalojar, normalmente es lo último que autoaloja un usuario. De hecho, es muy fácil encontrarse en una situación en la que los correos electrónicos enviados por el servidor son rechazados por los servidores SMTP de los destinatarios.

Para evitarlo, necesitas, entre otras cosas:

    -configurar el DNS inverso de la conexión a Internet del servidor (o VPN)
    -una IPv4 fija
    -que esta IPv4 sea eliminada de todas las listas negras (en particular, la IP no debe estar en el DUL)
    -poder abrir el puerto 25 (así como otros puertos SMTP)

Desgraciadamente, ninguno de los ISP franceses más habituales respeta todos estos puntos.

Para superar esto, el uso de una VPN que respete estos puntos puede ser una alternativa.

### Confianza

Por último, si no quiere que el contenido de las comunicaciones de su servidor sea espiable por los equipos presentes en la red de su proveedor de servicios de Internet, puede utilizar una VPN para cifrar sus comunicaciones y deportar su confianza a un proveedor de VPN. A modo de recordatorio, desde 2015, el gobierno despliega oficialmente cajas negras en los principales operadores de red cuyo objetivo es espiar todas las comunicaciones digitales francesas para, entre otras cosas, preservar los intereses científicos, económicos e industriales de Francia.

## Desvenjajas
### Coste
Una VPN neutra tiene un coste, ya que el operador que la proporciona debe gestionar un servidor y utilizar el ancho de banda. Los precios de las VPN asociadas a FFDN rondan los 6 euros al mes.

### Enrutamiento de paquetes

Cuando se establece una VPN en el servidor, si no se establece una configuración particular, la transferencia de un archivo desde un ordenador de la red local al servidor que utiliza la VPN, pasará por el extremo de la VPN, es decir, por el servidor del proveedor de la VPN.

Para superar este punto, hay dos soluciones:

    -transformando su servidor en un router y conectando su equipo doméstico a él, este equipo se beneficiará también de la confidencialidad de la VPN.
    -utilizar el servidor de YunoHost como resolvedor de DNS cuando estés en casa, para redirigir los nombres de dominio del servidor a la ip local en lugar de la ip pública. Esta operación puede realizarse en cada dispositivo o en el router (si éste lo permite).
