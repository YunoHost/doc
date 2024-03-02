---
title: Dokumentation schreiben
template: docs
taxonomy:
    category: docs
routes:
  default: '/write_documentation'
---

## Über GitHub

Die YunoHost-Dokumentation wird über ein [Git-Repository](https://github.com/YunoHost/doc) verwaltet.

Wenn Sie mit GitHub nicht vertraut sind, oben auf jeder Seite befindet sich die Schaltfläche "Edit", mit der Sie zum GitHub-Online-Editor weitergeleitet werden, mit dem Sie Änderungsvorschläge machen können (Pull Requests, PR).

Wenn Sie sich jedoch mehrere Bearbeitungen vornehmen oder aktiv mitarbeiten wollen, sollten Sie das Repository forken. Sie können dann alle gewünschten Commits (Änderungen) in Ihrem Fork vornehmen und alle gleichzeitig in dem selben Pull-Requests senden. Die Etikette von GitHub empfiehlt Ihnen, alle damit verbundenen Commits in derselben PR zusammenzufassen.

Da der Online-Editor das Hochladen von Dateien nicht unterstützt, ist die Verwendung von Git die bevorzugte Methode, wenn Sie Medien (z. B. Bilder) hochladen müssen.

## Grav

Unter der Haube wird die Dokumentation vom [Grav CMS](https://getgrav.org/?target=_blank) bereitgestellt.

Die Struktur des Repositorys wird nachfolgend beschrieben:

```text
+ -- config
   + -- site.yaml
   + -- system.yaml 
   + -- themes 
       + -- yunohost-docs.yaml
          # Einige Einstellungen für das Dokumentationstheme
+ -- images
   # Enthält die auf den Dokumentationsseiten verwendeten Bilder. 
+ -- pages 
   # Das Verzeichnis mit den Dokumentationsseiten. 
   # Die Seitenhierarchie spiegelt sich in der Verzeichnishierarchie wider. 
   + -- 00.home 
   + -- 01.administer 
   + -- 02.applications 
   + -- 03.community 
   + -- 04.contribute 
+ -- themes 
    + -- learn4 
    + -- yunohost-docs 
       # Enthält den Code des Themes, dies erweitert den Code des Learn4-Themes 
+ -- .gitignore 
    # Enthält die Anweisungen, keine sensiblen 
    # oder nutzlosen Dateien an das Git-Repository zu senden 
+ -- README.md 
```

!!!! Weitere Informationen zu den Funktionen von Grav finden Sie in der [Dokumentation](https://learn.getgrav.org?target=_blank). Der Rest dieser Seite zeigt Ihnen einige spezifische Anweisungen, die Sie zur Dokumentation von YunoHost beachten sollten..

## Grav-Header

Jede Seite beginnt mit einem Header, der Grav Anweisungen zur Verarbeitung gibt. Werfen wir einen Blick in die Kopfzeile dieser Seite:

```text
--- 
title: Dokumentation schreiben 
template: docs 
taxonomie: 
    category: docs 
routes: 
  default: '/write_documentation' 
--- 
```

1. Die Kopfzeile beginnt und endet mit einer Zeile, die `---` enthält
2. Der `title:` verwaltet die erste Titel-Überschrift der Seite, ihren Namen im Navigationsmenü links und den Namen des Browser-Tab`s
3. Die Punkte `template` und `taxonomie` sollten immer unverändert bleiben. Sie weisen Grav an, das richtige Theme zu verwenden und die Seiten richtig auf zu bauen.
4. Die Schlüssel `routes` und `default` machen die Seite standardmäßig unter `https://yunohost.org/docs/write_documentation` verfügbar, um sie nicht unter `https://yunohost.org/docs/contribute/write_documentation` aufrufen zu müssen, wo sie in der Verzeichnishierarchie gespeichert ist.

## Syntax

Sie können die Markdown-Syntax verwenden. Weitere Informationen finden Sie in der [Dokumentation](/doc_markdown_guide).

! Beachten Sie, dass Sprachcodes nicht am Anfang der Links zu anderen Dokumentationsseiten stehen dürfen: `/en`,`/fr` usw. sind überflüssig.

Um die Markdown-Funktionen zu verbessern, werden zusätzliche Plugins in Grav installiert. In der eigenen Dokumentation auf GitHub erfahren Sie, wie Sie sie verwenden.

```text
anchors
external_links
flex-objects
highlight
image-captions
markdown-notices
presentation
presentation-deckset
shortcode-core
```

## Sonderseiten

Einige Seiten der Dokumentation werden automatisch oder dynamisch generiert.

| Seite | Pfad | Anmerkungen |
| --------------- | ------- | ------- |
| Apps-Katalog | `/pages/02.applications/01.catalog/apps.md` | Ruft [app.json](https://github.com/YunoHost/apps/blob/master/apps.json?target=_blank) ab und verarbeitet sie |
| Apps-Helfer | `pages/04.contribute/04.packaging_apps/11.helpers/package_apps_helpers.md` | Erstellt von diesem [Skript](https://github.com/YunoHost/yunohost/blob/dev/doc/generate_helper_doc.py?target=_blank) aus dieser [Vorlage](https://github.com/YunoHost/yunohost/blob/dev/doc/helper_doc_template.md?target=_blank) |
| Pro-App-Dokumentation | `pages/02.applications/02.docs/docs.md` | Listet die Unterseiten im selben Verzeichnis auf, deren Header `taxonomy.category: docs, apps` enthält |

## Hosten Sie Ihre eigene Testdokumentation

! Diese Anweisungen müssen noch vollständig getestet werden. Bitte helfen Sie uns, indem Sie Probleme melden, die Sie möglicherweise mit ihnen haben.

0. Forken Sie das YunoHost Dokumentations Repository
1. Installieren Sie das YunoHost-Paket Grav : `yunohost app install grav`
2. Installieren Sie die folgenden Plugins durch das Grav Admin-Panel oder CLI:

```text
anchors
breadcrumbs
external_links
feed
flex-objects
git-sync
highlight
image-captions
langswitcher
markdown-notices
presentation
presentation-deckset
shortcode-core
tntsearch 
```

3. Git Sync Plugin einrichten.
   1. Melden Sie sich mit Ihren Anmeldeinformationen auf GitHub an
   2. Legen Sie das Repo fest, z. B. `https://github.com/username/doc`.
   3. Kopieren Sie die URL des Webhooks, z. B. `https://grav.example/_git-sync-ca25c111f0de`.
   4. Grundeinstellungen> Ordner im Sync: `pages`` images` `themes`
   5. Git Repo-Einstellungen> Benutzer nicht erforderlich: Aktiviert
   6. Git Repo-Einstellungen> Web Hooks-Geheimnis: Aktiviert
   7. Erweiterte Einstellungen> Lokaler Branch:`master`
   8. Erweiterte Einstellungen> Remote Branch: `master`  
      (Sie können`master` ändern, wenn Sie an einem anderen Zweig arbeiten möchten, aber vergessen Sie nicht, ihn zuerst auf GitHub zu erstellen.)
   9. Erweiterte Einstellungen> Committer-Name: Ihr GitHub-Benutzername
   10. Erweiterte Einstellungen> Committer-E-Mail : Ihre E-Mail auf GitHub
4. Lokale Kopie speichern und zurücksetzen
5. Konfigurieren Sie `commits` und `tree` in `config/theme/yunohost-docs.yaml`, so das sie auf Ihren Fork des Repositorys verweisen.
6. Stellen Sie sicher, dass die Verzeichnisse `user/pages/01.home` und `user/pages/02.typography` gelöscht werden.
7. Konfiguration> System:
   1. Sprache> Unterstützt: `en` `fr` `de` `es` `ar`
   2. Sprache> Standardsprache überschreiben:`en`
   3. Sprache> Sprache vom Browser einstellen: `Ja`
   4. HTTP-Header> Etag: `Ja`
   5. Erweitert> Blueprint-Kompatibilität:`Ja`
   6. Erweitert> YAML-Kompatibilität: `Ja`
   7. Erweitert> Twig-Kompatibilität:`Ja`
