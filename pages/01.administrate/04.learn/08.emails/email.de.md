---
title: E-Mails
template: docs
taxonomy:
    category: docs
routes:
  default: '/email'
---

YunoHost wird mit einem kompletten Mail-Stack geliefert, der es Ihnen ermöglicht, Ihren eigenen E-Mail-Server zu hosten und somit Ihre eigenen E-Mail-Adressen in ```irgendjemand@deine.domain.tld``` zu haben.

Der Mail-Stack enthält einen SMTP-Server (Postfix), einen IMAP-Server (Dovecot), einen Antispam-Server (rspamd) und eine DKIM-Konfiguration.

## Sicherstellen dass Ihre Einrichtungen richtig sind

E-Mail ist ein kompliziertes Ökosystem und eine ganze Reihe von Details können sein ordnungsgemäßes Funktionieren verhindern.

Um Ihre Einstellungen zu validieren:

- Wenn Sie zu Hause selbst hosten und kein VPN verwenden, stellen Sie sicher das [Ihr ISP den Port 25 nicht blockiert](https://yunohost.org/#/isp); 
- leiten Sie Ports weiter, wie in [dieser Dokumentation](https://yunohost.org/#/isp_box_config) beschrieben;
- Mail-DNS-Einträge nach [dieser Dokumentation](https://yunohost.org/#/dns_config) sorgfältig konfigurieren;
- testen Sie Ihre Konfiguration mit [Mail-tester.com](https://mail-tester.com/) (Vorsicht : nur 3 Tests pro Domain und Tag sind erlaubt) ;

Eine Punktzahl von mindestens 8~9/10 ist ein angemessenes Ziel.

## E-Mail-Programme

Um mit dem E-Mail-Server zu interagieren (E-Mails lesen und senden), können Sie entweder einen Webclient wie Roundcube oder Rainloop auf Ihrem Server installieren - oder einen Desktop-/Mobil-Client, wie auf [dieser Seite](https://yunohost.org/#/email_configure_client) beschrieben, konfigurieren.

Desktop- und Mobil-Clients haben den Vorteil, dass sie Ihre E-Mails auf das Gerät kopieren, was eine Offline-Anzeige und einen relativen Schutz gegen mögliche Hardware-Ausfälle Ihres Servers ermöglicht.

## Konfigurieren von E-Mail-Aliasen und automatische Weiterleitungen

Mail-Aliase und Weiterleitungen können für jeden Benutzer konfiguriert werden. Beispielsweise wird für den ersten,  auf dem Server angelegten Benutzer automatisch ein Alias ```root@the.domain.tld``` konfiguriert.  Das bedeutet das eine an diese Adresse gesendete E-Mail im Posteingang des ersten Benutzers endet. Automatische Weiterleitungen können konfiguriert werden, z.B. wenn ein Benutzer kein zusätzliches E-Mail-Konto einrichten möchte und nur E-Mails vom Server, z.B. auf seine E-Mail-Adresse, empfangen möchte.

Eine weitere Funktion, die nur wenigen Leuten bekannt ist, ist die Verwendung von Suffixen, die mit "+" beginnen. Zum Beispiel landen E-Mails, die an ```johndoe+buchung@die.domain.tld``` gesendet werden, automatisch im Ordner ```buchung``` (Kleinbuchstaben) der Mailbox von John Doe oder im Posteingang von John Doe, wenn der Ordner ```buchung``` nicht existiert. Es ist eine praktische Technik, z.B. eine E-Mail-Adresse auf einer Website anzugeben und dann die von dieser Website kommende E-Mail einfach (über automatische Filter) zu sortieren.

## Was passiert wenn mein Server nicht erreichbar ist?

Wenn Ihr Server nicht mehr verfügbar ist, bleiben die an Ihren Server gesendeten E-Mails bis zu ~5 Tage lang in einer Warteschlange auf der Seite des Absenders. Der Hoster des Absenders wird regelmäßig versuchen, die E-Mail erneut zu senden, bis er sie verwirft, falls er sie nicht versenden konnte.

## Formulare zum Entfernen seiner IP-Adresse von der schwarzen Liste

Es ist möglich, dass die von Ihrer YunoHost-Instanz gesendeten E-Mails von den großen E-Mail-Diensten als Spam betrachtet werden. Ist es möglich, dass die IP-Adresse von Ihrem Server bereits früher zum Versenden von Spam verwendet wurde oder dass diese E-Mail-Dienste Ihren Server als Spam-Versender betrachten? Um sicherzustellen, dass die IP-Adresse Ihrer Server nicht in diese schwarzen Listen aufgenommen wird und um sie aus diesen zu entfernen, folgen Sie [diesem Link](https://yunohost.org/#/blacklist_forms).

## Eine Migration von E-Mails von einem E-Mail-Provider zu einer YunoHost-Instanz

Siehe [diese Seite](https://yunohost.org/#/email_migration).

