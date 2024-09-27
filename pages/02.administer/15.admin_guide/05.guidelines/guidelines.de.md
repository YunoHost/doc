---
title: Hinweise und Leitlinien
template: docs
taxonomy:
    category: docs
routes:
  default: '/guidelines'
---

Diese Seite listet einige Tipps und Richtlinien auf, die jeder YunoHost-Administrator kennen sollte, um sich um seinen Server zu kümmern :).

## YunoHost nicht beschädigen 

Das heißt : Entweder ist der Server für den tatsächlichen Betrieb gedacht, oder es handelt sich um einen Testserver, auf dem Sie experimentieren dürfen.

Ist Ihr Ziel, einen Produktionserver zu benutzen, so beachten Sie folgendes :

- ein Server ist ein empfindliches System : Seien Sie vorsichtig, methodisch und geduldig ;
- experimentieren und Anpassen einschränken - insbesondere von Konfigurationsdateien ;
- Nicht zahlreiche Anwendungen installieren, nur um zu sehen, wie sie aussehen ;
- Vorsicht mit inoffiziellen Anwendungen, und verzichten auf solche, die noch "in Bearbeitung" sind, oder einen Level 0 haben ;
- wenn etwas kaputt geht, überlegen Sie richtig, bevor Sie versuchen, es selbst zu reparieren, wenn Sie nicht wissen, was Sie tun. <small>(z. B., den Admin-Benutzer nicht selbst versuchen neu anzulegen, falls er komischerweise verschwunden ist.)</small>

## Keep it simple !

YunoHost ist für allgemeine und einfache Anwendungsfälle konzipiert. Wenn Sie von diesen Bedingungen abweichen, wird es schwieriger, und Sie benötigen technisches Wissen, um sie zu erfüllen. Zum Beispiel:

- Versuchen Sie nicht, YunoHost in einem Kontext auszuführen, in dem Sie keine Kontrolle über die Ports 80 und 443 haben (oder überhaupt kein Internet);
- Versuchen Sie nicht, fünf Server über dieselbe Internetverbindung zu hosten, wenn Sie nicht bereits ein fortgeschrittener Benutzer sind;
- Auf keinen Fall sollten Sie versuchen, NGINX durch Apache zu ersetzen (oder beides gleichzeitig laufen zu lassen);
- Versuchen Sie nicht, benutzerdefinierte SSL-Zertifikate zu verwenden, wenn Sie diese nicht wirklich benötigen;
- ...

Halten Sie die Dinge so einfach wie möglich!

## Das System soll nicht ständig wieder installiert werden

Manche Leute neigen dazu, in eine "Neuinstallationsspirale" zu verfallen - wo immer, wenn etwas im Server kaputt geht und es nicht offensichtlich ist, wie man es beheben kann, oder weil der Server instabil geworden ist, der Administrator damit endet, den gesamten Server von Grund auf neu zu installieren, weil es als ein "einfacher" und schneller Weg erscheint, alles wieder in Ordnung zu bringen.

Vermeiden Sie das. Eine neue Installation ist mühsam und keine gute langfristige Strategie zur Problemlösung. Sie werden nur müde und lernen nichts dabei. Vergessen Sie den Traum von einem einwandfreien Server: Im Betrieb wird ein Server nach und nach immer instabil. Außerdem müssen Sie (allmählich) lernen, Probleme zu lösen, wenn Sie auf welche stoßen. [Bitten Sie um Hilfe](/help), geben Sie Details über die entsprechenden Probleme an und was Sie versuchen dagegen zu unternehmen. Beheben Sie dann die Probleme. Mit der Zeit werden Sie eine viel bessere Kontrolle über Ihren Server haben. Und im Gegensatz zu ständigen Neu-Installationen ist das ein großer Vorteil.

## Backups erstellen

Wenn Sie Dienste und Daten hosten, die für Ihre Benutzer wichtig sind, ist es wichtig, dass Sie über eine Sicherungsrichtlinie verfügen. Backups können einfach über die Webadministrationsoberfläche erstellt werden - allerdings können sie derzeit nicht von dort heruntergeladen werden (aber sie können auf anderem Wege heruntergeladen werden). Sie sollten regelmäßig Backups erstellen und diese an einem sicheren Ort aufbewahren, der physisch von Ihrem Server getrennt ist. Weitere Informationen finden Sie in [der Backup-Dokumentation](/backup).

## Die an Root gesendeten Emails lesen

Als Administrator sollten Sie einen E-Mail-Client so einrichten, dass er E-Mails prüft, die an `root@your.domain.tld` (das muss ein Alias für den ersten von Ihnen hinzugefügten Benutzer sein) gesendet werden, oder sie an eine andere Adresse weiterleitet, die Sie aktiv prüfen. Diese E-Mails können Informationen darüber enthalten, was auf Ihrem Server passiert, wie z. B. periodische automatisierte Aufgaben.

## YunoHost ist freie Software, die von Freiwilligen instand gehalten wird

Schließlich sollten Sie bedenken, dass YunoHost eine freie Software ist, die von Freiwilligen gepflegt wird - und dass das Ziel von YunoHost (die Demokratisierung des Selbst-Hostings) nicht einfach ist! Die Software wird ohne jegliche Garantie zur Verfügung gestellt. Das YunoHost Team tut sein Bestes, um das bestmögliche Erlebnis zu erhalten und zu bieten - dennoch sind die Funktionen, Anwendungen und YunoHost als Ganzes weit davon entfernt, perfekt zu sein, und Sie werden früher oder später auf kleine oder große Probleme stoßen. Wenn das passiert, kommen Sie bitte [in den Chat oder das Forum und bitten um Hilfe, oder melden das Problem](/help) :)!

Wenn Ihnen YunoHost gefällt und Sie möchten, dass das Projekt am Leben erhalten wird und weiter voranschreitet, hinterlassen Sie bitte eine Dankesnachricht und [spenden](https://liberapay.com/YunoHost) für das Projekt und erzählen Sie anderen davon!

Und da YunoHost schließlich ein Open-Source-Projekt ist, sind Sie herzlich dazu eingeladen, zum Projekt [beizutragen](/contribute). Sowohl zu technischen (d.h. Code) als auch zu weniger technischen Aspekten (wie z.B. das Mitwirken an dieser Dokumentation ;) )!
