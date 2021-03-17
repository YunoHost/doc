---
title: Mises à jour
template: docs
taxonomy:
    category: docs
routes:
  default: '/update'
  aliases:
    - '/upgrade'
---

## Depuis la webadmin

Dans la partie administration, choisir Mettre à jour le système. YunoHost va mettre à jour le catalogue des paquets système et le catalogue des applications, et afficher les mise à jour disponibles.

Cliquez sur les boutons verts pour lancer les mises à jours du système et des applications.

## Depuis la ligne de commande

Voici quelques exemples de ligne de commande correspondantes :

``` bash
# Aller chercher les mises à jour disponibles
yunohost tools update

# Mettre à jour tous les paquets systèmes
yunohost tools upgrade --system

# Mettre à jour toutes les applications
yunohost tools upgrade --apps

# Mettre à jour une application en particulier
yunohost app upgrade wordpress
```
