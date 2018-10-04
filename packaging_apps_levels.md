# Quality levels of YunoHost application packages
In order to facilitate the packaging of applications by successive steps to reach, each package is assigned a quality level, from 0 to 10.
A package must meet a number of criteria to reach each level. In addition, to reach a level, the package must have previously reached the previous level.

This ranking of applications by level has 3 advantages:
- Application packagers have clear goals to achieve, and specific steps to attain them.
- Users can quickly and easily see the quality level of an application and know if the package is of good quality.
- Applications of higher quality levels are shown more prominently than those of lower levels.

## Summary of levels

**Level 0**
The application does not work.

**Level 1**
The application installs and uninstalls correctly in some cases.

**Level 2**
The application installs and uninstalls correctly in all common configurations.

**Level 3**
The application can be updated.

**Level 4**
The application directly uses YunoHost users and allows unique identification from the YunoHost portal.

**Level 5**
The code of the application package follows some syntax rules.

**Level 6**
The application can be saved and restored.

**Level 7**
The application package successfully passes all integrity tests.

**Level 8**
The application follows a set of advanced recommendations improving its overall quality.

**Level 9**
The application respects all recommendations. It is a package of excellent quality.

**Level 10**
The application package is considered perfect!

## Quality levels in detail:

### Level 0
**The application doesn't install, or doesn't function after installation.**
This is the lowest level.  An application at level 0 is considered to be non-functional. 

YEP to follow in order to attain Level 0:
- [YEP 1.1](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-11---nommer-son-app-et-son-d%C3%A9pot---valid%C3%A9--manuel--notworking-) : Nommer son app et son dépôt
- [YEP 1.2](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-12---inscrire-lapp-sur-un-r%C3%A9pertoire-connu---valid%C3%A9--manuel--notworking-) : Inscrire l'app sur un "répertoire" connu

### Level 1
**The application installs and uninstalls correctly.**
While some exceptions are possible, if an application can at least install and uninstall then it is considered functional.

YEP to follow in order to attain Level 1:
- [YEP 2.2](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-22---utiliser-bash-pour-les-scripts-principaux---valid%C3%A9--auto--working-) : Utiliser bash pour les scripts principaux
- [YEP 2.5](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-25---copier-correctement-des-fichiers----brouillon--manuel--working-) : Copier correctement des fichiers
- [YEP 2.7](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-27---donner-des-permissions-suffisantes-aux-instructions-bash----valid%C3%A9--auto--working-) : Donner des permissions suffisantes aux instructions bash
- [YEP 2.15](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-215---v%C3%A9rifier-les-param%C3%A8tres-saisies-par-lutilisateur----valid%C3%A9--manuel--official-) : Suivre les instructions d'installation de l'application

### Level 2
**The application installs and uninstalls in all common configurations.**
- Installation in a subdirectory.
- Installation at the root of a domain.
- Installation in a subdomain.
- Private installation (secured by SSO).
- Public installation.
- Multi-instance installation.
- Uninstallation in the above configurations.

*If an application doesn't permit some configurations, this must be clearly indicated in the package's readme file.  Level 2 cannot be reached if the packager decides not to support some of the above configurations, without a good reason.*  
*This doesn't preclude voluntarily restricting public, private, or multi-instance capabilities if justified.*

YEP to follow in order to attain Level 2:
- [YEP 1.5](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-15---mettre-%C3%A0-jour-r%C3%A9guli%C3%A8rement-le-statut-de-lapp---brouillon--manuel--working-) : Mettre à jour régulièrement le statut de l'app
- *[YEP 2.18.2](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-2182---supporter-linstallation-sur-un-domaine----valid%C3%A9--auto--working-) : Supporter l'installation sur un domaine*
- *[YEP 2.18.3](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-2183---supporter-linstallation-sur-un-sous-domaine----valid%C3%A9--auto--working-) : Supporter l'installation sur un sous-domaine*
- *[YEP 2.18.4](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-2184---supporter-linstallation-sur-un-sous-dossier----valid%C3%A9--auto--official-) : Supporter l'installation sur un sous-dossier*
- *[YEP 4.6](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-46---g%C3%A8re-le-multi-instance----valid%C3%A9--manuel--optional-) : Gère le multi-instance*

### Level 3
** The application supports upgrading from an older version of the package. **
The application must be upgradable from a previous version of the package without causing an error.

YEP to follow in order to attain Level 3:
- [YEP 2.3](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-23---sauvegarder-les-r%C3%A9ponses-lors-de-linstallation---valid%C3%A9--manuel--working-) : Sauvegarder les réponses lors de l'installation

### Level 4
**The application uses LDAP or HTTP authentication**  
The application manages its users directly from the [YunoHost LDAP database](https://github.com/YunoHost/SSOwat/blob/366dd6c4438e6550f7438c36893690b628340185/config.lua#L50-L53) and allows unified login using [HTTP authentication](https://fr.wikipedia.org/wiki/Authentification_HTTP) from the SSO.

* If the application doesn't support LDAP or HTTP authentication, this level can be ignored, with justification.*

YEP to follow in order to attain Level 4:
- *[YEP 4.1](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-41---lier-au-ldap----valid%C3%A9--manuel--official-) : Lier au ldap*
- *[YEP 4.2](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-42---lier-lauthentification-au-sso----valid%C3%A9--manuel--official-) : Lier l'authentification au sso*

### Niveau 5
**The application doesn't show any errors in [Package linter](https://github.com/YunoHost/package_linter).**  
*False positives will be managed on a case-by-case basis.*

YEP to follow in order to attain Level 5:
- *[YEP 1.3](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-13---indiquer-la-licence-associ%C3%A9e-au-paquet---valid%C3%A9--auto--working-) : Indiquer la licence associée au paquet*
- [YEP 2.1](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-21---respecter-le-format-du-manifeste---valid%C3%A9--auto--inprogress-) : Respecter le format du manifeste
- [YEP 2.12](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-212---utiliser-les-commandes-pratiques-helpers---valid%C3%A9--auto--official-) : Utiliser les commandes pratiques (helpers)
- [YEP 2.18.1](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-2181---lancer-le-script-dinstallation-dune-webapp-correctement----valid%C3%A9--manuel--working-) : Lancer le script d'installation d'une webapp correctement

### Niveau 6
**L'application peut-être sauvegardée et restaurée sans erreur sur la même machine ou une autre.**  

YEP to follow in order to attain Level 6:
- [YEP 1.4](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-14---informer-sur-lintention-de-maintenir-un-paquet----brouillon--manuel--working-) : Informer sur l'intention de maintenir un paquet
- [YEP 1.6](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-16---se-tenir-inform%C3%A9-sur-l%C3%A9volution-du-packaging-dapps---valid%C3%A9--manuel--official-) : Se tenir informé sur l'évolution du packaging d'apps
- [YEP 1.7](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-17---ajouter-lapp-%C3%A0-lorganisation-yunohost-apps---valid%C3%A9--manuel--official-) : Ajouter l'app à l'[organisation YunoHost-Apps](https://github.com/YunoHost-Apps)
- [YEP 1.8](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-18---publier-des-demandes-de-test---valid%C3%A9--manuel--official-) : Publier des demandes de test
- [YEP 1.9](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-19---documenter-lapp---valid%C3%A9--auto--official-) : Documenter l'app
- [YEP 1.10](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-110---garder-un-historique-de-version-propre----brouillon--manuel--official-) : Garder un historique de version propre
- [YEP 2.9](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-29---enlever-toutes-traces-de-lapp-lors-de-la-suppression----brouillon--manuel--working-) : Enlever toutes traces de l'app lors de la suppression
- [YEP 3.3](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-33---faciliter-le-contr%C3%B4le-de-lint%C3%A9grit%C3%A9-des-sources----brouillon--manuel--official-) : Faciliter le contrôle de l'intégrité des sources
- [YEP 3.5](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-35---suivre-les-recommendations-de-la-documentation-de-lapp----valid%C3%A9--manuel--official-) : Suivre les recommandations de la documentation de l'app
- [YEP 3.6](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-36---mettre-%C3%A0-jour-les-versions-contenant-des-cve----draft--manuel--official-) : Mettre à jour les versions contenant des CVE
- *[YEP 4.3](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-43---fournir-un-script-de-sauvegarde-yunohost-fonctionnel----valid%C3%A9--auto--official-) : Fournir un script de sauvegarde YunoHost fonctionnel*
- *[YEP 4.4](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-44---fournir-un-script-de-restauration-yunohost-fonctionnel----valid%C3%A9--auto--official-) : Fournir un script de restauration YunoHost fonctionnel*

**If an app reaches level 6, it may apply to become an official app.**

### Level 7
**The application passes [Package check](https://github.com/YunoHost/package_check) without errors.**  
Taking into account the possible tests for the application.

YEP to follow in order to attain Level 7:
- [YEP 2.6](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-26---annuler-laction-si-les-valeurs-dentr%C3%A9es-sont-incorrectes----valid%C3%A9--manuel--working-) : Annuler l'action si les valeurs d'entrées sont incorrectes
- [YEP 3.2](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-32---ouvrir-un-port-correctement----brouillon--manuel--working-) : Ouvrir un port correctement

### Level 8
**The application follows all YEP recommendations.**

YEP to follow in order to attain Level 8:
- [YEP 2.4](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-24---d%C3%A9tecter-et-g%C3%A9rer-les-erreurs---brouillon--manuel--working-) : Détecter et gérer les erreurs
- [YEP 2.8](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-28---modifier-correctement-une-configuration-syst%C3%A8me----brouillon--manuel--working-) : Modifier correctement une configuration système
- [YEP 2.16](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-216---v%C3%A9rifier-la-disponibilit%C3%A9-des-d%C3%A9pendances-sur-arm-x86-et-x64----valid%C3%A9--manuel--official-) : Vérifier la disponibilité des dépendances sur ARM, x86 et x64
- [YEP 2.18.5](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-2185---ajouter-la-tuile-yunohost-pour-naviguer-facilement-entre-les-applications----valid%C3%A9--manuel--official-) : Ajouter la tuile YunoHost pour naviguer facilement entre les applications
- [YEP 3.4](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-34---isoler-lapp----brouillon--manuel--official-) : Isoler l'app
- [YEP 4.5](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-45---utiliser-les-hooks----valid%C3%A9--manuel--optional-) : Utiliser les hooks

*Si une application n'est pas disponible sur une architecture, et qu'il est impossible de contourner cette limitation raisonnablement, cette limitation doit être indiquée dans le readme et prise en compte dans le script d'installation. L'installation de l'application sur une architecture non supportée doit être stoppée avant de modifier les fichiers.*

### Level 9
**The application follows all of the optional YEPs.**

YEP to follow in order to attain Level 9:
- [YEP 2.10](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-210---configurer-les-logs-de-lapplication----brouillon--manuel--working-) : Configurer les logs de l'application
- [YEP 2.11](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-211---utiliser-une-variable-plut%C3%B4t-que-lapp-id-directement---valid%C3%A9--manuel--official-) : Utiliser une variable plutôt que l'app id directement
- [YEP 2.13](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-213---traduire-le-package-en-anglais----brouillon--manuel--official-) : Traduire le package en anglais
- [YEP 2.14](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-214---remplir-correctement-un-fichier-de-conf----brouillon--manuel--official-) : Remplir correctement un fichier de conf
- [YEP 2.17](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-217---prendre-en-compte-la-version-dorigine-lors-des-mises-%C3%A0-jour----valid%C3%A9--manuel--official-) : Prendre en compte la version d'origine lors des mises à jour
- [YEP 4.2.1](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-421---d%C3%A9connexion----valid%C3%A9--manuel--official-) : Déconnexion

### Level 10
**The app is considered perfect!**
This ultimate level for an application can only be reached after thorough study of the package and validation by the Apps group.

How to request the integration of an application in the official list?

Before applying for an application on the official list, you must commit to maintaining the app over time, or find someone who is committed to doing so.
An official application must be regularly updated and follow the packaging recommendations.

To claim to join the official list, the application must have reached at least level 6 and must be free software.

If all these prerequisites are satisfied, you can create a pull request on the official list or make a request on the forum.
From then on, the package will be checked by the members of the Apps group and the decision to include it in the list of official applications will be debated by the group.

Hopefully the app will join YunoHost's official apps.
