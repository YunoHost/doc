# Radicale

Radicale est un serveur de calendrier et de contact CalDAV/CardDAV. Il ne dispose pas d’interface graphique d’administration.

Radicale est installé par défaut avec le client web InfCloud qui permettra de visualiser et de modifier vos calendriers et carnets d’adresses.

Pour connecter un autre client au serveur radicale, il faut renseigner ces adresses :

### Collection CalDAV/CardDAV complète d’un utilisateur
- URL : https://domain.tld/path/user/
- Exemple : https://example.org/radicale/moi/

### Pour connecter un calendrier en particulier
- URL : https://domain.tld/path/user/calendar.ics/
- Exemple : https://example.org/radicale/moi/calendar.ics/

### Pour connecter un carnet d’adresses en particulier
- URL : https://domain.tld/path/user/AddressBook.vcf/
- Exemple : https://example.org/radicale/moi/AddressBook.vcf/

### Créer un nouveau calendrier ou un nouveau carnet d’adresses
Créer un nouveau calendrier ou un nouveau carnet d’adresses est très simple avec radicale, il suffit d’y accéder! Radicale créera tout nouveau calendrier ou carnet d’adresses inexistant si vous tentez d’y accéder.

Il suffit donc de se connecter (comme précédemment) à un calendrier ou un carnet d’adresses inexistant pour le créer.
Cela peut être fait simplement avec un navigateur, pour le voir apparaître dans une collection déjà connectée à un client.

### Accéder à un calendrier ou un carnet d’adresses d’un autre utilisateur
Les adresses précédentes fonctionnent également pour accéder à des ressources n’appartenant pas à l’utilisateur authentifié.

> Exemple :
> User1 peut se connecter à la collection de user2
> https://example.org/radicale/user2/
> Il lui suffira d’indiquer le login et mot de passe de user1.
> Ce sont les règles de partage (voir ci-dessous) qui permettront ou pas à user1 de voir le contenu de la collection de user2.
> Par défaut, aucun partage n’est autorisé.

---

### Configurer les droits d’accès et les partages de calendriers et de carnets d’adresses
Par défaut, tout utilisateur a le droit de lecture et d’écriture sur ses propres calendriers et carnets d’adresses.
Il est toutefois possible d’affiner ces règles par défaut et d’autoriser des partages en autorisant des utilisateurs à accéder à des ressources ne leurs appartenant pas.
Les règles régissant ces droits doivent être inscrite dans le fichier */etc/radicale/rights*

Chaque règle se présente sous cette forme:
```bash
## Commentaire précédant la règle et l’expliquant (optionnel évidemment)
[Nom de la règle]
user: utilisateur concerné
collection: calendrier, carnet ou collection concernée.
permission: permission, r (lecture), w (écriture) ou rw (lecture/écriture)
```
Le fichier *rights* contient plusieurs exemples pouvant être exploités.
Pour valider les modifications apportées au fichier */etc/radicale/rights*, radicale doit être rechargé via le service uwsgi.
```bash
sudo service uwsgi restart
```

### Partager des ressources
Pour partager un calendrier ou un carnet d’adresses, il suffit d’écrire une règle le permettant. Le partage peut se faire avec un autre utilisateur.
```bash
user: ^user1$
collection: ^user2/shared2.ics$
permission: rw
```
Ou publiquement pour un utilisateur distant n’utilisant pas le même serveur.
```bash
user: .*
collection: ^user2/shared2$
permission: r
```
Dans les deux cas, le partage ne fonctionnera qu’en utilisant l’adresse complète du calendrier ou de la collection. Autrement dit, les partages n’apparaissent pas dans la collection d’un utilisateur.
Cette limitation peut s’avérer bloquante pour des clients gérant une seule collection, tel que InfCloud. Pour ce cas particulier, une solution permet de contourner ce problème.

#### Partager des ressources directement dans la collection d’un utilisateur
> Cette solution est fonctionnelle, mais reste du bidouillage…

Pour permettre à un partage d’apparaître directement dans la collection d’un utilisateur, il faut exploiter l’usage des fichiers sous Radicale.
En créant simplement un lien symbolique de la ressource à partager.
```bash
ln -sr user2/shared.ics user1/user2_shared.ics
```
La ressource partagée devient ainsi une ressource de la collection de user1, alors qu’elle reste physiquement dans la collection de user2.
En revanche, sans avoir recours à des règles pour chaque ressource de la collection de user1, la règle générale s’applique. user1 obtient donc le droit de lecture ET d’écriture par défaut sur la ressource partagée, car elle fait partie de sa collection.

---

### Rendre le log de Radicale plus loquace
Par défaut, le log de Radicale est réglé sur INFO. Ce mode épargne le disque dur mais ne permet pas de débugger Radicale en cas de problème.
Pour passer Radicale en mode DEBUG, il faut éditer le fichier */etc/radicale/logging* et passer INFO à DEBUG dans les sections *[logger_root]* et *[handler_file]* puis recharger le service uwsgi.
Dès lors, le log affiche toutes les requêtes qui sont faites à Radicale ainsi que l’analyse du fichier *rights*.
Il est toutefois déconseillé de rester sur ce mode, car le log se remplie très rapidement.

---

### Modifier la configuration de InfCloud
La configuration de InfCloud se trouve dans le fichier *infcloud/config.js*
Pour prendre en compte une modification dans le fichier *config.js* (ou tout autre fichier de InfCloud) il faut recharger le cache avec le script fourni.
```bash
sudo ./cache_update.sh
```

------------------

# <img src="/images/APPLICATION_logo.svg" width="80px" alt="logo de APPLICATION"> APPLICATION

[![Install APPLICATION with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=APPLICATION) [![Integration level](https://dash.yunohost.org/integration/APPLICATION.svg)](https://dash.yunohost.org/appci/app/APPLICATION)

- [Configuration](#configuration)
- [Limitations avec Yunohost](#limitations-avec-yunohost)
- [Applications clientes](#applications-clients)
- [Liens utiles](#liens-utiles)

**Présentation générale de l'application.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Configuration

**Si la configuration de l'application ne se fait pas avec le panel admin de YunoHost.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Limitations avec Yunohost

**Explication des limitations actuelles en utilisation l'application avec YunoHost.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Applications clientes

| Nom de l'applications | Plateforme | Multi-comptes | Autre réseaux supportés | Play Store | F-Droid | Apple Store | *Autres* |
|-----------------------|------------|---------------|-------------------------|------------|---------|-------------|----------|
|                       |            |               |                         |            |         |             |          |

## Liens utiles

 + Site web : [SITE WEB](#)
 + Documentation officielle : [DOCUMENTATION](#)
 + Dépôt logiciel de l'application : [github.com - YunoHost-Apps/APPLICATION](https://github.com/YunoHost-Apps/APPLICATION_ynh)
 + Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/APPLICATION/issues](https://github.com/YunoHost-Apps/APPLICATION_ynh/issues)
