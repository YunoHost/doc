# Post-instalación

La etapa que llamamos « **post-instalación** » de hecho es la etapa de configuración inicial de Yunohost. Se ejecuta después de la **instalación** del sistema mismo.

### Vía la interfaz web

Puedes acceder a la post-instalación gráfica entrando en un navegador web :
* la dirección **IP local de tu servidor** si éste está conectado a tu red local (en general `192.168.x.x`, ver ['Encontrar mi IP' en la página sobre SSH](/ssh))
* la dirección **IP pública de tu servidor** si éste no está conectado a tu red local (por ejemplo, si es un VPS, tu proveedor debería haberte transmitido la dirección IP).

Durante la primera visita, encontrarás muy probablemente una advertencia de seguridad relacionada al certificado utilizado. De momento, tu servidor utiliza un certificado autofirmado. Después, podrás utilizar un certificado automáticamente reconocido por los navegadores como descrito en la página sobre los [Certificados](/certificate). Mientras tanto, añade una excepción de seguridad para aceptar el certificado vigente.

Luego, llegas en esta página :

<img style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);" src="/images/postinstall_web.png">

*<p class="text-muted">Vistazo de la post-instalación Web</p>*

### Vía la interfaz de línea de comando

También puedes acceder a la post-instalación entrando el comando `yunohost tools postinstall` directamente en el servidor o [en SSH](/ssh).

<img style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);" src="/images/postinstall_cli.png">

*<p class="text-muted">Vistazo de la post-instalación con línea de comando</p>*

## Informaciones solicitadas

### Dominio principal

Es el nombre de dominio que permitirá el acceso a tu servidor así como al portal de autenticación de los usuarios. Entonces estará **visible por todo el mundo** : elígelo en consecuencia.

* YunoHost te propone un DNS dinámico, proveando nombres de dominio del tipo *midominio.nohost.me*, *midominio.noho.st* o *midominio.ynh.fr*. Si no posees un nombre de dominio y/o que quieres aprovechar de este servicio, elige un dominio terminando con `.nohost.me`, `.noho.st` o `.ynh.fr`. Si no está utlizado ya, el dominio automáticamente estará vinculado a tu servidor Yunohost, y no tendrás más etapas de configuración.

* Si, en cambio, dominas la noción de **DNS**, puedes utilizar tu propio nombre de dominio. En este caso, refiérete a la página [yunohost.org/dns](/dns_es) por más información.

* Si no tienes nombre de dominio y que no quieres uno que acabe con *.nohost.me*, *.noho.st* ou *.ynh.fr*, puedes utilizar un dominio local. Más información sobre cómo [acceder a tu servidor desde la red local](/dns_local_network_es).


### Contraseña de administración

Es la contraseña que permitirá acceder a la [interfaz de administración](/admin_es) de tu servidor. También podrás utilizarla para conectarte remotamente vía **SSH**, o vía  **SFTP** para transferir archivos.

De manera general, ésta es la **llave de entrada en tu sistema**, pues piensa en **[elegirla atentamente](https://es.wikihow.com/escoger-una-contrase%C3%B1a-segura)**.

<br>

---

## Enhorabuena !

Si llegas aquí después de haber visto “Yunohost fue instalado con éxito" desde tu navegador ou tu interfaz de línea de comando, pues felicitaciones !


### ¿ Y ahora ?

- Si te auto-alojas en casa y sin VPN, tienes que asegurarte que [los puertos de tu caja internet estén redirigidos](isp_box_config_es) ;
- Si utilizas tu propio nombre de dominio (i.e. que no sea un nohost.me /
  noho.st), tienes que [configurar el nombre de dominio según la configuración recomendada](dns_config_es) ;
- Si no puedes configurar el nombre de dominio de momento (porque todavía no lo has comprado, ou porque es un dominio test), puedes solucionar temporalmente el problema con las instrucciones del último párrafo [aquí](dns_local_network_es) ;
- No te asustes demasiado por [la advertencia a propósito del certificado](certificate_es), tendrás la posibilidad de obtener un certificado Let's Encrypt :).
- Echa un vistazo a las [aplicaciones disponibles](apps_es) !

