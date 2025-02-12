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

Les domaines peuvent être gérés dans la section "Domaine" de la webadmin, ou via la ligne de commande (voir `yunohost domain --help`)

![Une capture d'écran de l'interface de gestion des domaines dans la webadmin avec un bouton "Ajouter un domain" et la liste des domaines](image://webadmin_domain.png)

## Domaines locaux


## 3 types de domaines

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Domaines gérés par le projet YunoHost (simple et gratuits)"]]

Afin de rendre l'auto-hébergement aussi accessible que possible, le projet YunoHost fournit un service de nom de domaine *gratuit* et *configuré automatiquement*. En utilisant ce service, vous n'aurez pas à [configurer les enregistrements DNS](/dns_config) vous-même, ce qui peut être fastidieux et technique. Néanmoins, soyez conscient que vous n'êtes pas réellement propriétaire du domaine choisi...

Les (sous-)domaines suivants sont proposés :
- `whateveryouwant.nohost.me` ;
- `whateveryouwant.noho.st` ;
- `whateveryouwant.ynh.fr`.

De plus, YunoHost utilise un mécanisme de DNS dynamique intégré, de sorte que votre serveur reste accessible même si votre IP publique change.

Pour obtenir un de ces domaines, il vous suffit de choisir `Je n'ai pas de nom de domaine...` lors de la configuration initiale (post-installation) ou sur la page `Ajouter un domaine`.

![Capture d'écran de la page « Ajouter un domaine » où vous pouvez choisir « Je n'ai pas de nom de domaine »](image://webadmin_dyndns.png)

! Pour limiter les coûts de ressources et les abus, chaque instance ne peut avoir qu'un seul de ces domaines à la fois, mais vous pouvez ajouter autant de sous-domaines que vous le souhaitez. Par exemple, si vous choisissez `example.noho.st` vous pouvez plus tard ajouter les domaines `video.example.noho.st` ou `www.example.ynh.noho.st` ou tout autre sous-domaine dont vous pourriez avoir besoin. Dans ce cas, vous devez sélectionner « J'ai déjà un nom de domaine ».

[Plus d'informations sur ces domaines](/dns_nohost_me)

[/ui-tab]
[ui-tab title="Vos propres domaines"]]

Avoir son propre domaine apporte plusieurs avantages :

- plus de contrôle et d'autonomie
- un nom de domaine plus simple (par exemple directement en .net ou .org)

Cependant, vous devez payer pour cela chaque année (environ 15€/an ... en fonction du TLD) et vous devez faire quelques configurations supplémentaires pour [mettre en place une zone DNS correcte](/dns_config). L'outil de diagnostic peut vous aider à effectuer cette configuration.

Si vous avez déjà votre propre domaine, vous pouvez simplement cliquer sur « J'ai déjà un nom de domaine... ». Dans le cas contraire, afin de simplifier et d'automatiser la configuration DNS, nous vous suggérons de l'acheter auprès d'un [registrar dont l'API est supportée par YunoHost] (/providers/registrar).

[Cpture d'écran de la page « Ajouter un domaine » où vous pouvez choisir « J'ai déjà un nom de domaine »](image://webadmin_domain_owndomain.png)

[En savoir plus sur la configuration de la zone DNS](/dns_config)

[/ui-tab]
[ui-tab title="Domaines locaux (uniquement accessibles dans votre réseau local)"]]

À partir de YunoHost v4.3, les domaines finissant par `.local` sont pleinement supportés, en plus du `yunohost.local` par défaut.
Ils n'utilisent pas le protocole DNS mais mDNS (appelé aussi Zeroconf, Bonjour), qui permet leur diffusion sans configuration particulière mais exclusivement sur votre réseau local, ou votre VPN.
Leur utilisation est donc parfaitement adaptée si vous ne prévoyez pas de rendre une de vos apps disponible sur l'Internet.

[Capture d'écran de la page « Ajouter un domaine » où vous pouvez choisir « J'ai déjà un nom de domaine » et configurer votre domaine se terminant par .local](image://webadmin_domain_local.png)

!!!! Le protocole mDNS ne permet pas d'ajouter des sous-domaines. Ainsi `domaine.local` est valide, `sous.domain.local` ne l'est pas.

C'est le service `yunomdns` qui se charge de diffuser l'existence de vos domaines `.local` sur votre réseau.
Il possède un fichier de configuration, `/etc/yunohost/mdns.yml`, qui permet de choisir quels domaines sont diffusés, et sur quelles interfaces réseau.
Ce fichier est régénéré automatiquement dès que vous ajoutez ou supprimez un domaine `.local`.

Le service cherchera toujours à diffuser le domaine `yunohost.local`. Si vous avez plusieurs serveurs YunoHost sur votre réseau, alors tentez `yunohost-2.local`, etc.
Le chiffre risque de changer selon quel serveur démarre en premier, donc ne comptez pas dessus pour y installer des apps : créez vos propres domaines locaux.

! Malheureusement, les appareils Android avant la version 12 (sortie en 2021) ne semblent pas écouter le protocole mDNS.
! Pour profiter des domaines `.local` sur vos appareils Android, vous devez entrer l'adresse IP locale de votre serveur YunoHost dans leur paramètre DNS.

[/ui-tab]
[/ui-tabs]

## Configuration DNS

DNS (Domain Name System) est un système qui permet aux ordinateurs du monde entier de traduire les noms de domaine lisibles par les humains (comme `yolo.com`) en adresses IP compréhensibles par les machines (comme `11.22.33.44`). Pour que cette traduction (et d'autres fonctionnalités) fonctionne, il faut configurer soigneusement les enregistrements DNS.

YunoHost peut générer une configuration DNS recommandée pour chaque domaine, y compris les enregistrements nécessaires pour les emails. La configuration DNS recommandée est disponible dans l'administrateur web via Domaines > (le domaine) > configuration DNS, ou avec la commande `yunohost domain dns-conf the.domain.tld`.

## A propos des caractères non-latins

Si votre domaine comporte des caractères spéciaux non-latins, il sera transformé par YunoHost en [version internationalisée](https://en.wikipedia.org/wiki/Internationalized_domain_name) ou en [Punycode] (https://en.wikipedia.org/wiki/Punycode). Ainsi, lorsque vous utilisez la ligne de commande, vous devez utiliser le format punycode renvoyé par exemple par `yunohost domain list`.

## Certificats SSL/HTTPS

Un autre aspect important de la configuration des domaines est le certificat SSL/HTTPS. YunoHost est intégré avec Let's Encrypt, de sorte qu'une fois que votre serveur est correctement accessible depuis n'importe qui sur Internet via le nom de domaine, l'administrateur peut demander l'installation d'un certificat Let's Encrypt. Voir la documentation sur les [certificats](/certificate) pour plus d'informations.
