# Configuration box/routeur

### Accès à l’administration de la box/routeur
Dans la barre d’URL de votre navigateur web entrez `http://192.168.0.1` ou `http://192.168.1.1`.    
Il sera sûrement nécessaire de s’authentifier.


### Ouverture des ports
L’ouverture des ports suivants est nécessaire au fonctionnement des différents services.

**TCP** : 22, 25, 53, 80, 443, 465, 993, 5222, 5269, 5290

---

#### UPnP

L’UPnP permet d’ouvrir automatiquement les ports. Si ce n'est pas le cas par défaut, vous pouvez l'activer via l'interface d'administration de votre routeur.

Dans certains cas après avoir changé la configuration de votre box (ex: sur Freebox ajout d'IPv6, débloquer le smtp ...) et après l'avoir rebooter. Il se peut que vos ports ne soient plus ouverts. Il faut donc reautorisé ces ports par le firewall:

```sudo yunohost firewall reload```

#### Ouverture manuelle de ports

Dans le cas où l’UPnP ne fonctionne pas l’ouverture manuelle des ports est nécessaire. Encore une fois référez-vous à l'interface d'administration de votre routeur.

#### Le courrier électronique

Les fournisseurs d’accès à Internet bloquent souvent le port 25 pour éviter que les ordinateurs de votre réseau n'envoient des spams à votre insu. Pour pouvoir envoyer des emails, il vous faut donc ouvrir le port 25, ou désactiver l'option "blocage SMTP sortant" dans l'administration de votre routeur.
