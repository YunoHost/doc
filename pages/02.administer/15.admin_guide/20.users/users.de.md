---
title: Benutzer und das SSO
template: docs
taxonomy:
    category: docs
routes:
  default: '/users'
---

## Benutzer

Benutzer sind Menschen, die Zugang zu Anwendungen und anderen Diensten auf Ihrem Server haben. Der Administrator kann Benutzer über die Webadministration (in der Kategorie Benutzer) oder über die Kommandozeile (siehe `yunohost user --help`) hinzufügen und verwalten. Danach erhalten die Benutzer eine persönliche E-Mail-Adresse (vom Administrator ausgewählt), und können sich im Benutzerportal anmelden, um auf Anwendungen zuzugreifen, für die sie Berechtigungen haben, und andere Parameter zu konfigurieren.

Der erste Benutzer, der angelegt wird, erhält auch automatisch die E-Mail-Aliase `root@main.domain.tld` und `admin@main.domain.tld`, so dass E-Mails, die an diese Adressen geschickt werden, im Postfach des ersten Benutzers landen.

! Sie sollten vorsichtig sein, wem Sie Zugang zu Ihrem Server gewähren. Im Hinblick auf die Sicherheit vergrößert sich dadurch die Angriffsfläche für jemanden, der sich auf die eine oder andere Weise am Server zu schaffen machen will.

## Das Benutzerportal oder SSO

[center]
![](image://user_panel.jpg)
[/center]

Das Benutzerportal, auch SSO für 'Single Sign On' genannt, ermöglicht es den Benutzern, einfach zwischen den verschiedenen Anwendungen, auf die sie Zugriff haben, zu wechseln. Der Begriff "Single Sign On" kommt daher, dass der Benutzer sich nur im Portal anmelden muss, um automatisch bei allen Anwendungen angemeldet zu werden, die eine Authentifizierung erfordern (oder zumindest bei denen, die mit SSO/LDAP integriert sind, da dies manchmal technisch kompliziert oder gar nicht möglich ist).

Im Portal können Benutzer auch auf den Avatar oben links klicken, um einige andere Einstellungen zu konfigurieren, z. B. ihre Identität, E-Mail-Aliase, automatische E-Mail-Weiterleitungen oder ihr Passwort zu ändern.

!!! Sie sollten sich bewusst sein, dass das SSO nur über den tatsächlichen Domänennamen (z.B. `https://the.domain.tld/yunohost/sso`) erreicht werden kann, und NICHT über die IP des Servers (z.B. `https://11.22.33.44/yunohost/sso`), im Gegensatz zum Webadmin! Dies ist ein wenig verwirrend, aber aus technischen Gründen notwendig. Wenn Sie sich in einer Situation befinden, in der Sie auf das SSO zugreifen müssen, ohne dass Ihr DNS richtig konfiguriert ist, könnten Sie in Erwägung ziehen, Ihre `/etc/hosts` wie in [dieser Seite](/dns_local_network) beschrieben zu verändern.

## Benutzergruppen und Berechtigungen

Siehe [diese spezielle Seite](/groups_and_permissions).

## SSH-Zugang

Siehe [diese spezielle Seite](/ssh).
