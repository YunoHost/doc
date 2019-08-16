# Instalación en un ordenador

*Encontrar otros medios de instalar Yunohost **[aquí](/install_es)**.*

## Prerrequisitos

<img src="/images/laptop.png" width=200>
<img src="/images/desktop.jpg">
<img src="/images/nettop.jpg">

* Un ordenador compatible x86 dedicado a YunoHost : portátil, netbook, ordenador de escritorio. Puedes reutilizar calquiera máquina con **256 Mo de RAM mínimo**
* Otro ordenador para examinar esta guía y acceder a tu servidor
* Un [proveedor de Internet ético](/isp_es), de preferencia con acceso de buena velocidad   (ascendente)
* Una **memoria USB** con capacidad mínima de 1Go **O** un **CD en blanco** estándar
* ***Casos particulares*** : si tu servidor no tiene tarjeta gráfica, hay que preparar un iso que se inicie sobre el puerto de serie](https://github.com/luffah/debian-mkserialiso).

---

## Etapas de instalación

<a class="btn btn-lg btn-default" href="/images_es">0. Descargar la imagen ISO</a>

<a class="btn btn-lg btn-default" href="/burn_or_copy_iso_es">1. Copiar la imagen ISO</a>

<a class="btn btn-lg btn-default" href="/boot_and_graphical_install_es">2. Encender e instalar</a>

<a class="btn btn-lg btn-default" href="/postinstall_es">3. Post-instalación</a>

---

Para conectarse directamente al ordenador (únicamente en local) :
* Usuario : **root**
* Contraseña : **yunohost**


## Casos específicos / avanzados

si el ordenador no tiene tarjeta gráfica pero sí tiene un puerto de serie : hay que modificar el ISO para un inicio con la consola de serie. Una solución es utilizar [un script que modifica las opciones de inicio](https://github.com/luffah/debian-mkserialiso).
