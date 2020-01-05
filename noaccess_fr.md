# Récupérer l'accès à son YunoHost
Si vous avez perdu l'accès à votre YunoHost qui était auparavant fonctionnel, cette page est faite pour vous.

Il existe de nombreuses causes pouvant empécher totalement ou partiellement d'accéder en administrateur à un serveur YunoHost. Dans de nombreux cas, un des moyens d'accès est inaccessible, mais les autres sont fonctionnels.

Cette page va vous aider à diagnostiquer, obtenir un accès et si besoin réparer votre système. Les pannes les plus courantes sont priorisées de haut en bas. Il vous suffit de tester chaque hypothèse.

## Vous avez perdu votre mot de passe administrateur
Si vous arrivez à afficher la page web d'administration (forcer le rafraîchissement avec CTRL + F5 pour être sur) et que vous n'arrivez pas à vous connectez. Vous avez probablement un mot de passe erroné.

Dans ce cas, à moins d'avoir un accès root actif (en SSH par exemple) auquel cas vous pouvez changer le mot de passe de l'utilisateur admin, vous allez devoir opérer en mode rescue.

TODO

## Vous avez une erreur de certificat qui vous empêche d'accéder à la webadmin

Si vous n'avez jamais activé Let's Encrypt ou que vous accéder à la web admin via une IP ou un domaine locale, vous pouvez accepter le certificat invalide exceptionnellement à condition d'être sur une connexion internet sûre (pas avec Tor Browser par exemple).

Pour y parvenir, il faut aller sur la page d'administration web en utilisant la navigation privée, votre navigateur devrait vous autoriser d'ajouter une exception temporaire pour accéder à la page.

## Vous avez accès en SSH mais pas à la Web admin ou inversement

### Vous avez été banni temporairement
Votre serveur YunoHost inclut un pare-feu qui banni les IP qui échouent plusieurs fois à se connecter. Dans certains cas, il peut s'agir d'un programme (nextcloud-client) qui est configuré avec un ancien mot de passe ou d'un utilisateur qui utilise la même IP que vous.

Si vous avez été banni en tentant d'accéder à une page web, seul les pages web sont inaccessibles, vous devriez donc pouvoir accéder au serveur en SSH. De même, si vous avez été banni en SSH vous devriez pouvoir accéder à la webadmin.

Si vous avez été banni à la fois en SSH et à la webadmin, vous pouvez essayer d'accéder à votre serveur avec une autre IP, par exemple en utilisant la 4G d'un smartphone ou en utilisant Tor Browser.

NB: le bannissement dure en général quelques minutes. Le bannissement n'est actif qu'en IPv4.

### Vous n'avez plus d'espace disque...
... et votre serveur web nginx qui distribue les pages de la web admin ou votre serveur SSH ne fonctionne plus.

Pour vérifier si vous avez de l'espace disque, vous pouvez le faire de puis la web admin TODO ou avec la commande `df -h`.

Si une de vos partition est remplie à 100%, il faut identifier ce qui prend de la place sur votre système et faire de la place.

Attention, dans certains cas il peut s'agir d'erreur qui arrive tellement souvent qu'elles remplissent les fichiers de logs et votre système avec.

A partir de la web admin vous pouvez relancer le service SSH. De même en SSH, vous pouvez redémarrer le serveur web nginx avec la commande `yunohost service start nginx`

### Vous manquez de RAM et n'avez pas de swap
... et votre serveur web nginx qui distribue les pages de la web admin ou votre serveur SSH a été tués aléatoirement.

Quand votre serveur n'a plus de ram, il est obligé d'écrire sur le disque dans la swap, si il n'y en a pas, dans ce cas il doit tuer un des processus pour faire de l'espace.

Vous pouvez vérifier que vous n'avez plus beaucoup de ram via la web admin ou en SSH via la commande `free -m`.

Pour régler cette situation, vous pouvez soit:

* optimiser votre serveur pour qu'il utilise moins de ram (suppression arrêt de services inutiles)
* ajouter de la ram
* ajouter un fichier de swap

A partir de la web admin vous pouvez relancer le service SSH. De même en SSH, vous pouvez redémarrer le serveur web nginx avec la commande `yunohost service start nginx`

### Vous avez installé une app qui a cassé votre configuration web
Si vous avez installé une app de mauvaise qualité, celle-ci peut échouer à l'installation et laisser des bouts de configuration qui vont empécher le redémarrage de votre serveur web nginx qui vous permet d'accéder à la web admin.

Dans ce cas, il faut accéder en SSH et essayer de terminer la suppression de l'app. Si elle est déjà supprimée, il faut enlever manuellement les résidus de configuration.

### Votre serveur est accessible en IPv6 mais pas en IPv4 ou inversement
Dans un tel cas, il est possible que vous arriviez à accéder à votre web admin en IPv6 mais pas en SSH potentiellement en IPv4 par défaut...

Dans ce cas il faut résoudre votre problème de connectivité.

Dans certains cas une mise à jour de votre box a activé l'ipv6, entraînant des problèmes de configuration au niveau de votre nom de domaine.

## Votre VPN a expiré ou ne se monte plus
Si vous utilisez un VPN a IP fixe, peut être que celui-ci est arrivé à expiration ou que l'infrastructure de votre fournisseur est en difficulté.

Dans ce cas, vous pouvez peut être accéder à votre serveur avec son IP locale s'agissant probablement d'un serveur auto-hébergé chez-vous.

Pour connaître votre ip locale, certaines BOX propose une cartographie du réseau en cours avec les équipements connectés. Sinon, en ligne de commande avec linux:
```
sudo arp-scan --local
```

Vous pouvez aussi essayer avec le domaine `yunohost.local` si il n'y a qu'un seul YunoHost sur votre réseau.

Il faut voir avec votre fournisseur de VPN pour renouveler le VPN et mettre à jour les paramètre de l'app VPN Client.

TODO

## Votre routeur ne redirige plus vers votre serveur
Si votre routeur a été remis à zéro ou mis à jour, votre configuration de redirection de port pourrait avoir disparu. De même, l'ipv6 ou le hairpining pourrait avoir été activé.

Typiquement si en tapant votre IP publique vous tombez sur votre box, c'est soit le hairpinning soit la redirection de port qui est manquante.

## Votre serveur ping avec son IP, mais pas avec le nom de domaine
### Votre nom de domaine a expiré
Si votre nom de domaine expire il ne redirigera plus vers votre serveur. 

Vous pouvez vérifier que votre nom de domaine a expiré en vous connectant sur l'interface de votre registrar ou en utilisant le whois par exemple via la commande `whois NOM_DE_DOMAINE`.

Dans ce cas il faut renouveler le nom de domaine (si ile st encore temps.

### Votre nom de domaine est mal configuré
Si votre serveur ping avec son ip mais ne ping pas avec le nom de domaine alors il y a un problème de configuration au niveau du champs A.

Si c'est un nom de domaine fournit par YunoHost, lancez 
```
yunohost dyndns update
```

Si c'est un autre nom de domaine, il faut mettre à jour votre ipv4 et votre ipv6 dans l'interface de votre registrar. 

Attention, si votre IP change régulièrement il faut mettre en place un script qui se lance régulièrement pour mettre à jour votre IP.

### Votre nom de domaine noho.st, nohost.me, ynh.fr est inaccessible suite à une panne de l'infra YunoHost
Il arrive environ trois fois par an que l'infra de YunoHost soit en panne suite à une coupure de courant ou à un problème d'administration système.

Vérifiez sur le forum si d'autre sont signalez le même problème.

## Vous avez perdu l'accès en IPv4 mais vous avez accès en IPv6 ou inversement

Dans ce cas, il faut tenter d'accéder en SSH avec l'autre IP et essayer de comprendre pourquoi le réseau en IPv4 ou en IPv6 a disparu.

Si ce n'est pas lié à une erreur de configuration réseau sur votre système, il peut être nécessaire d’appeler votre fournisseur de serveur ou d'accès à internet pour vérifier que le problème n'est pas chez eux.

## Vous avez perdu l'accès en IPv4 (ET en IPv6 le cas échéant)
Vous pouvez le vérifier en tentant de faire des ping sur votre serveur en IPv4 et en IPv6.

Dans ce cas, vous devriez essayer de brancher un clavier/écran sur votre serveur ou d'y accéder par VNC si c'est un serveur distant.

### Vous pouvez vous connecter avec l'utilisateur admin et le mot de passe
A partir de là vous devriez diagnostiquer votre problème réseau le réparer ou si ce n'est pas lié au système contacter le support de votre fournisseur de serveur ou de connexion Internet.

### Votre serveur est coincé au démarrage
Dans certains cas, votre serveur peut rester coincer au démarrage. Il peut s'agir d'un problème suite à l'installation d'un nouveau kernel. Essayez de choisir un autre kernel avec VNC ou avec l'écran lors du boot.

Si vous êtes en grub rescue, dans ce cas il peut s'agir d'un problème de configuration de grub ou d'un disque corrompu.

Dans ce cas il faut accéder au disque avec un autre système (mode rescue du fournisseur, live usb, lire la carte SD ou le disque dur avec un autre ordinateur) et essayer de vérifier l'intégrité des partitions avec smartctl, fsck et mount.

Si les disques sont corrompus et difficile à monter, il faut sauvegarder les données et potentiellement refaire un formatage/réinstaller et/ou changer le disque. Si on arrive à monter le disque, il est possible d'utiliser systemd-nspawn pour entrer dans la base de donnée.

Sinon, relancer grub-update et grub-install en chroot ou avec systemd-nspawn.

### L'accès en VNC ou via écran ne fonctionne pas
Dans ce cas il peut s'agir d'un problème matériel sur votre serveur physique ou d'un problème d'hyperviseur si c'est un VPS.

Si c'est une machine loué contacter le support de votre fournisseur. Sinon essayez de dépanner votre machine en retirant les composants qui peuvent être en panne.
