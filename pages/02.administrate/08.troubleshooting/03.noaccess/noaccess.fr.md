---
title: Récupérer l'accès à son YunoHost
template: docs
taxonomy:
    category: docs
routes:
  default: '/noaccess'
---

Il existe de nombreuses causes pouvant empêcher totalement ou partiellement d'accéder en administrateur à un serveur YunoHost. Dans de nombreux cas, un des moyens d'accès est inaccessible, mais les autres sont fonctionnels.

Cette page va vous aider à diagnostiquer, obtenir un accès et si besoin réparer votre système. Les pannes les plus courantes sont priorisées de haut en bas. Il vous suffit de tester chaque hypothèse.


## Vous avez accès au serveur via l'adresse IP, mais pas avec le nom de domaine ?

#### Si vous êtes auto-hébergé à la maison : il faut configurer les redirection de ports

Vérifier que vous arrivez à accéder au serveur en utilisant son IP globale (que vous pouvez trouver sur https://ip.yunohost.org). Si cela ne fonctionne pas:
   - Assurez-vous d'avoir [configuré les redirections de ports](/isp_box_config)
   - Certaines box de FAI ne supportent pas le hairpinning et vous ne pouvez pas accéder à votre serveur depuis l'intérieur du réseau local (sauf à passer par l'IP locale). Pour contourner le problème, vous pouvez tester d'accéder à votre serveur en passant par un proxy comme proxfree.com

#### Il faut configurer vos enregistrement DNS

(N.B.: ce n'est pas nécessaire si vous utilisez un domaine de type nohost.me, noho.st ou ynh.fr)

Il vous faut configurer vos enregistrement DNS comme expliqué sur [cette page](/dns_config) (à minima l'enregistrement A, et AAAA si vous avez de l'IPv6). 

Vous pouvez valider que les enregistrements DNS sont corrects en comparant le résultat de https://www.whatsmydns.net/ avec l'IP globale de votre serveur (si vous êtes hébergé à la maison, vous pouvez obtenir cette IP sur https://ip.yunohost.org)


#### Autres causes possibles

- Votre nom de domaine noho.st, nohost.me ou ynh.fr est inaccessible suite à une panne de l'infra YunoHost. Vérifiez sur le forum si d'autre personnes signalent le même problème.
- Votre nom de domaine est peut-être expiré. Vous pouvez vérifier que votre nom de domaine a expiré en vous connectant sur l'interface de votre registrar ou en utilisant le whois par exemple via la commande `whois NOM_DE_DOMAINE`.
- Vous avez une IP dynamique. Dans ce cas, il faut mettre en place un script qui se charge de mettre à jour régulièrement votre IP (ou d'utiliser un nom de domaine en nohost.me, noho.st ou ynh.fr qui inclue un tel mécanisme)


## Vous êtes face à une erreur de certificat qui vous empêche d’accéder à la webadmin

Si vous venez d'installer votre serveur ou d'ajouter un nouveau domaine, il utilise pour le moment un certificat auto-signé. Dans ce cas, il devrait être possible et légitime d'ajouter *exceptionnellement* une exception de sécurité le temps d'[installer un certificat Let's Encrypt](/certificate) à condition d'être sur une connexion internet sûre (pas avec Tor Browser par exemple).

Une erreur de certificat peut également être affichée dans certain cas où vous avez fait une faute de frappe dans la barre d'adresse de votre navigateur.


## Vous avez accès en SSH mais pas à la Web admin ou inversement

#### Vous essayez de vous connecter en SSH avec `root` plutôt qu'avec `admin`

Par défaut, la connexion en SSH doit s'effectuer avec l'utilisateur `admin`. Il est possible de se connecter à la machine avec l'utilisateur `root` *seulement depuis le réseau local* sur lequel se situe le serveur (ou bien via la console web / VNC pour des VPS).

Lorsque vous exécutez des commandes `yunohost` en tant qu'admin, il faut les précéder de la commande `sudo` (par exemple `sudo yunohost user list`). Vous pouvez également devenir `root` en tapant `sudo su`.

#### Vous avez été banni temporairement

Votre serveur YunoHost inclut un mécanisme (Fail2Ban) qui banni automatiquement les IPs qui échouent plusieurs fois à s'authentifier. Dans certains cas, il peut s'agir d'un programme (par exemple un client Nextcloud) qui est configuré avec un ancien mot de passe ou d'un utilisateur qui utilise la même IP que vous.

Si vous avez été banni en tentant d'accéder à une page web, seul les pages web sont inaccessibles, vous devriez donc pouvoir accéder au serveur en SSH. De même, si vous avez été banni en SSH vous devriez pouvoir accéder à la webadmin.

Si vous avez été banni à la fois en SSH et à la webadmin, vous pouvez essayer d'accéder à votre serveur avec une autre IP, par exemple en utilisant la 4G d'un smartphone ou en utilisant Tor Browser.

Voir aussi : [débannir une IP sur Fail2Ban](/fail2ban)

NB : le bannissement dure en général 10 à 12 minutes. Le bannissement n'est actif qu'en IPv4.


#### Le serveur web NGINX est cassé

Peut-être que le serveur web NGINX est en panne. Vous pouvez vérifier cela [en ssh](/ssh) avec `yunohost service status ssh`. Si il est en panne, vérifiez que la configuration ne comporte pas d'erreur avec `nginx -t`. Si la configuration est cassée, ceci est peut-être du à une l'installation ou désinstallation d'une application de mauvaise qualité... Si vous êtes perdu, [demandez de l'aide](/help).

Il se peut également que le serveur web (NGINX) ou le serveur ssh aient été tués suite à un manque d'espace disque ou de RAM / swap.
- Tentez de relancer le service avec `systemctl restart nginx`.
- Vous pouvez contrôler l'espace disque utilisé avec `df -h`. Si une de vos partitions est remplie à 100%, il faut identifier ce qui prend de la place sur votre système et faire de la place. Il est possible d'installer l'utilitaire `ncdu` avec `apt install ncdu` puis de faire `ncdu /` pour analyser la taille des dossiers de toute l'arborescence.
- Vous pouvez contrôler l'utilisation de la RAM / swap avec `free -h`. En fonction des résultats, il peut être nécessaire d'optimiser votre serveur pour qu'il utilise moins de RAM (suppression d'app lourdes et inutiles...), d'ajouter de la RAM ou d'ajouter un fichier de swap.

#### Votre serveur est accessible en IPv6 mais pas en IPv4 ou inversement

Vous pouvez le vérifier en tentant de faire des ping sur votre serveur en IPv4 et en IPv6.

Dans un tel cas, il est possible que vous arriviez à accéder à votre web admin en IPv6 mais pas en SSH potentiellement en IPv4 par défaut...

Dans ce cas il faut résoudre votre problème de connectivité.

Dans certains, cas une mise à jour de votre box a activé l'IPv6, entraînant des problèmes de configuration au niveau de votre nom de domaine.


## La webadmin fonctionne, mais certaines applications web me renvoient une erreur 502.

Il est fort probablement que le service correspondant à ces applications soit en panne (typiquement pour les applications PHP, il s'agit de php7.0-fpm ou php7.3-fpm). Vous pouvez alors tenter de relancer le service, et si cela ne fonctionne pas, regarder les logs du service correspondant et/ou [demander de l'aide](/help).


## Vous avez perdu votre mot de passe administrateur ? (ou bien le mot de passe est refusé)

Si vous arrivez à afficher la page web d'administration (forcez le rafraîchissement avec CTRL + F5 pour être sur) et que vous n'arrivez pas à vous connectez, vous avez probablement un mot de passe erroné.

Si vous êtes certain du mot de passe, il est possible que le service SLAPD qui gère l'authentification soit en panne. Si c'est le cas, il vous faut vous connecter en `root`.
- Si votre serveur est chez vous, vous avez sans doute accès au réseau local du serveur. Depuis ce réseau, vous pouvez vous connecter [en SSH](/ssh) avec l'utilisateur `root`.
- Si vous êtes sur un VPS, votre hébergeur vous fournit peut-être la possibilité d'avoir une console sur votre serveur depuis le navigateur web. 
Une fois connecté, il vous faut regarder l'état du service avec la commande `yunohost service status slapd` et/ou tenter de réinitialiser votre mot de passe avec la commande `yunohost tools adminpw`.

Si vous ne pouvez pas ou ne réussissez pas non plus à vous connecter en `root`, vous allez devoir opérer en mode rescue.

TODO: à compléter


## Votre VPN a expiré ou ne se monte plus

Si vous utilisez un VPN a IP fixe, peut être que celui-ci est arrivé à expiration ou que l'infrastructure de votre fournisseur est en difficulté.

Dans ce cas, vous pouvez peut être accéder à votre serveur avec son IP locale s'agissant probablement d'un serveur auto-hébergé chez-vous.

Pour connaître votre IP locale, certaines BOX proposent une cartographie du réseau en cours avec les équipements connectés. Sinon, en ligne de commande avec linux:
```bash
sudo arp-scan --local
```

Vous pouvez aussi essayer avec le domaine `yunohost.local` s'il n'y a qu'un seul YunoHost sur votre réseau.

Il faut voir avec votre fournisseur de VPN pour renouveler le VPN et mettre à jour les paramètre de l'app VPN Client.

TODO : à compléter

## Votre serveur est coincé au démarrage

Dans certains cas, votre serveur peut rester coincé au démarrage. Il peut s'agir d'un problème suite à l'installation d'un nouveau kernel. Essayez de choisir un autre kernel avec VNC ou avec l'écran lors du boot.

Si vous êtes en mode `rescue` avec `grub`, dans ce cas il peut s'agir d'un problème de configuration de `grub` ou d'un disque corrompu.

Dans ce cas il faut accéder au disque avec un autre système (mode `rescue` du fournisseur, live USB, lire la carte SD ou le disque dur avec un autre ordinateur) et essayer de vérifier l'intégrité des partitions avec `smartctl`, `fsck` et `mount`.

Si les disques sont corrompus et difficiles à monter, il faut sauvegarder les données et potentiellement refaire un formatage/réinstaller et/ou changer le disque. Si on arrive à monter le disque, il est possible d'utiliser `systemd-nspawn` pour entrer dans la base de données.

Sinon, relancer `grub-update` et `grub-install` en `chroot` ou avec `systemd-nspawn`.


## L’accès en VNC ou via écran ne fonctionne pas

Dans ce cas il peut s'agir d'un problème matériel sur votre serveur physique ou d'un problème d'hyperviseur si c'est un VPS.

Si c'est une machine louée contactez le support de votre fournisseur. Sinon, essayez de dépanner votre machine en retirant les composants qui peuvent être en panne.
