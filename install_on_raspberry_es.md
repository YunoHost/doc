# Instalar YunoHost en un Raspberry Pi

*Encontrar otros medios de instalar Yunohost **[aquí](/install_es)**.*

<center>
<img src="/images/raspberrypi.jpg" width=300 style="padding-bottom:20px">
<img src="/images/micro-sd-card.jpg">
</center>

<div class="alert alert-info" markdown="1">
Antes de alojar tu propio servidor en tu casa, te recomendamos que consultes las [posibles restricciones impuestas por tu Proveedor de Internet](/isp). Si tu proveedor es demasiado restrictivo, puedes utilizar un VPN para eludir estas restricciones.
</div>

## Prerrequisitos

- Un Raspberry Pi 0, 1, 2, 3 o 4 ;
- Un adaptador de corriente para alimentar la tarjeta ;
- Una tarjeta microSD : al menos **8 Go** y **Clase 10** (por ejemplo una [Transcend 300x](http://www.amazon.fr/Transcend-microSDHC-adaptateur-TS32GUSDU1E-Emballage/dp/B00CES44EO)) ;
- Un cable ethernet/RJ-45 para conectar la tarjeta con tu enrutador o tu caja internet. (Con el Raspberry Pi 0, puedes conectar tu tarjeta con un cable OTG y un adaptador Wifi USB.)
- Un [proveedor de Internet ético](/isp_es), de preferencia con buena velocidad de upload.

---

## Instalación con la imagen pre-instalada (recomendada)

<a class="btn btn-lg btn-default" href="/images_es">1. Descargar la imagen para Raspberry Pi</a>

<a class="btn btn-lg btn-default" href="/copy_image_es">2. Poner la imagen en tu tarjeta SD</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot_es">3. Conectar y encender</a>

<a class="btn btn-lg btn-default" href="/ssh_es">4. Conectarse en SSH</a>

<a class="btn btn-lg btn-default" href="/postinstall_es">5. Proceder a la post-instalación</a>

---

## Instalación manual (desaconsejada)

<div class="alert alert-warning" markdown="1">
No recomendamos la instalación manual porque es más técnica y más larga que la instalación vía la imagen per-instalada. Esta documentación sobre todo está destinada a los usuarios expertos.
</div>

<div class="alert alert-warning" markdown="1">
Las últimas versiones de Raspbian necesitan una pantalla y un teclado porque ya no es posible conectarse directamente por SSH al Raspberry por defecto. Sin embargo, es posible reactivar el inicio de SSH al boot : solo hay que poner un archivo llamado `ssh` (vacío, sin extensión) en la partición boot de la tarjeta SD.
</div>

0. Instalar Raspbian Stretch Lite ([instrucciones](https://www.raspberrypi.org/downloads/raspbian/)) en la tarjeta SD.

1. Conéctate con ssh al Raspberry Pi con el usuario pi. Define una contraseña root con 
```bash
sudo passwd root
```

2. Modifica `/etc/ssh/sshd_config` para autorizar root a que se conecte con ssh, reemplazando `PermitRootLogin without-password` por `PermitRootLogin yes`. Recarga el daemon ssh con `service ssh reload`, y luego re-conéctate como root.

3. Desconéctate et reconéctate con el usuario root esta vez.

4. Sigue con el <a href="/install_manually_es">procedimiento de instalación manual genérico</a>.

