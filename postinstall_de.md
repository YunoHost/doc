Nach der Installation
Der Schritt "Nach der Installation" ist eigentlich die Erstkonfiguration von YunoHost. Dies muss unmittelbar nach der Installation des Systems selbst erfolgen.

Hinweis: Wenn Du gerade einen Server von Grund auf wiederherstellen und eine von yunohost erstellte Sicherung hast, dann musst Du diesen Vorgang überspringen und den Schritt "Wiederherstellung während der Nachinstallation" auf der Sicherungsseite ausführen.

Über die Weboberfläche
Du kannst die Nachinstallation über die Weboberfläche durchführen, indem Du im Browser folgendes eingibst:

Die lokale IP-Adresse Deines Servers, wenn er sich in Deinem lokalen Netzwerk befindet (z. B. zu Hause!). Die Adresse sieht normalerweise wie folgt aus: 192.168.x.y (siehe 'Finde Deine IP' auf der Seite über SSH)
Die öffentliche IP-Adresse Deines Servers, wenn sich der Server nicht in Deinem lokalen Netzwerk befindet. Wenn Du einen VPS besitzt, sollte Dir dein VPS-Anbieter normalerweise die IP des Servers gegeben haben.
Beim ersten Besuch wird sehr wahrscheinlich eine Sicherheitswarnung in Bezug auf das vom Server verwendete Zertifikat angezeigt. Derzeit verwendet Dein Server ein selbstsigniertes Zertifikat. Du kannst später ein Zertifikat hinzufügen, das von Webbrowsern automatisch erkannt wird, wie in der Zertifikatdokumentation beschrieben. Im Moment solltst Du eine Sicherheitsausnahme hinzufügen, um das aktuelle Zertifikat zu akzeptieren.

Du solltest dann auf dieser Seite landen:




Vorschau der Web-Nachinstallation

Von der Kommandozeile
Du kannst die Nachinstallation auch mit dem Befehl yunohost tools postinstall direkt auf dem Server oder über SSH durchführen.




Vorschau der Befehlszeile nach der Installation



Informationen gefragt
Hauptdomain
Dies ist der erste Domainname, der mit Deinem YunoHost-Server verknüpft ist, aber auch der Name, der von den Benutzern Deines Servers für den Zugriff auf das Authentifizierungsportal verwendet wird. Es wird somit für alle sichtbar sein, wähle ihn also mit Bedacht aus.

Wenn Du keinen Domainnamen hast oder den DynDNS-Dienst von YunoHost verwenden möchtest, dann wählen eine Subdomain von .nohost.me, .noho.st oder .ynh.fr (z. B. homersimpson.nohost.me). Sofern dies nicht bereits geschehen ist, wird die Domäne automatisch konfiguriert und Du benötigen keinen weiteren Konfigurationsschritt.

Wenn Du weißt, was DNS ist, möchten Du hier wahrscheinlich Deinen eigenen Domainnamen konfigurieren. In diesem Fall findest Du weitere Informationen auf der DNS-Seite.

Wenn Du keinen Domainnamen besitzt und keine .nohost.me, .noho.st oder .ynh.fr verwenden möchtest, dann kannst Du Sie eine lokale Domain verwenden. Die Idee ist, Deinen Router so zu konfigurieren, dass ein lokaler Domänenname auf Deinen Server umgeleitet wird. Du kannst beispielsweise die Domäne yunohost.local erstellen, die auf Deinem Server in Deinem Router umgeleitet wird. Jetzt wird jedes Gerät im Netzwerk beim Zugriff auf yunohost.local auf Deinen Server umgeleitet. Weitere Informationen zum Einrichten einer lokalen Domain findest Du hier.

Administrationspasswort
Dieses Kennwort wird verwendet, um auf die Verwaltungsoberfläche Ihres Servers zuzugreifen. Du würdest es auch verwenden, um eine Verbindung über SSH oder SFTP herzustellen. Im Allgemeinen ist dies der Schlüssel Deines Systems. Wähle das Passwort sorgfältig aus.



Herzlichen Glückwunsch!
Wenn Du so weit gekommen bist und siehst, dass YunoHost erfolgreich installiert wurde (Web-Nachinstallation) oder YunoHost korrekt konfiguriert wurde, dann herzlichen Glückwunsch!

Was jetzt ?
Wenn Du zu Hause selbst hosten und kein VPN hast, dann musst Du sicherstellen, dass die Ports auf dem Router / Deiner Internetbox korrekt weitergeleitet werden.
Wenn Du einen eigenen Domainnamen verwendest (d. H. Keine .nohost.me / .noho.st), musst Du den Router gemäß der empfohlenen DNS-Konfiguration konfigurieren.
Wenn Du den Domainnamen noch nicht konfigurieren konntest (weil Du ihn noch nicht registriert hast oder weil es sich um eine Testdomain handelt), finden Du im letzten Absatz hier eine Problembehandlung.
Habe keine Angst vor der Zertifikatwarnung, wahrscheinlich kannst Du ein Let's Encrypt-Zertifikat installieren :).
Schau Dir die verfügbaren Apps an!

