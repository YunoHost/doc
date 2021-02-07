---
title: Upgrades
template: docs
taxonomy:
    category: docs
routes:
  default: '/update'
  aliases:
    - '/upgrade'
---

## From the webadmin

On the administraton panel, click on Upgrade the system. YunoHost will refresh the system package catalog as well as the application catalog, and display available upgrades.

Click on green upgrade buttons to upgrade the system and applications.

## From the command line

Here are some example of corresponding command lines:

``` bash
# Fetch available updates
yunohost tools update

# Upgrade all system packages
yunohost tools upgrade --system

# Upgrade all apps
yunohost tools upgrade --apps

# Upgrade a specific application
yunohost app upgrade wordpress
```
