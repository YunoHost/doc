Emails
======

YunoHost integra un ecosistema completo de servidor mail, permitiéndote de alojar tu propia mensajería electrónica, y pues de tener tus propias direcciones email en `algo@tu.dominio.tld`.

Este ecosistema comprende un servidor SMTP (postfix), un servidor IMAP (Dovecot), un antispam (rspamd) y una configuración DKIM.

Asegurarse de que la configuración esté correcta
-------------------------------

Los emails son un ecosistema complicado y una multitud de detalles puedes impedir que funcionen correctamente.

Para validar que tu configuración es correcta :
- si te alojas en casa y que no tienes VPN, asegúrate de que [tu proveedor de Internet no esté bloqueando el puerto 25](isp_es) ;
- redirige los puertos siguiendo [esta documentación](isp_box_config_es) ;
- configura con cuidado los registros DNS del correo electrónico siguiendo [esta documentación](dns_config_es) ;
- testa tu configuración utilizando [Mail-tester.com](https://mail-tester.com) <small>(cuidado : sólo 3 tests por dominio y por día están autorizados)</small> ;

Una nota de al menos 8~9/10 es un objetivo razonable.

Clientes de mensajería 
-------------

Para interactuar con el servidor de mail, o sea leer y mandar emails, puedes instalar un cliente web como Roundcube o Rainloop en tu servidor - o configurar un cliente de Desktop o móvil como descrito en [esta página][cette page](email_configure_client_es).

Los clientes Desktop o móvil tienen la ventaja de copiar tu emails en el equipo, así permitiendo la consulta desconectada de tus mensajes, y cierta protección frente a la posibilidad de un servidor averiado.

Configuration de los aliases de mensajeras y de las redirecciones automáticas 
-------------------------------------------

Aliases de mensajeras y redirecciones pueden ser configurados por cada usuario. Por ejemplo, el primer usuario creado en el servidor automáticamente dispone de un alias `root@tu.dominio.tld` - lo que significa que un email mandado hacia esta dirección se encontrará en el buzón de entrada de este usuario. Las redirecciones automáticas pueden ser configuradas, por ejemplo si un usuario no quiere configurar una cuenta de correo adicional y simplemente desea recibir correos del servidor en - por ejemplo - su dirección gmail.

Otra función desconocida es el uso del sufijo "+". Por ejemplo, email mandados a `johndoe+sncf@tu.dominio.tld` llegarán en el directorio 'sncf' del buzón de correo de John Dos (o directamente en el buzón si este directorio no existe). Es una técnica práctica que permite proveer una dirección de mail a un sitio y automatizar la clasificación de los correos que te mandará este sitio.

¿ Qué ocurre si mi servidor se pone indisponible ?
-----------------------------------------------

Si tu servidor se pone indisponible, los correos electrónicos mandados a tu servir se quedarán en una fila de espera por el lado del expedidor durante aproximadamente 5 días. El proveedor de hosting del expedidor intentará mandarte regularmente el correo, hasta que lo tire si no lo puede enviar. 

Más información
--------------------

- Existe una página de documentación para [migrar sus emails desde un proveedor de mensajería hacia una instancia Yunohost](email_migration_es).
- Para profundizar tu comprensión del correo electrónico y de sus protocolos, aquí tienes una [conferencia muy interesante](http://www.iletaitunefoisinternet.fr/lemail-par-benjamin-sonntag/index.html)(en francés).
