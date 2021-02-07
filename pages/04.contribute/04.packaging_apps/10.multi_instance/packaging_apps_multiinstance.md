---
title: Multi-instances
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_multiinstance'
---

Multi-instance is application capacity to be installed several times.

#### Scripts
When YunoHost installs the application, it passes `$YNH_APP_INSTANCE_NAME` var to the script, set to value `id__n` with the application `id` coming from the manifest and `n` being an integer incremented each time a new instance of the application is installed.

**E.g.** in the Roundcube script, database is called `roundcube`, the install directory `roundcube` and the [NGINX configuration](/packaging_apps_nginx_conf) `roundcube`. This way, the second instance of Roundcube will not conflict with the first one, and will be installed in the `roundcube__2` database, in the `roundcube__2`directory, and with the `roundcube__2` NGINX configuration.

Retrieve app identifier (including the multi-instance id):
```bash
app=$YNH_APP_INSTANCE_NAME
```

#### Manifest
Set `multi_instance` variable to `true` in the [manifest](/packaging_apps_manifest):
```json
 "multi_instance": true,
```
