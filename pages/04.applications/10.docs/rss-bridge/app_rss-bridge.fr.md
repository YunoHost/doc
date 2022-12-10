---
title: RSS-Bridge
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_rss-bridge'
---

[![Installer RSS-Bridge avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=rss-bridge) [![Integration level](https://dash.yunohost.org/integration/rss-bridge.svg)](https://dash.yunohost.org/appci/app/rss-bridge)

*RSS-Bridge* est un projet PHP capable de générer des flux RSS et Atom pour les sites web qui n'en ont pas. Il peut être utilisé sur des serveurs web ou comme une application autonome en mode CLI.

Important : RSS-Bridge n'est pas un lecteur de flux ou un agrégateur de flux, mais un outil pour générer des flux qui sont consommés par des lecteurs de flux et des agrégateurs de flux. Vous trouverez une liste d'agrégateurs de flux sur Wikipedia.

#### Sites/pages supportés (principal)

 * `FlickrExplore` : [Dernières images intéressantes](http://www.flickr.com/explore) de Flickr
 * `GoogleSearch` : Les résultats les plus récents de la recherche Google.
 * `GooglePlus` : Les messages les plus récents de la chronologie de l'utilisateur.
 * `Twitter` : Recherche par mot-clé/hashtag ou ligne de temps de l'utilisateur.
 * `Identi.ca` : Chronologie de l'utilisateur Identica (devrait être compatible avec les autres instances Pump.io)
 * YouTube : chaîne, liste de lecture ou recherche d'un utilisateur de YouTube.
 * `Cryptome` : Retourne les documents les plus récents de [Cryptome.org](http://cryptome.org/)
 * `DansTonChat` : Les citations les plus récentes de [danstonchat.com](http://danstonchat.com/)
 * `DuckDuckGo` : Résultats les plus récents de [DuckDuckGo.com](https://duckduckgo.com/)
 * `Instagram` : Les photos les plus récentes d'un utilisateur d'Instagram
 * `OpenClassrooms` : Les derniers tutoriels de [fr.openclassrooms.com](http://fr.openclassrooms.com/)
 * `Pinterest` : Les photos les plus récentes d'un utilisateur ou d'une recherche
 * `ScmbBridge` : Les histoires les plus récentes de [secouchermoinsbete.fr](http://secouchermoinsbete.fr/)
 * `Wikipedia` : articles en surbrillance de [Wikipedia](https://wikipedia.org/) en anglais, allemand, français ou espéranto.
 * `Bandcamp` : renvoie la dernière version de [bandcamp](https://bandcamp.com/) pour un tag
 * `ThePirateBay` : Retourne les derniers torrents indexés de [The Pirate Bay](https://thepiratebay.se/) avec des mots-clés.
 * `Facebook` : Retourne les dernières publications sur une page ou un profil sur [Facebook](https://facebook.com/)

Plus [de nombreux autres ponts](bridges/) à activer, grâce à la communauté

#### Format de sortie

Le format de sortie peut prendre plusieurs formes :

 * `Atom` : Fil ATOM, à utiliser dans les lecteurs RSS/Feed.
 * `Mrss` : Flux MRSS, à utiliser dans les lecteurs RSS/Feed.
 * `Json` : Json, pour la lecture par d'autres applications.
 * `Html` : Page html simple.
 * `Plaintext` : Texte brut (objet php, tel que retourné par print_r).

### Captures d'écran

![Capture d'écran de RSS-Bridge](https://github.com/YunoHost-Apps/rss-bridge_ynh/blob/master/doc/screenshots/screenshot_rss-bridge_welcome.png)

### Avertissements / informations importantes

### Configuration

#### Activation/désactivation des ponts

Par défaut, le script crée `whitelist.txt` et ajoute les ponts principaux (voir ci-dessus). Vous pouvez le modifier :

 * pour activer les ponts supplémentaires (un pont par ligne)
 * pour désactiver les ponts principaux (supprimer la ligne)
 * pour activer tous les ponts (juste un joker `*` comme contenu du fichier)

Pour des raisons de simplicité, ce paquet YunoHost active tous les ponts par défaut.

## Liens utiles

+ Site web : [github.com/RSS-Bridge/rss-bridge](https://github.com/RSS-Bridge/rss-bridge)
+ Démonstration : [Démo](https://wtf.roflcopter.fr/rss-bridge/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/rss-bridge](https://github.com/YunoHost-Apps/rss-bridge_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/rss-bridge/issues](https://github.com/YunoHost-Apps/rss-bridge_ynh/issues)
