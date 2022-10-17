---
title: NGINX configuration
template: docs
taxonomy:
    category: docs
routes:
  default: '/packaging_apps_nginx_conf'
---

This tutorial aim to help setup NGINX configuration for application packaging.

#### NGINX configuration

Configuration must be in `conf/nginx.conf`. We must use **FastCGI** or a **proxy_pass** following the application:
* **FastCGI** is used with PHP applications:

```nginx
#sub_path_only rewrite ^__PATH__$ __PATH__/ permanent;
location __PATH__/ {

    # Path to source
    alias __FINALPATH__/;

    index index.php;

    try_files $uri $uri/ index.php;
    location ~ [^/]\.php(/|$) {
        fastcgi_split_path_info ^(.+?\.php)(/.*)$;
        fastcgi_pass unix:/var/run/php/php__PHPVERSION__-fpm-__NAME__.sock;

        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param REMOTE_USER $remote_user;
        fastcgi_param PATH_INFO $fastcgi_path_info;
        fastcgi_param SCRIPT_FILENAME $request_filename;
    }

    # Include SSOWAT user panel.
    include conf.d/yunohost_panel.conf.inc;
}
```

* **`proxy_pass`** in Python, Node.js, Go and Java applications:

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

#### Install script

We must modify `conf/nginx.conf` file with application arguments. For this, we use generic terms `YNH_EXAMPLE_PATH` that we modify by desired values with `sed` command:

```bash
sed -i "s@YNH_EXAMPLE_PATH@$path@g" ../conf/nginx.conf
sed -i "s@YNH_EXAMPLE_PORT@$port@g" ../conf/nginx.conf
sed -i "s@YNH_EXEMPLE_DOMAIN@$domain@g" ../conf/nginx.conf
```
We must move that configuration file in NGINX configuration, then reload NGINX configuration:

```bash
cp ../conf/nginx.conf /etc/nginx/conf.d/$domain.d/$app.conf
sudo service nginx reload
```

If NGINX won't restart, it's possible that this configuration file isn't right.

#### Remove script

We must remove NGINX configuration of this application, then reload NGINX configuration:

```bash
rm -f /etc/nginx/conf.d/$domain.d/$app.conf
sudo service nginx reload
```
