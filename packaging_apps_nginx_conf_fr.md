# Configuration Nginx
Ce tutoriel a pour but d’aider à la mise en place d’une configuration Nginx pour le packaging d’application.

#### Configuration Nginx
La configuration doit être mise dans `conf/nginx.conf`. Il s’agira d’utiliser **FastCGI** ou un **proxy_pass** suivant l’application :
* **FastCGI** est utilisé dans les applications PHP :
```bash
location YNH_EXAMPLE_PATH {
  alias YNH_WWW_PATH ;
  if ($scheme = http) {
    rewrite ^ https://$server_name$request_uri? permanent;
  }
  index index.php;
  try_files $uri $uri/ index.php;
  location ~ [^/]\.php(/|$) {
    fastcgi_split_path_info ^(.+?\.php)(/.*)$;
    fastcgi_pass unix:/var/run/php5-fpm.sock;
    fastcgi_index index.php;
    include fastcgi_params;
    fastcgi_param REMOTE_USER     $remote_user;
    fastcgi_param PATH_INFO       $fastcgi_path_info;
    fastcgi_param SCRIPT_FILENAME $request_filename;
  }

  # Include SSOWAT user panel.
  include conf.d/yunohost_panel.conf.inc;
}
```

* **`proxy_pass`** dans le cas d’applications Python, Node.js, Go et Java :
```bash
location YNH_EXAMPLE_PATH/ {
       rewrite                ^YNH_EXAMPLE_PATH$ YNH_EXAMPLE_PATH/ permanent;
       proxy_pass             http://YNH_EXEMPLE_DOMAIN:YNH_EXAMPLE_PORT/;
       proxy_set_header       Host $host;
       proxy_buffering off;
}
```

#### Script d’installation
Il s’agit de modifier le fichier `conf/nginx.conf` avec les paramètres de l’application. Pour cela, on utilise des termes génériques `YNH_EXAMPLE_PATH` que l’on modifie par des valeurs souhaitées avec la commande `sed` :
```bash
sed -i "s@YNH_EXAMPLE_PATH@$path@g" ../conf/nginx.conf
sed -i "s@YNH_EXAMPLE_PORT@$port@g" ../conf/nginx.conf
sed -i "s@YNH_EXEMPLE_DOMAIN@$domain@g" ../conf/nginx.conf
```
Il faut ensuite déplacer ce fichier de configuration dans la configuration de Nginx, puis recharger la configuration de Nginx :
```bash
cp ../conf/nginx.conf /etc/nginx/conf.d/$domain.d/$app.conf
sudo service nginx reload
```
Si Nginx ne redémarre pas, il se peut que le fichier de configuration ne soit pas correct.

#### Script de suppression
Il s’agit de supprimer la configuration Nginx pour cette application, puis de recharger la configuration de Nginx :
```bash
rm -f /etc/nginx/conf.d/$domain.d/$app.conf
sudo service nginx reload
```
