# SSH

## Qu’est-ce que SSH ?

**SSH** est un accronyme pour Secure Shell, et désigne un protocole qui permet de contrôler à distance une machine via la ligne de commande (CLI). C'est aussi une commande disponible de base sur Linux et Mac OS / OSX. Sous Windows, maleureusement il vous faudra utiliser le logiciel [PuTTy](http://www.fastcomet.com/tutorials/getting-started/putty).

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

Un mot de passe sera demandé. Si c'est un VPS, votre fournisseur devrait également vous avoir communiqué un mot de passe. Sur un Raspberry Pi, le password devrait être `raspberry`. Sur un OLinuXino, cela devrait être `olinux`.

#### Changer le mot de passe root !

Après vous être loggé pour la première fois, il vous faut changer le mot de passe root. Le serveur vous demandera peut-être automatiquement de le faire. Si ce n'est pas le cas, il faut utiliser la commande `passwd`. Il est important de choisir un mot de passe raisonnablement compliqué.

## Sur une instance déjà installée

Si vous avez installé votre serveur à la maison et que vous cherchez à vous connecter depuis l'extérieur du réseau local, assurez-vous d'avoir bien redirigé le port 22 vers votre serveur.

Si vous connaissez seulement l'IP de votre serveur :

```bash
ssh admin@111.222.333.444
```

Ensuite, entrez le mot de passe administrateur défini pendant la [post-installation](postinstall).

Si vous avez configuré vos DNS (or tweaked your `/etc/hosts`), you can simply use your domain name :

```bash
ssh admin@votre.domaine.tld
```

Si vous avez changé le port SSH, il faut rajouter `-p <numerodeport>` à la commande, par ex. :

```bash
ssh -p 2244 admin@votre.domaine.tld
```

## Quels utilisateurs ?

Par défaut, seulement les utilisateurs admin et root peuvent se logger en SSH sur une instance Yunohost.

Les utilisateurs YunoHost créé via l'interface d'administration sont géré par la base de donnée LDAP. Par défaut, ils ne peuvent pas se connecter en SSH pour des raisons de sécurité. Si vous avez absolument besoin qu'un utilisateur dispose d'un accès SSH, vous pouvez utiliser [cette manipulation](https://forum.yunohost.org/t/ssh-disconnects-after-successful-login/256/10).

## SSH et sécurité

Voir la page dédiée à la [sécurité](security_fr)
