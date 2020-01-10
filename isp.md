# Internet service providers

<a class="btn btn-lg btn-default" href="/isp_box_config_en"> Main configuration box</a>

Here is a non-comprehensive list of internet service providers by country, which contains criteria about tolerance to self-hosting.

A "no" may cause problems for using your server or may require you to make additional configuration changes. Status in brackets indicates the default behavior.

A list of French and Belgian ISPs is available on the [french page](/isp_fr).

### USA
| Service provider | Box (modem/router) | uPnP available | Port 25 openable | [Hairpinning](http://en.wikipedia.org/wiki/Hairpinning) | Customizable reverse DNS | Fix IP |
| --- | --- | --- | --- | --- | --- | --- |
| Cox | Multiple | Yes | No. Only for business class customer. | No | No | Yes, as a business class customer |
| Charter | Multiple | Yes | No. Only for business class customer. | No | No | Yes, as a business class customer |
| DSLExtreme | Multiple | Yes | Yes | No | No | Yes, extra charge. |

### UK
| Service provider | Box (modem/router) | uPnP available | Port 25 openable | [Hairpinning](http://en.wikipedia.org/wiki/Hairpinning) | Customizable reverse DNS | Fix IP |
| --- | --- | --- | --- | --- | --- | --- |
| BT Internet | - | - | Yes| - | - | No |
| Virgin Media | Yes | - | - | - | No | No |

### Brazil
| Service provider | Box (modem/router) | uPnP available | Port 25 openable | [Hairpinning](http://en.wikipedia.org/wiki/Hairpinning) | Customizable reverse DNS | Fix IP |
| --- | --- | --- | --- | --- | --- | --- |
| Global Village Telecom | Multiple | Yes | No. Only for Fix IP| No | No | Yes, extra charge. |

### Ireland
| Service provider | Box (modem/router) | uPnP available | Port 25 openable | [Hairpinning](http://en.wikipedia.org/wiki/Hairpinning) | Customizable reverse DNS | Fix IP |
| --- | --- | --- | --- | --- | --- | --- |
| Whizzy Internet | Multiple | Yes | Yes| Yes | Yes | Yes |

### Canada
| Service provider | Box (modem/router) | uPnP available | Port 25 openable | [Hairpinning](http://en.wikipedia.org/wiki/Hairpinning) | Customizable reverse DNS | Fix IP |
| --- | --- | --- | --- | --- | --- | --- |
| Telus | Multiple | - | No. Extra charge | - | - | No. Extra charge |
| TekSavvy | Multiple | - | Yes | No | - | No. Extra charge |

### Sweden

| Service provider | Box (modem/router) | uPnP available | Port 25 openable | [Hairpinning](http://en.wikipedia.org/wiki/Hairpinning) | Customizable reverse DNS | Fix IP |
| --- | --- | --- | --- | --- | --- | --- |
| Telia | Multiple | Yes | No. Business only. | Yes | No. Business only. | No. Business only. |
| Bredbandsbolaget | Multiple | Yes | No. Business only. | Yes | No. Business only. | No. Business only. |
| Ownit | Multiple | Yes | Yes | N/A? | ? | Yes |

Ownit reserves port 3 and 4 of their router to TV. With a simple call to their hotline, explaining that you want to selfhost, they can reassign one of the ports to be in bridge mode. It means that your server will have its own public fixed IP address, in addition to the modem's.

### Switzerland

Most of non business IP provided by ISP are blacklisted.

| Service provider | Box (modem/router) | uPnP available | Port 25 openable | [Hairpinning](http://en.wikipedia.org/wiki/Hairpinning) | Customizable reverse DNS | Fix IP |
| --- | --- | --- | --- | --- | --- | --- |
| Sunrise | Multiple | No | Yes | No | - | - |
| Swisscom | Multiple | No | Yes | No | - | - |
| VTX | Multiple | No | Yes | No | - | - |

If you want to add international ISPs information, please do consider [modifying this page](/write_documentation).
