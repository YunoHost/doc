# Quality levels of YunoHost application packages

In order to facilitate the packaging of applications by providing successive steps to achieve, each package is assigned a quality level, from 0 to 10.  
A package must meet a number of criteria to reach each level. In addition, to reach a level, the package must have previously reached the previous level.

This classification of applications by levels has 3 advantages:
- The application packaging is more fun, with clear objectives to achieve and successive steps.
- A properly packaged application is put forward more than an application that does not comply with packaging rules.
- Users can quickly see the level of an application and thus know if the package is of good quality.

## Level summary

**Level 0**
The application does not work.

**Level 1**
The application installs and uninstalls correctly in some cases.

**Level 2**
The application installs and uninstalls correctly in all common configurations.

**Level 3**
The application can be updated.

**Level 4**
The application can be saved and restored.

**Level 5**
The application package code follows some syntax rules.

**Level 6**
The application package is in the YunoHost-Apps organization.

**Level 7**
The application package passes all integrity tests successfully.

**Level 8**
The application package respects all packaging recommendations. This is a high quality app.

**Level 9**
The application complies with higher packaging recommendations. Not available yet.

**Level 10**
The application package is considered perfect!

## Quality levels in detail:

### Level 0

**The application does not install or run after installation.**  

This is the lowest level, a level 0 application is considered non-functional.

YEP to be respected to reach level 0:
- [YEP 1.1](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-11---nommer-son-app-et-son-d%C3%A9pot---valid%C3%A9--manuel--notworking-) Name your app and repository
- [YEP 1.2](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-12---inscrire-lapp-sur-un-r%C3%A9pertoire-connu---valid%C3%A9--manuel--notworking-) Add the app to a known app list 

### Level 1

**The application can be installed and uninstalled correctly.** 

But exceptions are possible, if at least one installation method is functional and its removal then the application is considered functional.

YEP to be respected to reach level 1:
- [YEP 2.2](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-22---utiliser-bash-pour-les-scripts-principaux---valid%C3%A9--auto--working-) Use bash for main scripts
- [YEP 2.5](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-25---copier-correctement-des-fichiers----brouillon--manuel--working-) Correctly copy files
- [YEP 2.7](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-27---donner-des-permissions-suffisantes-aux-instructions-bash----valid%C3%A9--auto--working-) Bash instructions: Give sufficient permissions to bash instructions
- [YEP 2.15](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-215---v%C3%A9rifier-les-param%C3%A8tres-saisies-par-lutilisateur----valid%C3%A9--manuel--official-) : Follow the application installation instructions

### Level 2

**The application can be installed and uninstalled in all common configurations.**  

- Installation in subfolder.
- Installation at the root of a domain or subdomain.
- Private installation (secured by the SSO).
- Public installation.
- Multi-instance installation.
- Uninstallation under the same circumstances.

*If an application does not allow certain installation configurations, these must be clearly indicated in the README. However, level 2 cannot be reached if an installation configuration is intentionally discarded without valid reason.*  
*This does not preclude the voluntary restriction of public, private or multi-instance if it is relevant for this application.*

YEP to be respected to reach level 2:
- [YEP 1.5](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-15---mettre-%C3%A0-jour-r%C3%A9guli%C3%A8rement-le-statut-de-lapp---brouillon--manuel--working-) : Update app status regularly
- *[YEP 2.18.2](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-2182---supporter-linstallation-sur-un-domaine----valid%C3%A9--auto--working-) : Support installation on a domain*
- *[YEP 2.18.3](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-2183---supporter-linstallation-sur-un-sous-domaine----valid%C3%A9--auto--working-) : Support installation on a subdomain*
- *[YEP 2.18.4](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-2184---supporter-linstallation-sur-un-sous-dossier----valid%C3%A9--auto--official-) : Support installation on a subfolder*
- *[YEP 4.6](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-46---g%C3%A8re-le-multi-instance----valid%C3%A9--manuel--optional-) : Manage multi-instance*

### Level 3

**The application supports upgrade from an older version of the package.**  

The application must be able to be updated from a previous version of the package without causing an error.

YEP to be respected to reach level 3:
- [YEP 2.3](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-23---sauvegarder-les-r%C3%A9ponses-lors-de-linstallation---valid%C3%A9--manuel--working-) Save answers during installation

### Level 4

**The application can be backed up and restored without error on the same machine or another.** 

YEP to be respected to reach level 4:
- *[YEP 4.3](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-43---fournir-un-script-de-sauvegarde-yunohost-fonctionnel----valid%C3%A9--auto--official-) : Provide a functional YunoHost backup script*
- *[YEP 4.4](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-44---fournir-un-script-de-restauration-yunohost-fonctionnel----valid%C3%A9--auto--official-) :  Provide a functional YunoHost restore script*

### Level 5

**The application has no errors in [Package linter](https://github.com/YunoHost/package_linter).**  

*There may be false positives in Package linter. These situations will be handled on a case-by-case basis.*

YEP to be respected to reach level 5:
- *[YEP 1.3](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-13---indiquer-la-licence-associ%C3%A9e-au-paquet---valid%C3%A9--auto--working-) : Specify the license associated with the package*
- *[YEP 2.1](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-21---respecter-le-format-du-manifeste---valid%C3%A9--auto--inprogress-) : Respect manifest format*
- [YEP 2.12](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-212---utiliser-les-commandes-pratiques-helpers---valid%C3%A9--auto--official-) : Use practical commands (helpers)
- [YEP 2.18.1](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-2181---lancer-le-script-dinstallation-dune-webapp-correctement----valid%C3%A9--manuel--working-) : Run the webapp installation script correctly

### Level 6

**The application can be backed up and restored without error on the same machine or another.** 

YEP to be respected to reach level 6:
- [YEP 1.4](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-14---informer-sur-lintention-de-maintenir-un-paquet----brouillon--manuel--working-) : Inform about the intention to maintain a package
- [YEP 1.6](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-16---se-tenir-inform%C3%A9-sur-l%C3%A9volution-du-packaging-dapps---valid%C3%A9--manuel--official-) : As a maintainer, keep checking and being aware of the evolution of apps packaging
- *[YEP 1.7](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-17---ajouter-lapp-%C3%A0-lorganisation-yunohost-apps---valid%C3%A9--manuel--official-) : Add app to the [YunoHost-Apps organization](https://github.com/YunoHost-Apps)*
- [YEP 1.8](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-18---publier-des-demandes-de-test---valid%C3%A9--manuel--official-) : Publish test requests
- [YEP 1.9](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-19---documenter-lapp---valid%C3%A9--auto--official-) : Document app
- [YEP 1.10](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-110---garder-un-historique-de-version-propre----brouillon--manuel--official-) : Keep a clean version history
- [YEP 2.9](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-29---enlever-toutes-traces-de-lapp-lors-de-la-suppression----brouillon--manuel--working-) : Remove all traces of the app during deletion
- [YEP 3.3](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-33---faciliter-le-contr%C3%B4le-de-lint%C3%A9grit%C3%A9-des-sources----brouillon--manuel--official-) :  Facilitating source integrity control
- [YEP 3.5](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-35---suivre-les-recommendations-de-la-documentation-de-lapp----valid%C3%A9--manuel--official-) : Follow the recommendations of the app documentation
- [YEP 3.6](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-36---mettre-%C3%A0-jour-les-versions-contenant-des-cve----draft--manuel--official-) : Update versions containing CVEs

### Level 7

**The application has no errors in [Package check](https://github.com/YunoHost/package_check).** 

Considering the maximum number of tests possible for the application.

YEP à respecter pour atteindre le niveau 7:
- [YEP 2.4](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-24---d%C3%A9tecter-et-g%C3%A9rer-les-erreurs---brouillon--manuel--working-) : Error detection and management
- [YEP 2.6](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-26---annuler-laction-si-les-valeurs-dentr%C3%A9es-sont-incorrectes----valid%C3%A9--manuel--working-) :  Cancel action if input values are incorrect
- [YEP 2.8](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-28---modifier-correctement-une-configuration-syst%C3%A8me----brouillon--manuel--working-) : Change a system configuration correctly
- [YEP 2.10](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-210---configurer-les-logs-de-lapplication----brouillon--manuel--working-) : Configure application logs
- [YEP 2.11](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-211---utiliser-une-variable-plut%C3%B4t-que-lapp-id-directement---valid%C3%A9--manuel--official-) : Use a variable rather than the app id directly
- [YEP 2.13](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-213---traduire-le-package-en-anglais----brouillon--manuel--official-) : Translate the package into English
- [YEP 3.2](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-32---ouvrir-un-port-correctement----brouillon--manuel--working-) : Open port: Open port correctly

### Level 8

**The application package respects all packaging recommendations. This is a high quality app.**

YEP to be respected to reach level 8:
- [YEP 1.12](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-112) : Follow the template from example_ynh
- *[YEP 2.16](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-216---v%C3%A9rifier-la-disponibilit%C3%A9-des-d%C3%A9pendances-sur-arm-x86-et-x64----valid%C3%A9--manuel--official-) : Check dependency availability on ARM, x86 and x64*
- [YEP 2.18.5](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-2185---ajouter-la-tuile-yunohost-pour-naviguer-facilement-entre-les-applications----valid%C3%A9--manuel--official-) : Add the YunoHost tile to easily navigate between applications
- [YEP 4.1](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-41---lier-au-ldap----valid%C3%A9--manuel--official-) : Link to ldap
- [YEP 4.2](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-42---lier-lauthentification-au-sso----valid%C3%A9--manuel--official-) : Bind authentication to sso
- [YEP 4.5](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-45---utiliser-les-hooks----valid%C3%A9--manuel--optional-) : Use hooks

If an application is not available on an architecture, and it is impossible to circumvent this limitation reasonably, this limitation must be indicated in the REDME and taken into account in the installation script. The installation of the application on an unsupported architecture must be stopped before modifying the filesystem.

### Level 9

**The application complies with all optional YEPs.**

YEP to be respected to reach level 9:

- [YEP 2.14](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-214---remplir-correctement-un-fichier-de-conf----brouillon--manuel--official-) :  Fill a conf file correctly
- [YEP 2.17](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-217---prendre-en-compte-la-version-dorigine-lors-des-mises-%C3%A0-jour----valid%C3%A9--manuel--official-) : Take into account the original version during updates
- [YEP 3.4](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-34---isoler-lapp----brouillon--manuel--official-) : Isolate app
- [YEP 4.2.1](https://github.com/YunoHost/doc/blob/master/packaging_apps_guidelines_fr.md#yep-421---d%C3%A9connexion----valid%C3%A9--manuel--official-) : Logout

### Level 10

**The application is considered perfect.**

This ultimate level for an application can only be reached after an in-depth study of the package and by the validation of the Apps group.
