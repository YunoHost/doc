# Nginx configuration
This tutorial aim to help setup Nginx configuration for application packaging.

#### Nginx configuration
Configuration must be in `conf/nginx.conf`. We must use **FastCGI** or a **proxy_pass** following the application:
* **FastCGI** is used with PHP applications:
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

* **`proxy_pass`** in Python, Node.js, Go and Java applications:
```bash
location YNH_EXAMPLE_PATH/ {
       rewrite                ^YNH_EXAMPLE_PATH$ YNH_EXAMPLE_PATH/ permanent;
       proxy_pass             http://YNH_EXEMPLE_DOMAIN:YNH_EXAMPLE_PORT/;
       proxy_set_header       Host $host;
       proxy_buffering off;
}
```

#### Install script
We must modify `conf/nginx.conf` file with application arguments. For this, we use generic terms `YNH_EXAMPLE_PATH` that we modify by desired values with `sed` command:
```bash
sed -i "s@YNH_EXAMPLE_PATH@$path@g" ../conf/nginx.conf
sed -i "s@YNH_EXAMPLE_PORT@$port@g" ../conf/nginx.conf
sed -i "s@YNH_EXEMPLE_DOMAIN@$domain@g" ../conf/nginx.conf
```
We must move that configuration file in Nginx configuration, then reload Nginx configuration:
```bash
cp ../conf/nginx.conf /etc/nginx/conf.d/$domain.d/$app.conf
sudo service nginx reload
```
If Nginx won't restart, it's possible that this configuration file isn't right.

#### Remove script
We must remove Nginx configuration of this application, then reload Nginx configuration:
```bash
rm -f /etc/nginx/conf.d/$domain.d/$app.conf
sudo service nginx reload
```