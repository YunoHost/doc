#<img src="/images/peertube_logo.png" alt="Logo de PeerTube">  PeerTube

PeerTube est une plateforme de streaming vidéo fédérée (ActivityPub) utilisant P2P (BitTorrent) directement dans le navigateur web, en utilisant WebTorrent.

 - [Découverte de l'environnement de PeerTube](#EnvironnementPeerTube)
 - [Manipulations utiles & Problèmes rencontrés](#ManipulationsUtiles)
   + [Permettre aux vidéos d'être embarqué sur un site web](#VideosEmbed)
 - [Liens utiles](#liensutiles)

## <a name ="EnvironnementPeerTube">Découverte de l'environnement de PeerTube</a>

Pour comprendre en quoi PeerTube propose une réelle alternative à youtube, vous êtes invité à regarder le clip de promotion de PeerTube réalisé par l'association Framasoft (ci-dessous). Elle est elle même hébergé sur framatube.org  

<iframe width="560" height="315" sandbox="allow-same-origin allow-scripts" src="https://framatube.org/videos/embed/9db9f3f1-9b54-44ed-9e91-461d262d2205" frameborder="0" allowfullscreen></iframe>

## <a name="ManipulationsUtiles">Manipulations utiles & Problèmes rencontrés</a>

### <a name="VideosEmbed">Permettre aux vidéos d'être embarqué sur un site web</a>

Pour permettre à une vidéo d'être embarqué, c'est à dire que la vidéo puisse être visible sur un site internet (comme la vidéo de présentation de youtube sur cette page) à l'aide du code disponible en cliquant sur *Partager* sur la page de la vidéo et en copiant le code sur une page du site de destination (cf. capture d'écran ci-dessous). Vous devrez modifier ce fichier de configuration situé ici : `/etc/nginx/conf.d/nom.instance.tld.conf` 
![Capture d'écran du bouton partager](/images/peertube_embed_01.png)

## <a name="liensutiles">Quelques liens utiles</a>

 - [Site officiel de PeerTube - joinpeertube.org](https://joinpeertube.org/fr/)
 - [Documentation de l'application de yunohost](#)
 - [
