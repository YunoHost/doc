# SSH

## Qu’est-ce que SSH ?

**SSH** est un accronyme pour Secure Shell, et désigne un protocole qui permet de contrôler à distance une machine via la ligne de commande (CLI). C'est aussi une commande disponible de base sur Linux et Mac OS / OSX. Sous Windows, malheureusement il vous faudra utiliser le logiciel [PuTTy](http://www.fastcomet.com/tutorials/getting-started/putty).

## Pendant l’installation de YunoHost

#### Trouver son IP

Si vous installez YunoHost sur un VPS, votre fournisseur devrait vous avoir communiqué l'adresse IP de votre serveur. 

Si vous installez un serveur à la maison (par ex. sur Raspberry Pi ou OLinuXino), il vous faut trouver l'IP qui a été attribuée à votre carte après que vous l'ayez connecté à votre box internet / routeur. Il y a plusieurs façon de faire ça :

- ouvrez un terminal et tapez `sudo arp-scan --local` pour lister les IP des machines sur le réseau local ;
- utilisez l'interface de votre box internet pour lister les machines connectées, ou regarder les logs ;
- branchez un écran sur votre serveur, loggez-vous et tapez `ifconfig`.

#### Se connecter

En supposant que votre adresse IP est `111.222.333.444`, ouvrez un terminal et tapez :

```bash
ssh root@111.222.333.444
```

Un mot de passe sera demandé. Si c'est un VPS, votre fournisseur devrait également vous avoir communiqué un mot de passe. Si vous avez utilisé une image pré-installée (pour x86 ou cartes ARM), le password devrait être `yunohost`.

#### Changer le mot de passe root !

Après vous être loggé pour la première fois, il vous faut changer le mot de passe root. Le serveur vous demandera peut-être automatiquement de le faire. Si ce n'est pas le cas, il faut utiliser la commande `passwd`. Il est important de choisir un mot de passe raisonnablement compliqué.

## Sur une instance déjà installée

Si vous avez installé votre serveur à la maison et que vous cherchez à vous connecter depuis l'extérieur du réseau local, assurez-vous d'avoir bien redirigé le port 22 vers votre serveur.

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

## Quels utilisateurs ?

Par défaut, seulement les utilisateurs admin et root peuvent se logger en SSH sur une instance Yunohost.

Les utilisateurs YunoHost créés via l'interface d'administration sont géré par la base de donnée LDAP. Par défaut, ils ne peuvent pas se connecter en SSH pour des raisons de sécurité. Si vous avez absolument besoin qu'un utilisateur dispose d'un accès SSH, vous pouvez utiliser la commande :
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
yunohost user ssh add-key <username>
```



## SSH et sécurité

Voir la page dédiée à la [sécurité](security_fr)
