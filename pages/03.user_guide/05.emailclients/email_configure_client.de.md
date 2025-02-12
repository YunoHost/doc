---
title: E-Mail-Client konfigurieren
template: docs
taxonomy:
    category: docs
routes:
  default: '/email_configure_client'
---

Sie können E-Mails über Ihre YunoHost-Instanz von Desktop-E-Mail-Clients wie Thunderbird Desktop oder auf Ihrem Smartphone mit Anwendungen wie K-9 Mail abrufen und versenden.

Moderne Mail-Clients sollten in der Lage sein, sich automatisch zu konfigurieren. Wenn die Autokonfiguration fehlschlägt, können Sie sie manuell vornehmen, indem Sie die folgenden Anweisungen befolgen. (Wenn die Autokonfiguration fehlschlägt, sollte dies als ein Fehler in YunoHost verstanden werden, und wir würden uns freuen, Ihr Feedback zu lesen, um das Problem auf unserer Seite zu reproduzieren).

### Allgemeine Einstellungen

Hier sind die Elemente, die Sie eingeben sollten, um Ihren Mail-Client manuell zu konfigurieren (`domain.tld` bezieht sich auf das, was nach dem @ in Ihrer E-Mail Adresse steht, und `Benutzername` auf das, was vor dem @ steht).

| Protokoll | Port | Verschlüsselung | Authentifizierung | Benutzername |
| :--:     | :-:  | :--:       | :--:            | :--:                                   |
| IMAP | 993 | SSL/TLS | Normales Passwort | `Benutzername` (ohne die `@domain.tld`) |
| SMTP | 587 | STARTTLS | Normales Passwort | `Benutzername` (ohne die `@domain.tld`) |

### Client für Client

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Thunderbird Desktop"]

#### ![](image://thunderbird.png?resize=50&classes=inline) Thunderbird Desktop konfigurieren (auf einem Desktop-Computer)

Um ein neues Konto in Thunderbird Desktop manuell zu konfigurieren, fügen Sie die Kontoinformationen hinzu und wählen dann Port 993 mit SSL/TLS für IMAP und Port 587 mit STARTTLS für SMTP. Wählen Sie anschließend "Normales Passwort" für die Authentifizierung und klicken Sie auf "Erweiterte Konfiguration". Möglicherweise müssen Sie die Zertifikatsausnahmen für das Abrufen von E-Mails und nach dem Senden Ihrer ersten E-Mail akzeptieren. Vergessen Sie nicht, den Punkt vor dem Domainnamen zu entfernen.

![](image://thunderbird_config_1.png?resize=900)
![](image://thunderbird_config_2.png?resize=900)

- [Alias-Mails verwalten](https://support.mozilla.org/de/kb/configuring-email-aliases)

[/ui-tab]
[ui-tab title="K-9 Mail / Thunderbird Mobile"]

#### ![](image://k9mail.png?resize=50&classes=inline) K-9 Mail / Thunderbird Mobile konfigurieren (auf Android)

Führen Sie die folgenden Schritte aus. (Wie bei Thunderbird Desktop müssen Sie möglicherweise an einigen Stellen Zertifikate akzeptieren)

![](image://thunderbird_mobile_config_1.png?resize=280&classes=inline)
![](image://thunderbird_mobile_config_2.png?resize=280&classes=inline)
![](image:/thunderbird_mobile_config_3.png?resize=280&classes=inline)

[/ui-tab]
[ui-tab title="Dekko"]

#### ![](image://dekko-app.png?resize=50&classes=inline) Dekko konfigurieren (auf Ubuntu Touch)

Beim ersten Mal können Sie einfach "Konto hinzufügen" wählen. Wenn Sie bereits ein Konto eingerichtet haben, tippen Sie auf das Hamburger-Menü, dann auf das Zahnrad, wählen Sie Mail, Konten und drücken Sie das '+'-Symbol.

Dann wählen Sie IMAP. Füllen Sie die Felder aus und drücken Sie auf Weiter. Jetzt sucht Dekko nach der Konfiguration. Überprüfen Sie, ob alle Felder korrekt ausgefüllt sind. Vergewissern Sie sich, dass Sie Ihren YunoHost-Benutzernamen und NICHT Ihre Mailadresse eingeben und wählen Sie "Nicht vertrauenswürdige Zertifikate zulassen". Tun Sie dies für IMAP und SMTP und drücken Sie auf Weiter. Dekko wird nun das Konto synchronisieren, danach sind Sie fertig. Herzlichen Glückwunsch!

![](image://dekko_config_1.png?resize=280&classes=inline)
![](image://dekko_config_2.png?resize=280&classes=inline)
![](image://dekko_config_3.png?resize=280&classes=inline)
![](image://dekko_config_4.png?resize=280&classes=inline)
[/ui-tab]
[/ui-tabs]
