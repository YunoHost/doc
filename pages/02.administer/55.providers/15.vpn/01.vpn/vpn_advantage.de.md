---
title: Vorteil eines VPN für Selbst-Hosting
template: docs
taxonomy:
    category: docs
routes:
  default: '/vpn_advantage'
---

Es ist unüblich, zu Hause einen Server einzurichten, und die meisten Internetanschlüsse, die Privatpersonen zur Verfügung stehen, sind für diesen Zweck ungeeignet. Ein netzneutrales VPN, das eine feste IPv4-Adresse und IPv6-Adressen bereitstellt, kann helfen, einige der Einschränkungen oder Schwierigkeiten zu überwinden.

! <b>Vorsicht</b>: nicht alle bestehenden VPN-Anbieter erfüllen diese Bedingungen, vergewissern Sie sich, dass der von Ihnen gewählte Anbieter sie erfüllt.

## Vorteile

### Plug & Play
Indem Sie ein VPN auf Ihrem Server einrichten, können Sie ihn für den Rest des Internets zugänglich machen, ohne die Konfiguration des Routers, an den Sie ihn anschließen, ändern zu müssen. Dies kann sehr praktisch sein, wenn Sie in den Urlaub fahren, umziehen oder einen Internetausfall haben, da Sie das Gerät einfach an eine Person Ihres Vertrauens anschließen können, ohne den Router der Person konfigurieren zu müssen, die Ihnen hilft.

Außerdem ersparen Sie sich die Mühe, die Ports Ihres Routers zu öffnen und das Hairpinning zu umgehen.

### Keine Mikro-DNS-Ausfälle
Wenn Ihr Internetanschluss keine feste öffentliche IP hat, müssen Sie einen dynamischen Domänennamen (Dynamic DNS) einrichten. Diese Lösung mag akzeptabel sein, aber das DNS wird nur in regelmäßigen Abständen aktualisiert (alle zwei Minuten, wenn es sich um einen `noho.st` oder `nohost.me` Domänennamen handelt). Es besteht also die Möglichkeit, dass dies gelegentlich zu Darstellungsfehlern im Browser führt oder dass sogar eine andere Website angezeigt wird (die Risiken sind jedoch geringer, da die Praxis des Self-Hosting nicht weit verbreitet ist).

Mit einem neutralen VPN wird dieses Problem umgangen, da das VPN mit einer virtuellen Internetverbindung verglichen werden kann, die eine eigene feste IPv4-Adresse hat, so dass der Domänenname nicht aktualisiert werden muss. 

### Der Fall der E-Mail
E-Mail ist eines der komplexesten Protokolle, die man selbst hosten kann, und in der Regel ist es das, was ein Benutzer zuletzt selbst hostet. In der Tat kann es leicht passieren, dass vom Server gesendete E-Mails von den SMTP-Servern der Empfänger abgelehnt werden.

Um dies zu vermeiden, müssen Sie u. a. :
- den umgekehrten DNS der Internetverbindung des Servers (oder VPN) konfigurieren
- eine feste IPv4
- dass diese IPv4 aus allen Blacklists entfernt werden kann (insbesondere darf die IP nicht in der DUL enthalten sein)
- in der Lage sein, Port 25 (sowie die anderen SMTP-Ports) zu öffnen

Leider beachtet keiner der gängigsten französischen Internetanbieter alle diese Punkte.

Um dies zu vermeiden, kann die Verwendung eines VPN, das diese Punkte berücksichtigt, eine Alternative darstellen.

### Vertrauen
Wenn Sie nicht möchten, dass der Inhalt der Kommunikation Ihres Servers von Geräten im Netz Ihres Internetanbieters ausspioniert wird, können Sie ein VPN verwenden, um Ihre Kommunikation zu verschlüsseln und Ihr Vertrauen in einen VPN-Anbieter zu setzen. Zur Erinnerung: Seit 2015 hat die Regierung offiziell Blackboxes bei großen Netzbetreibern installiert, um die gesamte digitale Kommunikation in Frankreich abzuhören und so die wissenschaftlichen, wirtschaftlichen und industriellen Interessen Frankreichs zu schützen.

## Benachteiligung
### Kosten
Ein neutrales VPN ist mit Kosten verbunden, da der Betreiber, der es bereitstellt, einen Server betreiben und Bandbreite nutzen muss. Die Preise für die assoziativen VPNs des FFDN liegen bei etwa 6 € pro Monat.

### Packet Routing
Wenn Sie ein VPN auf Ihrem Server einrichten, wird die Übertragung einer Datei von einem Computer im lokalen Netzwerk zum Server, der das VPN nutzt, über das Ende des VPN, d.h. über den Server des VPN-Anbieters, laufen, wenn Sie keine besondere Konfiguration einrichten.

Um dies zu vermeiden, gibt es zwei Lösungen :
- Wenn Sie den Server in einen Router umwandeln und die Heimgeräte daran anschließen, profitieren auch diese Geräte von der VPN-Vertraulichkeit.
- Verwenden Sie den YunoHost-Server als DNS-Resolver, wenn Sie zu Hause sind, um die Domänennamen des Servers auf die lokale IP und nicht auf die öffentliche IP umzuleiten. Dies kann entweder auf jedem Gerät oder auf dem Router erfolgen (sofern letzterer dies zulässt).
