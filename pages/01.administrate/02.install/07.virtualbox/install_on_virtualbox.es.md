---
title: Instalar YunoHost en VirtualBox
template: docs
taxonomy:
    category: docs
routes:
  default: '/install_on_virtualbox'
---

*Encontrar otros medios de instalar YunoHost **[aquí](/install)**.*

## Prerrequisitos

![](image://virtualbox.png?resize=200)

* Un ordenador x86 con VirtualBox instalado y bastante RAM disponible para iniciar una pequeña máquina virtual.
* La última **imagen ISO YunoHost** estable, disponible [aquí](/images).

! N.B. : Instalar YunoHost en VirtualBox es útil para probar la distribución. Para realmente autoalojarse a largo plazo, probablement necesitarás una máquina virtual (viejo ordenador, tarjeta ARM...) o un VPS.

---

## <small>1.</small> Crear una nueva máquina virtual

![](image://virtualbox_1.png)

<br>

* No es grave si sólo la versión 32-bit está disponible, pero en este caso asegúrate que 32 bit previamente.
* 256Mo de RAM es el requisito mínimo, 512Mo está recomendado (1Go o más si puedes).
* 8Go de almacenaje mínimo requisito.

---

## <small>2.</small> Modificar la configuración de la red

Ir a **Settings** > **Network** :

![](image://virtualbox_2.png)

<br>

* Selectiona `Bridged adapter`

* Elige tu interfaz según su nombre :

    **wlan0** si estás conectado sin hilo, **eth0** de otro modo.

---

## <small>3.</small> Inicia tu máquina virtual

Inicia tu máquina virtual

![](image://virtualbox_2.1.png)

<br>

Aquí tienes que seleccionar la imagen ISO, luego deberías ver esta pantalla de bienvenida.

<br>

Si te encuentras con el error "VT-x is not available", probablement hay que activar (enable) la virtualización en la opciones del BIOS de tu ordenador.

<br>
   
![](image://virtualbox_3.png)

<br>

* Elige `Instalación gráfica`

* Selecciona tu idioma, tu ubicación, la distribución de tu teclado y deja el ordenador terminar el proceso :-)

---

## <small>4.</small> Efectuar la post-instalación

Después del reinicio, la máquina debería proponerte de efectuar la post-instalación :

<a class="btn btn-lg btn-default" href="/postinstall">Documentación de post-instalación</a>
