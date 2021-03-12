---
title: Zertifikat
template: docs
taxonomy:
    category: docs
routes:
  default: '/certificate'
---

Digitale Zertifikate werden verwendet, um die Vertraulichkeit und Echtheit der Kommunikation zwischen einem Webbrowser und Ihrem Server zu gewährleisten. Insbesondere schützen sie vor Angreifern, die versuchen, Ihren Server zu identifizieren.

YunoHost bietet ein **selbstsigniertes-Zertifikat**. Es bedeutet, dass Ihr Server die Gültigkeit des Zertifikats garantiert. Es genügt **für eine persönliche Verwendung**, weil Sie Ihrem eigenen Server vertrauen. Dies könnte jedoch ein Problem sein, wenn Sie den Zugriff auf einem Fremden, wie Webbenutzer, für eine Website öffnen möchten.
Und zwar, werden die Benutzer eine solche Warnung auf dem Bildschirm sehen:

![](image://postinstall_error_de.png)

Was im Wesentlichen den Besucher fragt: **"Vertrauen Sie dem Server, der diese Website hostet? "**.
Dies kann viele Menschen selbstverständlich erschrecken.

Um diese Verwirrung zu vermeiden, ist es möglich, ein digitales Zertifikat zu erhalten, welches direkt von den Browsern anerkannt wurde, und von einer "bekannten" Zertifizierungsstelle unterzeichnet wird: **Let's Encrypt**, **Gandi**, **RapidSSL**, **StartSSL**, **Cacert**.

**Let's Encrypt** bietet kostenlose Zertifikate an. Seit der Version 2.5 erlaubt YunoHost ein solches Zertifikat direkt von der Verwaltungsschnittstelle oder der Befehlszeile zu installieren. Der Rest des Dokuments erklärt die Installation und Verwaltung eines solchen Zertifikats. Sie können auch [ein digitales Zertifikat von einer anderen Zertifizierungstelle als Let's Encrypt installieren](/certificate_custom).

### Digitales Zertifikat Let's Encrypt installieren

Bevor Sie ein Let's Encrypt-Zertifikat installieren, vergewissern Sie sich, dass Ihr DNS ordnungsgemäß konfiguriert ist (Ihre.Domain.tld sollte auf die IP Ihres Servers zeigen) und Ihre Website von außen in HTTP zugänglich ist (d. h. zumindest der Port 80 wird korrekt an Ihren Server umgeleitet).

#### Mit Web-Verwaltungsschnittstelle

Gehen Sie zu dem Abschnitt "Domaine" der Administrationsoberfläche. Dann
zu dem Abschnitt, der Ihrer Domain entspricht. Da steht einen Knopf 'Certificat SSL'.

![](image://domain-certificate-button.png)

Im Abschnitt 'Certificat SSL', wird der aktuelle Status angegeben.
Wurde der Domain-Name vor kurzem hinzugefügt, so steht ein selbst-signiertes Zertifikat zur verfügung.

![](image://certificate-before-LE.png)

Wenn die Domain korrekt konfiguriert ist, dann ist es möglich 
mit dem grünen Knopf ein Let's Encrypt-Zertifikat einzusetzen.

![](image://certificate-after-LE.png)

Nach Abschluss der Installation, die ensprechende Domain mit Webbrowser
in HTTPS-Modus besuchen um die Berücksichtigung des digitalen Zertifikats
von Let's Encrypt zu überprüfen. Das digitale Zertifikat wird automatisch etwa alle drei Monate erneuert.

![](image://certificate-signed-by-LE.png)

#### Mit Shell-Zugang

SSH-Zugang auf Ihrem Server herstellen.

So können Sie den aktuellen Status des digitalen Zertifikats überprüfen 

```bash
yunohost domain cert-status Ihre.domain.tld
```

Dann Let's Encrypt-Zertifikat installieren

```bash
yunohost domain cert-install Ihre.domain.tld
```

Ergebnis sollte so aussehen :

```bash
Success! The SSOwat configuration has been generated
Success! Successfully installed Let's Encrypt certificate for domain DOMAIN.TLD!
```

Nach Abschluss der Installation, die ensprechende Domain mit Webbrowser
in HTTPS-Modus besuchen um die Berücksichtigung des digitalen Zertifikats
von Let's Encrypt zu überprüfen. Das digitale Zertifikat wird automatisch etwa alle drei Monate erneuert.

##### Fehlerbehebung

Wenn das Zertifikat aufgrund einer schlechten Handhabung nicht funktionsfähig ist
(z. B. Verlust des Zertifikats oder Dateien nicht lesbar), ist es trotzdem möglich
ein selbst-signiertes Zertifikat zu regenerieren :

```bash
yunohost domain cert-install Ihre.domain.tld --self-signed --force
```

Trotz einer sorgfältigen Überprüfung der DNS-Konfiguration und auch von außen
die Möglichkeit mit HTTP-Modus Zugriff auf den Webserver besteht, kann Yunohost
manschmal die Einstellungen verweigern. In diesem Fall ist es notwendig :

- die Parameter `127.0.0.1 Ihre.domain.tld` auf der Datei `/etc/hosts` des Webserver hinzufügen.
Wenn es immer noch nicht funktionsfähig ist, also die Überprüfungen deaktivieren mit `--no-checks` nach dem Befehl `cert-install`.


