---
title: Diagnostic du bon fonctionnement de YunoHost
template: docs
taxonomy:
    category: docs
routes:
  default: '/diagnostic'
---

Pour vérifier que tous les aspects critiques de votre serveur sont correctement
configurés, il est recommandé d'utiliser le système de diagnostic disponible
dans la webadmin de YunoHost. (Cette fonctionnalité a été ajoutée dans la version
3.8)

Quelques points à retenir:
* Le diagnostique tourne périodiquement
* Un email est envoyé à root, qui est normalement forwardé vers le premier utilisateur créé
* Les problèmes trouvés doivent soient être réglé, soit ignorés (si ils sont
compris ou ne sont pas pertinents) autrement un mail est envoyé deux fois par
jour.
