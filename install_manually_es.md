# Instalar YunoHost manualmente

Una vez que tienes acceso a tu servidor (directamente o con SSH), puedes instalar Yunohost ejecutando este comando como root :

```bash
curl https://install.yunohost.org | bash
```

<small>*(Si `curl` no está instalado en tu sistema, tal vez tendrás que instalarlo con `apt install curl`. De otro modo, si el comando no muestra nada, puedes intentar `apt install ca-certificates`)*</small>

Cuando la instalación esté terminada, habrá que [**proceder a la post-instalación**](/postinstall_es)

---

**Nota para los usuarios expertos preocupados por el enfoque `curl|bash`**

Si no te gusta utilizar `curl|bash` (ou comandos similares) para desplegar software, toma el tiempo de leer ["Is curl|bash insecure?"](https://sandstorm.io/news/2015-09-24-is-curl-bash-insecure-pgp-verified-install) en el blog de Sandstorm, y también [esta discusión en Hacker News](https://news.ycombinator.com/item?id=12766350).

