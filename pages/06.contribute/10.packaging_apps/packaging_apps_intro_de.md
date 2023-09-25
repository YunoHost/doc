---
Titel: Einführung in die Paketierung
Template: docs
Taxonomie:
    Kategorie: docs
Routen:
  Standard: '/packaging_apps_intro'
  Aliases:
    - '/packaging_apps'
---

In dieser Dokumentation findest du alle grundlegenden Konzepte und Vokabeln, die du zum Verständnis von Anwendungspaketen benötigst.

Wir werden detailliert beschreiben, was ein YunoHost-Anwendungspaket ist, wie es funktioniert, wie du dein eigenes Paket erstellst und wie du Hilfe findest, wenn du diese benötigst.


## 1. Paketierungs-Philosophie

Die Möglichkeit, Anwendungen einfach aus einem Katalog zu installieren, ist eine Schlüsselfunktion von YunoHost. Während du in den Prozess der YunoHost-Anwendungspaketierung eintauchst, solltest du dich an diese Schlüsselprinzipien erinnern:

- **Der Administrator sollte keinen Doktortitel in Informatik haben, um deine Anwendung installieren, konfigurieren und nutzen zu können**: Gehe davon aus, dass der Administrator keine fortgeschrittenen Computerkenntnisse hat;

- **Weniger ist mehr**, **Keep it simple!**: überfrachte den Administrator nicht mit Dutzenden von technischen Fragen;

- **Die Dinge sollten sofort funktionieren**: zum Beispiel sollte der Administrator den Installationsprozess nicht manuell abschließen müssen, indem er die Zugangsdaten für die Datenbank manuell ausfüllt;

- Bei der Paketierung von YunoHost-Apps geht es **nicht nur um die Installation** von Quellen und Abhängigkeiten: Es geht auch um Wartung (Upgrade, Backup...) und die Integration der App in das YunoHost-Ökosystem (NGINX, SSO/LDAP, Fail2Ban, Anwendungskatalog, UI/UX...)


## 2. Voraussetzungen

In dieser Dokumentation wird vorausgesetzt, dass:

1. Du selbst bereits YunoHost-Administrator bist und weißt, wie der Installationsablauf aussieht;)
2. Du bist einigermaßen vertraut mit Systemadministration und Bash-Programmierung (oder bereit, diese zu lernen);
3. Du bist einigermaßen vertraut mit Git (oder bereit, es zu lernen);
4. Du hast Spaß am Basteln und am Debuggen von Computerkram im Allgemeinen.

Du bist auch eingeladen, dem [app packaging chatroom](/chat_rooms) beizutreten, um alle Fragen zu stellen, die du vielleicht hast!

Irgendwann wirst du auch eine Entwicklungs-/Testumgebung haben wollen, entweder mit [VirtualBox](/packaging_apps_virtualbox) oder [LXC/ynh-dev](https://github.com/yunohost/ynh-dev), das für den Kern gedacht ist, aber durchaus auch für die Entwicklung von Anwendungen verwendet werden kann. Du kannst auch einen Dev/Test-VPS bei deinem bevorzugten Hosting-Anbieter einrichten oder sogar auf deinem Prod entwickeln, wenn du gerne gefährlich lebst ;).

## 3. Anmerkungen zur Geschichte der YunoHost-App-Pakete

Viele Dinge bei YunoHost und dem YunoHost App-Packaging-Format sind historisch bedingt oder wurden auf organische Art und Weise entwickelt. Daher können sich einige Aspekte zu Recht alt anfühlen.

Die **"v0" der App-Paketierung** bestand aus dem Schreiben roher Bash-Skripte ohne echte Standardisierung/Einschränkung.

Mit der Zeit wurden wiederkehrende Schritte (wie die Installation von Abhängigkeiten mit apt oder die Einrichtung der NGINX-Konfiguration) in standardisierte Bash-Funktionen, auch "Helfer" genannt, formalisiert. Dies markierte so ziemlich **den Beginn der Ära der "v1"-Pakete**.

Verschiedene Tools wurden implementiert, um die Anwendung zu testen und ihr Verhalten zu standardisieren.

Nach einer Weile bildete sich eine Reihe von gemeinsamen Praktiken und Konventionen heraus, die sich in der `example_ynh`-Vorlagenanwendung widerspiegeln und erhalten. Während es für Entwickler verlockend ist, die Namensschemata von Variablen zu ändern oder die Struktur von Skripten zu refaktorisieren, stellt sich heraus, dass es sogar noch wichtiger ist, sich an die gemeinsamen Praktiken zu halten (auch wenn sie willkürlich und nicht elegant sind), um die Wartung aller Anwendungen durch jedes Mitglied der Paketierungsgemeinschaft über alle Repos hinweg zu erleichtern!

Nichtsdestotrotz war die inhärente Struktur von Anwendungen, auch wenn es Helfer gab, schwer und langweilig zu warten, da sie zu viele redundante Codestücke enthielt oder mit seltsamen historischen Konventionen gefüllt war. **Ein neues v2-Format** [wurde entworfen und zu YunoHost 11.1 Anfang 2023 hinzugefügt] (https://github.com/YunoHost/yunohost/pull/1289) in der Hoffnung, das App-Packaging zu modernisieren und zu vereinfachen und die UI/UX von YunoHost zu verbessern.

Es wird jedoch [**ein zukünftiges v3-Format**](https://github.com/YunoHost/issues/issues/2136) geben, um die Paketierung von Anwendungen weiter zu vereinfachen (z.B. durch die Übernahme von NGINX/systemd/... Konfigurationen, die Beseitigung der Notwendigkeit, Skripte zum Entfernen/Backup/Wiederherstellen manuell zu schreiben, usw.)


## 4. Allgemeiner Überblick über die Struktur einer YunoHost-App

Eine YunoHost-Anwendung besteht aus einem Git-Repository. Wir empfehlen dir, einen Blick auf diese Code-Repositories zu werfen, um dich mit der Struktur der App-Repositories vertraut zu machen:
- [die `helloworld_ynh` App](https://github.com/YunoHost-Apps/helloworld_ynh)
- [die `example_ynh` app](https://github.com/YunoHost/example_ynh), die alle gängigen Funktionen und empfohlenen Formatierungen veranschaulicht
- Deine bevorzugte "Real-Life"-App in der [YunoHost-Apps-Organisation](https://github.com/orgs/YunoHost-Apps/repositories)

Unter den in einem Paket enthaltenen Dateien sind die wichtigsten: 

- das **Anwendungsmanifest** `manifest.toml` <small>(oder `.json` in der Vergangenheit)</small>
    - Dies kann als der Ausweis der Anwendung angesehen werden, der verschiedene Metadaten enthält. 
    - Sie enthält auch die Fragen, die bei der Installation der Anwendung gestellt werden.
    - und eine Reihe von "Ressourcen" zum Initialisieren, wie z.B. herunterzuladende Quellen oder zu installierende apt-Abhängigkeiten
- **scripts/** enthält eine Reihe von Bash-Skripten, die den in YunoHost angebotenen Aktionen entsprechen
   - `_common.sh`: gemeinsame Variablen oder eigene Funktionen, die in anderen Skripten enthalten sind
   - `install`/`remove`: die Installations- und Deinstallationsprozedur
   - `upgrade`: die Upgrade-Prozedur
   - `backup`/`restore`: die Sicherungs-/Wiederherstellungsprozeduren 
   - (`change_url`): Ändern des Ortes, an dem die Anwendung in Bezug auf die Webzugriffsurl installiert ist
- **conf/** enthält eine Reihe von Konfigurationsvorlagen, die bei der Installation der Anwendung verwendet werden. Hier sind einige Beispiele für häufig vorkommende Dateien:
   - `nginx.conf`: die NGINX (=Webserver) Konfigurationsvorlage für diese Anwendung
   - systemd.service": die Konfigurationsvorlage für den systemd-Dienst für diese Anwendung
   - config.json/yaml/???`: die Konfigurationsvorlage für die Anwendung

Grob gesagt besteht die Installation selbst im Allgemeinen aus den folgenden Vorgängen (die jedoch je nach Komplexität und von der App verwendeten Technologien variieren können) - nicht unbedingt in dieser genauen Reihenfolge:

1. YunoHost holt das Git-Repository des Pakets
2. YunoHost stellt dem Administrator die in `manifest.toml` definierten Fragen zur Installation
3. Der Administrator füllt das Formular aus und startet die Installation
4. YunoHost stellt eine Reihe von technischen Voraussetzungen (genannt 'Ressourcen') bereit, wie z.B.:
    - Initialisierung des Schlüssel/Wertspeichers der Anwendung `settings.yml` mit den Antworten des Administrators auf das Installationsformular
    - legt einen UNIX-Systembenutzer für diese Anwendung an
    - installiert apt-Abhängigkeiten, die für diese Anwendung benötigt werden
    - wählt einen Port für internes Reverse-Proxying aus
    - initialisiert eine leere SQL-Datenbank
    - konfiguriert SSOwat-Berechtigungen
    - ...
5. Das eigentliche Skript `Install` wird ausgeführt und erledigt in der Regel:
    - Holen und Bereitstellen der App-Quellen
    - die App konfigurieren (typischerweise DB-Anmeldedaten, interner Reverse-Proxy-Port...)
    - Hinzufügen der NGINX-Konfiguration
    - Hinzufügen der systemd-Konfiguration für den Daemon der Anwendung
    - Startet den Daemon der Anwendung
    - verschiedene Feinabstimmungen zur Fertigstellung
6. ???
7. Die Anwendung ist einsatzbereit!


## 5. Erstellen deines allerersten YunoHost-Pakets

Wenn du nicht wirklich bei Null anfangen willst oder von [`example_ynh`](https://github.com/YunoHost/example_ynh), ist eine gängige Praxis, eine Anwendung zu identifizieren, die derjenigen ähnlich ist, die du zu paketieren versuchst - typischerweise, weil du dich auf die gleichen Technologien stützt -, das entsprechende Code-Repository zu klonen und die verschiedenen Dateien anzupassen. 

TODO/FIXME : hier sollten wir eine Reihe von bekannten Anwendungen für klassische Technologien auflisten

- PHP-Anwendungen:
- NodeJS-Apps:
- Python-Apps:
- ???
