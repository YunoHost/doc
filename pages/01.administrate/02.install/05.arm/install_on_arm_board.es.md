---
title: Instalar YunoHost en una tarjeta ARM
template: docs
taxonomy:
    category: docs
routes:
  default: '/install_on_arm_board'
---

*Encontrar otros medios de instalar YunoHost **[aquí](/install)**.*

![](image://olinuxino.jpg?resize=250)
![](image://micro-sd-card.jpg)

!!! Antes de alojar tu propio servidor en tu casa, te recomendamos que consultes las [posibles restricciones impuestas por tu Proveedor de Internet](/isp). Si tu proveedor es demasiado restrictivo, puedes utilizar un VPN para eludir estas restricciones.

- Una tarjeta ARM con un procesador de 500 MHz et 512 Mo de memoria RAM ; 
- Un adaptador de corriente para alimentar la tarjeta ;
- Una tarjeta microSD : al menos **8 Go** y **Clase 10** (por ejemplo una [Transcend 300x](http://www.amazon.fr/Transcend-microSDHC-adaptateur-TS32GUSDU1E-Emballage/dp/B00CES44EO)) ;
- Un cable ethernet/RJ-45 para conectar la carte con el router / caja internet. (Con el Raspberry Pi 0, puedes conectar tu tarjeta con un cable OTG y un adaptador Wifi USB.)
- Un [proveedor de Internet ético](/isp), de preferencia con una buena velocidad de upload.

---

## Instalación con la imagen pre-instalada (recomendada)

[div class="btn btn-lg btn-default"] [0. Descargar la imagen pre-instalada para tu tarjeta ARM](/images) [/div]
<br>
<small class="text-info">Si no existe una imagen dedicada a tu tarjeta, puedes seguir la sección "Instalación encima de ARMbian".</small>

[div class="btn btn-lg btn-default"] [1. Poner la imagen en tu tarjeta SD](/burn_or_copy_iso) [/div]

[div class="btn btn-lg btn-default"] [2. Conectar y encender](/plug_and_boot) [/div]

[div class="btn btn-lg btn-default"] [3. Proceder a la post-instalación](/postinstall) [/div]

---

## Instalación encima de ARMbian

[div class="btn btn-lg btn-default"] [0. Descargar la imagen ARMbian para tu tarjeta ARM](https://www.armbian.com/download/) [/div]

[div class="btn btn-lg btn-default"] [1. Poner la imagen en tu tarjeta SD](/burn_or_copy_iso) [/div]

[div class="btn btn-lg btn-default"] [2. Conectar y encender](/plug_and_boot) [/div]

[div class="btn btn-lg btn-default"] [3. Conectarse en SSH](/ssh) [/div]

[div class="btn btn-lg btn-default"] [4. Proceder a la post-instalación genérica](/install_manually) [/div]

