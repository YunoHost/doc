# Utiliser Yunohost comme un service caché Tor

Voir https://www.torproject.org/docs/tor-hidden-service.html.en (anglais)

## Installer Tor

```bash
apt-get install tor 
```

## Configurer notre service caché

Editer le fichier /ect/tor/torrc, et ajouter ces lignes :

```bash
HiddenServiceDir  /var/lib/tor/hidden_service/
HiddenServicePort 80 127.0.0.1:80
HiddenServicePort 443 127.0.0.1:443
```

## Redemarrer Tor

```bash
service tor restart
```


## Obtenir l'adresse du service caché

```bash
cat /path/to/hidden_service/keys/hostname
```

Le domaine ressemble à *random123456789.onion*

## Ajouter le domaine .onion à Yunohost

```bash
yunohost domain add random123456789.onion
```

