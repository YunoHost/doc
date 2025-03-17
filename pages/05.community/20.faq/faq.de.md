---
title: Häufig gestellte Fragen
template: docs
taxonomy:
    category: docs
routes:
  default: '/faq'
---

#### Unter welcher Lizenz wird YunoHost angeboten ?

YunoHost steht unter der freien GNU AGPL v.3 Lizenz.

YunoHost basiert auf Debian, also auch auf Lizenzen von Debian Bestandteilen.

Die Anwendungen und Applikations-Pakete stehen unter ihren jeweiligen, eigenen Lizenzen.

#### Was ist das Ziel von YunoHost ?

Wir glauben, dass Dezentralisierung sowie Kontrolle und Verantwortung über die eigenen Daten und Dienste ein wichtiger Bestandteil einer freien und demokratischen Gesellschaft ist.

Das YunoHost Projekt zielt darauf ab, eigenverantwortliches Hosting zu demokratisieren.

Wir bieten eine Software an, die es für jeden möglichst einfach machen soll, einen eigenen Server zu betreiben und zu verwalten - mit einem minimalen Aufwand an Wissen und Zeit.

#### Aber was *macht* YunoHost überhaupt ?

YunoHost könnte eine Distribution oder ein Betriebssystem genannt werden, aber es ist eigentlich "nur" eine Ebene, die über Debian betrieben wird und welche die meiste, schwierige Arbeit für Sie übernimmt.

Zum Beispiel, wenn Sie Wordpress installieren möchten, müssten Sie einige Befehle eintippen, um Benutzer zu generieren, einen Webserver einrichten, einen SQL Server einrichten, das Wordpress Archiv herunterladen, entpacken, den Webserver konfigurieren, die SQL Datenbank konfigurieren und schließlich Wordpress einrichten. YunoHost übernimmt all das für Sie, zähmt das technische Chaos und "tippt alle Befehle für Sie", sodass Sie sich auf das konzentrieren können, was wirklich wichtig ist.

Mehr Informationen finden Sie [hier](/whatsyunohost) !

#### Kann ich meine eigene, persönliche Internetseite mit YunoHost betreiben ?

Ja ! Werfen Sie einen Blick auf die [Custom Web app](https://github.com/YunoHost-Apps/my_webapp_ynh).
Dort erhalten Sie ein "leeres Gefäß" : nach der Installation, laden Sie einfach Ihre Dateien and den jeweiligen Ort hoch (via SSH/SCP or SFTP). PHP und eine SQL Datenbank steht Ihnen bei Bedarf zur Verfügung.

#### Kann ich viele voneinander unabhängige Internetseiten mit unterschiedlichen Domain-Namen betreiben ?

Ja ! YunoHost ermöglicht das Anlegen mehrerer Benutzer und Domain-Namen. Manche Apllikationen wie *WordPress* oder *Web App Multi Custom* sind mehrinstanzenfähig und können mehrmals installiert werden.

#### Wieso kann ich Anwendungen nicht über die IP-Adresse erreichen ?

Die [SSO](https://github.com/Kloadut/SSOwat/) (Single Sign-on) Technik kann Benutzer nicht richtig authentifizieren, wenn sie auf den Server nur über die IP zugreifen. Wenn Sie keine Möglichkeit haben, die DNS korrekt zu konfigurieren, können Sie als temporäre Notlösung [die `Hosts` Datei (letztes §)](/administer/tutorials/domains/dns_local_network) auf Ihrem Computer modifizieren.

#### Was ist das Geschäftsmodell von YunoHost ?

Momentan wird YunoHost nur von Freiwiligen betrieben, die in ihrer Freizeit an dem Projekt arbeiten. Im Grunde ist bisher kein Geld im Spiel (abgesehen von Serverkosten oder Stickern :P).

Vor dem Hintergrund, dass einige Mitwirkende sehr viel zeit in das Projekt investieren, überlegen wir derzeit, wie wir das Projekt langfristig tragfähig machen können.

Dies könnte durch Spenden oder öffentliche Gelder erricht werden. Einige Mitwirkenden arbeiten an professionellen Angeboten in Zusammenhang mit YunoHost.

#### Kann ich für das Projekt spenden ?

Ja, das können Sie ! YunoHost braucht Geld, um die Server und Domain-Namen zu bezahlen. Wir möchten außerdem erreichen, dass die Mitwirkenden weiterhin zum Projekt beitragen können und sich nicht nach anderen Jobs umschauen müssen.

Sie können [auf Liberapay spenden](https://liberapay.com/yunohost).

Wenn Ihnen das möglich ist, können Sie auch gerne Sachspenden leisten (ein Teil unserer Infrastruktur ist auf Server von Dritten angewiesen).

#### Wie kann ich zum Projekt beitragen ?

Es gibt viele Wege [zum Projekt beizutragen](/contribute) :).

Zögern Sie nicht, mit uns über Ihre Ideen zu sprechen!

Es ist ein weit verbreitetes Missverständnis, dass Neulinge bei offenen Softwareprojekten nicht "ausreichend qualifiziert" sind. Wer ist das schon :) ? Was wirklich zählt, ist, [dass Sie mögen, was Sie tun](https://www.youtube.com/watch?v=zIbR5TAz2xQ&t=113s), nett zu anderen Menschen, geduldig und starrköpfig gegenüber Maschinen sind und etwas freie Zeit haben. Abgesehen davon ist einfach alles was Sie tun können, schon mehr als genug!

#### Was sind YunoHost organisatorische Grundsätze ?

Das beschreiben wir in [diesem Dokument](/project_organization) :).

#### Will you port YunoHost to [insert favorite distro]?

If you care about distrowars, or think 'Debian is dirty', then YunoHost is not for you.

YunoHost is aimed at non-tech people who just want their server to work. Debian has its flaws, but it's (one of?) the most widely known and used distribution for servers. It's stable. Most self-hosted software are one way or another compatible with Debian. It's easily hackable by anybody who's been doing a bit of CLI on their personal Ubuntu/Mint computer. There is no killer feature in other distributions that makes it relevant for YunoHost to switch or port to it.

If this does not convince you, there are other projects running on other distributions or with different philosophies.

#### I checked how apps packaging work. Why are you reinventing [insert favorite package format]?

People have been tempted to compare YunoHost packages to traditional package managers (such as Debian's `.deb`), which hold a different purpose. Traditional package managers are meant to install low-level purpose of installing files, commands, programs and services on the system. It is often your duty to configure them properly, simply because there is no standard server setup. Typically, web apps requires a lot of configuration because they rely on a web server and a database (and the single sign-on).

YunoHost manages high-level abstractions (apps, domains, users...) and defines a standard setup (NGINX, Postfix, Metronome, SSOwat...) and, because of this, can handle the configuration for the user.

#### When will [this feature] be implemented? Why isn't [that app] packaged yet? I cannot believe you do not do [this] yet!

We do not give timelines.

We are a bunch of volunteers working on our free time to maintain and develop YunoHost. We have no product owner or project manager handling resources, we are not a business. We do what we can, because we love this software, when we can.

If you really want to have a feature implemented or documented, or an app packaged, [consider contributing yourself](/contribute)! We would love helping you get started.

#### What is YunoHost's policy regarding the apps included in the official catalog ?

See [this page]((/contribute/packaging_apps/policy))

#### Why won't you include [feature X] ?

YunoHost is primarily designed for not-so-tech-savvy users and aims to remain relatively simple in terms of UI/UX. At the same time, the project has limited time and energy available to be maintained and developed. Therefore we may lower the priority of features, or refuse entirely the inclusion of features, based on the criteria that they:

- would only be meaningful for advanced / power-users stuff which is out of the scope of the project ;
- would introduce too much UI/UX bloat ;
- would only cover unrealistic threat models ;
- would be there only to satisfy purists ;
- or overall would not be worth it in terms of development/maintenance time/energy for what it brings to the project.
