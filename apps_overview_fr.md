Applications
============

L'une des fonctionnalités principales de YunoHost est la possibilité d'installer facilement des applications immédiatement utilisables. Pour donner des exemples d'application, il est possible d'installer un système de blog, un "cloud" (pour héberger et synchroniser des fichiers), un site web, un lecteur RSS, ....

Les applications doivent être packagées manuellement par les packageurs/mainteneurs d'applications. Les applications peuvent être intégrées avec YunoHost pour gérer les mise à jour, la sauvegarde/restauration et l'intégration LDAP/SSO, entre autres.

Les applications peuvent être installées et gérées via l'interface webadmin dans la partie 'Applications', ou via les commandes de la catégorie `yunohost app`.

Listes d'applications
-----------------

Du point de vue technique, les applications sont des dépôts de code public (comme [celui-ci](https://github.com/YunoHost-Apps/wordpress_ynh)). Les applications existantes sont indexées à l'aide de "listes d'applications". Ces listes peuvent être gérées dans Applications > Installer > Gérer les listes d'applications, ou avec des commandes telles que `yunohost app fetchlist`.

Par défaut, YunoHost ne connaît que la liste officielle des applications. Il s'agit d'applications qui ont été soigneusement packagées, intégrées, revues et doivent être maintenues par l'équipe YunoHost. 

Néanmoins, vous souhaiterez peut-être avoir accès au catalogue plus fourni de la liste communautaire. Cette liste peut facilement être ajouté via la vue 'Gérer les listes d'applications' de l'administrateur web, ou avec la commande `yunohost app fetchlist -n community -u https://app.yunohost.org/community.json`. Sachez simplement que les applications de cette liste offrent moins de garanties que les applications officielles et que l'équipe YunoHost n'en est pas responsable !

La liste des applications existantes (officielles et communautaires) peut être consultée sur [cette page](/apps).

Niveaux d'intégration et de qualité
------------------------------

Des tests automatisés sont exécutés régulièrement pour tester l'intégration et la qualité de toutes les applications officielles, ainsi que les applications communautaires qui ont été déclarées "working". Le résultat est un niveau entre 0 et 7, dont la signification est détaillée sur [cette page](/packaging_apps_levels_fr). Certains résultats de tests peuvent également être disponibles sur [ce tableau de bord](https://dash.yunohost.org/appci/branch/stable).

Intégration LDAP / SSO
----------------------

Les applications peuvent prendre en charge l'intégration avec le système LDAP / Single Sign On, de sorte que les utilisateurs qui se connectent au portail utilisateur peuvent être automatiquement authentifiés sur toutes ces applications. Certaines applications ne le supportent pas car cette fonctionnalité n'est, soit pas implémentée en amont du logiciel de l'application, soit le mainteneur n'a pas encore travaillé sur cette partie.

Applications multi-instances
---------------------------

Certaines applications peuvent être installées plusieurs fois (à différents endroits) ! Pour ce faire, il suffit de retourner dans Applications > Installer, et de sélectionner à nouveau l'application à installer.


Gestion de l'accès des utilisateurs
----------------------

L'accès aux applications peut être limité à certains utilisateurs seulement. Ceci peut être configuré via la webadmin dans Applications > (une application) > Accès, ou de la même manière via les commandes `yunohost app addaccess`, `removeaccess` et `clearaccess`.

Packaging d'applications
------------------------

Si vous voulez apprendre ou contribuer à l'empaquetage des applications, veuillez consulter la [documentation des contributeurs](contributordoc).

