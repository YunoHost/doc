# Häufig gestellte Fragen

#### Unter welcher Lizenz wird YunoHost angeboten ?

YunoHost steht unter der freien GNU AGPL v.3 Lizenz.

YunoHost basiert auf Debian, also auch auf Lizenzen von Debian Bestandteilen.

Die Anwendungen und Applikations-Pakete stehen unter ihren jeweiligen, eigenen Lizenzen.


#### Was ist das Ziel von YunoHost ?

Wir glauben, dass Dezentralisierung sowie Kontrolle und Verantwortung über die eigenen Daten und Dienste ein wichtiger Bestandteil einer freien und demokratischen Gesellschaft ist.

Das YunoHost Projekt zielt darauf ab, eigenverantwortliches Hosting zu demokratisieren.

Wir bieten eine Software an, die es für jeden möglichst einfach machen soll, einen eigenen Server zu betreiben und zu verwalten - mit einem minimalen Aufwand an Wissen und Zeit.


#### Aber was *macht* YunoHost überhaupt ?

YunoHost könnte einen Distribution oder ein Betriebssystem genannt werden, aber es ist eigentlich "nur" eine Ebene, die über Debian betrieben wird und welche die meiste, schwierige Arbeit für Sie übernimmt.

Zum Beispiel, wenn Sie Wordpress installieren möchten, müssten Sie einige Befehle eintippen, um Benutzer zu generieren, einen Webserver einrichten, einen SQL Server einrichten, das Wordpress Archiv herunterladen, entpacken, den Webserver kofigurieren, die SQL Datenbank konfigurieren und schließlich Wordpress einrichten. YunoHost übernimmt all das für Sie, zähmt das technische Chaos und "tippt alle Befehle für Sie", sodass Sie sich auf das konzentrieren können, was wirklich wichtig ist.

Mehr Informationen finden Sie [hier](whatsyunohost) !


#### Kann ich meine eigene, persönliche Internetseite mit YunoHost betreiben ?

Ja ! Werfen Sie einen Blick auf die [Custom Web app](https://github.com/YunoHost-Apps/my_webapp_ynh).
Dort erhalten Sie ein "leeres Gefäß" : nach der Installation, laden Sie einfach Ihre Dateien and den jeweiligen Ort hoch (via SSH/SCP or SFTP). PHP und eine SQL Datenbank steht Ihnen bei Bedarf zur Verfügung.


#### Kann ich viele voneinander unabhängige Internetseiten mit unterschiedlichen Domain-Namen betreiben ?

Ja ! YunoHost ermöglicht das Anlegen mehrerer Benutzer und Domain-Namen. Manche Apllikationen wie *WordPress* oder *Web App Multi Custom* sind mehrinstanzenfähig und können mehrmals installiert werden.


#### Wieso kann ich Anwendungen nicht über die IP-Adresse erreichen ?

Die [SSO](https://github.com/Kloadut/SSOwat/) (Single Sign-on) Technik kann Benutzer nicht richtig authentifizieren, wenn sie auf den Server nur über die IP zugreifen. Wenn Sie keine Möglichkeit haben, die DNS korrekt zu konfigurieren, können Sie als temporäre Notlösung [die `Hosts` Datei (letztes §)](dns_local_network_en) auf Ihrem Computer modifizieren.


#### Was ist das Geschäftsmodell von YunoHost ?

Momentan wird YunoHost nur von Freiwiligen betrieben, die in ihrer Freizeit an dem Projekt arbeiten. Im Grunde ist bisher kein Geld im Spiel (abgesehen von Serverkosten oder Stickern :P).

Vor dem Hintergrund, dass einige Mitwirkende sehr viel zeit in das Projekt investieren, überlegen wir derzeit, wie wir das Projekt langfristig tragfähig machen können.

Dies könnte durch Spenden oder öffentliche Gelder erricht werden. Einige Mitwirkenden arbeiten an professionellen Angeboten in Zusammenhang mit YunoHost.


#### Kann ich für das Projekt spenden ?

Ja, das können Sie ! YunoHost braucht Geld, um die Server und Domain-Namen zu bezahlen. Wir möchten außerdem erreichen, dass die Mitwirkenden weiterhin zum Projekt beitragen können und sich nicht nach anderen Jobs umschauen müssen.

Sie können [auf Liberapay spenden](https://liberapay.com/yunohost).

Wenn Ihnen das möglich ist, können Sie auch gerne Sachspenden leisten (ein Teil unserer Infrastruktur ist auf Server von Dritten angewiesen).


#### Wie kann ich zum Projekt beitragen ?

Es gibt viele Wege [zum Projekt beizutragen](contribute) :).

Zögern Sie nicht, mit uns über Ihre Ideen zu sprechen!

Es ist ein weit verbreitetes Missverständnis, dass Neulinge bei offenen Softwareprojekten nicht "ausreichend qualifiziert" sind. Wer ist das schon :) ? Was wirklich zählt, ist, [dass Sie mögen, was Sie tun](https://www.youtube.com/watch?v=zIbR5TAz2xQ&t=113s), nett zu anderen Menschen, geduldig und starrköpfig gegenüber Maschinen sind und etwas freie Zeit haben. Abgesehen davon ist einfach alles was Sie tun können, schon mehr als genug!


#### Was sind YunoHost organisatorische Grundsätze ?

Das beschreiben wir in [diesem Dokument](project_organization) :).


#### Werdet ihr YunoHosts für [Lieblingsdistribution hier einfügen] portieren ?

Die kurze Antwort: Nein. Wir haben nicht die Energie dafür und es ist eh irrelevant.

<a data-toggle="collapse" data-target="#willyouportyunohost" href="#">Die lange Antwort</a>
<div id="willyouportyunohost" class="collapse">
<p>Wer sich auf Distrowars einlässt oder denkt, dass Dabian "schmutzig" sei, ist nicht die Zielgruppe von YunoHost.</p>

<p>YunoHost soll nicht-technikversierte Leute ansprechen, die einfach nur wollen, dass ihr Server funktioniert. Debian hat seine Macken, aber es ist eine bekannte und verbreitete Distributionen für Server. Es ist stabil. Die meiste self-hosted Software ist auf die eine oder andere Weise kompatibel mit Debian. Wer ein bisschen CLI auf seinem eigenen Ubuntu/Mint Computer betreibt, kann sich selbst etwas zusammenhacken. Es gibt kein Killer-Feature in anderen Distributionen, das es notwendig macht, dass YunoHost wechselt oder portiert wird.</p>

<p>Sollte Sie das nicht überzeugen, gibt es ausreichend andere Projekte für andere Distributionen mit einer anderen Philosophie dahinter.</p>
</div>


#### Ich hab gesehen, wie das Packen von Apps funktioniert? Warum erfindet ihr das Rad neu und benutzt nicht [hier bevorzugtes Paketformat einfügen] ?

Kurze Antwort: Machen wir nicht.

Mittellange Antwort: Früher wurden die Apps in .deb gepackt. Was für ein Albtraum. Wir sind jetzt glücklicher ;).

<a data-toggle="collapse" data-target="#whyareyoureinventingpackaging" href="#">Die lange Antwort</a>
<div id="whyareyoureinventingpackaging" class="collapse">

<p>Das Ziel von YunoHost ist es das Packen einfacher zu machen. Von Anfang an wollten wir es so simple wie möglich gestalten, nach dem Motto: « wer die App manuell installieren kann, sollte die Schritte für die Installation und Deinstallation der Pakete ohne besonderes Training kopieren und einfügen können ». Bei Debian Paketen ist das nicht der Fall.</p>

<p>Es hat sich herausgestellt, dass das Packen für YunoHost einen leicht anderen Zweck erfüllt als das Erstellen klassischer Pakete wie .deb. Debian Pakete haben nur den Anspruch Dateien, Befehle, Programme und Dienste auf dem System zu installieren. Es bleibt oft an Ihnen diese richtig zu konfigurieren, weil es einfach keinen standardisierte Server-Konfiguration gibt. Typischerweise erfordern Web-Apps einen sehr hohen Konfigurationsaufwand, weil sie auf dem Webserver und einer Datenbank (und dem single sign-on) aufbauen.</p>

<p>YunoHost richtet Konzepte auf höchster Ebene ein (Apps, Domain-Namen, Benutzer, ...) und definiert eine standardmäßige Einrichtung (Nginx, Postfix, Metronome, SSOwat, ...) und kann deshalb die Konfiguration für den Anwender übernehmen.</p>

<p>Wer trotzdem glaubt, man könne deb Pakete dazu bringen, all dies zu leisten, möge sich die vorherige Antwort anschauen.</p>
</div>
