---
title: Mailman3
template: docs
taxonomy:
    category: docs, apps
routes:
  default: '/app_mailman3'
---

[![Installer Mailman3 avec YunoHost](https://install-app.yunohost.org/install-with-yunohost.svg)](https://install-app.yunohost.org/?app=mailman3) [![Integration level](https://dash.yunohost.org/integration/mailman3.svg)](https://dash.yunohost.org/appci/app/mailman3)

*Mailman3* est un gestionnaire de liste de discussion par email.

## Captures d'écran

![Capture d'écran de Mailman3](https://github.com/YunoHost-Apps/mailman3_ynh/blob/master/doc/screenshots/screenshot1.webp)

## Avertissements / informations importantes

* Toutes les limitations, contraintes ou choses connues qui ne fonctionnent pas, telles que (mais pas limitées à) :
    * nécessitant un domaine dédié complet

* Autres informations que les gens devraient connaître, telles que :
    * Il n'y a pas encore de support LDAP (apparemment en cours de développement).
    * Les utilisateurs peuvent également s'inscrire eux-mêmes pour gérer les détails.
    * Les utilisateurs peuvent utiliser les listes de diffusion sans s'inscrire ?

L'administration classique est disponible sur la page : https://myyunohost.org/

L'admin Django est disponible sur la page : https://myyunohost.org/admin/

## Configuration générale

Mailman 3 ou "The Mailman Suite" est composé de 5 parties mobiles. Pour en savoir plus, consultez la documentation suivante :

> http://docs.mailman3.org/en/latest/index.html#the-mailman-suite

Sur votre YunoHost, tous les fichiers de configuration dont vous devez vous soucier se trouvent dans :

* `/etc/mailman3/`
* `/usr/share/mailman3-web/`

Les services que vous devez gérer peuvent être vérifiés avec :

* `systemctl status mailman3`
* `systemctl status mailman3-web`

Il est important de noter que ce paquet utilise le paquet Debian [mailman3-full](http://docs.mailman3.org/en/latest/prodsetup.html#distribution-packages) contenu dans le dépôt des rétro-portages (backports) de Debian Stretch. L'installation par défaut suppose l'utilisation d'une base de données SQLite3, mais le script d'installation passe outre et utilise une base de données PostgreSQL à la place.

Enfin, vous pouvez également configurer les choses via l'administration web de Django disponible à `/admin/`

## Limitations

* La migration à partir de Mailman 2.X n'est pas officiellement supportée, désolé. Cependant, il existe un manuel qui détaille un processus expérimental. Veuillez consulter [la documentation] (https://docs.mailman3.org/en/latest/migration.html).

* Mailman3 doit être configuré pour utiliser un domaine principal (https://myyunohost.org et non https://myyunohost.org/mailman3).

* Vous devez avoir un certificat HTTPS installé sur le domaine racine.

* Il ne peut y avoir qu'une seule installation par YunoHost.

## Liens utiles

+ Site web : [list.org](https://www.list.org/)
+ Démonstration : [Démo](https://lists.mailman3.org/mailman3/lists/)
+ Dépôt logiciel de l'application : [github.com - YunoHost-Apps/mailman3](https://github.com/YunoHost-Apps/mailman3_ynh)
+ Remonter un bug ou une amélioration en créant un ticket (issue) : [github.com - YunoHost-Apps/mailman3/issues](https://github.com/YunoHost-Apps/mailman3_ynh/issues)
