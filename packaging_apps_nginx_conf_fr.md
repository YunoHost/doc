# Configuration Nginx

Ce tutoriel a pour but d’aider à la mise en place d’une configuration Nginx pour le packaging d’application.
#### conf/nginx.conf
* **`proxy_pass`** dans le cas d’applications Python et Node.js :
```bash
location YNH_EXAMPLE_PATH/ {
       rewrite                ^YNH_EXAMPLE_PATH$ YNH_EXAMPLE_PATH/ permanent;
       proxy_pass             http://YNH_EXEMPLE_DOMAIN:YNH_EXAMPLE_PORT/;
       proxy_set_header       Host $host;
       proxy_buffering off;
}
```

#### scripts/install
Il s’agit de modifier le fichier `conf/nginx.conf` avec les paramètres de l’application. Pour cela, on utilise des termes génériques `YNH_EXAMPLE_PATH` que l’on modifie par leur valeur avec la commande `sed` :
```bash
sed -i "s@YNH_EXAMPLE_PATH@$path@g" ../conf/nginx.conf
sed -i "s@YNH_EXAMPLE_PORT@$port@g" ../conf/nginx.conf
sed -i "s@YNH_EXEMPLE_DOMAIN@$domain@g" ../conf/nginx.conf
```
Il faut ensuite déplacer ce fichier de configuration dans la configuration de Nginx, puis redémarrer Nginx :
```bash
cp ../conf/nginx.conf /etc/nginx/conf.d/$domain.d/$app.conf
sudo service nginx reload
```
Si Nginx ne redémarre pas, il se peut que le fichier de configuration ne soit pas correct.

#### scripts/remove
```bash
# Suppression de la configuration Nginx pour cette application
rm -f /etc/nginx/conf.d/$domain.d/$app.conf
sudo service nginx reload # Recharge de la configuration de Nginx
```