Domaines, configuration DNS et certificats
==========================================

YunoHost permet de gérer et de servir plusieurs domaines sur un même serveur. Vous pouvez donc héberger, par exemple, un blog et un Nextcloud sur un premier domaine `yolo.com`, et un client de messagerie web sur un second domaine `swag.nohost.me`. Chaque domaine est automatiquement configuré pour pouvoir gérer des services web, des courriels et une messagerie instantannée XMPP.

Les domaines peuvent être gérés dans la section 'Domaine' de la webadmin, ou via la catégorie `yunohost domain` de la ligne de commande. Chaque fois que vous ajoutez un domaine, il est supposé que vous avez acheté (ou en tout cas que vous contrôliez) le domaine, de sorte que vous puissiez gérer la [configuration DNS](dns) ce celui-ci. Une exception concerne les [domaines en `.nohost.me`, `.noho.st` et `ynh.fr`](/dns_nohost_me_fr) qui sont offerts par le Projet YunoHost, et peuvent être directement intégrés avec YunoHost grâce à une configuration dynDNS automatique. (Pour limiter les abus et les coûts, une instance ne peut avoir qu'un seul domaine offert à la fois).

Le domaine choisi lors de la postinstall est défini comme le domaine principal du serveur : c'est là que le SSO et l'interface d'administration web seront disponibles. Le domaine principal peut être modifié ultérieurement via la webadmin dans Domaines > (le domaine) > Définir par défaut, ou avec la ligne de commande `yunohost tools maindomain`.

Enfin, il faut noter que, dans le contexte de YunoHost, il n'y a pas de hiérarchie entre les domaines qu'il connaît. Dans l'exemple précédent, on peut ajouter un troisième domaine `foo.yolo.com` - mais il serait considéré comme un domaine indépendant de `yolo.com`.

Caractères non latins
-----------------

Si votre domain contient des caractères spéciaux, non latins, vous devez utiliser sa [version internationalisée](https://fr.wikipedia.org/wiki/Nom_de_domaine_internationalis%C3%A9) en [Punycode](https://fr.wikipedia.org/wiki/Punycode). Vous pouvez utiliser [ce convertisseur](https://www.charset.org/punycode), et utiliser le nom de domaine converti dans YunoHost.

Configuration DNS
-----------------

DNS (Domain Name System) est un système qui permet aux ordinateurs du monde entier de traduire les noms de domaine lisibles par l'homme (comme `yolo.com`) en adresses IP compréhensibles par les machines (comme `11.22.33.44`). Pour que cette traduction (et d'autres fonctionnalités) fonctionne, il faut configurer soigneusement les enregistrements DNS. 

YunoHost peut générer une configuration DNS recommandée pour chaque domaine, y compris les enregistrements nécessaires pour les parties emails et XMPP. La configuration DNS recommandée est disponible dans l'administrateur web via Domaine > (le domaine) > configuration DNS, ou avec la commande `yunohost domain dns-conf the.domain.tld`.

Certificats SSL/HTTPS
----------------------

Un autre aspect important de la configuration des domaines est le certificat SSL/HTTPS. YunoHost est intégré avec Let's Encrypt, de sorte qu'une fois que votre serveur est correctement accessible depuis n'importe qui sur Internet via le nom de domaine, l'administrateur peut demander l'installation d'un certificat Let's Encrypt. Voir la documentation sur les [certificats](certificate_fr) pour plus d'informations.

Sous-chemins vs. domaines individuels par application
-----------------------------------------------------

Dans le contexte de YunoHost, il est assez courant d'avoir un seul (ou quelques) domaines sur lesquels plusieurs applications sont installées dans des "sous-chemins", de sorte que l'on se retrouve avec quelque chose comme ceci : 

```bash
yolo.com
     ├─── /blog  : Wordpress (un blog)
     ├─── /cloud : Nextcloud (un service de cloud)
     ├─── /rss   : TinyTiny RSS (un lecteur RSS)
     ├─── /wiki  : DokuWiki (un wiki)
```

Alternativement, on peut choisir d'installer chaque application (ou certaines) sur un domaine dédié. Cela peut sembler plus joli pour les utilisateurs finaux, mais est généralement considéré comme plus compliqué et moins efficace dans le contexte de YunoHost, car vous devez ajouter un nouveau domaine à chaque fois. Néanmoins, certaines applications peuvent avoir besoin d'un domaine entier qui leur est dédié, pour des raisons techniques.

Si toutes les applications de l'exemple précédent étaient installées sur un domaine séparé, cela donnerait quelque chose comme ceci :

```bash
blog.yolo.com  : Wordpress (un blog)
cloud.yolo.com : Nextcloud (un service de cloud)
rss.yolo.com   : TinyTiny RSS (un lecteur RSS)
wiki.yolo.com  : DokuWiki (un wiki)
```
