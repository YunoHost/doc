# Flashear una tarjeta SD

Ahora que has descargado la imagen de Yunohost, tienes que copiar su contenido en una tarjeta SD. Esta etapa también puede llamarse 'flashear' la tarjeta SD.

<div class="alert alert-warning" markdown="1">
En el marco del self-hosting / auto-alojamiento, está recomendado que tu tarjeta SD tenga una capacidad de por lo menos 8 Go (para diponer de suficientemente espacio para el sistema y un poco de datos) y esté al menos certificada de clase 10 (para tener bueno rendimiento).
</div>

<img src="/imagen/sdcard.jpg" width=150><img src="https://yunohost.org/images/micro-sd-card.jpg">

### Con Etcher

Descarga <a href="https://etcher.io/" target="_blank">Etcher</a> para tu sistema operativo, e instálalo.

<img src="/images/etcher.gif">

Conecta tu tarjeta SD, selecciona tu imagen Yunohost y luego haz clic en 'Flash'.

### Con `dd`

Si estás en Linux / Mac y que estás cómodo con la línea de comandos, también puedes flashear tu tarjeta SD con el comando `dd`. Empieza por identificar el periférico que corresponde a tu tarjeta SD con `fdisk -l` o
`lsblk`. Suponiendo que tu tarjeta SD sea `/dev/mmcblk0` (¡ ten cuidado
!), puedes iniciar :

```bash
dd if=/chemin/vers/yunohost.img of=/dev/mmcblk0
```

## Extiende la partición root <small>(optionnel)</small>

<div class="alert alert-warning" markdown="1">
Esta etapa es opcional porque normalmente la realiza automáticamente el sistema durante el primer inicio sobre las imágenes recientes.
</div>

Por defecto, la partición root instalada en tu tarjeta SD con el comando `dd` es muy pequeña. Puedes redimensionarla con un programa como `resize2fs` (línea de comandos) o `Gparted` (interfaz gráfica) extendiendo la partición ext4 al máximo de modo a utilizar todo el espacio que no está asignado.

<img src="/images/gparted.jpg" style="max-width:100%;border-radius: 5px;border: 1px solid rgba(0,0,0,0.15);box-shadow: 0 5px 15px rgba(0,0,0,0.35);">

<p class="text-muted">Vistazo de la interfaz de Gparted</p>
