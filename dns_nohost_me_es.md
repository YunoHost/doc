# Nombres de dominios automáticos

Para hacer que el auto-alojamiento esté lo más accesible posible, el Proyecto Yunohost provee un servicio de nombres de dominio *ofertos* y *automáticamente configurados*. Cuando utilizas este servicio, no tienes que configurar tú mismo la [configuración de los registros DNS](/dns_config) que es bastante técnica.

Los subdominios siguientes están propuestos :
- `loquequieras.nohost.me` ;
- `loquequieras.noho.st` ;
- `loquequieras.ynh.fr`.

Para aprovechar de este servicio, basta con elegir uno de estos tipos de dominios durante la post-instalación. ¡ Estará automáticamente configurado por Yunohost !

N.B. : Por razones de equidad, sólo puedes tener un *único nombre de dominio* nohost.me por instalación de Yunohost.

### Subdominios

El servicio de dominios `nohost.me`, `noho.st` y `ynh.fr` no permite la creación de subdominios.

Aunque Yunohost permita la instalación de aplicaciones en subdominios (por ejemplo teniendo la aplicación Nextcloud accesible desde la dirección `cloud.midominio.org`), esta función no está permitida con los dominios `nohost.me` y `noho.st` y no es posible tener un subdominio tal como `miaplicacion.midominio.nohost.me`.

Para poder aprovechar de las aplicaciones instalables únicamente a la raíz de un nombre de de dominio, hay que tener su propio nombre de dominio.

### Añadir un dominio nohost.me, noho.st o ynh.fr después de la post-instalación

Si ya has hecho la post-instalación y quieres añadir un dominio de tipo nohost.me, puedes utilizar la categoría "Dominios" de la interfaz web, eligiendo la opción "no tengo nombre de dominio..."

También puedes utilizar los comandos siguientes desde línea de comandos.


```bash
# Añadir el dominio
yunohost domain add loquequieras.nohost.me

# Registrar el dominio en el servicio dyndns
yunohost dyndns subscribe -d loquequieras.nohost.me

# [ esperar ~ 30 segundos ]

# Actualizar la configuración DNS
yunohost dyndns update
```

### Recuperar un dominio nohost.me, noho.st o ynh.fr

Si reinstalas tu servidor y quieres utilizar un dominio automático que ya utilizaste, tienes que pedir una reinstalación del dominio al Proyecto Yunohost [en el hilo de discusión dedicado del foro](https://forum.yunohost.org/t/nohost-domain-recovery/442).

### Cambiar un dominio nohost.me, noho.st o ynh.fr
Si quieres utilizar otro dominio automático en tu servidor, primero tienes que cancelar el que ya está configurado, siguiendo estas instrucciones :
1. Suprimir el dominio de tu instancia (vía webadmin o `yunohost domain remove`). **Cuidado : esto suprimirá todas las aplicaciones instaladas en este dominio así como sus datos**.
2. Pedir la supresión de tu suscripción [en el hilo de discusión dedicado del foro](https://forum.yunohost.org/t/nohost-domain-recovery/442).
3. Suprimir los archivos de configuración automática de tu instancia (únicamente desde la linea de comando por ahora) : `sudo rm /etc/cron.d/yunohost-dyndns && sudo rm -r /etc/yunohost/dyndns`


Luego podrás registrar un nuevo dominio automático. 
