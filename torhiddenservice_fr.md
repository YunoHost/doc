## Utiliser YunoHost comme un service caché Tor
<div class="alert alert-warning">
Ce tuto n'est pas complet ! Des données peuvent être récupérée avec cette installation comme le nom de domaine principal de votre yunohost, donc ce n'est pas un "service caché".
</div>
Voir https://www.torproject.org/docs/tor-hidden-service.html.en (anglais)

### Installer Tor
```bash
apt install tor 
```

### Configurer notre service caché
Éditer le fichier `/etc/tor/torrc`, et ajouter ces lignes :

```bash
HiddenServiceDir  /var/lib/tor/hidden_service/
HiddenServicePort 80 127.0.0.1:80
HiddenServicePort 443 127.0.0.1:443
```

### Redémarrer Tor
```bash
systemctl restart tor
```

### Obtenir l’adresse du service caché
```bash
cat /var/lib/tor/hidden_service/hostname
```

Le nom de domaine ressemble à *random123456789.onion*

### Ajouter le domaine .onion à YunoHost
```bash
yunohost domain add random123456789.onion
```

### Éviter la redirection vers le SSO (optionnel)
Si vous voulez éviter d’être redirigé vers le portail à la connexion pour des raisons de traçabilité, vous pouvez désactiver SSOwat pour le domaine, en éditant le fichier `/etc/nginx/conf.d/random123456789.onion.conf` et en commentant la ligne suivante (elle apparaît deux fois dans le fichier) :

```bash
#access_by_lua_file /usr/share/ssowat/access.lua;
```

### Vérifier que l'on a pas fait d'erreurs dans la configuration de Nginx
```bash
nginx -t
```

### Si tout est OK on applique les modifications de la configuration
```bash
systemctl reload nginx
```
