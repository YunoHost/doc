---
title: Migrate or merge servers
template: docs
taxonomy:
    category: docs
routes:
  default: '/backup/migrate_or_merge_servers'
page-toc:
  active: true
  depth: 3
---


## Migrate a server

If YunoHost's archive system is not convenient enough to migrate a server, you can also [migrate from server to server with rsync](https://www.man42.net/blog/2017/07/how-to-migrate-a-debian-server/).

## Merge 2 YunoHost servers
If you merge 2 servers together, you will need to recreate the users, domains and permissions of the first server on the destination server. Then you can restore app by app. 

!! There is a limitation concerning apps that have the same ID. It will not be possible to restore them easily. Also be careful not to delete the eponymous app from the destination server :/
