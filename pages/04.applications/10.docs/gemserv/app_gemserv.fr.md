---
title: Gemserv
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_gemserv'
---

[![Installer Gemserv avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=gemserv) [![Integration level](https://dash.yunohost.org/integration/gemserv.svg)](https://dash.yunohost.org/appci/app/gemserv)

*Gemserv* est un serveur Gemini écrit en Rust.

### Avertissements / informations importantes

Gemserv utilise le port TCP 1965, vous ne pourrez donc l'utiliser pour autre chose.

Pour ajouter une capsule, créer le fichier de configuration `/etc/gemserv/config.d/example.toml` avec le contenu suivant :

```
[[server]]
hostname = "yourdomain.org"
dir = "/opt/yunohost/gemserv"
key = "/etc/yunohost/certs/yourdomain.org/key.pem"
cert = "/etc/yunohost/certs/yourdomain.org/crt.pem"
# index is optional but defaults to index.gemini. The server will serve files
# ending in gemini or gmi.
index = "index.gmi"
# lang is optional
lang = "en"
# cgi is optional bool
cgi = true
# cgipath is optional and only checked if cgi is true. It restricts cgi to only
# this directory.
cgipath = "/path/to/cgi-bin/"
# scgi is optional
scgi = { "/scgi" = "localhost:4000" }
# cgienv is optional
cgienv = { "GIT_PROJECT_ROOT" = "/srv/git" }
# usrdir is optional. it'll look in each user's ~/public_gemini
usrdir = true
# proxy is optional
# path is what comes after the hostname e.g. example.com/path
proxy = { path = "localhost:1966" }
# proxy_all is optional
# It will send all requests to the specified server. It also supports streamming.
proxy_all = "localhost:1967"
# redirect is optional
redirect = { "/redirect" = "/", "/newdomain" = "gemini://example.net" }
```

## Liens utiles

+ Site web : [git.sr.ht/~int80h/gemserv](https://git.sr.ht/~int80h/gemserv)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/gemserv](https://github.com/YunoHost-Apps/gemserv_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/gemserv/issues](https://github.com/YunoHost-Apps/gemserv_ynh/issues)
