# Packaging d’applications : les bonnes pratiques

<div class="alert alert-danger">
<b>
Cette page est en cours d'élaboration. Tant que cet avertissement n'est pas enlevé. Considérez ces informations comme potentiellement fausse.
Le nom YEP n'est à priori pas définitif, ni les niveaux, ni les bonnes pratiques en elle même.
</b>
</div>

### Introduction
Ce document a pour but de lister les différentes bonnes pratiques concernant la création de paquet d'application YunoHost.

Chaque bonne pratique est numérotée avec un numéro suffixé par les lettres YEP (YunoHost Enhancement Proposals), ceci afin de pouvoir y faire référence facilement dans les outils d'analyse automatique de paquet ([package checker](https://github.com/YunoHost/package_check), [package linter](https://github.com/YunoHost/package_linter)), mais également lors des revues de code.

Chaque YEP est associée à :
* un status indiquant si la régle a été validé ou si elle fait encore l'objet de discussion (brouillon, validé, refusé, obsolète) ;
* une indication sur le type de test à mener (manuel ou auto si un outil automatique peut vérifier) ;
* une indication du niveau d'app à partir duquel la règle est nécessaire (NOTWORKING, INPROGRESS, WORKING, OFFICIAL), certaines règles sont optionnelles ;

### Index des YEP
| ID |  Titre | Status | Test | Niveau |
|----|--------|--------|------|--------|
| **YEP 1** | **Communiquer avec la communauté** | | | |
| YEP 1.1 | Nommer son app et son dépot  | validé | manuel | NOTWORKING |
| YEP 1.2 | Inscrire l'app sur un "répertoire" connu  | validé | manuel | NOTWORKING |
| YEP 1.3 | Indiquer la licence associée au paquet  | validé | AUTO | WORKING |
| YEP 1.4 | Informer sur l'intention de maintenir un paquet   | brouillon | manuel | WORKING |
| YEP 1.5 | Mettre à jour régulièrement le statut de l'app  | brouillon | manuel | WORKING |
| YEP 1.6 | Se tenir informé sur l'évolution du packaging d'apps  | validé | manuel | OFFICIAL |
| YEP 1.7 | Ajouter l'app à l'[organisation YunoHost-Apps](https://github.com/YunoHost-Apps)  | validé | manuel | OFFICIAL |
| YEP 1.8 | Publier des demandes de test  | validé | manuel | OFFICIAL |
| YEP 1.9 | Documenter l'app  | validé | AUTO | OFFICIAL |
| YEP 1.10 | Garder un historique de version propre   | brouillon | manuel | OFFICIAL |
| YEP 1.11 | Ajouter l'app au [bugtracker YunoHost](https://dev.yunohost.org)   | brouillon | manuel | OFFICIAL |
| | | | | |
| **YEP 2** | **Stabiliser une app** | | | |
| YEP 2.1 | Respecter le format du manifeste  | validé | auto | INPROGRESS |
| YEP 2.2 | Utiliser bash pour les scripts principaux  | validé | auto | WORKING |
| YEP 2.3 | Sauvegarder les réponses lors de l'installation  | validé | manuel | WORKING |
| YEP 2.4 | Détecter et gérer les erreurs  | brouillon | manuel | WORKING |
| YEP 2.5 | Copier correctement des fichiers   | brouillon | manuel | WORKING |
| YEP 2.6 | Annuler l'action si les valeurs d'entrées sont incorrectes   | validé | manuel | WORKING |
| YEP 2.7 | Donner des permissions suffisantes aux instructions bash   | validé | auto | WORKING |
| YEP 2.8 | Modifier correctement une configuration système   | brouillon | manuel | WORKING |
| YEP 2.9 | Enlever toutes traces de l'app lors de la suppression   | brouillon | manuel | WORKING |
| YEP 2.10 | Configurer les logs de l'application   | brouillon | manuel | WORKING |
| YEP 2.11 | Utiliser une variable plutôt que l'app id directement  | validé | manuel | OFFICIAL |
| YEP 2.12 | Utiliser les commandes pratiques (helpers)  | validé | auto | OFFICIAL |
| YEP 2.13 | Traduire le package en anglais   | brouillon | manuel | OFFICIAL |
| YEP 2.14 | Remplir correctement un fichier de conf   | brouillon | manuel | OFFICIAL |
| YEP 2.15 | Vérifier les paramètres saisies par l'utilisateur   | validé | manuel | OFFICIAL |
| YEP 2.16 | Vérifier la disponibilité des dépendances sur ARM, x86 et x64   | validé | manuel | OFFICIAL |
| YEP 2.17 | Prendre en compte la version d'origine lors des mises à jour   | validé | manuel | OFFICIAL |
| | | | | |
| **YEP 2.18** | **Stabiliser une webapp** | | | |
| YEP 2.18.1 | Lancer le script d'installation d'une webapp correctement   | validé | manuel | WORKING |
| YEP 2.18.2 | Supporter l'installation sur un domaine   | validé | auto | WORKING |
| YEP 2.18.3 | Supporter l'installation sur un sous-domaine   | validé | auto | WORKING |
| YEP 2.18.4 | Supporter l'installation sur un sous-dossier   | validé | auto | OFFICIAL |
| YEP 2.18.5 | Ajouter la tuile YunoHost pour naviguer facilement entre les applications   | validé | manuel | OFFICIAL |
| | | | | |
| **YEP 3** | **Sécuriser une app** | | | |
| YEP 3.1 | Ne pas demander ou stocker de mot de passe LDAP   | brouillon | manuel | NOTWORKING |
| YEP 3.2 | Ouvrir un port correctement   | brouillon | manuel | WORKING |
| YEP 3.3 | Faciliter le contrôle de l'intégrité des sources   | brouillon | manuel | OFFICIAL |
| YEP 3.4 | Isoler l'app   | brouillon | manuel | OFFICIAL |
| YEP 3.5 | Suivre les recommendations de la documentation de l'app   | validé | manuel | OFFICIAL |
| YEP 3.6 | Mettre à jour les versions contenant des CVE   | draft | manuel | OFFICIAL |
| | | | | |
| **YEP 4** | **Intégrer une app** | | | |
| 4.1 | Lier au ldap   | validé | manuel | OFFICIAL |
| YEP 4.2 | Lier l'authentification au sso   | validé | manuel | OFFICIAL |
| YEP 4.2.1 | Déconnexion   | validé | manuel | OFFICIAL |
| YEP 4.3 | Fournir un script de sauvegarde YunoHost fonctionnel   | validé | auto | OFFICIAL |
| YEP 4.4 | Fournir un script de restauration YunoHost fonctionnel   | validé | auto | OFFICIAL |
| YEP 4.5 | Utiliser les hooks   | validé | manuel | OPTIONAL |
| YEP 4.6 | Gère le multi-instance   | validé | manuel | OPTIONAL |
| YEP 4.7 | Ajouter un module à la CLI   | validé | manuel | OPTIONAL |
| YEP 4.8 | Ajouter un module à l'admin web   | brouillon | manuel | OPTIONAL |


### YEP 1 - Communiquer avec la communauté
La YEP 1 est une meta YEP, elle explique ce qu'il faut faire pour échanger avec la communauté autour d'un paquet d'application YunoHost.

#### YEP 1.1 - Nommer son app et son dépot  | validé | manuel | NOTWORKING |
Chaque application YunoHost possède un id inscrit dans le manifest de l'application.
Cet identifiant doit être unique entre chaque paquet d'application.
Il est donc recommandé de vérifier sa disponibilité en consultant la liste des applications référencées dans les dépôts d'applications connus (official, community, internetcube).

De plus l'identifiant doit respecter l'expression régulière suivante `^[a-z1-9]((_|-)?[a-z1-9])+$` . Autrement dit, il doit respecter les règles suivantes :
* être en minuscule
* commencer par une lettre ou un chiffre
* être alphanumerique (le underscore est autorisé)
* ne pas contenir 2 underscores ou tirets qui se suivent
* ne pas terminer par un underscore ou un tiret

Pour les noms d'applications contenant des espaces la quasitotalité des paquets actuels les retirent simplement sans les remplacer par des tirets ou underscores.

Par convention, les dépôts d'applications YunoHost sont toujours nommés de leur ID suivis de la chaine de caractère "\_ynh". Ainsi on peut distinguer le dépôt upstream de l'application, du dépôt du package yunohost. Cette notation permet également de trouver des applications non répertoriés à travers les moteurs de recherche des plateformes proposant des gestionnaire de version (github par exemple).

Exemple : ID : exemple Nom de dépôt : exemple_ynh

#### YEP 1.2 - Inscrire l'app sur un "répertoire" connu  | validé | manuel | NOTWORKING |
Il est conseillé dés le début du packaging d'inscrire une app sur un des dépôts d'application YunoHost.

Ces dépôts ont plusieurs fonctions :
* communiquer l'existence d'un paquet ;
* indiquer la dernière version associée au paquet (afin de permetre à la mise à jour de l'app par YunoHost) ;
* indiquer l'état de fonctionnement du paquet ;
* indiquer des informations sur le support d'un paquet.

<div class="alert alert-danger">
<b>
TODO Lien ou information pour réaliser l'inscription.
</b>
</div>

#### YEP 1.3 - Indiquer la licence associée au paquet  | validé | AUTO | WORKING |
#### YEP 1.4 - Informer sur l'intention de maintenir un paquet   | brouillon | manuel | WORKING |
#### YEP 1.5 - Mettre à jour régulièrement le statut de l'app  | brouillon | manuel | WORKING |
#### YEP 1.6 - Se tenir informé sur l'évolution du packaging d'apps  | validé | manuel | OFFICIAL |
#### YEP 1.7 - Ajouter l'app à l'[organisation YunoHost-Apps](https://github.com/YunoHost-Apps)  | validé | manuel | OFFICIAL |
#### YEP 1.8 - Publier des demandes de test  | validé | manuel | OFFICIAL |
#### YEP 1.9 - Documenter l'app  | validé | AUTO | OFFICIAL |
#### YEP 1.10 - Garder un historique de version propre   | brouillon | manuel | OFFICIAL |
#### YEP 1.11 - Ajouter l'app au [bugtracker YunoHost](https://dev.yunohost.org)   | brouillon | manuel | OFFICIAL |

### YEP 2 - Stabiliser une app
#### YEP 2.1 - Respecter le format du manifeste  | validé | auto | INPROGRESS |
#### YEP 2.2 - Utiliser bash pour les scripts principaux  | validé | auto | WORKING |
Les scripts d'action (install, upgrade, remove, backup et restore) doivent être en bash afin que la cli/api yunohost puisse correctement les appeler.

Ceci étant rien n'empèche à l'intérieur de ces scripts de faire appel à d'autres scripts ou bibliothèques de fonction. Ceux ci ne sont pas obligés d'être en bash.

Cependant, il faudra porter une attention particulière à l'affichage correcte des logs d'information, de warning, ou d'erreurs. Afin qu'un utilisateur de la cli/api yunohost puisse comprendre le fonctionnement du script venant d'être executé et au besoin réparer son instance YunoHost.
 
#### YEP 2.3 - Sauvegarder les réponses lors de l'installation  | validé | manuel | WORKING |
Lors de l'installation, il est nécessaire de sauvegarder chaque réponse aux questions du manifeste. En effet, même si au début il n'est pas nécessaire d'écrire un script de mise à jour, par la suite ce sera sans doute le cas. Or, sans les informations initiales, la mise à jour peut être plus fastidieuse.

#### YEP 2.4 - Détecter et gérer les erreurs  | brouillon | manuel | WORKING |
#### YEP 2.5 - Copier correctement des fichiers   | brouillon | manuel | WORKING |
#### YEP 2.6 - Annuler l'action si les valeurs d'entrées sont incorrectes   | validé | manuel | WORKING |
#### YEP 2.7 - Donner des permissions suffisantes aux instructions bash   | validé | auto | WORKING |
#### YEP 2.8 - Modifier correctement une configuration système   | brouillon | manuel | WORKING |
#### YEP 2.9 - Enlever toutes traces de l'app lors de la suppression   | brouillon | manuel | WORKING |
#### YEP 2.10 - Configurer les logs de l'application   | brouillon | manuel | WORKING |
#### YEP 2.11 - Utiliser une variable plutôt que l'app id directement  | validé | manuel | OFFICIAL |
#### YEP 2.12 - Utiliser les commandes pratiques (helpers)  | validé | auto | OFFICIAL |
#### YEP 2.13 - Traduire le package en anglais   | brouillon | manuel | OFFICIAL |
#### YEP 2.14 - Remplir correctement un fichier de conf   | brouillon | manuel | OFFICIAL |
#### YEP 2.15 - Vérifier les paramètres saisies par l'utilisateur   | validé | manuel | OFFICIAL |
#### YEP 2.16 - Vérifier la disponibilité des dépendances sur ARM, x86 et x64   | validé | manuel | OFFICIAL |
#### YEP 2.17 - Prendre en compte la version d'origine lors des mises à jour   | validé | manuel | OFFICIAL |

### YEP 2.18 - Stabiliser une webapp
#### YEP 2.18.1 - Lancer le script d'installation d'une webapp correctement   | validé | manuel | WORKING |
#### YEP 2.18.2 - Supporter l'installation sur un domaine   | validé | auto | WORKING |
#### YEP 2.18.3 - Supporter l'installation sur un sous-domaine   | validé | auto | WORKING |
#### YEP 2.18.4 - Supporter l'installation sur un sous-dossier   | validé | auto | OFFICIAL |
#### YEP 2.18.5 - Ajouter la tuile YunoHost pour naviguer facilement entre les applications   | validé | manuel | OFFICIAL |

### YEP 3 - Sécuriser une app
#### YEP 3.1 - Ne pas demander ou stocker de mot de passe LDAP   | brouillon | manuel | NOTWORKING |
#### YEP 3.2 - Ouvrir un port correctement   | brouillon | manuel | WORKING |
Si l'application nécessite l'ouverture d'un port, il est nécessaire de vérifier préalablement que ce port n'est pas déjà utilisé par une autre application. Le cas échéant, le script install doit être capable de trouver un autre port disponible.  
Il convient également de vérifier si le port doit être ouvert sur le routeur, au delà du réseau local. Si ce n'est pas le cas, l'argument `--no-upnp` doit être ajouté à la commande `yunohost firewall allow` afin de limiter l'ouverture du port au réseau local uniquement.

#### YEP 3.3 - Faciliter le contrôle de l'intégrité des sources   | brouillon | manuel | OFFICIAL |
#### YEP 3.4 - Isoler l'app   | brouillon | manuel | OFFICIAL |
#### YEP 3.5 - Suivre les recommendations de la documentation de l'app   | validé | manuel | OFFICIAL |
#### YEP 3.6 - Mettre à jour les versions contenant des CVE   | draft | manuel | OFFICIAL |

### YEP 4 - Intégrer une app
#### YEP 4.2 - Lier l'authentification au sso   | validé | manuel | OFFICIAL |
#### YEP 4.2.1 - Déconnexion   | validé | manuel | OFFICIAL |
#### YEP 4.3 - Fournir un script de sauvegarde YunoHost fonctionnel   | validé | auto | OFFICIAL |
#### YEP 4.4 - Fournir un script de restauration YunoHost fonctionnel   | validé | auto | OFFICIAL |
#### YEP 4.5 - Utiliser les hooks   | validé | manuel | OPTIONAL |
#### YEP 4.6 - Gère le multi-instance   | validé | manuel | OPTIONAL |
#### YEP 4.7 - Ajouter un module à la CLI   | validé | manuel | OPTIONAL |
#### YEP 4.8 - Ajouter un module à l'admin web   | brouillon | manuel | OPTIONAL |
