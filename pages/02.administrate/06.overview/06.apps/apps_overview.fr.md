---
title: Les applications
template: docs
taxonomy:
    category: docs
routes:
  default: '/apps_overview'
---

L'une des fonctionnalités principales de YunoHost est la possibilité d'installer facilement des applications immédiatement utilisables. Pour donner des exemples d'application, il est possible d'installer un système de blog, un "cloud" (pour héberger et synchroniser des fichiers), un site web, un lecteur RSS...

Les applications doivent être packagées manuellement par les packageurs/mainteneurs d'applications. Les applications peuvent être intégrées avec YunoHost pour gérer les mise à jour, la sauvegarde/restauration et l'intégration LDAP/SSO, entre autres.

Les applications peuvent être installées et gérées via l'interface webadmin dans la partie 'Applications', ou via les commandes de la catégorie `yunohost app`.

Il est possible de naviguer dans le catalogue d'application dans la webadmin (dans Applications > Installer) ou bien [ici](/apps).

## Niveaux d'intégration et de qualité

Des tests automatisés sont exécutés régulièrement pour tester l'intégration et la qualité de toutes les applications officielles, ainsi que les applications communautaires qui ont été déclarées "working". Le résultat est un niveau entre 0 et 7, dont la signification est détaillée sur [cette page](/packaging_apps_levels). Certains résultats de tests peuvent également être disponibles sur [ce tableau de bord](https://dash.yunohost.org/appci/branch/stable).

## Intégration LDAP / SSO

Les applications peuvent prendre en charge l'intégration avec le système LDAP / Single Sign On, de sorte que les utilisateurs qui se connectent au portail utilisateur peuvent être automatiquement authentifiés sur toutes ces applications. Certaines applications ne le supportent pas car cette fonctionnalité n'est, soit pas implémentée en amont du logiciel de l'application, soit le mainteneur n'a pas encore travaillé sur cette partie.

## Applications multi-instances

Certaines applications peuvent être installées plusieurs fois (à différents endroits) ! Pour ce faire, il suffit de retourner dans Applications > Installer, et de sélectionner à nouveau l'application à installer.

## Gestion de l'accès des utilisateurs

L'accès aux applications peut être limité à certains utilisateurs seulement. Ceci peut être configuré via la webadmin sur la page [Groupes et permissions](/groups_and_permissions), ou de la même manière via la sous-catégorie de commandes `yunohost user permission`.

## Packaging d'applications

Si vous voulez apprendre ou contribuer à l'empaquetage des applications, veuillez consulter la [documentation des contributeurs](/contributordoc).
