# Conectar e iniciar el servidor

* Conecta tu servidor con un cable Ethernet (RJ-45) **directamente sobre tu router principal**. También puedes configurar la conexión wifi como explicado [aquí (fr)](http://raspbian-france.fr/connecter-wifi-raspberry-pi-3/). El wifi también puede configurarse sin haber iniciado la tarjeta, "montando" la segunda partición de la tarjeta y finalmente editando el archivo wpa-supplicant.conf. En Windows, puedes utilizar [Paragon ExtFS](https://www.paragon-software.com/home/extfs-windows/), no olvides de "unmount" para que los cambios estén integrados. 

* No te olvides de **conectar una pantalla** si quieres observar cómo ocurre el inicio, y un teclado si quieres un acceso con **línea de comandos** a tu servidor.

* Inicia el servidor, el Raspberry Pi va a reiniciarse si-mismo una primera vez, pues espera hasta que veas un gran `Y` cuadrado :

<br>

<div class="text-center"><img src="/images/boot_screen.png">

<p markdown="1">
*Nota el valor `IP` visible en la pantalla : esto es **la dirección IP local** de tu servidor.*
</p>

</div>
