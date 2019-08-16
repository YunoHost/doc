# SSH

## ¿ Qué es SSH ?

**SSH** est un acrónimo por Secure Shell, y representa un protocolo que permite controlar remotamente una máquina vía la línea de comandos (CLI). También es un comando básico disponible en los terminales de Linux y MacOS / OSX. En Windows, hace falta utilizar el programa [MobaXterm](https://mobaxterm.mobatek.net/download-home-edition.html) (después de haberlo iniciado, clicar sobre Session y luego SSH).

## Durante la instalación de Yunohost

#### Encontrar su IP

Si instalas Yunohost en un VPS, tu proveedor debería haberte comunicado la dirección IP de tu servidor. 

Si instalas un servidor en tu casa (por ejemplo en Raspberry Pi u OLinuXino), tienes que encontrar el IP que fue atribuido a tu tarjeta cuando la conectaste a tu router / caja Internet. Hay varias maneras de hacerlo :

- abre una terminal y teclea `sudo arp-scan --local` para enumerar los IP de las máquinas en la red local ;
- utiliza la interfaz de tu router caja internet para listar las máquinas conectadas, o mira los los ;
- conecta una pantalla en tu servidor, inicia una sesión y escribe `hostname --all-ip-address`.

#### Conectarse

Suponiendo que tu dirección IP sea `111.222.333.444`, abre una terminal y escribe :

```bash
ssh root@111.222.333.444
```

Ahora te piden una contraseña. Si es un VPS, tu proveedor ya te hará comunicado la contraseña. Si utilizaste una imagen pre-instalada (para x86 o tarjetas ARM), el password debería ser `yunohost`.

<div class="alert alert-warning">
Desde YunoHost 3.4, después de la post-instalación ya no es posible conectarse con el usuario `root`. En lugar de eso, hace falta **conectarse con el usuario `admin`**. Incluso si el servidor LDAP fuera quebrado (haciendo que el usuario `admin` ya no fuera utilizable) todavía deberías poder conectarte con el usuario `root` desde la red local.
</div>

#### ¡ Cambiar la contraseña root !

Después de haberte conectado por primera vez, tienes que cambiar la contraseña `root`. Tal vez el servidor te pida automáticamente que lo hagas. Si no es el caso, hay que utilizar el comando `passwd`. Es muy importante que elijas una contraseña bastante complicada. Nota que esta contraseña luego estará reemplazada por la contraseña admin elegida durante la post-instalación.


## En una instancia que ya está instalada

Si instalaste tu servidor en casa y que quieres conectarte desde fuera de la red local, asegúrate que hayas previamente redirigido el puerto 22 de tu router / caja hacia tu servidor (con el usuario `admin` !)

Si sólo conoces el IP de tu servidor :

```bash
ssh admin@111.222.333.444
```

Luego, entra la contraseña de administración que has elegido durante la post-instalación [post-installation](postinstall_es).

Si has configurado tus DNS (o modificar tu `/etc/hosts`), puedes utilizar tu nombre de dominio :

```bash
ssh admin@votre.domaine.tld
```

Si cambiaste el puerto SSH, hay que añadir `-p <numerodelpuerto>` al comando, por ej. :

```bash
ssh -p 2244 admin@tu.dominio.tld
```

<div class="alert alert-info">
Si estás conectado como `admin` y quieres ser `root` para tener más confort (por ejemplo, para no teclear `sudo` con cada comando), puedes convertirte en `root` tecleando `sudo su`.
</div>

## ¿ Qué usuarios ?

Por defecto, sólo el usuario `admin` puede conectarse en SSH en una instancia Yunohost.

Los usuarios Yunohost creados vea la interfaz de administración están administrados por la base de datos LDAP. Por defecto, no pueden conectarse en SSH por razones de seguridad. Si necesitas absolutamente que uno de estos usuarios disponga de un acceso SSH, puedes utilizar el comando :
```bash
yunohost user ssh allow <username>
```

Del mismo modo, es posible cancelar el acceso SSH de un usuario con el comando :
```bash
yunohost user ssh disallow <username>
```

Finalmente, es posible añadir, suprimir y listar llaves SSH, para mejorar la seguridad del acceso SSH, con estos comandos :
```bash
yunohost user ssh add-key <username> <key>
yunohost user ssh remove-key <username> <key>
yunohost user ssh list-keys <username>
```

## SSH y seguridad

N.B. : `fail2ban` proscribirá tu IP durante 10 minutos si fracasas más de 5 veces consecutivas en identificarte. Si esto ocurre y que quieres re-validar tu IP, puedes echar un vistazo a la página [fail2ban](/fail2ban_es)

Encontrarás explicaciones más completa sobre la seguridad y SSH en [la página dedicada](security_es).
