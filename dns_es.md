# DNS : sistema de nombre de dominios

La configuración de los DNS es una etapa crucial para que tu servidor esté accesible. En efecto, si tus DNS están mal configurados, con mucha certeza tendrás problemas de conexión a tu servidor vía tu nombre de dominio.

*Aunque esta etapa de documentación parezca larga y compleja, sigue siendo muy importante si quieres entender correctamente las implicaciones de la denominación en Internet vía los nombres de dominio, que son necesarios para el funcionamiento de tu servidor Yunohost.*

### ¿ Qué es ?

DNS significa « Domain Name Server » en inglés, y está frecuentemente empleado para designar la configuración de tus nombres de dominio. Tu nombre de dominio debe apuntar hacia algo (en general, una dirección IP).

**Por ejemplo** : `yunohost.org` apunta hacia `88.191.153.110`.

Este sistema fue creado para poder memorizar más fácilmente las direcciones de servidores. Existen registros DNS en los cuales hay que apuntarse. Esto se hace con **registrars** que te alquilarán estos nombres de dominio a cambio de cierto importe (entre 5 y algunas centenas de euros). Estos [registrars](registrar) son entidades privadas autorizadas por el [ICANN](https://es.wikipedia.org/wiki/Corporaci%C3%B3n_de_Internet_para_la_Asignaci%C3%B3n_de_Nombres_y_N%C3%BAmeros), tales como [Gandi](http://gandi.net), [OVH](http://ovh.com) o [BookMyName](http://bookmyname.com).

Es importante notar que los subdominios no necesariamente apuntan al dominio principal.

Si `yunohost.org` apunta hacia `88.191.153.110`, no quiere decir que  `backup.yunohost.org` apunte hacia la misma IP. Tienes que configurar **todos** los dominios y subdominios que deseas utilizar.

También existen **tipos** de registros DNS, lo que significa que un dominio puede apuntar hacia otra cosa que una dirección IP.

**Por ejemplo** : `www.yunohost.org` apunta hacia `yunohost.org`


### ¿ Cómo (bien) hacer la configuración ?

Tienes varias opciones. Nota que puedes cumular estas soluciones si posees varios dominios : por ejemplo, puedes tener `mi-servidor.nohost.me` utilizando la solución **1.**, et `mi-servidor.org` utilizando la solución **2.**, redirigiéndolos hacia el mismo servidor YunoHost.

1. Puedes utilizar [el servicio DNS de YunoHost](/dns_nohost_me_es), que configurará él mismo los DNS de tu instancia YunoHost. Pero en este caso, tienes que elegir un dominio terminando por `.nohost.me`, `.noho.st` o `.ynh.fr`, lo que puede tener inconvenientes (tendrás direcciones email tales como `juan@mi-servidor.noho.st`).
**Es el método recomendado si estás debutando.**

2. Puedes utilizar el servicio de DNS de tu  **registrar** (Gandi, OVH, BookMyName u otro) para configurar tus nombres de dominio. Ésta es la [configuración DNS estándar](/dns_config_es). También es posible utilizar una redirección DNS local, más información sobre cómo [Acceder a su servidor desde la red local](/dns_local_network_es).
También puedes consultar las documentaciones específicas a estas varias [oficinas de registro](/registrar_es) : [Gandi](http://gandi.net), [OVH](/OVH_fr) o [BookMyName](http://bookmyname.com).

**Atención** : Si eliges este modo de funcionamiento, tendrás más flexibilidad, pero nada será automático. Por ejemplo si quieres utilizar `webmail.mi-servidor.org`, tendrás que añadirlo manualmente en la interfaz de tu registrar.

3. Tu instancia tiene un servicio DNS, lo que quiere decir que configura automáticamente sus registros DNS y que es posible delegarle la administración de estos registros. Por eso, tienes que indicar al **registrar** que es tu instancia Yunohost que es el servidor DNS de tu nombre de dominio creando un registro glue (a menudo denominado **glue record**) apuntando hacia la IP de tu instancia Yunohost.
<br><br>**Atención** : Si eliges este modo de funcionamiento, todas las configuraciones serán automatizadas, tendrás mucha flexibilidad pero la pérdida de tu servidor potencialmente traerá muchos problemas. **Elige este método si estás muy seguro de los que estás haciendo.**

4. Una vez que tu servicio DNS está operacional, tu servidor puede utilizarlo pero hay que configurarlo, es el [revolvedor DNS](/dns_resolver_es).

### IP Dinámica
Si la dirección IP pública cambia, sigue este [tutorial](dns_dynamicip_es).
