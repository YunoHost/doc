# Configurar la redirección de los puertos

Si te estás auto-alojando en casa y sin VPN, tienes que redirigirse los puertos de tu router (caja/box). Si quieres una explicación sencilla de lo que es y por qué necesitas redirigir los puertos, puedes echar un vistazo a [esta página](port_forwarding_es). [Esta página](https://www.testdevelocidad.es/configuraciones/abrir-correctamente-los-puertos-router/) también propone explicaciones detalladas sobre el funcionamiento de los puertos, y las etapas de configuración para un router genérico.

### 0. Diagnosticar los puertos abiertos

Una vez que tienes la redirección configurada, deberías poder comprobar que los puertos están bien abiertos con esta herramienta : 

<a class="btn btn-default" href="http://ports.yunohost.org">Comprobar la redirección de los puertos</a>

### 1. Acceder a la interfaz de administración de tu router/caja/box

En general la interfaz de administración está accesible desde http://192.168.0.1 o http://192.168.1.1. 
Luego, es posible que tengas que autenticarte con los ID provechos pour tu proveedor de acceso a Internet.

### 2. Descubrir la IP local del servidor

Identifica cuál es la IP local de tu servidor, o sea :
- desde la interfaz de tu router/caja/box, donde tal vez estén listados los dipositivos conectados a la red local
- desde la webadmin de YunoHost, en 'Estado del servidor', 'Red'
- desde la línea de comandos en tu servidor, por ejemplo con `ip a | grep "scope global" | awk '{print $2}'`

En general una dirección IP local se parece a `192.168.xx.yy`, o `10.0.xx.yy`.

### 3. Redirigir los puertos

En la interfaz de administración de tu router/caja/box, tienes que encontrar una categoría que debe llamarse 'Configuración del router', o 'Redirección de puertos'. El nombre difiere según el tipo o la marca del router / de la caja Internet...

Luego tienes que redirigir cada uno de los puertos listados a continuación hacia la IP local de tu router para que los varios servicios de Yunohost funcionen. Para cada uno de ellos, una redirección 'TCP' es necesaria. En algunas interfaces, tal vez encontrarás referencias a un puerto 'externo' y un puerto 'interno' : en nuestro caso, se trata del mismo número de puerto, que sea interno o externo.

* Web: 80 <small>(HTTP)</small>, 443 <small>(HTTPS)</small>
* [SSH](/ssh_es): 22
* [XMPP](/XMPP_es): 5222 <small>(clients)</small>, 5269 <small>(servers)</small>
* [Email](/email_es): 25, 587 <small>(SMTP)</small>, 993 <small>(IMAP)</small>

<div class="alert alert-warning" markdown="1">
<span class="glyphicon glyphicon-warning-sign"></span> Algunos proveedores de acceso a Internet bloquean el puerto 25 (mail SMTP) por defecto para luchar con el spam. Otros (más escasos) no permiten utilizar libremente los puertos 80/443. Dependiendo de tu proveedor, puede ser posible de abrir estos puertos en la interfaz... Ver [esta página](isp_es) por más informaciones.
</div>

## Redirección automática / UPnP

Una tecnología llamada UPnP está disponible en algunos routers/cajas/box y permite redirigir automáticamente puertos hacia una máquina que lo pide. Si UPnP está activado en tu casa, ejecutar este comando debería automáticamente redirigir los puertos correctos :


```bash
sudo yunohost firewall reload
```

