# Guide de rédaction de la documentation

## Pages de documentations utilisateurs.trices

Ajouter un bouton installer en un clique (cf. https://yunohost.org/#/app_piwigo_fr)

Classement des applications disponibles par tags(genre, git, gestion associations, mails, etc).

**Définition d'une license de diffusion de la documentation, mais laquelle ? Permissive ou non (CC By-Sa)**

## Quelques usages types et d'ordres général (trame de rédaction)

 + Lorsqu'un lien renvoi vers une page qui n'est pas dans la langue de la page d'origine, il est d'usage d'ajouter `(en)`(Pour un lien qui pointe vers une page en anglais).

### Trame général documentation applications

 + Un index en tête de documentations avec renvois vers l'ensemble des chapitres de la documentation.
 + Une présentation général de l'application et de sa fonction.
 + Une partie administration de l'application
 + Une partie avec : 
    - les liens vers le site officiel
    - Les liens vers le package de yunohost
 + Une partie sur les client desktop (si il existe). Lien vers différentes applications tierces si il en existe plusieurs (lien possible avec framalibre.org)  ou un lien vers la page concernant les applications desktop si des apps officiels sont fournis.
 + Bouton installer en un clique 

## Feuille de route

 1. Documenter les applications
    1. Documenter les applications au travail (marqué : work) niveau 8/7/6
    1. Traduire la page de documentation à minima en français et en anglais
    1. Faire une PR sur le dépot de l'app concerné vers la page de documentation

## Documenter une application

Faut il documenter son utilisation ?  

```
La documentation de l'application est elle disponible en français & en anglais ?  
                                                      /     \  
                                                     /       \  
                                                    /         \  
                                                   /           \  
                                                  /             \  
                                             -------            -------  
                                             | Oui |            | Non |----> Il faut donc documenter l'application  <-------    
                                             -------            -------       dans la documentation de YunoHost            |  
                                               |                                                                           |  
                                          La documentation utilisateur est elle de bonne qualité et suffisante ?           |  
                                              /  \                                                                         |  
                                             /    \                                                                        |  
                                            /      \                                                                       |  
                                           /        \                                                                      |  
                                          /          \                                                                     |  
                                      -------      -------                                                                 |  
   Renvoi dans la page de doc ------- | Oui |      | Non |------------------------------------------------------------------  
       YunoHost                       -------      -------  
```
## Potentielles problématiques rencontrés ?

Qui des apps qui sont des containers à d'autres applications, tel que nextcloud ...
