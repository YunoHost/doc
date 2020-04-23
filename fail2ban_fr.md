# Fail2Ban

Fail2Ban est un logiciel de prévention des intrusions qui protège les serveurs informatiques contre les attaques de brute-force. Il surveille certains journaux et bannira les adresses IP qui montrent un comportement de brute-forcing.

En particulier, Fail2Ban surveille les tentatives de connexion SSH. Après 5 tentatives de connexion échouées sur SSH, Fail2Ban banniera l’adresse IP pendant 10 minutes. Si cette adresse récidive plusieurs fois, elle peut être bannie pendant une semaine.

## Débannir une adresse IP

Pour débloquer une adresse IP de Fail2Ban, vous devez d’abord accéder à votre serveur par un moyen quelconque (par exemple à partir d’une autre adresse IP que celle bannie).

Ensuite, regardez le journal de Fail2Ban pour identifier dans quelle 'prison' (jail) l’adresse IP a été bannie : 

```bash
$ tail /var/log/fail2ban.log
2019-01-07 16:24:47 fail2ban.filter  [1837]: INFO    [sshd] Found 11.22.33.44
2019-01-07 16:24:49 fail2ban.filter  [1837]: INFO    [sshd] Found 11.22.33.44
2019-01-07 16:24:51 fail2ban.filter  [1837]: INFO    [sshd] Found 11.22.33.44
2019-01-07 16:24:54 fail2ban.filter  [1837]: INFO    [sshd] Found 11.22.33.44
2019-01-07 16:24:57 fail2ban.filter  [1837]: INFO    [sshd] Found 11.22.33.44
2019-01-07 16:24:57 fail2ban.actions [1837]: NOTICE  [sshd] Ban 11.22.33.44
2019-01-07 16:24:57 fail2ban.filter  [1837]: NOTICE  [recidive] Ban 11.22.33.44
```

Ici, l’adresse IP `11.22.33.44` a été bannie dans les jails `sshd` et `recidive`.

Puis débanissez l’adresse IP avec les commandes suivantes :

```bash
$ fail2ban-client set sshd unbanip 11.22.33.44
$ fail2ban-client set recidive unbanip 11.22.33.44
```
