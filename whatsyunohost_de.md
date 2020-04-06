Was ist YunoHost?
=================

<img src="/images/YunoHost_logo_vertical.png" width=400>

YunoHost ist ein **Betriebssystem**, das auf die einfachste Verwaltung eines **Servers** abzielt und daher das [Self-Hosting](selfhosting) demokratisiert, wobei sichergestellt wird, dass es zuverlässig, sicher, ethisch einwandfrei und leichtgewichtig bleibt. Es ist ein Copylefted-Libre-Softwareprojekt, das ausschließlich von Freiwilligen betrieben wird. Technisch gesehen kann es als eine Distribution angesehen werden, die auf [Debian GNU / Linux](https://debian.org) basiert und auf [vielen Arten von Hardware](install) installiert werden kann.

Features
--------

- <img src="/images/icon-debian.png" width=32 style="margin-right:5px"> Basierend auf Debian ;
- <img src="/images/icon-tools.png" width=32 style="margin-right:5px" width=64> Verwalten Sie Ihren Server über eine **benutzerfreundliche Weboberfläche** ;
- <img src="/images/icon-package.png" width=32 style="margin-right:5px"> Bereitstellen von **Apps mit nur wenigen Klicks** ;
- <img src="/images/icon-users.png" width=32 style="margin-right:5px"> Verwalten Sie **Benutzer** <small>(basierend auf LDAP)</small> ;
- <img src="/images/icon-globe.png" width=32 style="margin-right:5px"> Verwalten Sie Ihre **Domainnamen** ;
- <img src="/images/icon-medic.png" width=32 style="margin-right:5px"> Erstellen und Wiederherstellen von **Backups** ;
- <img src="/images/icon-door.png" width=32 style="margin-right:5px"> Stellen Sie über das **Benutzerportal** <small>(NGINX, SSOwat)</small> gleichzeitig eine Verbindung zu allen Apps her ;
- <img src="/images/icon-mail.png" width=32 style="margin-right:5px"> Enthält einen **vollständigen E-Mail-Stack** <small>(Postfix, Dovecot, Rspamd, DKIM)</small> ;
- <img src="/images/icon-messaging.png" width=32 style="margin-right:5px"> … sowie **einen Instant Messaging Server** <small>(XMPP)</small> ;
- <img src="/images/icon-lock.png" width=32 style="margin-right:5px"> Verwaltet **SSL-Zertifikate** <small>(basierend auf Let's Encrypt)</small> ;
- <img src="/images/icon-shield.png" width=32 style="margin-right:5px"> … und **Sicherheitssysteme** <small>(fail2ban, yunohost-firewall)</small> ;

Ursprung
------

YunoHost wurde im Februar 2012 aus folgender Situation heraus erstellt:

 <blockquote><p>"Scheiße, ich bin zu faul, um meinen Mailserver neu zu konfigurieren ... Beudbeud, wie hast Du deinen kleinen Server mit LDAP zum Laufen gebracht?"</p><small> Kload, Februar 2012</small></blockquote>

Alles, was benötigt wurde, war eine Administrationsoberfläche für Beudbeud's Server, um etwas nutzbar zu machen, also entschied sich Kload, eine zu entwickeln. Schließlich wurde YunoHost v1, nach der Automatisierung mehrerer Konfigurationen und der Paketierung in einigen Webanwendungen, fertiggestellt.

Angesichts der wachsenden Begeisterung für YunoHost und für das Selbst-Hosting im Allgemeinen beschlossen die ursprünglichen Entwickler zusammen mit neuen Mitarbeitern, mit der Arbeit an Version 2 zu beginnen, einer erweiterbaren, leistungsfähigeren, benutzerfreundlicheren und damit einfacheren Version eine schöne Tasse Fairtrade-Kaffee für die Elfen von Lappland.

Der Name **YunoHost** stammt aus dem Jargon "Y U NO Host". Das [Internet meme](https://en.wikipedia.org/wiki/Internet_meme) sollte dies veranschaulichen:
<div class="text-center"><img style="border-radius: 5px; box-shadow: 0 5px 15px rgba(0,0,0,0.15);" src="/images/dude_yunohost.jpg"></div>

Was YunoHost nicht ist?
---------------------

Selbst wenn YunoHost mehrere Domains und mehrere Benutzer verwalten kann, ist es **nicht als ein mutualisiertes System gedacht**.

Erstens ist die Software noch sehr jung, nicht auf ihre Skalierbarkeit getestet und daher wahrscheinlich nicht gut genug optimiert für Hunderte von Benutzern gleichzeitig. Vor diesem Hintergrund möchten wir die Software nicht in diese Richtung lenken. Die Virtualisierung demokratisiert sich und ihre Verwendung wird empfohlen, da sie eine wasserdichtere Methode zur Erzielung von Gegenseitigkeit darstellt als ein "Full-Stack"-System wie YunoHost.

Sie können Ihre Freunde, Ihre Familie und Ihr Unternehmen sicher und problemlos aufnehmen, aber Sie müssen **Ihren Benutzern vertrauen**, und diese müssen vor allem Ihnen vertrauen. Wenn Sie ohnehin YunoHost-Dienste für unbekannte Personen bereitstellen möchten, ist ein vollständiger VPS pro Benutzer in Ordnung, und wir glauben, dass dies ein besserer Weg ist.

Artworks
---------

Schwarz und Weiss YunoHost PNG logo by ToZz (400 × 400 px):

<a href="/images/ynh_logo_black_300dpi.png"><img src="/images/ynh_logo_black_300dpi.png" width=220></a>

<a href="/images/ynh_logo_white_300dpi.png"><img src="/images/ynh_logo_white_300dpi.png" width=220></a>

Zum download Klicken.

Licence: CC-BY-SA 4.0
