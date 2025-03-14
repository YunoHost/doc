---
title: Elegir manera y proveedores de autohospedaje
template: docs
taxonomy:
    category: docs
routes:
  default: '/howtohostyourself'
---

Puedes autohospedarte desde tu casa (desde un pequeño ordenador), o desde un servidor remoto. Cada solución tiene sus ventajas e inconvenientes:

### En casa, por ejemplo con una tarjeta ARM o un ordenador antiguo

Puedes autoalojarte en casa, desde una tarjeta ARM o un viejo ordenador conectado a tu internet.

- **Ventajas**: Tienes el control físico de la máquina y solo tienes que conseguir el hardware inicial.
- **Desventajas**: Probablemente necesitas [configurer manualmente tu router](/install/post_install/isp_box_config) y puede que [tu operador de internet te limite](/install/providers/isp/).

### En casa, pasando por una VPN

Una VPN es un tunel encriptado entre dos máquinas. En la práctica, permite hacer como si una máquina estuviera en otro lugar. Esto permite el autoalojamiento evitando limitaciones de los proveedores de internet. Puedes echar un ojo a [el proyecto InternetCu.Be](https://internetcu.be/) y la [Federación FFDN (Federación de operadores de acceso a internet asociativos)](https://www.ffdn.org/en).

- **Ventajas** : Tienes el control físico de la máquina y la VPN permite ocultarte del rastro de tu operador de internet, y esquivar limitaciones.
- **Desventajas** : Las VPN suelen ser de pago, y tendrás que costearla mensualmente.

### En un servidor remoto (VPS o servidor dedicado)

Puedes alquilar un servidor privado virtual (VPS) o una máquina dedicada a alojamientos [asociativos](https://db.ffdn.org/) o [comerciales](/providers/server).

- **Ventajas**: Tu servidor será rápido y su conexión veloz.
- **Desventajas**: Ocasiona un gasto mensual por la máquina, y no tienes control físico.

### Resumen

<table>
    <thead>
      <tr>
        <th></th>
        <th style="text-align:center;">En casa<br><small>(ej. ARM, viejo PC)</small></th>
        <th style="text-align:center;">En casa<br>pasando por la VPN</th>
        <th style="text-align:center;">En remoto<br>(VPS o dedicado)</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="text-align:center;">Coste material</td>
        <td style="text-align:center;" class="warning" colspan="2">En torno a ~50€<br><small>(ej. una Raspberry Pi)</small></td>
        <td style="text-align:center;" class="success">Ninguno</td>
      </tr>
      <tr>
        <td style="text-align:center;">Coste mensual</td>
        <td style="text-align:center;" class="success">Despreciable<br><small>(electricidad)</small></td>
        <td style="text-align:center;" class="warning">En torno a ~5€ <br><small>(VPN)</small></td>
        <td style="text-align:center;" class="warning">Desde ~3€ <br><small>(VPS)</small></td>
      </tr>
      <tr>
        <td style="text-align:center;">Control físico<br>de la máquina</td>
        <td style="text-align:center;" class="success">Si</td>
        <td style="text-align:center;" class="success">Si</td>
        <td style="text-align:center;" class="danger">No</td>
      </tr>
      <tr>
        <td style="text-align:center;">Enrutamiento manual<br>de puertos</td>
        <td style="text-align:center;" class="warning">Si</td>
        <td style="text-align:center;" class="success">No</td>
        <td style="text-align:center;" class="success">No</td>
      </tr>
      <tr>
        <td style="text-align:center;">Posibilidad de limitación <br>por el proveedor de internet</td>
        <td style="text-align:center;" class="danger">Si <br><small>(ver <a href="/isp">Proveedores</a>)</small></td>
        <td style="text-align:center;" class="success">Esquivados mediante VPN</td>
        <td style="text-align:center;" class="success">Generalemente no</td>
      </tr>
      <tr>
        <td style="text-align:center;">CPU</td>
        <td style="text-align:center;" class="warning" colspan="2">Generalemente ~1 GHz</td>
        <td style="text-align:center;" class="success">~2 GHz <br><small>(droplet Digital Ocean)</small></td>
      </tr>
      <tr>
        <td style="text-align:center;">RAM</td>
        <td style="text-align:center;" class="warning" colspan="2">Desde 500M hasta 8G</td>
        <td style="text-align:center;" class="warning">Depende del precio</td>
      </tr>
      <tr>
        <td style="text-align:center;">Conectividad a internet</td>
        <td style="text-align:center;" class="warning" colspan="2">Depende de tu conexión</td>
        <td style="text-align:center;" class="success">Generalemente buena</td>
      </tr>
    </tbody>
</table>
