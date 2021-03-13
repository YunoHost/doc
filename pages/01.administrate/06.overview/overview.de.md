---
title: Übersicht des YunoHost Ökosystems
menu: Geführte Tour
template: docs
taxonomy:
    category: docs
routes:
  default: '/overview'
---

Diese Seite bietet eine Übersicht über das Ökosystem eines YunoHost-Servers. Diese Übersicht macht mehrere Vereinfachungenun zielt wesentlich daruaf ab, ein globales Bild zu vermitteln, bevor tiefer auf die verschiedenen Aspekte eingegangen wird.


![](image://ecosystem.png)

Alles beginnt mit dem speziellen **admin** Benutzer. Dies ist der Administrator des Computers, der Dinge auf dem Server über die Webverwaltungsoberfläche oder über SSH und die Befehlszeilenschnittstelle installieren, konfigurieren und verwalten kann. *(Wenn du bereits mit GNU / Linux vertraut bist, ist dies root ziemlich ähnlich. YunoHost hat diesen zusätzlichen 'Admin'-Benutzer aus verschiedenen technischen Gründen.)*

Der Administrator kann unter anderem Benutzer erstellen und Anwendungen installieren. Benutzer haben, wenn sie erstellt werden, automatisch eine eigene E-Mail-Adresse sowie ein XMPP-Konto. Benutzer können auch eine Verbindung zum Benutzerportal (SSO) herstellen, um auf Anwendungen zuzugreifen. Einige Anwendungen können normalerweise entweder öffentlich zugänglich oder privat installiert werden. Letzteres bedeutes, dass nur einige Benutzer Zugriff darauf haben.

Anwendungen und andere Funktionen des Servers hängen von verschiedenen Diensten ab, damit sie ordnungsgemäß funktionieren. Dienste (manchmal auch als Daemons bezeichnet) sind Programme, die ständig auf dem Server ausgeführt werden. Sie stellen sicher, dass verschiedene Aufgaben, z.B. das Beantworten von Webanfragen von Webbrowsern oder das Weiterleiten von E-Mails, ausgeführt werden. 
