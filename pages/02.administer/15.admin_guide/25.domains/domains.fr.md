---
title: Domaines, configurations DNS, et certificats
template: docs
taxonomy:
    category: docs
routes:
  default: '/domains'
---

YunoHost permet de gérer et de servir plusieurs domaines sur un même serveur. Vous pouvez donc héberger, par exemple, un blog et un Nextcloud sur un premier domaine `yolo.com`, et un client de messagerie web sur un second domaine `swag.nohost.me`. Chaque domaine est automatiquement configuré pour pouvoir gérer des services web et des courriels.

Les domaines peuvent être gérés dans la section 'Domaines' de la webadmin, ou via la catégorie `yunohost domain` de la ligne de commande.

Chaque fois que vous ajoutez un domaine, il est supposé que vous avez acheté (ou en tout cas que vous contrôlez) le domaine, de sorte que vous puissiez gérer la [configuration DNS](/dns_config) de celui-ci. Une exception concerne les [domaines en `.nohost.me`, `.noho.st` et `ynh.fr`](/dns_nohost_me) qui sont offerts par le Projet YunoHost, et peuvent être directement intégrés avec YunoHost grâce à une configuration DynDNS automatique. Pour limiter les abus et les coûts, une instance ne peut avoir qu'un seul domaine offert à la fois, toutefois vous pouvez ajouter autant de sous-domaines de celui-ci que vous le souhaitez. Par exemple, ci vous choisissez `exemple.ynh.fr` vous pourrez par la suite ajouter les domaines `video.exemple.ynh.fr` ou `www.exemple.ynh.fr` ou tout autre sous-domaine dont vous pourriez avoir l'utilité.

Le domaine choisi lors de la configuration initiale (post-installation) est défini comme le domaine principal du serveur : c'est là que le SSO et la webadmin seront disponibles. Le domaine principal peut être modifié ultérieurement via la webadmin dans Domaines > (le domaine) > Définir par défaut, ou avec la ligne de commande `yunohost tools maindomain`.

Enfin, il faut noter que, dans le contexte de YunoHost, il n'y a pas de hiérarchie entre les domaines qu'il connaît. Dans l'exemple précédent, on peut ajouter un troisième domaine `foo.yolo.com` - mais il serait considéré comme un domaine indépendant de `yolo.com`.

## Domaines locaux

À partir de YunoHost v4.3, les domaines finissant par `.local` sont pleinement supportés, en plus du `yunohost.local` par défaut.
Ils n'utilisent pas le protocole DNS mais mDNS (appelé aussi Zeroconf, Bonjour), qui permet leur diffusion sans configuration particulière mais exclusivement sur votre réseau local, ou votre VPN.
Leur utilisation est donc parfaitement adaptée si vous ne prévoyez pas de rendre une de vos apps disponible sur l'Internet.

!!!! Le protocole mDNS ne permet pas d'ajouter des sous-domaines. Ainsi `domaine.local` est valide, `sous.domain.local` ne l'est pas.

C'est le service `yunomdns` qui se charge de diffuser l'existence de vos domaines `.local` sur votre réseau.
Il possède un fichier de configuration, `/etc/yunohost/mdns.yml`, qui permet de choisir quels domaines sont diffusés, et sur quelles interfaces réseau.
Ce fichier est régénéré automatiquement dès que vous ajoutez ou supprimez un domaine `.local`.

Le service cherchera toujours à diffuser le domaine `yunohost.local`. Si vous avez plusieurs serveurs YunoHost sur votre réseau, alors tentez `yunohost-2.local`, etc.
Le chiffre risque de changer selon quel serveur démarre en premier, donc ne comptez pas dessus pour y installer des apps : créez vos propres domaines locaux.

! Malheureusement, les appareils Android avant la version 12 (sortie en 2021) ne semblent pas écouter le protocole mDNS.
! Pour profiter des domaines `.local` sur vos appareils Android, vous devez entrer l'adresse IP locale de votre serveur YunoHost dans leur paramètre DNS.

## Sous-domaines

! Gardez bien en tête que YunoHost considère les domaines et leur sous-domaines indépendamment.
! **Il vous faut** enregistrer chacun des domaines et sous-domaines que vous voulez utiliser.

## Configuration DNS

DNS (Domain Name System) est un système qui permet aux ordinateurs du monde entier de traduire les noms de domaine lisibles par l'homme (comme `yolo.com`) en adresses IP compréhensibles par les machines (comme `11.22.33.44`). Pour que cette traduction (et d'autres fonctionnalités) fonctionne, il faut configurer soigneusement les enregistrements DNS.

YunoHost peut générer une configuration DNS recommandée pour chaque domaine, y compris les enregistrements nécessaires pour les emails. La configuration DNS recommandée est disponible dans l'administrateur web via Domaines > (le domaine) > configuration DNS, ou avec la commande `yunohost domain dns-conf the.domain.tld`.

## Certificats SSL/HTTPS

Un autre aspect important de la configuration des domaines est le certificat SSL/HTTPS. YunoHost est intégré avec Let's Encrypt, de sorte qu'une fois que votre serveur est correctement accessible depuis n'importe qui sur Internet via le nom de domaine, l'administrateur peut demander l'installation d'un certificat Let's Encrypt. Voir la documentation sur les [certificats](/certificate) pour plus d'informations.
