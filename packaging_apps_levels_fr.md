# Niveaux de qualité des packages d'applications YunoHost

Afin de faciliter le packaging d'applications par des étapes successives à atteindre, chaque package est affublé d'un niveau de qualité, de 0 à 10.  
Un package doit satisfaire un certain nombre de critères pour atteindre chaque niveau. De plus pour atteindre un niveau, le package doit avoir préalablement atteint le niveau précédent.

Ce classement des applications par niveaux présente 3 avantages:
- Le packaging d'application est d'autant plus ludique, avec des objectifs clairs à atteindre et des étapes successives.
- Une application correctement packagée est davantage mise en avant qu'une application ne respectant pas les règles de packaging.
- Les utilisateurs peuvent rapidement voir le niveau d'une application et ainsi savoir si le package est de bonne qualité.

## Résumé des niveaux

**Niveau 0**  
L'application ne fonctionne pas.

**Niveau 1**  
L'application s'installe et se désinstalle correctement dans certains cas.

**Niveau 2**  
L'application s'installe et se désinstalle correctement dans toutes les configurations communes.

**Niveau 3**  
L'application peut être mise à jour.

**Niveau 4**  
L'application peut-être sauvegardée et restaurée.

**Niveau 5**  
Le code du package d'application respecte certaines règles de syntaxe.

**Niveau 6**  
Le package d'application est dans l'organisation YunoHost-Apps.

**Niveau 7**  
Le package d'application passe avec succès l'ensemble des tests d'intégrité.

**Niveau 8**  
Le package d'application respecte toute les recommendations de packaging d'apps. C'est une app de très bonne qualité.

**Niveau 9**  
Le package d'application respecte des recommandations de packaging supérieures. Non disponible pour le moment.

**Niveau 10**  
Le package d'application est jugé parfait !

## Les niveaux de qualité en détails:

### Niveau 0
**L'application ne s'installe pas ou ne fonctionne pas après installation.**  
C'est le niveau le plus bas, une application de niveau 0 est considérée comme non fonctionnelle.

YEP à respecter pour atteindre le niveau 0:
- [YEP 1.1](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-11---nommer-son-app-et-son-d%C3%A9pot---valid%C3%A9--manuel--notworking-) : Nommer son app et son dépôt
- [YEP 1.2](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-12---inscrire-lapp-sur-un-r%C3%A9pertoire-connu---valid%C3%A9--manuel--notworking-) : Inscrire l'app sur un "répertoire" connu

### Niveau 1
**L'application s'installe et se désinstalle correctement.**  
Mais des exceptions sont possibles, si au moins une méthode d'installation est fonctionnelle ainsi que sa suppression alors l'application est considérée comme fonctionnelle.

YEP à respecter pour atteindre le niveau 1:
- [YEP 2.2](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-22---utiliser-bash-pour-les-scripts-principaux---valid%C3%A9--auto--working-) : Utiliser bash pour les scripts principaux
- [YEP 2.5](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-25---copier-correctement-des-fichiers----brouillon--manuel--working-) : Copier correctement des fichiers
- [YEP 2.7](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-27---donner-des-permissions-suffisantes-aux-instructions-bash----valid%C3%A9--auto--working-) : Donner des permissions suffisantes aux instructions bash
- [YEP 2.15](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-215---v%C3%A9rifier-les-param%C3%A8tres-saisies-par-lutilisateur----valid%C3%A9--manuel--official-) : Suivre les instructions d'installation de l'application

### Niveau 2
**L'application s'installe et se désinstalle dans toutes les configurations communes.**  

- Installation en sous-dossier.
- Installation à la racine d'un domaine ou d'un sous-domaine.
- Installation privée (sécurisée par le SSO).
- Installation publique.
- Installation multi-instance.
- Désinstallation dans les mêmes circonstances.

*Si une application ne permet pas certaines configurations d'installation, celles-ci doivent être indiquées clairement dans le readme du package. Toutefois, le niveau 2 ne peut pas être atteint si une configuration d'installation est volontairement écartée sans raison valable.*  
*Cela n'empêche pas de restreindre volontairement les installations publiques, privées ou multi-instance si l'application le justifie.*

YEP à respecter pour atteindre le niveau 2:
- [YEP 1.5](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-15---mettre-%C3%A0-jour-r%C3%A9guli%C3%A8rement-le-statut-de-lapp---brouillon--manuel--working-) : Mettre à jour régulièrement le statut de l'app
- *[YEP 2.18.2](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-2182---supporter-linstallation-sur-un-domaine----valid%C3%A9--auto--working-) : Supporter l'installation sur un domaine*
- *[YEP 2.18.3](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-2183---supporter-linstallation-sur-un-sous-domaine----valid%C3%A9--auto--working-) : Supporter l'installation sur un sous-domaine*
- *[YEP 2.18.4](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-2184---supporter-linstallation-sur-un-sous-dossier----valid%C3%A9--auto--official-) : Supporter l'installation sur un sous-dossier*
- *[YEP 4.6](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-46---g%C3%A8re-le-multi-instance----valid%C3%A9--manuel--optional-) : Gère le multi-instance*

### Niveau 3
**L'application supporte l'upgrade depuis une ancienne version du package.**  
L'application doit pouvoir être mise à jour depuis une version précédente du package sans provoquer d'erreur.

YEP à respecter pour atteindre le niveau 3:
- [YEP 2.3](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-23---sauvegarder-les-r%C3%A9ponses-lors-de-linstallation---valid%C3%A9--manuel--working-) : Sauvegarder les réponses lors de l'installation

### Niveau 4
**L'application peut-être sauvegardée et restaurée sans erreur sur la même machine ou une autre.**  

YEP à respecter pour atteindre le niveau 4:
- *[YEP 4.3](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-43---fournir-un-script-de-sauvegarde-yunohost-fonctionnel----valid%C3%A9--auto--official-) : Fournir un script de sauvegarde YunoHost fonctionnel*
- *[YEP 4.4](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-44---fournir-un-script-de-restauration-yunohost-fonctionnel----valid%C3%A9--auto--official-) : Fournir un script de restauration YunoHost fonctionnel*

### Niveau 5
**L'application ne présente aucune erreur dans [Package linter](https://github.com/YunoHost/package_linter).**  
*Il peut y avoir des faux positifs dans Package linter. Ces situations seront gérées au cas par cas.*

YEP à respecter pour atteindre le niveau 5:
- *[YEP 1.3](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-13---indiquer-la-licence-associ%C3%A9e-au-paquet---valid%C3%A9--auto--working-) : Indiquer la licence associée au paquet*
- *[YEP 2.1](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-21---respecter-le-format-du-manifeste---valid%C3%A9--auto--inprogress-) : Respecter le format du manifeste*
- [YEP 2.12](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-212---utiliser-les-commandes-pratiques-helpers---valid%C3%A9--auto--official-) : Utiliser les commandes pratiques (helpers)
- [YEP 2.18.1](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-2181---lancer-le-script-dinstallation-dune-webapp-correctement----valid%C3%A9--manuel--working-) : Lancer le script d'installation d'une webapp correctement

### Niveau 6
**Le package d'application est dans l'organisation YunoHost-Apps.**  

YEP à respecter pour atteindre le niveau 6:
- [YEP 1.4](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-14---informer-sur-lintention-de-maintenir-un-paquet----brouillon--manuel--working-) : Informer sur l'intention de maintenir un paquet
- [YEP 1.6](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-16---se-tenir-inform%C3%A9-sur-l%C3%A9volution-du-packaging-dapps---valid%C3%A9--manuel--official-) : Se tenir informé sur l'évolution du packaging d'apps
- *[YEP 1.7](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-17---ajouter-lapp-%C3%A0-lorganisation-yunohost-apps---valid%C3%A9--manuel--official-) : Ajouter l'app à l'[organisation YunoHost-Apps](https://github.com/YunoHost-Apps)*
- [YEP 1.8](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-18---publier-des-demandes-de-test---valid%C3%A9--manuel--official-) : Publier des demandes de test
- [YEP 1.9](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-19---documenter-lapp---valid%C3%A9--auto--official-) : Documenter l'app
- [YEP 1.10](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-110---garder-un-historique-de-version-propre----brouillon--manuel--official-) : Garder un historique de version propre
- [YEP 2.9](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-29---enlever-toutes-traces-de-lapp-lors-de-la-suppression----brouillon--manuel--working-) : Enlever toutes traces de l'app lors de la suppression
- [YEP 3.3](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-33---faciliter-le-contr%C3%B4le-de-lint%C3%A9grit%C3%A9-des-sources----brouillon--manuel--official-) : Faciliter le contrôle de l'intégrité des sources
- [YEP 3.5](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-35---suivre-les-recommendations-de-la-documentation-de-lapp----valid%C3%A9--manuel--official-) : Suivre les recommandations de la documentation de l'app
- [YEP 3.6](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-36---mettre-%C3%A0-jour-les-versions-contenant-des-cve----draft--manuel--official-) : Mettre à jour les versions contenant des CVE

### Niveau 7
**L'application ne présente aucune erreur dans [Package check](https://github.com/YunoHost/package_check).**  
En considérant le maximum de tests possibles pour l'application.

YEP à respecter pour atteindre le niveau 7:
- [YEP 2.4](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-24---d%C3%A9tecter-et-g%C3%A9rer-les-erreurs---brouillon--manuel--working-) : Détecter et gérer les erreurs
- [YEP 2.6](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-26---annuler-laction-si-les-valeurs-dentr%C3%A9es-sont-incorrectes----valid%C3%A9--manuel--working-) : Annuler l'action si les valeurs d'entrées sont incorrectes
- [YEP 2.8](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-28---modifier-correctement-une-configuration-syst%C3%A8me----brouillon--manuel--working-) : Modifier correctement une configuration système
- [YEP 2.10](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-210---configurer-les-logs-de-lapplication----brouillon--manuel--working-) : Configurer les logs de l'application
- [YEP 2.11](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-211---utiliser-une-variable-plut%C3%B4t-que-lapp-id-directement---valid%C3%A9--manuel--official-) : Utiliser une variable plutôt que l'app id directement
- [YEP 2.13](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-213---traduire-le-package-en-anglais----brouillon--manuel--official-) : Traduire le package en anglais
- [YEP 3.2](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-32---ouvrir-un-port-correctement----brouillon--manuel--working-) : Ouvrir un port correctement

### Niveau 8
**Le package d'application respecte toute les recommandations de packaging d'apps. C'est une app de très bonne qualité.**

YEP à respecter pour atteindre le niveau 8:
- *[YEP 2.16](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-216---v%C3%A9rifier-la-disponibilit%C3%A9-des-d%C3%A9pendances-sur-arm-x86-et-x64----valid%C3%A9--manuel--official-) : Vérifier la disponibilité des dépendances sur ARM, x86 et x64*
- [YEP 2.18.5](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-2185---ajouter-la-tuile-yunohost-pour-naviguer-facilement-entre-les-applications----valid%C3%A9--manuel--official-) : Ajouter la tuile YunoHost pour naviguer facilement entre les applications
- [YEP 4.1](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-41---lier-au-ldap----valid%C3%A9--manuel--official-) : Lier au ldap
- [YEP 4.2](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-42---lier-lauthentification-au-sso----valid%C3%A9--manuel--official-) : Lier l'authentification au sso
- [YEP 4.5](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-45---utiliser-les-hooks----valid%C3%A9--manuel--optional-) : Utiliser les hooks

*Si une application n'est pas disponible sur une architecture, et qu'il est impossible de contourner cette limitation raisonnablement, cette limitation doit être indiquée dans le readme et prise en compte dans le script d'installation. L'installation de l'application sur une architecture non supportée doit être stoppée avant de modifier les fichiers.*

### Niveau 9
**L'application respecte toutes les YEP optionnelles.**

YEP à respecter pour atteindre le niveau 9:
- [YEP 2.14](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-214---remplir-correctement-un-fichier-de-conf----brouillon--manuel--official-) : Remplir correctement un fichier de conf
- [YEP 2.17](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-217---prendre-en-compte-la-version-dorigine-lors-des-mises-%C3%A0-jour----valid%C3%A9--manuel--official-) : Prendre en compte la version d'origine lors des mises à jour
- [YEP 3.4](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-34---isoler-lapp----brouillon--manuel--official-) : Isoler l'app
- [YEP 4.2.1](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-421---d%C3%A9connexion----valid%C3%A9--manuel--official-) : Déconnexion

### Niveau 10
**L'application est jugée parfaite !**  
Ce niveau ultime pour une application ne peux être atteint que suite à étude approfondie du package et par la validation du groupe Apps.
