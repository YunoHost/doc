# YunoHost manuell installieren

<div class="alert alert-info">
Dieser Vorgang funktioniert nur unter **Debian 10** <small>(mit **kernel >= 3.12**)</small>)
</div>

Sobald Du Zugriff auf die Kommandozeile auf Deinem Server hast (entweder direkt oder über SSH), kannst Du yunohost installieren, in dem Du das folgende Kommando als root ausführst:

```bash
curl https://install.yunohost.org | bash
```

<small>*(Falls `curl` noch nicht auf Deinem System installiert ist, musst Du es eventuell mit `apt install curl` installieren. Falls das Kommando fehlschlägt, ist eventuell ein `apt install ca-certificates` notwendig.)*</small>

Sobald die Installation abgeschlossen ist, fahre mit der [**Postinstallation**](/postinstall) fort.

---

**Anmerkung für forgeschrittene Benutzer mit Sorge gegenüber dem `curl|bash` Ansatz**

Falls Du stark gegen den `curl|bash` Weg (und ähnlicher Kommandos) zum installieren von Software eingestellt bist, empfehlen wir, ["Is curl|bash insecure?"](https://sandstorm.io/news/2015-09-24-is-curl-bash-insecure-pgp-verified-install) auf dem Sandstom Blog, und vielleicht [diese Diskussion auf Hacker News](https://news.ycombinator.com/item?id=12766350) zu lesen (beides Englisch).