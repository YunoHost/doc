---
title: Seafile
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_seafile'
---

[![Installer Seafile avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=seafile) [![Integration level](https://dash.yunohost.org/integration/seafile.svg)](https://dash.yunohost.org/appci/app/seafile)

*Seafile* est une application open source de stockage en ligne (cloud).

Il s'agit d'une plateforme de synchronisation et de partage de fichiers d'entreprise avec une fiabilité et des performances élevées. Il s'agit d'une plateforme d'hébergement de fichiers avec une fiabilité et des performances élevées. Placez des fichiers sur votre propre serveur. Synchronisez et partagez des fichiers sur différents appareils, ou accédez à tous les fichiers sous forme de disque virtuel.

### Captures d'écran

![Capture d'écran de Seafile](https://github.com/YunoHost-Apps/seafile_ynh/blob/master/doc/screenshots/access-logs.jpg)

### Avertissements / informations importantes

#### Support multi-utilisateurs

Cette application supporte LDAP et l'authentification SSO.

Si vous avez installé Seafile avant 7.x et que vous avez plus d'un domaine pour les utilisateurs dans YunoHost ou que l'application Seafile est installée sur un domaine différent, vous devez migrer vos comptes.
Vous pouvez utiliser l'action fournie à `https://domain.tld/yunohost/admin/#/apps/seafile/actions`. Vous pouvez également utiliser la commande suivante pour migrer tous vos comptes :
```
yunohost app action run seafile migrate_user_email_to_mail_email
```
Voir [issue#44](https://github.com/YunoHost-Apps/seafile_ynh/issues/44)
pour plus d'information.

#### Les architectures prises en charge

Depuis Seafile 6.3, l'architecture i386 n'est plus supportée.

Seafile ne distribue pas de binaire pour les architectures génériques armhf mais les binaires rpi fonctionnent généralement sur toutes les cartes arm.

#### Informations complémentaires

#### Installation

Depuis la ligne de commande :

```
yunohost app install seafile
```

#### Mise à niveau

Par défaut, une sauvegarde est effectuée avant la mise à niveau. Pour éviter cela, vous avez les possibilités suivantes :
- Passez la variable env `NO_BACKUP_UPGRADE` avec `1` à chaque mise à jour. Par exemple `NO_BACKUP_UPGRADE=1 yunohost app upgrade synapse`.
- Définissez le paramètre `disable_backup_before_upgrade` à `1`. Vous pouvez le faire avec cette commande :
```
yunohost app setting synapse disable_backup_before_upgrade -v 1
```

Après cela, les paramètres seront appliqués pour **toutes** les prochaines mises à jour.

En ligne de commande :

```
yunohost app upgrade seafile
```

#### Sauvegarde

Cette application utilise maintenant la fonctionnalité de sauvegarde intégré à YunoHost. Pour conserver l'intégrité des données et avoir une meilleure garantie de restauration, il est recommandé de procéder comme suit :

- Arrêtez le service seafile avec la commande suivante :
```
systemctl stop seafile.service seahub.service
```
- Lancez la sauvegarde de seafile avec la commande suivante :
```
yunohost backup create --app seafile
```
- Faites une sauvegarde de vos données avec votre stratégie spécifique (cela peut être avec rsync, borg backup ou juste cp). Les données sont stockées dans `/home/yunohost.app/seafile-data`.
- Redémarrez le service seafile avec cette commande :
```
systemctl start seafile.service seahub.service
```

#### Désinstallation

En raison de la fonctionnalité de sauvegarde du noyau uniquement, le répertoire de données dans `/home/yunohost.app/seafile-data` **n'est pas supprimé**. Il doit être supprimé manuellement pour purger les données des utilisateurs de l'application.

#### Changer l'URL

Depuis maintenant, il est possible de changer le domaine ou l'url de seafile.

Pour cela lancez : `yunohost app change-url seafile -d new_domain.tld -p PATH new_path`.

## Liens utiles

+ Site web : [seafile.com](https://www.seafile.com/en/home/)
+ Démonstration : [Démo](https://demo.seafile.com/accounts/login/?next=/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/seafile](https://github.com/YunoHost-Apps/seafile_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/seafile/issues](https://github.com/YunoHost-Apps/seafile_ynh/issues)
