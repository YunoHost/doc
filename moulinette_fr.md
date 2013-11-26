# Moulinette

La moulinette est l'interface en ligne de commande (CLI) de YunoHost. Elle permet de gérer entièrement YunoHost: utilisateurs, domaines, apps, pare-feu, sauvegardes et monitoring.

### Utilisation

La moulinette fonctionne avec 2 niveau de sous-commandes, par exemple:
```bash
yunohost user create
```

Vous pouvez y adjoindre des arguments pour certaines commandes:
```bash
yunohost app install roundcube --label Webmail
```

Pour obtenir de l'aide à tout moment sur l'utilisation d'une commande ou d'une sous-commande, vous pouvez ajouter ```-h``` ou ```--help``` à la commande. Essayez par exemple:
```bash
yunohost --help
yunohost user --help
yunohost user create --help
```

--- 

Ça y est, vous savez utiliser la moulinette ! N'hésitez pas à parcourir ses fonctions.
```bash
root@yunohost:~# yunohost --help
usage: yunohost [-h] [-v]
                {domain,monitor,firewall,backup,app,hook,dyndns,user,tools}
                ...

positional arguments:
  {domain,monitor,firewall,backup,app,hook,dyndns,user,tools}
    domain              Manage domains
    monitor             Monitoring functions
    firewall            Manage firewall rules
    backup              Manage backups
    app                 Manage apps
    hook                Manage hooks
    dyndns              Subscribe and Update DynDNS Hosts
    user                Manage users
    tools               Specific tools

optional arguments:
  -h, --help            show this help message and exit
  -v, --version         Display YunoHost version
```
