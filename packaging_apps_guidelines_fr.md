# Packaging d’applications: les bonnes pratiques

### Introduction
Ce document a pour but de lister les différentes bonnes pratiques concernant la création de paquet d'application YunoHost.

Chaque bonne pratique est numérotée avec un numéro suffixé par les lettres YEP (YunoHost Enhancement Proposals), ceci afin de pouvoir y faire référence facilement dans les outils d'analyse automatique de paquet (package checker, package linter), mais également lors des revues de code.

Status: brouillon, validé, refusé, obsolete
Nécéssaire si: YEP nécéssaire pour atteindre le status indiqué

### Index des YEP
| Nécéssaire si | ID |  Titre | Status | Test |
|:-------------:|:-------:|:-------:|:-----:|:-------:|
| | **YEP 1** | **Communiquer avec la communauté** | | |
| NOTWORKING | YEP 1.1 | Nommer son app et son dépot  | VALIDATED |
| NOTWORKING | YEP 1.2 | Inscrire l'app sur un "répertoire" connue  | VALIDATED |
| WORKING | YEP 1.3 | Indiquer la license associée au paquet  | VALIDATED |
| WORKING | YEP 1.4 | Informer sur l'intention de maintenir un paquet   | DRAFT |
| WORKING | YEP 1.5 | Mettre à jour régulièrement le status de l'app  | DRAFT |
| OFFICIAL | YEP 1.6 | Se tenir informé sur l'évolution du packaging d'apps  | VALIDATED |
| OFFICIAL | YEP 1.7 | Ajouter l'app à l'organisation YunoHost-Apps  | VALIDATED |
| OFFICIAL | YEP 1.8 | Publier des demandes de test  | VALIDATED |
| OFFICIAL | YEP 1.9 | Documenter l'app  | VALIDATED |
| OFFICIAL | YEP 1.10 | Garder un historique de version propre   | DRAFT |
| OFFICIAL | YEP 1.11 | Ajouter l'app au bugtracker Ynh   | DRAFT |

| | **YEP 2** | **Stabiliser une app** | | |
| INPROGRESS | YEP 2.1 | Respecter le format du manifest  | VALIDATED |
| WORKING | YEP 2.2 | Utiliser bash pour les scripts principaux  | VALIDATED |
| WORKING | YEP 2.3 | Sauvegarder les réponses lors de l'installation  | VALIDATED |
| WORKING | YEP 2.4 | Détecter et gérer les erreurs   | DRAFT |
| WORKING | YEP 2.5 | Copier correctement des fichiers   | DRAFT |
| WORKING | YEP 2.6 | Annuler l'action si les valeurs d'entrées sont incorrectes   | VALIDATED |
| WORKING | YEP 2.7 | Donner des permissions suffisantes aux instructions bash   | VALIDATED |
| WORKING | YEP 2.8 | Modifier correctement une configuration système   | DRAFT |
| WORKING | YEP 2.9 | Enlever toutes traces de l'app lors de la suppression   | DRAFT |
| WORKING | YEP 2.10 | Configurer les logs de l'application   | DRAFT |
| OFFICIAL | YEP 2.11 | Utiliser une variable plutôt que l'app id directement  | VALIDATED |
| OFFICIAL | YEP 2.12 | Utiliser les helpers  | VALIDATED |
| OFFICIAL | YEP 2.13 | Traduire le package en anglais   | DRAFT |
| OFFICIAL | YEP 2.14 | Remplir correctement un fichier de conf   | DRAFT |
| OFFICIAL | YEP 2.15 | Vérifier les paramétres saisies par l'utilisateurs   | VALIDATED |
| OFFICIAL | YEP 2.16 | Vérifier la disponibilité des dépendances sur ARM, x86 et x64   | VALIDATED |
| OFFICIAL | YEP 2.17 | Prendre en compte la version d'origine lors des mises à jour   | VALIDATED |


| | **YEP 2.18** | **Stabiliser une webapp** | | |
| WORKING | YEP 2.18.1 | Lancer le script d'installation d'une webapp correctement   | VALIDATED |
| WORKING | YEP 2.18.2 | Supporter l'installation sur un domaine   | VALIDATED |
| WORKING | YEP 2.18.3 | Supporter l'installation sur un sous-domaine   | VALIDATED |
| OFFICIAL | YEP 2.18.4 | Supporter l'installation sur un sous-dossier   | VALIDATED |
| OFFICIAL | YEP 2.18.5 | Ajouter le carré yunohost pour retourner au SSO   | VALIDATED |

| | **YEP 3** | **Sécuriser une app** | | |
| NOTWORKING | YEP 3.1 | Ne pas demander ou stocker de password ldap   | DRAFT |
| WORKING | YEP 3.2 | Ouvrir un port correctement   | DRAFT |
| OFFICIAL | YEP 3.3 | Faciliter le contrôle de l'intégrité des sources   | DRAFT |
| OFFICIAL | YEP 3.4 | Isoler l'app   | DRAFT |
| OFFICIAL | YEP 3.5 | Suivre les recommendations de la documentation de l'app   | VALIDATED |

| | **YEP 4** | **Intégrer une app** | | |
| OFFICIAL | 4.1 Lier au | ldap   | VALIDATED |
| OFFICIAL | YEP 4.2 | Lier l'authentification au sso   | VALIDATED |
| OFFICIAL | YEP 4.2.1 | Logout   | VALIDATED |
| OFFICIAL | YEP 4.3 | Fournir un script de sauvegarde YunoHost fonctionnel   | VALIDATED |
| OFFICIAL | YEP 4.4 | Fournir un script de restauration YunoHost fonctionnel   | VALIDATED |
| OPTIONAL | YEP 4.5 | Utiliser les hooks   | VALIDATED |
| OPTIONAL | YEP 4.6 | Supporter le multi instance   | VALIDATED |
| OPTIONAL | YEP 4.7 | Ajouter un module à la CLI   | VALIDATED |
| OPTIONAL | YEP 4.8 | Ajouter un module à l'admin web   | DRAFT |
