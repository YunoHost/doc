---
title: Domains, DNS conf und Zertifikat
template: docs
taxonomy:
    category: docs
routes:
  default: '/domains'
---

YunoHost ermöglicht es Ihnen, mehrere Domains auf demselben Server zu verwalten und zu bedienen. Zum Beispiel können Sie einen Blog und Nextcloud auf einer ersten Domain `yolo.com` hosten, und einen Web-Mail-Client auf einer zweiten Domain `swag.nohost.me`. Jede Domain wird automatisch so konfiguriert, dass sie Web-, Mail- und XMPP-Dienste nutzen kann.

Domains können im Abschnitt 'Domain' des Webadmin verwaltet werden, oder über die Kategorie `yunohost domain` in der Kommandozeile.

Jedes Mal, wenn Sie eine Domain hinzufügen, wird erwartet, dass Sie sie bei einem Domain-Registrar gekauft haben (oder besitzen), damit Sie die [DNS-Konfiguration](/dns_config) verwalten können. Die Ausnahme sind die [`.nohost.me`, `.noho.st` und `ynh.fr` Domains](/dns_nohost_me), die vom YunoHost-Projekt bezahlt werden und dank einer automatisierten dynDNS-Einrichtung direkt in YunoHost integriert werden können. Um Kosten und Missbrauch zu begrenzen, kann jede Instanz immer nur eine dieser Domains einrichten, Sie können jedoch so viele Subdomains hinzufügen, wie Sie möchten. Wenn Sie zum Beispiel `example.noho.st` wählen, können Sie später die Domains `video.example.noho.st` oder `www.example.ynh.noho.st` oder jede andere Subdomain hinzufügen, die Sie benötigen.

Die bei der Erstkonfiguration (nach der Installation) gewählte Domäne wird als Hauptdomäne des Servers definiert: von hier aus werden das SSO und die Webverwaltungsschnittstelle verfügbar sein. Die Hauptdomain kann später über die Webverwaltung unter Domains > (die Domain) > Set default oder mit der Befehlszeile `yunohost tools maindomain` geändert werden.

Beachten Sie abschließend, dass es im Kontext von YunoHost keine Hierarchie zwischen den ihm bekannten Domains gibt. Im obigen Beispiel könnten Sie eine dritte Domain `foo.yolo.com` hinzufügen - diese würde aber als eine von `yolo.com` unabhängige Domain betrachtet werden.

## Nicht-lateinische Zeichen

Wenn Ihre Domain spezielle, nicht-lateinische Zeichen enthält, müssen Sie ihre [internationalisierte Version](https://de.wikipedia.org/wiki/Internationalisierter_Domainname) über [Punycode](https://de.wikipedia.org/wiki/Punycode) verwenden. Sie können [diesen Konverter](https://www.charset.org/punycode) verwenden und den konvertierten Domainnamen in Ihrer YunoHost-Konfiguration verwenden. 

## Subdomains

! Bitte beachten Sie, dass YunoHost Domains und deren Subdomains unabhängig voneinander betrachtet.
! Sie **müssen** alle Domains und Subdomains, die Sie nutzen möchten, registrieren.

## DNS-Konfiguration

DNS (Domain Name System) ist ein System, das es Computern auf der ganzen Welt ermöglicht, von Menschen lesbare Domain-Namen (wie z.B. `yolo.com`) in maschinenverständliche Adressen, sogenannte IP-Adressen (wie z.B. `11.22.33.44`), zu übersetzen. Damit diese Übersetzung (und andere Funktionen) funktioniert, müssen Sie DNS-Einträge sorgfältig konfigurieren. 

YunoHost kann eine empfohlene DNS-Konfiguration für jede Domain generieren, einschließlich der für Mail und XMPP benötigten Elemente. Die empfohlene DNS-Konfiguration ist im Webadmin über Domain > (die Domain) > DNS-Konfiguration oder mit dem Befehl `yunohost domain dns-conf the.domain.tld` verfügbar.

## SSL/HTTPS-Zertifikate

Ein weiterer wichtiger Aspekt der Domain-Konfiguration ist das SSL/HTTPS-Zertifikat. YunoHost ist mit Let's Encrypt integriert, so dass der Administrator ein Let's Encrypt-Zertifikat anfordern kann, sobald Ihr Server von jedem im Internet über den Domainnamen korrekt erreichbar ist. Siehe die Dokumentation über [certificates](/certificate) für weitere Informationen.

## Unterpfade vs. einzelne Domains pro Anwendungen

!!!! Section to be moved to a translated /apps_overview page

Im Zusammenhang mit YunoHost ist es durchaus üblich, eine einzige (oder einige wenige) Domains zu haben, auf denen mehrere Anwendungen in "Unterpfaden" installiert sind, so dass man am Ende etwas wie dieses erhält: 

```bash
yolo.com
     ├── /blog : Wordpress (ein Blog)
     ├─── /cloud : Nextcloud (ein Cloud-Dienst)
     ├─── /rss : TinyTiny RSS (ein RSS-Reader)
     ├── /wiki : DokuWiki (ein Wiki)
```

Alternativ können Sie jede (oder einige) Anwendungen auf einer eigenen Domäne installieren. Abgesehen von der Ästhetik bietet die Verwendung von Subdomänen anstelle von Subpfaden die Möglichkeit, einen Dienst leichter auf einen anderen Server zu verschieben. Außerdem kann es sein, dass einige Anwendungen aus technischen Gründen eine eigene Domäne benötigen. Der Nachteil ist, dass Sie jedes Mal eine neue Domäne hinzufügen und daher möglicherweise zusätzliche DNS-Einträge konfigurieren, die Diagnose neu starten und ein neues Let's Encrypt-Zertifikat installieren müssen.

Dies mag für Endbenutzer hübscher aussehen, wird aber im Allgemeinen als komplizierter und weniger effizient im Zusammenhang mit YunoHost angesehen, da Sie jedes Mal eine neue Domain hinzufügen müssen. Dennoch kann es sein, dass einige Anwendungen aus technischen Gründen eine eigene Domain benötigen.

Wenn alle Anwendungen aus dem vorherigen Beispiel auf einer separaten Domain installiert wären, würde dies etwa so aussehen:

```bash
blog.yolo.com : Wordpress (ein Blog)
cloud.yolo.com : Nextcloud (ein Cloud-Dienst)
rss.yolo.com : TinyTiny RSS (ein RSS-Reader)
wiki.yolo.com : DokuWiki (ein Wiki)
```

!!! Viele Anwendungen verfügen über eine Funktion, mit der Sie die URL Ihrer Anwendung ändern können. Diese Wahl zwischen Subpfad und Subdomain kann in einigen Fällen durch eine einfache Manipulation in der Verwaltungsschnittstelle umgekehrt werden.
