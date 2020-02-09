# So hosten Sie selbst ?

Sie können zu Hause (auf einem kleinen Computer) oder auf einem Remote-Server hosten. Jede Lösung hat ihre Vor- und Nachteile:

### Zu Hause, zum Beispiel auf einem Einplatinencomputer oder einem alten Computer

Sie können zu Hause mit einem Einplatinencomputer oder einem überarbeiteten regulären Computer, der mit Ihrem Heimrouter verbunden ist, hosten. 

- **Pros**  : Sie haben die physische Kontrolle über die Maschine und müssen nur die Hardware kaufen;
- **Cons**  : Sie müssen [Ihre Internet-Router manuell konfigurieren](isp_box_config) und [sind möglicherweise von Ihrem Internet-Service-Provider eingeschränkt](isp).

### Zu Hause hinter einem VPN

Ein VPN ist ein verschlüsselter Tunnel zwischen zwei Computern. In der Praxis sieht es so aus, als ob Sie direkt vor Ort mit Ihrem Server verbunden wären, aber tatsächlich verbinden Sie sich von einem anderen Ort im Internet. Auf diese Weise können Sie weiterhin zu Hause hosten und gleichzeitig mögliche Einschränkungen Ihres Internetdienstanbieters umgehen. Siehe auch [das Internet Cube-Projekt](https://internetcu.be/) und [der FFDN](https://www.ffdn.org/).

- **Pros** : Sie haben die physische Kontrolle über den Computer, und das VPN verbirgt Ihren Datenverkehr vor Ihrem ISP und ermöglicht es Ihnen, seine Einschränkungen zu umgehen;
- **Cons** : Sie müssen ein monatliches Abonnement für das VPN bezahlen.

### Auf einem Remote-Server (VPS oder dedizierter Server)

Sie können einen virtuellen privaten Server oder eine dedizierte Maschine von [associative](https://db.ffdn.org/) oder von anderen kommerziellen "Cloud"-Anbietern mieten.

- **Pros** : Ihr Server und seine Internetverbindung sind schnell;
- **Cons** : Sie müssen ein monatliches Abonnement bezahlen und haben keine physische Kontrolle über Ihren Server.

### Summary

<table class="table">
    <thead>
      <tr>
        <th></th>
        <th style="text-align:center;">Zu Hause<br><small>(z.B. Einplatinencomputer, alter Computer)</small></th>
        <th style="text-align:center;">Zu Hause<br>hinter einem VPN</th>
        <th style="text-align:center;">Auf einem Remote-Server<br>(VPS oder dediziert)</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="text-align:center;">Hardware Kosten</td>
        <td style="text-align:center;" class="warning"  colspan="2">etwa 50€ <br><small>(z.B. ein Raspberry Pi)</small></td>
        <td style="text-align:center;" class="success">keine</td>
      </tr>
      <tr>
        <td style="text-align:center;">Monatliche Kosten</td>
        <td style="text-align:center;" class="success">Unerheblich<br><small>(Stromkosten)</small></td>
        <td style="text-align:center;" class="warning">etwa 5€ <br><small>(VPN)</small></td>
        <td style="text-align:center;" class="warning">ab ~3€ <br><small>(VPS)</small></td>
      </tr>
      <tr>
        <td style="text-align:center;">Physikalische Kontrolle<br>der Machine</td>
        <td style="text-align:center;" class="success">Ja</td>
        <td style="text-align:center;" class="success">Ja</td>
        <td style="text-align:center;" class="danger">Nein</td>
      </tr>
      <tr>
        <td style="text-align:center;">Manuelles Port <br>Routing erforderlich</td>
        <td style="text-align:center;" class="warning">Ja</td>
        <td style="text-align:center;" class="success">Nein</td>
        <td style="text-align:center;" class="success">Nein</td>
      </tr>
      <tr>
        <td style="text-align:center;">Mögliche ISP-Einschränkungen</td>
        <td style="text-align:center;" class="danger">Ja <br><small>(siehe [hier](/isp))</small></td>
        <td style="text-align:center;" class="success">Per VPN umgangen</td>
        <td style="text-align:center;" class="success">Normalerweise nein</td>
      </tr>
      <tr>
        <td style="text-align:center;">CPU</td>
        <td style="text-align:center;" class="warning" colspan="2">Typischerweise ~1 GHz</td>
        <td style="text-align:center;" class="success">~2 GHz <br><small>(Digital Ocean droplet)</small></td>
      </tr>
      <tr>
        <td style="text-align:center;">RAM</td>
        <td style="text-align:center;" class="warning" colspan="2">In der Regel 500 MB oder 1 GB</td>
        <td style="text-align:center;" class="warning">abhängig von den Serverkosten</td>
      </tr>
      <tr>
        <td style="text-align:center;">Internetverbindung</td>
        <td style="text-align:center;" class="warning" colspan="2">Hängt von Ihrer Internetverbindung ab</td>
        <td style="text-align:center;" class="success">Normalerweise ziemlich gut</td>
      </tr>
    </tbody>
</table>
