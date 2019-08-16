#Acceder a tu servidor desde la red local

Después de haber instalado tu servidor, es probable que tu nombre de dominio no esté accesible desde la red local donde se encuentra el servidor. Esto es un problema que se llama el [hairpinning](https://en.wikipedia.org/wiki/Hairpinning).

Para resolver este problema, es preciso configurar el DNS de tu router o, por defecto, el o los archivos hosts de tu ordenadores clientes.

### Obtener la dirección IP local del servidor
A fin de configurar el DNS o el archivo hosts, tienes que conocer la dirección IP privada de tu servidor. Esta dirección sólo puede ser utilizada en la red local donde está el servidor, y no está vinculada con tu dirección pública utilizada en Internet.

Puedes descubrir la dirección privada de tu servidor de varias maneras :
- En la pantalla de conexión de Yunohost en el mismo servidor :
<img src="/images/ynh_login.png" width=600>

- Desde la interfaz de administración de tu servidor Yunohost :
    en Estado del servidor > Red
<img src="/images/ynh_admin_etat_ip.png" width=900>

- O desde tu router o tu caja Internet, dependiendo de su modelo.

## Configurar el DNS de la caja Internet o del router

Vas a crear una redirección que estará activa en toda tu red local. El objetivo es crear una redirección DNS hacia el IP de tu servidor en tu caja Internet. Hay que acceder a la interfaz de configuración de tu caja y a los parámetros DNS, y luego crear una redirección local (por ejemplo, yunohost.local puede redigir hacia 192.168.21).

## Configurar el archivo [hosts](https://es.wikipedia.org/wiki/Archivo_hosts) del ordenador cliente
Sólo deberías modificar el archivo hosts si no puedes modificar el DNS de tu caja Internet / router, porque el archivo hosts únicamente afectará el ordenador en el cual el archivo esté modificado.

- En Windows, encontrarás el archivo hosts aquí :
    `%SystemRoot%\system32\drivers\etc\`
    > Es preciso visualizar los archivos y sistemas escondidos para ver el archivo hosts.
- En sistemas UNIX (GNU/Linux, Mac OS), lo encontrarás aquí :
    `/etc/hosts`
    > Necesitarás derechos root para modificar el archivo.

Simplemente añade al final del archivo hosts una linea conteniendo la dirección IP privada del servidor y tu nombre de dominio

```bash
192.168.1.62	domain.tld
```
