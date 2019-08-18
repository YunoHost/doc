# Proveedores de acceso a Internet

<a class="btn btn-lg btn-default" href="/isp_box_config_es"> Configuración general del router</a>

Aquí tienes una lista (no exhaustiva) de proveedores de acceso a Internet por país, con criterios de compatibilidad con el [self-hosting](selfhosting_es).

Un « **no** » puede implicar problemas de utilización del servidor o puede obligarte a hacer configuraciones adicionales. El estatus entre paréntesis indica el comportamiento por defecto.

### Francia

*Nota que algunos de estos proveedores como OVH y Orange también están presentes en España.*

Todos los proveedores de acceso a Internet [miembros de la Federación French Data Network] (http://www.ffdn.org/fr/membres) tienen una política a favor del auto-alojamiento / self-hosting.
* ✔ : sí
* ✘ : no

| Proveedor de acceso | OVH | [Free](/isp_free_fr) | [SFR](/isp_sfr_fr) | [Orange](/isp_orange_fr) | Bouygues<br>Télécom | Darty |
| :---: | :---: | :---: | :---: | :---: | :---: | :---: |
| **Box/router** | Personal/OVH Télécom | Freebox | Neufbox | Livebox | Bbox | Dartybox |
| **[UPnP](https://fr.wikipedia.org/wiki/Universal_Plug_and_Play)** | ✔ | ✔ | ✔ | ✔ | ✔ | ✔ |
| **[Puerto 25 que se abre](email_fr)**<br> (cerrado por defecto) | ✔ | ✔ | ✔ | ✘ | ✔ | ✔ |
| **[Hairpinning](http://fr.wikipedia.org/wiki/Hairpinning)** | ✔ | ✔ | ✔/✘ | ✘ | ✔ | ✔ |
| **[Reverse DNS](https://en.wikipedia.org/wiki/Reverse_DNS_lookup)<br>personalizable ** | ✔ | ✔ (excepto IPv6) | … | ✘ | ✘ | ✘ |
| **[IP fija](/dns_dynamicip_es)** | ✔ | ✔ | ✔/✘ | ✘ | ✔ | ✔ |
| **[IPv6](https://fr.wikipedia.org/wiki/IPv6)** | ✔ | ✔ | ✔ | ✔ | … | … |
| **[No listado en el DUL](https://en.wikipedia.org/wiki/Dialup_Users_List)** | … | ✘ | … | … | … | … |
Para obtener una lista más completa y precisa, refiérete a la muy buena documentación (fr) de [wiki.auto-hebergement.fr](http://wiki.auto-hebergement.fr/fournisseurs/fai#d%C3%A9tail_des_fai).

**Truco** : [FDN](http://www.fdn.fr) propone unos [VPN](http://www.fdn.fr/-VPN-.html) que permiten recuperar una (o varias si lo pides) IPv4 fija y un /48 en IPv6 y así « limpiar » tu conexión si tu proveedor es uno los *proveedores limitantes* de la tabla más arriba.

### Bélgica

| Proveedor de acceso | Box/ router | uPnP activable | [Puerto 25 que se abre](email_fr)| [Hairpinning](http://fr.wikipedia.org/wiki/Hairpinning) | [Reverse DNS](https://en.wikipedia.org/wiki/Reverse_DNS_lookup) | IP fija |
| :---: | :---: | :---: | :---: | :---: | :---: | :---: |
| **Proximus** | BBox2 | sí (activado) | sí | **no** | **no** | **no** |
| | BBox3 | sí (activado) | sí | **no** | **no** | **no** |
| **Scarlet** | BBox2 | sí (activado) | sí | **no** | **no** | **no** |

**Proximus** no estaría a favor del auto-alojamiento. Hacen que la apertura de los puertos esté más difícil para luchar contra el spam. Es mejor pasar por [Neutrinet](http://neutrinet.be), uno de los [miembros de la Federación French Data Network](http://www.ffdn.org/fr/membres).

### Costa de Marfil

| Proveedor de acceso | Box/ router | uPnP activable | [Puerto 25 que se abre](email_fr)| [Hairpinning](http://fr.wikipedia.org/wiki/Hairpinning) | [Reverse DNS](https://en.wikipedia.org/wiki/Reverse_DNS_lookup) | IP fija |
| :---: | :---: | :---: | :---: | :---: | :---: | :---: |
| **Orange** | Livebox2 | sí (activado) | no | **no** | **no** | **no** |
| **Moov** |  | sí (activado) |  |  |  |  |
| **MTN** |  | sí (activado) |  |  |  | |