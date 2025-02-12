---
title: Migrer ou fusionner des serveurs
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/migrate_or_merge_servers'
page-toc:
  active: true
  depth: 3
---

## Migrer un serveur

Si le système d'archive de YunoHost est assez pratique pour migrer un serveur, on peut aussi [migrer de serveur à serveur avec rsync](https://www.man42.net/blog/2017/07/how-to-migrate-a-debian-server/).

## Fusionner 2 serveurs YunoHost

Si vous fusionnez 2 serveurs ensemble, vous devrez recréer les utilisateurs et utilisatrices, ainsi que les domaines et les permissions du premier serveur sur le serveur de destination. Puis vous pourrez restaurer app par app.

!! Il existe tout de même une limite concernant les apps qui ont le même ID. Il ne sera pas possible de les restaurer facilement. Attention également à ne pas supprimer l'app éponyme du serveur de destination :/
