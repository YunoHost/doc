# Guide de rédaction de la documentation des applications

## Pages de documentations utilisateurs.trices / administrateurs⋅trices

Ajouter un bouton installer en un clique (comme par exemple : https://yunohost.org/#/app_piwigo_fr)

Classement des applications disponibles par tags (genre, Git, gestion associations, courriels, etc.).

*/Définition d'une license de diffusion de la documentation, mais laquelle ? Permissive ou non (CC BY-SA)/*

## Quelques usages types et d'ordres général (trame de rédaction)

 + Lorsqu'un lien renvoi vers une page qui n'est pas dans la langue de la page d'origine, il est d'usage d'ajouter `(en)`(Pour un lien qui pointe vers une page en anglais).
 + renommer les images dans l'ordre suivant :`nomapplication_descriptif.ext`

### Trame général documentation applications

 1. Logo (dimension 80 pixels de hauteurs) + titre de niveau 1.
 1. Bouton installer en un clique, Niveau d'intégration, et le status.
 1. Un index en tête de documentations avec renvois vers l'ensemble des chapitres de la documentation.
 1. Une présentation général de l'application et de sa fonction.
 1. Une partie administration de l'application.
 1. Une partie aller plus loin, Manipulations techniques liés spécifiquement à YunoHost.
 1. Une partie sur les client desktop (si il en existe). Lien vers différentes applications tierces si il en existe plusieurs (lien possible avec le catalgue d'applications [framalibre.org](https://framalibre.org))  ou un lien vers la page concernant les applications desktop si des applications officiels sont fournis.
 1. Documentation de l'utilisation si besoin (cf. Documenter une application).
 1. Une partie avec :
    - les liens vers le site officiel
    - Les liens vers le package de YunoHost

## Feuille de route

1. Documenter les applications.
   1. Documenter les applications au travail (marqué : work) niveau 8/7/6.
   1. Traduire la page de documentation à minima en français et en anglais.
   1. Faire une PR sur le dépôt de l'application concerné vers la page de documentation.

## Documenter une application

Faut-il documenter son utilisation ?

```
La documentation de l'application est elle disponible en français & en anglais ?
                                                      /     \
                                                     /       \
                                                    /         \
                                                   /           \
                                                  /             \
                                             -------            -------
                                             | Oui |            | Non |----> Documenter l'application  <----<----<----<-----
                                             -------            -------   dans la documentation de YunoHost                |
                                               |                                                                           |
                                          La documentation utilisateur est elle de bonne qualité et suffisante ?           |
                                              /  \                                                                         |
                                             /    \                                                                        |
                                            /      \                                                                       |
                                           /        \                                                                      |
                                          /          \                                                                     |
                                      -------      -------                                                                 |
   Renvoi dans la page de doc ------- | Oui |      | Non |---->---->---->---->---->---->---->---->---->---->---->---->---->-
YunoHost vers le site officiel        -------      -------
```

## Potentielles problématiques rencontrés ?

Quid des applications qui sont des containers à d'autres applications, tel que Nextcloud et qui présentes de multiples possibilités d'usages.
