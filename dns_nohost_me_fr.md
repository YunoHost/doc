# Noms de domaines automatiques

Afin de rendre l'auto-hébergement le plus accessible possible, le Projet YunoHost fournit un service de noms de domaine *offerts* et *automatiquement configurés*. En utilisant ce service, vous n'avez donc pas à réaliser vous-même la [configuration des enregistrements DNS](/dns_config) qui est assez technique.

Les (sous-)domaines suivants sont proposés :
- `cequevousvoulez.nohost.me` ;
- `cequevousvoulez.noho.st` ;
- `cequevousvoulez.ynh.fr`.

Pour profiter de ce service, il vous suffit de choisir un tel domaine lors de la post-installation. Il sera ensuite automatiquement configuré par YunoHost !

N.B. : Pour des raisons d'équité, vous ne pouvez avoir qu'*un seul domaine* nohost.me par installation de
YunoHost.

### Sous-domaines

Le service de domaines `nohost.me`, `noho.st` et `ynh.fr` n'autorise pas la création de sous-domaines.

Même si YunoHost permet l'installation d'applications sur des sous-domaines (par exemple avoir l'application Owncloud accessible depuis l'adresse `cloud.mondomaine.org`), cette fonctionnalité n'est pas permise avec les domaines `nohost.me` et `noho.st` et il n’est pas possible d’avoir un sous-sous-domaine tel `monapplication.mondomaine.nohost.me`.

Pour pouvoir profiter des applications installables uniquement à la racine d’un nom de domaine, il faut avoir son propre nom de domaine.

### Ajouter un domaine nohost.me, noho.st ou ynh.fr après la post-installation

Si vous avez déjà effectué la postinstallation et souhaitez ajouter un domaine
de type nohost.me, vous pouvez utiliser la catégorie "Domaines" de l'interface web,
en choisissant l'option "je n'ai pas de nom de domaine..."

Vous pouvez également utiliser les commandes suivantes depuis la ligne de commande.

```bash
# Ajouter le domaine
yunohost domain add cequevousvoulez.nohost.me

# Enregister le domaine dans le service dyndns
yunohost dyndns subscribe -d cequevousvoulez.nohost.me

# [ attendre ~ 30 secondes ]

# Mettre à jour la configuration DNS
yunohost dyndns update

# Le définir comme nouveau domain principal
yunohost tools maindomain --new-domain whateveryouwant.nohost.me
```

### Récupérer un domaine nohost.me, noho.st ou ynh.fr

Si vous réinstallez votre serveur et voulez utiliser un domaine automatique déjà utilisé précédemment, il vous faut demander une réinitialisation du domaine au Projet YunoHost, [dans le fil de discussion dédié du forum](https://forum.yunohost.org/t/nohost-domain-recovery/442).

### Changer un domaine nohost.me, noho.st ou ynh.fr
Si vous voulez utiliser un autre domaine automatique sur votre serveur, vous devez d'abord supprimer celui qui est déjà configuré, selon les instructions suivantes :
1. Supprimer le domaine de votre instance (par webadmin ou `yunohost domain remove`). **Attention : cela supprimera
toute application installée sur ce domaine, ainsi que ses données**.
2. Demander la suppression de votre souscription [dans le fil de discussion dédié du forum](https://forum.yunohost.org/t/nohost-domain-recovery/442).
3. Enlever les fichiers de configuration automatique sur votre instance (uniquement depuis la ligne de commande pour le moment) : `sudo rm /etc/cron.d/yunohost-dyndns && sudo rm -r /etc/yunohost/dyndns`


Vous pourrez ensuite enregistrer un nouveau domaine automatique.
