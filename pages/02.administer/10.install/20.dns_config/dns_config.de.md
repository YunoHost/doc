---
title: Konfiguration der DNS-Zone
template: docs
taxonomy:
    category: docs
routes:
  default: '/dns_config'
---

Das Domain Name System (DNS) ist einer der wichtigsten Dienste in vielen IP-basierten Netzwerken.
Hauptsächlich wird das DNS zur Umsetzung von Domainnamen in IP-Adressen benutzt. Das DNS bietet somit eine Vereinfachung, weil Menschen sich Namen weitaus besser merken können als Zahlenketten. Damit
Ihr Server für andere leicht erreichbar ist und bestimmte Dienste, wie z. B. E-Mail, richtig funktionieren, ist es notwendig, die DNS-Zone Ihrer Domain zu konfigurieren.

Wenn Sie eine [automatische Domain](/dns_nohost_me) verwenden, die vom YunoHost-Projekt bereitgestellt wird,
sollte die Konfiguration automatisch erfolgen. Wenn Sie Ihren eigenen Domainname
(z. B. von einem Registrar erworben), müssen Sie manuell Ihre
Domain über die Schnittstelle Ihres Registrars konfigurieren.

## Empfohlene DNS-Konfiguration
_N.B. : Die Beispiele hier verwenden den Text: `your.domain.tld`, der durch Ihre eigene Domain (z. B.`www.yunohost.org`) zu ersetzen ist._

YunoHost bietet eine empfohlene DNS-Konfiguration, die auf zwei Arten zugänglich ist :
- mit dem Webadmin, unter Domänen > your.domain.tld > DNS-Konfiguration ;
- oder auf der Kommandozeile  `yunohost domain dns-conf your.domain.tld`

Für einige spezielle Anforderungen oder Installationen und wenn Sie wissen, 
was Sie tun, müssen Sie diese Empfehlung möglicherweise ändern oder
andere Datensätze hinzufügen (z. B. zur Behandlung von Subdomains).

Die empfohlene Konfiguration sieht typischerweise so aus:

```bash
#
# Basis IPv4/IPv6 Einträge
#
@ 3600 IN A 111.222.33.44
* 3600 IN A 111.222.33.44

# (Si votre serveur supporte l'IPv6, il a des enregistrements AAAA)
@ 3600 IN AAAA 2222:444:8888:3333:bbbb:5555:3333:1111
* 3600 IN AAAA 2222:444:8888:3333:bbbb:5555:3333:1111

#
# XMPP
#
_xmpp-client._tcp 3600 IN SRV 0 5 5222 votre.domaine.tld.
_xmpp-server._tcp 3600 IN SRV 0 5 5269 votre.domaine.tld.
muc 3600 IN CNAME @
pubsub 3600 IN CNAME @
vjud 3600 IN CNAME @
xmpp-upload 3600 IN CNAME @

#
# Mail (MX, SPF, DKIM et DMARC)
#
@ 3600 IN MX 10 votre.domaine.tld.
@ 3600 IN TXT "v=spf1 a mx ip4:111.222.33.44 -all"
mail._domainkey 3600 IN TXT "v=DKIM1; k=rsa; p=uneGrannnnndeClef"
_dmarc 3600 IN TXT "v=DMARC1; p=none"
```

Aber es ist vielleicht leichter zu verstehen, wenn es auf folgende Weise
dargestellt wird:

| Type    | Nom                    | Valeur                                                 |
| :-----: | :--------------------: | :----------------------------------------------------: |
|  **A**  |   **@**                |  `111.222.333.444` (deine IPv4)                        |
|    A    |   *                    |  `111.222.333.444` (deine IPv4)                        |
|  AAAA   |   @                    |  `2222:444:8888:3333:bbbb:5555:3333:1111` (deine IPv6) |
|  AAAA   |   *                    |  `2222:444:8888:3333:bbbb:5555:3333:1111` (deine IPv6) |
| **SRV** | **_xmpp-client._tcp**  |  `0 5 5222 deine.domaine.tld.`                         |
| **SRV** | **_xmpp-server._tcp**  |  `0 5 5269 deine.domaine.tld.`                         |
|  CNAME  |   muc                  |  `@`                                                   |
|  CNAME  |   pubsub               |  `@`                                                   |
|  CNAME  |   vjud                 |  `@`                                                   |
|  CNAME  |   xmpp-upload          |  `@`                                                   |
| **MX**  | **@**                  |  `deine.domaine.tld.`     (und prioriät: 10)           |
|   TXT   |   @                    |  `"v=spf1 a mx ip4:111.222.33.44 -all"`                |
|   TXT   |  mail._domainkey       |  `"v=DKIM1; k=rsa; p=irgendeingrooßerSchlüssel"`       |
|   TXT   |  _dmarc                |  `"v=DMARC1; p=none"`                                  |

#### Einige Hinweise zu dieser Tabelle

- Nicht alle dieser Aufzeichnungen sind notwendig. Für eine Minimalinstallation werden nur die fett gedruckten Datensätze benötigt;
- Der Punkt am Ende `your.domain.tld.` ist wichtig ;) ;
- `@` entspricht `your.domain.tld`, und z. B.. `muc` entspricht `muc.your.domain.tld` ;
- Die hier gezeigten Werte sind nur Beispiele! Beziehen Sie sich auf die generierte Konfiguration, um herauszufinden, welche Werte zu verwenden sind;
- Wir empfehlen eine [TTL](https://de.wikipedia.org/wiki/Time_to_Live#Domain_Name_System) von 3600 (1 Stunde). Es ist aber auch möglich einen anderen Wert zu verwenden, wenn Sie wissen, was Sie tun ;
- Legen Sie keinen IPv6-Eintrag an, wenn Sie nicht sicher sind, daß IPv6 auf Ihrem Server funktioniert! Sie werden Probleme mit Let's Encrypt haben, wenn dies nicht der Fall ist.
- If you're using the domain provider Namecheap the SRV DNS entries are formatted as **Service**: _xmpp-client **Protocol**: _tcp **Priority**: 0 **Weight**: 5 **Port**: 5222 **Target**: your.domain.tld

### Reverse DNS

Wenn Ihr ISP oder Host dies zulässt, empfehlen wir Ihnen, eine
 [Reverse-DNS-Konfiguration](https://de.wikipedia.org/wiki/Reverse_DNS)
für Ihre öffentlichen IPv4- und/oder IPv6-Adressen. Dadurch wird verhindert, dass Sie als Spammer von den Anti-Spam-Filtersystemen markiert werden.

**N.B. : Die Reverse-DNS-Konfiguration erfolgt bei Ihrem Internet Service Provider bzw. VPS-Host. Es betrifft *nicht* den Registrar Ihres Domainnamens.**

Das heißt, wenn Ihre öffentliche IPv4-Adresse `111.222.333.444`ist  und Ihr
Domänename `domain.tld`ist, sollten Sie mit dem Befehl 
`nslookup` das folgende Ergebnis erhalten :

```shell
$ nslookup 111.222.333.444
444.333.222.111.in-addr.arpa    name = domain.tld.
```

Das Diagnosesystem in der Administrationsoberfläche tut dies automatisch (im Abschnitt E-Mail)

### Dynamische IP

Wenn sich Ihre öffentliche IP-Adresse ständig ändert, befolgen Sie dieses [Tutorial](/dns_dynamicip).
