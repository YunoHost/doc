# Packaging d’applications : les bonnes pratiques

<div class="alert alert-danger">
<b>
Cette page est en cours d'élaboration. Tant que cet avertissement n'est pas enlevé. Considérez ces informations comme potentiellement fausse.
Le nom YEP n'est à priori pas définitif, ni les niveaux, ni les bonnes pratiques en elle-même.
</b>
</div>

### Introduction
Ce document a pour but de lister les différentes bonnes pratiques concernant la création de paquet d'application YunoHost.

Chaque bonne pratique est numérotée avec un numéro suffixé par les lettres YEP (YunoHost Enhancement Proposals), ceci afin de pouvoir y faire référence facilement dans les outils d'analyse automatique de paquet ([package checker](https://github.com/YunoHost/package_check), [package linter](https://github.com/YunoHost/package_linter)), mais également lors des revues de code.

Chaque YEP est associée à :
* un statut indiquant si la règle a été validée ou si elle fait encore l'objet de discussion (brouillon, validé, refusé, obsolète) ;
* une indication sur le type de test à mener (manuel ou auto si un outil automatique peut vérifier) ;
* une indication du niveau d'app à partir duquel la règle est nécessaire (NOTWORKING, INPROGRESS, WORKING, OFFICIAL), certaines règles sont optionnelles ;

### Index des YEP
| ID |  Titre | Statut | Test | Niveau |
|----|--------|--------|------|--------|
| **YEP 1** | **Communiquer avec la communauté** | | | |
| YEP 1.1 | Nommer son app et son dépot  | validé | manuel | NOTWORKING (0) |
| YEP 1.2 | Inscrire l'app sur un "répertoire" connu  | validé | manuel | NOTWORKING (0) |
| YEP 1.3 | Indiquer la licence associée au paquet  | validé | AUTO | WORKING (5) |
| YEP 1.4 | Informer sur l'intention de maintenir un paquet   | brouillon | manuel | OFFICIAL (6) |
| YEP 1.5 | Mettre à jour régulièrement le statut de l'app  | brouillon | manuel | WORKING (2) |
| YEP 1.6 | Se tenir informé sur l'évolution du packaging d'apps  | validé | manuel | OFFICIAL (6) |
| YEP 1.7 | Ajouter l'app à l'[organisation YunoHost-Apps](https://github.com/YunoHost-Apps)  | validé | manuel | OFFICIAL (6) |
| YEP 1.8 | Publier des demandes de test  | validé | manuel | OFFICIAL (6) |
| YEP 1.9 | Documenter l'app  | validé | AUTO | OFFICIAL (6) |
| YEP 1.10 | Garder un historique de version propre   | brouillon | manuel | OFFICIAL (6) |
| YEP 1.11 | Ajouter l'app au [bugtracker YunoHost](https://github.com/yunohost/issues/issues)   | brouillon | manuel | OFFICIAL (NA) |
| YEP 1.12 | Suivre le modèle de [example_ynh](https://github.com/YunoHost/example_ynh) | brouillon | manuel | OFFICIAL (8) |
| | | | | |
| **YEP 2** | **Stabiliser une app** | **Statut** | **Test** | **Niveau** |
| YEP 2.1 | Respecter le format du manifeste  | validé | auto | INPROGRESS (5) |
| YEP 2.2 | Utiliser bash pour les scripts principaux  | validé | auto | WORKING (1) |
| YEP 2.3 | Sauvegarder les réponses lors de l'installation  | validé | manuel | WORKING (3) |
| YEP 2.4 | Détecter et gérer les erreurs  | brouillon | manuel | WORKING (8) |
| YEP 2.5 | Copier correctement des fichiers   | brouillon | manuel | WORKING (1) |
| YEP 2.6 | Annuler l'action si les valeurs d'entrées sont incorrectes   | validé | manuel | WORKING (7) |
| YEP 2.7 | Donner des permissions suffisantes aux instructions bash   | validé | auto | WORKING (1) |
| YEP 2.8 | Modifier correctement une configuration système   | brouillon | manuel | WORKING (8) |
| YEP 2.9 | Enlever toutes traces de l'app lors de la suppression   | brouillon | manuel | WORKING (6) |
| YEP 2.10 | Configurer les logs de l'application   | brouillon | manuel | WORKING (9) |
| YEP 2.11 | Utiliser une variable plutôt que l'app id directement  | validé | manuel | OFFICIAL (9) |
| YEP 2.12 | Utiliser les commandes pratiques (helpers)  | validé | auto | OFFICIAL (5) |
| YEP 2.13 | Traduire le paquet en anglais   | brouillon | manuel | OFFICIAL (9) |
| YEP 2.14 | Remplir correctement un fichier de conf   | brouillon | manuel | OFFICIAL (9) |
| YEP 2.15 | Suivre les instructions d'installation de l'application   | validé | manuel | OFFICIAL (1) |
| YEP 2.16 | Vérifier la disponibilité des dépendances sur ARM, x86 et x64   | validé | manuel | OFFICIAL (8) |
| YEP 2.17 | Prendre en compte la version d'origine lors des mises à jour   | validé | manuel | OFFICIAL (9) |
| | | | | |
| **YEP 2.18** | **Stabiliser une webapp** | **Statut** | **Test** | **Niveau** |
| YEP 2.18.1 | Lancer le script d'installation d'une webapp correctement   | validé | manuel | WORKING (5) |
| YEP 2.18.2 | Gérer l'installation à la racine d’un nom de domaine   | validé | auto | WORKING (2) |
| YEP 2.18.3 | Gérer l'installation sur un sous-domaine   | validé | auto | WORKING (2) |
| YEP 2.18.4 | Gérer l'installation sur un chemin `/path`   | validé | auto | OFFICIAL (2) |
| YEP 2.18.5 | Gérer la tuile YunoHost pour faciliter la navigation entre les applications   | validé | manuel | OFFICIAL (8) |
| | | | | |
| **YEP 3** | **Sécuriser une app** | **Statut** | **Test** | **Niveau** |
| YEP 3.1 | Ne pas demander ou stocker de mot de passe LDAP   | brouillon | manuel | NOTWORKING (?) |
| YEP 3.2 | Ouvrir un port correctement   | brouillon | manuel | WORKING (7) |
| YEP 3.3 | Faciliter le contrôle de l'intégrité des sources   | brouillon | manuel | OFFICIAL (6) |
| YEP 3.4 | Isoler l'app   | brouillon | manuel | OFFICIAL (8) |
| YEP 3.5 | Suivre les recommendations de la documentation de l'app   | validé | manuel | OFFICIAL (6) |
| YEP 3.6 | Mettre à jour les versions contenant des CVE   | draft | manuel | OFFICIAL (6) |
| YEP 3.7 | Modifier correctement les dépots sources | draft | manuel | NOTWORKING (0) |
| | | | | |
| **YEP 4** | **Intégrer une app** | **Statut** | **Test** | **Niveau** |
| 4.1 | Lier au ldap   | validé | manuel | OFFICIAL (4) |
| YEP 4.2 | Lier l'authentification au sso   | validé | manuel | OFFICIAL (4) |
| YEP 4.2.1 | Déconnexion   | validé | manuel | OFFICIAL (9) |
| YEP 4.3 | Fournir un script de sauvegarde YunoHost fonctionnel   | validé | auto | OFFICIAL (6) |
| YEP 4.4 | Fournir un script de restauration YunoHost fonctionnel   | validé | auto | OFFICIAL (6) |
| YEP 4.5 | Utiliser les hooks   | validé | manuel | OPTIONAL (8) |
| YEP 4.6 | Gère le multi-instance   | validé | manuel | OPTIONAL (2) |
| YEP 4.7 | Ajouter un module à la CLI   | validé | manuel | OPTIONAL |
| YEP 4.8 | Ajouter un module à l'admin web   | brouillon | manuel | OPTIONAL |


### YEP 1
#### Communiquer avec la communauté
La YEP 1 est une meta YEP, elle explique ce qu'il faut faire pour échanger avec la communauté autour d'un paquet d'application YunoHost.

#### YEP 1.1
##### Nommer son app et son dépôt  | validé | manuel | NOTWORKING |
Chaque application YunoHost possède un id inscrit dans le manifeste de l'application.
Cet identifiant doit être unique entre chaque paquet d'application.
Il est donc recommandé de vérifier sa disponibilité en consultant la liste des applications référencées dans les dépôts d'applications connus (official, community, internetcube).

De plus l'identifiant doit respecter l'expression régulière suivante `^[a-z1-9]((_|-)?[a-z1-9])+$`. Autrement dit, il doit respecter les règles suivantes :
* être en minuscule
* commencer par une lettre ou un chiffre
* être alphanumérique (le underscore est autorisé)
* ne pas contenir deux underscores ou tirets qui se suivent
* ne pas terminer par un underscore ou un tiret

Pour les noms d'applications contenant des espaces la quasi-totalité des paquets actuels les retirent simplement sans les remplacer par des tirets ou underscores.

Par convention, les dépôts d'applications YunoHost sont toujours nommés de leur ID suivis de la chaîne de caractère "\_ynh". Ainsi on peut distinguer le dépôt upstream de l'application, du dépôt du paquet yunohost. Cette notation permet également de trouver des applications non répertoriées à travers les moteurs de recherche des plateformes proposant des gestionnaires de version (GitHub par exemple).

Exemple : ID : exemple Nom de dépôt : exemple_ynh

#### YEP 1.2
##### Inscrire l'app sur un « répertoire » connu  | validé | manuel | NOTWORKING |
Il est conseillé dès le début du packaging d'inscrire une app sur un des dépôts d'application YunoHost.

Ces dépôts ont plusieurs fonctions :
* communiquer l'existence d'un paquet ;
* indiquer la dernière version associée au paquet (afin de permettre la mise à jour de l'app par YunoHost) ;
* indiquer l'état de fonctionnement du paquet ;
* indiquer des informations sur le support d'un paquet.

Pour les listes `official.json` et `community.json` maintenues par l'équipe du projet Yunohost, l'inscription se fait sur [le dépôt git "apps"](https://github.com/YunoHost/apps). D'autres listes non-officielles (notamment celles incluant des applications non-libres) peuvent exister, se réferer au [Forum](https://forum.yunohost.org) de la communauté.

#### YEP 1.3
##### Indiquer la licence associée au paquet  | brouillon | AUTO | WORKING |
La licence du paquet est à indiquer dans un fichier `LICENSE` à la racine du paquet. Attention à ne pas confondre avec la licence de l'application qui va être installée dont l'acronyme est à renseigner dans le champ `license` du manifeste.

Les listes d'applications official.json et community.json n'acceptent que les paquets dont la licence est libre, de même pour la licence de l'application contenue. Certaines applications libres nécessitent des dépendances non-libres (exemple: mp3, drivers, etc.). Dans ce cas, il faut ajouter `&dep-non-free` à l'acronyme et si possible donner des précisions dans le README.md du paquet, l'intégration sera dans ce cas acceptée au cas par cas.

**NB :** Les applications non-présentes dans les listes maintenues par le projet peuvent tout de même être installées : soit manuellement via le lien de l'application, soit de manière plus intégrée via des listes non-officielles (qui peuvent être créées et maintenues par la communauté).

Dans le futur, YunoHost affichera sans doute des détails sur la licence de l'application. Pour y parvenir, l'acronyme doit être celui issu de cette [liste de licences répertoriées du SPDX](https://spdx.org/licenses/) (si il y a 2 acronymes, il faut prendre celui contenant le numéro de version). Pour plus de cohérence, la casse doit être respectée.

Si la licence n'est pas présente dans la liste, dans ce cas il faut indiquer `free` ou `non-free` selon qu'elle est libre ou non et donner l'occasion à l'utilisateur de se renseigner dans le README.md (lien, explications, ...).

Exemple: pour une licence `GNU Lesser General Public License (LGPL), version 3` l'acronyme est `LGPL-3.0` si toutefois des dépendances non libres sont utilisées dans ce cas il faudra mettre `LGPL-3.0&dep-non-free` dans le manifeste.

Si une application a des modules liés avec une autre licence (Exemple: Odoo 9 LGPL-3.0 + un module sous licence AGPL-3.0 ), dans ce cas on indiquera les deux licences séparées par un `&`.

Si deux applications distinctes sont dans le même paquet d'installation et ont des licences distinctes, dans ce cas on peut utiliser le `,` pour séparer les licences.

Dans les deux cas, le mainteneur est encouragé à réfléchir à la possibilité de créer deux paquets distincts. Le manifeste de chaque application permet de poser des questions de type `app` de façon à faire référence à une autre application déjà installée.

Rappel: une question de type `app` prend pour réponse l'identifiant d'une des apps déjà installée.

Quelques liens intéressants pour aider au choix de licence:
* [Des fiches explicatives sur les licences libres](https://www.inria.fr/content/download/5896/48452/version/2/file/INRIA_recueil_fiches_licences_libres_vf.pdf)
* [La documentation sur les licences du projet GNU](https://www.gnu.org/licenses/licenses.fr.html)
* [Un guide du projet GNU pour aider au choix d'une licence](https://www.gnu.org/licenses/license-recommendations.fr.html)

#### YEP 1.4
##### Informer sur l'intention de maintenir un paquet   | brouillon | manuel | OFFICIAL |
Le mainteneur de l'application doit s'engager à maintenir son app sur la durée si il souhaite que celle-ci rejoigne la liste des applications officielles.  
Cela implique de surveiller les mises à jour de l'application upstream, de respecter les nouvelles règles de packaging et de répondre aux demandes des utilisateurs.

#### YEP 1.5
##### Mettre à jour régulièrement le statut de l'app  | brouillon | manuel | WORKING |
#### YEP 1.6
##### Se tenir informé sur l'évolution du packaging d'apps  | validé | manuel | OFFICIAL |
Afin de suivre l'évolution du format de packaging ainsi que des bonnes pratiques, il est recommandé de:
* suivre [la catégorie Apps packaging du forum](https://forum.yunohost.org/c/contribute-room/apps-packaging)

Pour suivre l'évolution de YunoHost de façon plus générale :
* rejoindre le salon XMPP dev@conference.yunohost.org ([trois jours de logs sont disponibles](https://im.yunohost.org/logs/dev/))
* suivre [la catégorie Annoucement du forum](https://forum.yunohost.org/c/announcement)

#### YEP 1.7
##### Ajouter l'app à l'[organisation YunoHost-Apps](https://github.com/YunoHost-Apps)  | validé | manuel | OFFICIAL |
L'ajout d'une app sur l'[organisation YunoHost-Apps](https://github.com/YunoHost-Apps) permet de faire connaitre l'apps auprès des autres contributeurs qui pourraient être tentés de packager l'application visée.

C'est aussi un moyen pour permettre de déployer rapidement un correctif de sécurité si nécessaire dans le cas où le mainteneur ne serait pas disponible.

Procédure de transfert : demander sur le [salon de discussion `Apps`](chat_rooms_fr) à être invité à l’organisation en lui fournissant le nom de son compte GitHub.
Une fois l’invitation acceptée, [transférer son dépôt sur l’organisation en suivant ce tutoriel](https://help.github.com/articles/transferring-a-repository-owned-by-your-personal-account/#transferring-a-repository-to-another-user-account-or-to-an-organization).

#### YEP 1.8
##### Publier des demandes de test  | validé | manuel | OFFICIAL |
Afin d'assurer le bon fonctionnement d'un paquet, il convient de publier une annonce afin d'ouvrir les tests sur le paquet. Cette annonce peut se faire sur le forum dans [la catégorie Apps du forum](https://forum.yunohost.org/c/apps).

Il est recommandé d'indiquer si certains tests n'ont pas été menés.

* Vérifier le package avec Package linter.
* Installation en sous-dossier.
* Installation à la racine d'un domaine ou d'un sous-domaine.
* Suppression, dans les 2 cas d'installations précédent.
* Accès à l'interface web de l'application, avec le / final dans l'adresse, et en l'omettant.
* Upgrade sur la même version du package.
* Upgrade depuis une ancienne version du package.
* Installation privée (sécurisée par le SSO).
* Installation publique.
* Installation multi-instance.
* Erreur de nom d'utilisateur.
* Erreur de nom de domaine.
* Path mal écrit (path/ au lieu de /path par exemple).
* Port déjà utilisé par une autre application.
* Source corrompue après téléchargement.
* Erreur de téléchargement de la source.
* Dossier déjà utilisé par une autre application.
* Backup et restore.

#### YEP 1.9
##### Documenter l'app  | validé | AUTO | OFFICIAL |
Avant tout, il convient de faire une description correcte de l'app dans le champ `description` du manifest. L'insertion de mot clé dans cette description peut être une bonne idée, dans la mesure où un utilisateur pourrait être amené à faire une recherche (CTRL+F) parmi toutes les applications.

Il y a également le README.md, ce dernier doit et peut contenir :
* le nom de l'app
* un bref résumé de ce qu'elle fait
* des éventuels compléments d'installation si le script ne suffit pas lui-même
* des instructions pour l'utiliser (par exemple pour relier son smartphone ou son ordinateur)
* l'endroit pour signaler un dysfonctionnement / une demande
* la roadmap/TODO
* éventuellement les pré-requis en termes de mémoires ram, processeur etc. (certains équipements ont moins de 512Mo de ram)

#### YEP 1.10
##### Garder un historique de version propre   | brouillon | manuel | OFFICIAL |
#### YEP 1.11
##### Ajouter l'app au [bugtracker YunoHost](https://github.com/yunohost/issues/issues)   | brouillon | manuel | OFFICIAL |

#### YEP 1.12
##### Suivre le modèle de [example_ynh](https://github.com/YunoHost/example_ynh) | brouillon | manuel | OFFICIAL |
Afin de faciliter le travail de la communauté concernant un package, il doit suivre le modèle montré par l'application d'exemple.  
Cela aidera les autres packagers à lire, modifier et débugger le paquet. De plus, cela aidera à prolonger la durée de vie du package en lui donnant un modèle standard que les autres packagers seront en mesure de comprendre rapidement au cas où un package deviendrait orphelin.  
De plus, un package ne devrait pas utiliser de code exotique ou inutilement compliqué si ce n'est pas vraiment nécessaire. Le cas échéant, cette partie du code devrait être clairement documentée.  
Gardez votre code aussi simple que possible, gardez tout ce dont un script a besoin directement dedans. Ne déplacez pas les fonctions dans un autre fichier. Restez simple et efficace.

### YEP 2
#### Stabiliser une app
#### YEP 2.1
##### Respecter le format du manifeste  | validé | auto | INPROGRESS |
Le manifeste permet de décrire une app afin que YunoHost puisse lui appliquer les bons traitements. Pour plus d'information voir la [documentation dédiée](https://yunohost.org/#/packaging_apps_manifest).

#### YEP 2.2
##### Utiliser bash pour les scripts principaux  | validé | auto | WORKING |
Les scripts d'action (install, upgrade, remove, backup et restore) doivent être en bash afin que la cli/api yunohost puisse correctement les appeler.

Ceci étant, rien n'empêche à l'intérieur de ces scripts de faire appel à d'autres scripts ou bibliothèques de fonction. Ceux-ci ne sont pas obligés d'être en bash.

Cependant, il faudra porter une attention particulière à l'affichage correct des logs d'information, de warning, ou d'erreurs. Afin qu'un utilisateur de la cli/api yunohost puisse comprendre le fonctionnement du script venant d'être exécuté et au besoin réparer son instance YunoHost.

#### YEP 2.3
##### Sauvegarder les réponses lors de l'installation  | validé | manuel | WORKING |
Lors de l'installation, il est nécessaire de sauvegarder chaque réponse aux questions du manifeste. En effet, même si au début il n'est pas nécessaire d'écrire un script de mise à jour, par la suite ce sera sans doute le cas. Or, sans les informations initiales, la mise à jour peut être plus fastidieuse.

#### YEP 2.4
##### Détecter et gérer les erreurs  | brouillon | manuel | WORKING |
Les scripts install, upgrade, backup et restore doivent détecter les erreurs pour éviter la poursuite des scripts en cas d'erreur bloquante ou d'usage de variable vide.  
L'usage de trap et de set -eu est recommandé pour détecter et traiter les erreurs ([Discussion en cours à ce sujet](https://forum.yunohost.org/t/gestion-des-erreurs-set-e-et-ou-trap/2249/5))  
Il est nécessaire également de vérifier le contenu des variables avant les suppressions du script remove. Par exemple un `rm -Rf /var/www/$app` avec `$app` vide aurait un résultat désastreux.

Au début des scripts, avant toutes modifications, il faut vérifier l'existence des utilisateurs mentionné à l'installation, ainsi que la disponibilité du path demandé, la disponibilité du dossier final de l'application et la taille des mots de passe le cas échéant.

 N'oubliez pas qu'en cas d'erreur d'installation le script de suppression sera lancé automatiquement par la cli yunohost.

#### YEP 2.5
##### Copier correctement des fichiers   | brouillon | manuel | WORKING |
#### YEP 2.6
##### Annuler l'action si les valeurs d'entrées sont incorrectes   | validé | manuel | WORKING |
Chaque script devrait vérifier que les valeurs d'entrées sont correctes.

Voici quelques exemples :
* Vérifier que le nom de domaine existe
* Vérifier que l'utilisateur existe
* Vérifier que le chemin choisi est disponible

Dans le cas où l'une des valeurs est incorrecte, il est alors nécessaire d'annuler toutes modifications réalisées préalablement sur l'instance. Le mieux étant de faire tous ces contrôles avant de modifier le système.


#### YEP 2.7
##### Donner des permissions suffisantes aux instructions bash   | validé | auto | WORKING |
Certaines instructions nécessitent les droits sudo. Il faut dans ce cas ne pas oublier de préfixer ces instructions par `sudo `.

Dans d'autres cas il est nécessaire de donner des droits à l'aide de chmod et de chown.

#### YEP 2.8
##### Modifier correctement une configuration système   | brouillon | manuel | WORKING |
Les modifications du système doivent être réversible pour que la suppression de l'application soit sans conséquences pour le système, ne laisse pas de résidus.  
Pour celà, il faut recourir autant que possible aux dossiers `.d` des configurations système. Où lorsqu'il n'est pas possible de faire autrement, d'indiquer clairement la configuration modifiée par une application et s'assurer que les modifications seront retirées lors de sa suppression.

#### YEP 2.9
##### Enlever toutes traces de l'app lors de la suppression   | brouillon | manuel | WORKING |
À l’exception de dépendances (par exemple : paquets Debian) utilisés par d’autres services ou applications.

#### YEP 2.10
##### Configurer les logs de l'application   | brouillon | manuel | WORKING |
Si possible, l'application doit utiliser un fichier de log, qui sera de préférence dans /var/log.  
Si le log est mis en place par le script install et non par l'application elle-même, un fichier de configuration pour log-rotate devra être ajouté pour gérer les rotations des logs de l'application.

#### YEP 2.11
##### Utiliser une variable plutôt que l'app id directement  | validé | manuel | OFFICIAL |
Il est conseillé de rendre les scripts le plus générique possible, un bon moyen d'y parvenir est d'utiliser une variable pour le nom de l'app afin d'éviter qu'il se retrouve partout dans les scripts. Ainsi, un autre packageur pourra plus facilement se servir du script pour une autre app.

#### YEP 2.12
##### Utiliser les commandes pratiques (helpers)  | validé | auto | OFFICIAL |
Afin de simplifier le packaging, d'uniformiser les pratiques, d'éviter les erreurs et d'augmenter la durée de vie d'un script vis-à-vis des futures versions de YunoHost. Un ensemble de helpers permettant de faire de nombreuses actions est proposé.

Pour plus d'informations :
* consulter [la documentation des helpers](https://yunohost.org/#/packaging_apps_helpers_fr)
* explorer [le répertoire des helpers](https://github.com/YunoHost/yunohost/tree/unstable/data/helpers.d)

#### YEP 2.13
##### Traduire le paquet en anglais   | brouillon | manuel | OFFICIAL |
#### YEP 2.14
##### Remplir correctement un fichier de conf   | brouillon | manuel | OFFICIAL |
*Juste pour éclaircir un peu cette YEP, mais ça reste à l'état de brouillon.*
Le but est de trouver une méthode plus fiable que sed pour modifier les fichiers de configuration. sed pouvant éventuellement avoir des effets de bord en modifiant des parties non désirées du fichier de configuration, en particulier avec l'usage de regex.

#### YEP 2.15
##### Suivre les instructions d'installation de l'application   | validé | manuel | OFFICIAL |

#### YEP 2.16
##### Vérifier la disponibilité des dépendances sur ARM, x86 et x64   | validé | manuel | OFFICIAL |
YunoHost s'installe sur ARM, sur x86 et x64. Un paquet devrait donc être testé sur ces trois architectures processeur.

Certains paquets ne sont pas disponibles sur ARM, il convient dans ce cas d'étudier d'autres solutions ou d'indiquer dans le README.md que l'application ne fonctionne pas sur ARM et de bloquer l’installation par détection du type d’architecture.

#### YEP 2.17
##### Prendre en compte la version d'origine lors des mises à jour   | validé | manuel | OFFICIAL |
Le script de mise à jour doit pouvoir fonctionner même si les mises à jour précédentes n'ont pas été effectuées.

Ainsi, il doit être possible de faire des sauts de mise à jour d'une version N-x vers une version N. Pour ce faire il est conseillé d'enregistrer les numéros de version dans les settings de l'app.

### YEP 2.18
##### Stabiliser une webapp
La majeure partie des applications YunoHost sont des web apps, mais certaines n'en sont pas. Les YEP 2.18.x développent certaines spécificités liées aux web app.

#### YEP 2.18.1
##### Lancer le script d'installation d'une webapp correctement   | validé | manuel | WORKING |
Bien souvent une web app s'installe à partir de formulaires affichés sur une page web. Cette façon de faire, bien que pratique pour un humain, l'est moins pour un programme.

Il convient donc de vérifier si l'application ne propose pas une solution d'installation en ligne de commande.

Si ce n'est pas le cas, il convient d'utiliser l'option -H de curl. En effet, dans certains cas la redirection DNS pourrait ne pas être active au moment de l'installation.
```bash
curl -kL -H "Host: $domain" --data "&param1=Text1&param2=text2" https://localhost$path/install.php > /dev/null 2>&1
```

#### YEP 2.18.2
##### Gérer l'installation à la racine d’un nom de domaine   | validé | auto | WORKING |
Une web app devrait pouvoir s'installer à la racine d’un nom de domaine.

#### YEP 2.18.3
##### Gérer l'installation sur un sous-domaine   | validé | auto | WORKING |
Une web app devraient pouvoir s'installer sur un sous-domaine directement sans sous dossiers.

#### YEP 2.18.4
##### Gérer l'installation sur un chemin `/path`   | validé | auto | OFFICIAL |
Une web app devraient pouvoir s'installer sur un chemin `/path`.

#### YEP 2.18.5
##### Gérer la tuile YunoHost pour naviguer facilement entre les applications   | validé | manuel | OFFICIAL |
Sauf dans de rare cas il est conseillé d'intégrer la tuile YunoHost qui permet de retourner sur le menu du SSO. Cette intégration se fait dans la configuration nginx.

Certains utilisateurs ont remplacé ce carré par un script ajoutant un menu en haut de chaque webapp.

### YEP 3
#### Sécuriser une app
#### YEP 3.1
##### Ne pas demander ou stocker de mot de passe LDAP   | brouillon | manuel | NOTWORKING |
#### YEP 3.2
##### Ouvrir un port correctement   | brouillon | manuel | WORKING |
Si l'application nécessite l'ouverture d'un port, il est nécessaire de vérifier préalablement que ce port n'est pas déjà utilisé par une autre application. Le cas échéant, le script install doit être capable de trouver un autre port disponible.  
Il convient également de vérifier si le port doit être ouvert sur le routeur, au delà du réseau local. Si ce n'est pas le cas, l'argument `--no-upnp` doit être ajouté à la commande `yunohost firewall allow` afin de limiter l'ouverture du port au réseau local uniquement.

#### YEP 3.3
##### Faciliter le contrôle de l'intégrité des sources   | brouillon | manuel | OFFICIAL |
L'application upstream ne doit pas être intégrée en tarball dans le dossier source du package, car cela alourdit le package et le dépôt git et ne permet pas la vérification de l'intégrité de la source.  
La source doit donc être téléchargée depuis le site officiel, puis son intégritée doit être vérifiée avant de l'installer.

#### YEP 3.4
##### Isoler l'app   | brouillon | manuel | OFFICIAL |
Afin d'éviter des effets de bords en cas de compromission éventuelle de l'application, celle-ci doit être isolée pour ne pas risquer d'impacter les autres applications.  
Pour cela, il convient d'isoler l'application dans son dossier d'exécution en restreignant son environnement par un chroot, soit par un mécanisme interne à l'application lorsque c'est possible (par exemple pour un serveur ftp), soit par l'usage de phpfpm.  
De même, pour restreindre la portée de l'utilisateur exécutant l'application, il est préférable d'utiliser un utilisateur dédiée à l'application. Dont les droits sont restreint à l'usage de l'application uniquement.  
Toutefois, cela ne doit pas exempter d'une restriction maximale des droits sur les fichiers de l'application. Autant que possible, les fichiers doivent appartenir à root, et l'utilisateur dédié ne doit avoir de droits d'écriture que sur les fichiers le réclamant expressément.

#### YEP 3.5
##### Suivre les recommandations de la documentation de l'app   | validé | manuel | OFFICIAL |
En général, une application propose une documentation afin d'aider les administrateurs systèmes à réaliser l'installation. Il est conseiller d'en suivre les recommandations, notamment celles concernant les permissions à accorder par fichier ou répertoire.

Le mainteneur de paquet doit toutefois rester vigilant, certaines documentations pouvant être erronées ou insuffisantes.

#### YEP 3.6
##### Mettre à jour les versions contenant des CVE   | draft | manuel | OFFICIAL |
Les [CVE](https://fr.wikipedia.org/wiki/Common_Vulnerabilities_and_Exposures), ou Common Vulnerabilities and Exposures, recensent les failles de sécurités communes aux applications. Les corrections de ces failles peuvent concerner l'application et il est important dans ce cas de suivre au plus près ces mises à jour.  
Plus généralement, l'application peut proposer un correctif pour une faille spécifique à elle-même.  
De manière générale, cette YEP implique de suivre un canal d'information pour suivre les mises à jour de sécurité de l'application et réagir rapidement en mettant à jour le package en conséquence.

Comme précisé dans la YEP 1.7, si un correctif de sécurité doit être déployé en urgence, un autre membre de YunoHost peut être amené à faire un commit sur le package si nécessaire.

#### YEP 3.7
##### Modifier correctement les dépots sources  | draft | manuel | OFFICIAL |
La modification ou l'ajout des dépôts sources dans /etc/apt/sources.list ou /etc/apt/sources.list.d/ ne doit se faire que si c'est absolument nécessaire. Dans un tel cas, merci d'utiliser le pinning, afin de s'assurer que le dépôt n'aura pas une priorité supérieur aux dépôts de debian et YunoHost. 

Dans certains cas, il pourra être préférable de télécharger directement le .deb à partir du dépôt source (avec wget par exemple), ceci est à évaluer en fonction des dépendances, de la nature et du rythme des mises à jour.

L'ajout des backports et des dépôts contrib est autorisée. Le paquet doit demander l'autorisation à l'usager avant de procéder à l'ajout de dépôts nonfree, et si possible, permettre l'installation de l'app sans ce dépôt.

Lorsque l'on désigne la distribution on doit toujours faire référence à son nom (jessie) et non pas au statut de celle-ci (stable). Sans quoi, il y a un risque le jour où debian change de version.

Dans tous les cas, une app ne devrait pas modifier les dépôts sources pour les placer sur testing ou une version non supportée par YunoHost (à l'heure où cette yep est rédigé, YunoHost ne supporte pas la nouvelle stable: debian stretch).

### YEP 4
#### Intégrer une app

Cette meta YEP traite de l'intégration d'une app avec l'environnement YunoHost. Une bonne intégration est en général un gage de qualité et de confort pour les utilisateurs.

#### YEP 4.2
##### Lier l'authentification au sso   | validé | manuel | OFFICIAL |
Le Single Sign On permet d'éviter d'avoir à créer les mêmes utilisateurs pour chaque app. Ainsi, un utilisateur YunoHost pourra se connecter via le Single Sign On à l'ensemble des apps.

Pour se faire, il convient de lier son app au LDAP et/ou d'utiliser des hooks pour dupliquer les identifiants du compte dans la base de données de l'app.

Une fois cette opération appliquée, le mainteneur peut utiliser l'instruction HTTP REMOTE_USER pour vérifier si un utilisateur est connecté ou non. En général, des modules existent (que ce soit au niveau de la technologie, du framework ou même de l'app elle-même).

Au besoin, SSOwat permet de sécuriser l'accès à une ou plusieurs parties de l'app. Il peut ainsi être pertinent de sécuriser l'accès à une page d'administration avec le SSO plutôt qu'un `.htaccess` et de rendre le reste de l'app accessible à tous les visiteurs.

#### YEP 4.2.1
##### Déconnexion   | validé | manuel | OFFICIAL |
Lorsque l'on clique sur une action de déconnexion au sein de l'app, celle-ci devrait déconnecter l'utilisateur du SSO. Sinon, il y a un risque que l'utilisateur laisse par mégarde une session ouverte.

#### YEP 4.3
##### Fournir un script de sauvegarde YunoHost fonctionnel   | validé | auto | OFFICIAL |
L'application doit disposer d'un script backup pour permettre aux utilisateurs de sauvegarder l'application, sa configuration et ses données.

#### YEP 4.4
##### Fournir un script de restauration YunoHost fonctionnel   | validé | auto | OFFICIAL |
L'application doit disposer d'un script restore pour permettre aux utilisateurs de restaurer une application sauvegardée préalablement avec le script backup.

#### YEP 4.5
##### Utiliser les hooks   | validé | manuel | OPTIONAL |
YunoHost offre la possibilité de lancer des actions à chaque traitement effectué par la ligne de commande. Ceci peut être pratique dans de nombreux cas.

Exemples :
* Ajouter/supprimer un utilisateur dans la base de données de l'app lorsque l'on utilise `yunohost user create` ou `yunohost user remove`
* Gérer l’ajout d'un nouveau nom de domaine lors de l'action `yunohost domain add`
* Lancer un script après que le pare-feu ait été rechargé

Liste des hooks :
* post_domain_add
* post_domain_remove
* post_user_create
* post_user_delete
* post_backup_create
* post_backup_restore
* pre_backup_delete
* post_backup_delete
* post_app_addaccess
* post_app_removeaccess
* post_app_clearaccess
* post_app_addaccess
* post_iptable_rules

Ces scripts sont à placer dans un répertoire `hooks` comme dans ce paquet : https://github.com/YunoHost-Apps/owncloud_ynh/tree/master/hooks .


#### YEP 4.6
##### Gèrer le multi-instance   | validé | manuel | OPTIONAL |
Il est parfois pratique de pouvoir installer plusieurs fois une même app. Par exemple, pour plusieurs noms de domaine différents.

Il faut toutefois faire attention à la façon de gérer les chemins de fichier, les dépendances, les ports utilisés etc. de sorte qu'il n'y ait pas de collision.

#### YEP 4.7
##### Ajouter un module à la CLI   | validé | manuel | OPTIONAL |
Il est possible de créer un module afin d'ajouter des commandes à la ligne de commandes yunohost.

Pour ce faire, il faut ajouter un actionmaps dans `/usr/share/moulinette/actionsmap/`. Cet actionmaps doit commencer par `ynh_`.

Les paquets [menu_ynh](https://github.com/YunoHost-Apps/menu_ynh/) et [subscribe_ynh](https://github.com/YunoHost-Apps/subscribe_ynh/) bien qu’anciens (et non à jour) peuvent servir de base pour mettre en place ce genre de module.
#### YEP 4.8
##### Ajouter un module à l'admin web   | brouillon | manuel | OPTIONAL |
