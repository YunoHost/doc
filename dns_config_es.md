# Configuración de la zona DNS

DNS (sistema de nombre de dominios) es un elemento esencial de Internet que permite convertir direcciones comprensibles por seres humanos (los nombres de dominio) en direcciones comprensibles por la máquina (los IPs). Para que tu servidor esté fácilemente por otros seres humanos, y para que servicios como el mail funcionen correctamente, es preciso configurar la zona DNS de tu dominio.

Si utilizas un [dominio automático](/dns_nohost_me_es) provecho por el Proyecto Yunohost, la configuración debería ser automática. Si quieres utilizar tu propio nombre de dominio (comprado a un registrar), hay que configurar manualmente tu proprio nombre de dominio vía la interfaz de tu registrar.


## Configuración DNS recomendada
_Nota: los ejemplos utilizan el marcador `tu.dominio.tld`, debe ser reemplazado por su propio dominio, como `www.yunohost.org`._

YunoHost provee una configuración DNS recomendada, accesible vía :
- la webadmin, en Dominios > tu.dominio.tld > Configuración DNS ;
- o la linea de comando, `yunohost domain dns-conf tu.dominio.tld`

Para algunas necesidades o instalaciones particulares, y si sabes lo que estás haciendo, a lo mejor tendrás que modificar esa recomendación o añadir otros registros (e.g. para administrar subdominios).

La configuración recomendada típicamente se parece a :

```bash
#
# Registros IPv4/IPv6 básicos 
#
@ 3600 IN A 111.222.33.44
* 3600 IN A 111.222.33.44

# (Si tu servidor es compatibles con el IPv6, habrá registros AAAA)
@ 3600 IN AAAA 2222:444:8888:3333:bbbb:5555:3333:1111
* 3600 IN AAAA 2222:444:8888:3333:bbbb:5555:3333:1111

#
# XMPP
#
_xmpp-client._tcp 3600 IN SRV 0 5 5222 tu.dominio.tld.
_xmpp-server._tcp 3600 IN SRV 0 5 5269 tu.dominio.tld.
muc 3600 IN CNAME @
pubsub 3600 IN CNAME @
vjud 3600 IN CNAME @

#
# Mail (MX, SPF, DKIM et DMARC)
#
@ 3600 IN MX 10 votre.domaine.tld.
@ 3600 IN TXT "v=spf1 a mx ip4:111.222.33.44 -all"
mail._domainkey 3600 IN TXT "v=DKIM1; k=rsa; p=uneGrannnnndeClef"
_dmarc 3600 IN TXT "v=DMARC1; p=none"
```

Pero puede ser un poco más fácil entenderla viéndola de esta manera :


| Tipo    | Nombre                 | Valor                                                 |
| :-----: | :--------------------: | :----------------------------------------------------: |
|  **A**  |   **@**                |  `111.222.333.444` (tu IPv4)                        |
|    A    |   *                    |  `111.222.333.444` (tu IPv4)                        |
|  AAAA   |   @                    |  `2222:444:8888:3333:bbbb:5555:3333:1111` (tu IPv6) |
|  AAAA   |   *                    |  `2222:444:8888:3333:bbbb:5555:3333:1111` (tu IPv6) |
| **SRV** | **_xmpp-client._tcp**  |  `0 5 5222 tu.dominio.tld.`                         |
| **SRV** | **_xmpp-server._tcp**  |  `0 5 5269 tu.dominio.tld.`                         |
|  CNAME  |   muc                  |  `@`                                                   |
|  CNAME  |   pubsub               |  `@`                                                   |
|  CNAME  |   vjud                 |  `@`                                                   |
| **MX**  | **@**                  |  `tu.dominio.tld.`     (y prioridad: 10)            |
|   TXT   |   @                    |  `"v=spf1 a mx ip4:111.222.33.44 -all"`                |
|   TXT   |  mail._domainkey       |  `"v=DKIM1; k=rsa; p=uneGrannnndeClef"`                |
|   TXT   |  _dmarc                |  `"v=DMARC1; p=none"`                                  |

#### Algunas notas a propósito de esta tabla :

- Todos los registros no son necesarios. Para una instalación mínima, solos los registros en negrita son necesarios.
- El punto al final de `tu.dominio.tld.` es importante ;) ;
- `@` corresponde a `tu.dominio.tld`, y por ejemplo `muc`corresponde a `muc.tu.dominio.tld` ;
- ¡ Los valores mostrados son ejemplos ! Refiérete a la configuración generada por tu servidor qué valores utilizar.
- Recomendamos un [TTL](https://en.wikipedia.org/wiki/Time_to_live) de 3600 (1 hora). Pero puedes utilizar otro valor si sabes lo que estás haciendo ;
- ¡ No pongas registros IPv6 si no estás seguro que el IPv6 funcione en tu servidor ! Tendrás problemas con Let's Encrypt si no es el caso :-)
