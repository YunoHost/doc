---
title: SSH
template: docs
taxonomy:
    category: docs
---

## Qu’est-ce que SSH ?

**SSH** est un acronyme pour Secure Shell, et désigne un protocole qui permet de contrôler et administrer à distance une machine via la ligne de commande (CLI). C'est aussi une commande disponible de base dans les terminaux de GNU/Linux et macOS. Sous Windows, il vous faudra utiliser le logiciel [MobaXterm](https://mobaxterm.mobatek.net/download-home-edition.html) (après l'avoir lancé, cliquer sur Session puis SSH).

## Quelle adresse utiliser pour se connecter au serveur ?

Si vous hébergez votre serveur **à la maison** (par ex. Raspberry Pi ou OLinuXino ou vieil ordinateur)
   - vous devriez pouvoir vous connecter à la machine en utilisant `yunohost.local`. 
   - si `yunohost.local` ne fonctionne pas, il vous faut [trouver l'IP locale de votre serveur](/finding_the_local_ip).
   - si vous avez installé votre serveur à la maison mais essayez d'y accéder depuis l'extérieur du réseau local, assurez-vous d'avoir bien configuré une redirection de port pour le port 22

Si il s'agit d'une machine distante (VPS), votre fournisseur devrait vous avoir communiqué l'IP de votre machine

Dans tous les cas, si vous avez déjà configuré un nom de domaine qui pointe sur l'IP appropriée, il est plus pratique d'utiliser `votre.domaine.tld` plutôt que l'adresse IP

## Identifiants pour se connecter

### AVANT la post-installation

- Si vous faites une **installation à la maison**, les identifiants par défaut sont login:  `root`, mot de passe: `yunohost`
- Si vous faites une **installation sur un serveur distant (VPS)**, votre fournisseur devrait vous avoir communiqué le login et mot de passe (ou vous proposer de configurer une clef SSH)

### APRÈS la post-installation

Durant la postinstallation, vous avez défini un mot de passe d'administration. C'est ce mot de passe qui devient le nouveau mot de passe pour les utilisateurs `root` et `admin`. De plus, **le connection en SSH avec l'utilisateur `root` est désactivée et il vous faut utiliser l'utilisateur `admin` !**. L'exception à cette règle est qu'il reste possible de se logger en root *depuis le réseau local - ou depuis une console en direct sur la machine* (ce qui peut être utile dans l'éventualité ou le serveur LDAP est inactif et l'utilisateur admin ne fonctionne plus)

## Se connecter

Une commande SSH ressemble typiquement à :

```bash
# avant la postinstall:
ssh root@11.22.33.44

# ou après la postinstall:
ssh admin@11.22.33.44
```

Ou bien en utilisant le nom de domaine plutôt que l'IP (plus pratique) :

```bash
ssh admin@votre.domaine.tld
# ou avec le nom de domaine spécial yunohost.local:
ssh admin@yunohost.local
```

Si vous avez changé le port SSH, il faut rajouter l'option `-p <numerodeport>` à la commande, par ex. :

```bash
ssh -p 2244 admin@votre.domaine.tld
```

<div class="alert alert-info">
Si vous êtes connecté en tant qu'`admin` et souhaitez devenir `root` pour plus de confort (par exemple, ne pas avoir à taper `sudo` à chaque commande), vous pouvez devenir `root` en tapant `sudo su` ou `sudo -i`.
</div>

## Quels utilisateurs ?

Par défaut, seulement l'utilisateur `admin` peut se logger en SSH sur une instance YunoHost.

Les utilisateurs YunoHost créés via l'interface d'administration sont gérés par la base de donnée LDAP. Par défaut, ils ne peuvent pas se connecter en SSH pour des raisons de sécurité. Si vous avez absolument besoin qu'un utilisateur dispose d'un accès SSH, vous pouvez utiliser la commande :
```bash
yunohost user ssh allow <username>
```

De même, il est possible de supprimer l'accès SSH à un utilisateur avec la commande :
```bash
yunohost user ssh disallow <username>
```

Enfin, il est possible d'ajouter, de supprimer et de lister des clés SSH, pour améliorer la sécurité de l'accès SSH, avec les commandes :
```bash
yunohost user ssh add-key <username> <key>
yunohost user ssh remove-key <username> <key>
yunohost user ssh list-keys <username>
```

## SSH et sécurité

N.B. : `fail2ban` bannira votre IP pour 10 minutes si vous échouez plus de 5 fois à vous identifier. Pour débannir une IP, vous pouvez regarder la page sur [Fail2Ban](/fail2ban)

Une discussion plus complète de la sécurité et de SSH peut être trouvée sur [la page dédiée](/security).
