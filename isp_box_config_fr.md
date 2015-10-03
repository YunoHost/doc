# Configuration box/routeur

### Accès à l’administration de la box/routeur
Allez à l’adresse suivante : http://192.168.0.1 (ou celle-ci http://192.168.1.1). Puis authentifier-vous.

### Tutoriel
* [Tutoriel pour les ouvrir les ports sur les boxs d’Orange, Free, SFR, Dartybox, Belgacom et sur les routeurs Netgear](https://craym.eu/tutoriels/utilitaires/ouvrir_les_ports_de_sa_box.html).

### Ouverture des ports
L’ouverture des ports suivants est nécessaire au fonctionnement des différents services.

**TCP :**
   * Web : 80 <small>(HTTP)</small>, 443 <small>(HTTPS)</small>
   * [SSH](ssh_fr) : 22
   * [XMPP](XMPP_fr) : 5222 <small>(clients)</small> , 5269 <small>(serveurs)</small>
   * [Courriel](email_fr) : 25, 465 <small>(SMTP)</small>, 993 <small>(IMAP)</small>
   * [DNS](dns_fr) : 53

**UDP :**
   * [DNS](dns_fr) : 53

---

#### UPnP

L’UPnP permet d’ouvrir automatiquement les ports. Si ce n’est pas le cas par défaut, vous pouvez l’activer via l’interface d’administration de votre routeur.

Dans certains cas après avoir changé la configuration de votre box (ex : sur Freebox ajout d’IPv6, débloquer le SMTP…) et après l’avoir rebooté. Il se peut que vos ports ne soient plus ouverts. Il faut donc réautoriser ces ports par le firewall :

```sudo yunohost firewall reload```

#### Ouverture manuelle de ports

Dans le cas où l’UPnP ne fonctionne pas, l’ouverture manuelle des ports est nécessaire. Encore une fois référez-vous à l’interface d’administration de votre routeur.

#### Le courrier électronique

Les fournisseurs d’accès à Internet bloquent souvent le port 25 pour éviter que les ordinateurs de votre réseau n’envoient des spams sur Internet à votre insu. Pour pouvoir envoyer des emails, il vous faut donc ouvrir le port 25, ou désactiver l’option « blocage SMTP sortant » dans l’administration de votre routeur.
