---
title: Instalar YunoHost en un Raspberry Pi
template: docs
taxonomy:
    category: docs
---

*Encontrar otros medios de instalar YunoHost **[aquí](/install)**.*

<center>
<img src="/images/raspberrypi.jpg" width=300 style="padding-bottom:20px">
<img src="/images/micro-sd-card.jpg">
</center>

<div class="alert alert-info" markdown="1">
Antes de alojar tu propio servidor en tu casa, te recomendamos que consultes las [posibles restricciones impuestas por tu Proveedor de Internet](/isp). Si tu proveedor es demasiado restrictivo, puedes utilizar un VPN para eludir estas restricciones.
</div>

## Prerrequisitos

- Un Raspberry Pi 2, 3 o 4 (RPi 0 and 1 may work but require some tweaking ... see [this issue](https://github.com/YunoHost/issues/issues/1423)) ; ;
- Un adaptador de corriente para alimentar la tarjeta ;
- Una tarjeta microSD : al menos **8 Go** y **Clase 10** (por ejemplo una [Transcend 300x](http://www.amazon.fr/Transcend-microSDHC-adaptateur-TS32GUSDU1E-Emballage/dp/B00CES44EO)) ;
- Un cable ethernet/RJ-45 para conectar la tarjeta con tu enrutador o tu caja internet. (Con el Raspberry Pi 0, puedes conectar tu tarjeta con un cable OTG y un adaptador Wifi USB.)
- Un [proveedor de Internet ético](/isp), de preferencia con buena velocidad de upload.

---

## Instalación con la imagen pre-instalada (recomendada)

<a class="btn btn-lg btn-default" href="/images">1. Descargar la imagen para Raspberry Pi</a>

<a class="btn btn-lg btn-default" href="/burn_or_copy_iso">2. Poner la imagen en tu tarjeta SD</a>

<a class="btn btn-lg btn-default" href="/plug_and_boot">3. Conectar y encender</a>

<a class="btn btn-lg btn-default" href="/postinstall">4. Proceder a la post-instalación</a>

---

## Instalación manual (desaconsejada)

<div class="alert alert-warning" markdown="1">
No recomendamos la instalación manual porque es más técnica y más larga que la instalación vía la imagen per-instalada. Esta documentación sobre todo está destinada a los usuarios expertos.
</div>

<div class="alert alert-warning" markdown="1">
Las últimas versiones de Raspberry Pi OS necesitan una pantalla y un teclado porque ya no es posible conectarse directamente por SSH al Raspberry por defecto. Sin embargo, es posible reactivar el inicio de SSH al boot : solo hay que poner un archivo llamado `ssh` (vacío, sin extensión) en la partición boot de la tarjeta SD.
</div>

0. Instalar Raspberry Pi OS Lite ([instrucciones](https://www.raspberrypi.org/downloads/raspberry-pi-os/)) en la tarjeta SD.

1. Conéctate con SSH al Raspberry Pi con el usuario pi. Define una contraseña root con 
```bash
sudo passwd root
```

2. Modifica `/etc/ssh/sshd_config` para autorizar root a que se conecte con ssh, reemplazando `PermitRootLogin without-password` por `PermitRootLogin yes`. Recarga el daemon ssh con `service ssh reload`, y luego re-conéctate como root.

3. Desconéctate et reconéctate con el usuario root esta vez.

4. Sigue con el <a href="/install_manually">procedimiento de instalación manual genérico</a>.

