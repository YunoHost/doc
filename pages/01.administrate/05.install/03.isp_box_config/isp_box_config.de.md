---
title: Portweiterleitung Konfigurieren
template: docs
taxonomy:
    category: docs
routes:
  default: '/isp_box_config'
  aliases:
    - '/port_forwarding'
---

Wenn Sie zu Hause selbst hosten und kein VPN nutzen, müssen Sie die Ports Ihres Routers umleiten ("Internet box"). Das folgende Schema versucht, die Rolle der Portweiterleitung beim Einrichten eines Servers zu Hause kurz zu erklären.

[figure caption="Abbildung der Wichtigkeit von Port-Weiterleitung"]![](image://portForwarding_en.png)[/figure]

### 0. Offene Ports diagnostizieren

Sobald die Umleitungen konfiguriert sind, können Sie mit dem in YunoHost 3.8 eingeführten Diagnosewerkzeug überprüfen, ob
die Ports korrekt freigegeben sind.

### 1. Auf die Administrationsoberfläche Ihrer Box/Ihres Routers zugreifen

Ihre Box/Router-Administrationsoberfläche ist in der Regel erreichbar über [http://192.168.0.1](http://192.168.0.1) oder [http://192.168.1.1](http://192.168.1.1). Als Nächstes müssen Sie sich möglicherweise mit den von Ihrem Internetdienstanbieter (ISP) bereitgestellten Anmeldedaten authentifizieren.

### 2. Die lokale IP Ihres Servers finden

Identifizieren Sie die lokale IP Ihres Servers, entweder :
- von Ihrer Box/Router-Schnittstelle, die möglicherweise angeschlossene Geräte auflistet
- über die Yunohost-Schnittstelle, Abschnitt "Internetkonnektivität", dann auf "Details" im IPv4-Bericht klicken.
- von der Befehlszeile Ihres Servers aus, indem Sie `hostname -I` ausführen

Eine lokale IP-Adresse sieht typischerweise so aus:`192.168.xx.yy`, oder `10.0.xx.yy`.

Die lokale IP-Adresse muss statisch sein, damit die Port-Weiterleitungen, die Sie im nächsten Schritt konfigurieren werden, Ihren Server immer erreichen. Sie sollten in Ihren Rechner/Router gehen und sicherstellen, dass die lokale IP-Adresse Ihres Servers statisch und nicht dynamisch ist.

### 3. Ports weiterleiten

Suchen Sie in der Verwaltungsoberfläche Ihres Routers nach etwas wie "Router-Konfiguration" oder "Port-Weiterleitung". Die Benennung unterscheidet sich bei den verschiedenen Arten von Boxen.

Das Öffnen der unten aufgeführten Ports ist notwendig, damit die verschiedenen in YunoHost verfügbaren Dienste funktionieren. Für jeden von ihnen wird die 'TCP'-Weiterleitung benötigt. Einige Schnittstellen beziehen sich auf 'externe' und 'interne' Ports : diese sind in unserem Fall gleich.

* Web: 80 <small>(HTTP)</small>, 443 <small>(HTTPS)</small>
* [SSH](/ssh): 22
* [XMPP](/XMPP): 5222 <small>(clients)</small>, 5269 <small>(servers)</small>
* [Email](/email): 25, 587 <small>(SMTP)</small>, 993 <small>(IMAP)</small>

Wenn Sie sowohl ein Modem als auch einen Router verwenden, dann müssen Sie Folgendes tun:
1. zuerst auf dem Modem (der Box, die dem Internet am nächsten ist) Regeln erstellen, um die oben genannten Ports an Ihren Router weiterzuleiten;
2. dann auf dem Router (der Box zwischen dem Modem und Ihren Geräten) Regeln erstellen, um die oben genannten Ports an die statische IP-Adresse für Ihren Server weiterzuleiten.

! [fa=exclamation-triangle /] Einige ISPs blockieren standardmäßig den Port 25 (Mail-SMTP), um Spam zu bekämpfen. Andere (seltener) erlauben keine freie Nutzung der Ports 80/443. Abhängig von Ihrem ISP kann es möglich sein, diese Ports in der Schnittstelle zu öffnen... Siehe [diese Seite](/isp) für weitere Informationen.

## Automatische Weiterleitung / UPnP

Eine Technologie namens UPnP ist auf einigen Internet-Boxen / Routern verfügbar und erlaubt Ports automatisch an den Rechner weiterzuleiten, der sie benötigt. Ist UPnP in Ihrem lokalen Netzwerk aktiviert, so sollte die Ausführung dieses Befehls den Port automatisch öffnen:

```bash
sudo yunohost firewall reload
```
