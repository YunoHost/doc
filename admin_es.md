# La interfaz de administración web

Yunohost tiene una interfaz gráfica de administración. El otro método consiste en utilizar la [linea de comando](/commandline_es).

### Acceso

La interfaz admin está accesible desde tu instancia Yunohost en esta dirección : https://ejemplo.org/yunohost/admin (reemplaza ejemplo.org por tu nombre de dominio)

<div class="text-center" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">
<img src="/images/webadmin.png" style="max-width:100%;">
</div>


### Reinicia la contraseña del administrador

Para reiniciar la contraseña de administración de Yunohost (con el usuario root) :

```bash
$ yunohost-reset-ldap-password
```

Una contraseña provisional será creada, podrás utilizarla para luego definir una nueva contraseña.


### Cómo mover la carpeta de una aplicación 

Para cambiar la carpeta donde está una aplicación, sólo algunos comandos son necesarios : desplazar el contenido, crear un vínculo simbólico y definir los derechos de acceso.

Ejemplo con WordPress :
```bash
# Desplazamiento del wordpress hacia otro soporte
$ sudo  mv /var/www/wordpress /mon/dossier/cible
# Creación del vínculo simbólico 
$ sudo ln -s /media/disqueexterne/wordpress /var/www/wordpress
# El directorio debe pertenecer a www-data
sudo chown -R www-data:www-data /media/externalharddrive/wordpress
```
