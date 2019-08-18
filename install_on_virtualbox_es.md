# Instalar YunoHost en VirtualBox

*Encontrar otros medios de instalar Yunohost **[aquí](/install_es)**.*

## Prerrequisitos

<img src="/images/virtualbox.png" width=200>

* Un ordenador x86 con VirtualBox instalado y bastante RAM disponible para iniciar una pequeña máquina virtual.
* La última **imagen ISO YunoHost** estable, disponible [aquí](/images_es).

<div class="alert alert-warning" markdown="1">
N.B. : Instalar YunoHost en VirtualBox es útil para probar la distribución. Para realmente autoalojarse a largo plazo, probablement necesitarás una máquina virtual (viejo ordenador, tarjeta ARM...) o un VPS.
</div>

---

## <small>1.</small> Crear una nueva máquina virtual

<img src="/images/virtualbox_1.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

* No es grave si sólo la versión 32-bit está disponible, pero en este caso asegúrate que 32 bit previamente.
* 256Mo de RAM es el requisito mínimo, 512Mo está recomendado (1Go o más si puedes).
* 8Go de almacenaje mínimo requisito.

---

## <small>2.</small> Modificar la configuración de la red

Ir a **Settings** > **Network** :

<img src="/images/virtualbox_2.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

* Selectiona `Bridged adapter`

* Elige tu interfaz según su nombre :

    **wlan0** si estás conectado sin hilo, **eth0** de otro modo.

---

## <small>3.</small> Inicia tu máquina virtual

Inicia tu máquina virtual

<img src="/images/virtualbox_2.1.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

Aquí tienes que seleccionar la imagen ISO, luego deberías ver esta pantalla de bienvenida.

<br>

Si te encuentras con el error "VT-x is not available", probablement hay que activar (enable) la virtualización en la opciones del BIOS de tu ordenador.

<br>
   
<img src="/images/virtualbox_3.png" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<br>

* Elige `Instalación gráfica`

* Selecciona tu idioma, tu ubicación, la distribución de tu teclado y deja el ordenador terminar el proceso :-)

---

## <small>4.</small> Efectuar la post-instalación

Después del reinicio, la máquina debería proponerte de efectuar la post-instalación :

<a class="btn btn-lg btn-default" href="/postinstall_es">Documentación de post-instalación</a>
