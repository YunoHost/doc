# Domaines dynamiques Nohost.me

Afin de rendre l'auto-hébergement aussi accessible que possible, le projet YunoHost fournit un service de nom de domaine *gratuit* et *configuré automatiquement*. En utilisant ce service, vous n'aurez pas à [configurer les enregistrements DNS](/dns_config) vous-même, ce qui peut être fastidieux et technique.

Les (sous-)domaines suivants sont proposés :
- `whateveryouwant.nohost.me` ;
- `whateveryouwant.noho.st` ;
- "whateveryouwant.ynh.fr".

Pour utiliser ce service, il vous suffit de choisir un tel domaine lors de la post-installation. Il sera ensuite automatiquement configuré par YunoHost !

N.B. : Par mesure d'équité, chaque instance ne peut avoir **un tel domaine** configuré à un moment donné.

### Sous-domaines

Le service de domaine " nohost.me ", " noho.st " et " synh.fr " permet la création de sous-domaines.

YunoHost permet l'installation d'applications sur des sous-domaines (par exemple, avoir l'application Nextcloud accessible depuis l'adresse `cloud.mondomaine.org`), cette fonctionnalité est également autorisée avec les services `nohost.me`, `noho.st` et `ynh. fr` et il est donc possible d'avoir un sous-domaine tel que `monapplication.mondomaine.nohost.me`. Pour créer un sous-domaine pour les domaines `nohost.me`, `noho.st` et `ynh.fr` il suffit d'ajouter le sous-domaine à yunohost comme n'importe quel autre domaine.


### Ajout d'un domaine nohost.me, noho.st ou ynh.fr après la post-installation

Si vous avez déjà effectué la post-installation et que vous souhaitez ajouter un domaine automatique, vous pouvez le faire à partir de l'interface web "Domaines", en sélectionnant l'option "Je n'ai pas de nom de domaine...".

Vous pouvez également utiliser les commandes suivantes.

"Bash
# Ajouter le domaine
yunohost domain add whateveryouwant.nohost.me

# S'abonner/enregistrer au service dyndns
yunohost dyndns subscribe -d whateveryouwant.nohost.me

# [ attendre ~ 30 secondes ]

# Mettre à jour la conf DNS
mise à jour de yunohost dyndns

# En faire le domaine principal
yunohost domain main-domain -n whateveryouwant.nohost.me
```

### Récupérer un domaine nohost.me, noho.st ou ynh.fr

Si vous réinstallez votre serveur et souhaitez utiliser un domaine déjà utilisé précédemment, vous devez demander une réinitialisation de domaine sur le forum [dans le fil de discussion dédié] (https://forum.yunohost.org/t/nohost-domain-recovery/442).


### Changer un domaine nohost.me, noho.st ou ynh.fr

Si vous souhaitez utiliser un autre domaine automatique, vous devez d'abord supprimer votre enregistrement de domaine actuel. Cela se fait en 3 étapes :

1. Supprimez le domaine de votre instance (via webadmin ou le CLI "Yunohost domain remove"). 
**/!\ Attention : ceci supprimera toute application installée sur ce domaine, ainsi que ses données.**
2. Demandez la suppression de l'enregistrement [dans le fil de discussion du forum dédié] (https://forum.yunohost.org/t/nohost-domain-recovery/442).
3. Supprimez les fichiers de configuration automatique du domaine sur votre serveur, via le CLI uniquement : `sudo rm /etc/cron.d/yunohost-dyndns && sudo rm -r /etc/yunohost/dyndns`.

Vous pouvez alors ajouter un nouveau domaine.
