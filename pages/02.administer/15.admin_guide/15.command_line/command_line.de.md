---
title: SSH
template: docs
taxonomy:
    category: docs
routes:
  default: '/ssh'
  aliases:
    - '/commandline'
page-toc:
  active: true
---

## Was ist SSH?

**SSH** steht für **S**ecure **Sh**ell, und bezeichnet ein Protokoll, dass es einem erlaubt über ein entferntes System auf die Kommandozeile (Command Line Interface, **CLI**) zuzugreifen. SSH ist standardmäßig auf jedem Terminal auf GNU/Linux oder macOS verfügbar. Für Windows ist Drittsoftware nötig, z.B. [MobaXterm](https://mobaxterm.mobatek.net/download-home-edition.html) (Klicke nach dem Start auf Session und dann SSH).

## Während der YunoHost Installation

#### Finde deine IP

Solltest du auf einem VPS installieren, dann hat der VPS Provider die IP-Adresse, die du bei ihm erfragen solltest. 

Wenn du Zuhause installierst (z.B. auf einem Raspberry Pi oder OLinuXino), dann musst du herausfinden, welche IP-Adresse dein Router dem System zugewiesen hat. Hierfür existieren mehrere Wege:
- Öffne ein Terminal und tippe `sudo arp-scan --local` ein, um eine Liste der aktiven IP-Adressen deines lokalen Netzwerks anzuzeigen;
- wenn dir der arp-scan eine zu unübersichtliche Zahl an Adressen anzeigt, versuche mit `nmap -p 22 192.168.**x**.0/24` nur die anzuzeigen, deren SSH-Port 22 offen ist. (passe das **x** deinem Netzwerk an);
- Prüfe die angezeigten Geräte in der Benutzeroberfläche deines Routers, ob du das Gerät findest;
- Schließe einen Bildschirm und Tastatur an deinen Server, logge dich ein und tippe `hostname --all-ip-address`.

#### Verbinden

Angenommen deine IP Addresse ist `111.222.333.444`, öffne einen Terminal und gib Folgendes ein:

```bash
ssh root@111.222.333.444
```

Es wird nach einem Passwort gefragt. Handelt es sich um einen VPS, sollte der VPS Provider dir das Passwort kommuniziert haben. Wenn du ein pre-installed image benutzt (für x86 Computer oder ARM boards), sollte das Passwort `yunohost` sein.

! Seit YunoHost 3.4 kann man sich nach dem Ausführen der Postinstallation nicht mehr als `root` anmelden. **Stattdessen sollte man sich mit dem `admin` Benutzer anmelden!** Für den Fall, dass der LDAP-Server defekt und der `admin` Benutzer nicht verwendbar ist, kann man sich eventuell trotzdem noch mit `root` über das lokale Netzwerk anmelden.

#### Ändere das Passwort!

Nach dem allerersten Login sollte man das root Passwort ändern. Der Server könnte dazu automatisch auffordern. Falls nicht, ist der Befehl `passwd` zu benutzen. Es ist wichtig, ein einigermaßen starkes Passwort zu wählen. Beachte, dass das root Passwort durch das admin Passwort überschrieben wird, wenn man die Postinstallation durchführt.

#### Auf ans Konfigurieren!

Wir sind nun bereit, mit der [Postinstallation](/postinstall) zu beginnen.

## Nach der Installation von YunoHost

Wenn du deinen Server zu Hause installiert hast und versuchst, dich von außerhalb deines lokalen Netzwerks zu verbinden, stell sicher, dass Port 22 korrekt an deinen Server weitergeleitet wird. (Zur Erinnerung: seit YunoHost 3.4 solltest du dich mit dem Benutzer `admin` verbinden).

Wenn du nur die IP-Adresse deines Servers kennst :

```bash
ssh admin@111.222.333.444
```

Dann musst du dein Administratorkennwort eingeben, das du unter [Post-Installationsschritt](/postinstall) erstellt hast.

Wenn du dein DNS konfiguriert hast (oder deine `/etc/hosts` optimiert hast), kannst du einfach deinen Domainnamen verwenden:

```bash
ssh admin@your.domain.tld
```

Wenn du den SSH-Port geändert hast, musst du `-p <Portnummer>` an den Befehl anhängen, z.B. :

```bash
ssh -p 2244 admin@your.domain.tld
```

!!! Wenn du als `admin` verbunden bist und aus Bequemlichkeit `root` werden möchtest (z.B. um nicht vor jedem Befehl `sudo` eintippen zu müssen), kannst du mit dem Befehl `sudo su` `root` werden.

## Welche Benutzer?

Standardmäßig kann sich nur der Benutzer `admin` am YunoHost SSH-Server anmelden.

Die über die Administrationsoberfläche angelegten Benutzer von YunoHost werden über das LDAP-Verzeichnis verwaltet. Standardmäßig können sie sich aus Sicherheitsgründen nicht über SSH anmelden. Wenn du möchtest, dass einige Benutzer SSH-Zugang haben, verwende den Befehl:

```bash
yunohost user permission add ssh.main <username>
```

Es ist auch möglich, den SSH-Zugang wie folgt zu entfernen:

```bash
yunohost user permission remove ssh.main <username>
```

Schließlich ist es möglich, SSH-Schlüssel hinzuzufügen, zu löschen und aufzulisten, um die Sicherheit des SSH-Zugangs zu verbessern, indem man die Befehle verwendet:

```bash
yunohost user ssh add-key <username> <key>
yunohost user ssh remove-key <username> <key>
yunohost user ssh list-keys <username>
```

## Sicherheit und SSH

N.B.: `fail2ban` sperrt deine IP für 10 Minuten, wenn du 5 fehlgeschlagene Login-Versuche durchführst. Wenn du die IP-Sperre aufheben willst, schau dir die Seite über [Fail2Ban](/fail2ban) an.

Eine ausführlichere Diskussion über Sicherheit & SSH findest du auf der [dedicated page](/security).


## YunoHost Kommandozeile

!!! Ein vollständiges Tutorial über die Kommandozeile würde den Rahmen der YunoHost-Dokumentation sprengen: Lies dazu am besten ein spezielles Tutorial wie [dieses](https://ryanstutorials.net/linuxtutorial/) oder [dieses](http://linuxcommand.org/). Aber sei versichert, dass du kein CLI-Experte sein musst, um es zu benutzen!

Der Befehl "yunohost" kann zur Verwaltung deines Servers verwendet werden und führt verschiedene Aktionen aus, die denen des Webadmin ähneln. Der Befehl muss entweder vom `root`-Benutzer oder vom `admin`-Benutzer durch Voranstellen von `sudo` gestartet werden. (ProTip™ : Du kannst `root` mit dem Befehl `sudo su` als `admin` werden).

YunoHost-Befehle haben normalerweise diese Art von Struktur: 

```bash
yunohost app install wordpress --label Webmail
          ^    ^        ^             ^
          |    |        |             |
    category  action  argument      options
```

Zögere nicht, nach weiteren Informationen zu einer bestimmten Kategorie oder Aktion zu fragen, indem du die Option `--help` verwendest. Zum Beispiel listen diese Befehle : 

```bash
yunohost --help
yunohost user --help
yunohost user create --help
```

nacheinander alle verfügbaren Kategorien auf, dann die in der Kategorie `Benutzer` verfügbaren Aktionen, dann die Verwendung der Aktion `Benutzer erstellen`. Du wirst feststellen, dass der YunoHost-Befehlsbaum eine ähnliche Struktur aufweist wie die YunoHost-Admin-Seiten.
