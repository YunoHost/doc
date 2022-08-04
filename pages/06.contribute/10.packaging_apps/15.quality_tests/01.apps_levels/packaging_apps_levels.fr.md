---
title: Niveaux de qualité des packages d'applications YunoHost
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_levels'
---

Afin de faciliter le packaging d'applications par des étapes successives à atteindre, chaque package est affublé d'un niveau de qualité, de 0 à 9.  
Un package doit satisfaire un certain nombre de critères pour atteindre chaque niveau. De plus pour atteindre un niveau, le package doit avoir préalablement atteint le niveau précédent.

Ce classement des applications par niveaux présente 3 avantages :
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

! L'utilisation du niveau 9 est peu à peu arrêtée.