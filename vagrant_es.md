# Vagrant y YunoHost

*Si necesitas una máquina virtual para testar tu código, es mejor utilizar directamente [ynh-dev](https://github.com/yunohost/ynh-dev)*

*Encontrar otros medios de instalar Yunohost **[aquí](/install_es)**.*

<img src="/images/vagrant.png" width=250>

**Prerrequisitos** : Un ordenador x86 con VirtualBox instalado y bastante RAM disponible para iniciar una pequeña máquina virtual.

---

## Inicio

Crear una carpeta para el proyecto :
```bash
mkdir YunoHost
cd YunoHost
```

El comando siguiente iniciará el proyecto con una imagen básica de Yunohost
```bash
vagrant box add yunohost/stretch-unstable https://build.yunohost.org/yunohost-stretch-unstable.box --provider virtualbox
vagrant init yunohost/stretch-unstable
```
Luego, tienes que activar la red para la instancia Yunohost :
```bash
sed -i 's/# config\.vm\.network "private_network"/config.vm.network "private_network"/' Vagrantfile
```

---

## Instalación

Iniciar la máquina virtual
```bash
vagrant up
```

Conectarse a la máquina virtual iniciada
```bash
vagrant ssh
```

Actualizar el sistema.
```bash
apt update && apt dist-upgrade
```

Puedes acceder a tu VM vía el IP 192.168.33.10.

Las direcciones IP están asignadas por defecto pero pueden ser cambiadas en los parámetros de red del Vagrantfile.

---

*Una vez la instalación terminada, puedes proceder a la post-instalación :
**[yunohost.org/postinstall](/postinstall_es)** *



