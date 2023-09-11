---
title: Publishing your app on the catalog
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_publishing'
---

The official YunoHost's app catalog is maintained [in this repository](https://github.com/YunoHost/apps/), in particular [the `apps.toml` file](https://github.com/YunoHost/apps/blob/master/apps.toml).

For your app to be made available to everybody, you should make a pull request that adds your app inside the `apps.toml` (see the [detailed instructions in the README](https://github.com/YunoHost/apps/#how-to-add-your-app-to-the-application-catalog))

Note that the "real" catalog used by YunoHost servers is https://app.yunohost.org/default/v3/apps.json which is rebuilt every 4 hours.

NB: The `level` key is not to be set manually by maintainers. The `yunohost-bot` will [automatically create a pull request](https://github.com/YunoHost/apps/blob/master/tools/update_app_levels/update_app_levels.py) every Friday evening with results from the official CI, which are then to be manually reviewed and merged by the community.
