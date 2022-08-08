---
title: SSH et la ligne de commande
template: docs
taxonomy:
    category: docs
routes:
  default: '/ssh'
  aliases:
    - '/commandline'
page-toc:
  active: true
---

## Qu’est-ce que SSH ?

**SSH** est un acronyme pour Secure Shell, et désigne un protocole qui permet de contrôler et administrer à distance une machine via la ligne de commande (CLI). C'est aussi une commande disponible de base dans les terminaux de GNU/Linux et macOS. Sous Windows, il vous faudra utiliser le logiciel [MobaXterm](https://mobaxterm.mobatek.net/download-home-edition.html) (après l'avoir lancé, cliquer sur Session puis SSH).

L'interface en ligne de commande (CLI) est, en informatique, la manière originale (et plus technique) d'interagir avec un ordinateur, comparée aux interfaces graphiques. La ligne de commande est généralement considérée comme plus complète, puissante et efficace que les interfaces graphiques, bien que plus difficile à apprendre.

## Comment se connecter ?
### Identifiant à utiliser

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="Avant la configuration initiale (post-installation)"]

- Si vous faites une **installation à la maison**, les identifiants par défaut sont login: `root`, mot de passe: `yunohost` (ou `1234` si vous partez d'une image armbian).
- Si vous faites une **installation sur un serveur distant (VPS)**, votre fournisseur devrait vous avoir communiqué le login et le mot de passe (ou vous proposer de configurer une clé SSH).

[/ui-tab]
[ui-tab title="Après"]

Durant la post-installation, vous avez défini un mot de passe d'administration. C'est ce mot de passe qui devient le nouveau mot de passe pour les utilisateurs `root` et `admin`. De plus, **la connexion en SSH avec l'utilisateur `root` est désactivée et il vous faut utiliser l'utilisateur `admin` !**. L'exception à cette règle est qu'il reste possible de se logger en root *depuis le réseau local - ou depuis une console en direct sur la machine* (ce qui peut être utile dans l'éventualité où le serveur LDAP est inactif et l'utilisateur admin ne fonctionne plus).

!!! Si vous êtes connecté en tant qu'`admin` et souhaitez devenir `root` pour plus de confort (par exemple, ne pas avoir à taper `sudo` à chaque commande), vous pouvez devenir `root` en tapant `sudo su` ou `sudo -i`.
[/ui-tab]
[/ui-tabs]

### Adresse à utiliser

Si vous hébergez votre serveur **à la maison** (par ex. Raspberry Pi ou OLinuXino ou vieil ordinateur)
   - vous devriez pouvoir vous connecter à la machine en utilisant `yunohost.local` (ou `yunohost-2.local`, selon le nombre de serveurs sur le réseau). 
   - si `yunohost.local` et consorts ne fonctionnent pas, il vous faut [trouver l'IP locale de votre serveur](/finding_the_local_ip).
   - si vous avez installé votre serveur à la maison mais essayez d'y accéder depuis l'extérieur du réseau local, assurez-vous d'avoir bien configuré une redirection de port pour le port 22.

S'il s'agit d'une machine distante (VPS), votre fournisseur devrait vous avoir communiqué l'IP de votre machine.

Dans tous les cas, si vous avez déjà configuré un nom de domaine qui pointe sur l'IP appropriée, il est plus pratique d'utiliser `votre.domaine.tld` plutôt que l'adresse IP.

### Se connecter

Ci-dessous quelques exemples de commande SSH typiques :

```bash
# avant la postinstall:
ssh root@11.22.33.44

# après la postinstall:
ssh admin@11.22.33.44

# avec le nom de domaine plutôt que l'IP (plus pratique):
ssh admin@votre.domaine.tld

# avec le nom de domaine spécial yunohost.local:
ssh admin@yunohost.local

# si vous avez changé le numéro de port pour SSH 
ssh -p 2244 admin@votre.domaine.tld
```

!!! `fail2ban` bannira votre IP pendant 10 minutes si vous échouez plus de 10 fois à vous identifier. Pour débannir une IP, vous pouvez regarder la page sur [Fail2Ban](/fail2ban).

## Autoriser un utilisateur YunoHost standard

Par défaut, seul l'utilisateur `admin` peut se logger en SSH sur une instance YunoHost.

Les utilisateurs YunoHost créés via l'interface d'administration sont gérés par la base de données LDAP. Par défaut, ils ne peuvent pas se connecter en SSH pour des raisons de sécurité. Via le système des permissions il est possible d'autoriser la connexion en SFTP ou si c'est vraiment nécessaire en SSH.

! Faites attention à qui vous donnez accès à SSH. Cela augmente encore plus la surface d'attaque disponible pour un utilisateur malveillant.

[ui-tabs position="top-left" active="0" theme="lite"]
[ui-tab title="À partir de l'interface web"]
Se rendre dans `Utilisateurs > Gérer les groupes et les autorisations`

À partir de là, il est possible d'ajouter les permissions SFTP ou SSH à un utilisateur ou un groupe au choix.

Si vous souhaitez ajouter une clé publique SSH à l'utilisateur, vous devez le faire en ligne de commande, l'interface web ne proposant pas encore cette fonctionnalité.
[/ui-tab]
[ui-tab title="À partir de la ligne de commande"]
Pour autoriser un utilisateur ou un groupe à accéder en SFTP ou en SSH :
```bash
# SFTP
yunohost user permission add sftp <username>
# SSH
yunohost user permission add ssh <username>
```

Pour enlever la permission :
```bash
# SFTP
yunohost user permission remove sftp <username>
# SSH
yunohost user permission remove ssh <username>
```

Enfin, il est possible d'ajouter, de supprimer et de lister des clés SSH, pour améliorer la sécurité de l'accès SSH, avec les commandes :
```bash
yunohost user ssh add-key <username> <key>
yunohost user ssh remove-key <username> <key>
yunohost user ssh list-keys <username>
```
[/ui-tab]
[/ui-tabs]

## SSH et sécurité

Une discussion plus complète sur la sécurité de SSH peut être trouvée sur [la page dédiée](/security).

## La ligne de commande

!!! Fournir un tutoriel complet sur la ligne de commande est bien au-delà du cadre de la documentation de YunoHost : pour cela, référez-vous à des tutoriels comme [celui-ci](https://doc.ubuntu-fr.org/tutoriel/console_ligne_de_commande) ou [celui-ci (en)](http://linuxcommand.org/). Mais soyez rassuré, il n'y a pas besoin d'être un expert pour commencer à l'utiliser !

### La commande `yunohost`

La commande `yunohost` peut être utilisée pour administrer votre serveur ou réaliser les mêmes actions que celles disponibles sur la webadmin. Elle doit être lancée depuis l'utilisateur `root`, ou bien depuis l'utilisateur `admin` en précédant la commande de `sudo`. (ProTip™ : il est possible de devenir `root` via la commande `sudo su` en tant qu'`admin`.)

Les commandes YunoHost ont ce type de structure :

```bash
yunohost app install wordpress --label Webmail
          ^    ^        ^             ^
          |    |        |             |
   catégorie  action  argument     options
```

N'hésitez pas à naviguer et demander des informations à propos d'une catégorie ou action donnée via l'option `--help`. Par exemple, ces commandes :

```bash
yunohost --help
yunohost user --help
yunohost user create --help
```

vont successivement lister toutes les catégories disponibles, puis les actions de la catégorie `user`, puis expliquer comment utiliser l'action `user create`. Vous devriez remarquer que l'arbre des commandes YunoHost suit une structure similaire aux pages de la webadmin.

### La commande `yunopaste`
Cette commande est utile lorsque vous voulez communiquer à une autre personne le retour d'une commande.

Exemple :
```bash
yunohost tools diagnosis | yunopaste
```
### Quelques commandes utiles

Si votre interface web d'administration indique que l'API est injoignable, essayez de démarrer `yunohost-api` :
```bash
systemctl start yunohost-api
```

Si vous ne parvenez plus à vous connecter avec l'utilisateur `admin` via SSH et via l'interface web, le service `slapd` est peut-être éteint, essayez de le redémarrer :
```bash
systemctl restart slapd
```

Si vous avez des configurations modifiées manuellement et souhaitez connaître les modifications :
```bash
yunohost tools regen-conf --with-diff --dry-run
```
