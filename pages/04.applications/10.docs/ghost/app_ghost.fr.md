---
title: Ghost
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_ghost'
---

[![Installer Ghost avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=ghost) [![Integration level](https://dash.yunohost.org/integration/ghost.svg)](https://dash.yunohost.org/appci/app/ghost)

*Ghost* est une plateforme d'édition, d'adhésions, d'abonnements et de newsletters.

### Avertissements / informations importantes

#### Installation

1. Pas de prise en charge LDAP.

2. Vous avez besoin de plus de 1 Go de RAM. Si vous ne l'avez pas, veuillez créer une mémoire swap.

```
dd if=/dev/zero of=/swapfile bs=1024 count=1048576
mkswap /fichier d'échange
swapon / fichier d'échange
echo "/swapfile swap swap defaults 0 0" >> /etc/fstab
```

3. Cette application est multi-instance (vous pouvez avoir plusieurs sites Web de blogs Ghost sur un seul serveur YunoHost)

##### Installation de l'application Ghost

0. Remarque - Lorsque vous rendez l'installation publique, vous devez accéder à votre lien de domaine Ghost SANS vous connecter à votre session YunoHost. Il est recommandé d'utiliser un mode incognito pour vous connecter à votre compte administrateur Ghost. Si vous rendez votre installation publique et essayez de vous connecter à votre compte administrateur Ghost tout en étant connecté à votre session YunoHost, vous obtiendrez une erreur d'en-tête autorisée. La raison en est que Ghost a une fonctionnalité qui permet un accès au contenu basé sur un abonnement. Cela signifie que Ghost permet à l'utilisateur administrateur de configurer d'autres utilisateurs (soit d'autres membres du personnel, soit des abonnés payés/non payés) pour avoir la possibilité de se connecter en dehors de YunoHost.

1. ** L'application peut être installée par l'interface d'administration YunoHost ou par la commande suivante : **

```
sudo yunohost app install https://github.com/YunoHost-Apps/ghost_ynh
```

2. Après l'installation, créez un compte administrateur en visitant `https://domain.tld/ghost/ghost`. Si vous choisissez de nommer votre instance Ghost "blog" pendant le processus d'installation de YunoHost, alors ce sera "https://domain.tld/blog/ghost". Cela vous permettra de continuer à configurer votre compte administrateur et à configurer vos paramètres.

## Liens utiles

+ Site web : [ghost.org](https://ghost.org/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/ghost](https://github.com/YunoHost-Apps/ghost_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/ghost/issues](https://github.com/YunoHost-Apps/ghost_ynh/issues)
