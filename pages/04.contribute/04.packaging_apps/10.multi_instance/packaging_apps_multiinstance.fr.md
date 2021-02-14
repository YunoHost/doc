---
title: Multi-instances
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_multiinstance'
---

Le multi-instance est la capacité d’une application à être installée plusieurs fois.

#### Scripts
Lorsque YunoHost installe l’application, il passe au script dans la variable `$YNH_APP_INSTANCE_NAME`  la valeur `id__n` avec l’identifiant de l’application `id` provenant du manifeste et `n` un nombre incrémentée à chaque nouvelle instance de l’application.

**Par exemple** : dans le script Roundcube, il faut nommer la base de données `roundcube`, le dossier d’installation `roundcube` et la [configuration NGINX](/packaging_apps_nginx_conf) `roundcube`. De cette manière, la seconde installation de Roundcube ne rentrera pas en conflit avec la première, et sera installée dans la base de données `roundcube__2`, dans le répertoire `roundcube__2`, et avec la configuration NGINX `roundcube__2`.


Récupération de l'identifiant de l'app (incluant l'id multi-instance) :
```bash
app=$YNH_APP_INSTANCE_NAME
```

#### Manifeste
Passer la variable `multi_instance` à `true` dans le [manifeste](/packaging_apps_manifest) :
```json
 "multi_instance": true,
```
