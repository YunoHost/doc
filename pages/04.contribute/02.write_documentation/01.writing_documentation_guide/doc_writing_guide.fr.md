---
title: Guide de rédaction de la documentation des applications
template: docs
taxonomy:
    category: docs
routes:
  default: '/doc_writing_guide'
---

## Page de documentation utilisateurs·rices / administrateurs⋅rices

Ajouter un bouton installer en un clic (comme par exemple : https://yunohost.org/app_piwigo) et un bouton sur le niveau d'intégration de l'application.

Classement des applications disponibles par tags (genre, Git, gestion associations, courriels, etc.).

## Quelques usages types et d'ordre général (trame de rédaction)

 + Lorsqu'un lien renvoie vers une page qui n'est pas dans la langue de la page d'origine, il est d'usage d'ajouter `(en)`(Pour un lien qui pointe vers une page en anglais).
 + renommer les images dans l'ordre suivant :`nomapplication_descriptif.ext`

### Trame générale documentation applications

 1. Logo (dimension 80 pixels de hauteur) + titre de niveau 1.
 1. Bouton installer en un clic, Niveau d'intégration pour chaque type de processeur.
 1. Un index en tête de documentation avec renvoi vers l'ensemble des chapitres de la documentation.
 1. Une présentation générale de l'application et de sa fonction.
 2. Une partie configuration de l'application.
 1. Une partie administration de l'application.
 1. Une partie sur les limitations liées à YunoHost.
 1. Une partie sur les clients desktop (s'il en existe). Lien vers différentes applications tierces s'il en existe plusieurs (lien possible avec le catalogue d'applications [framalibre.org](https://framalibre.org)) ou un lien vers la page concernant les applications desktop si des applications officielles sont fournies.
 1. Une partie avec :
    - le lien vers le site officiel
    - le lien vers la documentation officielle
    - les liens vers le package de YunoHost et issues

Trame pour la rédaction des pages de documentations : [ici](/app_writing_guide)

## Feuille de route

1. Documenter les applications.
   1. Documenter les applications au travail (marqué : work) niveau 8/7/6.
   1. Traduire la page de documentation a minima en français et en anglais.
   1. Faire une PR sur le dépôt de l'application concernée vers la page de documentation.
