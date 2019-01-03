# Noms de domaines nohost.me

Afin de rendre l'auto-hébergement le plus accessible possible, YunoHost propose un service de noms de domaine *gratuits* et *automatiquement configurés*. En utilisant ce service, vous n'avez donc pas à réaliser vous-même la [configuration des enregistrements DNS](/dns_config) qui est assez technique.

Les (sous-)domaines suivants sont proposés :
- `cequevousvoulez.nohost.me` ;
- `cequevousvoulez.noho.st` ;
- `cequevousvoulez.ynh.fr`.

Pour profiter de ce service, il vous suffit de choisir un tel domaine lors de la post-installation. Il sera ensuite automatiquement configuré par YunoHost !

### Récupérer un domaine nohost.me ou noho.st

Si vous réinstallez votre serveur et voulez utiliser un domaine déjà utilisé précédemment, il vous faut demander une réinitialisation du domaine sur le forum [dans le fil de discussion dédié](https://forum.yunohost.org/t/nohost-domain-recovery/442).

### Sous-domaines

Le service de domaines `nohost.me` et `noho.st` n'autorise pas la création de sous-domaines.

Même si YunoHost permet l'installation d'applications sur des sous-domaines (par exemple avoir l'application Owncloud accessible depuis l'adresse `cloud.mondomaine.org`), cette fonctionnalité n'est pas permise avec les domaines `nohost.me` et `noho.st` et il n’est pas possible d’avoir un sous-sous-domaine tel `monapplication.mondomaine.nohost.me`.

Pour pouvoir profiter des applications installables uniquement à la racine d’un nom de domaine, il faut avoir son propre nom de domaine.

### Ajouter un domaine nohost.me / noho.st / ynh.fr après la post-installation

Si vous avez déjà effectué la postinstallation est souhaitez ajouter un domaine
de type nohost.me, vous pouvez utiliser les commandes suivantes (uniquement
faisable depuis la ligne de commande pour le moment).

N.B. : vous ne pouvez avoir qu'*un* seul domaine nohost.me par installation de
YunoHost.

```bash
# Ajouter le domaine
yunohost domain add cequevousvoulez.nohost.me

# Enregister le domaine dans le service dyndns
yunohost dyndns subscribe -d cequevousvoulez.nohost.me

# [ attendre ~ 30 seconds ]

# Mettre à jour la configuration DNS
yunohost dyndns update
```

