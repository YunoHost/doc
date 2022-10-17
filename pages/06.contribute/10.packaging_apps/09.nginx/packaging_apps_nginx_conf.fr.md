---
title: Configuration NGINX
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_nginx_conf'
---

Ce tutoriel a pour but d’aider à la mise en place d’une configuration NGINX pour le packaging d’application.

#### Configuration NGINX

La configuration doit être mise dans `conf/nginx.conf`. Il s’agira d’utiliser **FastCGI** ou un **proxy_pass** suivant l’application :
* **FastCGI** est utilisé dans les applications PHP :

```nginx
#sub_path_only rewrite ^__PATH__$ __PATH__/ permanent;
location __PATH__/ {

        proxy_pass        http://127.0.0.1:__PORT__/;
        proxy_redirect    off;
        proxy_set_header  Host $host;
        proxy_set_header  X-Real-IP $remote_addr;
        proxy_set_header  X-Forwarded-Proto $scheme;
        proxy_set_header  X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header  X-Forwarded-Host $server_name;
  
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
}
```

* **`proxy_pass`** dans le cas d’applications Python, Node.js, Go et Java :

```nginx
#sub_path_only rewrite ^__PATH__$ __PATH__/ permanent;
location __PATH__/ {

        proxy_pass        http://127.0.0.1:__PORT__/;
        proxy_redirect    off;
        proxy_set_header  Host $host;
        proxy_set_header  X-Real-IP $remote_addr;
        proxy_set_header  X-Forwarded-Proto $scheme;
        proxy_set_header  X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header  X-Forwarded-Host $server_name;
  
        proxy_http_version 1.1;
        proxy_set_header Upgrade $http_upgrade;
        proxy_set_header Connection "upgrade";
}
```

#### Script d’installation

Il s’agit de modifier le fichier `conf/nginx.conf` avec les paramètres de l’application. Pour cela, on utilise des termes génériques `YNH_EXAMPLE_PATH` que l’on modifie par des valeurs souhaitées avec la commande `sed` :

```bash
sed -i "s@YNH_EXAMPLE_PATH@$path@g" ../conf/nginx.conf
sed -i "s@YNH_EXAMPLE_PORT@$port@g" ../conf/nginx.conf
sed -i "s@YNH_EXEMPLE_DOMAIN@$domain@g" ../conf/nginx.conf
```

Il faut ensuite déplacer ce fichier de configuration dans la configuration de NGINX, puis recharger la configuration de NGINX :

```bash
cp ../conf/nginx.conf /etc/nginx/conf.d/$domain.d/$app.conf
sudo service nginx reload
```

Si NGINX ne redémarre pas, il se peut que le fichier de configuration ne soit pas correct.

#### Script de suppression

Il s’agit de supprimer la configuration NGINX pour cette application, puis de recharger la configuration de NGINX :

```bash
rm -f /etc/nginx/conf.d/$domain.d/$app.conf
sudo service nginx reload
```
