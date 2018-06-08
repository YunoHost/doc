# Migrer ses emails d'un ancien serveur mail vers YunoHost

*[Documentation en rapport avec l’email de YunoHost](/email_fr)*.

La migration des emails d’un serveur à un autre peut se faire via deux outils recommandés : ImapSync ou Larch.

Cet outil doit être installé sur votre ordinateur de bureau. La procédure de transfert est comme sur le schéma :

**`Ancien serveur email −> ordinateur client avec ImapSync ou Larch −> nouveau serveur email`**

### ImapSync

[Site d’ImapSync](http://imapsync.lamiral.info/)

Installez ImapSync sur votre ordinateur client en suivant ce [guide](http://imapsync.lamiral.info/INSTALL) :
```bash
sudo dnf install imapsync # Sous Fedora
```
Transférez les mails d’un serveur à l’autre :
```bash
imapsync --host1 <domaine/IP> --port1 993 --ssl1 --user1 <utilisateur> --password1 <mdp> \
--host2 <domaine/IP> --port2 993 --ssl2 --user2 <utilisateur> --password2 <mot de passe>
```

Notez que les paramètres de transfert `--port 993` et `--ssl` sont spécifique à un serveur de mail YunoHost.

### Larch

[Site de Larch](https://github.com/rgrove/larch/)

Après avoir préalablement installé `gem`, installez `larch` sur votre ordinateur client :
```bash
sudo gem install larch
```
Transférez les mails d’un serveur à l’autre :
```bash
larch -a -f imaps://serveur_d'origine.org -t imaps://serveur_de_destination.org
```
Pour d’autres types de transferts référez-vous à la documentation de Larch.
