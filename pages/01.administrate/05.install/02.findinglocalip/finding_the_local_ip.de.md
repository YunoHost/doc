---
title: Lokale IP-Adresse Ihres Servers finden
template: docs
taxonomy:
    category: docs
routes:
  default: '/finding_the_local_ip'
---

Bei einer Installation zu Hause sollte Ihr Server normalerweise über die Domäne`yunohost.local` erreichbar sein. Wenn dies aus irgendeinem Grund nicht funktioniert, müssen Sie möglicherweise die *lokale* IP-Adresse Ihres Servers ermitteln.

## Was ist ein locales IP ?
Die lokale IP-Adresse ist die, die verwendet wird, um auf Ihren Server innerhalb des lokalen Netzwerks (typischerweise Ihr Zuhause) zu verweisen, wo mehrere Geräte an einen Router (Ihre Internetbox) angeschlossen sind. Die lokale IP-Adresse sieht typischerweise so aus `192.168.x.y` (oder manchmal `10.0.x.y` oder `172.16.x.y`)

## Wie findet man es?
Jeder dieser Tricks sollte es Ihnen ermöglichen, die lokale IP-Adresse Ihres Servers zu finden:
[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="(Empfohlen) Mit Angry IP Scanner"]

Verwenden Sie dazu die [AngryIP](https://angryip.org/download/) Software. Sie Brauchen nur diese lokalen IP-Bereiche in dieser Reihenfolge durchsuchen, bis Sie die aktive IP-Adresse finden, die Ihrem Server entspricht:
- `192.168.0.0` -> `192.168.0.255`
- `192.168.1.0` -> `192.168.1.255`
- `192.168.2.0` -> `192.168.255.255`
- `10.0.0.0` -> `10.0.255.255`
- `172.16.0.0` -> `172.31.255.255`

!!! **Tricks**:
!!! - Die Reihenfolge nach Ping festlegen, um die effektiv genutzten IP-Adressen zu sehen, wie unten agegeben.
!!! - Ihr Server sollte normalerweise auf Port 80 und 443 als lauschend angezeigt werden
!!! - im Zweifelsfall, einfach `https://192.168.x.y` in Ihrem Browser eingeben, um zu prüfen, ob es sich um Yunohost handelt.

![](image://angryip.png?class=inline)

[/ui-tab]
[ui-tab title="Mit Ihrem internet-Router / box"]
Benutzen Sie die Schnittstelle Ihrer Internet-Box / Ihres Routers, um die angeschlossenen Geräte aufzulisten
[/ui-tab]
[ui-tab title="Mit arp-scan"]
Wenn Sie Linux verwenden, können Sie ein Terminal öffnen und den Befehl `sudo arp-scan --local`werwenden, um die IP-Adressen in Ihrem lokalen Netzwerk aufzulisten (dies kann auch unter Windows funktionieren);

Wenn der Befehl `arp-scan` viele Geräte anzeigt, können Sie dann mit dem Befehl `nmap -p 22 192.168.1.0/24` prüfen, welche Geräte für SSH offen sind, um sie auszusortieren (passen Sie den IP-Bereich an Ihr lokales Netzwerk an)
[/ui-tab]
[ui-tab title="Mit Hilfe eines Bildschirms"]
Bildschirm auf den Server anschliessen, sich einloggen und diesen Befehl eingeben`hostname --all-ip-address`.

Die Standard-Anmeldedaten (vor der Nachinstallation!) zum Einloggen sind:
- login: root
- password: yunohost

(Wenn Sie ein rohes Armbian-Image anstelle des vorinstallierten Yunohost-Images verwenden, lauten die Anmeldedatenen root / 1234)

[/ui-tab]
[/ui-tabs]

## Ich kann meine lokale IP-Adresse immer noch nicht finden

Wenn Sie Ihren Server mit keinem der vorherigen Tricks finden können, ist Ihr Server möglicherweise nicht richtig gebootet worden:

- Vergewissern Sie sich, dass Ihr Server richtig eingesteckt ist;
- Wenn Sie eine SD-Karte verwenden, stellen Sie sicher, dass der Elektroanschluss nicht staubig ist;
- Schließen Sie einen Bildschirm an Ihren Server an und versuchen Sie, ihn neu zu starten, um zu prüfen, ob er ordnungsgemäß hochfährt;
- Vergewissern Sie sich, dass das Ethernet-Kabel funktioniert und richtig eingesteckt ist;
