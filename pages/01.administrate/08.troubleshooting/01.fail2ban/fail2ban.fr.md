---
title: Fail2Ban
template: docs
taxonomy:
    category: docs
routes:
  default: '/fail2ban'
---

**Fail2Ban** est un logiciel de prévention des intrusions qui protège les serveurs informatiques contre les attaques de brute-force. Il surveille certains journaux et bannira les adresses IP qui montrent un comportement de brute-forcing.

En particulier, **Fail2Ban** surveille les tentatives de connexion `SSH`. Après 5 tentatives de connexion échouées sur SSH, Fail2Ban banniera l’adresse IP pendant 10 minutes. Si cette adresse récidive plusieurs fois, elle peut être bannie pendant une semaine.

## Débannir une adresse IP

Pour débloquer une addresse IP, vous devez d’abord accéder à votre serveur par un moyen quelconque (par exemple à partir d’une autre adresse IP ou d’une autre connexion internet que celle bannie).

Ensuite, regardez le **journal de Fail2Ban** pour identifier dans quelle `prison` ou `jail` l’adresse IP a été bannie :

```bash
sudo tail /var/log/fail2ban.log
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
sudo fail2ban-client set sshd unbanip 11.22.33.44
sudo fail2ban-client set recidive unbanip 11.22.33.44
```

## Passer une adresse IP en liste blanche / whitelist

Si vous ne voulez plus qu’une adresse IP « légitime » soit bloquée par **YunoHost**, alors il faut la renseigner dans la liste blanche ou whitelist du fichier de configuration de la `prison`.

Lors d’une mise à jour du logiciel **Fail2Ban**, le fichier d’origine `/etc/fail2ban/jail.conf` est écrasé. C’est donc dans un nouveau fichier que nous allons stocker les modifications. Elles seront ainsi conservées dans le temps.

1. Commencez par créer le nouveau fichier de configuration des prisons qui s’appelera `yunohost-whitelist.conf` :

    ```bash
    sudo touch /etc/fail2ban/jail.d/yunohost-whitelist.conf
    ```

2. Éditez ce nouveau fichier avec votre éditeur préféré :

    ```bash
    sudo nano /etc/fail2ban/jail.d/yunohost-whitelist.conf
    ```

3. Coller le contenu suivant dans le fichier et adapter l’adresse IP `XXX.XXX.XXX.XXX` :

    ```bash
    [DEFAULT]

    ignoreip = 127.0.0.1/8 XXX.XXX.XXX.XXX #<= l'adresse IP (on peut en mettre plusieurs, séparées par un espace) que vous voulez passer en liste blanche / whitelist
    ```

4. Sauvegardez le fichier et rechargez la configuration de Fail2Ban :

    ```bash
    sudo fail2ban-client reload
    ```

Félicitations, plus de risques de se bannir de son propre serveur YunoHost !
