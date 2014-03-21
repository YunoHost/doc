# Site web, démo et autres !

<span class="badge">Publié le 15 mars 2014 à 18h30</span>

Comme vous l'avez sûrement remarqué, nous avons très largement changé notre site Internet et notre plateforme de documentation. Nous utilisons à présent [Simone](https://github.com/Kloadut/Simone), une solution « faite-maison » qui se concentre sur le contenu et la lisibilité. Les pages sont accessibles via [Github](https://github.com/YunoHost/doc), vous pouvez donc faire des **pull requests** ou les éditer directement sur ce site --*essayez `ESC` pour voir* ;-)

D'autre part, nous vous présentons aujourd’hui notre nouvelle [page d'accueil](/index_fr) ainsi que plusieures autres pages : Vous devriez pouvoir naviguer entre elles sans problème.

Notez que nous faisons tout notre possible pour vous fournir une **documentation exhaustive** le plus tôt possible. C'est un travail **extrêmement chronophage** que nous ne pouvions pas faire avant d'avoir une version un peu stable. Aussi, si vous écrivez correctement l'anglais, n'hésitez pas à venir [contribuer](/contribute_fr) à la rédaction :-)

### Twitter

Un tout nouveau compte Twitter est maintenant disponible ( [@yunohost](http://twitter.com/yunohost) ), nous tâcherons de le tenir à jour avec des petites news.

### Démo

Une [plateforme de démonstration](/demo_fr) est disponible pour vous donner un aperçu de l'interface admin et utilisateur. Gardez à l'esprit qu'elle tourne sous la dernière version beta, qui ne supporte pas encore les actions concurrentes... Ça peut donc vous paraître buggé :-)


N'hésitez pas à venir nous laisser un mot sur notre salon de discussion, accessible depuis la [page d'accueil](/index_fr) ou via votre client XMPP favori à [support@conference.yunohost.org](xmpp:support@conference.yunohost.org?join).

<div class="pull-right"><span class="label label-default">Trucs</span> <span class="label label-success">démo</span> <span class="label label-warning">documentation</span></div>
<div class="clearfix"></div>

<hr>

#YunoHost v2 beta4

<span class="badge">Publié le 03 mars 2014 à 20h47</span>

Grosse annonce aujourd'hui : nous sortons une nouvelle version beta4 (probablement la **dernière beta** avant la version RC). Un tas de choses ont été améliorées sur et autour du logiciel.

Comme d'habitude, voici une liste non-exhaustive des changements:

* De nombreuses fonctionnalités ont été ajoutée à l'**interface d'administration**, en particulier la gestion des droits par app, une vue de monitoring et la gestion des services.
* Un **panel utilisateur** minimal a été implémenté dans le SSO. Il sera amélioré rapidement.
* La **configuration mail** a été simplfiée. Nous gardons finalement le couple **Amavis/SpamAssassin** pour toutes les instances.
* De nouvelles apps ont été ajoutées: **Zerobin**, **PHPMyAdmin** et **Jirafeau** (et [plus bientôt](/apps_fr) !).
* L'interception des URLs dans **SSOwat** a été légèrement améliorée.

Et préparez-vous à de nombreux changements en vue de la RC:

* **Règles persistentes** dans SSOwat
* Une grosse refonte du code de la **moulinette** (déjà bien avancée)
* Une nouvelle identité visuelle va être intégrée
* Une fonction générale d'upgrade du système
* L'internationalisation de l'interface admin et de la CLI

Pour plus d'informations, vous pouvez vous référer à la [roadmap](/roadmap_fr) (pas forcément à jour).

Et comme toujours, un immense câlin virtuel à tous les contributeurs qui ont rendu cette release possible. Travailler avec une équipe aussi sympa et motivée est vraiment un plaisir quotidien :
<p class="text-muted"><small>opi, ezpen, Ju, Moul, jerome, titoko, beudbeud, Courgette, TozZ et les autres</small></p>

<div class="pull-right"><span class="label label-default">Release</span> <span class="label label-primary">beta4</span></div>
<div class="clearfix"></div>

<hr>
