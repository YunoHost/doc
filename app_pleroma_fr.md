# <img src="/images/pleroma_logo.png" alt="logo de Pleroma"> Pleroma

 - [Découverte de l'interface de Pleroma](#d%C3%A9couverte-de-linterface-de-pleroma)
 - [Logiciels Clients pour mobile et ordinateur](#applications-clients)
 - [Liens utiles](#quelques-liens-utiles)

Pleroma est un réseau social décentralisé de micro-blogging qui propose une alternative à Twitter, le protocole [Activy Pub](https://en.wikipedia.org/wiki/ActivityPub) qu'il utilise permet d'interagir avec le [fediverse](https://fediverse.party/en/fediverse) composé notamment de Mastodon, GNU Social, et d'autres. Il a l'avantage d'être plus léger que mastodon et se prête donc plus facilement à l'auto-hébergement.

## Découverte de l'interface de Pleroma

Pour celles et ceux qui n'ont pas ou peu l'habitude des réseaux sociaux, voici en détail l'utilisation de chacune des fenêtres proposées :

### Accueil de l'interface

<img src="/images/capture_globale.png" alt="Capture écran accueil de Pleroma">

1. Barre de menu
   + <img src="/images/capture_menu_gauche.png" alt="Capture du bouton à gauche de la barre de menu"> Le bouton à gauche portant le nom de l'instance - dans la capture ci-dessus *Meta - Pleroma* - renvoie vers la page d'accueil de l'instance. Dans le cas où vous êtes connecté⋅e cela vous renverra vers la visualisation de votre *journal*, si ce n'est pas le cas vers *Le réseau connu*.
   + <img src="/images/capture_menu_droite.png" alt="Capture des boutons à droite de la barre de menu"> Si vous êtes connecté⋅e vous aurez trois boutons, si vous ne l'êtes pas il n'y en aura que deux. Dans l'ordre, de gauche à droite :
      + <img src="/images/capture_menu_droite_chercher_utilisateur.png" alt="Capture bouton chercher un⋅e utilisateur⋅trice"> Permet d'ajouter de nouveaux utilisateurs et nouvelles utilisatrices afin de les suivre et ainsi vous abonner à leurs publications. Il est possible de rechercher un·e utilisateur·trice avec seulement son pseudonyme (par exemple : *yunohost*) ou alors sous la forme @pseudonyme@instance.domaine (par exemple : *@yunohost@mastodon.social*)
      + <img src="/images/capture_menu_droite_preferences.png" alt="Capture bouton préférences"> Permet d'accéder aux paramétres d'affichages de votre session.
      /!\ Si vous n'êtes pas connecté·e les modifications effectuées ne seront valables qu'un temps (jusqu'à ce que les cookies de fonctionnement soient effacés).
      + <img src="/images/capture_menu_droite_deconnexion.png" alt="Capture Déconnexion"> Permet de se déconnecter de l'instance. Si vous n'êtes pas sur votre ordinateur personnel pensez-y !

2. Espace de Publications / Fenêtre de connexion
<img src="/images/capture_espace_connexion.png" alt="Fenêtre de connexion à la place de la zone de publications"> Si vous êtes connecté·e cet espace vous permet de publier vos messages et d'y joindre un média (images, GIF, vidéos, etc). Vous êtes limité⋅e dans le nombre de caractères, avec Pleroma la limitation est définie par l'administrateur·trice de l'instance. Si vous avez des questions envoyez lui un message.

3. Fenêtre de visualisations
C'est ici le centre ~~du monde~~ de Pleroma, vous pourrez y voir les différentes publications de vos contacts ou qui circulent sur l'instance ainsi que les re-toots et qui a publié.

4. Le journal
Cette zone permet de voir les différentes publications des comptes que vous suivez mais aussi l'ensemble des publications visibles sur votre instance. Vous trouverez aussi les messages privés et les notifications où vous trouverez tous vos toots et les publications où vous avez été cité⋅e.

5. Interface utilisateur·trice
Cet espace permet de choisir l'agencement de Pleroma, il est proposé deux agencements : un spécifique à Pleroma et un fork (une copie) de l'agencement de Mastodon, selon vos préférences d'usages et de visualisations ; à vous de faire votre choix.

6. Notifications
On retrouve dans cette zone les messages où vous avez été cité⋅e, mais aussi les abonnements à votre compte.

## Applications clients

| Nom de l'applications | Plateforme | Multi-comptes | Autre réseaux supportés | Play Store | F-Droid | Apple Store |
|---|---|---|---|---|---|---|
| Tusky | Android | Oui | Mastodon | [https://play.google.com/id=com.keylesspalace.tusky](https://play.google.com/store/apps/details?id=com.keylesspalace.tusky) | [f-droid.org/com.keylesspalace.tusky](https://f-droid.org/fr/packages/com.keylesspalace.tusky/) |
| Fedilab | Android | Oui | Mastodon, Pleroma, Peertube, GNU Social, Friendica, Pixelfed | [play.google.com/app.fedilab.android](https://play.google.com/store/apps/details?id=app.fedilab.android&hl=fr) | [f-droid.org//fr.gouv.etalab.mastodon](https:/f-droid.org/fr/packages/fr.gouv.etalab.mastodon/)
| Twidere | Android | Oui | Twitter, Mastodon | [play.google.com/org.mariotaku.twidere](https://play.google.com/store/apps/details?id=org.mariotaku.twidere) | [https://f-droid.org/org.mariotaku.twidere](https://f-droid.org/fr/packages/org.mariotaku.twidere/) |
| Librem Social | Android | Non | ? | [play.google.com/one.librem.social](https://play.google.com/store/apps/details?id=one.librem.social&hl=fr) | [https://f-droid.org/one.librem.social](https://f-droid.org/fr/packages/one.librem.social) | |

## Quelques liens utiles

+ Site officiel : [pleroma.social (En anglais)](https://pleroma.social)
+ Trouver d'autres instances de Pleroma : [fediverse.network/pleroma](https://fediverse.network/pleroma)

------------------

# <img src="/images/APPLICATION_logo.svg" width="80px" alt="logo de APPLICATION"> APPLICATION

[![Install APPLICATION with YunoHost](https://install-app.yunohost.org/install-with-yunohost.png)](https://install-app.yunohost.org/?app=APPLICATION) [![Integration level](https://dash.yunohost.org/integration/APPLICATION.svg)](https://dash.yunohost.org/appci/app/APPLICATION)

### Index

- [Configuration](#configuration)
- [Limitations avec YunoHost](#limitations-avec-yunohost)
- [Applications clientes](#applications-clientes)
- [Liens utiles](#liens-utiles)

**Présentation générale de l'application.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Configuration

**Si la configuration de l'application ne se fait pas avec le panel admin de YunoHost.** *Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce rutrum sodales mauris eu viverra. Sed dapibus, tellus sit amet interdum condimentum, enim eros faucibus ligula, sed suscipit orci velit at felis. Etiam quam lacus, vulputate eu scelerisque ac, sollicitudin rutrum orci. Cras eu ante porttitor, laoreet odio sed, hendrerit tellus. Nulla luctus sem in arcu scelerisque cursus. Nulla ut tellus at leo porttitor tincidunt. Morbi vitae purus convallis, elementum lectus non, dignissim orci. Integer eget egestas mauris. Nunc nunc dolor, cursus in quam mollis, rutrum fermentum nibh. Aliquam molestie velit a nulla porttitor, sit amet tincidunt erat laoreet.*

## Limitations avec YunoHost

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
