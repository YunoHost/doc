# Firefox Sync
Firefox Sync permet la synchronisation des favoris, des marques-pages, de l’historique, des onglets, des extensions entre plusieurs instances du navigateur web Firefox.

### Configuration de Firefox
Configurer Firefox pour utiliser votre serveur pour la synchronisation.

#### Firefox bureau
Tapez `about:config` dans la barre d’URL.

Recherchez : `services.sync.tokenServerURI`.

Remplacez l’URL par la vôtre : https://mondomaine.tld/adresse/token/1.0/sync/1.5

Créez un compte chez Mozilla : https://accounts.firefox.com/signup

#### Firefox mobile
Installez le plugin `fxa-custon-server-addon`.