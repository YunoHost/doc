---
title: Internet service providers
template: docs
taxonomy:
    category: docs
never_cache_twig: true
twig_first: true
process:
    markdown: true
    twig: true
routes:
  default: '/providers/isp'
  aliases: 
    - '/isp'
---

{% set country = uri.param('country')  %}

!!! To find generic instructions on how to configure port forwarding, see [Main configuration box](/isp_box_config)

{% if country == '' %}
Here is a non-comprehensive list of internet service providers by country, which contains criteria about tolerance to self-hosting.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Africa"]

- [Ivory Coast](/isp/country:civ)

[/ui-tab]
[ui-tab title="Asia"]

- [South Korea](/isp/country:kor)
- [Taiwan](/isp/country:twn)

[/ui-tab]
[ui-tab title="Europe"]

- [Belgium (nl)](/isp/country:belnl)
- [Belgium (fr)](/isp/country:belfr)
- [Finland](/isp/country:fin)
- [France](/isp/country:fra)
- [Hungary](/isp/country:hun)
- [Ireland](/isp/country:irl)
- [Sweden](/isp/country:swe)
- [Switzerland](/isp/country:che)
- [UK](/isp/country:gbr)

[/ui-tab]
[ui-tab title="North america"]

- [Canada](/isp/country:can)
- [USA](/isp/country:usa)

[/ui-tab]
[ui-tab title="Oceania"]
[/ui-tab]
[ui-tab title="South america"]

- [Brazil](/isp/country:bra)

[/ui-tab]
[/ui-tabs]

{% else %}
A "no" may cause problems for using your server or may require you to make additional configuration changes. Status in brackets indicates the default behavior.

{% endif %}

{% if country == 'belfr' %}

### Belgique

| Fournisseur d’accès | Box/ routeur | uPnP activable | [Port 25 ouvrable](/email)| [Hairpinning](http://fr.wikipedia.org/wiki/Hairpinning) | [Reverse DNS](https://en.wikipedia.org/wiki/Reverse_DNS_lookup) | IP fixe |
| :---: | :---: | :---: | :---: | :---: | :---: | :---: |
| **Proximus** | BBox2 | oui (activé) | oui | **non** | **non** | **non** |
| | BBox3 | oui (activé) | oui | **non** | **non** | **non** |
| **Scarlet** | BBox2 | oui (activé) | oui | **non** | **non** | **non** |

**Proximus** ne serait pas ouvert à l’auto-hébergement. L’ouverture des ports serait plus difficile afin d’éviter tout SPAM. Il serait préférable de passer par [Neutrinet](http://neutrinet.be), un des [membres de la Fédération French Data Network](http://www.ffdn.org/fr/membres).

{% elseif country == 'belnl' %}

### België

| Service provider | Box/ router | uPnP beschikbaar | [Poort 25 openen mogelijk](/email)| [Hairpinning](http://fr.wikipedia.org/wiki/Hairpinning) | [Reverse DNS](https://en.wikipedia.org/wiki/Reverse_DNS_lookup) | vaste IP |
| :---: | :---: | :---: | :---: | :---: | :---: | :---: |
| **Proximus*- | BBox2 | ja (geactiveerd) | ja | **nee*- | **nee*- | **nee*- |
| | BBox3 | ja (geactiveerd) | ja | **nee*- | **nee*- | **nee*- |
| **Scarlet*- | BBox2 | ja (geactiveerd) | ja | **nee*- | **nee*- | **nee*- |

**Proximus*- zou niet openstaan voor self-hosting. Het openen van de poorten zou moeilijker zijn om SPAM te voorkomen. Het loont de moeite om een vpn te gebruiken.

{% elseif country == 'bra' %}

### Brazil

| Service provider | Box (modem/router) | uPnP available | Port 25 openable | [Hairpinning](http://en.wikipedia.org/wiki/Hairpinning) | Customizable reverse DNS | Fix IP |
| --- | --- | --- | --- | --- | --- | --- |
| Global Village Telecom | Multiple | Yes | No. Only for Fix IP| No | No | Yes, extra charge. |

{% elseif country == 'can' %}

### Canada

| Service provider | Box (modem/router) | uPnP available | Port 25 openable | [Hairpinning](http://en.wikipedia.org/wiki/Hairpinning) | Customizable reverse DNS | Fix IP |
| --- | --- | --- | --- | --- | --- | --- |
| Telus | Multiple | - | No. Extra charge | - | - | No. Extra charge |
| TekSavvy | Multiple | - | Yes | No | - | No. Extra charge |

{% elseif country == 'fin' %}

### Finland

| Service provider | Box (modem/router) | uPnP available | Port 25 openable | [Hairpinning](http://en.wikipedia.org/wiki/Hairpinning) | Customizable reverse DNS | Fix IP |
| --- | --- | --- | --- | --- | --- | --- |
| DNA | Multiple | Yes | No [^fi-port25] | Yes | No | No. Only for business. |
| Elisa | Multiple | Yes | No [^fi-port25] | Yes | Not available for consumers | No. Only for Business. |
| Telia | Multiple | Yes | No [^fi-port25] | Yes | Not available for consumers | No. Only for Business. |

[^fi-port25]: Regulations in Finland prohibit the use of Port 25 for consumers.

{% elseif country == 'fra' %}

### France

Tous les fournisseurs d’accès à Internet [membres de la Fédération French Data Network](http://www.ffdn.org/fr/membres) ont une politique favorable à l’auto-hébergement.

- ✔ : oui
- ✘ : non

| Fournisseur d’accès | OVH | [Free](/isp_free) | [SFR](/isp_sfr) | [Orange](/isp_orange) | Bouygues<br>Télécom | Darty |
| :---: | :---: | :---: | :---: | :---: | :---: | :---: |
| **Box/routeur** | Personnel/OVH Télécom | Freebox | Neufbox | Livebox | Bbox | Dartybox |
| **[UPnP](https://fr.wikipedia.org/wiki/Universal_Plug_and_Play)** | ✔ | ✔ | ✔ | ✔ | ✔ | ✔ |
| **[Port 25 ouvrable](/email)**<br> (fermé par défaut) | ✔ | ✔ | ✔ | ✘ | ✔ | ✔ |
| **[Hairpinning](http://fr.wikipedia.org/wiki/Hairpinning)** | ✔ | ✔ | ✔/✘ | ✔ (depuis la Livebox 4) | ✔ | ✔ |
| **[Reverse DNS](https://en.wikipedia.org/wiki/Reverse_DNS_lookup)<br>personnalisable** | ✔ | ✔ (sauf IPv6, pas de support, et buggué sur certaines plages d'adresses ipv4) | … | ✘ (XXX.pro.dns-orange.fr disponible sur les abonnements orange pro) | ✘ | ✘ |
| **[IP fixe](/dns_dynamicip)** | ✔ | ✔ | ✔/✘ | ✘ (en option depuis la Livebox 3 et sur les abonnements orange pro) | ✔ | ✔ |
| **[IPv6](https://fr.wikipedia.org/wiki/IPv6)** | ✔ | ✔ | ✔ | ✔ | … | … |
| **[Non listé sur le DUL](https://en.wikipedia.org/wiki/Dialup_Users_List)** | … | ✘ | … | … | … | … |

Pour une liste plus complète et précise, référez-vous à la très bonne documentation de [wiki.auto-hebergement.fr](http://wiki.auto-hebergement.fr/fournisseurs/fai#d%C3%A9tail_des_fai).

**Astuce** : [FDN](http://www.fdn.fr) fournit des [VPN](http://www.fdn.fr/-VPN-.html) permettant de rapatrier une (ou plusieurs sur demande) IPv4 fixe et un /48 en IPv6 et ainsi « nettoyer » votre connexion si vous êtes chez l’un des FAI *limitants* du tableau ci-dessus.

{% elseif country == 'hun' %}

### Hungary

| Service provider | Box (modem/router) | uPnP available | Port 25 openable | [Hairpinning](http://en.wikipedia.org/wiki/Hairpinning) | Customizable reverse DNS | Fix IP |
| --- | --- | --- | --- | --- | --- | --- |
| DIGI Távközlési és Szolgáltató Kft. | Yes | Yes | No. Business only. | No | No. Business only | No. Business only |
| Telekom Magyarország | Yes | Yes | No | No | No | No |

**Notice** : DIGI allows non-business users to subscribe to their business plan, for roughly the same price as the regular plan. Fix IP is an additional subscription for business plan users.

{% elseif country == 'irl' %}

### Ireland

| Service provider | Box (modem/router) | uPnP available | Port 25 openable | [Hairpinning](http://en.wikipedia.org/wiki/Hairpinning) | Customizable reverse DNS | Fix IP |
| --- | --- | --- | --- | --- | --- | --- |
| Whizzy Internet | Multiple | Yes | Yes| Yes | Yes | Yes |

{% elseif country == 'civ' %}

### Côte d'Ivoire

| Fournisseur d’accès | Box/ routeur | uPnP activable | [Port 25 ouvrable](/email)| [Hairpinning](http://fr.wikipedia.org/wiki/Hairpinning) | [Reverse DNS](https://en.wikipedia.org/wiki/Reverse_DNS_lookup) | IP fixe |
| :---: | :---: | :---: | :---: | :---: | :---: | :---: |
| **Orange** | Livebox2 | oui (activé) | non | **non** | **non** | **non** |
| **Moov** |  | oui (activé) |  |  |  |  |
| **MTN** |  | oui (activé) |  |  |  | |

{% elseif country == 'swe' %}

### Sweden

| Service provider | Box (modem/router) | uPnP available | Port 25 openable | [Hairpinning](http://en.wikipedia.org/wiki/Hairpinning) | Customizable reverse DNS | Fix IP |
| --- | --- | --- | --- | --- | --- | --- |
| Telia | Multiple | Yes | No. Business only. | Yes | No. Business only. | No. Business only. |
| Bredbandsbolaget | Multiple | Yes | No. Business only. | Yes | No. Business only. | No. Business only. |
| Ownit | Multiple | Yes | Yes | N/A? | ? | Yes |

Ownit reserves port 3 and 4 of their router to TV. With a simple call to their hotline, explaining that you want to selfhost, they can reassign one of the ports to be in bridge mode. It means that your server will have its own public fixed IP address, in addition to the modem's.

{% elseif country == 'che' %}

### Switzerland

Most of non business IP provided by ISP are blacklisted.

| Service provider | Box (modem/router) | uPnP available | Port 25 openable | [Hairpinning](http://en.wikipedia.org/wiki/Hairpinning) | Customizable reverse DNS | Fix IP |
| --- | --- | --- | --- | --- | --- | --- |
| Sunrise | Multiple | No | Yes | No | - | - |
| Swisscom | Multiple | No | Yes | No | No | No |
| VTX | Multiple | No | Yes | No | - | - |

{% elseif country == 'kor' %}

### South Korea

| Service provider | Box (modem/router) | uPnP available | Port 25 openable | [Hairpinning](http://en.wikipedia.org/wiki/Hairpinning) | Customizable reverse DNS | Fix IP |
| --- | --- | --- | --- | --- | --- | --- |
| LG U+ (HelloVision) | Multiple | Yes | Yes (Without ISP Router) | No | - | Partial |
| KT(SkyLife, Qook&Show) | Multiple | Yes | Yes | No | - | Partial |
| SKT (SK Broadband) | Multiple | Yes | Yes | No | - | Partial |

{% elseif country == 'twn' %}

### Taiwan

| Service provider | Box (modem/router) | uPnP available | Port 25 openable | [Hairpinning](http://en.wikipedia.org/wiki/Hairpinning) | Customizable reverse DNS | Fix IP |
| --- | --- | --- | --- | --- | --- | --- |
| CHT (Chunghwa Telecom) | Multiple | Yes | Yes | Yes (Need hidden settings) | No | Partial |

{% elseif country == 'gbr' %}

### UK

| Service provider | Box (modem/router) | uPnP available | Port 25 openable | [Hairpinning](http://en.wikipedia.org/wiki/Hairpinning) | Customizable reverse DNS | Fix IP |
| --- | --- | --- | --- | --- | --- | --- |
| BT Internet | Yes | - | Yes| - | - | No |
| Virgin Media | Yes | - | - | - | No | No |
| ZEN Internet | Yes | - | Yes | - | Yes | Yes |
| PlusNet | Yes | Yes | Yes | No | Yes, if you raise a ticket | Small one off Charge |

{% elseif country == 'usa' %}

### USA

| Service provider | Box (modem/router) | uPnP available | Port 25 openable | [Hairpinning](http://en.wikipedia.org/wiki/Hairpinning) | Customizable reverse DNS | Fix IP |
| --- | --- | --- | --- | --- | --- | --- |
| Cox | Multiple | Yes | No. Only for business class customer. | No | No | Yes, as a business class customer |
| Charter | Multiple | Yes | No. Only for business class customer. | No | No | Yes, as a business class customer |
| DSLExtreme | Multiple | Yes | Yes | No | No | Yes, extra charge. |
| AT&T| Multiple | Yes | No. Only for business class customer. | unknown. | unknown. | unknown. |
| Xfinity (Comcast)| Multiple | Yes | No. Only for business class customer. | unknown. | unknown. |  Yes, as a business class customer|

{% endif %}
