---
title: Les applications
template: docs
taxonomy:
    category: docs
routes:
  default: '/apps_overview'
---

L'une des fonctionnalités principales de YunoHost est la possibilité d'installer facilement des applications immédiatement utilisables. Pour donner des exemples d'application, il est possible d'installer un système de blog, un "cloud" (pour héberger et synchroniser des fichiers), un site web, un lecteur RSS...

Les applications peuvent être installées et gérées via l'interface d'administration web dans la partie 'Applications', ou via les commandes de la catégorie `yunohost app`.

Il est possible de naviguer dans le catalogue d'application dans la webadmin (dans `Applications > Installer`) ou bien [ici](/apps).

! Attention à rester raisonnable sur le nombre d'applications installées. Chaque installation supplémentaire augmente la surface d'attaque et les risques de panne. Idéalement, si vous souhaitez faire des tests, faites-le avec une autre instance par exemple dans [une machine virtuelle](/install/hardware:virtualbox).

Les applications doivent être packagées manuellement par les packageurs/mainteneurs d'applications. Les applications peuvent être intégrées avec YunoHost pour gérer les mises à jour, la sauvegarde/restauration et l'intégration LDAP/SSO, entre autres.

## Instructions après l'installation

Certaines applications ont besoin de vous communiquer des instructions, des URL ou des identifiants une fois qu'elles sont installées. Pensez donc à vérifier les emails du premier compte utilisateur.

## Niveaux d'intégration et de qualité

Des tests automatisés sont exécutés régulièrement pour tester l'intégration et la qualité de toutes les applications qui ont été déclarées "working" par leur packageurs. Le résultat est un niveau entre 0 et 8, dont la signification est détaillée sur [cette page](/packaging_apps_levels). Certains résultats de tests peuvent également être disponibles sur [ce tableau de bord](https://dash.yunohost.org/appci/branch/stable).

Par défaut, seules les applications d'une qualité suffisante vous sont proposées. Lorsque la qualité d'une application chute, les mises à jour sont mises en attente et l'installation n'est plus possible, le temps que le problème soit résolu.

## Intégration LDAP / SSO

Les applications peuvent prendre en charge l'intégration avec le système LDAP / Single Sign On, de sorte que les utilisateurs qui se connectent au portail utilisateur puissent être automatiquement authentifiés sur toutes ces applications. Certaines applications ne le supportent pas, soit parce que cette fonctionnalité n'est pas implémentée en amont du logiciel de l'application, soit parce que le mainteneur n'a pas encore travaillé sur cette partie. Cette information est en général disponible sur le README du paquet d'application.

## Applications multi-instances

Certaines applications peuvent être installées plusieurs fois (à différents endroits) ! Pour ce faire, il suffit de retourner dans Applications > Installer, et de sélectionner à nouveau l'application à installer.

## Gestion des tuiles

Les applications web peuvent fournir des tuiles disponibles depuis le portail utilisateur, il est possible de choisir de les afficher ou non et de redéfinir le texte via l'interface d'administration web `Applications > Nom de l'APP > Opérations > Gérer les étiquettes et les tuiles` ou via la ligne de commande: `yunohost app change-label <app> "Nouveau texte"`.

## Gestion de l'accès des utilisateurs

L'accès aux applications peut être limité à certains utilisateurs seulement. Ceci peut être configuré via la webadmin sur la page [Groupes et permissions](/groups_and_permissions), ou de la même manière via la sous-catégorie de commandes `yunohost user permission`.

## Éxécuter des commandes au sein d'une app

À partir de YunoHost v11.1.21.4, si vous avez besoin d'exécuter des commandes avec le binaire de l'application, ou des commandes PHP, etc., vous pouvez exécuter la commande `yunohost app shell <app>`.
Cela aura pour effet de :

- ouvrir un nouveau shell Bash en tant qu'utilisateur système de l'application
- ouvrir le répertoire de travail de l'application (par exemple `/var/www/<app>`)
- précharger l'environnement avec des variables provenant du service de l'application, s'il existe
- remplacer `php`, pour qu'il pointe vers la version de PHP utilisée par l'application

## Packaging d'applications

Si vous voulez apprendre ou contribuer à l'empaquetage des applications, veuillez consulter la [documentation des contributeurs](/contributordoc).

## Sous-chemins vs. domaines individuels par application

Dans le contexte de YunoHost, il est assez courant d'avoir un seul (ou quelques) domaines sur lesquels plusieurs applications sont installées dans des "sous-chemins", de sorte que l'on se retrouve avec quelque chose comme ceci :

```text
yolo.com
     ├─── /blog  : Wordpress (un blog)
     ├─── /cloud : Nextcloud (un service de cloud)
     ├─── /rss   : TinyTiny RSS (un lecteur RSS)
     ├─── /wiki  : DokuWiki (un wiki)
```

Alternativement, on peut choisir d'installer chaque application (ou certaines) sur un domaine dédié. Au delà de la question esthétique, utiliser des sous-domaines au lieu de sous-chemins permet de laisser la possibilité de déplacer un service sur un autre serveur plus facilement. Par ailleurs, certaines applications peuvent avoir besoin d'un domaine entier qui leur est dédié, pour des raisons techniques. L'inconvénient est que vous devez ajouter un nouveau domaine à chaque fois, et donc potentiellement configurer des enregistrements DNS supplémentaire, relancer le diagnostique et l'installation d'un nouveau certificat Let's Encrypt.

Si toutes les applications de l'exemple précédent étaient installées sur un domaine séparé, cela donnerait quelque chose comme ceci :

```text
blog.yolo.com  : Wordpress (un blog)
cloud.yolo.com : Nextcloud (un service de cloud)
rss.yolo.com   : TinyTiny RSS (un lecteur RSS)
wiki.yolo.com  : DokuWiki (un wiki)
```

!!! De nombreuses applications intègrent une fonctionnalité qui vous permet de changer l'URL de votre application. Ce choix entre sous-chemin et sous-domaine peut donc dans certains cas être réversible via une simple manipulation dans l'interface d'administration.
