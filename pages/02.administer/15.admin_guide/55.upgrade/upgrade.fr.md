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

## Utilisez les outils Yunohost

À moins de savoir ce que vous faites, vous devriez utiliser les outils Yunohost plutôt que les outils Debian (apt, apt-get ou aptitude).

## Depuis la webadmin

Dans la partie administration, choisir Mettre à jour le système. YunoHost va mettre à jour le catalogue des paquets système et le catalogue des applications, et afficher les mise à jour disponibles.

Cliquez sur les boutons verts pour lancer les mises à jour du système et des applications.

## Depuis la ligne de commande

Voici quelques exemples en ligne de commande correspondants :

```bash
# Aller chercher les mises à jour disponibles
yunohost tools update

# Mettre à jour tous les paquets systèmes
yunohost tools upgrade system

# Mettre à jour toutes les applications
yunohost tools upgrade apps

# Mettre à jour une application en particulier
yunohost app upgrade wordpress
```
