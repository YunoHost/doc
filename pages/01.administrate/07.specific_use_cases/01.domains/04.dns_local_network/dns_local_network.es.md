---
title: Local network access to your server
template: docs
taxonomy:
  category: docs
routes:
  default: '/dns_local_network'
---

After completing your server installation, it is possible that your domain will not be accessible through the local network. This is an issue known as [hairpinning](http://en.wikipedia.org/wiki/Hairpinning) - a feature that is not well supported by some internet routers.

To solve this issue you can:
- configure your router's DNS
- or alternatively -  your /etc/hosts files on your clients workstation

### Find the local IP address of your server

First you need to find out the local IP of your server
- either using the tricks lister [here](/finding_the_local_ip)
- or if in the webadmin, in the Diagnosis section, under Internet Connectivity, IPv4, click on 'Details' and you should find an entry for 'Local IP'
- or using the command line on the server : `hostname -I`

## Configurar el DNS de la caja Internet o del router

Vas a crear una redirección que estará activa en toda tu red local. El objetivo es crear una redirección DNS hacia el IP de tu servidor en tu caja Internet. Hay que acceder a la interfaz de configuración de tu caja y a los parámetros DNS, y luego crear una redirección local (por ejemplo, `yunohost.local` puede redigir hacia `192.168.1.21`).

## Configurar el archivo [hosts](https://es.wikipedia.org/wiki/Archivo_hosts) del ordenador cliente
Sólo deberías modificar el archivo hosts si no puedes modificar el DNS de tu caja Internet / router, porque el archivo hosts únicamente afectará el ordenador en el cual el archivo esté modificado.

- En Windows, encontrarás el archivo hosts aquí :
    `%SystemRoot%\system32\drivers\etc\`
    > Es preciso visualizar los archivos y sistemas escondidos para ver el archivo hosts.
- En sistemas UNIX (GNU/Linux, macOS), lo encontrarás aquí :
    `/etc/hosts`
    > Necesitarás derechos root para modificar el archivo.

Simplemente añade al final del archivo hosts una linea conteniendo la dirección IP privada del servidor y tu nombre de dominio

```bash
192.168.1.62	domain.tld
```
