---
title: Instalación en un ordenador
template: docs
taxonomy:
    category: docs
routes:
  default: '/install_iso'
---

*Encontrar otros medios de instalar YunoHost **[aquí](/install)**.*

## Prerrequisitos

[center]
![Laptop](image://laptop.png?resize=200,200&class=inline)
![Desktop](image://desktop.jpg?resize=200,200&class=inline)
![Nettop](image://nettop.jpg?resize=200,200&class=inline)
[/center]

* Un ordenador compatible x86 dedicado a YunoHost : portátil, netbook, ordenador de escritorio. Puedes reutilizar calquiera máquina con **256 Mo de RAM mínimo**
* Otro ordenador para examinar esta guía y acceder a tu servidor
* Un [proveedor de Internet ético](/isp), de preferencia con acceso de buena velocidad (ascendente)
* Una **memoria USB** con capacidad mínima de 1Go **O** un **CD en blanco** estándar
* ***Casos particulares*** : si tu servidor no tiene tarjeta gráfica, hay que preparar un ISO que se inicie sobre el puerto de serie](https://github.com/luffah/debian-mkserialiso).

---

## Etapas de instalación

[0. Descargar la imagen ISO](/images?classes=btn,btn-lg,btn-primary)

[1. Copiar la imagen ISO](/burn_or_copy_iso?classes=btn,btn-lg,btn-primary)

[2. Encender e instalar](/boot_and_graphical_install?classes=btn,btn-lg,btn-primary)

[3. Post-instalación](/postinstall?classes=btn,btn-lg,btn-primary)

---

Para conectarse directamente al ordenador (únicamente en local) :
* Usuario : **root**
* Contraseña : **yunohost**


## Casos específicos / avanzados

si el ordenador no tiene tarjeta gráfica pero sí tiene un puerto de serie : hay que modificar el ISO para un inicio con la consola de serie. Una solución es utilizar [un script que modifica las opciones de inicio](https://github.com/luffah/debian-mkserialiso).
