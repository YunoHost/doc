---
title: Was ist YunoHost?
template: docs
taxonomy:
    category: docs
routes:
  default: '/whatsyunohost'
---

![](image://YunoHost_logo_vertical.png?resize=400&id=ynhlogo)

YunoHost ist ein **Betriebssystem**, das auf die einfachste Verwaltung eines **Servers** abzielt und daher das [Self-Hosting](/selfhosting) demokratisiert, wobei sichergestellt wird, dass es zuverlässig, sicher, ethisch einwandfrei und leichtgewichtig bleibt. Es ist ein Copylefted-Libre-Softwareprojekt, das ausschließlich von Freiwilligen betrieben wird. Technisch gesehen kann es als eine Distribution angesehen werden, die auf [Debian GNU/Linux](https://debian.org) basiert und auf [vielen Arten von Hardware](/install) installiert werden kann.

## Features

- ![](image://icon-debian.png?resize=32&classes=inline) Basierend auf Debian ;
- ![](image://icon-tools.png?resize=32&classes=inline) Verwalten Sie Ihren Server über eine **benutzerfreundliche Weboberfläche** ;
- ![](image://icon-package.png?resize=32&classes=inline) Bereitstellen von **Apps mit nur wenigen Klicks** ;
- ![](image://icon-users.png?resize=32&classes=inline) Verwalten Sie **Benutzer** <small>(basierend auf LDAP)</small> ;
- ![](image://icon-globe.png?resize=32&classes=inline) Verwalten Sie Ihre **Domainnamen** ;
- ![](image://icon-medic.png?resize=32&classes=inline) Erstellen und Wiederherstellen von **Backups** ;
- ![](image://icon-door.png?resize=32&classes=inline) Stellen Sie über das **Benutzerportal** <small>(NGINX, SSOwat)</small> gleichzeitig eine Verbindung zu allen Apps her ;
- ![](image://icon-mail.png?resize=32&classes=inline) Enthält einen **vollständigen E-Mail-Stack** <small>(Postfix, Dovecot, Rspamd, DKIM)</small> ;
- ![](image://icon-messaging.png?resize=32&classes=inline) … sowie **einen Instant Messaging Server** <small>(XMPP)</small> ;
- ![](image://icon-lock.png?resize=32&classes=inline) Verwaltet **SSL-Zertifikate** <small>(basierend auf Let's Encrypt)</small> ;
- ![](image://icon-shield.png?resize=32&classes=inline) … und **Sicherheitssysteme** <small>(fail2ban, yunohost-firewall)</small> ;

## Ursprung

YunoHost wurde im Februar 2012 aus folgender Situation heraus erstellt:

 <blockquote><p>"Scheiße, ich bin zu faul, um meinen Mailserver neu zu konfigurieren ... Beudbeud, wie hast Du deinen kleinen Server mit LDAP zum Laufen gebracht?"</p><small> Kload, Februar 2012</small></blockquote>

Alles, was benötigt wurde, war eine Administrationsoberfläche für Beudbeud's Server, um etwas nutzbar zu machen, also entschied sich Kload, eine zu entwickeln. Schließlich wurde YunoHost v1, nach der Automatisierung mehrerer Konfigurationen und der Paketierung in einigen Webanwendungen, fertiggestellt.

Angesichts der wachsenden Begeisterung für YunoHost und für das Selbst-Hosting im Allgemeinen beschlossen die ursprünglichen Entwickler zusammen mit neuen Mitarbeitern, mit der Arbeit an Version 2 zu beginnen, einer erweiterbaren, leistungsfähigeren, benutzerfreundlicheren und damit einfacheren Version eine schöne Tasse Fairtrade-Kaffee für die Elfen von Lappland.

Der Name **YunoHost** stammt aus dem Jargon "Y U NO Host". Das [Internet meme](https://en.wikipedia.org/wiki/Internet_meme) sollte dies veranschaulichen:
![](image://dude_yunohost.jpg)

## Was YunoHost nicht ist?

Selbst wenn YunoHost mehrere Domains und mehrere Benutzer verwalten kann, ist es **nicht als ein mutualisiertes System gedacht**.

Erstens ist die Software noch sehr jung, nicht auf ihre Skalierbarkeit getestet und daher wahrscheinlich nicht gut genug optimiert für Hunderte von Benutzern gleichzeitig. Vor diesem Hintergrund möchten wir die Software nicht in diese Richtung lenken. Die Virtualisierung demokratisiert sich und ihre Verwendung wird empfohlen, da sie eine wasserdichtere Methode zur Erzielung von Gegenseitigkeit darstellt als ein "Full-Stack"-System wie YunoHost.

Sie können Ihre Freunde, Ihre Familie und Ihr Unternehmen sicher und problemlos aufnehmen, aber Sie müssen **Ihren Benutzern vertrauen**, und diese müssen vor allem Ihnen vertrauen. Wenn Sie ohnehin YunoHost-Dienste für unbekannte Personen bereitstellen möchten, ist ein vollständiger VPS pro Benutzer in Ordnung, und wir glauben, dass dies ein besserer Weg ist.

## Artworks

Schwarz und Weiss YunoHost PNG logo by ToZz (400 × 400 px):

![](image://ynh_logo_black_300dpi.png?resize=220)
![](image://ynh_logo_white_300dpi.png?resize=220&id=whitelogo)

Licence: CC-BY-SA 4.0
