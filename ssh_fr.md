# SSH

## Qu’est-ce que SSH ?

**SSH** est un acronyme pour Secure Shell, et désigne un protocole qui permet de contrôler à distance une machine via la ligne de commande (CLI). C'est aussi une commande disponible de base dans les terminaux de Linux et Mac OS / OSX. Sous Windows, il vous faudra utiliser le logiciel [MobaXterm](https://mobaxterm.mobatek.net/download-home-edition.html) (après l'avoir lancé, cliquer sur Session puis SSH).

## Pendant l’installation de YunoHost

#### Trouver son IP

Si vous installez YunoHost sur un VPS, votre fournisseur devrait vous avoir communiqué l'adresse IP de votre serveur. 

Si vous installez un serveur à la maison (par ex. sur Raspberry Pi ou OLinuXino), il vous faut trouver l'IP qui a été attribuée à votre carte après que vous l'ayez connectée à votre box internet / routeur. Il y a plusieurs façons de faire cela :

- ouvrez un terminal et tapez `sudo arp-scan --local` pour lister les IP des machines sur le réseau local ;
- si la commande arp-scan vous affiche beaucoup de machines, vous pouvez vérifier lesquelles sont ouvertes au ssh avec `nmap -p 22 192.168.1.0/24` pour faire du tri (adaptez la plage IP selon votre réseau local)
- utilisez l'interface de votre box internet pour lister les machines connectées, ou regarder les logs ;
- branchez un écran sur votre serveur, loggez-vous et tapez `hostname --all-ip-address`.

#### Se connecter

En supposant que votre adresse IP est `111.222.333.444`, ouvrez un terminal et tapez :

```bash
ssh root@111.222.333.444
```

Un mot de passe sera demandé. Si c'est un VPS, votre fournisseur devrait également vous avoir communiqué un mot de passe. Si vous avez utilisé une image pré-installée (pour x86 ou cartes ARM), le password devrait être `yunohost`.

<div class="alert alert-warning">
Depuis YunoHost 3.4, après avoir effectué la postinstallation, il ne sera plus possible de se logguer avec l'utilisateur `root`. À la place, il vous faut **vous logguer avec l'utilisateur `admin` !** Dans l'éventualité où le serveur LDAP serait cassé, rendant l'utilisateur `admin` inutilisable, vous devriez cependant pouvoir vous logguer avec l'utilisateur `root` depuis le réseau local.
</div>

#### Changer le mot de passe root !

Après vous être connecté pour la première fois, il vous faut changer le mot de passe `root`. Le serveur vous demandera peut-être automatiquement de le faire. Si ce n'est pas le cas, il faut utiliser la commande `passwd`. Il est important de choisir un mot de passe raisonnablement compliqué. Notez que ce mot de passe sera écrasé ensuite par le mot de passe admin choisi lors de la postinstallation.

#### En avant pour la configuration !

Tout est prêt pour passer à la [post-installation](postinstall).

## Sur une instance déjà installée

Si vous avez installé votre serveur à la maison et que vous cherchez à vous connecter depuis l'extérieur du réseau local, assurez-vous d'avoir bien redirigé le port 22 vers votre serveur. (Rappel : depuis la version 3.4, il vous faut vous logguer avec l'utilisateur `admin` !)

Si vous connaissez seulement l'IP de votre serveur :

```bash
ssh admin@111.222.333.444
```

Ensuite, entrez le mot de passe administrateur défini pendant la [post-installation](postinstall).

Si vous avez configuré vos DNS (ou modifié votre `/etc/hosts`), vous pouvez utiliser votre nom de domaine :

```bash
ssh admin@votre.domaine.tld
```

Si vous avez changé le port SSH, il faut rajouter `-p <numerodeport>` à la commande, par ex. :

```bash
ssh -p 2244 admin@votre.domaine.tld
```

<div class="alert alert-info">
Si vous êtes connecté en tant qu'`admin` et souhaitez devenir `root` pour plus de confort (par exemple, ne pas avoir à taper `sudo` à chaque commande), vous pouvez devenir `root` en tapant `sudo su`.
</div>

## Quels utilisateurs ?

Par défaut, seulement l'utilisateur `admin` peut se logger en SSH sur une instance Yunohost.

Les utilisateurs YunoHost créés via l'interface d'administration sont gérés par la base de donnée LDAP. Par défaut, ils ne peuvent pas se connecter en SSH pour des raisons de sécurité. Si vous avez absolument besoin qu'un utilisateur dispose d'un accès SSH, vous pouvez utiliser la commande :
```bash
yunohost user ssh allow <username>
```

De même, il est possible de supprimer l'accès ssh à un utilisateur avec la commande :
```bash
yunohost user ssh disallow <username>
```

Enfin, il est possible d'ajouter, de supprimer et de lister des clés ssh, pour améliorer la sécurité de l'accès ssh, avec les commandes :
```bash
yunohost user ssh add-key <username> <key>
yunohost user ssh remove-key <username> <key>
yunohost user ssh list-keys <username>
```

## SSH et sécurité

N.B. : `fail2ban` bannira votre IP pour 10 minutes si vous échouez plus de 5 fois à vous identifier. Pour débannir une IP, vous pouvez regarder la page sur [fail2ban](/fail2ban_fr)

Une discussion plus complète de la sécurité et de SSH peut être trouvée sur [la page dédiée](security_fr).
